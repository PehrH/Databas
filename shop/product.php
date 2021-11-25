<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $count = 1;
  $sql = "SELECT * FROM prod";
  $result = mysqli_query($conn,$sql);
  $userID = $userInfo['user_id'];
  if (isset($_GET["id"])) {
    if (!isset($_SESSION['user_id'])) {
      header("location: login.php");
    }  
  }
  $getC = "SELECT COUNT(*) AS total_count FROM carts WHERE c_user_id ='$userID'"; 
  $getCC = mysqli_query($conn, $getC);
  $getCartsCount = mysqli_fetch_assoc($getCC);
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop Online - Produkter</title>
</head>
<body>
  <h1>Produkter</h1>
  <?php  
  if (isset($_SESSION['user_id'])){ 
    echo "Hej, " . $userInfo['Fname'] . "";
  ?>
    <a href="index.php">| Hem | </a>
    <a href="product.php">| Produkter | </a>
    <a href="logout.php">Logga ut</a><br>
    <a href="cart.php">Varukorgen: <?php  echo $getCartsCount['total_count']; ?> </a><br>

    
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
 <form>
  <?php

  if ($result->num_rows > 0) {
  // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo'<img height="100" width="80" src="cPanel/image/'.$row['prod_image'].'">';
  ?>
  <div>
  <form method="post">
  <h3><?php echo $row["prod_title"]; ?></h3>
  <p class="price"><?php echo $row["prod_price"];?> kr</p>
  <a href="cPanel/addtocart.php?id=<?php echo $row["prod_id"];?>&u=<?php echo $userInfo['user_id'];?>">KÖP</a> 

  
  </form> 
  </div>

  <?php
  }
} else {
  echo "0 results";
}
  ?>
  </form> 
  
</body>
</html>