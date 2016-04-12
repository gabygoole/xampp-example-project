<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back<br/><br/>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>

<?php
  $con = mysqli_connect("localhost","root","","first_db");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);
    $flag = true;
    
    
    $query = $con->query("SELECT * from users");
    while($row = $query->fetch_array(MYSQLI_ASSOC)){
      
      if($username == $row['username']){
        $flag= false;
        Print '<script>alert("username has been token");</script>';
        Print '<script>window.location.assign("register.php");</script>';
      }
    }

    if($flag) {
      $con->query("INSERT INTO users (username,password) VALUES ('$username','$password')");
      Print '<script>alert("successfully regstered");</script>';
      Print '<script>window.location.assign("index.php");</script>';
    }
  }
?>