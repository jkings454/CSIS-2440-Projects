var xPlayer = prompt('Player x what is your name?');
var oPlayer = prompt('Player O what is your name?');
document.getElementById("pX").innerHTML = xPlayer + ": <span id='xScore'>0</span>";
document.getElementById("pO").innerHTML = oPlayer + ": <span id='oScore'>0</span>";
document.getElementById("turn").innerText = xPlayer;
var currentPlayer = true; // true == x, false == o
var xGameTotal = 0;
var oGameTotal = 0;
var xWins = 0;
var oWins = 0;
var catWins = 0;
var gameOver = false;

var winsArray = [7, 56, 448, 73, 146, 292, 273, 84];

function playerMoved(id, value){
    if (id.innerText == "" && !gameOver) {
        changeMarker(id);
        updatePlayerTotal(value);

        if (checkWinner(xGameTotal)) {
            xWins++;
            victory(xPlayer);
        }

        if (checkWinner(oGameTotal)) {
            oWins++;
            victory(oPlayer);
        }

        if (oGameTotal+xGameTotal===511){
            catWins++;
            victory("Nobody");
        }

        switchPlayers();
    }
}

function checkWinner(total){
    for (var i = 0; i < winsArray.length; i++){
        if ((winsArray[i] & total) === winsArray[i]){
            return true;
        }
    }
    return false;
}
function changeMarker(id) {
    if (currentPlayer) id.innerHTML = "X";
    else id.innerHTML = "O";
}
function updatePlayerTotal(value){
    if (currentPlayer) xGameTotal += value;
    else oGameTotal += value;
}
function switchPlayers(){
    currentPlayer = !currentPlayer;
    document.getElementById("turn").innerText = currentPlayer ? xPlayer : oPlayer;
}
function victory(player){
    document.getElementById("victory").innerText = player + " Wins!";
    gameOver = true;
    document.getElementById("oScore").innerText = oWins;
    document.getElementById("xScore").innerText = xWins;
}
function resetBoard() {
    var elems = document.getElementsByClassName("box");
    console.log(elems);
    xGameTotal = 0;
    oGameTotal = 0;
    for (var i = 0; i < elems.length; i++){
        elems[i].innerHTML = "";
    }
    if(!currentPlayer) switchPlayers();
    document.getElementById("victory").innerText = "";
    gameOver = false;
}
function resetEverything() {
    if (confirm("Are you sure you want to reset everything?")){
        location.reload();
    }
}