<?php 
include_once('dbconnect.php');  
include_once('header.php'); 
?><br>
<h1>編輯評論</h1>
<?php
if (isset($_GET['comment_id'])) {
    $i = $_GET['comment_id'];
    // 使用 $i 來執行您的操作
    $editQ = mysqli_query($dbConnection, "SELECT * FROM `comment` WHERE `id` = '".$i."' ");
    while ($edit = mysqli_fetch_assoc($editQ)) {
        ?>
        <form action="function.php?op=editcmt&comment_id=<?php echo $i; ?>" method="post"><?php
        echo '<div class="comment"><p>';
        echo '名稱 : '.$edit['name'].'<br/>';?>
        <label for="name">更改稱呼:</label>
        <input type="text" id="name" name="name" value="<?php echo $edit['name']; ?>"><br/><br>
        <?php
        echo '留言 : '.$edit['comment'].'<br/>';?>
        <label for="comment">更改留言:</label>
        <input type="text" id="comment" name="comment" value="<?php echo $edit['comment']; ?>"><br/><br>
        <?php
        echo '電話 : '.$edit['phone'].'<br/>';?>
        <label for="phone">更改電話:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $edit['phone']; ?>"><br/><br>
        <?php
        echo '訪客電郵 : '.$edit['email'].'<br/>';?>
        <label for="email">更改電郵:</label>
        <input type="email" id="email" name="email" value="<?php echo $edit['email']; ?>" required><br/><br>
        <?php
        echo '留言時間 : '.$edit['time'].'<br/>';?>
        <?php
        echo '</p></div>';?>
        <button type="submit" name="edit">編輯</button>
        <button type="reset" name="delete">重設</button><br/><br/>
        </form>
        <?php
    }
} else {
    echo "No comment ID provided.";
}
include_once('footer.php'); 
?>