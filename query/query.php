<?php
include_once("../db/condb.php");
// 從HTML input中獲取username、title和userid
$type = $_POST['type'];
$username = $_POST['username'] ? $_POST['username'] : null;
$title = $_POST['title'] ? $_POST['title'] : null;
$topic = $_POST['topic'] ? $_POST['topic'] : null;

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
    <main style="width:100%; height: auto;display: flex; flex-direction: column; align-items: center;">
        <div style="font-size:large; color:blue;">
            <?php
            $sql = "SELECT COUNT(*)
                    FROM $type AS t
                    LEFT OUTER JOIN user ON t.userid = user.userid";
            // 如果提供了username、title或topic，則加入WHERE條件進行模糊查詢
            if ($username !== null || $title !== null || $topic !== null) {
                $sql .= " WHERE";
                $flag = false;
                // 如果提供了username，加入username的模糊查詢條件
                if ($username !== null) {
                    $sql .= ($flag === true) ? " AND" : "";
                    $sql .= " user.username LIKE :username";
                    $flag = true;
                }

                // 如果提供了title，加入title的模糊查詢條件
                if ($title !== null) {
                    $sql .= ($flag === true) ? " AND" : "";
                    $sql .= " t.title LIKE :title";
                    $flag = true;
                }

                // 如果提供了topic，加入topic的查詢條件
                if ($topic !== null) {
                    $sql .= ($flag === true) ? " AND" : "";
                    $sql .= " t.topic LIKE :topic";
                    $flag = true;
                }
            }
            if ($stmt = $db->prepare($sql)) {

                // 如果提供了username，則綁定參數
                if ($username !== null) {
                    $username = '%' . $username . '%';
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                }

                // 如果提供了title，則綁定參數
                if ($title !== null) {
                    $title = '%' . $title . '%';
                    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                }

                // 如果提供了topic，則綁定參數
                if ($topic !== null) {
                    $topic = '%' . $topic . '%';
                    $stmt->bindParam(':topic', $topic, PDO::PARAM_STR);
                }

                $stmt->execute();
                if ($rowcount = $stmt->fetchColumn())
                    echo "共" . $rowcount . "筆搜尋結果";
                else
                    echo "查無符合資料";
            }
            ?>
        </div>
        <div style="width: 100%;">
            <table style="width: 100%; text-align:center;">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>標題</th>
                        <th>描述</th>
                        <th>主題</th>
                        <th>相關課程</th>
                        <th>網址</th>
                        <th>使用者名稱</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 建立SQL查詢
                    $sql = "SELECT t.id, t.title, t.description, t.topic, t.course_name, t.url, user.username
                            FROM $type AS t
                            LEFT OUTER JOIN user ON t.userid = user.userid";

                    // 如果提供了username、title或topic，則加入WHERE條件進行模糊查詢
                    if ($username !== null || $title !== null || $topic !== null) {
                        $sql .= " WHERE";

                        // 如果提供了username，加入username的模糊查詢條件
                        if ($username !== null) {
                            $sql .= " user.username LIKE :username";
                        }

                        // 如果提供了title，加入title的模糊查詢條件
                        if ($title !== null) {
                            $sql .= ($username !== null) ? " AND" : "";
                            $sql .= " t.title LIKE :title";
                        }

                        // 如果提供了topic，加入topic的查詢條件
                        if ($topic !== null) {
                            $sql .= ($username !== null || $title !== null) ? " AND" : "";
                            $sql .= " t.topic LIKE :topic";
                        }
                    }
                    if ($stmt = $db->prepare($sql)) {

                        // 如果提供了username，則綁定參數
                        if ($username !== null) {
                            $username = '%' . $username . '%';
                            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        }

                        // 如果提供了title，則綁定參數
                        if ($title !== null) {
                            $title = '%' . $title . '%';
                            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                        }

                        // 如果提供了topic，則綁定參數
                        if ($topic !== null) {
                            $topic = '%' . $topic . '%';
                            $stmt->bindParam(':topic', $topic, PDO::PARAM_STR);
                        }

                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        for ($count = 1; $count < count($rows); $count++) {
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
                                    <?php echo $rows[$count]['username']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    $db = null;
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <hr>
    遇到問題了嗎？<a href="../contact/index.php">回報</a>
</body>

</html>