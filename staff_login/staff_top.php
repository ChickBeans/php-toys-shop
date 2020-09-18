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
        <?php if (!empty($error)) : ?>
          <p class="error">＊ログインに失敗しました。</p>
          <a class="button--link" href="../staff_login/staff_login.html">ログイン画面へ</a>
          <?php exit(); ?>
        <?php else : ?>
          <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
          <a class="button--link" href="../staff/staff_list.php">スタッフ管理へ</a>
          <a class="button--link" href="../product/pro_list.php">商品管理へ</a>
          <a class="button--logout" href="../order/order_download.php">注文ダウンロード</a>
          <a class="button--logout" href="staff_logout.php">ログアウト</a>
        <?php endif ?>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>