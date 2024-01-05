<?php
session_start();

// 登入檢查
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}

include_once("db/condb.php");
$userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : null;
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS_hub</title>
    <style>
        * {
            font-family: 'Heebo', sans-serif;
            user-select: none;
            -webkit-user-select: none;
            /* 兼容 WebKit 浏览器 */
            -moz-user-select: none;
            /* 兼容 Firefox 浏览器 */
            -ms-user-select: none;
            /* 兼容 IE/Edge 浏览器 */
        }

        html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 0px;
            text-align: center;
            display: flex;
            flex-direction: column;
            position: fixed;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #555;
            padding: 3px;
        }

        .menu {
            list-style-type: none;
        }

        nav li {
            color: #fff;
            text-decoration: none;
            padding: 3px;
            margin: 0 10px;
            border-radius: 5px;
            display: inline;
        }

        nav li:hover {
            background-color: #777;
        }

        button {
            cursor: pointer;
            border: none;
            color: white;
            background-color: transparent;
        }

        main {
            width: 100%;
            height: 100%;
            padding-top: 132px;
            background-color: #DADADA;
            text-align: center;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        iframe {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>CS_hub</h1>
        <nav>
            <ul class="menu">
                <li><button onclick="toUrl('home.php')">首頁</button></li>
                <li><button onclick="toUrl('honor.php')">榮譽榜</button></li>
                <li><button onclick="toUrl('note/note.php')">筆記</button></li>
                <li><button onclick="toUrl('code_practice/code_practice.php')">程式練習</button></li>
                <li><button onclick="toUrl('query/index.php')">查詢</button></li>
                <?php if ($isLoggedIn): ?>
                    <li><button onclick="toUrl('user/user.php')">個人頁面</button></li>
                    <li><button onclick="toUrl('account/logout.php')">登出</button></li>
                <?php else: ?>
                    <li><button onclick="login()">登入</button></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <iframe id="mainIframe" frameborder="0" scrolling="yes" src="home.php"></iframe>
    </main>

    <script src="js/scripts.js"></script>
</body>

</html>