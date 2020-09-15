<?php
session_start();
require('../common/dbconnect.php');

var_dump($_POST);

$staff_id = $_POST['staff_id'];
$staff_name = $_POST['staff_name'];

$staff_id = htmlspecialchars($staff_id, ENT_QUOTES, 'UTF-8');
$staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');

if (!isset($_SESSION['staff_edit'])) {
  header('Location: staff_add.php');
} else {
// 画面に表示されているユーザーのデータを修正
$stmt = $db->prepare('DELETE FROM mst_staff WHERE id=?');
$stmt->execute(array(
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
      <p>スタッフ名：<?php echo $staff_name ?>様をデータから削除致しました。</p>
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