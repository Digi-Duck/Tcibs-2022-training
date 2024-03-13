<?php
include_once 'dbconnect.php';
include_once 'header.php';
?>
    <br>
    <h1 id="tittle-2nd">
        <div id="cmt-tittle">訪客留言列表</div>
        <a href="../54th/new-comment.php" id="comment-link">新增留言</a>
        <a href="../54th/edit-cmt.php" id="comment-link">留言編輯</a><br>
    </h1>

<?php
    $i="a1";
    $commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment`");
    while ($comment = mysqli_fetch_assoc($commentQ)) {
        global $i; 
        $i;
        echo '<div class="comment"><p>';
        echo '訪客名稱 : '.$comment['name'].'<br/>';
        echo '訪客回饋 : '.$comment['comment'].'<br/>';
        echo '訪客電話 : '.$comment['phone'].'<br/>';
        echo '訪客電郵 : '.$comment['email'].'<br/>';
        echo '留言時間 : '.$comment['time'].'<br/>';
        ?>
        <form action="function.php?op=edit" method="post">
        <input
			type="text"
			placeholder="輸入留言密碼"
			name="search";
            id= "<?php echo $i;?>";
			required><br/>
            <button type="submit" name="edit">編輯</button>
            <button type="reset" name="delete">重設</button><br/><br/>
        </form>
        <?php
        echo $i;
        echo '</p></div>';
        $i++;
    }
include_once 'footer.php';
?>
