<?php
session_start();

  include("connection.php");
  include("function.php");
  $adminInfo = adminInfo($conn);
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
  $result = mysqli_query($conn,"SELECT * FROM prod");
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['addProd'])) {
      header("location: addProduct.php");
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
		header("Location: login.php");
	} 
	?>
   <ul>
    <li><a href="index.php">Hem</a></li>
    <li><a href="allorder.php">Order</a></li>
    <li><a href="allusers.php">Användare</a></li>
    <li><a href="admins.php">Admins</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>    
    <h3>Alla produkter</h3><br><br>
    <form method="post">
    <button  name="addProd">Lägga till ny produkt</button><br><br>
    </form>
 <form>
	<table id="productTabel">
  <tr>
  	<th>Artikel nummer</th>
    <th>Titel</th>
    <th>Beskrivning</th>
    <th>Antal</th>
    <th>Pris</th>
    <th>Bild</th>
    <th></th>
    <th></th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  ?>
  <tr>
    <td><?php echo $row["prod_id"]; ?> </td>
    <td><?php echo $row["prod_title"]; ?></td>
    <td><?php echo $row["prod_des"]; ?></td>
    <td><?php echo $row["prod_count"]; ?></td>
    <td><?php echo $row["prod_price"]; ?></td>
    <td><?php echo'<img height="60" width="40" src="image/'.$row['prod_image'].'">'; ?></td>
    <th><a href="editProduct.php?id=<?php echo $row["prod_id"]; ?>">Ändra</a></th>
    <th><a href="deleteProduct.php?id=<?php echo $row["prod_id"]; ?>">Ta bort</a></th>
  </tr>

  <?php
  }
} 
  ?>
</table>
	<br><a href="index.php">Hem</a><br>
	<br><a href="addProduct.php">Lägga till produkter</a><br>
	<a href="logout.php">Logga ut</a>
	</form>	
</body>
</html>