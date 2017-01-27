<?php
// Using a JSON file in order to save space.
$rawCharacterSheetData = file_get_contents("characterdescriptions.json");
$characterData = json_decode($rawCharacterSheetData);

$name = $_POST["HeroName"];
$race = $_POST["Race"];
$sex = $_POST["Sex"];
$age = $_POST["Age"];
$class = $_POST["Class"];

$imagePartial = substr($race, 0, 2) . substr($class, 0, 2)  . substr($sex, 0, 2);
$image = "<img src = \"/assets/images/CharacterSheet/$imagePartial.jpg\" class=\"character-image\" align='right'/>";

$raceDescription = $characterData->{"Races"}->{$race}->{"Description"};
$raceRestrictions = $characterData->{"Races"}->{$race}->{"Restrictions"};
$raceSpecialAbilities = $characterData->{"Races"}->{$race}->{"Special Abilities"};
$raceSavingThrows = $characterData->{"Races"}->{$race}->{"Saving Throws"};

$classDescription = $characterData->{"Classes"}->{$class};
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .character-image {
            max-width: 50%;
            max-height: 50%;
            padding: 20px 20px 20px 20px;
        }
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class='container'>
    <div class = "page-header">
        <?php echo "<h2>$name, the $race $class. <span class='small'>Age $age</span></h2>" ?>
    </div>
    <?php
    echo $image ;
    echo "<h3>Description</h3>";
    echo "<p>$raceDescription</p>";
    echo "<h4>Restrictions</h4>";
    echo "<p>$raceRestrictions</p>";
    echo "<h4>Special Ablilities</h4>";
    echo "<p>$raceSpecialAbilities</p>";
    echo "<h4>Saving Throws</h4>";
    echo "<p>$raceSavingThrows</p>";
    echo "<hr/>";
    echo $classDescription;
    ?>
    <a href = "CharacterSheetGenerator.php" class = "btn btn-primary">Generate another character</a>
    <button class = "btn btn-default" onclick="window.print()">Print page</button>
</body>
</html>