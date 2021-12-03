<?php
session_start();

  include("cPanel/connection.php");
  include("cPanel/function.php");
  $userInfo = userInfo($conn);
  $userID = $userInfo['user_id'];
  $userFname = $userInfo['Fname'];
  $userLname = $userInfo['Lname'];
  $getCartsCount = getCartsCount($conn);
  $id = $_GET['id'];
  $orderConnection = mysqli_query($conn,"SELECT * FROM prod where prod_id = $id");
  $prodInfo = mysqli_fetch_assoc($orderConnection);
  $commentConnection = mysqli_query($conn,"SELECT * FROM comments where comment_prod = $id");
  if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['comment'])){
    $commentText = $_POST['commentText'];
    if (strlen($commentText) == 0) {
      echo "Du måste skriva ett kommentar <br>";
    }
    else{
      $star = $_POST['star'];
    mysqli_query($conn, "INSERT into comments (comment_prod,comment_user_id,comment_user_Fname,comment_user_Lname,comment_rating,comment_text ) values ('$id','$userID','$userFname','$userLname','$star','$commentText')");
    header("location: prodview.php?id=$id");
  }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shop Online</title>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php  
  if (!isset($_SESSION['user_id'])){ 
    
  ?> 
  <a href="index.php">Hem</a>
  <a href="login.php">Logga in</a>
  <a href="signup.php">Registera</a>
  <a href="product.php">Produkter</a>
  <?php
   } else {
    echo "Hej, " . $userInfo['Fname'] . "";
  ?>
<a href="index.php">| Hem  </a>
    <a href="product.php">| Produkter</a>
    <a href="history.php">| Historik | </a>
    <a href="logout.php">Logga ut</a><br>
    <a href="cart.php">Varukorgen: <?php  echo $getCartsCount['total_count']; ?> </a><br> 
  <?php
   } 
   ?>
   <img src="cPanel/image/<?php echo $prodInfo["prod_image"];?>" style="width:350px;height:400px; ">
   <h2><?php echo $prodInfo['prod_title']?></h2>
   <h2><?php echo $prodInfo['prod_price']?> kr</h2>
   <?php 
  if ($prodInfo["prod_count"] == 0) {
    echo '<label>Antal i lager: Slut i lager</label> <br>';
    echo '<p>Beskrivning:' . $prodInfo['prod_des'] . '</p>';
  }
  else{
    echo '<label>Antal i lager:' . $prodInfo['prod_count'] .  '</label><br>';
    echo '<p>Beskrivning:' . $prodInfo['prod_des'] . '</p><br>';
    echo '<a href="cPanel/addtocart.php?id='. $prodInfo["prod_id"]. '&u= ' . $userInfo['user_id']. '">KÖP</a>';
  }
  ?>
   
   <h3>Recension</h3><br>
   <?php 
    if (isset($_SESSION['user_id'])){
      ?>
   <form method="post">
   <div class="rating">
  <input id="radio1" type="radio" name="star" value="5" class="star" />
  <label for="radio1">&#9733;</label>
  <input id="radio2" type="radio" name="star" value="4" class="star" />
  <label for="radio2">&#9733;</label>
  <input id="radio3" type="radio" name="star" value="3" class="star" />
  <label for="radio3">&#9733;</label>
  <input id="radio4" type="radio" name="star" value="2" class="star" />
  <label for="radio4">&#9733;</label>
  <input id="radio5" type="radio" name="star" value="1" class="star" />
  <label for="radio5">&#9733;</label>
</div><br><br><br>

   <textarea style="width: 400px; height:100px;" name="commentText"></textarea><br><br>
   <input type="submit" name="comment" value="Skicka"> <br><br>
   </form>
   <?php 
 }
   if ($commentConnection->num_rows > 0) {
    while ($row = $commentConnection->fetch_assoc()) {
       echo ' <label>' .$row['comment_user_Fname'] . ' ' . $row['comment_user_Lname']. ':</label><br><br>';
       for ($i=0; $i < $row['comment_rating'] ; $i++) { 
         echo '<label style="font-size: 20px; color: orange;">&#9733;</label>';
       }
       echo '<br>'. $row['comment_text'] . '<br>';
       echo '--------------------- <br>';
    }
  }

   ?>
   

</body>
</html>