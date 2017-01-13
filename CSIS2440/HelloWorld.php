<!DOCTYPE html>
<html>
<head>
    <title>Hello World!</title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <script type='text/javascript'
            src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript'
            src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
<div class='container'>
    <!--
        I'm not sure whether these are supposed to be in the PHP comments or the HTML comments so I did both.

        Name: Joshua Nichols
        Age: 20
    -->
    <a href = "/">Back to homepage.</a>
    <?php
        echo "<h1>Hello world</h1>";
        $greeting = "PHP is FUN!\n";
        echo $greeting;

        /*  Name: Joshua Nichols
         *  Age: 20
         */
    ?>
    <script>
        // Eh, why not write this as a javascript comment for completion's sake.
        /*
            Name: Joshua Nichols
            Age: 20
         */
    </script>

</div>
</body>
</html>