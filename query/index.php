<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>查詢介面</title>
</head>

<body>
    <main style="width:100%; display: flex; flex-direction: column; align-items: center;">
        <h1>查詢</h1>
        <form method="post" action="query.php" target="queryiframe">
            <select name="type">
                <option value="note">筆記</option>
                <option value="code_practice">程式練習</option>
            </select>
            使用者ID<input type="text" name="userid">
            使用者名稱<input type="text" name="username">
            標題<input type="text" name="title">
            <input type="submit" value="查詢" name="submit">
        </form>
        <div style="width: 100%; height: auto;">
            <iframe name="queryiframe" frameborder="0" scrolling="yes" src=""
                style="width: 100%; height: auto;"></iframe>
        </div>
    </main>
</body>

</html>