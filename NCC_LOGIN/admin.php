<?php
require('dbcon.php');
?>


<!DOCTYPE html>
<html>

<head>

	<title>NCC LOGIN</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>

<body>

<?php
if(isset($_POST['submit']))
{$u=$_POST['uname'];
 $p=$_POST['pass'];
 
 $sql = "select * from logins where username='$u' and passwords='$p'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Username and password are correct
        $row = $result->fetch_assoc();
        $x = $row['passwords'];
        $y = $row['type'];

        session_start();
        $_SESSION['uname'] = $u;

        if ($y == 'admin') {
            header('location: /NCC_MAIN/NCC_ADMIN/p.php');
        } elseif ($y == 'ano1') {
            header('location: /NCC_MAIN/NCC1/p.php');
        } elseif ($y == 'ano2') {
            header('location: /NCC_MAIN/NCC2/p.php');
        } elseif ($y == 'cadet') {
            header('location: /NCC_MAIN/student/student.php');
        }
    } else {
        // Username and password do not match
        echo "<script>alert('Invalid username or password. Please try again.'); window.history.back();</script>";
    }

}



?>
</body>
</html>