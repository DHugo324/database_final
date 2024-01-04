<?php
	include_once("../db/condb.php");
    // SQL 查詢，使用 JOIN 連接 note 和 user 表格
    $sql = "SELECT code_practice.id, code_practice.title, code_practice.description, code_practice.topic, code_practice.course_name, code_practice.url, user.username
            FROM code_practice
            INNER JOIN user ON code_practice.userid = user.userid";

    $stmt = $db->prepare($sql);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Code Practice</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Topic</th>
            <th>Course Name</th>
            <th>URL</th>
            <th>Username</th>
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