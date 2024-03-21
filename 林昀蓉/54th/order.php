<?php
include_once 'dbconnect.php';
include_once 'header.php';

// 檢查是否有傳遞 id 參數
if(isset($_GET['id'])) {
    $foodid = $_GET['id'];

    // 從資料庫中獲取食物名稱
    $foodQ = mysqli_query($dbConnection, "SELECT `food` FROM `food` WHERE `img` = '$foodid'");
    $food = mysqli_fetch_assoc($foodQ);
    $foodname = $food['food'];
} else {
    echo "No product ID provided!";
    exit(); // 如果沒有提供產品 ID，則退出腳本
}

?>

<form action="function.php?op=shoppingCar" method="post">
  <br><br>
  <label for="food_name">預定產品名稱 </label>
  <input type="hidden" id="food_id" name="food_id" value="<?php echo $foodid;?>">
  
  <h2><?php echo $foodname;?></h2>

  <label for="quantity">購買數量:</label>
  <input type="number" id="quantity" name="quantity" min="1" max="5" value="1">
  
  <br><br>
  <input class="buyBtn" type="submit" value="加入購物車">

</form>

<?php
include_once 'footer.php';
?>