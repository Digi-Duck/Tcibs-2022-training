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
    $i = $_POST['search']; // 從表單中獲取 $i 的值
    editcmt($i); // 將 $i 變量作為參數傳遞給 editcmt() 函數
}
function editcmt($i){
    global $dbConnection; 

    $commentQ = mysqli_query($dbConnection, "SELECT * FROM `comment` WHERE `password` = '{$_POST['search']}'");
    $comment = mysqli_fetch_assoc($commentQ);

    $pwdQ = "SELECT `password` FROM `comment` WHERE `id`='$i'";
    $pwd = mysqli_query($dbConnection,$pwdQ);
    $row = mysqli_fetch_assoc($pwd);
    if ($row) {
        // $row 變量不為空值，請確保它包含您預期的數據
        print_r($row);
    } else {
        // $row 變量為空值，請檢查您的查詢和數據庫中的數據
        echo "No data found for id: $i";
    }

    // if ($_POST['search'] == $row['password']){
    //     header('Location: http://localhost/54th/edit-cmt.php');
    // }
    // else{
    //     header('Location: http://localhost/54th/comment.php');
    // }
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
function checkout(){
    global $dbConnection;
    $carQ = mysqli_query($dbConnection, "SELECT * FROM `shoppingcar`");
    while ($car = mysqli_fetch_assoc($carQ)){
        print_r($car);
        $sql = "INSERT INTO `54th`.`checkout` (
            `name`, 
            `email`,
             `food`, 
             `quantity`, 
             `money`, 
             `time` 
             ) VALUES (
             '{$_POST['name']}', 
             '{$_POST['email']}', 
             '{$car['food']}', 
             '{$car['quantity']}',
             '{$car['money']}', 
              '".date('Y-m-d H:i:s')."'
             )";
             if(mysqli_query($dbConnection, $sql)) {
                // 插入成功
            } else {
                // 插入失敗
            }
    }
    header('Location: http://localhost/54th/ordercomplete.php');
    exit(); // 重定向後退出腳本
}
?>