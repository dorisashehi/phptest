<?php

require 'loggedin.php';
require 'connection.php';

$userID =  $_POST['userID'];
$first_name =  $_POST['first_name'];
$last_name =  $_POST['last_name'];
$login =  $_POST['login'];

// execute the sql to update the user.
    $insertSql = "
        UPDATE users SET
            first_name = '$first_name',
            last_name = '$last_name',
            login = '$login'
            WHERE userID = '$userID'
    ";

    // Execute the SQL statement to update the record
    if ($mysqli->query($insertSql) === true) {
        //echo "User '$login' updated to the database.";
        header("Location: manage_users.php");
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

// Close the database connection
$mysqli->close();
?>
