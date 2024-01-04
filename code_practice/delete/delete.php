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
    echo "<a href='../../account/index.php'>未成功跳轉頁面請點擊此</a>";
    echo "或是<a href='../../home.php'>返回首頁</a>";
    header("refresh:3;url=../../account/index.php");
    return false;
}

include_once("../../db/condb.php");

$id = $_GET['id'];
$sql = "SELECT * FROM code_practice WHERE id = ?";
if ($stmt = $db->prepare($sql)) {
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    if ($result[0]['userid'] !== $_SESSION["userid"]) {
        echo "您不是擁有者！ 3 秒後將自動跳轉頁面<br>";
        echo "<a href='../../user/user.php'>未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=../../user/user.php");
        exit;
    }
}
$sql = "DELETE FROM code_practice WHERE id = ?";
if ($stmt = $db->prepare($sql)) {
    $success = $stmt->execute(array($id));
    if ($success) {
        echo "刪除成功! 3 秒後將自動跳轉頁面<br>";
        echo "<a href='../../user/user.php'>未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=../../user/user.php");
        exit;
    } else {
        echo "刪除失敗： " . $db->errorInfo()[2];
        echo "回報BUG請至此：<a href='../../contact/index.php'>";
        header("refresh:5;url=../../user/user.php");
    }
}
?>