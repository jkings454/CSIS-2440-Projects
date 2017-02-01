<?php
$antagonists = explode("\n", file_get_contents("../assets/misc/StoryIdeaFiles/antagonists.txt"));
$complications = explode("\n", file_get_contents("../assets/misc/StoryIdeaFiles/complications.txt"));
$objectives = explode("\n", file_get_contents("../assets/misc/StoryIdeaFiles/objectives.txt"));
$settings = explode("\n", file_get_contents("../assets/misc/StoryIdeaFiles/settings.txt"));
?>

<!DOCTYPE html>
<html>
  <head>
      <title></title>
      <link rel ='stylesheet' type ='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
      <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
      <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
  </head>
  <body>
  <div class='container'>
      <div class="page-header">
          <h1>Generate a story idea.</h1>
      </div>
      <?php if (isset($_POST['Name'])) {
          shuffle($antagonists);
          shuffle($complications);
          shuffle($objectives);
          shuffle($settings);

          $name = ucwords(strtolower($_POST["Name"]));
          $age = $_POST["Age"];
          $sex =$_POST["Sex"];
          $class = $_POST["Class"];
          ?>
          <h4>This is the story of <?php echo $name ?>.</h4>
          <p><?php echo $name?> is a <?php echo ($age < 30) ? "young":"young at heart"?>
          <?php echo ($sex=="Male") ? " man":" woman"?> at the age of <?php echo $age?>. <?php echo $name?> is a
              world renowned <?php echo $class?>.</p>

          <p>One day,</p>
          <ul>
              <li><?php echo $settings[0]?></li>
              <li><?php echo $objectives[0]?></li>
              <li><?php echo $antagonists[0]?></li>
              <li><?php echo $complications[0]?></li>
          </ul>
      <?php } else {?>

          <div class="col-md-6 col-md-offset-3">
              <form action="StoryIdeaGenerator.php" method="post">
                  <div class="form-group col-sm-6">
                      <label>Name</label>
                      <input type="text" name="Name" class="form-control"/>
                  </div>
                  <div class="form-group col-sm-6">
                      <label>Age</label>
                      <input type="number" name="Age" class="form-control"/>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label>Class</label>
                          <select name="Class" class="form-control">
                              <option value="Detective">Detective</option>
                              <option value="Scientist">Scientist</option>
                              <option value="Soldier">Soldier</option>
                              <option value="Doctor">Doctor</option>
                          </select>
                      </div>
                      <div class="radio">
                          <label><input name="Sex" value="Male" type="radio" checked="checked"/>Male</label>
                      </div>
                      <div class="radio">
                          <label><input name="Sex" value="Female" type="radio"/>Female</label>
                      </div>
                      <div class="text-center">
                          <input type="submit" value="Submit" class="btn btn-primary btn-block btn-lg"/>
                          <a href="/ClassroomExercises.html" class="btn btn-default btn-block btn-lg">Back</a>
                      </div>
                  </div>
              </form>
          </div>
      <?php } ?>
  </div>
  </body>
</html>