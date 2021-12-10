<?php
	session_start();
	include("cPanel/connection.php");
	include("cPanel/function.php");
	$getSiteSetting = getSiteSetting($conn);
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$forName = $_POST['forName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		if (empty($forName) || empty($lastName) || empty($email) || empty($password)){
			echo "Du måste fylla på alla information ";
		}
		else {
			mysqli_begin_transaction($conn);
			try{
			mysqli_query($conn, "INSERT into users (Fname,Lname,user_password,user_email) values ('$forName','$lastName','$password','$email')");
			echo "Ditt konto är skapat";
			mysqli_commit($conn);
			} catch (mysqli_sql_exception $exception) {
    			mysqli_rollback($conn);
   				 throw $exception;
				}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $getSiteSetting['site_name'] ?> - Registera</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<?php  
	if (isset($_SESSION['user_id'])){ 
		header("Location: index.php");
	 } else {
	?>
  <ul>
  	<li><a href="index.php">Hem</a></li>
  <li><a href="product.php">Produkter</a></li>
  <li><a href="login.php">Logga in</a></li>
  </ul>
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
	<?php
	 } 
	?>
</body>
</html>