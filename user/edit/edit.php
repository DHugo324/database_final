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
    echo "<a href='../../account/index.php'>未成功跳轉頁面請點擊此</a>";
    echo "或是<a href='../../home.php'>返回首頁</a>";
    header("refresh:3;url=../../account/index.php");
    return false;
}

include_once("../../db/condb.php");

$olduserid = $_SESSION["userid"];
$newuserid = $_POST["userid"];
$username = $_POST["username"];
$password = $_POST["password"];

// 使用 prepared statement 防範 SQL 注入
$stmt = $db->prepare("SELECT userid, password FROM user WHERE userid = ?");
$stmt->execute(array($olduserid));

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $row['password'])) {
        try {
            if ($stmt = $db->prepare("UPDATE user SET username = ?, userid = ? WHERE userid = ?")) {
                $success = $stmt->execute(array($username, $newuserid, $olduserid));
                if ($success) {
                    $_SESSION["userid"] = $newuserid;
                    $_SESSION["username"] = $username;
                    echo "修改成功! 3 秒後將自動跳轉頁面<br>";
                    echo "<a href='../user.php'>未成功跳轉頁面請點擊此</a><br>";
                    header("refresh:3;url=../user.php");
                    exit;
                }
            }
        } catch (PDOException $error) {
            echo "編輯失敗： " . $error->getMessage() . "，該id已有人使用<br>";
            echo "5秒後返回編輯頁面：<a href='index.php'>點此</a><br>";
            echo "回報BUG請至此：<a href='../../contact/index.php'>回報</a><br>";
            header("refresh:5;url=index.php");
            exit;
        }
    } else {
        function_alert("密碼錯誤，修改失敗");
        exit;
    }
} else {
    function_alert("無此帳號，修改失敗");
    exit;
}

function function_alert($message)
{
    echo "<script>alert('$message'); window.location.href='index.php';</script>";
    return false;
}
?>