<?php
session_start();
session_regenerate_id(true);
// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
    header('Location: ../staff_login/staff_login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/staff.css">
    <title>TOYS SHOP -admin-</title>
</head>

<body>
    <div id="global-container">
        <div id="container">
            <header class="header">
                <div class="header--inner">
                    <h2 class="title">TOYS SHOP 管理画面</h2>
                </div>
            </header>
            <main class="main">
                <h3>スタッフ管理</h3>
                <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
                <form class="staff--form" action="staff_add_check.php" method="post">
                    <p class="staff--sub">・スタッフ名を入力してください</p>
                    <input class="staff--input staff--name" type="text" name="staff_name">
                    <p>・パスワードを入力してください。</p>
                    <input class="staff--input staff--pass" type="password" name="staff_pass">
                    <p>・パスワードをもう一度入力してください。</p>
                    <input class="staff--input staff--pass" type="password" name="staff_pass2">
                    <div class="button--warapper">
                        <input class="button staff--button__back" type="button" onclick="history.back()" value="戻る">
                        <input class="button staff--button__submit" type="submit" value="OK">
                    </div>
                </form>
            </main>
            <footer class="footer">
                <div class="footer--inner">
                </div>
            </footer>
        </div>
    </div>
</body>

</html>