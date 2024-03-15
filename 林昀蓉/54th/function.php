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


if($op=='search')
{
    search();
}
function search(){
    global $dbConnection; 

    $searchString = mysqli_real_escape_string($dbConnection, trim(htmlentities($_POST['search'])));

     if ($searchString === "" || !ctype_alnum($searchString) ) {
         echo "Invalid search string";
         exit();
     }

    //  $searchString = "%$searchString%";

     $sql = "SELECT * FROM comment WHERE password LIKE ?";

     $prepared_stmt = $dbConnection->prepare($sql);
     $prepared_stmt->bind_param('s', $searchString);
     $prepared_stmt->execute();

     
     $result = $prepared_stmt->get_result();

     if ($result->num_rows === 0) {
         
         echo "No match found";
         
         exit();

     } else {
         
         while ($row = mysqli_fetch_assoc($result)) {
            include_once('dbconnect.php');  
            include_once('header.php'); 
            include_once('new-cmt-header.php'); 
            include_once('edit-part.php');
            // header('Location: http://localhost/54th/edit-cmt2.php');
            echo '<h1>您的留言：</h1>';
            echo '<div class="edit-cmt">';
            echo '您的名稱 : '.$row['name'];

            // $cmtid = " SELECT `id` FROM `comment` WHERE `name` = '{$row['name']}' ";
            // $prepared_stmt->bind_param('s', $cmtid);
            // $prepared_stmt->execute();

            ?>
            <form action="function.php?op=edit-cmt" method="post">
            <?php
                $search = $_POST['search'];
            ?>
                <input type="text" id="name1" name="name1" placeholder="修改名稱"><br/>
                <br/>
            <?php
            echo '您的留言 : '.$row['comment'].'<br/>';
            ?>
                <input type="text" id="comment1" name="comment1" placeholder="修改留言"><br/>
                <br/>
            <?php
            echo '您的電話 : '.$row['phone'].'<br/>';
            ?>
                <input type="text" id="phone1" name="phone1" placeholder="修改電話"><br/>
                <br/>
            <?php
            echo '您的電郵 : '.$row['email'].'<br/>';
            ?>
                <input type="text" id="email1" name="email1" placeholder="修改電郵"><br/>
                <br/>
            <?php
            echo '留言時間 : '.$row['time'];
            echo '</p></div>';
            ?>
                <br>
            <input input class="buyBtn" type="submit" value="送出">
            <input input class="buyBtn" type="reset" value="重設">
            </form>
            <?php
             
            include_once('footer.php'); 
        }
    }
}

if($op=='edit')
{
    editcmt();
}
function editcmt(){
    global $dbConnection; 
    global $i; 
    $a=$i;
    $commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment` WHERE `password` = '{$_POST['search']}'");
    $comment = mysqli_fetch_assoc($commentQ);

    $pwd = "SELECT `password` FROM `comment` WHERE `id`='$a'";
    $result = mysqli_query($dbConnection,$pwd);
    $row = mysqli_fetch_assoc($result);
    print_r($row);
    echo $_POST['search'];
    echo $a;

    
    // if ($_POST['search'] == $row['password']){
    //     header('Location: http://localhost/54th/edit-cmt.php');
    // }
    // else{
    //     header('Location: http://localhost/54th/comment.php');
    // }
}
if($op=='creatOrder'){
    creatOrder();
}
function creatOrder(){
    global $dbConnection;
    $sql = "INSERT INTO `54th`.`food` (
        `food`, 
        ``,
         `quantity`, 
         `order_time`, 
         `gem_id`
         ) VALUES (
         '{$_POST['name']}', 
         '{$_POST['email']}',
         {$_POST['quantity']}, 
         '".date('Y-m-d H:i:s')."',
         {$_POST['gem_id']})";
}
?>
