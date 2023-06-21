<?php
//check if user is logged in 
require 'loggedin.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
    <link rel="stylesheet" href="/style/style.css">
</head>
<body>
    <?php require 'menu.html'; //put menu ?>

    <?php  
        //get from the url the user that you want to edit.
        $user_id = $_GET['id'];

        // Connect to database
        $conn = mysqli_connect("db", "test_user", "password", "test_db");

        // Check if connection successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query database for user with the specified id
        $sql = "SELECT * FROM users WHERE userID='$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
	<h1>Edit User</h1>

	<form name="editUserForm" action="edit_user.php" method="post">

        <input type="hidden" name="userID" value="<?php echo $row['userID'] ?>"><br>

		<label>First Name:</label>
        
		<input type="text" name="first_name" required value="<?php echo $row['first_name'] ?>"><br>

		<label>Last Name:</label>
		<input type="text" name="last_name" required value="<?php echo $row['last_name'] ?>"><br>

		<label>Login name:</label>
		<input type="text" name="login" required value="<?php echo $row['login'] ?>"><br>

		<input type="submit" value="Submit">
	</form>
</body>
</html>