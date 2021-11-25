<?php
session_start();

	include("cPanel/connection.php");
	include("cPanel/function.php");
	$userInfo = userInfo($conn);
	$count = 1;
	$sql = "SELECT * FROM prod";
	$result = mysqli_query($conn,$sql);
	$userID = $userInfo['user_id'];
	if (isset($_GET["id"])) {
		if (!isset($_SESSION['user_id'])) {
			header("location: login.php");
		}
		else{
			$id = $_GET['id'];
		//$userID = $userInfo['user_id'] ;
		$getCartsInfo = "SELECT * from carts WHERE c_prod_id = '$id' AND c_user_id = '$userID'";
		$cartConnection = mysqli_query($conn,$getCartsInfo);
		$cartInfo = mysqli_fetch_assoc($cartConnection);
		if ($cartInfo['c_prod_id'] === $id ) {
			$test = $cartInfo['cart_count'];
			$test ++;
			$updateDB = "UPDATE carts SET cart_count = '$test' WHERE c_prod_id= '$id' AND c_user_id = '$userID'";
			mysqli_query($conn, $updateDB);
			header("location: index.php");
			} 
		else{
			$getProdInfo = "SELECT * from prod WHERE prod_id = '$id'";
			$prodConnection = mysqli_query($conn,$getProdInfo);
			$prodInfo = mysqli_fetch_assoc($prodConnection);
			//$userID = $userInfo['user_id'];
			$prodTitel = $prodInfo['prod_title'];
			$prodPrice = $prodInfo['prod_price'];
			$prodImage = $prodInfo['prod_image'];
			$count = 1;
			$addToDB = "INSERT into carts (c_user_id,c_prod_titel,c_prod_id,c_prod_price,cart_count, c_prod_image) values ('$userID','$prodTitel','$id','$prodPrice','$count','$prodImage')";
			mysqli_query($conn, $addToDB);
			header("location: index.php");
			
			}
		}
		
	}

	$getC = "SELECT COUNT(*) AS total_count FROM carts WHERE c_user_id ='$userID'"; 
	$getCC = mysqli_query($conn, $getC);
	$getCartsCount = mysqli_fetch_assoc($getCC);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Online</title>
</head>
<body>
	<h1>Hem</h1>
  <?php  
  if (isset($_SESSION['user_id'])){ 
    echo "Hej, " . $userInfo['Fname'] . "";
  ?>
    <a href="product.php">| Produkter | </a>
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
  // output data of each row
  	for ($i=0; $i < 6 ; $i++) { 
  		$row = $result->fetch_assoc();
  		echo'<img height="100" width="80" src="cPanel/image/'.$row['prod_image'].'">';
  ?>
  <div>
  <form method="post">
  <h3><?php echo $row["prod_title"]; ?></h3>
  <p class="price"><?php echo $row["prod_price"];?> kr</p>
  <a href="index.php?id=<?php echo $row["prod_id"]; ?>">KÖP</a>	

  
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