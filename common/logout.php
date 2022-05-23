<?php

// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 

if(isset($_GET['redirect'])) { //Redirect to Reffered Page
   header('Location: '.($_GET['redirect'])); 
   exit; 
   } else {
    header('Location: ../index.php');  
    exit;
   }
?>