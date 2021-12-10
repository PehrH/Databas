<?php
session_start();

	include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $idAdmin = $adminInfo ['admin_id'];
    if($idAdmin < 1) {
      header("location: login.php");
    }
  $messageStatus = mysqli_query($conn,"SELECT * FROM messages WHERE message_admin_status = 0 AND message_active = 0");

  if ($_SERVER['REQUEST_METHOD'] == "POST" ){
    $msgID = $_POST['msgID'];
    if (isset($_POST['seMsg'])) {
     header("location: readmessage.php?msgId=$msgID");
    }
    elseif (isset($_POST['doneMsg'])) {
      mysqli_query($conn, "UPDATE messages SET message_active = 1, message_admin_status = 1 WHERE message_id = $msgID");
      header("location: readmessage.php?msgId=$msgID");
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
	<h1>Meddelandet</h1>
	<?php  
	if (!isset($_SESSION['admin_id'])){ 
		header("Location: login.php");
	} 
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
	<table id="messagesTable">
  <tr>
  	<th>Nr</th>
    <th>Titel</th>
    <th>Datum</th>
    <th>Status</th>
    <th></th>
  </tr>
  <?php
  if ($messageStatus->num_rows > 0) {
      while($row = $messageStatus->fetch_assoc()) {
          $msgid = $row["message_id"];
          $msgInfo = mysqli_query($conn,"SELECT * FROM msg WHERE mess_id = $msgid");
          $getMessage = mysqli_fetch_assoc($msgInfo);
               ?>
            <tr>
              <td><?php echo $msgid ?> </td>
              <td><?php echo $getMessage["msg_title"]; ?></td>
              <td><?php echo $getMessage["msg_date"]; ?></td>
              <td>Öppen</td>
              <form method="post">
              <td><input type="submit" name="seMsg" value="Läs meddeladet"></td>
              <td><input type="submit" name="doneMsg" value="Avsluta"></td>
              <input type="hidden" name="msgID" value="<?php echo $msgid?>">
              </form>
            </tr>
        <?php
     }
  }
  else {
    echo "Inga nya meddelande";
  } 
  ?>
</table>
</body>
</html>