<?php
session_start();
session_regenerate_id(true);
require('../common/dbconnect.php');
require_once('../common/common.php');

$staff_name = $_POST['staff_name'];
$staff_pass = $_POST['staff_pass'];
$staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
$staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  header('Location: ../staff_login/staff_login.html');
  exit();
} else {
  // スタッフを追加する
  $stmt = $db->prepare('INSERT INTO mst_staff SET name=?, password=?');
  $stmt->execute(array(
    $staff_name,
    md5($staff_pass)
  ));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/staff.css">
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
        <p><?php echo $staff_name ?>　を登録致しました。</p>
        <a href="staff_list.php">戻る</a>
        <?php
        // // 再登録防止の為、セッション内容を破棄するここうまく行ってない…
        // unset($_SESSION['staff_login']);
        // exit();
        // // exit();
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