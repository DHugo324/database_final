<?php
    session_start();
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        function_alert("請先登入");
        exit;
    }
    function function_alert($message) {
        echo "<script>alert('$message'); window.location.href='../../login/index.php';</script>";
        return false;
    }
    
    $conn = include_once("../../DB/db.php");

    $title = $_POST["title"];
    $description = $_POST["description"];
    $topic = $_POST["topic"];
    $course_name = $_POST["course_name"];
    $url = $_POST["url"];
    $userid = $_POST["userid"];

    $sql = "INSERT INTO code_practice (title, description, topic, course_name, url, userid) 
            VALUES ('".$title."', '".$description."', '".$topic."', '".$course_name."', '".$url."', '".$userid."')";

    if ($db->exec($sql)) {
        echo "新增成功! 3 秒後將自動跳轉頁面<br>";
        echo "<a href='../code_practice.php'>未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=../code_practice.php");
        exit;
    } 
    else {
        echo "Error creating table: " . $db->errorInfo()[2];
    }
?>