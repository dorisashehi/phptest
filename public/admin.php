<?php

session_start(); // Start the session

// Check if user authenticated
if (!isset($_SESSION['loggin'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" href="/style/style.css">
</head>
<body>

    <?php require 'menu.html'; ?>
	<h1>Administration Page</h1>
</body>
</html>