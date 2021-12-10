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
    $getCart = mysqli_query($conn, "SELECT * FROM carts WHERE c_user_id = $userID");
    if ($getCart) {
    	$getCartsCount = 0;
    	if (mysqli_num_rows($getCart) > 0) {
        	while ($row = $getCart->fetch_assoc()) {
            	$getCartsCount = $getCartsCount + $row['cart_count'];
        	}
    	}
    }
    else{
    	$getCartsCount = 0;
    }
    return $getCartsCount;
}
function getOrderStatusCount($conn){
    $orderStatusCount = 0;
    $selectOrder = mysqli_query($conn, "SELECT order_status FROM orders WHERE order_status = 0");
    if ($selectOrder->num_rows > 0) {
        while ($selectOrder->fetch_assoc()) {
            $orderStatusCount ++; 
        }
    }
    return $orderStatusCount;
}
function getNewMessageCountAdmin($conn){
    $newMessageCount = 0;
    $selectMessage = mysqli_query($conn, "SELECT * FROM messages WHERE message_admin_status = 0");
    if ($selectMessage->num_rows > 0) {
        while ($selectMessage->fetch_assoc()) {
            $newMessageCount ++; 
        }
    }
    return $newMessageCount;
}
function getSiteSetting($conn){
    $selectSetting = mysqli_query($conn, "SELECT * FROM settings WHERE setting_id = 1");
    $user_data = mysqli_fetch_assoc($selectSetting);
    return $user_data;

}