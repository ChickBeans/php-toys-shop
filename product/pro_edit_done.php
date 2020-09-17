<?php
session_start();
require('../common/dbconnect.php');
require_once('../common/common.php');

$post = sanitize($_POST);

$pro_id = $post['pro_id'];
$pro_name = $post['pro_name'];
$pro_price = $post['pro_price'];
$pro_picture_name_old = $post['pro_picture_name_old'];
$pro_picture_name = $post['pro_picture_name'];

// 画面に表示されているユーザーのデータを修正
$stmt = $db->prepare('UPDATE mst_product SET name=?, price=?, picture=? WHERE id=?');
$stmt->execute(array(
  $pro_name,
  $pro_price,
  $pro_picture_name,
  $pro_id
));

// 古い画像が存在する場合削除する
if ($pro_picture_name_old != '') {
  unlink('./picture/' . $pro_picture_name_old);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/normalize.css">
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
      <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
      <p>商品名：<?php echo $pro_name ?>の情報を修正致しました。</p>
        <a href="pro_list.php">戻る</a>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>