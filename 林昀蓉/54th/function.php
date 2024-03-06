<?php
include_once 'dbconnect.php';

$op ='none';
if(isset($_GET['op'])) $op = $_GET['op'];

if($op=='checkLogin')
{
    checkLogin($_POST['account'],$_POST['password']);
}
function checkLogin($account, $password)
{
    global $dbConnection;
    $loginQ = mysqli_query($dbConnection, "SELECT * FROM `login` WHERE `account`='".$account."'");

    $login = mysqli_fetch_assoc($loginQ);

    if($account == $login['account'] && $password == $login['password'])
    {
        session_start();
        $_SESSION['account'] = $account;
        header('Location: http://localhost/54th/staff.php');
    }
    else
    {   
        header('Location: http://localhost/54th/login.php');
    }
}

if($op=='newcomment')
{
    newcomment();
}
function newcomment(){

    global $dbConnection;

    //儲存留言
    $sql = "INSERT INTO `54th`.`comment` (
        `name`, 
        `comment`,
         `phone`, 
         `email`, 
         `password`,
         `time`
         ) VALUES (
         '{$_POST['name']}', 
         '{$_POST['comment']}',
         '{$_POST['phone']}',
         '{$_POST['email']}',
         '{$_POST['password']}',
         '".date('Y-m-d H:i:s')."'
         )";

    //寫入MySQL資料庫
    if(mysqli_query($dbConnection, $sql))
    {
        header('Location: http://localhost/54th/new-comment.php');
    }
    else{

    }
   
}
if($op=='reset')
{
    header('Location: http://localhost/54th/new-comment.php');
}

if($op=='search')
{
    search();
}
function search(){
    global $dbConnection; 

     // Escape the search string and trim
     // all whitespace
     $searchString = mysqli_real_escape_string($dbConnection, trim(htmlentities($_POST['search'])));

     // Check for empty strings and non-alphanumeric
     // characters.
     // Also, check if the string length is less than
     // three. If any of the checks returns "true",
     // return "Invalid search string", and
     // kill the script.
     if ($searchString === "" || !ctype_alnum($searchString) ) {
         echo "Invalid search string";
         exit();
     }

     // We are using a prepared statement with the
     // search functionality to prevent SQL injection.
     // So, we need to prepend and append the search
     // string with percent signs
     $searchString = "%$searchString%";

     // The prepared statement
     $sql = "SELECT * FROM comment WHERE password LIKE ?";

     // Prepare, bind, and execute the query
     $prepared_stmt = $dbConnection->prepare($sql);
     $prepared_stmt->bind_param('s', $searchString);
     $prepared_stmt->execute();

     // Fetch the result
     $result = $prepared_stmt->get_result();

     if ($result->num_rows === 0) {
         // No match found
         echo "No match found";
         // Kill the script
         exit();

     } else {
         // Process the result(s)
         while ($row = mysqli_fetch_assoc($result)) {
            include_once 'new-cmt-header.php';
            echo '<h1>您的留言：</h1>';
            echo '<div class="edit-cmt">';
            echo '您的名稱 : '.$row['name'];
            ?>
            <form action="function.php?op=edit-cmt" method="post">
                <input type="text" id="name" name="name" placeholder="修改名稱"><br/>
                <br/>
            <?php
            echo '您的留言 : '.$row['comment'].'<br/>';
            ?>
                <input type="text" id="comment" name="comment" placeholder="修改留言"><br/>
                <br/>
            <?php
            echo '您的電話 : '.$row['phone'].'<br/>';
            ?>
                <input type="text" id="phone" name="phone" placeholder="修改電話"><br/>
                <br/>
            <?php
            echo '您的電郵 : '.$row['email'].'<br/>';
            ?>
                <input type="text" id="phone" name="phone" placeholder="修改電郵"><br/>
                <br/>
            <br>
            <input input class="buyBtn" type="submit" value="送出">
            </form>
            <form action="function.php?op=reset1" method="post">
            <input input class="buyBtn" type="submit" value="重設">
            </form> 
            <?php
            echo '留言時間 : '.$row['time'];
            echo '</p></div>';

         } // end of while loop
     } // end of if($result->num_rows)

    }
?>