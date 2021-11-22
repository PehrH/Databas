<?php
session_start();

	include("cPanel/connection.php");
	include("cPanel/function.php");
	$userInfo = userInfo($conn);

	$sql = "SELECT * FROM prod WHERE ";
  $result = mysqli_query($conn,$sql);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Online</title>
</head>
<body>
	<h1>Detta är första sidan</h1>

	<?php  
	if (isset($_SESSION['user_id'])){ 
		echo "Hej, " . $userInfo['Fname'] . "";
	?>
		<a href="product.php">Produkter</a>
		<a href="logout.php">Logga ut</a>
		
	<?php
	 } else {
	?>
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

  for ($i=0; $i < 6; $i++) { 
  		$row = $result->fetch_assoc() 
  ?>
  <div class="productBox">
  <?php echo'<img height="100" width="80" src="cPanel/image/'.$row['prod_image'].'">'; ?>
  <h3><?php echo $row["prod_title"]; ?></h3>
  <p class="price"><?php echo $row["prod_price"]; ?> kr</p>
  <p><button>KÖP</button></p>
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