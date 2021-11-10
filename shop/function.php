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

function getLastID(){
	$maxNumber = 0;
	$query = "SELECT user_id from users";
	$result = mysqli_query($conn, $query);
	if ($result && mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			if ($row['user_id'] > $maxNumber){
				$maxNumber = $row['user_id'];
			}

		}
		return $maxNumber;
	}
	else {
		return 0;
	}

}
