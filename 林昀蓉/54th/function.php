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
?>