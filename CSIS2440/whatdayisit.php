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
      <?php
      $d = date("D");
      echo "$d<br/>";
      if ($d == "Fri" or $d == "Sat" || $d == "Sun") {
          $message = "Have a nice weekend!";
      }
      else {
          $message = "Have a nice day!";
      }
      echo "$message<br/>";

//      $days = array(
//          "Mon" => "Monday",
//          "Tue" => "Tuesday",
//          "Wed" => "Wednesday",
//          "Thu" => "Thursday",
//          "Fri" => "Friday",
//          "Sat" => "Saturday",
//          "Sun" => "Sunday"
//      );
//
//      echo "<h1>Today is $days[$d].</h1>";
      //An alternative approach.
      switch ($d) {
          case "Mon":
              echo "<h1>Today is Monday</h1>";
              break;
          case "Tue":
              echo "<h1>Today is Tuesday</h1>";
              break;
          case "Wed":
              echo "<h1>Today is Wednesday</h1>";
              break;
          case "Thu":
              echo "<h1>Today is Thursday</h1>";
              break;
          case "Fri":
              echo "<h1>Today is Friday</h1>";
              break;
          case "Sat":
              echo "<h1>Today is Saturday</h1>";
              break;
          case "Sun":
              echo "<h1>Today is Sunday</h1>";
              break;
          default:
              echo "<h1>There is no day</h1>";
              break;
      }

      $a = 0;
      $b = 0;

      print("<table width='50px'><tr><th>$a</th><th>$b</th></tr>");
      for ($i = 0; $i < 5; $i++) {
          $a += 10;
          $b += 5;
          print("<tr><td>$a</td><td>$b</td></tr>");
      }
      print("</table><br>At the end of the loop a=$a and b=$b");

      $i = rand(0,50);
      $num = rand(51, 100);

      while ($i < $num) {
          $num--;
          $i++;
      }
      echo "<br>Loop stopped at i=$i and num=$num";

      echo "<br>Year of birth: <select>";
      $year1=date("Y");
      for ($y = 0; $y < 100; $y++) {
          if ($y > 10) {
              $yearval = $year1 - $y;
              echo "<option>$yearval</option>";
          }
      }
      echo "</select>";
      ?>
  </div>
  </body>
</html>