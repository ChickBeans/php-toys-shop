<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');
require_once('../common/common.php');

$post = sanitize($_POST);
$staff_id = $post['staff_id'];
$staff_name = $post['staff_name'];
$staff_pass = $post['staff_pass'];
$staff_pass2 = $post['staff_pass2'];

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
} else {
  // 画面に表示されているユーザーのデータを修正
  $stmt = $db->prepare('UPDATE mst_staff SET name=?, password=? WHERE id=?');
  $stmt->execute(array(
    $staff_name,
    md5($staff_pass),
    $staff_id
  ));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/normalize.css">
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
        <p>スタッフ名：<?php echo $staff_name ?>様の情報を修正致しました。</p>
        <a href="staff_list.php">戻る</a>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>