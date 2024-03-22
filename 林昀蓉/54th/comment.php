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
    $commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment`");
    $i = 1;
    while ($comment = mysqli_fetch_assoc($commentQ)) {
        
        echo '<div class="comment" id="' . $i . '"><p>'; // 在此設置 id 為 $i
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
            name="search"
            id="<?php echo $i; ?>"
            required><br/>
        <button type="submit" name="edit">編輯</button>
        <button type="reset" name="delete">重設</button><br/><br/>
        </form>
        <?php
        echo '</p></div>';
        $i++; // 增加 $i 的值
    }
include_once 'footer.php';
?>
