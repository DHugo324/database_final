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
    echo "<a href='index.php'>未成功跳轉頁面請點擊此</a><br>";
    echo "或是<a href='../home.php'>返回首頁</a>";
    header("refresh:3;url=../account/index.php");
    return false;
}
include_once("../db/condb.php");
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
// function console_log($output, $with_script_tags = true)
// {
//     $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
//         ');';
//     if ($with_script_tags) {
//         $js_code = '<script>' . $js_code . '</script>';
//     }
//     echo $js_code;
// }
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
            background-color: #449d44;
        }

        button {
            cursor: pointer;
        }
    </style>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script>
        function editNote(id) {
            window.location.href = "../note/edit/index.php?id=" + id;
        }

        function editCodePractice(id) {
            window.location.href = "../code_practice/edit/index.php?id=" + id;
        }

        function deleteNote(id) {
            window.location.href = "../note/delete/delete.php?id=" + id;
        }

        function deleteCodePractice(id) {
            window.location.href = "../code_practice/delete/delete.php?id=" + id;
        }
    </script>
</head>

<body>
    <h1 class="sub-header" style="margin-left: 8px; margin-right: 8px;">你好，
        <?php echo $username; ?>
        <button style="background-color: unset; border: none;" onclick="window.location.href='edit/index.php';"><img
                src="../image/setting.png" style="width: 30px; height: 30px;"></button>
    </h1>
    <div style="margin-left: 8px; margin-right: 8px;">
        <h2 class="sub-header" style="display: flex; align-items: center;">
            我的筆記&nbsp;
            <button class="add" onclick="window.location.href = '../note/insert/index.php'">新增</button>
        </h2>
        <div class="sub-header" style="font-size:large; color:blue;">
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
        <table class="table table-bordered table-striped" style="background-color: #f0f0f0; color: #333;">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>標題</th>
                    <th>描述</th>
                    <th>主題</th>
                    <th>相關課程</th>
                    <th>網址</th>
                    <th>操作</th>
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
                            <th scope="row" class="text-center">
                                <?php echo $count; ?>
                            </th>
                            <td class="text-center">
                                <?php echo $rows[$count]['title']; ?>
                            </td class="text-center">
                            <td class="text-center">
                                <?php echo $rows[$count]['description']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['topic']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['course_name']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['url']; ?>
                            </td>
                            <td class="text-center">
                                <button style="background-color: unset; border: none;"
                                    onclick="editNote(<?php echo $rows[$count]['id'] ?>);"><img src="../image/edit.png"
                                        style="width: 30px; height: 30px;"></button>
                                <button style="background-color: unset; border: none;"
                                    onclick="deleteNote(<?php echo $rows[$count]['id'] ?>);"><img src="../image/delete.png"
                                        style="width: 30px; height: 30px;"></button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
    <div style="margin-left: 8px; margin-right: 8px;">
        <h2 class="sub-header" style="display: flex; align-items: center;">
            我的程式練習&nbsp;
            <button class="add" onclick="window.location.href = '../code_practice/insert/index.php'">新增</button>
        </h2>
        <div class="sub-header" style="font-size:large; color:blue;">
            <?php
            $sql = "SELECT COUNT(*) FROM code_practice WHERE userid = ?";
            $stmt = $db->prepare($sql);
            $error = $stmt->execute(array($userid));
            if ($rowcount = $stmt->fetchColumn())
                echo "共 " . $rowcount . " 篇";
            else
                echo "快新增你的第一篇程式練習吧！";
            ?>
        </div>
        <table class="table table-bordered table-striped" style="background-color: #f0f0f0; color: #333;">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>標題</th>
                    <th>描述</th>
                    <th>主題</th>
                    <th>相關課程</th>
                    <th>網址</th>
                    <th>操作</th>
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
                            <td class="text-center">
                                <?php echo $rows[$count]['title']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['description']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['topic']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['course_name']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $rows[$count]['url']; ?>
                            </td>
                            <td class="text-center">
                                <button style="background-color: unset; border: none;"
                                    onclick="editCodePractice(<?php echo $rows[$count]['id'] ?>);"><img src="../image/edit.png"
                                        style="width: 30px; height: 30px;"></button>
                                <button style="background-color: unset; border: none;"
                                    onclick="deleteCodePractice(<?php echo $rows[$count]['id'] ?>);"><img
                                        src="../image/delete.png" style="width: 30px; height: 30px;"></button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <hr>
    <div style='display: flex; justify-content: center; align-items: center; flex-direction: row;'>遇到問題了嗎？<a
            href="../contact/index.php">回報</a></div>
</body>

</html>