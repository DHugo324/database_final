<?php
	include_once("../db/condb.php");
    // SQL 查詢，使用 JOIN 連接 note 和 user 表格
    $sql = "SELECT code_practice.id, code_practice.title, code_practice.description, code_practice.topic, code_practice.course_name, code_practice.url, user.username
            FROM code_practice
            INNER JOIN user ON code_practice.userid = user.userid";
    $stmt = $db->prepare($sql);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();

    $sql = "SELECT COUNT(*) FROM code_practice";
    $stmt = $db->prepare($sql);
    $error = $stmt->execute();
    $result1 = $stmt->fetchColumn();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Code Practice</title>
    <style>
        h1 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            background-color: #f2f2f2; /* 淺灰色背景 */
        }

        th, td {
            border: 1px solid #d9d9d9; /* 深灰色邊框 */
            text-align: left;
            padding: 8px;
            width: 14.28%;
        }

        th {
            background-color: #999; /* 深灰色表頭 */
            color: white;
        }
    </style>
</head>
<body>
    <h1>程式練習列表</h1>
    <?php
        echo "<div style='display: flex; flex-direction: column; align-items: center;font-size:large; color:blue;'>共有 ". $result1 . " 個練習</div>";
    ?>
    <table>
        <tr>
            <th>編號</th>
            <th>標題</th>
            <th>描述</th>
            <th>主題</th>
            <th>課程名稱</th>
            <th>網址</th>
            <th>使用者名稱</th>
        </tr>

        <?php
        if ($result) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['topic']}</td>";
                echo "<td>{$row['course_name']}</td>";
                echo "<td><a href='{$row['url']}' target='_blank'>{$row['url']}</a></td>"; // 將 URL 包裝在超連結中
                echo "<td>{$row['username']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No results found</td></tr>";
        }
        ?>

    </table>
</body>
</html>