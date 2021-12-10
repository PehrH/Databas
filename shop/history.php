<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $getCartsCount = getCartsCount($conn);
  $newMessagesCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $userID = $userInfo['user_id'];
  $selectOrder = mysqli_query($conn, "SELECT * from orders WHERE order_user = '$userID'");
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $prodId = $_POST['prodId'];
    if (isset($_POST['seOrder'])) {
      header("location: order.php?id=$prodId");
    }
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $getSiteSetting['site_name'] ?> - Historik</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Historik</h1>
  <?php  
  if (!isset($_SESSION['user_id'])){ 
    header("location: login.php");
   } else {
  ?>
<ul>
  <li><a href="index.php">Hem</a></li>
  <li><a href="product.php">Produkter</a></li>
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
    <th width="5%">Order ID</th>
    <th width="5%">Antal produkter</th>
    <th width="10%">Pris</th>
    <th width="15%">Datum och tid</th>
    <th width="25%"></th>
  </tr>
  <?php
  if ($selectOrder->num_rows > 0) {
    while ($getOrder = $selectOrder->fetch_assoc()) {
      ?>
    <tr>
    <th width="5%"><?php echo $getOrder['order_id']; ?></th>
    <th width="5%"><?php echo $getOrder['order_prod_count']; ?></th>
    <th width="10%"><?php echo $getOrder['order_sum']; ?></th>
    <th width="15%"><?php echo $getOrder['order_date']; ?></th>
    <form method="post">
    <th width="25%"><button name="seOrder">See order</button></th>
    <input type="hidden" name="prodId" value="<?php echo $getOrder['order_id'];?>">
  </tr>
  </form>
 
    <?php 
    }
  }
  ?>
   </table>


</body>
</html>