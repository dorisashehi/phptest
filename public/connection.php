<?php

// Database connection. We can find them at docker-compose.yml
$host = 'db';
$db = 'test_db';
$user = 'test_user';
$pass = 'password';

// Create a new mysqli instance
$mysqli = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

?>