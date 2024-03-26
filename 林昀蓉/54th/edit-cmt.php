<?php 
include_once('dbconnect.php');  
include_once('header.php'); 
?><br>
<h1><a>編輯評論</a></h1>
<?php
if (isset($_GET['comment_id'])) {
    $i = $_GET['comment_id'];
    $editQ = mysqli_query($dbConnection, "SELECT * FROM `comment` WHERE `id` = '".$i."' ");
    while ($edit = mysqli_fetch_assoc($editQ)) {
        ?>
        <form action="function.php?op=newcomment" method="post"><?php
        echo '<div class="comment"><p>';
        echo '名稱 : '.$edit['name'].'<br/>';?>
        <label for="name">更改稱呼:</label>
        <input type="text" id="name" name="name"><br/>
        <?php
        echo '留言 : '.$edit['comment'].'<br/>';?>
        <label for="comment">更改留言:</label>
        <input type="text" id="comment" name="comment"><br/>
        <?php
        echo '電話 : '.$edit['phone'].'<br/>';?>
        <label for="phone">更改電話:</label>
        <input type="text" id="phone" name="phone"><br/>
        <?php
        echo '訪客電郵 : '.$edit['email'].'<br/>';?>
        <label for="email">更改電郵:</label>
        <input type="email" id="email" name="email" require><br/>
        <?php
        echo '留言時間 : '.$edit['time'].'<br/>';?>
        <?php
        echo '</p></div>';?>
        <button type="submit" name="edit">編輯</button>
        <button type="reset" name="delete">重設</button><br/><br/>
        </form>
        <?php
    }
}

include_once('footer.php'); 
?>  