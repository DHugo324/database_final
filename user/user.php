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
    header("refresh:3;url=index.php");
    return false;
}
include_once("../db/condb.php");
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>用戶頁面</title>
    <style>
        .add {
            padding: 5px 10px;
            background-color: #5cb85c;
            color: white;
            font-weight: bold;
            font-size: large;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add:hover {
            background-color: #77c477;
        }
    </style>
    <script>
        function editNote(id) {
            window.location.href = "../note/edit/index.php?id=" + id;
        }

        function editCodePractice(id) {
            window.location.href = "../note/edit/code_practice/index.php?id=" + id;
        }

        function deleteNote(id) {
            window.location.href = "../note/delete/delete.php?id=" + id;
        }

        function deleteCodePractice(id) {
            window.location.href = "../note/delete/code_practice/delete.php?id=" + id;
        }
    </script>
</head>

<body>
    <!-- <a href="../account/logout.php">登出</a> -->
    <h1>你好，
        <?php echo $username; ?>
    </h1>
    <div>
        <h2>我的筆記 <button class="add" onclick="window.location.href = '../note/insert/index.php'">新增</button>
        </h2>
        <div style="font-size:large; color:blue;">
            <?php
            $sql = "SELECT COUNT(*) FROM note WHERE userid = ?";
            $stmt = $db->prepare($sql);
            $error = $stmt->execute(array($userid));
            if ($rowcount = $stmt->fetchColumn())
                echo "共 " . $rowcount . " 篇";
            else
                echo "快新增你的第一篇筆記吧！";
            ?>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>標題</th>
                        <th>描述</th>
                        <th>主題</th>
                        <th>相關課程</th>
                        <th>網址</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, title, description, topic, course_name, url FROM note WHERE userid = ?";
                    if ($stmt = $db->prepare($sql)) {
                        $stmt->execute(array($userid));
                        for ($rows = $stmt->fetchAll(), $count = 0; $count < count($rows); $count++) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $count; ?>
                                </th>
                                <td>
                                    <?php echo $rows[$count]['title']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['description']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['topic']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['course_name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['url']; ?>
                                </td>
                                <td>
                                    <button onclick="editNote(<?php echo $rows[$count]['id'] ?>);">修改</button>
                                    <button onclick="deleteNote(<?php echo $rows[$count]['id'] ?>);">刪除</button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div>
        <h2>我的程式練習 <button class="add" onclick="window.location.href = '../code_practice/insert/index.php'">新增</button>
        </h2>
        <div style="font-size:large; color:blue;">
            <?php
            $sql = "SELECT COUNT(*) FROM code_practice WHERE userid = ?";
            $stmt = $db->prepare($sql);
            $error = $stmt->execute(array($userid));
            if ($rowcount = $stmt->fetchColumn())
                echo "共" . $rowcount . "篇";
            else
                echo "快新增你的第一篇程式練習吧！";
            ?>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>標題</th>
                        <th>描述</th>
                        <th>主題</th>
                        <th>相關課程</th>
                        <th>網址</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, title, description, topic, course_name, url FROM code_practice WHERE userid = ?";
                    if ($stmt = $db->prepare($sql)) {
                        $stmt->execute(array($userid));
                        for ($rows = $stmt->fetchAll(), $count = 0; $count < count($rows); $count++) {
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $count; ?>
                                </th>
                                <td>
                                    <?php echo $rows[$count]['title']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['description']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['topic']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['course_name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows[$count]['url']; ?>
                                </td>
                                <td>
                                    <button onclick="editNote(<?php echo $rows[$count]['id'] ?>);">修改</button>
                                    <button onclick="deleteNote(<?php echo $rows[$count]['id'] ?>);">刪除</button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    遇到問題了嗎？<a href="../contact/index.php">回報</a>
</body>

</html>