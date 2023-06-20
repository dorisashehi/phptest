<?php
session_start(); // Start the session

// Check if user authenticated
if (!isset($_SESSION['loggin'])) {
    header("Location: index.php");
}
