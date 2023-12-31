<?php
	include_once("../db/condb.php");
    // SQL 查詢，使用 JOIN 連接 note 和 user 表格
    $sql = "SELECT code_practice.id, code_practice.title, code_practice.description, code_practice.topic, code_practice.course_name, code_practice.url, user_view.username
            FROM code_practice
            INNER JOIN user_view ON code_practice.userid = user_view.userid";
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div style="margin-left: 8px; margin-right: 8px;">
        <h2 class="sub-header">程式練習列表</h2>
        <?php
            echo "<div class='sub-header' style='font-size:large; color:blue;'>共有 ". $result1 . " 個練習</div>";
        ?>
        <table class="table table-bordered table-striped" style="background-color: #f0f0f0; color: #333;">
            <thead>
                <tr>
                    <th style='text-align: center;'>編號</th>
                    <th style='text-align: center;'>標題</th>
                    <th style='text-align: center;'>描述</th>
                    <th style='text-align: center;'>主題</th>
                    <th style='text-align: center;'>課程名稱</th>
                    <th style='text-align: center;'>網址</th>
                    <th style='text-align: center;'>使用者名稱</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($result) {
                    $count = 0;
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<th style='text-align: center;'>{$count}</th>";
                        echo "<td style='text-align: center;'>{$row['title']}</td>";
                        echo "<td style='text-align: center;'>{$row['description']}</td>";
                        echo "<td style='text-align: center;'>{$row['topic']}</td>";
                        echo "<td style='text-align: center;'>{$row['course_name']}</td>";
                        echo "<td style='text-align: center;'><a href='{$row['url']}' target='_blank'>{$row['url']}</a></td>"; // 將 URL 包裝在超連結中
                        echo "<td style='text-align: center;'>{$row['username']}</td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='7'>No results found</td></tr>";
                }
                ?>
            </tbody>

        </table>
    </div>
    <hr>
    <div style='display: flex; justify-content: center; align-items: center; flex-direction: row;'>遇到問題了嗎？<a href="../contact/index.php">回報</a></div>
</body>
</html>