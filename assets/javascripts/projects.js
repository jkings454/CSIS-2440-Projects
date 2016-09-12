// Author: Josh Nichols.
// This script uses jQuery to perform a remote origin AJAX request.

/*
  This method is what will make the call to my website, requesting the raw JSON data.
*/
function getGroups(){
  $.ajax({
    url:"http://www.joshualnichols.com/api/v1/project_groups",
    dataType: 'json',
    cache: true,
    // Upon the success of the request, the function 'showGroups' will be called.
    success: showGroups
  })
}

/*
  This function is called when the AJAX request succeeds. It will display the information it recieved
  from the JSON request onto the DOM, using jQuery functions.
*/
function showGroups(data){
  // This clears the DOM element with the id 'groups'
  $('#groups').empty();
  // $.each() is basically a forEach function provided by jQuery.
  $.each(data, function(i, group){
    // append the information we recieved through AJAX to this group...
    $('#groups').append("<a href = '#' class='list-group-item' onClick='getGroup(" +  group.id + ")'> <h4>" + group.title + "</h4></a>");
  })
}
/*
  Whenever a list item is clicked, it will call this function. This function will begin an AJAX request in order to recieve specific
  information about the project group and the projects within it.
*/
function getGroup(group_id){
  // This merely displays a very fancy loader on our DOM in order to let the users know their content is loading...
  $('#projects').html("<div class = 'loader'>Loading Content...</div>")
  $.ajax({
    url:"http://www.joshualnichols.com/api/v1/project_groups/" + group_id,
    dataType: 'json',
    cache: true,
    success: showGroup
  })
}

/*
  This callback method is called upon the success of the getGroup AJAX request.
  It fetches our project data and displays it in a very pretty format.
*/
function showGroup(data){
  var showString = "";
  showString += "<div class = 'page-header'>";
  showString += "<h1 class = 'group-header'>" + data.title + "</h1>";
  showString += "</div>";
  $.each(data.projects, function(i, project){
    showString += "<div class = 'col-md-6'>"
    showString += "<article>"
    showString += "<a href = '" + project.link + "' target = '_blank'><h1>" + project.name + "</h1></a>";
    showString += "<p>" + project.description + "</p>";
    showString += "</article>"
    showString += "</div>"
  })
  $('#projects').html(showString);

}

// Once our document is ready, begin the 'getGroups()' function.
$(document).ready(getGroups());
