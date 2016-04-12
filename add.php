<?php
	/*意思很明显，只是为了防止未登录的人进来这个页面*/
	session_start();
	if($_SESSION['user']){
	} else {
		header("location: index.php");
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$con = new mysqli("localhost", "root", "", "first_db");
		$time = strftime("%X");
		$date = strftime("%B %d, %Y");
		$details = $con->real_escape_string($_POST['details']);

		if(isset($_POST['public'])) {
			$desition = "yes";
		} else {
			$desition = "no";
		}

		$con->query("INSERT INTO list(details, date_posted, time_posted, public) VALUES ('$details','$date','$time', '$desition')");
		header("location: home.php");
	}


?>