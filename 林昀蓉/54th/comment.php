<?php
include_once 'dbconnect.php';
include_once 'header.php';
?>
    <br>
    <h1 id="tittle-2nd">訪客留言列表
        <a href="../54th/new-comment.php" id="comment-link">新增留言</a><br>
        <a href="../54th/edit-cmt.php" id="comment-link">留言編輯</a>
    </h1>

<?php

    $commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment`");

    while ($comment = mysqli_fetch_assoc($commentQ)) {
    
        echo '<div class="comment"><p>';
        echo '訪客名稱 : '.$comment['name'].'<br/>';
        echo '訪客回饋 : '.$comment['comment'].'<br/>';
        echo '訪客電話 : '.$comment['phone'].'<br/>';
        echo '訪客電郵 : '.$comment['email'].'<br/>';
        echo '留言時間 : '.$comment['time'].'<br/>';
        echo '</p></div>';
    
    }
include_once 'footer.php';
?>
