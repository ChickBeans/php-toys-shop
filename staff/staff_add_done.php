<?php
session_start();
require('../common/dbconnect.php');

if (!isset($_SESSION['staff_join'])) {
  header('Location: staff_add.php');
} else {
  $stmt = $db->prepare('INSERT INTO mst_staff SET name=?, password=?');
  $stmt->execute(array(
    $_SESSION['staff_join']['staff_name'],
    md5($_SESSION['staff_join']['staff_pass'])
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
        <p><?php echo $_SESSION['staff_join']['staff_name'] ?>　を登録致しました。</p>
        <a href="staff_list.php">戻る</a>
        <?php
        // 再登録防止の為、セッション内容を破棄するここうまく行ってない…
        unset($_SESSION['join']);
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