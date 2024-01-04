<?php
	include_once("../db/condb.php");
    // SQL 查詢，使用 JOIN 連接 note 和 user 表格
    $sql = "SELECT note.id, note.title, note.description, note.topic, note.course_name, note.url, user.username
            FROM note
            INNER JOIN user ON note.userid = user.userid";
    $stmt = $db->prepare($sql);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();

    $sql = "SELECT COUNT(*) FROM note";
    $stmt = $db->prepare($sql);
    $error = $stmt->execute();
    $result1 = $stmt->fetchColumn();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Note</title>
    <style>
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
    <h2>筆記列表</h2>
    <?php
        echo "<div style='font-size:large; color:blue;'>共有 ". $result1 . " 個筆記</div>";
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