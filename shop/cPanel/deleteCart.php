<?php

include("connection.php");
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * from carts WHERE cart_id = '$id'"); 
$result = mysqli_fetch_assoc($sql);
if ($result['cart_count'] > 1) {
    $temp = $result['cart_count'];
    $temp = $temp - 1;
    mysqli_begin_transaction($conn);
    try{
    $update = mysqli_query($conn,"UPDATE carts SET cart_count = '$temp' WHERE cart_id = $id");
    mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($conn);
        throw $exception;
    }
     mysqli_close($conn); 
    header("location: ../cart.php"); 
    exit;  
}
else{
    mysqli_begin_transaction($conn);
    try{
    $del = mysqli_query($conn,"DELETE FROM carts WHERE cart_id = '$id'");
    mysqli_commit($conn);
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($conn);
        throw $exception;
    }
    mysqli_close($conn); 
    header("location: ../cart.php"); 
    exit;
}


?>