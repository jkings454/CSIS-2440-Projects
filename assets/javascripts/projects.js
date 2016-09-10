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
  $('#projects').html("<div class = 'loader'>Loading Content...</div>")
  $.ajax({
    url:"http://www.joshualnichols.com/api/v1/project_groups/" + group_id,
    dataType: 'json',
    success: showGroup
  })
}
function showGroup(data){
  var showString = "";
  showString += "<div class = 'page-header'>";
  showString += "<h1 class = 'group-header'>" + data.title + "</h1>";
  showString += "</div>";
  $.each(data.projects, function(i, project){
    showString += "<div class = 'col-md-6'>"
    showString += "<h1>" + project.name + "</h1>";
    showString += "<p>" + project.description + "</p>";
    showString += "</div>"
  })
  $('#projects').html(showString);

}
$(document).ready(getGroups());
