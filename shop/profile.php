<?php
session_start();

	include("cPanel/connection.php");
	include("cPanel/function.php");
	$userInfo = userInfo($conn);
	$newMessagesCount = getNewMessageCountAdmin($conn);
	$getCartsCount = getCartsCount($conn);
	$getSiteSetting = getSiteSetting($conn);
  	$idUser = $userInfo ['user_id'];
  	if($idUser < 1) {
      header("location: login.php");
    }
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		if (isset($_POST['changeForName'])) {
			$forName = $_POST['forName'];
			mysqli_query($conn, "UPDATE users SET Fname = '$forName' WHERE user_id = $idUser");
      		header("location: profile.php");
		}
		elseif (isset($_POST['changeLastName'])) {
			$lastName = $_POST['lastName'];
			mysqli_query($conn, "UPDATE users SET Lname = '$lastName' WHERE user_id = $idUser");
      		header("location: profile.php");
		}
		elseif (isset($_POST['email'])) {
			$email = $_POST['changeEmail'];
			mysqli_query($conn, "UPDATE users SET user_email = '$email' WHERE user_id = $idUser");
      		header("location: profile.php");
		}
		elseif (isset($_POST['changePassword'])) {
			$password = $_POST['password'];
			mysqli_query($conn, "UPDATE users SET user_password = '$password' WHERE user_id = $idUser");
      		header("location: profile.php");
		}

	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $getSiteSetting['site_name'] ?> - Mina sidor</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Mina sidor</h1>

	<?php  
	if (isset($_SESSION['admin_id'])){ 
	?>
	<ul>
  <li><a href="index.php">Hem</a></li>
  <li><a href="product.php">Produkter</a></li>
  <li><a href="history.php">Historik</a></li>
  <li><a href="messages.php">Meddelandet: <?php  echo $newMessagesCount?></a></li>
   <li style="float: right;"><a href="logout.php">Logga ut</a></li>
  <li style="float: right; background-color: #04AA6D"><a href="cart.php">Varukorgen: <?php  echo $getCartsCount?></a></li>
  <li style="float: right; background-color: #04AA6D"><a href=""><?php  echo $userInfo['Fname']?></a></li>
  </ul>
  </ul>
	<?php
	 } else {
	 	header("Location: login.php");
	 } 
	?>
	<br><br>
	<form method="post">
	<label>Förnamn: </label>
	<input type="text" name="forName" value="<?php echo $userInfo ['Fname'] ?>">
	<input type="submit" name="changeForName" value="Ändra"><br><br>
	<label>Efternamn: </label>
	<input type="text" name="lastName" value="<?php echo $userInfo ['Lname'] ?>">
	<input type="submit" name="changeLastName" value="Ändra"><br><br>
	<label>E-post: </label>
	<input type="text" name="email" value="<?php echo $userInfo ['user_email'] ?>">
	<input type="submit" name="changeEmail" value="Ändra"><br><br>
	<label>Lösenord: </label>
	<input type="password" name="password" value="***********">
	<input type="submit" name="changePassword" value="Ändra"><br><br>
	</form>
</body>
</html>