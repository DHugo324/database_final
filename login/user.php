<?php
session_start();

// 登入檢查
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    login_alert();
    exit;
}
function login_alert()
{
    echo "請先登入! 3 秒後將自動跳轉登入頁面<br>";
    echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
    echo "或是<a href='../home.php'>返回首頁</a>";
    header("refresh:3;url=index.php");
    return false;
}

$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>用戶頁面</title>
    <style>
        .add {
            padding: 5px 10px;
            background-color: #5cb85c;
            color: white;
            font-weight: bold;
            font-size: large;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add:hover {
            background-color: #77c477;
        }
    </style>
</head>

<body>
    <!-- <header>
        <a href="../index.html">首頁</a>
        <a href="logout.php">登出</a>
    </header> -->
    <h1>你好，
        <?php echo $username; ?>
    </h1>
    <div>
        <h2>我的筆記 <button class="add" onclick="window.location.href = '../note/insert/index.php'">新增</button>
        </h2>
        <div></div>
    </div>
    <hr>
    <div>
        <h2>我的程式練習 <button class="add" onclick="window.location.href = '../code_practice/insert/index.php'">新增</button>
        </h2>
        <div></div>
    </div>
    <hr>
</body>

</html>