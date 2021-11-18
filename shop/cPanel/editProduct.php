<?php
error_reporting(0);
?>
<?php
session_start();
include("connection.php");

$id = $_GET['id'];
$qry = mysqli_query($conn,"SELECT * FROM prod WHERE prod_id='$id'"); // select query

$result = mysqli_fetch_array($qry); // fetch data
echo $result['title'];
if (isset($_POST['addProd'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];  
    $folder = "image/".$filename;
    $title = $_POST['title'];
    $price = $_POST['price'];
    $count = $_POST['count'];
    $des = $_POST['des'];
        
        if (empty($title) || empty($price) || empty($count) || empty($des)) {
            echo "Du måste fylla på alla information ";
        }
        
        $sql = "UPDATE prod SET prod_title = '$title', prod_price = '$price', prod_count = '$count', prod_des = '$des', prod_image = '$filename' WHERE prod_id= $id";

        mysqli_query($conn, $sql);
        move_uploaded_file($tempname, $folder);
        echo "Produkten är skapat";
        
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Lägga till produkter</title>
</head>
</body>
<?php  
    if (!isset($_SESSION['admin_id'])){ 
        header("Location: login.php");
     } else {
    ?>
    
    
<div id="addProduct">
        <form method="POST" action="" enctype="multipart/form-data">
            <div>Updatera produkten</div><br><br>
            <label  for="title">Titel: </label>
            <input  type="text" name="title" value="<?php echo $result['title'] ?>"><br><br>
            <label for="price">Pris: </label>
            <input type="number" name="price" value="<?php echo $result['price'] ?>"><br><br>
            <label for="count">Antal:</label>
            <input type="number" name="count" value="<?php echo $result['count'] ?>"><br><br>
            <label for="des">Beskrivning: </label><br>
            <input style="width: 300px; height: 500px;" type="text" name="des" value="<?php echo $result['des'] ?>"> 
            <?php echo'<img height="60" width="40" src="image/'.$result['prod_image'].'">'; ?>
            <input type="file" name="uploadfile" value=""/><br><br>
    

            <input type="submit" name="update" value="Lägga till"><br><br>

            <a href="index.php">Hem</a>
            <a href="product.php">Produkter</a>
            
            
        </form>     

    </div>
    <?php
     } 
    ?>

</body>
</html>
