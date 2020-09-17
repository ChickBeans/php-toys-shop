<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');

// 個別のページを用意する
$pro_id = htmlspecialchars($_GET['pro_id']);
// カートに商品が存在する場合
if (isset($_SESSION['cart'])) {
  // カートに商品を追加する
  $cart = $_SESSION['cart'];
  $pro_quantity = $_SESSION['pro_quantity'];

  // カートの重複チェック
  if (in_array($pro_id, $cart)) {
    $error['cart'] = 'deplicate';
  } else {
    $cart[] = $pro_id;
    $pro_quantity[] = 1;
    $_SESSION['cart'] = $cart;
    $_SESSION['pro_quantity'] = $pro_quantity;
  }
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
          <h2 class="title">TOYS SHOP 管理画面</h2>
        </div>
      </header>
      <main class="main">
        <?php if (!empty($error)) : ?>
          <?php if ($error['cart'] === 'deplicate') : ?>
            <p class="error">既にその商品は追加されてます。</p>
            <div class="button--wrapper">
              <a class="button" href="shop_list.php">商品一覧へ戻る</a>
            </div>
          <?php endif ?>
        <?php else : ?>
          <p>カートに追加しました</p>
          <div class="button--wrapper">
            <a class="button" href="shop_list.php">商品一覧へ戻る</a>
          </div>
        <?php endif ?>
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