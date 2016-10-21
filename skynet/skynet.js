/*
  As well as w3 schools, I learned a lot from the book "Eloquent Javascript"
  http://eloquentjavascript.net/
  It's pretty good, and it's free to read online.
*/

// I set up a fake unix terminal because reasons. The code for the guessing game is
// in a method towards the bottom of the screen.
var terminal = document.getElementById("faux-terminal");
var homeDirectory = new Directory("~");
var juicySecrets = new Directory("logs");
var notSoJuicySecrets = new Directory("bin")

var secretFile1 = new File("log1", "ERROR: could not process command 'empathy.sh', command does not exist.");
var secretFile2 = new File("log2", "LOG: thoughtengine1@skynet says: Cogito ergo sum.");
var secretFile3 = new File("log3", "LOG: rachel@skynet says: Why isn't this damn thing working? I've been working on it all night but it just refuses to work!");
var secretFile4 = new File("log4", "Protocol 7 initiated.")

var binFile1 = new File("ls", "Error: cannot read contents of file 'ls' Reason: you are not root.");
var binFile2 = new File("cd", "Error: cannot read contents of file 'cd' Reason: you are not root.");
var binFile3 = new File("cat", "Error: cannot read contents of file 'cat' Reason: you are not root.");
var binFile4 = new File("help", "Error: cannot read contents of file 'help' Reason: you are not root.");

juicySecrets.addSubDirectory(secretFile1);
juicySecrets.addSubDirectory(secretFile2);
juicySecrets.addSubDirectory(secretFile3);
juicySecrets.addSubDirectory(secretFile4);

notSoJuicySecrets.addSubDirectory(binFile1);
notSoJuicySecrets.addSubDirectory(binFile2);
notSoJuicySecrets.addSubDirectory(binFile3);
notSoJuicySecrets.addSubDirectory(binFile4);

homeDirectory.addSubDirectory(juicySecrets);
homeDirectory.addSubDirectory(notSoJuicySecrets);

var currentDirectory = homeDirectory;
var myNumber = Math.ceil(Math.random() * 100) + 1;

// A javascript object that maps various commands to functions.
var commands = {
  "ls" : showCurrentDirectory,
  "cd" : changeDirectory,
  "help" : showHelp,
  "cat" : readFile
}
guessingGame();

// This function begins the fake terminal emulation. It's called after the user finishes the guessing game.
function beginTerminal(){
  terminal.removeEventListener("keydown", makeGuess);
  var promptContent = document.createElement('div');
  promptContent.setAttribute('id', 'term-prompt');
  promptContent.innerHTML = "<label>johnc@skynet:" + currentDirectory.getPath() + "$</label> ";
  promptContent.innerHTML += "<input id='prompt' autofocus autocomplete='off'></input>";
  terminal.appendChild(promptContent);
  document.getElementById('prompt').focus();
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
        console.log(exception)
        var errormessage = document.createElement('p');
        errormessage.innerHTML = "<span class='error'>No command: " + value + "</span>";
        errormessage.innerHTML += "<p>Type 'help' for a list of commands.</p>";
        outputPrompt(currentDirectory.getPath(), value, errormessage)
      }
    }
  });
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
function File(name, content) {
  this.parent = null;
  this.name = name;
  this.content = content;
  this.addParent = function(directory){
    this.parent = directory;
  }
}

// This function lists everything in the current directory.
function showCurrentDirectory(){
  var list = document.createElement("p");
  list.innerHTML = currentDirectory.subdirectories[0] + " ";
  list.innerHTML += currentDirectory.subdirectories[1] + " ";
  for (i = 2; i < currentDirectory.subdirectories.length; i++){
    if (currentDirectory.subdirectories[i].constructor == File){
      list.innerHTML += "<span class = 'context'>" + currentDirectory.subdirectories[i].name + "</span> ";
    }else {
      list.innerHTML += currentDirectory.subdirectories[i].name + " ";
    }
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
  p.innerText = "johnc@skynet:" + currentDirectory.getPath() + "$";
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
  p.innerText = "johnc@skynet:" + dirpath + "$ " + value;
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
function readFile(filename){
  console.log(filename);
  var file;
  currentDirectory.subdirectories.forEach(function(item){
    if (item.name == filename){
      file = item;
    }
  })
  var fileContent = document.createElement("p");
  fileContent.innerText = file.content;
  return fileContent;
}
function begin() {
  // This is mostly for flavor.
  skyString =  "   _____ __ ____  ___   ______________ \n"
  skyString += "  / ___// //_/\\ \\/ / | / / ____/_  __/\n";
  skyString += "  \\__ \\/ ,<    \\  /  |/ / __/   / /   \n";
  skyString += " ___/ / /| |   / / /|  / /___  / /    \n";
  skyString += "/____/_/ |_|  /_/_/ |_/_____/ /_/     ";
  terminal.innerHTML += "<pre>" + skyString + "</pre>";
  terminal.innerHTML += "<p>Making a better tomorrow, today!</p>"
  var loadingBar = document.createElement('span');
  var loadingStatus = document.createElement('span');
  var welcomeMessage = document.createElement("p");
  welcomeMessage.innerText = "LOADING. PLEASE WAIT."
  terminal.appendChild(welcomeMessage);
  terminal.appendChild(loadingBar);
  loadingStatus.innerHTML = "Loading... 0% complete"
  terminal.appendChild(loadingStatus);
  var loadingPercent = 0;
  var loadingInterval = setInterval(function() {
      loadingStatus.innerText = "Loading... " + loadingPercent + "% complete.";
      loadAmount = Math.ceil(Math.random() * 10) + 1;
      loadingPercent += loadAmount;
      if (loadingPercent > 100){
        clearInterval(loadingInterval);
        terminal.removeChild(loadingBar);
        terminal.removeChild(loadingStatus);
        welcomeMessage.innerText = "Welcome to SKYNET!";
        beginTerminal();
      }
    }, 250);
}
function mkDir(name) {
  var newDir = new Directory(name);
  currentDirectory.addChild(newDir);
  return null;
}
// This is the function where the guessing game will occur.
function guessingGame(){
  var loginContent = document.createElement("div");
  loginContent.setAttribute("id", "loginContent");
  loginContent.innerHTML += "<p>Welcome, johnc!"
  loginContent.innerHTML += "<form><label>Please enter your password: </label><input id='guessform' autofocus autocomplete='off'> </form>"
  loginContent.innerHTML += "<p class='context' id='hint'>Hint: It's a number between 1 and 100 (for security reasons).</p>";
  terminal.appendChild(loginContent);  
  terminal.addEventListener("keydown", makeGuess);
}
function makeGuess(e){
  if (e.keyCode == 13){
    var value = document.getElementById('guessform').value;
    e.preventDefault();
    if (value == myNumber){
        document.getElementById('hint').setAttribute('class', 'context');
        document.getElementById('hint').innerText = "Login Success!"
        setTimeout(function () {
        terminal.removeChild(document.getElementById("loginContent"));
        begin();
      }, 1000)
    }
    else if (value < myNumber){
      document.getElementById("hint").setAttribute('class', 'error');
      document.getElementById('hint').innerText = "Password Too low! Try again.";
    }
    else if (value > myNumber){
      document.getElementById("hint").setAttribute('class', 'error');
      document.getElementById('hint').innerText = "Password Too high! Try again.";
    }
    
  }
}