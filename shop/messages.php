<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $getCartsCount = getCartsCount($conn);
  $getSiteSetting = getSiteSetting($conn);
    $idUser = $userInfo ['user_id'];
    if($idUser < 1) {
      header("location: login.php");
    }
  $messageStatus = mysqli_query($conn,"SELECT * FROM messages WHERE message_user = 3");

  if ($_SERVER['REQUEST_METHOD'] == "POST" ){
    $msgID = $_POST['msgID'];
    if (isset($_POST['seMsg'])) {
     header("location: readmessage.php?msgId=$msgID");
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
  <h1>Alla meddelanden</h1>
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
   <li style="float: right;"><a href="logout.php">Logga ut</a></li>
  <li style="float: right; background-color: #04AA6D"><a href="cart.php">Varukorgen: <?php  echo $getCartsCount?></a></li>
  <li style="float: right; background-color: #04AA6D"><a href=""><?php  echo $userInfo['Fname']?></a></li>
  </ul>
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
              <?php 
              if ($row["message_active"] == 1) {
                echo '<td>Stängd</td>';
              }
              else {
                echo '<td>Öppen</td>';
              }
              ?>
              <form method="post">
              <td><input type="submit" name="seMsg" value="Läs meddeladet"></td>
              <input type="hidden" name="msgID" value="<?php echo $msgid?>">
              </form>
            </tr>
        <?php
     }
  } 
  ?>
</table>
</body>
</html>