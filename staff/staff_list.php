<?php
require('../common/dbconnect.php');

$stmt = $db->query('SELECT id, name FROM mst_staff;');

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
        <h2>スタッフ一覧</h2>
        <form method="post" action="staff_branch.php">
          <table border="1" class="staff--list">
            <tr>
              <th>選択</th>
              <th>スタッフID</th>
              <th>スタッフ名</th>
            </tr>
            <?php while (true) {
              $rec = $stmt->fetch();
              var_dump($rec['id']);
              // 値が取得できなくなった場合→処理をやめる
              if ($rec === false) {
                break;
              }
            ?>
              <tr>
                <!-- radioボタンにid情報を格納 -->
                <td><input type="radio" name="staff_id" value="<?php echo $rec['id'] ?>"></td>
                <td><?php echo $rec['id'] ?></td>
                <td><?php echo $rec['name'] ?></td>
              </tr>
            <?php
            } ?>
          </table>
          <input class="button staff--button__edit" type="submit" name="staff_disp" value="参照">
          <input class="button staff--button__edit" type="submit" name="staff_add" value="追加">
          <input class="button staff--button__edit" type="submit" name="staff_edit" value="修正">
          <input class="button staff--button__edit" type="submit" name="staff_delete" value="削除">
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