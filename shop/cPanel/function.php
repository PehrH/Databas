<?php
include("connection.php");

function userInfo($conn){
	if (isset($_SESSION['user_id'])) 
	{
		$id = $_SESSION['user_id'];
		$query = "SELECT * from users WHERE user_id = '$id'";

		$result = mysqli_query($conn,$query);
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
			# code...
		}
	}
}
function adminInfo($conn){
	if (isset($_SESSION['admin_id'])) 
	{
		$id = $_SESSION['admin_id'];
		$query = "SELECT * from admins WHERE admin_id = '$id'";

		$result = mysqli_query($conn,$query);
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
			# code...
		}
	}
}
function deleteProduct($productId){
	$query = "DELETE FROM prod WHERE prod_id= $productId ";
	mysqli_query($conn,$query);
	echo "Produkter är borttagen !";

}