<?php
session_start();

	include("connection.php");
	include("function.php");
	$adminInfo = adminInfo($conn);
	$orderStatusCount = getOrderStatusCount($conn);
	$newMessageCount = getNewMessageCountAdmin($conn);
	$getSiteSetting = getSiteSetting($conn);
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
	<h1>Detta är Controll Panel</h1>

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
	 	header("Location: login.php")
	?>
	<a href="login.php">Logga in</a>
	<?php
	 } 
	?>
</body>
</html>