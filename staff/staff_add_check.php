<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');
require_once('../common/common.php');

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
}

$staff_name = $_POST['staff_name'];
$staff_pass = $_POST['staff_pass'];
$staff_pass2 = $_POST['staff_pass2'];

// エラーチェック
if ($staff_name === '') {
  $error['name'] = 'blank';
}
if ($staff_pass === '') {
  $error['pass'] = 'blank';
}
if (strlen($staff_pass) < 6) {
  $error['pass'] = 'length';
}
if ($staff_pass !== $staff_pass2) {
  $error['pass'] = 'different';
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
        <!-- エラーメッセージを表示する -->
        <?php if (!empty($error)) : ?>
          <?php if ($error['name'] === 'blank') : ?>
            <p class="error">※スタッフ名が入力されていません</p>
          <?php endif  ?>
          <?php if ($error['pass'] === 'blank') : ?>
            <p class="error">※パスワードが入力されていません</p>
          <?php endif  ?>
          <?php if ($error['pass'] === 'length') : ?>
            <p class="error">※パスワードは6文字以上で入力してください</p>
          <?php endif  ?>
          <?php if ($error['pass'] === 'different') : ?>
            <p class="error">※パスワードが一致しません</p>
          <?php endif  ?>
          <input type="button" onclick="history.back()" value="戻る">
          <!-- エラーが存在しない場合 -->
        <?php else : ?>
          <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
          <p>スタッフ名：<?php echo $staff_name ?>を追加しますか？</p>
          <form method="post" action="./staff_add_done.php">
            <input type="hidden" name="staff_name" value="<?php echo $staff_name ?>">
            <input type="hidden" name="staff_pass" value="<?php echo $staff_pass ?>">
            <input class="button staff--button__back" type="button" onclick="history.back()" value="戻る">
            <input class="button staff--button__submit" type="submit" value="OK">
          </form>
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