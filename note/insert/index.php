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
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>新增介面</title>
</head>

<body>
    <h1>新增筆記</h1>
    <form method="post" action="insert.php">
        標題：
        <input type="text" name="title" required><br><br>
        描述：
        <input type="text" name="description"><br><br>
        主題：
        <input type="text" name="topic"><br><br>
        課程名稱：
        <input type="text" name="course_name"><br><br>
        網址：
        <input type="url" name="url"><br><br>
        <input type="submit" value="新增" name="submit">
        <input type="reset" value="重設" name="reset">
    </form>
    <a href="../note.php">返回</a>
</body>

</html>