<?php
session_start();
require('../common/dbconnect.php');
require_once('../common/common.php');

$post = sanitize($_POST);
$member_email = $post['member_email'];
$member_pass = $post['member_pass'];

// ログイン処理
// 入力したidとパスワードが共に一致した場合、データを取得する
$stmt = $db->prepare('SELECT id, name FROM dat_member WHERE email=? AND password=?');
$stmt->execute(array(
  $member_email,
  md5($member_pass)
));
$rec = $stmt->fetch();

// エラーチェック
if (empty($rec)) {
  $error['member_login'] = 'failed';
} else {
  // ログイン成功した場合入力した値をセッションに保持
  $_SESSION['member_login'] = $rec;
  header('Location: shop_list.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/shop.css">
  <title>TOYS SHOP -admin-</title>
</head>

<body>
  <div id="global-container">
    <div id="container">
      <header class="header">
        <div class="header--inner">
          <h2 class="title">ログイン</h2>
        </div>
      </header>
      <main class="main">
        <?php if ($error['member_login'] = 'failed') : ?>
          <p class="error">※メールアドレスかパスワードが間違っています</p>
          <a href="member_login.html">戻る</a>
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