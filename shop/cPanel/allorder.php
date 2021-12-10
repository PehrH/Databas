<?php
session_start();

  include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $selectOrder = mysqli_query($conn, "SELECT * FROM orders JOIN users ON orders.order_user = users.user_id");
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
  <title><?php echo $getSiteSetting['site_name'] ?> - Kontrollpanalen</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php  
  if (!isset($_SESSION['admin_id'])){ 
    header("location: login.php");
   } else {
  ?>
  <ul>
    <li><a href="index.php">Hem</a></li>
    <li><a href="product.php">Produkter</a></li>
    <li><a href="allusers.php">Användare</a></li>
    <li><a href="admins.php">Admins</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>    
    <h3>Alla order</h3>
  <?php
   } 
   ?>
   <table>
  <tr>
    <th width="5%">Order ID</th>
    <th width="20%">Beställare namn</th>
    <th width="20%">Beställare E-post</th>
    <th width="5%">Antal produkter</th>
    <th width="10%">Pris</th>
    <th width="15%">Datum och tid</th>
    <th width="25%">Välj</th>
  </tr>
  <?php
  if ($selectOrder->num_rows > 0) {
    while ($getOrder = $selectOrder->fetch_assoc()) {
      ?>
    <tr>
    <th width="5%"><?php echo $getOrder['order_id']; ?></th>
    <th width="20%"><?php echo $getOrder ['Fname']; echo " " . $getOrder ['Lname']; ?></th>
    <th width="20%"><?php echo $getOrder['user_email']; ?></th>
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