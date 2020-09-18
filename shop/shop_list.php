<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');

// 商品一覧を表示
$stmt = $db->query('SELECT * FROM mst_product;');

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
          <h2 class="title">TOYS SHOP</h2>
        </div>
      </header>
      <main class="main">
        <h2>商品一覧画面</h2>
        <?php if (isset($_SESSION['member_login'])) : ?>
          <span><?php echo $_SESSION['member_login']['member_name'] ?>様</span>
          <a href="member_logout.php">会員ログアウト</a>
        <?php else : ?>
          <span>ゲスト様</span>
          <a href="member_login.html">会員ログイン</a>
        <?php endif ?>
        <table border="1" class="pro--list">
          <tr>
            <th>商品ID</th>
            <th>商品名</th>
            <th>価格</th>
            <!-- <th>商品画像</th> -->
          </tr>
          <!-- DBから取得したデータを表示する -->
          <?php while (true) {
            $rec = $stmt->fetch();
            // 値が取得できなくなった場合→処理をやめる
            if ($rec === false) {
              break;
            }
          ?>
            <tr>
              <!-- radioボタンにid情報を格納 -->
              <td><?php echo $rec['id'] ?></td>
              <td><a href="shop_product.php?pro_id=<?php echo $rec['id'] ?>"><?php echo $rec['name'] ?></a></td>
              <td><?php echo $rec['price'] ?></td>
              <!-- <td><img src="<?php echo '../product/picture/' . $rec['picture'] ?>" alt="商品画像"></td> -->
            </tr>
          <?php
          } ?>
        </table>
        <a href="shop_cartlook.php">カートを見る</a>
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