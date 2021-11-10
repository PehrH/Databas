<?php
	session_start();
	
	include("connection.php");
	include("function.php");

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$forName = $_POST['forName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$query = "INSERT into users (fName,lName,password,email) values ('$forName','$lastName','$password','$email')";
			
		mysqli_query($conn, $query);
		
		echo "Ditt konto är skapat";

		
		
	
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Online - Registera</title>
</head>
<body>
	<div id="loginBox">
		<form method="post">
			<div>Registera</div><br>
			<span>Förnamn: </span><input type="text" name="forName"><br><br>
			<span>Efternamn: </span><input type="text" name="lastName"><br><br>
			<span>E-post: </span><input type="text" name="email"><br><br>
			<span>Lösenord: </span><input type="text" name="password"><br><br>
			<input type="submit" value="Registera"><br><br>

			<a href="index.php">Hem</a>
			<a href="login.php">Logga in</a>
			
			
		</form>		

	</div>
</body>
</html>