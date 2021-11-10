<?php
	session_start();
	
	include("cPanel/connection.php");
	include("cPanel/function.php");
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$forName = $_POST['forName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if (empty($forName) || empty($lastName) || empty($email) || empty($password)) {
			echo "Du måste fylla på alla information ";
		}
		//elseif (!preg_match("/^[a-zA-Z-' ]*$/",$email)) {
			//echo "Du måste ange rätt epost";
		//}
		else {
		$query = "INSERT into users (fName,lName,password,email) values ('$forName','$lastName','$password','$email')";
			
		mysqli_query($conn, $query);
		
		echo "Ditt konto är skapat";

		}
		
	
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
			<div>Registera</div><br><br>
			<label for="forName">Förnamn: </label>
			<input type="text" name="forName"><br><br>
			<label for="lastName">Efternamn: </label>
			<input type="text" name="lastName"><br><br>
			<label for="email">E-post:</label>
			<input type="email" name="email"><br><br>
			<label for="password">Lösenord: </label>
			<input type="password" name="password"><br><br>

			<input type="submit" value="Registera"><br><br>

			<a href="index.php">Hem</a>
			<a href="login.php">Logga in</a>
			
			
		</form>		

	</div>
</body>
</html>