<?php
session_start();

// 登入檢查
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>歡迎</title>
</head>

<body>
    <h1>你好，
        <?php echo $username; ?>
    </h1>
    <a href="logout.php">登出</a>
    <a href="../code_practice/insert/index.php">前往新增程式練習頁面</a>
    <a href="../note/insert/index.php">前往新增筆記頁面</a>
</body>

</html>