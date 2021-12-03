<?php
session_start();
  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $getCartsCount = getCartsCount($conn);
  $result = mysqli_query($conn,"SELECT * FROM prod");
  $userID = $userInfo['user_id'];
  if (isset($_GET["id"])) {
    if (!isset($_SESSION['user_id'])) {
      header("location: login.php");
    }  
  }
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
    <a href="index.php">| Hem  </a>
    <a href="history.php">| Historik | </a>
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
    while ($row = $result->fetch_assoc()) {
  ?>
    <div>
  <form method="post">
  <a href="prodview.php?id=<?php echo $row["prod_id"];?>"><img src="cPanel/image/<?php echo $row["prod_image"];?>" style="width:80px;height:100px;"></a>
  <h3><a href="prodview.php?id=<?php echo $row["prod_id"];?>"><?php echo $row["prod_title"];?></a></h3>
  <p class="price"><?php echo $row["prod_price"];?> kr</p>
  <?php 
  if ($row["prod_count"] == 0) {
    echo '<p>Slut i lager</p>';
  }
  else{
    echo '<a href="cPanel/addtocart.php?id='. $row["prod_id"]. '&u= ' . $userInfo['user_id']. '">KÖP</a>';
  }
  ?>
    
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