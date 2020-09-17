<?php

session_start();
require('../common/dbconnect.php');
require_once('../common/common.php');

try {

  $post = sanitize($_POST);

  $pro_id = $post['pro_id'];
  $pro_name = $post['pro_name'];
  $pro_price = $post['pro_price'];
  $pro_picture_name_old = $post['pro_picture_name_old'];
  $pro_picture = $_FILES['pro_picture'];

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

  var_dump($error['image']);
} catch (Exception $e) {
  echo 'エラー：' . $e->getMessage();
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
            <p class="error">※スタッフ名が入力されていません</p>
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
          <form method="post" action="./pro_edit_done.php">
            <p>商品名：<?php echo $pro_name ?>に変更致します</p>
            <p>価格：<?php echo $pro_price ?>円に変更致します</p>
            <input type="hidden" name="pro_id" value="<?php echo $pro_id ?>">
            <input type="hidden" name="pro_name" value="<?php echo $pro_name ?>">
            <input type="hidden" name="pro_price" value="<?php echo $pro_price ?>">
            <input type="hidden" name="pro_picture_name_old" value="<?php echo $pro_picture_name_old ?>">
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