<!DOCTYPE html>
<html>
<head>
    <title>Character Sheet Generator</title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .charsheet {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .padmeplease {
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<div class='container'>
    <div class="col-sm-6 col-sm-offset-3 charsheet">
        <form action="CharacterSheetResponse.php" method="post">
            <div class = "padmeplease">
                <div class="form-group col-sm-8">
                    <label>Name</label>
                    <input type='text' name="HeroName" class="form-control"/>
                </div>
                <div class = "form-group col-sm-4">
                    <label>Age</label>
                    <input type = "text" name="Age" class="form-control"/>
                </div>
            </div>
            <div class="form-group padmeplease">
                <label>Race</label>
                <select name = "Race" class = 'form-control'>
                    <option value="Human">Human</option>
                    <option value="Dwarf">Dwarf</option>
                    <option value="Halfling">Halfling</option>
                    <option value="Elf">Elf</option>
                </select>
            </div>
            <div class="form-group padmeplease">
                <label>Class</label>
                <select name="Class" class="form-control">
                    <option value="Fighter">Fighter</option>
                    <option value="Mage">Mage</option>
                    <option value="Cleric">Cleric</option>
                    <option value="Thief">Thief</option>
                </select>
            </div>
            <div class = "padmeplease">
                <label class="radio-inline">
                    <input name="Sex" type='radio' value="Male"/>
                    Male
                </label>
                <label class="radio-inline">
                    <input name="Sex" type="radio" value="Female"/>
                    Female
                </label>
            </div>
            <input type="submit" name="Submit" value="Submit" class="btn btn-primary"/>
        </form>
        <a href="/ClassroomExercises.html">More Classroom Exercises...</a>
    </div>
</div>
</body>
</html>