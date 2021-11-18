<?php

include("connection.php");

$id = $_GET['id']; 

$del = mysqli_query($conn,"DELETE FROM prod WHERE prod_id = '$id'"); 

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