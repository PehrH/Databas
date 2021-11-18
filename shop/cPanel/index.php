<?php
session_start();

	include("connection.php");
	include("function.php");

	$adminInfo = adminInfo($conn);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Controll Panel</title>
</head>
<body>
	<h1>Detta är Controll Panel</h1>

	<?php  
	if (isset($_SESSION['admin_id'])){ 
		echo "Hej, " . $adminInfo['Aname'] . "";
	?>
	<br><a href="product.php">Produkter</a><br>
	<a href="logout.php">Logga ut</a>
		
	<?php
	 } else {
	 	header("Location: login.php")
	?>
	<a href="login.php">Logga in</a>
	<?php
	 } 
	?>
	
</body>
</html>