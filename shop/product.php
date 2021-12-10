<?php
session_start();
  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $getCartsCount = getCartsCount($conn);
  $newMessagesCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
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
  <title><?php echo $getSiteSetting['site_name'] ?> - Produkter</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Produkter</h1>
  <?php  
  if (isset($_SESSION['user_id'])){ 
  ?>
  <ul>
  <li><a href="index.php">Hem</a></li>
  <li><a href="history.php">Historik</a></li>
  <li><a href="sendmessages.php">Kontakta admin</a></li>
  <li><a href="messages.php">Meddelandet: <?php  echo $newMessagesCount?></a></li>
  < <li style="float: right;"><a href="logout.php">Logga ut</a></li>
  <li style="float: right; background-color: #04AA6D"><a href="cart.php">Varukorgen: <?php  echo $getCartsCount?></a></li>
  <li style="float: right; background-color: #04AA6D"><a href=""><?php  echo $userInfo['Fname']?></a></li>
  </ul>
  </ul> 
  <?php
   } else {
  ?>
  <ul>
    <li><a href="index.php">Hem</a></li>
  <li><a href="product.php">Produkter</a></li>
  <li><a href="login.php">Logga in</a></li>
  <li><a href="signup.php">Registera</a></li>
  </ul>
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