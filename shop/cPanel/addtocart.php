<?php
include("connection.php"); 
$id = $_GET['id'];
$userID = $_GET['u'];
$getCartsInfo = "SELECT * from carts WHERE c_prod_id = '$id' AND c_user_id = '$userID'";
$cartConnection = mysqli_query($conn,$getCartsInfo);
$cartInfo = mysqli_fetch_assoc($cartConnection);
if ($cartInfo['c_prod_id'] === $id ) {
    $test = $cartInfo['cart_count'];
    $test ++;
    $updateDB = "UPDATE carts SET cart_count = '$test' WHERE c_prod_id= '$id' AND c_user_id = '$userID'";
    mysqli_query($conn, $updateDB);
    header("location: ../product.php");
    exit;
    } 
else{
    $getProdInfo = "SELECT * from prod WHERE prod_id = '$id'";
    $prodConnection = mysqli_query($conn,$getProdInfo);
    $prodInfo = mysqli_fetch_assoc($prodConnection);
    $prodTitel = $prodInfo['prod_title'];
    $prodPrice = $prodInfo['prod_price'];
    $prodImage = $prodInfo['prod_image'];
    $count = 1;
    $addToDB = "INSERT into carts (c_user_id,c_prod_titel,c_prod_id,c_prod_price,cart_count, c_prod_image) values ('$userID','$prodTitel','$id','$prodPrice','$count','$prodImage')";
    mysqli_query($conn, $addToDB);
    header("location: ../product.php");
    exit;  
    }
