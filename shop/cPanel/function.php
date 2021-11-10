<?php

function checkLogin($conn){
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

function checkAdminLogin($conn){
	if (isset($_SESSION['Aname'])) 
	{
		$name = $_SESSION['Aname'];
		$query = "SELECT * from admin WHERE Aname = '$name'";

		$result = mysqli_query($conn,$query);
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
}
