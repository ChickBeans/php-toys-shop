<?php
session_start();

$pro_name = $_POST['pro_name'];
$pro_price = $_POST['pro_price'];

$pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
$pro_price = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

// エラーチェック
if ($pro_name === '') {
  $error['name'] = 'blank';
}
if ($pro_price === '') {
  $error['price'] = 'blank';
}
if (preg_match('/\A[0-9]+\z/', $pro_price) == 0) {
  $error['price'] = 'irregular';
}

// セッション変数pro_joinに入力情報を保存
if (empty($error)) {
  $_SESSION['product'] = $_POST;
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
          <input type="button" onclick="history.back()" value="戻る">
          <!-- エラーが存在しない場合 -->
        <?php else : ?>
          <p>商品名：<?php echo $pro_name ?>を追加します。</p>
          <form type="post" action="./pro_add_done.php">
            <input type="hidden" name="name" value="<?php $pro_name ?>">
            <input type="hidden" name="price" value="<?php $pro_price ?>">
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