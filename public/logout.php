<?php
session_start(); // Start the session

// If the user is logged in, destroy their session and redirect them to the index page
if(isset($_SESSION['loggin'])) {
    session_destroy(); // Destroy the session data
    header("Location: index.php"); // Redirect the user to the index page
    exit(); // Stop executing the script
}else{
    header("Location: index.php");
}

?>