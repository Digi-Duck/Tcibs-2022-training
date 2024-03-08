<?php
include_once 'dbconnect.php';
include_once 'header.php';
include_once 'new-cmt-header.php';
?>

<form action="function.php?op=newcomment" method="post">
  
    <label for="name">您的稱呼:</label>
    <input type="text" id="name" name="name"><br/>

    <label for="comment">您的留言:</label>
    <input type="text" id="comment" name="comment"><br/>

    <label for="phone">您的電話:</label>
    <input type="text" id="phone" name="phone"><br/>
  
    <label for="email">您的電郵:</label>
    <input type="email" id="email" name="email" require><br/>

    <label for="password">您的留言密碼(用於編輯留言):</label>
    <input type="text" id="password" name="password" require><br/>
    
    <br>
    <input input class="buyBtn" type="submit" value="送出">
    <input input class="buyBtn" type="reset" value="重設">
    </form> 
 

<?php
include_once 'footer.php';
?>