<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');



// 個別のページを用意する
$pro_id = htmlspecialchars($_GET['pro_id']);

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
} else {
  // pro_idと一致するデータを取得する
  $stmt = $db->prepare('SELECT * FROM mst_product WHERE id=?');
  $stmt->execute(array(
    $pro_id
  ));
  $rec = $stmt->fetch();
  $pro_picture_name = $rec['picture'];
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
        <h2>商品削除</h2>
        <span class="login-staff--name"><?php echo $_SESSION['staff_login']['name'] ?>様　ログイン中</span>
        <p>商品ID：<?php echo $rec['id'] ?></p>
        <p>商品名：<?php echo $rec['name'] ?></p>
        <?php if ($pro_picture_name != '') : ?>
          <img src="./picture/<?php echo $pro_picture_name ?>" alt="商品画像">
        <?php endif ?>
        <form action="pro_delete_done.php" method="post">
          <input type="hidden" name="pro_id" value=<?php echo $rec['id'] ?>>
          <input type="hidden" name="pro_name" value=<?php echo $rec['name'] ?>>
          <input type="hidden" name="pro_picture_name" value=<?php echo $pro_picture_name ?>>
          <div class="button--wrapper">
            <input class="button pro--button__back" type="button" onclick="history.back()" value="戻る">
            <input class="button pro--button__submit" type="submit" value="OK">
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