<?php
include_once 'dbconnect.php';
include_once 'header.php';
$foodQ = mysqli_query($dbConnection, "SELECT * FROM `food`");
$food = mysqli_fetch_assoc($foodQ);
?>
<form action="/functions.php?op=createOrder" method="post">
  <br><br>
  <label for="food_name">預定產品名稱 </label>
  <input type="hidden" id="food_id" name="food_id" value="<?php echo $food['id'];?>">
  
  <h2><?php echo $food['food'];?></h2>

  <label for="name">你的稱呼:</label>
  <input type="text" id="name" name="name"><br/>

  <label for="email">你的電郵:</label>
  <input type="email" id="email" name="email" require><br/>

  <label for="quantity">購買數量:</label>
  <input type="number" id="quantity" name="quantity" min="1" max="5" value="1">
  
  <br>
  <input class="buyBtn" type="submit" value="加入購物車">

</form>
<?php
include_once 'footer.php';
?>