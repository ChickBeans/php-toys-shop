<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');
require_once('../common/common.php');

$post = sanitize($_POST);

$pro_name = $post['pro_name'];
$pro_price = $post['pro_price'];
$pro_picture_name = $post['pro_picture_name'];

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
}

if (!isset($pro_name) && !isset($pro_price)) {
  header('Location: pro_add.php');
  exit();
} else {
  $stmt = $db->prepare('INSERT INTO mst_product SET name=?, price=?, picture=?');
  $stmt->execute(array(
    $pro_name,
    $pro_price,
    $pro_picture_name
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
      <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
        <p><?php echo $pro_name ?>　を登録致しました。</p>
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