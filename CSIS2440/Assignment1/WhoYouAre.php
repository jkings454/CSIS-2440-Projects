<?php
if (!isset($_POST["name"])) {
    /*
        Read this is how you do redirects. Not sure if it's correct.
        If the user tries to access this page without submitting a form,
        then it should redirect them to the form.
    */
    header("Location: WhoAmI.php");
    die();
}

// Typical tyrannical programmer, deciding how users should express themselves.
$name = ucwords(strtolower($_POST["name"]));
$age = $_POST['age'];
$address = ucwords(strtolower($_POST["address"]));
$state = $_POST['state'];
$sex = $_POST['sex'];

$currentYear = date('Y');

// Loading data from the provided file.
$postPage = file_get_contents("PostPage.txt");
// Stripping newline characters and replacing them with <br />
$newlines = array("\r", "\n", "\r\n");
$postPage = str_replace($newlines, "<br />", $postPage);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Who You Are</title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        .wrapper {
            /* Just to ensure that my background goes all the way. */
            height; 100%;
            margin: 0;
        }
        .itsaboy {
            background-color: #506888;
            color: #fbfbfb;
        }
    </style>
</head>
<body>
<!-- So this should have the class "itsaboy" if the gender is male. -->
<div class="wrapper <?php echo ($sex == "male") ? "itsaboy":"" ?>">
    <div class='container'>
        <div class="page-header">
            <h1>Who You Are</h1>
        </div>
        <p>
            <?php
            printf("Your name is %s. You're %s years old, and you're %s. You live in the state of %s at %s.",
                $name, $age, $sex, $state, $address);
            ?>
        </p>
        <h4>Years since you were born</h4>
        <ul>
            <?php
            // Every year since you were born. Sorry if you happen to be born late in the year.
            for ($i = 0; $i <= $age; $i++) {
                $year = $currentYear - $i;
                echo "<li>$year</li>";
            }
            ?>
        </ul>
        <p class="text-center">
            <?php
            /*
             * I have some minor gripes that I wish to express:
             * So far, all of the texts that you have provided have really wonky characters in them
             * (probably due to the character encoding you're using) that all show up as question marks.
             *
             * It might just be a Linux thing, but it's weird.
             */
            echo $postPage;
            ?>
        </p>
    </div>
</div>
</body>
</html>