<?php
require 'loggedin.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Users</title>
	<link rel="stylesheet" href="/style/users.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/table.css">
</head>
<body>
    <?php require 'menu.html'; ?>
	<h1>Manage Users</h1>
	<table class="general-table">
		<thead>
			<tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Login</th>
                <th>Action</th>
			</tr>
		</thead>
		<tbody>
            <?php 
            
                // Connect to database
                $conn = mysqli_connect("db", "test_user", "password", "test_db");

                // Check if connection successful
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Determine current page number for pagination
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $usersPerPage = 5;
                $startIndex = ($page - 1) * $usersPerPage;
                

                // Query database for all users and do not show the administrator user
                $sql = "SELECT * FROM users WHERE login != 'dorisashehi' ORDER BY userID DESC LIMIT $startIndex, $usersPerPage";
                $result = mysqli_query($conn, $sql);

                // Count total number of users for pagination
                $result1 = $conn->query("SELECT COUNT(*) as count FROM users");
                $row = $result1->fetch_assoc();
                $total_users = $row['count'];
                $num_pages = ceil($total_users / $usersPerPage);
                $prev_page = ($page - 1) ? $page - 1 : false;
                $next_page = ($page + 1 <= $num_pages) ? $page + 1 : false;

            
            ?>
			<?php while ($row = mysqli_fetch_assoc($result)){ ?>
			<tr>
                <td><?php echo $row['userID']; ?></td>
				<td><?php echo $row['first_name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['login']; ?></td>
				<td><a href="edit_user_form.php?id=<?php echo $row['userID']; ?>">Edit</a> | <a href="delete_user.php?id=<?php echo $row['userID']; ?>" onclick="return confirm('Are you sure that you want to delete that user?')">Delete</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
    <div style="width:100%;  text-align:center;">
        <div class="pagination">
            <?php if($prev_page): ?>
                <a href="?page=<?php echo $prev_page; ?>">Prev</a>
            <?php endif; ?>
            <?php for($i = 1; $i <= $num_pages; $i++): ?>
                <?php if($i == $page): ?>
                    <span><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if($next_page): ?>
                <a href="?page=<?php echo $next_page; ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>