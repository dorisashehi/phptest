<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="/style/style.css">
</head>
<body>
    <h1>Login</h2>
	<form method="post" action="login.php" onsubmit="return validateForm()">
		<label for="username">Login Name:</label>
		<input type="text" id="username" name="username"><br><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password"><br><br>
		<input type="submit" value="Login">
	</form>
    <p><i>Administrator Credentials(First login)</i></p>
    <p><i>Login Name:dorisashehi<i></p>
    <p><i>Password:dorisa<i></p>
	
</body>
</html>