<?php
session_start();

	include("connection.php");
	include("function.php");

	$user_data = checkLogin($conn);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Online</title>
</head>
<body>
	<h1>Detta är första sidan</h1>

	<?php  
	if (isset($_SESSION['user_id'])){ 
		echo "Mitt konto";
	?>
		
		<a href="logout.php">Logga ut</a>
		
	<?php
	 } else {
	?>
	<a href="login.php">Logga in</a>
	<a href="signup.php">Registera</a>
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