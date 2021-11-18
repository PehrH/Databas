<?php
error_reporting(0);
?>
<?php
session_start();
$msg = "";
include("connection.php");
// If upload button is clicked ...
if (isset($_POST['addProd'])) {

	$filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];	
	$folder = "image/".$filename;
	$title = $_POST['title'];
	$price = $_POST['price'];
	$count = $_POST['count'];
	$des = $_POST['des'];
		
		if (empty($title) || empty($price) || empty($count) || empty($des)) {
			echo "Du måste fylla på alla information ";
		}
		
	//$db = mysqli_connect("localhost", "root", "", "photos");

		// Get all the submitted data from the form
		$sql = "INSERT INTO prod (prod_title, prod_price, prod_count, prod_des, prod_image) VALUES ('$title', '$price', '$count', '$des', '$filename')";

		// Execute query
		mysqli_query($conn, $sql);
		move_uploaded_file($tempname, $folder);
		echo "Produkten är skapat";
		
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Lägga till produkter</title>
</head>
</body>
<?php  
	if (!isset($_SESSION['admin_id'])){ 
		header("Location: login.php");
	 } else {
	?>
	
	
<div id="addProduct">
		<form method="POST" action="" enctype="multipart/form-data">
			<div>Lägga till produkter</div><br><br>
			<label for="title">Titel: </label>
			<input type="text" name="title"><br><br>
			<label for="price">Pris: </label>
			<input type="number" name="price"><br><br>
			<label for="count">Antal:</label>
			<input type="number" name="count"><br><br>
			<label for="des">Beskrivning: </label><br>
			<textarea name="des" rows="4" cols="50"></textarea><br>
			<input type="file" name="uploadfile" value=""/><br><br>
	

			<input type="submit" name="addProd" value="Lägga till"><br><br>

			<a href="index.php">Hem</a>
			<a href="product.php">Produkter</a>
			
			
		</form>		

	</div>
	<?php
	 } 
	?>

</body>
</html>
