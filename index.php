<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
		<br />
		<br />
        <a href="login.php">Click here to login</a> 
		<br />
		<a href="register.php">Click here to register</a> 
        <h2 align="center">List</h2>
        <table border="1px" width="100%">
            <tr>
                <th>ID</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
            </tr>
            <?php
                $con = new mysqli("localhost", "root", "", "first_db");
                $query = $con->query("SELECT id,time_edited,date_edited,time_posted,date_posted,details FROM list WHERE public='yes'");
                while($row = $query->fetch_array(MYSQLI_ASSOC)) {
                    Print '<tr>';
                        Print '<td align="center">'.$row['id'].'</td>';
                        Print '<td align="center">'.$row['details'].'</td>';
                        Print '<td align="center">'.$row['date_edited']." - ".$row['time_edited'].'</td>';
                        Print '<td align="center">'.$row['date_posted']." - ".$row['time_posted'].'</td>';
                    Print '</tr>';
                }
            ?>
        </table>
    </body>
</html>