<?php
// Start session
session_start();

// Retrieve user input
$username = $_POST['username'];
$password = $_POST['password'];

// Validate user input
if ($username == "" || $password == "") {

    // Display error message and redirect back to login page
    $_SESSION['error'] = "Please provide both username and password.";
    header("Location: index.php");
    
} else {
    // Connect to database
    $conn = mysqli_connect("db", "test_user", "password", "test_db");

    // Check if connection successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query database for user with provided credentials
    $sql = "SELECT * FROM users WHERE login='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if query successful and the passwords match
    if (mysqli_num_rows($result) > 0 && password_verify($password,$row['password'])){

        // User authenticated, store user ID in session and redirect to administration page
        $_SESSION['loggin'] = $row['userID'];
        header("Location: admin.php");

    } else {
        // Display error message and redirect back to login page
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: index.php");
    }

    // Close database connection
    mysqli_close($conn);
}
?>