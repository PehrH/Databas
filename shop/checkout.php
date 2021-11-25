<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfor = userInfo($conn);
  $idUser = $userInfor ['user_id'];
  $tot = 0;
  $getCartsInfo = "SELECT * from carts WHERE c_user_id = '$idUser'";
  $cartConnection = mysqli_query($conn,$getCartsInfo);
  $totCartCount = 0;
  if(!isset($_SESSION['user_id'])) {
      header("location: login.php");
    }
  else{
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $buyTotal = $_POST['totSum'];
    $totinput = $_POST['totinput'];
    $totcount = $_POST['totcount'];
      if ($buyTotal === $totinput) {
          $makeOrder = "INSERT INTO orders (order_user, order_sum, order_prod_count, order_status) VALUES ('$idUser', '$buyTotal', '$totcount', 0)";
          mysqli_query($conn, $makeOrder);
          /*
           if ($cartConnection->num_rows > 0) {
            while ($row = $cartConnection->fetch_assoc()) {
                $getOrdersInfo = "SELECT * from orders";
                $orderInfo = mysqli_query($conn,$getOrdersInfo);

                $makeOrderProd = "INSERT INTO ordersprod (o_order_id, person_id, product_id ) SELECT order_id, $idUser, $row['c_prod_id'] FROM orders WHERE order_user = '$idUser'"
               }
             }
             */
      }
      else{
        echo $totinput;
      }
  }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop Online - Betalning</title>
</head>
<body>
  <h1>Checkout</h1>
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