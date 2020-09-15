<?php
require('../common/dbconnect.php');

// 個別のページを用意する
$staff_id = htmlspecialchars($_GET['staff_id']);

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
        <h2>スタッフ情報参照</h2>
        <p>スタッフID：<?php echo $rec['id'] ?></p>
        <p>スタッフ名：<?php echo $rec['name'] ?></p>
          <div class="button--warapper">
            <input class="button staff--button__back" type="button" onclick="history.back()" value="戻る">
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