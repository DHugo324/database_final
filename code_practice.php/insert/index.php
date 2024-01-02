<?php
    // Initialize the session
    session_start();

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        function_alert("請先登入");
        header("location: ../index.html");
        exit;
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新增介面</title>
</head>
<body>
    <h1>新增程式練習</h1>
<form method="post" action="insert.php">
標題：
<input type="text" name="title" required><br><br>
描述：
<input type="text" name="description"><br><br>
主題：
<input type="text" name="topic"><br><br>
課程名稱：
<input type="text" name="course_name"><br><br>
網址：
<input type="url" name="url" required><br><br>
<input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>" required>
<input type="submit" value="新增" name="submit">
</form>
<a href="../code_practice.php">返回</a>
</body>
</html>
