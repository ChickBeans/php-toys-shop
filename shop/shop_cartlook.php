<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');

// カートにアイテムが存在する場合
if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
  $pro_quantity = $_SESSION['pro_quantity'];
  $max = count($cart);

  // var_dump($cart, $pro_quantity, $max);
  // exit();

  foreach ($cart as $key => $id) {
    $stmt = $db->prepare('SELECT * FROM mst_product WHERE id=?');
    $stmt->execute(array(
      $id
    ));
    $rec = $stmt->fetch();
    // 商品ごとの個数を配列に格納する
    $pro_id[] = $rec['id'];
    $pro_name[] = $rec['name'];
    $pro_price[] = $rec['price'];
    // 画像の有無で処理を分ける
    if (!empty($rec['picture'])) {
      $pro_picture[] = $rec['picture'];
    } else {
      $pro_picture[] = '';
    }
  }
}

var_dump($_SESSION['member_login']['name']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/shop.css">
  <title>TOYS SHOP</title>
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
        <h2>商品情報参照</h2>
        <?php if (empty($_SESSION['member_login'])) : ?>
          <span>ゲスト様</span>
          <a href="member_login.html">会員ログイン</a>
          <?php else : ?>
            <span><?php echo $_SESSION['member_login']['name'] ?>様</span>
            <a href="member_logout.php">会員ログアウト</a>
        <?php endif ?>

        <!-- カート内に商品が存在する場合 -->
        <form action="quantity_change.php" method="post">
          <?php if (!empty($cart)) : ?>
            <!-- 配列ごとの商品を表示する -->
            <?php for ($i = 0; $i < $max; $i++) : ?>
              <p>商品ID：<?php echo $pro_id[$i] ?></p>
              <p>商品名：<?php echo $pro_name[$i] ?></p>
              <p>価格：<?php echo $pro_price[$i] ?>円</p>
              <p>合計価格：<?php echo $pro_price[$i] * $pro_quantity[$i] ?>円</p>
              <!-- チェックしたものを削除する -->
              <input type="checkbox" name="pro_delete<?php echo $i ?>">
              <input type="text" name="pro_quantity<?php echo $i ?>" value="<?php echo $pro_quantity[$i] ?>" pattern="[1-9][0-9]*" title="半角数字で入力してください">
              <!-- 商品が存在する場合表示する -->
              <?php if (!empty($pro_picture[$i])) : ?>
                <div class="pro-image--wrapper">
                  <img class="pro-image" src="../product/picture/<?php echo $pro_picture[$i] ?>" alt="商品画像">
                </div>
              <?php endif ?>
            <?php endfor ?>
          <?php else : ?>
            <!-- カート内に商品が存在しない場合 -->
            <p class="error">カートが空です</p>
          <?php endif ?>

          <div class="button--wrapper">
            <input class="button pro--button__back" type="button" onclick="history.back()" value="戻る">
            <input type="hidden" name="max" value="<?php echo $max ?>">
            <input type="submit" value="数量変更">
          </div>
        </form>
        
        <?php if (empty($_SESSION['member_login'])): ?>
          <a href="shop_form.php">ご購入手続きへ進む</a>
          <?php else: ?>
            <a href="shop_easy_check.php">ご購入手続きへ進む</a>
        <?php endif ?>
        <a href="clear_cart.php">カートを空にする</a>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>