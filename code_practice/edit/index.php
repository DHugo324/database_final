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

$id = $_GET['id'];
$sql = "SELECT * FROM code_practice WHERE id = ?";
if ($stmt = $db->prepare($sql)) {
    $stmt->execute(array($id));
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
        if ($result[0]['userid'] !== $_SESSION["userid"]) {
            echo "您不是擁有者！ 3 秒後將自動跳轉頁面<br>";
            echo "<a href='../../user/user.php'>未成功跳轉頁面請點擊此</a>";
            header("refresh:3;url=../../user/user.php");
            exit;
        }
        $title = $result[0]['title'];
        $description = $result[0]['description'];
        $topic = $result[0]['topic'];
        $course_name = $result[0]['course_name'];
        $url = $result[0]['url'];
    } else {
        echo "查無此程式練習！ 3 秒後將自動跳轉頁面<br>";
        echo "<a href='../../user/user.php'>未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=../../user/user.php");
        exit;
    }
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>編輯介面</title>
    <style>
        input[type=submit] {
            padding: 5px 10px;
            background-color: #5cb85c;
            color: white;
            font-weight: bold;
            font-size: large;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #449d44;
        }

        input[type=reset] {
            padding: 5px 10px;
            background-color: #FF0000;
            color: white;
            font-weight: bold;
            font-size: large;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=reset]:hover {
            background-color: #CC0000;
        }
    </style>
</head>

<body>
    <div>
        <img src="../../image/back.png" title="返回" width="50px" height="50px" style="cursor: pointer;"
            onclick="history.back()">
    </div>
    <main style="width:100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h1>編輯程式練習</h1>
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>" required>
            <table>
                <tbody>
                    <tr>
                        <td>標題：</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                    </tr>
                    <tr>
                        <td>描述：</td>
                        <td><input type="text" name="description" value="<?php echo $description; ?>"></td>
                    </tr>
                    <tr>
                        <td>主題：</td>
                        <td><input type="text" name="topic" value="<?php echo $topic; ?>"></td>
                    </tr>
                    <tr>
                        <td>課程名稱：</td>
                        <td><input type="text" name="course_name" value="<?php echo $course_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>網址：</td>
                        <td><input type="url" name="url" value="<?php echo $url; ?>"></td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align: center;">
                <input type="submit" value="編輯" name="submit">
                <input type="reset" value="重設" name="reset">
            </div>
        </form>
    </main>
</body>

</html>