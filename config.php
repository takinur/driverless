<?php

//Server http://localhost/00183727-driverless/
define('SERVER', 'http://localhost/00183727-driverless/');

//Root Directory 
define('ROOT', __DIR__ .'/');


// Database Credentials.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'driverless');
 
//Attempt to connect to database 
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
