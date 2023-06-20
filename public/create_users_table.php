<?php
require 'connection.php';

// SQL statement to create the "users" table
$sql = "
    CREATE TABLE IF NOT EXISTS users (
        userID INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        login VARCHAR(255),
        password VARCHAR(255)
    )
";
//encrypt password.
$pass_hash = password_hash('dorisa', PASSWORD_DEFAULT);

// execute the sql to create the user.
if ($mysqli->query($sql) === true) {
    // insert a fake record first that will be also the administrator of the page;
    $insertSql = "
        INSERT INTO users (first_name, last_name, login, password)
        VALUES ('Dorisa', 'Shehi', 'dorisashehi',  '$pass_hash')
    ";

    // Execute the SQL statement to insert the record
    if ($mysqli->query($insertSql) === true) {
        echo "You created the 'users' table and the first user added.";
    } else {
        echo "Error inserting record: " . $mysqli->error;
    }
} else {
    echo "Error creating 'users' table: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
