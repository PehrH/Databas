<?php
session_start();

	include("cPanel/connection.php");
	include("cPanel/function.php");
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
	
		$email = $_POST['email'];
		if (empty($email)) {
			echo "Du måste ange rätt epost";
		}
		else {
		
			$query = "SELECT * from users WHERE email = '$email' limit 1";
				
			$result = mysqli_query($conn, $query);
			if($result){
				if ($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);
					if($user_data['email'] === $email){

						
					}
			    }
			}
		}

	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Online - Forget password</title>
</head>
<body>
	<h1>Forget password</h1>

	<?php  
	if (isset($_SESSION['user_id'])){ 
		header("Location: index.php")

	 } else {
	?>
	<label for="email">E-post:</label>
	<input type="email" name="email"><br><br>

	<input type="submit" value="Skicka"><br><br>
	<?php
	 } 
	?>
	
</body>
</html>