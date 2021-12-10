<?php
	session_start();
	
	include("cPanel/connection.php");
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$email = $_POST['email'];
		if (empty($email)) {
			//echo "Du måste ange en email";
			header("Location: forgetpass.php?error=emptyfields");
			
		} 
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			//echo "Ange en giltig email";
			header("Location: forgetpass.php?error=invalidemail");
			
		} 
		else {
			$email = $_POST['email'];
			$query = "SELECT * from users WHERE user_email = '$email'";

			$result = mysqli_query($conn, $query);

			//mysqli_fetch_assoc return boolean
			$getpassword = mysqli_fetch_assoc($result);
			if($getpassword){
				$lösen = $getpassword['user_password'];
				//echo $lösen;
				echo "Lösenorder har sänds till email";
				$to = $getpassword['user_email'];
				$subject = "Nytt lösenord";
				$txt = "Här kommer ditt nya lösenord" .$lösen;
				$headers = "From: webmaster@example.com" . "\r\n" .
				"CC: somebodyelse@example.com";
				mail($to,$subject,$txt,$headers);

			}
			else {
				echo ("Emailen finns inte registrerad");
			}
		}
	} 


?>

<!DOCTYPE html>
<html>
<head>
	<title>Shop Online - Glömt lösenord</title>
</head>
<body>
		<h2> Återställ via din E-mail</h2>

		<form method="post">

			<label for="email">Email:</label><br>
			<input type="text" name="email" placeholder="Vilken Email.."><br>
		
			<input type="submit" value="Skicka">

			
			

		</form>		

	</div>
</body>
</html>
