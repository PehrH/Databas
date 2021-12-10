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
  $msgId = $_GET['msgId'];
  $user = "användare";
  $msgInfo = mysqli_query($conn,"SELECT * FROM msg  WHERE mess_id = $msgId AND msg_user = $idUser OR msg_user = 0");
  $messageStatus = mysqli_query($conn,"SELECT * FROM messages WHERE message_id = $msgId");
  $getMessageStatus = mysqli_fetch_assoc($messageStatus);
   if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['send'])){
    $message = $_POST['message'];
    mysqli_query($conn, "INSERT into msg (mess_id, msg_user, msg_title, msg_text) values ('$msgId', '$idUser', '$user', '$message')");
    mysqli_query($conn, "UPDATE messages SET message_user_status = 1, message_admin_status = 0  WHERE message_id = $msgID");
    header("location: readmessage.php?msgId=$msgId");
   }

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $getSiteSetting['site_name'] ?> - Meddelande</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Meddelanden # <?php echo $msgId ?></h1>
	<?php  
	if (!isset($_SESSION['user_id'])){ 
		header("Location: login.php");
	} 
  ?>
  <ul>
  <li><a href="index.php">Hem</a></li>
  <li><a href="product.php">Produkter</a></li>
  <li><a href="history.php">Historik</a></li>
  <li><a href="sendmessages.php">Kontakta admin</a></li>
  <li><a href="messages.php">Meddelandet: <?php  echo $newMessagesCount?></a></li>
   <li style="float: right;"><a href="logout.php">Logga ut</a></li>
  <li style="float: right; background-color: #04AA6D"><a href="cart.php">Varukorgen: <?php  echo $getCartsCount?></a></li>
  <li style="float: right; background-color: #04AA6D"><a href=""><?php  echo $userInfo['Fname']?></a></li>
  </ul>
  </ul>
  <form method="post">
  <?php
  if ($msgInfo->num_rows > 0) {
      while($row = $msgInfo->fetch_assoc()) {
        
        if ($row["msg_user"] == 0) {
          echo "<label>Meddelandet av admin:</label><br><br>";
          echo '<p>' . $row["msg_text"] . ' </p><br><br>';
        }
        else{
           echo "<label>Meddelandet av kunden:</label><br><br>";
          echo '<p>' . $row["msg_text"] . ' </p><br><br>';
        }
      }
    }
    if ($getMessageStatus['message_active'] == 0) {
        ?>
      
      <label for="message">Svara: </label><br>
      <textarea name="message" style="width: 400px; height: 200px;"></textarea><br>
      <input type="submit" name="send" value="Skicka meddelandet">

    </form> 
	   <?php 
      }
     ?>
</body>
</html>