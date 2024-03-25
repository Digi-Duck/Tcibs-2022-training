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


if ($op == 'edit') {
    $i = $_POST['comment_id']; // 从表单中获取 $i 的值
    editcmt($i); // 将 $i 变量作为参数传递给 editcmt() 函数
}
function editcmt($i){
    global $dbConnection; 

    $commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment` WHERE `password` = '{$_POST['search']}'");
    $comment = mysqli_fetch_assoc($commentQ);

    $pwdQ = "SELECT `password` FROM `comment` WHERE `id`='$i'";
    $pwd = mysqli_query($dbConnection,$pwdQ);
    $row = mysqli_fetch_assoc($pwd); // 將 $row 變量更正為 $pwd

    if ($_POST['search'] == $row['password']){
        header('Location: http://localhost/54th/edit-cmt.php');
    }
    else{
        header('Location: http://localhost/54th/comment.php');
    }
}

if($op == 'shoppingCar') {
    shoppingCar();
}

function shoppingCar(){
    global $dbConnection;

    // 檢查是否有傳遞食物 id
    if(isset($_POST['food_id'])) {
        $foodid = $_POST['food_id'];

        $shoppingCarQ = mysqli_query($dbConnection, "SELECT `price`,`food` FROM `food` WHERE `img` = '$foodid'");
        $shoppingCar = mysqli_fetch_assoc($shoppingCarQ);
        $price = (int)$shoppingCar['price'];
        $quantity = (int)$_POST['quantity'];

        $sql = "INSERT INTO `54th`.`shoppingCar` (
            `food`, 
            `quantity`,
             `money`, 
             `time` 
             ) VALUES (
             '{$shoppingCar['food']}', 
             '{$_POST['quantity']}',
              $quantity*$price,
              '".date('Y-m-d H:i:s')."'
             )";

             if(mysqli_query($dbConnection, $sql))
             {
                 header('Location: http://localhost/54th/shoppingcar.php');
                 exit(); // 重定向後退出腳本
             }
             else{
                // 處理資料庫查詢失敗的情況
             }   
    } else {
        echo "No product ID provided!";
        exit(); // 如果沒有提供產品 ID，則退出腳本
    }
}
if($op == 'checkout') {
    checkout();
}
function checkout() {
    global $dbConnection;

    // 選擇購物車中的商品信息
    $carQ = mysqli_query($dbConnection, "SELECT * FROM `shoppingcar`");
    while ($car = mysqli_fetch_assoc($carQ)) {
        // 輸出購物車中的商品信息

        // 插入購物車中的商品信息到 `checkout` 表
        $sql = "INSERT INTO `54th`.`checkout` (
                    `name`, 
                    `email`,
                    `food`, 
                    `quantity`, 
                    `money`, 
                    `time` 
                ) VALUES (
                    ?, ?, ?, ?, ?, ?
                )";
        $stmt = mysqli_prepare($dbConnection, $sql);
        mysqli_stmt_bind_param($stmt, 'sssiis', $_POST['name'], $_POST['email'], $car['food'], $car['quantity'], $car['money'], date('Y-m-d H:i:s'));
        mysqli_stmt_execute($stmt);

        // 檢查插入操作是否成功
        if(mysqli_stmt_affected_rows($stmt) > 0) {
            // 插入成功
        } else {
            // 插入失敗
        }
        // 釋放資源
        mysqli_stmt_close($stmt);
    }
    // 清空購物車
    mysqli_query($dbConnection, "DELETE FROM `shoppingcar`");
    // 重定向到訂單完成頁面
    header('Location: http://localhost/54th/ordercomplete.php');
    exit(); // 重定向後退出腳本
}
?>