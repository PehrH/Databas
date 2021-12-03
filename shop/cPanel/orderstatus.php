<?php
session_start();

  include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $selectOrder = mysqli_query($conn, "SELECT * FROM orders JOIN users ON orders.order_user = users.user_id WHERE orders.order_status = 0;");
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $prodId = $_POST['prodId'];
    if (isset($_POST['seOrder'])) {
      header("location: order.php?id=$prodId");
    }
    elseif(isset($_POST['approved'])){
      mysqli_query($conn, "UPDATE orders SET order_status = 1 WHERE order_id = $prodId");
      header("location: orderstatus.php");
    }
    elseif(isset($_POST['denied'])){
      mysqli_query($conn, "DELETE FROM orders WHERE order_id = $prodId");
      header("location: orderstatus.php");
    }
    
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop Online</title>
</head>
<body>
  <?php  
  if (!isset($_SESSION['admin_id'])){ 
    header("location: login.php");
   } else {
    echo "Hej, " . $adminInfo['Aname'] . "";
  ?>
  <a href="index.php"> Hem</a>
  <a href="product.php"> | Produkter |</a>
  <a href="logout.php">Logga ut</a>
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
    <th width="25%"><button name="seOrder">See order</button><button name="approved">Gödkänna</button><button name="denied">Neka</button></th>
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