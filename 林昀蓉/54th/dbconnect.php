<?php
$dbConnection = mysqli_connect("localhost","root","","54th");

//檢查連線是否成功
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

mysqli_set_charset($dbConnection, "utf8");
$dbConnection->query('SET time_zone = "+8:00"');