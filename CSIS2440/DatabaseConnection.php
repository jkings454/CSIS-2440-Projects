<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 2/13/17
 * Time: 1:18 PM
 */
$secrets = json_decode(file_get_contents("secrets.json"));
$host = "localhost";
$dbname = "MonsterThing";
$connection = mysqli_connect(
    $host,
    $secrets["db_username"],
    $secrets["db_pwd"],
    $dbname
) or die('Could not connect to the database server. ' . mysqli_connect_error());
?>