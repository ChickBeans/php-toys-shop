<?php
session_start();
session_regenerate_id(true);

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
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
    <link rel="stylesheet" href="../css/product.css">
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
                <h3>商品追加</h3>
                <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
                <form class="pro--form" action="pro_add_check.php" method="post" enctype="multipart/form-data">
                    <p class="pro--sub">・商品名を入力してください</p>
                    <input class="pro--input pro--name" type="text" name="pro_name">
                    <p>・価格を入力してください。</p>
                    <input class="pro--input pro--price" type="text" name="pro_price">
                    <p>・画像を選択してください</p>
                    <input class="pro--input pro--picture" type="file" name="pro_picture">
                    <div class="button--wrapper">
                        <input class="button pro--button__back" type="button" onclick="history.back()" value="戻る">
                        <input class="button pro--button__submit" type="submit" value="OK">
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