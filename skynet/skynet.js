var terminal = document.getElementById("faux-terminal");

var homeDirectory = new Directory("~");
var testDirectory = new Directory("test");

homeDirectory.addSubDirectory(testDirectory);

var currentDirectory = homeDirectory;

var commands = {
  "ls" : showCurrentDirectory,
  "cd" : changeDirectory,
  "help" : showHelp
}

var promptContent = document.createElement('div');
promptContent.setAttribute('id', 'term-prompt');
promptContent.innerHTML = "<label>user@skynet:" + currentDirectory.getPath() + "$</label> ";
promptContent.innerHTML += "<input id='prompt' autofocus></input>";
terminal.appendChild(promptContent);

function Directory(name){
  this.parent = null;
  this.subdirectories = [".", ".."];
  this.name = name;
  this.getPath = function() {
    if (this.parent){
      return this.parent.getPath() + "/" + this.name;
    }
    else {
      return this.name;
    }
  };
  this.addSubDirectory = function(directory){
    directory.addParent(this);
    this.subdirectories.push(directory);
  }
  this.addParent = function(directory){
    this.parent = directory;
  }
}
terminal.addEventListener("keydown", function(e) {
  if (e.keyCode == 13) {
    var value = document.getElementById("prompt").value;
    try {
      processCommand(value);
    }
    catch (exception) {
      var errormessage = document.createElement('p');
      errormessage.innerHTML = "<span class='error'>No command: " + value + "</span>";
      errormessage.innerHTML += "<p>Type 'help' for a list of commands.</p>";
      outputPrompt(currentDirectory.getPath(), value, errormessage)
    }

  }
});
function showCurrentDirectory(){
  var list = document.createElement("p");
  list.innerHTML = currentDirectory.subdirectories[0] + " ";
  list.innerHTML += currentDirectory.subdirectories[1] + " ";
  for (i = 2; i < currentDirectory.subdirectories.length; i++){
    list.innerHTML += currentDirectory.subdirectories[i].name + " ";
  }
  return list;
}
function changeDirectory(directory){
  var oldDir = currentDirectory.getPath();
  if (directory == "..") {
    if (currentDirectory.parent != null){
      currentDirectory = currentDirectory.parent;
    }
    else {
      var errormessage = document.createElement('p');
      errormessage.innerHTML = "<span class='error'>No directory above " + currentDirectory.getPath() + "</span>";
      return errormessage;
    }
  }
  else {
    for (i = 2; i < currentDirectory.subdirectories.length; i++){
      if (currentDirectory.subdirectories[i].name == directory){
        currentDirectory = currentDirectory.subdirectories[i];
      }
    }
  }
  var p = document.getElementById('term-prompt').childNodes[0];
  p.innerText = "user@skynet:" + currentDirectory.getPath() + "$";
  return null;

}
function processCommand(value){
  var splitVal = value.split(" ");
  var result;
  var dirpath = currentDirectory.getPath();
  if (splitVal.length > 1) {
    result = commands[splitVal[0]](splitVal[1]);
  }
  else {
    result = commands[value]();
  }
  outputPrompt(dirpath, value, result);
}
function outputPrompt(dirpath, value, result){
  var p = document.createElement('p');
  p.innerText = "user@skynet:" + dirpath + "$ " + value;
  terminal.appendChild(p);
  if (result != null){
    terminal.appendChild(result);
  }
  var prompt = document.createDocumentFragment();
  terminal.appendChild(prompt);
  prompt.appendChild(document.getElementById("term-prompt"));
  terminal.appendChild(prompt);
  document.getElementById("prompt").value = "";
  document.getElementById("prompt").focus();
}
function showHelp() {
  var helpmessage = document.createElement("p");
  helpmessage.innerHTML = "The following commands are available to you: ";
  Object.keys(commands).forEach(function(key) {
    helpmessage.innerHTML += "<p class = context>" + key + "</p>";
  });
  return helpmessage;
}
