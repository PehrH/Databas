<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  

  $userInfor = userInfo($conn);
  $newMessagesCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $idUser = $userInfor ['user_id'];
  if($idUser < 1) {
      header("location: login.php");
    }
  mysqli_begin_transaction($conn);
  try{
      $getLastRow = mysqli_query($conn, "SELECT order_id AS last_row FROM orders WHERE order_user = $idUser ORDER BY order_id DESC LIMIT 1");
      $lastRow = mysqli_fetch_assoc($getLastRow);
      $lastOrder = $lastRow['last_row'];
      $orderConnection = mysqli_query($conn,"SELECT * FROM ordersprod JOIN orders ON orders.order_id = ordersprod.o_order_id WHERE ordersprod.o_order_id = $lastOrder");
      mysqli_commit($conn);
      } catch (mysqli_sql_exception $exception) {
          mysqli_rollback($conn);
           throw $exception;
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
  if (!isset($_SESSION['user_id'])){ 
    header("location: login.php");
   } else {
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
  <?php
   } 
   ?>
   <h2>Tack för din beställning. Beställningen är mottaget</h2>
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