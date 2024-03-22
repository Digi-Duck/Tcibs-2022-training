<?php
include_once 'dbconnect.php';
include_once 'header.php';

// 重新查詢總計金額
$moneyQ = mysqli_query($dbConnection, "SELECT SUM(`money`) FROM `shoppingcar`");
$money = mysqli_fetch_assoc($moneyQ);
$tottle = $money['SUM(`money`)'];

?>
<br>
<a href="../54th/checkout.php" class="tittle">返回購物車</a><br>
<h1>總計：<?php echo $tottle ?>元</h1>

<form action="function.php?op=checkout" method="post">

<label for="name">你的稱呼:</label>
<input type="text" id="name" name="name"><br/>

<label for="email">你的電郵:</label>
<input type="email" id="email" name="email" require><br/>
<br>

<input input class="buyBtn" type="submit" value="確認結帳">
<input input class="buyBtn" type="reset" value="重設">

</form> 

<?php
include_once 'footer.php';
?> 