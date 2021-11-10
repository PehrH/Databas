<?php
session_start();

	include("connection.php");
	include("function.php");

	$user_data = checkAdminLogin($conn);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Controll Panel</title>
</head>
<body>
	<h1>Detta är Controll Panel</h1>

	<?php  
	if (isset($_SESSION['Aname'])){ 
		echo "Users ";
		echo " Admins ";
		echo " Products ";
	?>
		
		<a href="logout.php">Logga ut</a>
		
	<?php
	 } else {
	 	header("Location: login.php")
	?>
	<a href="login.php">Logga in</a>
	<?php
	 } 
	?>
	


	<!-----
	<a href="login.php">Logga in</a>
	<a href="signup.php">Registera</a>
	<a href="logout.php">Logga ut</a>
     --->
</body>
</html>