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
			$result = mysqli_query($conn, "SELECT * from admins WHERE Aname = '$name' limit 1");
			if($result){
				if ($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);
					if($user_data['admin_password'] === $password){
						$_SESSION['admin_id'] = $user_data['admin_id'];
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
