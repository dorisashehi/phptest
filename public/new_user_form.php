<?php
require 'loggedin.php';

if(isset($_SESSION['error_user_exists'])) {
	//user already exists 
	$firstName = $_SESSION['created_user_first_name'];
	$lastName = $_SESSION['creates_user_last_name'];
	$loginName = $_SESSION['created_user_login'];
}else{
	//user doesnt exists
	$firstName = "";
	$lastName = "";
	$loginName = "";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New User</title>
	<link rel="stylesheet" href="/style/style.css">
	<script>
		function validateForm() {
			//prevent submit first
			event.preventDefault(); 
			//make validation
			var firstName = document.forms["newUserForm"]["first_name"].value;
			var lastName = document.forms["newUserForm"]["last_name"].value;
			var loginname = document.forms["newUserForm"]["login"].value;
			var password = document.forms["newUserForm"]["password"].value;

			if (firstName == "" || lastName == "" || loginname == "" || password == "") {
				//show error
				alert("Please fill in all fields.");
			}else{
				// Submit the form
				document.forms["newUserForm"].submit();
			}
		}

	</script>
</head>
<body>

    <?php require 'menu.html'; ?>
	<h1>Add New User</h1>

	<form  method="POST" name="newUserForm" id="newUserForm" action="add_new_user.php" onsubmit="return validateForm()" method="post">
		<label>First Name:</label>
		<input type="text" name="first_name" value="<?php echo $firstName ?>" ><br>

		<label>Last Name:</label>
		<input type="text" name="last_name" value="<?php echo $lastName ?>" ><br>

		<label>Login name:</label>
		<input type="text" name="login" value="<?php echo $loginName ?>" ><br>

		<label>Password:</label>
		<input type="password" name="password" ><br>

		<input type="submit" value="Submit">
	</form>
	<?php
		if(isset($_SESSION['error_user_exists'])){
			echo "<p class='error_message' style='color:red;'><b>Error: " . $_SESSION["error_user_exists"] . "</b></p>"; 
		}

		if(isset($_SESSION['user_created'])){
			echo "<p class='success_message' style='color:green;'><b>Success: " . $_SESSION["user_created"] . "</b></p>"; 
		}

		// Clear the error and form values from session
		unset($_SESSION['error_user_exists']);
		unset($_SESSION['user_created']);
	?>

</body>
</html>