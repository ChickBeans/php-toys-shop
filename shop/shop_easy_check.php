<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');
require_once('../common/dbconnect.php');

$post = sanitize($_POST);

$name = $post['name'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];

$order = $post['order'];
$pass = $post['pass'];
$pass2 = $post['pass2'];
$gender = $post['gender'];
$birth = $post['birth'];

// セッションチェック
if (!isset($_SESSION['member_login'])) {
  $error['member_login'] = 'failed';
} else {

  $stmt = $db->prepare('SELECT name, email, postal1, postal2, address, tel FROM dat_member WHERE id=?');
  $stmt->execute(array(
    $_SESSION['member_login']['id']
  ));
  $rec = $stmt->fetch();
  $name = $rec['name'];
  $email = $rec['email'];
  $postal1 = $rec['postal1'];
  $postal2 = $rec['postal2'];
  $address = $rec['address'];
  $tel = $rec['tel'];
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
          <?php if ($error['member_login'] === 'failed') : ?>
            <p class="error">※ログインされていません。</p>
          <?php endif ?>
          <a href="shop_list.php">商品一覧へ</a>
        <?php else : ?>
          <form method="post" action="shop_easy_done.php">
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
            <input class="shop--input name" type="hidden" name="name" value="<?php echo $name ?>">
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