<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfor = userInfo($conn);
  $idUser = $userInfor ['user_id'];
  $tot = 0;
  $getCartsInfo = "SELECT * from carts WHERE c_user_id = '$idUser'";
  $cartConnection = mysqli_query($conn,$getCartsInfo);
  if(!isset($_SESSION['user_id'])) {
      header("location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop Online - Varukorgen</title>
</head>
<body>
  <h1>Varukorgen</h1>
  <?php  
  if (isset($_SESSION['user_id'])){ 
    echo "Hej, " . $userInfor['Fname'] . "";
  ?>
    <a href="index.php">| Hem | </a>
    <a href="product.php">| Produkter | </a>
    <a href="logout.php">Logga ut</a><br>
    
    
  <?php
   } else {
  ?>
  <a href="index.php">Hem</a>
  <a href="login.php">Logga in</a>
  <a href="signup.php">Registera</a>
  <a href="product.php">Produkter</a>
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