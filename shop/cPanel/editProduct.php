<?php
error_reporting(0);
?>
<?php
session_start();
include("connection.php");

$id = $_GET['id'];
$query = "SELECT * from prod WHERE prod_id = '$id' limit 1";

$sql = mysqli_query($conn, $query); 
$result = mysqli_fetch_assoc($sql);

if (isset($_POST['update'])) {
    if (empty($_FILES['uploadfile']['name'])) {
        $filename = $result['prod_image'];
    }
    else {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"]; 
    }
     
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
        header("Location: product.php");
        
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
    
    
<div id="changeProduct">
        <form method="POST" action="" enctype="multipart/form-data">
            <h1>Ändra Produkter</h1><br><br>
            <label  for="title">Titel: </label>
            <input  type="text" name="title" value="<?php echo $result['prod_title'] ?>"><br><br>
            <label for="price">Pris: </label>
            <input type="number" name="price" value="<?php echo $result['prod_price'] ?>"><br><br>
            <label for="count">Antal:</label>
            <input type="number" name="count" value="<?php echo $result['prod_count'] ?>"><br><br>
            <label for="des">Beskrivning: </label><br>
            <input style="width: 300px; height: 500px;" type="text" name="des" value="<?php echo $result['prod_des'] ?>"> <br><br>
            <?php echo'<img height="60" width="40" src="image/'.$result['prod_image'].'">'; ?> <br><br>
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
