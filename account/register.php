<?php
include_once "../db/condb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $password = $_POST["password"];
    $username = $_POST["username"];


    // 檢查帳號是否重複
    $check = "SELECT * FROM user WHERE userid = '" . $userid . "'";
    $result = $db->query($check);

    if ($result->rowCount() == 0) {
        // 使用 password_hash 進行密碼加密
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO user (userid, password, username) VALUES (?, ?, ?)");
        $success = $stmt->execute(array($userid, $hashed_password, $username));

        if ($success) {
            echo "註冊成功！ 3 秒後將自動跳轉頁面<br>";
            echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
            header("refresh:3;url=index.php");
            exit;
        } else {
            echo "Error creating table: " . $db->errorInfo()[2];
        }
    } else {
        echo "該帳號已有人使用！<br>3 秒後將自動跳轉頁面<br>";
        echo "<a href='register.php'>未成功跳轉頁面請點擊此</a>";
        header('HTTP/1.0 302 Found');
        header("refresh:3;url=register.php");
        exit;
    }
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>會員註冊</title>
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
    <h1>註冊頁面</h1>
    <form name="registerForm" method="post" action="register.php" onsubmit="return validateForm()">
        帳 號：
        <input type="text" name="userid" required><br /><br />
        密 碼：
        <input type="password" name="password" id="password" required><br /><br />
        確認密碼：
        <input type="password" name="password_check" id="password_check" required><br /><br />使用者名稱：
        <input type="text" name="username" required><br><br>
        <input type="submit" value="註冊" name="submit">
        <input type="reset" value="重設" name="reset">
    </form>
    <a href="index.php">已有帳號？前往登入頁面</a>
</body>

</html>