<?php
	session_start();
	
	include("connection.php");
	include("function.php");
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
	
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$query = "SELECT * from users WHERE email = '$email' limit 1";
			
		$result = mysqli_query($conn, $query);
		if($result){
			if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
				if($user_data['password'] === $password){

					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: index.php");
				}
				echo "Ditt mail eller Lösenord är fel";
		    }
		}
		
		
		
		
	
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Online - Logga in</title>
</head>
<body>
	<div id="loginBox">
		<form method="post">
			<div>Logga in</div><br>
			<span>E-post: </span><input type="text" name="email"><br><br>
			<span>Lösenord: </span><input type="text" name="password"><br><br>
			<input type="submit" value="Logga in"><br><br>
			<div>Har du ingen konto ? </div><a href="signup.php">Registera här</a>
			
			

		</form>		

	</div>
</body>
</html>