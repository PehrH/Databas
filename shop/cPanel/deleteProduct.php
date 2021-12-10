<?php

include("connection.php");

$id = $_GET['id']; 
mysqli_begin_transaction($conn);
try{
	$del = mysqli_query($conn,"DELETE FROM prod WHERE prod_id = '$id'"); 
	mysqli_commit($conn);
} catch (mysqli_sql_exception $exception) {
          mysqli_rollback($conn);
           throw $exception;
        }
if($del)
{
    mysqli_close($conn); 
    header("location: product.php"); 
    exit;	
}
else
{
    echo "Det gick inte att ta bort produkten";
}
?>