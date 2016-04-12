<?php
	session_start();
	if($_SESSSION['user']){
	} else {
		header("location: index.php");
	}
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		$con = new mysqli("localhost", "root", "", "first_db");
		$con->query("DELETE FROM list WHERE id='$id'");
		header("location: home.php");
	}
?>