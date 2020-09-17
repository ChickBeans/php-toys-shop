<?php
session_start();
require('../common/dbconnect.php');
require_once('../common/common.php');

$post = sanitize($_POST);
$staff_id = $post['staff_id'];
$staff_pass = $post['staff_pass'];

$staff_pass = md5($staff_pass);

// ログイン処理
// 入力したidとパスワードが共に一致した場合、データを取得する
$stmt = $db->prepare('SELECT id, name FROM mst_staff WHERE id=? AND password=?');
$stmt->execute(array(
  $staff_id,
  $staff_pass
));
$rec = $stmt->fetch();

// エラーチェック
if (empty($rec)) {
  $error['staff_login'] = 'failed';
} else {
  // ログイン成功した場合入力した値をセッションに保持
  $_SESSION['staff_login'] = $rec;
  header('Location: staff_top.php');
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
          <h2 class="title">ログイン</h2>
        </div>
      </header>
      <main class="main">
        <?php if ($error['staff_login'] = 'failed') : ?>
          <p class="error">スタッフコードかパスワードが間違っています</p>
          <a href="staff_login.html">戻る</a>
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