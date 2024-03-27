<?php
include_once 'dbconnect.php';
include_once 'header.php';
?>
<br>
<h1 id="tittle-2nd">
    <div id="cmt-tittle">訪客留言列表</div>
    <a href="../54th/new-comment.php" id="comment-link">新增留言</a>
</h1>

<?php
// 修改 SQL 查詢以按時間遞減排序
$commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment` ORDER BY `time` DESC");
$numRows = mysqli_num_rows($commentQ);
$i = $numRows; // 使用資料庫中的留言數作為起始值
while ($comment = mysqli_fetch_assoc($commentQ)) {

    echo '<div class="comment" id="' . $i . '"><p>'; // 在此設置 id 為 $i
    echo '訪客名稱 : '.$comment['name'].'<br/>';
    echo '訪客回饋 : '.$comment['comment'].'<br/>';
    echo '訪客電話 : '.$comment['phone'].'<br/>';
    echo '訪客電郵 : '.$comment['email'].'<br/>';
    echo '留言時間 : '.$comment['time'].'<br/>';
    ?>
    <form action="function.php?op=edit" method="post">
        <input type="hidden" name="comment_id" value="<?php echo $i; ?>">
        <input
        type="text"
        placeholder="輸入留言密碼"
        name="search"
        required><br/>
        <a href="edit-cmt.php?comment_id=<?php echo $i; ?>">編輯評論</a>
        <button type="reset" name="delete">重設</button><br/><br/>
    </form>
    <?php
    echo '</p></div>';
    $i--; // 以逆序遞減 $i 的值
}
include_once 'footer.php';
?>
