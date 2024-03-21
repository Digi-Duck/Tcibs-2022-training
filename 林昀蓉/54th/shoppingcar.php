<?php
include_once 'dbconnect.php';
include_once 'header.php';
$moneyQ = mysqli_query($dbConnection, "SELECT SUM(`money`) FROM `shoppingcar`;");
$money = mysqli_fetch_assoc($moneyQ);
$tottle = $money['SUM(`money`)'];
?>
<h1>您的購物車：</h1>
<?php
    $carQ = mysqli_query($dbConnection, "SELECT * FROM `shoppingcar`");
    while ($car = mysqli_fetch_assoc($carQ)) {
        echo '<div class="comment"><p>';
        echo '餐點名稱 : '.$car['food'].'<br/>';
        echo '餐點數量 : '.$car['quantity'].'<br/>';
        echo '小計 : '.$car['money'].'<br/>';
    }
?>
    <h1>
<?php
    echo '總計：',$tottle,'元';
?>
    </h1>
<nav>
    <a href="../54th/food.php" class="tittle">繼續購物</a>
    <a href="../54th/checkout.php" class="tittle">結帳</a><br>
</nav>
<?php
include_once 'footer.php';
?>