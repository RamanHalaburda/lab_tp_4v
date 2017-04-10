<?php

if (isset($_POST['send']))
{
    $conn = mysqli_connect("127.0.0.1:3306", "root","1656") or die("Database tp4v connection failed: " . mysqli_error());
    $db_selected = mysqli_select_db($conn,'tp4v') or die("Database tp4v selection failed: " . mysqli_error());

	$name = $_POST['nam']; 
	$login = $_POST['login']; 
	$pass = $_POST['pass']; 
	$path = "uploads/";
	move_uploaded_file($_FILES['userfile']['tmp_name'], $path.$_FILES['userfile']['name']);
	$avatar = $path.$_FILES['userfile']['name'];
	$pol = $_POST['pol']; 
	$sql = "INSERT INTO user_info(name, login, pass, avatar, pol) VALUES('$name', '$login', '$pass', '$avatar', '$pol')";
	if (mysqli_query($conn, $sql))
	{
		Header("Location: index.php");
	}
	else Header("Location: registr.php");
}

echo "<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
	<title>Регистрация</title>
	<script type=\"text/javascript\">
	function test_edit(f){
		name = document.getElementById(\"nam\").value;
		login = document.getElementById(\"login\").value;
		pass = document.getElementById(\"pass\").value;
		boolean key = true;

		if(name.length<3) key = false;
		if(login.length<3) key = false;
		if(parseInt(pass)>5) key = false;

		if(key == true) f.submit(); else alert(\"Please, input all info!\");
	};
	</script>
</head>
<body>
    <center>
	<h3>Please, fill info for registration</h3>
	<form method=\"post\" enctype=\"multipart/form-data\">
		<input type='text' name='nam' placeholder='Your name'><br>
		<input type='text' name='login' placeholder='Your login'><br>
		<input type='password' name='pass' placeholder='Your password'><br>
		<input type='hidden' name='MAX_FILE_SIZE' value='30000'>
		<input type='file' name='userfile'><br>
		<span>Sex:</span>
		<select name='pol'>
			<option>Male</option>
		 	<option>Famale</option>
		</select><br>
		<input type='submit' name='send'>
	</form>
	</center>
</body>
</html>";
?>