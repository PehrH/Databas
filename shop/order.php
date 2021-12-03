<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $getCartsCount = getCartsCount($conn);
  $id = $_GET['id'];

  $orderConnection = mysqli_query($conn,"SELECT * FROM ordersprod JOIN orders ON orders.order_id = ordersprod.o_order_id WHERE ordersprod.o_order_id = $id");
  if(!isset($_SESSION['admin_id'])) {
      header("location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop Online</title>
</head>
<body>
  <?php  
  if (!isset($_SESSION['user_id'])){ 
    header("location: login.php");
   } else {
    echo "Hej, " . $userInfo['Fname'] . "";
  ?>
<a href="index.php">| Hem  </a>
    <a href="product.php">| Produkter</a>
    <a href="history.php">| Historik | </a>
    <a href="logout.php">Logga ut</a><br>
    <a href="cart.php">Varukorgen: <?php  echo $getCartsCount['total_count']; ?> </a><br> 
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
    <th width="10%"><?php echo'<img height="50" width="40" src="cPanel/image/'.$getProd ['prod_image'].'">' ?></th>
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