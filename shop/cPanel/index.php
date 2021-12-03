<?php
session_start();

	include("connection.php");
	include("function.php");
	$adminInfo = adminInfo($conn);
	$orderStatusCount = 0;
	$selectOrder = mysqli_query($conn, "SELECT order_status FROM orders WHERE order_status = 0");
	if ($selectOrder->num_rows > 0) {
    	while ($getOrder = $selectOrder->fetch_assoc()) {
    		$orderStatusCount ++; 
  		}
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Controll Panel</title>
</head>
<body>
	<h1>Detta är Controll Panel</h1>

	<?php  
	if (isset($_SESSION['admin_id'])){ 
		echo "Hej, " . $adminInfo['Aname'] . "";
	?>
	<a href="product.php"> | Produkter |</a>
	<a href="orderstatus.php"> Order status: <?php echo $orderStatusCount ?> |</a>

	<a href="logout.php">Logga ut</a>
		
	<?php
	 } else {
	 	header("Location: login.php")
	?>
	<a href="login.php">Logga in</a>
	<?php
	 } 
	?>
</body>
</html>