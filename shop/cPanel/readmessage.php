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
  $msgId = $_GET['msgId'];
  $admin = "admin";
  $zero = 0;
  $msgInfo = mysqli_query($conn,"SELECT * FROM msg  WHERE mess_id = $msgId");
  $messageStatus = mysqli_query($conn,"SELECT * FROM messages WHERE message_id = $msgId");
  $getMessageStatus = mysqli_fetch_assoc($messageStatus);
   if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['send'])){
    $message = $_POST['message'];
     mysqli_query($conn, "INSERT into msg (mess_id, msg_user, msg_title, msg_text) values ('$msgId', 0, '$admin', '$message')");
     mysqli_query($conn, "UPDATE messages SET message_user_status = 0, message_admin_status = 1  WHERE message_id = $msgID");
       header("location: readmessage.php?msgId=$msgId");
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
    <h3>Alla nya meddelande</h3>
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
      <form method="post">
      <label for="message">Svara: </label><br>
      <textarea name="message" style="width: 400px; height: 200px;"></textarea><br><br>
      <input type="submit" name="send" value="Skicka meddelandet"> 
    </form> 
     <?php 
      }
     ?>
</body>
</html>