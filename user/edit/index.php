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
    header("refresh:3;url=../account/index.php");
    return false;
}
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改資料</title>
    <style>
        input[type=submit] {
            padding: 5px 10px;
            background-color: #5cb85c;
            color: white;
            font-weight: bold;
            font-size: large;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #449d44;
        }

        input[type=reset] {
            padding: 5px 10px;
            background-color: #FF0000;
            color: white;
            font-weight: bold;
            font-size: large;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=reset]:hover {
            background-color: #CC0000;
        }
    </style>
</head>

<body>
    <div>
        <img src="../../image/back.png" title="返回" width="50px" height="50px" style="cursor: pointer;"
            onclick="window.location.href='../user.php'">
    </div>
    <main style="width:100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h1>修改用戶資料</h1>
        <form method="post" action="edit.php">
            <table>
                <tbody>
                    <tr>
                        <td>使用者ID：</td>
                        <td><input type="text" name="userid" value="<?php echo $userid; ?>" required></td>
                    </tr>
                    <tr>
                        <td>使用者名稱：</td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>" required></td>
                    </tr>
                    <tr>
                        <td>密碼：</td>
                        <td><input type="password" name="password" required></td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align: center;">
                <input type="submit" value="確認修改" name="submit">
                <input type="reset" value="重設" name="reset">
            </div>
        </form>
    </main>
</body>

</html>