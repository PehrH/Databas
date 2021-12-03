<?php
session_start();

	include("connection.php");
  $result = mysqli_query($conn,"SELECT * FROM prod");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Controll Panel - Produkter</title>
</head>
<body>
	<h1>Produkter</h1>
	<?php  
	if (!isset($_SESSION['admin_id'])){ 
		header("Location: login.php");
	} 
	?>
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
} else {
  echo "0 results";
}
  ?>
</table>
	<br><a href="index.php">Hem</a><br>
	<br><a href="addProduct.php">Lägga till produkter</a><br>
	<a href="logout.php">Logga ut</a>
	</form>	
</body>
</html>