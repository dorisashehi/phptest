<?php

//check if user is logged in 
require 'loggedin.php';

//connect to database
require 'connection.php';

//get the user id that we want to delete from the url of the page 
$userID =  $_GET['id'];

// create the sql to delete the user.
    $insertSql = "
        DELETE FROM users WHERE userID = '$userID'
    ";

    // Execute the SQL statement to delete the record
    if ($mysqli->query($insertSql) === true) {
        echo "User deleted from database.";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }

// Close the database connection
$mysqli->close();
?>
