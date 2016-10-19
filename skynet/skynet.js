/*
  As well as w3 schools, I learned a lot from the book "Eloquent Javascript"
  http://eloquentjavascript.net/
  It's pretty good, and it's free to learn online.
*/

// I set up a fake unix terminal because reasons. The code for the guessing game is
// in a method towards the bottom of the screen.
var terminal = document.getElementById("faux-terminal");

var homeDirectory = new Directory("~");
var testDirectory = new Directory("test");

homeDirectory.addSubDirectory(testDirectory);

var currentDirectory = homeDirectory;

// A javascript object that maps various commands to functions.
var commands = {
  "ls" : showCurrentDirectory,
  "cd" : changeDirectory,
  "help" : showHelp
}
guessingGame();

// This function begins the fake terminal emulation. It's called after the user finishes the guessing game.
function beginTerminal(){
  var promptContent = document.createElement('div');
  promptContent.setAttribute('id', 'term-prompt');
  promptContent.innerHTML = "<label>user@skynet:" + currentDirectory.getPath() + "$</label> ";
  promptContent.innerHTML += "<input id='prompt' autofocus></input>";
  terminal.appendChild(promptContent);
  // This just makes it so the user can use enter to submit a guess.
}
// This is a javascript class describing a directory (folder).
function Directory(name){
  // Javascript: Making orphans since 1995.
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
      // Some really fun exception handling.
      try {
        processCommand(value);
      }
      /*
        Rant time:
          Javascript has one exception class. And as far as I know, there's no distinction between
          the different types of errors. So if litterally ANYTHING goes wrong, this will catch it, 
          not just what I want it to catch.
        Sorry about that.
      */
      catch (exception) {
        var errormessage = document.createElement('p');
        errormessage.innerHTML = "<span class='error'>No command: " + value + "</span>";
        errormessage.innerHTML += "<p>Type 'help' for a list of commands.</p>";
        outputPrompt(currentDirectory.getPath(), value, errormessage)
      }
    }
  });
// This function lists everything in the current directory.
function showCurrentDirectory(){
  var list = document.createElement("p");
  list.innerHTML = currentDirectory.subdirectories[0] + " ";
  list.innerHTML += currentDirectory.subdirectories[1] + " ";
  for (i = 2; i < currentDirectory.subdirectories.length; i++){
    list.innerHTML += currentDirectory.subdirectories[i].name + " ";
  }
  return list;
}
// This sets the current directory.
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
// Processes the terminal input and acts accordingly using that nifty commands object
// that I set up.
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
// basically, displays a prompt 
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
// Should be called if the user types "help"
// displays a help message.
function showHelp() {
  var helpmessage = document.createElement("p");
  helpmessage.innerHTML = "The following commands are available to you: ";
  Object.keys(commands).forEach(function(key) {
    helpmessage.innerHTML += "<p class = 'context'>" + key + "</p>";
  });
  return helpmessage;
}
function guessingGame() {
  // This is mostly for flavor.
  skyString =  "   _____ __ ____  ___   ______________ \n"
  skyString += "  / ___// //_/\ \/ / | / / ____/_  __/\n";
  skyString += "  \__ \\ / ,<    \  /  |/ / __/   / /   \n";
  skyString += " ___/ / /| |   / / /|  / /___  / /    \n";
  skyString += "/____/_/ |_|  /_/_/ |_/_____/ /_/     ";
  terminal.innerHTML += "<pre>" + skyString + "</pre>";
}