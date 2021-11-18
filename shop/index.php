<?php
session_start();

	include("cPanel/connection.php");
	include("cPanel/function.php");
	$userInfo = userInfo($conn);
	
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
		echo "Hej, " . $userInfo['Fname'] . "";
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
	
</body>
</html>