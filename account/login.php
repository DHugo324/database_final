<?php
include_once "../db/condb.php";

// Define variables and initialize with empty values
$userid = $_POST["userid"];
$password = $_POST["password"];

// 使用 prepared statement 防範 SQL 注入
$stmt = $db->prepare("SELECT userid, password, username FROM user WHERE userid = ?");
$stmt->execute(array($userid));

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["userid"] = $row['userid'];
        $_SESSION["username"] = $row['username'];
        header("location: ../index.php");
    } else {
        function_alert("帳號或密碼錯誤");
        exit;
    }
} else {
    function_alert("無此帳號");
    exit;
}

function function_alert($message)
{
    echo "<script>alert('$message'); window.location.href='index.php';</script>";
    return false;
}
?>