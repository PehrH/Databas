<?php
session_start();

  include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $id = $_GET['id'];

  $orderConnection = mysqli_query($conn,"SELECT * FROM ordersprod JOIN orders ON orders.order_id = ordersprod.o_order_id WHERE ordersprod.o_order_id = $id");
  if(!isset($_SESSION['admin_id'])) {
      header("location: login.php");
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
    <li><a href="admins.php">Admins</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>    
  <?php
   } 
   ?>
   <table>
  <tr>
    <th width="10%"></th>
    <th width="40%">Produkt</th>
    <th width="10%">Artikelnummer</th>
    <th width="15%">Pris</th>
    <th width="10%">Antal</th>
    <th width="15%">Summa</th>
  </tr>
  <?php

  if ($orderConnection->num_rows > 0) {
    while ($orderDetails = $orderConnection->fetch_assoc()) {
      $orderID = $orderDetails['o_order_id'];
      $orderDate = $orderDetails['order_date'];
      $prodID = $orderDetails['product_id'];
      $orderSum = $orderDetails['order_sum'];
      $countSum = $orderDetails['order_prod_count'];
      $prodConn = mysqli_query($conn,"SELECT * from prod WHERE prod_id = '$prodID'");
      $getProd = mysqli_fetch_assoc($prodConn);

      ?>

    <tr>
    <th width="10%"><?php echo'<img height="50" width="40" src="image/'.$getProd ['prod_image'].'">' ?></th>
    <th width="40%"><?php echo $getProd ['prod_title'] ?></th>
    <th width="10%"><?php echo $prodID?></th>
    <th width="15%"><?php echo $orderDetails['o_prod_price'] ?></th>
    <th width="10%"><?php echo $orderDetails['o_count'] ?></th>
    <th width="15%"><?php echo $tot = $orderDetails['o_prod_price'] * $orderDetails['o_count']; ?></th>
  </tr>
    <?php 
    }
  }
      
  ?>
  <tr>
    <th width="10%"></th>
    <th width="40%"></th>
    <th width="10%"></th>
    <th width="15%"></th>
    <th width="10%">Antal produkter</th>
    <th width="15%">Total summa</th>
  </tr>
  <tr>
    <th width="10%"></th>
    <th width="40%"></th>
    <th width="10%"></th>
    <th width="15%"></th>
    <th width="10%"><?php echo $countSum ?></th>
    <th width="15%"><?php echo $orderSum?></th>
  </tr>
  <h2>Order # <?php echo $orderID; ?></h2>
   <label>Datum och tid : <?php echo $orderDate ?></label><br><br>
  </table>

</body>
</html>