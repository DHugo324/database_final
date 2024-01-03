<?php
// Initialize the session
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    login_alert();
    exit;
}
function login_alert()
{
    echo "請先登入! 3 秒後將自動跳轉登入頁面<br>";
    echo "<a href='../../login/index.php'>未成功跳轉頁面請點擊此</a>";
    echo "或是<a href='../../index.html'>返回首頁</a>";
    header("refresh:3;url=../../login/index.php");
    return false;
}
?>