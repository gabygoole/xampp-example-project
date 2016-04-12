<?php
	session_start();
	$con = new mysqli("localhost", "root", "", "first_db");
	$username = $con->real_escape_string($_POST['username']);
	$password = $con->real_escape_string($_POST['password']);
	$resultRecord = $con->query("Select * FROM users WHERE username='$username'");

	if($resultRecord){
		$row = $resultRecord->fetch_array(MYSQLI_ASSOC);
		if($password == $row['password']) {
			$_SESSION['user'] = $username;
			header("location: home.php"); 
		} else{
			Print '<script>alert("Check your password");</script>';	
		}	
	}else{
		Print '<script>alert("check your Account");</script>';
		Print '<script>window.location.assign("login.php");</script>';
	}
?>	