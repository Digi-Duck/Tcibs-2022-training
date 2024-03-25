<?php 
include_once('dbconnect.php');  
include_once('header.php'); 
?>
<a href="edit-cmt.php?comment_id=<?php echo $i; ?>">編輯評論</a>
<?php
if (isset($_GET['comment_id'])) {
    $i = $_GET['comment_id'];
    // 在此处使用 $i 變數
}
include_once('footer.php'); 
?>  