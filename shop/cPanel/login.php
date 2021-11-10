<?php
	session_start();
	
	include("connection.php");
	include("function.php");
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
	
		$name = $_POST['name'];
		$password = $_POST['password'];
		if (empty($name) || empty($password)) {
			echo "Du måste ange rätt namn och lösenord";
		}
		else {
		
			$query = "SELECT * from admin WHERE Aname = '$name' limit 1";
				
			$result = mysqli_query($conn, $query);
			if($result){
				if ($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);
					if($user_data['Apassword'] === $password){

						$_SESSION['Aname'] = $user_data['Aname'];
						header("Location: index.php");
					}
			    }
			}
		}
		
		
		
		
	
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Controll Panel - Logga in</title>
</head>
<body>
	<div id="loginBox">
		<form method="post">
			<h1>Controll Panel</h1>
			<div>Logga in</div><br>
			<label for="name">Namn: </label>
			<input type="text" name="name"><br><br>
			<label for="password">Lösenord: </label>
			<input type="password" name="password" minlength="5"><br><br>
			
			<input type="submit" value="Logga in"><br><br>
			
			
			

		</form>		

	</div>
</body>
</html>
