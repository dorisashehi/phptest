<?php

// Start session
session_start();

// Check if user authenticated
if (!isset($_SESSION['loggin'])) {
    header("Location: index.php");
}


// Function to export all users and save them as a CSV file
function export_users() {

    // Connect to database
    $conn = mysqli_connect("db", "test_user", "password", "test_db");

    // Check if connection successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query the database for all users
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);

    // Convert user data into a CSV string
    $csv = "ID,FIRST NAME,LAST NAME,LOGIN\n"; // Header row
    while ($row = mysqli_fetch_assoc($result)) {
        $csv .= "{$row['userID']},{$row['first_name']},{$row['last_name']},{$row['login']}\n";
    }

    // Save the CSV string to a file with the current date/time in the filename
    $filename = "users_" . date("Y_m_d_H_i_s") . ".csv";
    $filepath = "./files/$filename";
    file_put_contents($filepath, $csv);
}

// Function to display the list of saved files on the download page
function display_files() {
    // Query the directory where the CSV files are saved
    $dir = "./files/";
    $files = scandir($dir);

    // Display the list of files with their details
    echo "<table>";
    echo "<tr><th>Filename</th><th>Date/Time</th><th>File Size</th></tr>";
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $filepath = $dir . $file;
            $filesize = filesize($filepath) / 1024; // Size in kilobytes
            $filedate = date("Y-m-d H:i:s", filemtime($filepath)); // Last modified date/time
            echo "<tr>";
            echo "<td><a href=\"/download_files/files/$file\">$file</a></td>";
            echo "<td>$filedate</td>";
            echo "<td>$filesize kB</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

// If the user clicked the export link, export the users and redirect back to the download page
if (isset($_GET['export'])) {
    export_users();
    header("Location: /download_files/download.php");
}

// Display the download page with the list of saved files
?>
<!DOCTYPE html>
<html>
<head>
    <title>Download Page</title>
    <style>
    table{
        border-collapse: collapse;
        text-align: center;
        margin: auto;

    }
    td, th {
        border: 1px solid black;
        border-spacing: 0px;
        padding: 10px;
    }
    .btn {
        background-color: #4CAF50; /* Green background color */
        border: none; /* Remove borders */
        color: white; /* White text color */
        padding: 10px 20px; /* Add some padding */
        text-align: center; /* Center text */
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Display as inline-block */
        font-size: 16px; /* Set font size */
        margin: 5px; /* Add margin */
        cursor: pointer; /* Change cursor to pointer */
    }
    </style>
    <link rel="stylesheet" href="/style/style.css">

</head>
<body>
    <nav>
        <ul>
            <li><a href="../manage_users.php">Manage Users</a></li>
            <li><a href="../new_user_form.php">Add New User</a></li>
            <li><a href="/download_files/download.php">Downloads</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
    <p style="text-align:center; margin-bottom:30px"><a href="/download_files/download.php?export=true" class="btn">Export Users</a></p>
    <?php display_files(); ?>
</body>
</html>