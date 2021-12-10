<?php
session_start();

	include("connection.php");
	include("function.php");
	$adminInfo = adminInfo($conn);
	$idAdmin = $adminInfo ['admin_id'];
	$orderStatusCount = getOrderStatusCount($conn);
	$newMessageCount = getNewMessageCountAdmin($conn);
	$getSiteSetting = getSiteSetting($conn);
	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addAdmin']) ){
			$aName = $_POST['addUserName'];
			$aEmail = $_POST['addEmail'];
			$aPassword = $_POST['addPassword'];
			if (empty($aName) || empty($aEmail) || empty($aPassword)){
			echo "Du måste fylla på alla information ";
		}
		else{
			mysqli_query($conn, "INSERT INTO admins (Aname,admin_email,admin_password) values ('$aName','$aEmail','$aPassword') ");
      		header("location: admins.php");
      		
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
	<?php
	 } else {
	 	header("Location: login.php");
	 } 
	?>
	<h3>Lägga till ny admin</h3>
	<br><br>
	<form method="post">
	<label>Username: </label>
	<input type="text" name="addUserName" value=""><br><br>
	<label>E-post: </label>
	<input type="text" name="addEmail" value=""><br><br>
	<label>Lösenord: </label>
	<input type="password" name="addPassword" value=""><br><br>
	<input type="submit" name="addAdmin" value="Lägga till"><br><br>
	</form>
</body>
</html>