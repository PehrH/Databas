<?php
include("connection.php"); 

$id = $_GET['id'];
$userID = $_GET['u'];
if ($userID < 1) {
    header("location: ../login.php");
}
else{
    
    $cartConnection = mysqli_query($conn,"SELECT * from carts WHERE c_prod_id = '$id' AND c_user_id = '$userID'");
    $cartInfo = mysqli_fetch_assoc($cartConnection);
    if ($cartInfo['c_prod_id'] === $id ) {
        $increment = $cartInfo['cart_count'];
        $increment ++;
        mysqli_begin_transaction($conn);
         try{
        mysqli_query($conn, "UPDATE carts SET cart_count = '$increment' WHERE c_prod_id= '$id' AND c_user_id = '$userID'");
        mysqli_commit($conn);
      } catch (mysqli_sql_exception $exception) {
          mysqli_rollback($conn);
           throw $exception;
        }
        header("location: ../product.php");
        exit;
        } 
    else{
        mysqli_begin_transaction($conn);
        try{
        $prodConnection = mysqli_query($conn,"SELECT * from prod WHERE prod_id = '$id'");
        $prodInfo = mysqli_fetch_assoc($prodConnection);
        $prodTitel = $prodInfo['prod_title'];
        $prodPrice = $prodInfo['prod_price'];
        $prodImage = $prodInfo['prod_image'];
        $count = 1;
        mysqli_query($conn, "INSERT into carts (c_user_id,c_prod_titel,c_prod_id,c_prod_price,cart_count, c_prod_image) values ('$userID','$prodTitel','$id','$prodPrice','$count','$prodImage')");
        mysqli_commit($conn);
      } catch (mysqli_sql_exception $exception) {
          mysqli_rollback($conn);
           throw $exception;
        }
        header("location: ../product.php");
        exit;  
        }

}
