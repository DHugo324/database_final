<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>查詢介面</title>
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

        .queryForm {
            display: flex;
        }

        @media screen and (min-width:768px) {
            .queryForm {
                flex-direction: row;
            }
        }

        @media screen and (max-width: 767px) {
            .queryForm {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <main style="width:100%; height: 100%; display: flex; flex-direction: column; align-items: center;">
        <h1>查詢</h1>
        <form class="queryForm" method="post" action="query.php" target="queryiframe">
            <div>
                <span style="float: right; width: 100%;">
                    <select name="type" style="width: 100%;">
                        <option value="note">筆記</option>
                        <option value="code_practice">程式練習</option>
                    </select>
                </span>
            </div>
            <div>&nbsp;<span>名稱：</span><span style="float: right;"><input type="text" name="username"
                        placeholder="username"></span>&nbsp;
            </div>
            <div>&nbsp;<span>標題：</span><span style="float: right;"><input type="text" name="title"
                        placeholder="title"></span>&nbsp;</div>
            <div>&nbsp;<span>主題：</span><span style="float: right;"><input type="text" name="topic"
                        placeholder="topic"></span>&nbsp;
            </div>
            <div>&nbsp;<input type="submit" value="查詢" name="submit">&nbsp;</div>
        </form>
        <div class="queryiframe" style="width: 100%; height: 100%;">
            <iframe name="queryiframe" frameborder="0" scrolling="yes" src=""
                style="width: 100%; height: 100%;"></iframe>
        </div>
    </main>
</body>

</html>