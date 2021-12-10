<?php
session_start();
	include("connection.php");
	include("function.php");
	$adminInfo = adminInfo($conn);
	$idAdmin = $adminInfo ['admin_id'];
	$orderStatusCount = getOrderStatusCount($conn);
	$newMessageCount = getNewMessageCountAdmin($conn);
	$getSiteSetting = getSiteSetting($conn);
	$sorting = 0;
	$result = mysqli_query($conn,"SELECT * FROM settings");
	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save']) ){
		$sitename = $_POST['siteName'];
		$sitedesc = $_POST['siteDesc'];
		$sitemeta = $_POST['siteMeta'];
		$prodnr = $_POST['prodNR'];
		if ($result->num_rows > 0) {
			mysqli_query($conn, "UPDATE settings SET site_name = '$sitename', site_desc = '$sitedesc', site_meta = '$sitemeta', prod_nr = '$prodnr'");
			header("location: setting.php");
		}
		else {
		
			mysqli_query($conn, "INSERT INTO settings (site_name,site_desc,site_meta,prod_nr) values ('$sitename','$sitedesc','$sitemeta', '$prodnr')");
      		header("location: setting.php");
      		
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
	<h3>Hemsidans inställningar</h3>
	<br><br>
	<form method="POST">
    <label for="siteName">Titel:</label>
    <input type="text" name="siteName" value="<?php echo $getSiteSetting['site_name'] ?>"><br><br>
    <label for="siteDesc">Beskrivning:</label>
    <input type="text" name="siteDesc" value="<?php echo $getSiteSetting['site_desc'] ?>"><br><br>
    <label for="siteMeta">META:</label>
    <input type="text" name="siteMeta" value="<?php echo $getSiteSetting['site_meta'] ?>"><br><br>
    <label for="prodNR">Ange antal produkter som ska visas på första sida:</label>
    <input type="number" name="prodNR" value="<?php echo $getSiteSetting['prod_nr'] ?>"><br><br>
    <input type="submit" name="save" value="Spara">
    </form>
</body>
</html>