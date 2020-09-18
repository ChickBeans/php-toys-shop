<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');


// 個別のページを用意する
$pro_id = htmlspecialchars($_GET['pro_id']);

$stmt = $db->prepare('SELECT * FROM mst_product WHERE id=?');
$stmt->execute(array(
  $pro_id
));
$rec = $stmt->fetch();

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
        <h2>商品情報参照</h2>
        <?php if (isset($_SESSION['member_login'])) : ?>
          <span><?php echo $_SESSION['member_login']['member_name'] ?>様</span>
          <a href="member_logout.php">会員ログアウト</a>
        <?php else : ?>
          <span>ゲスト様</span>
          <a href="member_login.html">会員ログイン</a>
        <?php endif ?>
        <p>商品ID：<?php echo $rec['id'] ?></p>
        <p>商品名：<?php echo $rec['name'] ?></p>
        <p>価格：<?php echo $rec['price'] ?>円</p>
        <!-- 商品が存在する場合表示する -->
        <?php if (!empty($rec['picture'])) : ?>
          <div class="pro-image--wrapper">
            <img class="pro-image" src="../product/picture/<?php echo $rec['picture'] ?>" alt="商品画像">
          </div>
        <?php endif ?>

        <div class="button--wrapper">
          <a class="cart--button" href="shop_cartin.php?pro_id=<?php echo $rec['id'] ?>">カートに入れる</a>
          <input class="button pro--button__back" type="button" onclick="history.back()" value="戻る">
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