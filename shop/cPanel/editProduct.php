<?php
error_reporting(0);
session_start();
  include("connection.php");
  include("function.php");
  $orderStatusCount = getOrderStatusCount($conn);
  $newMessageCount = getNewMessageCountAdmin($conn);
  $getSiteSetting = getSiteSetting($conn);
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * from prod WHERE prod_id = '$id' limit 1"); 
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
        mysqli_begin_transaction($conn);
        try{
        mysqli_query($conn, "UPDATE prod SET prod_title = '$title', prod_price = '$price', prod_count = '$count', prod_des = '$des', prod_image = '$filename' WHERE prod_id= $id");
        move_uploaded_file($tempname, $folder);
        mysqli_commit($conn);
      } catch (mysqli_sql_exception $exception) {
          mysqli_rollback($conn);
           throw $exception;
        }
        header("Location: product.php");      
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $getSiteSetting['site_name'] ?> - Kontrollpanalen</title>
  <meta name="description" content="<?php echo $getSiteSetting['site_desc'] ?>">
  <meta name="keywords" content="<?php echo $getSiteSetting['site_meta'] ?>">
  <link rel="stylesheet" href="style.css">
</head>
</body>
<?php  
    if (!isset($_SESSION['admin_id'])){ 
        header("Location: login.php");
     } else {
    ?>
     <ul>
    <li><a href="index.php">Hem</a></li>
    <li><a href="product.php">Produkter</a></li>
    <li><a href="allorder.php">Order</a></li>
    <li><a href="allusers.php">Användare</a></li>
    <li><a href="admins.php">Admins</a></li>
    <li><a href="orderstatus.php">Order status: <?php echo $orderStatusCount ?></a></li>
    <li><a href="messages.php">Meddelandet: <?php  echo $newMessageCount?></a></li>
    <li><a href="setting.php">Inställningar</a></li>
    <li style="float: right;"><a href="logout.php">Logga ut</a></li>
    <li style="float: right; background-color: #04AA6D"><a href="profile.php"><?php  echo $adminInfo['Aname']?></a></li>
    </ul>    
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
