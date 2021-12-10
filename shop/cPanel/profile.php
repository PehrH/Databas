<?php
session_start();

	include("connection.php");
	include("function.php");
	$adminInfo = adminInfo($conn);
	$idAdmin = $adminInfo ['admin_id'];
	$orderStatusCount = getOrderStatusCount($conn);
	$newMessageCount = getNewMessageCountAdmin($conn);
	$getSiteSetting = getSiteSetting($conn);
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		if (isset($_POST['changeUserName'])) {
			$uName = $_POST['userName'];
			mysqli_query($conn, "UPDATE admins SET Aname = '$uName' WHERE admin_id = $idAdmin");
      		header("location: profile.php");
      		
		}
		elseif (isset($_POST['changeEmail'])) {
			$uEmail = $_POST['email'];
			mysqli_query($conn, "UPDATE admins SET admin_email = '$uEmail' WHERE admin_id = $idAdmin");
      		header("location: profile.php");

		}
		elseif (isset($_POST['changePassword'])) {
			$uPassword = $_POST['password'];
			mysqli_query($conn, "UPDATE admins SET admin_password = '$uPassword' WHERE admin_id = $idAdmin");
      		header("location: profile.php");
		}

	}

	
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $getSiteSetting['site_name'] ?> - Kontrollpanalen</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<?php  
	if (isset($_SESSION['admin_id'])){ 
	?>
	<ul>
    <li><a href="index.php">Hem</a></li>
    <li><a href="product.php">Produkter</a></li>
    <li><a href="allorder.php">Order</a></li>
    <li><a href="allusers.php">Användare</a></li>
    <li><a href="admins.php">Admins</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>  
    <h3>Mina sidor</h3>
	<?php
	 } else {
	 	header("Location: login.php");
	 } 
	?>
	<br><br>
	<form method="post">
	<label>Username: </label>
	<input type="text" name="userName" value="<?php echo $adminInfo ['Aname'] ?>">
	<input type="submit" name="changeUserName" value="Ändra"><br><br>
	<label>E-post: </label>
	<input type="text" name="email" value="<?php echo $adminInfo ['admin_email'] ?>">
	<input type="submit" name="changeEmail" value="Ändra"><br><br>
	<label>Lösenord: </label>
	<input type="password" name="password" value="***********">
	<input type="submit" name="changePassword" value="Ändra"><br><br>
	</form>
</body>
</html>