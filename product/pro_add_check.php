<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = sanitize($_POST);
$pro_name = $post['pro_name'];
$pro_price = $post['pro_price'];
$pro_picture = $_FILES['pro_picture'];

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
}
// エラーチェック
if ($pro_name === '') {
  $error['name'] = 'blank';
}
if ($pro_price === '') {
  $error['price'] = 'blank';
}
// 半角数字のみ
if (preg_match('/\A[0-9]+\z/', $pro_price) == 0) {
  $error['price'] = 'irregular';
}
// 画像チェック
if ($pro_picture['size'] > 0) {
  if ($pro_picture['size'] > 10000000) {
    $error['picture'] = 'capacity';
  } else {
    move_uploaded_file($pro_picture['tmp_name'], './picture/' . $pro_picture['name']);
  }
}
// ファイルの拡張子チェック
$ext = substr($pro_picture['name'], -3);
if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') {
  $error['picture'] = 'type';
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
        <?php if (!empty($error)) : ?>
          <!-- エラーメッセージを表示する -->
          <?php if ($error['name'] === 'blank') : ?>
            <p class="error">※商品名が入力されていません</p>
          <?php endif  ?>
          <?php if ($error['price'] === 'blank') : ?>
            <p class="error">※価格が入力されていません</p>
          <?php endif  ?>
          <?php if ($error['price'] === 'irregular') : ?>
            <p class="error">※半角数字で入力してください</p>
          <?php endif  ?>
          <?php if ($error['picture'] === 'capacity') : ?>
            <p class="error">※画像の容量が大きすぎます。</p>
          <?php endif  ?>
          <?php if ($error['picture'] === 'type') : ?>
            <p class="error">※拡張子が「jpg」「png」の画像を設定してください。</p>
          <?php endif  ?>
          <input type="button" onclick="history.back()" value="戻る">
          <!-- エラーが存在しない場合 -->
        <?php else : ?>
          <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
          <p>商品名：<?php echo $pro_name ?>を追加します。</p>
          <img src="<?php echo './picture/' . $pro_picture['name'] ?>">
          <form method="post" action="./pro_add_done.php">
            <input type="hidden" name="pro_name" value="<?php echo $pro_name ?>">
            <input type="hidden" name="pro_price" value="<?php echo $pro_price ?>">
            <input type="hidden" name="pro_picture_name" value="<?php echo $pro_picture['name'] ?>">
            <input class="button pro--button__back" type="button" onclick="history.back()" value="戻る">
            <input class="button pro--button__submit" type="submit" value="OK">
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