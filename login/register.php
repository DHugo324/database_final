<?php
$conn = require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = mysqli_real_escape_string($conn, $_POST["userid"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    // 檢查帳號是否重複
    $check = "SELECT * FROM user WHERE userid = '".$userid."'";
    $result = $db->query($check);

    if ($result->rowCount() == 0) {
        // 使用 password_hash 進行密碼加密
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (userid, password, username) VALUES ($userid, '".$hashed_password."', '".$username."')";

        if ($db->exec($sql)) {
            echo "註冊成功! 3 秒後將自動跳轉頁面<br>";
            echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
            header("refresh:3;url=index.php");
            exit;
        } else {
            echo "Error creating table: " . $db->errorInfo()[2];
        }
    } else {
        echo "該帳號已有人使用!<br>3 秒後將自動跳轉頁面<br>";
        echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
        header('HTTP/1.0 302 Found');
        header("refresh:3;url=register.html");
        exit;
    }
}

function function_alert($message) {
    echo "<script>alert('$message'); window.location.href='index.php';</script>";
    return false;
}
?>
