<?php
session_start();

  include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $selectAdmins = mysqli_query($conn, "SELECT * FROM admins");
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['addAdmin'])) {
      header("location: addadmin.php");
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
  if (!isset($_SESSION['admin_id'])){ 
    header("location: login.php");
   } else {
  ?>
  <ul>
    <li><a href="index.php">Hem</a></li>
    <li><a href="product.php">Produkter</a></li>
    <li><a href="allorder.php">Order</a></li>
    <li><a href="allusers.php">Användare</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>    
    <h3>Alla admins</h3>
  <?php
   } 
   ?>
   <form method="post">
    <button  name="addAdmin">Lägga till ny admin</button><br><br>
    </form>
   <table>
  <tr>
    <th width="5%">Admins ID</th>
    <th width="20%">Admins namn</th>
    <th width="20%">Admins E-post</th>
  </tr>
  <?php
  if ($selectAdmins->num_rows > 0) {
    while ($getAdmins = $selectAdmins->fetch_assoc()) {
      ?>
    <tr>
    <th width="5%"><?php echo $getAdmins['admin_id']; ?></th>
    <th width="20%"><?php echo $getAdmins ['Aname'];?></th>
    <th width="20%"><?php echo $getAdmins['admin_email']; ?></th>
  </tr>
 
    <?php 
    }
  }
  ?>
   </table>


</body>
</html>