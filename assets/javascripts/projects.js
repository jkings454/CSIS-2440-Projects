function getGroups(){
  $.ajax({
    url:"http://www.joshualnichols.com/api/v1/project_groups",
    dataType: 'json',
    success: showGroups
  })
}
function showGroups(data){
  $('#groups').empty();
  $.each(data, function(i, group){
    $('#groups').append("<a href = '#' class='list-group-item' onClick='getGroup(" +  group.id + ")'> <h4>" + group.title + "</h4></a>");
  })
}
function getGroup(group_id){
  $('#projects').empty();
  $('#projects').append("<h1>Loading content...</h1>")
  $.ajax({
    url:"http://www.joshualnichols.com/api/v1/project_groups/" + group_id,
    dataType: 'json',
    success: showGroup
  })
}
function showGroup(data){
  $('#projects').empty();
  var showString = "";
  showString += "<h1>" + data.title + "</h1>";
  showString += "<ul>"
  $.each(data.projects, function(i, project){
    showString += "<li>" + project.name + "</li>";
  })
  showString += "</ul>"
  $('#projects').append(showString);

}
$(document).ready(getGroups());
