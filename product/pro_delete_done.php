<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');

$pro_id = $_POST['pro_id'];
$pro_name = $_POST['pro_name'];
// DBに登録されている画像名
$pro_picture_name = $_POST['pro_picture_name'];

$pro_id = htmlspecialchars($pro_id, ENT_QUOTES, 'UTF-8');
$pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
} else {
  // 画面に表示されているユーザーのデータを修正
  $stmt = $db->prepare('DELETE FROM mst_product WHERE id=?');
  $stmt->execute(array(
    $pro_id
  ));
}

// DB内に画像が存在した場合にローカルの方からも削除する
if ($pro_picture_name != '') {
  unlink('./picture/' . $pro_picture_name);
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
        <p>商品名：<?php echo $pro_name ?>のデータを削除致しました。</p>
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