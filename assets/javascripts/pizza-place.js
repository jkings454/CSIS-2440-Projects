$(document).ready(main());
var orderString = "";
function randomHeading(){
  var headings = ["Your Pizza Is Almost Ready", "We Appreciate You", "Sometimes I Wish I Was Pizza Too",
  "There is No Pizza", "Hot Pizzas In Your Area", "Where is the pizza?<br/><br/>In your heart.", "this pizza is hot, yo",
  "We have the best pizza. It's YUUGE.", "Quieres Pizza? Donde esta la biblioteca?"]
  window.setInterval(function(){
    var randomHeader = Math.floor(Math.random() * headings.length)
    $('#main-header h1').html(headings[randomHeader].toUpperCase())
  }, 60000);
}
function getAllValues(){
  var map = {};
  $("input").each(function() {
    if ($(this).attr('name') == 'toppings') {
      if (!('toppings' in map)){
        var toppings = [];
        $('input:checkbox:checked').each(function(){
          toppings.push($(this).val())
        });
        map["toppings"] = toppings
      }
    }
    else {
      if ($(this).attr('type') !== "button" && $(this).attr('type') !== "reset"){
        map[$(this).attr('name')] = $(this).val();
      }
    }
  })
  map[$("select").attr('name')] = $("select").val()
  return map;
}
function getAndDisplayPrice(){
  values = getAllValues();
  // Life is unfair.
  price = (Math.random() * 100).toFixed(2);
  showString = "<h1>Awesome!</h1>"
  showString += "<h4>Verify your order.</h4>"
  showString += "<ul>"
  Object.keys(values).forEach(function(key){
    if (key == 'toppings'){
      var toppingString = values[key].join(', ');
      showString += "<li><strong>Toppings:</strong> " + toppingString;
      orderString += "Toppings: " + toppingString + "%0D%0A"
    }
    else{
      showString += "<li><strong>" + key + ":</strong> " + values[key];
      orderString += key + ": " + values[key] + "%0D%0A"
    }
  });
  orderString += "Price: $" + price;
  showString += "<h3>Total: $" + price + "</h3>";
  showString += "<button class='btn btn-primary' onclick='sendMail(orderString)'>Send your order</button> "
  showString += "<button class='btn btn-default' onclick='location.reload()'>Redo Everything.</button>"
  $('#main').html(showString);

}
function sendMail(body) {
  window.open('mailto:jnicho97@bruinmail.slcc.edu?subject=Pizza Order&body=' + body);
}
function main() {
  randomHeading();
  listToppings();
}
function sanitizeString(str){
    str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
    return str.trim();
}
function listToppings(){
  // javascript: For when you want to do more work in order to do less work.
  var toppings = ["Pepperoni", "Anchovies", "Olives", "Jalepenos", "Pineapple", "Ham", "Habanero Peppers (for the bold)", "Extra Cheese",
                  "Tomato", "Basil", "Mushrooms", "Peanut Butter", "Doritos", "Orange Peels"];
  toppings.forEach(function(topping){
    var toppingChoice = "<label class = 'checkbox-inline'>";
    toppingChoice += "<input type='checkbox' name='toppings' value= '" + topping + "'>" + topping;
    toppingChoice += "</label>";
    $('#toppings').append(toppingChoice);
  })
}
