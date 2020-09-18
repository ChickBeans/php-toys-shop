<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');
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
                <form action="order_download_done.php" method="post">
                    <?php create_pulldown_year() ?>
                    <span>年</span>
                    <?php create_pulldown_month() ?>
                    <span>月</span>
                    <?php create_pulldown_day() ?>
                    <span>日</span>
                    <input class="button" type="submit" value="ダウンロードへ">
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