<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfor = userInfo($conn);
  $getCartsCount = getCartsCount($conn);
  $newMessagesCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $idUser = $userInfor ['user_id'];
  $tot = 0;
  $cartConnection = mysqli_query($conn,"SELECT * from carts WHERE c_user_id = '$idUser'");
  $totCartCount = 0;
  $currentOrderID;
  if(!isset($_SESSION['user_id'])) {
      header("location: login.php");
    }
  else{
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $buyTotal = $_POST['totSum'];
    $totinput = $_POST['totinput'];
    $totcount = $_POST['totcount'];
      if ($buyTotal === $totinput) {
         if ($cartConnection->num_rows > 0) {
           while ($row = $cartConnection->fetch_assoc()) {
            $prodID = $row['c_prod_id'];
            $prodPrice = $row['c_prod_price'];
            $prodCount = $row['cart_count']; 
            $prodConnection = mysqli_query($conn,"SELECT * from prod WHERE prod_id = $prodID");
            $prodInfo = mysqli_fetch_assoc($prodConnection);
            if ($prodCount > $prodInfo['prod_count']) {
              echo "Antal produkter " . $row['c_prod_titel'] . " i lager räcker inte till för att klargöra köpet. Det finns endast " . $prodInfo['prod_count'] . " st kvar i lager";
            }
            else {
              mysqli_begin_transaction($conn);
              try {
              $prodCountLeft = $prodInfo['prod_count'];
              $prodCountLeft = $prodCountLeft - $prodCount;
              mysqli_query($conn, "UPDATE prod SET prod_count = '$prodCountLeft' WHERE prod_id= $prodID");
              mysqli_query($conn, "INSERT INTO orders (order_user, order_sum, order_prod_count, order_status) VALUES ('$idUser', '$buyTotal', '$totcount', 0)");
             $getLastRow = mysqli_query($conn, "SELECT order_id AS last_row FROM orders WHERE order_user = $idUser ORDER BY order_id DESC LIMIT 1");
             $lastRow = mysqli_fetch_assoc($getLastRow);
             $lastOrder = $lastRow['last_row'];
              mysqli_query($conn, "INSERT INTO ordersprod (o_order_id, person_id, product_id, o_prod_price, o_count) VALUES ('$lastOrder', '$idUser', '$prodID', '$prodPrice', '$prodCount')");
              mysqli_query($conn, "DELETE FROM carts WHERE c_user_id = $idUser");
              mysqli_commit($conn);
                } catch (mysqli_sql_exception $exception) {
                    mysqli_rollback($conn);
                    throw $exception;
                  }
                  header("location: orderconfirm.php");
           }
         }
      }
    }
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
  <h1>Checkout</h1>
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
   <table>
  <tr>
    <th width="40%">Produkt</th>
    <th width="10%">Antal</th>
    <th width="20%">Pris</th>
    <th width="15%">Total</th>
  </tr>
  <?php
  if ($cartConnection->num_rows > 0) {
    while ($row = $cartConnection->fetch_assoc()) {
      $totCartCount =  $totCartCount + $row['cart_count'];
  ?>
  <tr>
    <th width="40%"><?php echo'<img height="100" width="80" src="cPanel/image/'.$row['c_prod_image'].'">'; echo $row['c_prod_titel'];?></th>
    <th width="10%"><?php echo $row['cart_count']; ?></th>
    <th width="20%"><?php echo $row['c_prod_price']; ?></th>
    <th width="15%"><?php $priceP = $row['c_prod_price']; $totalC = $row['cart_count']; $totalPrice = $priceP * $totalC; $tot = $tot + $totalPrice; echo $totalPrice; ?></th>
  </tr>
  <?php
  }
} else {
  echo "0 results";
}
  ?>
  </table>
  <form method="post">
  <br><br><label style="font-weight: bolder; font-size: 25px;">Betala summan: <?php echo $tot; ?> Kr </label>
  <input type="number" name="totSum"> 
  <input type="hidden" name="totinput" value="<?php echo $tot;?>">
  <input type="hidden" name="totcount" value="<?php echo $totCartCount;?>"> 
  <input type="submit" name="buy" value="Betala">
  </form>
</body>
</html>