<?php
	session_start();
	if($_SESSION['user']) {
	} else {
		header("location: index.php");
	}
	$user = $_SESSION['user'];
	$id_exist = false;//放到下面还真不行
	$con = new mysqli("localhost", "root", "", "first_db");
	#定义在这个部分的相当于是这个页面的全局变量，原因的话应该是在body之前
?>

<body>
	<h2>Home page</h2>
	<p>Welcome <?php Print "$user" ?>!</p>
	<a href="logout.php">Click here to log out</a>
	<a href="home.php">Click here back to homepage</a>
	<h2 align="center">Item selected</h2>

	<table border="1px" width="100%">
		<tr>
			<th>ID</th>
			<th>Details</th>
			<th>Post Time</th>
			<th>Edit Time</th>
			<th>Public Post</th>
		</tr>
		<?php
			if(!empty($_GET['id'])){
			$id = $_GET['id'];
			$_SESSION['id'] = $id;
			$res = $con->query("SELECT * FROM list WHERE id='$id'");
			if($res){
				$id_exist = true;
				$row = $res->fetch_array(MYSQLI_ASSOC);
				Print '<tr>';
					Print '<td align="center">'.$row['id'].'</td>';
					Print '<td align="center">'.$row['details'].'</td>';
					Print '<td align="center">'.$row['date_posted']." - ".$row['time_posted'].'</td>';
					Print '<td align="center">'.$row['date_edited']." - ".$row['time_edited'].'</td>';
					Print '<td align="center">'.$row['public'].'</td>';
				Print '</tr>';
			}
		}
		?>
	</table>
	<br/>
	<?php
	if($id_exist){
		Print '
			<form action="edit.php" method="POST">
				Enter new details <input type="text" name="details"/><br/>
				want to be public? <input type="checkbox" name="public" value="yes"/><br/>
				<input type="submit" value="Edit The Item"/>
			</form>
		';
	}
	else{
		Print '<h2 align="center">There is nothing to edit</h2>';
	}
	?>
</body>
</html>

<?php
	//只是更改数据库
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		
		$details = $con->real_escape_string($_POST['details']);
		$id = $_SESSION['id'];
		$time = strftime("%X");
		$date = strftime("%B %d, %Y");
		$public = "no";
		if(isset($_POST['public'])) 
			{
				$public = "yes";
			}
		$con->query("UPDATE list SET details='$details',time_edited='$time',date_edited='$date',public='$public' WHERE id='$id'");
		header("location: home.php");
	}

?>