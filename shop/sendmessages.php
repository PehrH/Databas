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

	if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['send'])){
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		if (empty($subject) || empty($message)){
			echo "Du måste fylla på alla information ";
		}
		else {
			mysqli_query($conn, "INSERT into messages (message_user_status,message_admin_status,message_user, 	message_active) values (1,0,'$idUser', 0)");
			$getLastRow = mysqli_query($conn, "SELECT message_id AS last_row FROM messages WHERE message_user = $idUser ORDER BY message_id DESC LIMIT 1");
             $lastRow = mysqli_fetch_assoc($getLastRow);
             $lastOrder = $lastRow['last_row'];
			echo $lastOrder;
			 mysqli_query($conn, "INSERT into msg (mess_id, msg_user, msg_title, msg_text) values ('$lastOrder', '$idUser', '$subject', '$message')");
			 header("location: messages.php");

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $getSiteSetting['site_name'] ?></title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<?php  
	if ($idUser < 1){ 
		header("Location: login.php");
	 } else {
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
	<div id="loginBox">
		<form method="post">
			<div>Kontakta admin</div><br><br>
			<label for="subject">Tittel: </label>
			<input type="text" name="subject"><br><br>
			<label for="message">Meddelandet: </label><br>
			<textarea name="message" style="width: 500px; height: 350px;"></textarea><br>
			<input type="submit" name="send" value="Skicka meddelandet">
		</form>		
	</div>
	<?php
	 } 
	?>
</body>
</html>