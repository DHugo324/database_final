<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../index.php");
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>登入介面</title>
    <style>
        .login {
            width: 100%;
            font-size: large;
            font-weight: bold;
            color: rgb(104, 85, 224);
            background-color: rgba(255, 255, 255, 1);
            border: 1px solid rgba(104, 85, 224, 1);
            border-radius: 4px;
            box-sizing: border-box;
            cursor: pointer;
        }

        .login:hover {
            color: white;
            box-shadow: 0 0 20px rgba(104, 85, 224, 0.6);
            background-color: rgba(104, 85, 224, 1);
        }
    </style>
</head>

<body>
    <main
        style="width:100%; height:100%; display: flex; flex-direction: column; align-items: center; background-color: #f4f4f4; justify-content: center;">
        <h1>CS_hub</h1>
        <section>
            <form method="post" action="login.php">
                帳號：
                <input type="text" name="userid" required><br /><br />
                密碼：
                <input type="password" name="password" required><br><br>
                <div><input class="login" type="submit" value="登入" name="submit"></div><br>
            </form>
            <div style="text-align: center;"><a href="register.php">還沒有帳號？現在就註冊！</a></div>
        </section>
    </main>
</body>

</html>