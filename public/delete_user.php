<?php
require 'loggedin.php';
require 'connection.php';

$userID =  $_GET['id'];


// execute the sql to delete the user.
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
