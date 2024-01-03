<?php
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

$conn = include_once("../../db/condb.php");

$title = $_POST["title"];
$description = $_POST["description"];
$topic = $_POST["topic"];
$course_name = $_POST["course_name"];
$url = $_POST["url"];
$userid = $_SESSION['userid'];

$sql = "INSERT INTO code_practice (title, description, topic, course_name, url, userid) 
            VALUES ('" . $title . "', '" . $description . "', '" . $topic . "', '" . $course_name . "', '" . $url . "', '" . $userid . "')";

if ($db->exec($sql)) {
    echo "新增成功! 3 秒後將自動跳轉頁面<br>";
    echo "<a href='../code_practice.php'>未成功跳轉頁面請點擊此</a>";
    header("refresh:3;url=../code_practice.php");
    exit;
} else {
    echo "新增失敗： " . $db->errorInfo()[2];
}
?>