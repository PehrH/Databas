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
			
		}
	}
}
function shopCart($userID, $prodID, $prodTitel, $prodPrice){
	$count = 1;
	$query = "SELECT * from carts WHERE c_user_id = '$userID'";
	$result = mysqli_query($conn,$query);
	if ($result && mysqli_num_rows($result) === 0) 
	{
			$addToDB = "INSERT into carts (c_user_id,c_prod_titel,c_prod_id,c_prod_price,cart_count) values ('$userID','$prodTitel','$prodID','$prodPrice','$count')";
			mysqli_query($conn, $addToDB);
			echo "OK";
		}
	elseif ($result && mysqli_num_rows($result) > 0) {
			$dbInfo = mysqli_fetch_assoc($result);
			if ($dbInfo['c_prod_id'] === $prodID ) {
				$count++;
				$updateDB = "UPDATE carts SET cart_count = '$count' WHERE c_prod_id= $prodID";
				mysqli_query($conn, $updateDB);
				echo "OK";
			} 
			else{
				$addToDB = "INSERT into carts (c_user_id,c_prod_titel,c_prod_id,c_prod_price,cart_count) values ('$userID','$prodTitel','$prodID','$prodPrice','$count')";
				mysqli_query($conn, $addToDB);
				echo "OK";
			}



			
		}

}