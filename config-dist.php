<?php

//Server http://localhost/00183727-driverless/
define('SERVER', 'server_add');

//Root Directory 
define('ROOT', __DIR__ .'/');


// Database Credentials.
define('DB_SERVER', 'db_host');
define('DB_USERNAME', 'db_username');
define('DB_PASSWORD', 'db_password');
define('DB_NAME', 'db_name');
 
//Attempt to connect to database 
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
