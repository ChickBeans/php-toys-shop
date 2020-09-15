<?php
require('../common/dbconnect.php');

// 個別のページを用意する
$staff_id = htmlspecialchars($_GET['staff_id']);

// staff_idと一致するデータを取得する
$stmt = $db->prepare('SELECT * FROM mst_staff WHERE id=?');
$stmt->execute(array(
  $staff_id
));
$rec = $stmt->fetch();
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
        <h2>スタッフ削除</h2>
        <p>スタッフID：<?php echo $rec['id'] ?></p>
        <p>スタッフ名：<?php echo $rec['name'] ?></p>
        <form action="staff_delete_done.php" method="post">
          <input type="hidden" name="staff_id" value=<?php echo $rec['id'] ?>>
          <input type="hidden" name="staff_name" value=<?php echo $rec['name'] ?>>
          <div class="button--wrapper">
            <input class="button staff--button__back" type="button" onclick="history.back()" value="戻る">
            <input class="button staff--button__submit" type="submit" value="OK">
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