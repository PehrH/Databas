<?php
include("connection.php");

function userInfo($conn){
	if (isset($_SESSION['user_id'])) 
	{
		$id = $_SESSION['user_id'];
		$result = mysqli_query($conn,"SELECT * from users WHERE user_id = '$id'");
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
function getCartsCount($conn){
	$userInfo = userInfo($conn);
	$userID = $userInfo['user_id'];
	$getCart = mysqli_query($conn, "SELECT COUNT(*) AS total_count FROM carts WHERE c_user_id ='$userID'");
	$getCartsCount = mysqli_fetch_assoc($getCart);	
	return $getCartsCount;
}