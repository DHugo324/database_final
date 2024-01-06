<?php
include_once "../db/condb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $password = $_POST["password"];
    $username = $_POST["username"];


    // 使用 password_hash 進行密碼加密
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO user (userid, password, username) VALUES (?, ?, ?)");
        $stmt->execute(array($userid, $hashed_password, $username));
        echo "註冊成功！ 3 秒後將自動跳轉頁面<br>";
        echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=index.php");
        exit;
    } catch (PDOException $error) {
        echo "註冊失敗： " . $error->getMessage() . " 請嘗試其他userid<br>";
        echo "<a href='register.php'>返回註冊頁面請點擊此</a>";
        header("refresh:5;url=register.php");
        exit;
    }
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>會員註冊</title>
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
    <script>

        function validateForm() {
            var x = document.forms["registerForm"]["password"].value;
            var y = document.forms["registerForm"]["password_check"].value;
            if (x.length < 6) {
                alert("密碼長度不足");
                return false;
            }
            if (x != y) {
                alert("請確認密碼是否輸入正確");
                return false;
            }
        }
    </script>

</head>

<body>
    <main
        style="width:100%; height:100%; display: flex; flex-direction: column; align-items: center; background-color: #f4f4f4; justify-content: center;">
        <h1>CS_hub</h1>
        <section>
            <form name="registerForm" method="post" action="register.php" onsubmit="return validateForm()">
                <table>
                    <tr>
                        <td>帳號：</td>
                        <td><input type="text" name="userid" required></td>
                    </tr>
                    <tr>
                        <td>密碼：</td>
                        <td><input type="password" name="password" id="password" required></td>
                    </tr>
                    <tr>
                        <td>確認密碼：</td>
                        <td><input type="password" name="password_check" id="password_check" required></td>
                    </tr>
                    <tr>
                        <td>使用者名稱：</td>
                        <td><input type="text" name="username" required></td>
                    </tr>
                </table>
                <input type="submit" value="註冊" name="submit">
                <input type="reset" value="重設" name="reset">
            </form>
            <a href="index.php">已有帳號？前往登入頁面</a>
        </section>
    </main>
</body>

</html>