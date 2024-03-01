<?php include_once('header.php'); ?>

<form action="function.php?op=checkLogin" method="post">
    
    <br>
    <h1>管理員登入</h1>

    <label for="account">帳號:</label>
    <input type="account" id="account" name="account" require><br>
    <br>
    <label for="account">密碼:</label>
    <input type="password" id="password" name="password">
  
    <br>
    <br>
    <input type="submit" value="登入">
</form> 

<?php include_once('footer.php'); ?>