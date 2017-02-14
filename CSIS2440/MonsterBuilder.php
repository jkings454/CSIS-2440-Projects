<?php
require_once "DatabaseConnection.php";

$newMob = array(
    array("Giant Ant", 17, 4, 1, "2d6", 60, "U", 240),
    array("Ape", 14, 4, 2, "1d4", 40, "N", 240),
    array("Assassin Vine", 15, 6, 1, "1d8", 5, "U", 500),
    array("Basilisk", 16, 6, 2,"1d10", 20, "F", 610),
    array("Dire Bear", 15, 7, 3, "2d8", 40, "N", 670),
    array("Fire Beetle", 16, 2,1, "2d4", 40, "N", 25),
    array("Blink Dog", 15, 4, 1, "1d6", 40, "C", 280),
    array("Dragon", 18, 7, 4, "2d10", 80, "H", 800),
    array("Dryad", 15, 2, 1, "1d4", 40, "D", 100),
    array("Elemental", 18, 8, 1, "1d12", 20, "N", 945),
    array("Gelatinous Cube", 12, 4, 1, "2d4", 20, "V", 280)
);

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
      <?php
      foreach($newMob as $mob) {
          $insert = <<<sql
INSERT INTO `MonsterThing`.`Monsters` (`MonsterName`, `MonsterAC`, `HitDice`, `MonsterAttack`, `MonsterDamage`,
            `MonsterMove`, `MonsterTreasure`, `MonsterXP`, `Active`) VALUES ('$mob[0]', $mob[1], $mob[2], $mob[3],
            '$mob[4]',$mob[5],'$mob[6]',$mob[7],'Y');
sql;
          $success = $connection->query($insert);
          if ($success == FALSE) {
              $failmess = "Whole query " . $insert . "<br />";
              echo $failmess;
              die('Invalid query: ' . mysqli_error($connection));
          } else {
              echo "$mob[0] was added <br />";
          }

      }
      ?>
  </div>
  </body>
</html>