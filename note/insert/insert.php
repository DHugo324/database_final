<?php
    $conn = require_once("../../DB/db.php");

    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $topic = mysqli_real_escape_string($conn, $_POST["topic"]);
    $course_name = mysqli_real_escape_string($conn, $_POST["course_name"]);
    $url = mysqli_real_escape_string($conn, $_POST["url"]);
    $userid = mysqli_real_escape_string($conn, $_POST["userid"]);

    $sql = "INSERT INTO note (title, description, topic, course_name, url, userid) 
            VALUES ('".$title."', '".$description."', '".$topic."', '".$course_name."', '".$url."', '".$userid."')";

    if ($db->exec($sql)) {
        session_start();
        echo "新增成功! 3 秒後將自動跳轉頁面<br>";
        echo "<a href='../note.php'>未成功跳轉頁面請點擊此</a>";
        $_SESSION["userid"] = $_POST["userid"];
        header("refresh:3;url=../note.php");
        exit;
    } 
    else {
        echo "Error creating table: " . $db->errorInfo()[2];
    }
?>