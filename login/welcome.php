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
    <h1>你好，<?php echo $username; ?></h1>
    <a href="logout.php">登出</a>
</body>

</html>
