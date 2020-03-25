<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$cfg['Console']['Mode'] = 'collapse';
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '123');
//define('DB_NAME', 'ice_cube');
$dbServer = "localhost";
$dbUsername = "root";
$dbpassword = "1234";
$dbName = "icecube";

/* Attempt to connect to MySQL database */
$link = mysqli_connect($dbServer, $dbUsername, $dbpassword, $dbName);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>