<?php
session_start();

if (isset($_POST['send']))
{
	$mail = $_POST['message']; 
	$author = $_SESSION['user_login'];

	$conn = mysqli_connect("127.0.0.1:3306", "root","1656") or die("Database tp4v connection failed: " . mysqli_error());
    $db_selected = mysqli_select_db($conn,'tp4v') or die("Database tp4v selection failed: " . mysqli_error());

	$sql = "INSERT INTO mail(author, message) VALUES('$author', '$mail')";
	mysqli_query($conn, $sql) or Header("Location: forum.php");
}

if($_SESSION['active'] == true)
{
	echo "<!DOCTYPE html> 
	<html> 
	<head><meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"><title>Форум</title></head> 
	<body> 
	<center>
	<h3>Welcome to chat, ";

	echo $_SESSION['user_login'];
	echo "!</h3> 
	<p>Field for your message</p>
	<form method=\"post\">
	<textarea placeholder=\"Your message...\" name=\"message\"></textarea><br>
	<input type=\"submit\" name=\"send\" onclick=\"window.location.reload()\">
	</form>
	<br>
	<h4>Messages</h4>";

    $conn = mysqli_connect("127.0.0.1:3306", "root","1656") or die("Database tp4v connection failed: " . mysqli_error());
    $db_selected = mysqli_select_db($conn,'tp4v') or die("Database tp4v selection failed: " . mysqli_error());

    $sql = "select * from  mail;" or die("die".mysqli_error());
    $rs = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($rs))
    {
        echo $row['author'] . " >> " . $row['message'];
        echo "<br>__________________________<br>";
    }

	echo "</center></body></html>";
}
else Header("Location: index.php");
?>