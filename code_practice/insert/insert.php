<?php
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

$title = $_POST["title"];
$description = $_POST["description"];
$topic = $_POST["topic"];
$course_name = $_POST["course_name"];
$url = $_POST["url"];
$userid = $_SESSION['userid'];

if ($stmt = $db->prepare("INSERT INTO code_practice (title, description, topic, course_name, url, userid) VALUES (?, ?, ?, ?, ?, ?)")) {
    $success = $stmt->execute(array($title, $description, $topic, $course_name, $url, $userid));
    if ($db->exec($sql)) {
        echo "新增成功! 3 秒後將自動跳轉頁面<br>";
        echo "<a href='../../user/user.php'>未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=../../user/user.php");
        exit;
    } else {
        echo "新增失敗： " . $db->errorInfo()[2];
        echo "回報BUG請至此：<a href='../../contact/index.php'>";
        header("refresh:5;url=../../user/user.php");
    }
}
?>