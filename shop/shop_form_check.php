<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = sanitize($_POST);

$name = $post['name'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];

// エラーチェック
if ($post['name'] === '') {
  $error['name'] = 'blank';
}
// メールアドレスの正規表現チェック
if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) === 0) {
  $error['email'] = 'regex';
}
// 郵便番号の正規表現チェック
if (preg_match('/\A[0-9]+\z/', $postal1) === 0 || preg_match('/\A[0-9]+\z/', $postal2) === 0) {
  $error['postal'] = 'regex';
}

if ($address === '') {
  $error['address'] = 'blank';
}
// 電話番号の正規表現チェック
if (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) === 0) {
  $error['tel'] = 'regex';
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
          <h2 class="title">TOYS SHOP</h2>
        </div>
      </header>
      <main class="main">
        <?php if (!empty($error)) : ?>
          <?php if ($error['name'] === 'blank') : ?>
            <p class="error">※お名前が入力されていません</p>
          <?php endif ?>
          <?php if ($error['email'] === 'regex') : ?>
            <p class="error">※メールアドレスを正しく入力してください</p>
          <?php endif ?>
          <?php if ($error['postal'] === 'regex') : ?>
            <p class="error">※郵便番号は半角数字で入力してください</p>
          <?php endif ?>
          <?php if ($error['address'] === 'blank') : ?>
            <p class="error">※住所が入力されていません</p>
          <?php endif ?>
          <?php if ($error['tel'] === 'regex') : ?>
            <p class="error">※電話番号を正しく入力してください</p>
          <?php endif ?>
          <input type="button" onclick="history.back()" value="戻る">
        <?php else : ?>
          <form method="post" action="shop_form_done.php">
            <p>お名前：<?php echo $name ?>様</p>
            <input class="shop--input" type="hidden" name="name" value="<?php echo $name ?>">
            <p>メールアドレス：<?php echo $email ?></p>
            <input class="shop--input" type="hidden" name="email" value="<?php echo $email ?>">
            <p>郵便番号：<?php echo $postal1 . '-' . $postal2 ?></p>
            <input class="shop--input postal1" type="hidden" name="postal1" value="<?php echo $postal1 ?>">
            <input class="shop--input postal2" type="hidden" name="postal2" value="<?php echo $postal2 ?>">
            <p>住所：<?php echo $address ?></p>
            <input class="shop--input address" type="hidden" name="address" value="<?php echo $address ?>">
            <p>電話番号：<?php echo $tel ?></p>
            <input class="shop--input tel" type="hidden" name="tel" value="<?php echo $tel ?>">
            <div class="button-wrapper">
              <input type="button" onclick="history.back()" value="戻る">
              <input type="submit" value="OK">
            </div>
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