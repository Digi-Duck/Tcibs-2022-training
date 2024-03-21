<?php 
include_once('dbconnect.php'); 
include_once('header.php'); 
echo '<br>';
echo '<br>';
?>
<a href="../54th/shoppingcar.php" class="buyBtn">查看購物車</a><br>
<?php
$foodQ = mysqli_query($dbConnection, "SELECT * FROM `food`");
while ($food = mysqli_fetch_assoc($foodQ)) {
    echo '<div class="col">
    <img src="../54th/img/'.$food['img'].'" >
    <p>
    名稱：'.$food['food'].'<br>
    價格：$'.$food['price'].'<br>       
    <a href="../54th/order.php?id='.$food['img'].'" class="buyBtn">預訂'.$food['food'].'</a><br><br>
    </div>';
}
include_once('footer.php'); 
?>