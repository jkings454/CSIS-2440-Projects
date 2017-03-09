<?php
if (!isset($_POST["action"])) {
    // This will redirect the user back to the form page
    // If there's no action set.
    // Action should be set by default.
    header("Location: /CSIS2440/Assignment2/");
}

require_once "../DatabaseConnection.php";
$error_messages = "";

// I've separated these by function to try and make it a little bit more readable. It didn't work out very well.
function submit_post($person, $connection)
{
    // Sanitize inputs...
    foreach ($person as $attr => $value) {
        $person[$attr] = sanitizeSQL($connection, $value);
    }

    // using sprintf to insert values.
    // Also: sorry about the big, ugly SQL Statement. Can't be avoided.
    $sql = sprintf("INSERT INTO FamilyDB.Contacts (ContactsFirstName, ContactsLastName, ContactsPhoneNum, 
                              ContactsAddress, ContactsCity, ContactsState, ContactsZip, ContactsBirthday, 
                              ContactsUsername, ContactsPassword, ContactsSex, ContactsRelationship) 
                    VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
                            $person["firstname"], $person["lastname"], $person["phone"], $person["address"],
                            $person["city"], $person["state"], $person["zip"], $person["birthday"], $person["username"],
                            $person["password"], $person["sex"], $person["relationship"]);

    // Query...
    $result = $connection->query($sql);
    // And return.
    return $result;
}

function update_post($person, $connection)
{
    // Function to update a post.
    // Similar to the last function, but uses UPDATE instead of INSERT
    foreach ($person as $attr => $value) {
        $person[$attr] = sanitizeSQL($connection, $value);
    }

    // Once again, horrible formatting.
    $sql = sprintf("UPDATE FamilyDB.Contacts SET ContactsFirstName = '%s', 
                                                 ContactsLastName = '%s',
                                                 ContactsPhoneNum = '%s',
                                                 ContactsAddress = '%s',
                                                 ContactsCity = '%s',
                                                 ContactsState = '%s',
                                                 ContactsZip = '%s',
                                                 ContactsBirthday = '%s',
                                                 ContactsUsername = '%s',
                                                 ContactsPassword = '%s',
                                                 ContactsSex = '%s',
                                                 ContactsRelationship = '%s'
                                             WHERE idContacts = '%s'",
        $person["firstname"], $person["lastname"], $person["phone"], $person["address"], $person["city"], $person["state"],
        $person["zip"], $person["birthday"], $person["username"], $person["password"], $person["sex"], $person["relationship"],
        $person["id"]);


    // Done.
    $result = $connection->query($sql);
    return $result;
}

function get_all($connection)
{
    // This just gets all contacts.
    $sql = "SELECT * FROM FamilyDB.Contacts;";

    $result = $connection->query($sql);

    return $result;
}

function search_post($keywords, $connection) {
    $keywords = sanitizeSQL($connection, $keywords);

    // Case insensitive query selects everything like the keywords.
    // way too many things to type here omg.
    $result = array();
    // This function uses keywords instead of actual values, so we have to perform multiple queries.
    foreach(explode(" ", $keywords) as $keyword) {
        $sql = "SELECT * FROM FamilyDB.Contacts WHERE upper(Contacts.ContactsFirstName) LIKE upper('%$keyword%') OR 
                                                      upper(Contacts.ContactsLastName) LIKE upper('%$$keyword%') OR 
                                                      upper(Contacts.ContactsZip) LIKE upper('%$keyword%') OR 
                                                      upper(Contacts.ContactsAddress) LIKE upper('%$keyword%') OR
                                                      upper(Contacts.ContactsBirthday) LIKE upper('%$keyword%') OR 
                                                      upper(Contacts.ContactsCity) LIKE upper('%$keyword%') OR 
                                                      upper(Contacts.ContactsPassword) LIKE upper('%$keyword%') OR 
                                                      Contacts.ContactsBirthday LIKE  '%$keyword%' OR 
                                                      Contacts.ContactsPhoneNum LIKE '%$keyword%' OR 
                                                      upper(Contacts.ContactsRelationship) LIKE upper('%$keyword%') OR 
                                                      upper(Contacts.ContactsUsername) LIKE upper('%$keyword%') OR 
                                                      upper(Contacts.ContactsState) LIKE upper('%$keyword%');";
        // Finally, push this to our results array.
        array_push($result, $connection->query($sql));
    }
    return $result;
}
$result = null;
switch ($_POST["action"]) {
    // Pretty self explanatory.
    case "new":
        $result = submit_post($_POST, $connection);
        break;
    case "all":
        $result = get_all($connection);
        break;
    case "update":
        $result = update_post($_POST, $connection);
        break;
    case "search":
        $result = search_post($_POST["keywords"], $connection);
        break;
    default:
        $error_messages .= "ERROR: Invalid action.<br/>";
        break;
}

if ($connection->connect_errno) {
    $error_messages .= "MYSQL ERROR: " . $connection->connect_error . "<br />";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel='stylesheet' type='text/css'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'/>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
<div class='container'>
    <div class="page-header">
        <h1>Results</h1>
    </div>
    <?php
    // Let's inform the user that something is messed up.
    if ($error_messages) {
        echo "<p>$error_messages</p>";
        die();
    }
    else { ?>
        <div class = "table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <!-- Look at this beautiful table. -->
                    <th>Action</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Birthday</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Sex</th>
                    <th>Relationship</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($_POST["action"] == "all") {
                    // We only have one query to worry about, so let's do this!
                    while ($row = $result->fetch_assoc()) {
                        // BEHOLD: The wall of printf
                        // I probably should have made this a function or something.
                        printf("<tr>");
                        printf("<td><a href='/CSIS2440/Assignment2?action=update&id=%s'>Update</a></td>", $row["idContacts"]);
                        printf("<td>%s</td>", $row["ContactsFirstName"]);
                        printf("<td>%s</td>", $row["ContactsLastName"]);
                        printf("<td>%s</td>", $row["ContactsPhoneNum"]);
                        printf("<td>%s</td>", $row["ContactsAddress"]);
                        printf("<td>%s</td>", $row["ContactsCity"]);
                        printf("<td>%s</td>", $row["ContactsState"]);
                        printf("<td>%s</td>", $row["ContactsZip"]);
                        printf("<td>%s</td>", $row["ContactsBirthday"]);
                        printf("<td>%s</td>", $row["ContactsUsername"]);
                        printf("<td>%s</td>", $row["ContactsPassword"]);
                        printf("<td>%s</td>", $row["ContactsSex"]);
                        printf("<td>%s</td>", $row["ContactsRelationship"]);
                        printf("</tr>");
                    }
                } elseif ($_POST["action"] == "search") {
                    // $result is an array of $results
                    // So we need to iterate.
                    foreach($result as $query) {
                        while ($row = $query->fetch_assoc()) {
                            // BEHOLD: The wall of printf
                            printf("<tr>");
                            // This link allows users to update a specific value.
                            printf("<td><a href='/CSIS2440/Assignment2?action=update&id=%s'>Update</a></td>", $row["idContacts"]);
                            printf("<td>%s</td>", $row["ContactsFirstName"]);
                            printf("<td>%s</td>", $row["ContactsLastName"]);
                            printf("<td>%s</td>", $row["ContactsPhoneNum"]);
                            printf("<td>%s</td>", $row["ContactsAddress"]);
                            printf("<td>%s</td>", $row["ContactsCity"]);
                            printf("<td>%s</td>", $row["ContactsState"]);
                            printf("<td>%s</td>", $row["ContactsZip"]);
                            printf("<td>%s</td>", $row["ContactsBirthday"]);
                            printf("<td>%s</td>", $row["ContactsUsername"]);
                            printf("<td>%s</td>", $row["ContactsPassword"]);
                            printf("<td>%s</td>", $row["ContactsSex"]);
                            printf("<td>%s</td>", $row["ContactsRelationship"]);
                            printf("</tr>");
                        }
                    }
                }
                else {
                    // The action is either "new" or "update", so let's just get our info from $_POST
                    printf("<td>None</td>");
                    printf("<td>%s</td>", $_POST["firstname"]);
                    printf("<td>%s</td>", $_POST["lastname"]);
                    printf("<td>%s</td>", $_POST["phone"]);
                    printf("<td>%s</td>", $_POST["address"]);
                    printf("<td>%s</td>", $_POST["city"]);
                    printf("<td>%s</td>", $_POST["state"]);
                    printf("<td>%s</td>", $_POST["zip"]);
                    printf("<td>%s</td>", $_POST["birthday"]);
                    printf("<td>%s</td>", $_POST["username"]);
                    printf("<td>%s</td>", $_POST["password"]);
                    printf("<td>%s</td>", $_POST["sex"]);
                    printf("<td>%s</td>", $_POST["relationship"]);
                }
                ?>
                </tbody>
    <?php } ?>
            </table>
            <!-- Always nice to have a back button. -->
            <a href="/CSIS2440/Assignment2" class="btn btn-default">Go Back</a>
        </div>
</div>
</body>
</html>

