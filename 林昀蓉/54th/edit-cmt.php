<?php 
include_once('dbconnect.php');  
include_once('header.php'); 
include_once('new-cmt-header.php'); 
echo '<h1>查詢留言並編輯</h1>';
?>

    <form action="function.php?op=search" method="post">
		<input
			type="text"
			placeholder="輸入留言密碼"
			name="search"
			required>
		<button type="submit" name="submit">查詢</button><br/><br/>
	</form>

<?php
include_once('footer.php'); 
?>