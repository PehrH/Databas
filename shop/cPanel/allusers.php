<?php
session_start();

  include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $selectUsers = mysqli_query($conn, "SELECT * FROM users");
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $userID = $_POST['userID'];
    if (isset($_POST['deleteUsers'])) {
      mysqli_query($conn, "DELETE FROM users WHERE user_id = '$userID'");
      header("location: allusers.php");
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
    <li><a href="allorder.php">Order</a></li>
    <li><a href="admins.php">Admins</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>    
    <h3>Alla användare</h3>
  <?php
   } 
   ?>
   <table>
  <tr>
    <th width="5%">Användare ID</th>
    <th width="20%">Användare namn</th>
    <th width="20%">Beställare E-post</th>
    <th width="25%"></th>
  </tr>
  <?php
  if ($selectUsers->num_rows > 0) {
    while ($getUsers = $selectUsers->fetch_assoc()) {
      ?>
    <tr>
    <th width="5%"><?php echo $getUsers['user_id']; ?></th>
    <th width="20%"><?php echo $getUsers ['Fname']; echo " " . $getUsers ['Lname']; ?></th>
    <th width="20%"><?php echo $getUsers['user_email']; ?></th>
    <form method="post">
    <th width="25%"><button name="deleteUsers">Ta bort användare</button></th>
    <input type="hidden" name="userID" value="<?php echo $getUsers['user_id'];?>">
  </tr>
  </form>
 
    <?php 
    }
  }
  ?>
   </table>


</body>
</html>