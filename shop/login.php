<?php
	session_start();
	
	include("cPanel/connection.php");
	include("cPanel/function.php");
	$userInfo = userInfo($conn);
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
	
		$email = $_POST['email'];
		$password = $_POST['password'];
		if (empty($email) || empty($password)) {
			echo "Du måste ange rätt epost och lösenord";
		}
		else {
		
			$query = "SELECT * from users WHERE user_email = '$email' limit 1";
				
			$result = mysqli_query($conn, $query);
			if($result){
				if ($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);
					if($user_data['user_password'] === $password){

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
					}
					else{
						echo "Fel E-post eller lösenord !";
					}
			    }
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
			<label for="email">E-post: </label>
			<input type="email" name="email"><br><br>
			<label for="password">Lösenord: </label>
			<input type="password" name="password" minlength="6"><br><br>
			
			<input type="submit" value="Logga in"><br><br>
			<div>Har du ingen konto ? </div><a href="signup.php">Registera här</a>
			
			

		</form>		

	</div>
</body>
</html>
