<?php 
global $row; 
global $prepared_stmt; 
global $result; 
global $prepared_stmt; 
$result = $prepared_stmt->get_result();
while ($row = mysqli_fetch_assoc($result)) {
include_once('dbconnect.php');  
include_once('header.php'); 
include_once('new-cmt-header.php'); 
include_once('edit-part.php');
echo '<h1>您的留言：</h1>';
echo '<div class="edit-cmt">';
echo '您的名稱 : '.$row['name'];
?>
<form action="function.php?op=edit-cmt" method="post">
<?php
                
?>
    <input type="text" id="name1" name="name1" placeholder="修改名稱"><br/>
    <br/>
<?php
echo '您的留言 : '.$row['comment'].'<br/>';
?>
    <input type="text" id="comment1" name="comment1" placeholder="修改留言"><br/>
    <br/>
<?php
echo '您的電話 : '.$row['phone'].'<br/>';
?>
    <input type="text" id="phone1" name="phone1" placeholder="修改電話"><br/>
    <br/>
<?php
echo '您的電郵 : '.$row['email'].'<br/>';
?>
    <input type="text" id="email1" name="email1" placeholder="修改電郵"><br/>
    <br/>
<?php
echo '留言時間 : '.$row['time'];
echo '</p></div>';
?>
    <br>
<input input class="buyBtn" type="submit" value="送出">
</form>
<form action="function.php?op=reset1" method="post">
<input input class="buyBtn" type="submit" value="重設">
</form> 
<?php
include_once('footer.php'); 
}
?>