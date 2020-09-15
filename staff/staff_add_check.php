<?php
session_start();

$staff_name = $_POST['staff_name'];
$staff_pass = $_POST['staff_pass'];
$staff_pass2 = $_POST['staff_pass2'];

$staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
$staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');
$staff_pass2 = htmlspecialchars($staff_pass2, ENT_QUOTES, 'UTF-8');

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

// セッション変数staff_joinに入力情報を保存
if (empty($error)) {
  $_SESSION['staff_join'] = $_POST;
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
          <!-- エラーメッセージを表示する -->
          <?php if($error['name'] === 'blank')  :?>
            <p class="error">※スタッフ名が入力されていません</p>
          <?php endif  ?>
          <?php if($error['pass'] === 'blank')  :?>
            <p class="error">※パスワードが入力されていません</p>
          <?php endif  ?>
          <?php if($error['pass'] === 'length')  :?>
            <p class="error">※パスワードは6文字以上で入力してください</p>
          <?php endif  ?>
          <?php if($error['pass'] === 'different')  :?>
            <p class="error">※パスワードが一致しません</p>
          <?php endif  ?>
          <input type="button" onclick="history.back()" value="戻る">
          <!-- エラーが存在しない場合 -->
        <?php else : ?>
          <p>スタッフ名：<?php echo $staff_name ?>を追加しますか？</p>
          <form type="post" action="./staff_add_done.php">
            <input type="hidden" name="name" value="<?php $staff_name ?>">
            <input type="hidden" name="pass" value="<?php $staff_pass ?>">
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