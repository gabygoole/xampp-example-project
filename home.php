<html>
	<head>
		<title>Home page</title>
	</head>

	<?php
		session_start();
		if($_SESSION['user']){
		} else {
			header("location: index.php");
		}

		$username = $_SESSION['user'];
	?>

	<body>
		<h2>Home Page</h2>
		<a href="logout.php">Click here to Log out</a><br/><br/>
		<h3>Welcome!</h3>
		<form action="add.php" method="POST">
			Add more to List: <input type="text" name="details"></input><br/>
			Post public? <input type="checkbox" name="public"></input><br/>
			<input type="submit" value="Add a Item"></input>
		</form>
		<table border="1px" width="100%">
			<tr>
				<th>Id</th>
				<th>Details</th>
				<th>Post Time</th>
				<th>Edit Time</th>
				<th>Edit</th>
				<th>Delete</th>
				<th>Public Post</th>
			</tr>

			<?php
				$con = new mysqli("localhost", "root", "", "first_db");
				$result = $con->query("SELECT * FROM list");
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					Print '<tr>';
						Print '<td align="center">'.$row['id'].'</td>';
						Print '<td align="center">'.$row['details'].'</td>';
						Print '<td align="center">'.$row['date_posted'].' - '.$row['time_posted'].'</td>';
						Print '<td align="center">'.$row['date_edited'].' - '.$row['time_edited'].'</td>';
						Print '<td align="center"><a href="edit.php?id='.$row['id'].'">Edit</a></td>';
						Print '<td align="center"><a href="#" onclick="myFunction('.$row['id'].')">Delete</a></td>';
						Print '<td align="center">'.$row['public'].'</td>';
					Print '</tr>';
				}
			?>
		</table>
		<script type="text/javascript">
			function myFunction(id){
				var r = confirm("Are you sure you want to delete this record");
				if(r) {
					window.location.assign("delete.php?id=" + id);
				}
			}
		</script>
	</body>
</html>