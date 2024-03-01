<?php
include_once 'dbconnect.php';
include_once 'header.php';
?>
<br>
    <h1 id="tittle-2nd">訪客留言-新增
        <a href="../54th/comment.php" id="new-comment">回留言列表</a><br>
    </h1><br>

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
    </form> 

    <form action="function.php?op=reset" method="post">
    <input input class="buyBtn" type="submit" value="重設">
    </form> 

<?php
include_once 'footer.php';
?>