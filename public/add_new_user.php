<?php
// Start session
session_start();
require 'connection.php';


$first_name =  $_POST['first_name'];
$last_name =  $_POST['last_name'];
$login =  $_POST['login'];
$password =  password_hash($_POST['password'], PASSWORD_DEFAULT);



// Query database for user with provided credentials
$sql = "SELECT * FROM users WHERE login='$login'";
$result = mysqli_query($mysqli, $sql); 

// Check if query successful
if (mysqli_num_rows($result) > 0) {

    // User authenticated, store user ID in session and redirect to administration page
    $row = mysqli_fetch_assoc($result);
    $_SESSION['created_user_id'] = $row['userID'];
    $_SESSION['created_user_first_name'] = $row['first_name'];
    $_SESSION['creates_user_last_name'] = $row['last_name'];
    $_SESSION['created_user_login'] = $row['login'];
    unset($_SESSION['user_created']);

    // Display error message and redirect back to login page
    $_SESSION['error_user_exists'] = "That user already exists";
    header("Location: new_user_form.php");

} else {

    // execute the sql to create the user.
    $insertSql = "
        INSERT INTO users (first_name, last_name, login, password)
        VALUES ('$first_name', '$last_name', '$login', '$password')
        ";

    // Execute the SQL statement to insert the record
    if ($mysqli->query($insertSql) === true) {

        //echo "User '$login' added to the database.";
        $_SESSION['user_created'] = "User '$login' added to the database.";

        // Clear the user values from session
        $_SESSION['created_user_id'] = "";
        $_SESSION['created_user_first_name'] = "";
        $_SESSION['creates_user_last_name'] = "";
        $_SESSION['created_user_login'] = "";
        unset($_SESSION['error_user_exists']);

        header("Location: new_user_form.php");

    } else {
        echo "Error inserting record: " . $mysqli->error;
    }

}


// Close the database connection
$mysqli->close();
?>
