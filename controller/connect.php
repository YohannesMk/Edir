<?php
$server="localhost";
$user="root";
$password="";
$db_name="edir";


// Create connection
$connection = new mysqli($server, $user, $password, $db_name);
// Check connection
if ($connection->connect_error) {
 die("Connection Failed: " . $connection->connect_error);
}

?>