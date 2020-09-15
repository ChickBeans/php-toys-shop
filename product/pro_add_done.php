<?php
session_start();
require('../common/dbconnect.php');

if (!isset($_SESSION['product'])) {
  header('Location: pro_add.php');
} else {
  $stmt = $db->prepare('INSERT INTO mst_product SET name=?, price=?');
  $stmt->execute(array(
    $_SESSION['product']['pro_name'],
    $_SESSION['product']['pro_price']
  ));
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
        <p><?php echo $_SESSION['product']['pro_name'] ?>　を登録致しました。</p>
        <a href="pro_list.php">戻る</a>
        <?php
        // 再登録防止の為、セッション内容を破棄するここうまく行ってない…
        unset($_SESSION['product']);
        exit();
        // exit();
        ?>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>