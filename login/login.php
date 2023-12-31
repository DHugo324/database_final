<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $_POST["username"];
$password = $_POST["password"];

// 使用 prepared statement 防範 SQL 注入
$stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row['id'];
        $_SESSION["username"] = $row['username'];
        header("location: welcome.php");
    } else {
        function_alert("帳號或密碼錯誤");
    }
} else {
    function_alert("帳號或密碼錯誤");
}

function function_alert($message) {
    echo "<script>alert('$message'); window.location.href='index.php';</script>";
    return false;
}
?>
