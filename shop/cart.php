<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $newMessagesCount = getNewMessageCountAdmin($conn);
  $getCartsCount = getCartsCount($conn);
  $getSiteSetting = getSiteSetting($conn);
  $idUser = $userInfo ['user_id'];
  $tot = 0;
  $cartConnection = mysqli_query($conn,"SELECT * from carts WHERE c_user_id = '$idUser'");
  if(!isset($_SESSION['user_id'])) {
      header("location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $getSiteSetting['site_name'] ?> - Varukorgen</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Varukorgen</h1>
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
    <th width="5%">Ändring</th>
  </tr>
  <?php
  if ($cartConnection->num_rows > 0) {
    while ($row = $cartConnection->fetch_assoc()) {
  ?>
  <tr>
    <th width="40%"><?php echo'<img height="100" width="80" src="cPanel/image/'.$row['c_prod_image'].'">'; echo $row['c_prod_titel'];?></th>
    <th width="10%"><?php echo $row['cart_count']; ?></th>
    <th width="20%"><?php echo $row['c_prod_price']; ?> Kr</th>
    <th width="15%"><?php $priceP = $row['c_prod_price']; $totalC = $row['cart_count']; $totalPrice = $priceP * $totalC; $tot = $tot + $totalPrice; echo $totalPrice; ?> Kr</th>
    <th width="5%"><a href="cPanel/deleteCart.php?id=<?php echo $row["cart_id"]; ?>">Ta bort</a></th>
  </tr>
  <?php
  }
} else {
  echo "0 results";
}
  ?>
   <tr>
    <th width="40%"></th>
    <th width="10%"></th>
    <th width="20%">Summa:</th>
    <th width="15%"><?php echo $tot; ?> Kr</th>
    <th width="5%"><a href="checkout.php">Betala</a></th>
  </tr>
  </table>
</body>
</html>