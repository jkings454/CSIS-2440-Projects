<!--
    Author: Josh Nichols

    WhoAmI.php: A form that definitely will not be used for nefarious purposes.
-->
<?php
// Literally doing this because I don't want to type all 50 states.
// Fortunately there was a nice list online for me to copy.
$states = explode("\n", file_get_contents("states.txt"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Who Am I?</title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        /*Style that ensures this page looks decent on mobile.*/
        .padding {
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
<!-- Who needs CSS when you have bootstrap. -->
<div class='container'>
    <div class="page-header">
        <h1>Who Am I?</h1>
    </div>
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <form action="WhoYouAre.php" method="post">
            <div class="form-group col-sm-9">
                <label>Name</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <div class="form-group col-sm-3">
                <label>Age</label>
                <input type="number" name="age" class="form-control"/>
            </div>
            <div class="form-group col-sm-8">
                <label>Address</label>
                <input type="text" name="address" class="form-control"/>
            </div>
            <div class="form-group col-sm-4">
                <label>State</label>
                <select name="state" class="form-control">can
                    <?php
                    // Thank god for for-loops.
                    foreach($states as $state) {
                        echo "<option value='$state'>$state</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-12 text-center">
                <label class="radio-inline" >
                    <!-- Defaulting to male ensures we ALWAYS get an answer. -->
                    <input type="radio" checked="checked" value="male" name="sex"/>
                    Male
                </label>
                <label class="radio-inline">
                    <input type="radio" value="female" name="sex"/>
                    Female
                </label>
            </div>
            <div class="col-sm-12 padding text-center">
                <a href="/" class="btn btn-default">Back to homepage</a>
                <input type="submit" class="btn btn-primary"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>