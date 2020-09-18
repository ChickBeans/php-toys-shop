<?php
session_start();
session_regenerate_id(true);
require_once('../common/common.php');
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
        <p>お客様情報を入力してください</p>
        <form method="post" action="shop_form_check.php">
          <p>お名前</p>
          <input class="shop--input" type="text" name="name">
          <p>メールアドレス</p>
          <input class="shop--input" type="text" name="email">
          <p>郵便番号</p>
          <input class="shop--input postal1" type="text" name="postal1">
          -
          <input class="shop--input postal2" type="text" name="postal2">
          <p>住所</p>
          <input class="shop--input address" type="text" name="address">
          <p>電話番号</p>
          <input class="shop--input tel" type="text" name="tel">
          <input type="radio" name="order" value="order_only" checked><span>今回だけの注文</span>
          <input type="radio" name="order" value="order_reg"><span>会員登録しての注文</span>
          <p>会員登録する方は以下の項目を入力してください</p>
          <p>・パスワードを入力してください。</p>
          <input class="staff--input staff--pass" type="password" name="pass">
          <p>・パスワードをもう一度入力してください。</p>
          <input class="staff--input staff--pass" type="password" name="pass2">
          <p>性別</p>
          <input type="radio" name="gender" value="0" checked><span>男性</span>
          <input type="radio" name="gender" value="1"><span>女性</span>
          <p>生まれ年</p>
          <?php create_pulldown_birth() ?>年代
          <div class="button-wrapper">
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
          </div>
        </form>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>