<?php
// JSON list of all 50 states & territories to make my life easier.
$states = json_decode(file_get_contents("../../assets/misc/states.json"));
if (isset($_GET["action"])) {
    if (($_GET["action"] == "update") && (!isset($_GET["id"]))) {
        $action = "search";
    }
    else {
        $action = $_GET["action"];
    }
}
else {
    $action = "none";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assignment 2</title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <link rel="stylesheet" type="text/css" href="/assets/stylesheets/build/assignment2.css" />
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
<div class='container'>
    <div class="page-header">
        <h1>Assignment 2: MySQL Form</h1>
    </div>
    <div class = "row">
        <div class="col-sm-3 bottom-margin">
            <div class="list-group">
                <a href="?action=search"
                   class="<?php echo "list-group-item" . ($action == "search" ? " active" : "" )?>">
                    Search
                </a>
                <a href="?action=update"
                   class="<?php echo "list-group-item" . ($action == "update" ? " active" : "" )?>">
                    Update
                </a>
                <a href="?action=new"
                   class="<?php echo "list-group-item" . ($action == "new" ? " active" : "" )?>">
                    Create new
                </a>
                <a href="?action=all"
                   class="<?php echo "list-group-item" . ($action == "all" ? " active" : "" )?>">
                    Show all
                </a>
            </div>
            <a href="/" class="btn btn-default hidden-xs btn-block">Back</a>
        </div>
        <div class="col-sm-9">
            <form action="/CSIS2440/Assignment2/results.php" method="post">
                <?php
                switch ($action) {
                    case "search":
                        include "FormPartials/__search_form.php";
                        break;
                    case "update":
                        include "FormPartials/__update_form.php";
                        break;
                    case "new":
                        include "FormPartials/__new_form.php";
                        break;
                    case "all":
                        include "FormPartials/__all_form.php";
                        break;
                    default:
                        echo "<h3 class='text-muted'>Select an action to continue</h3>";
                        break;
                }
                ?>
            </form>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="/" class="btn btn-default visible-xs btn-block">Back</a>
        </div>
    </div>

</div>
</body>
</html>