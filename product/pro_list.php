<?php
require('../common/dbconnect.php');

$stmt = $db->query('SELECT id, name, price FROM mst_product;');

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
        <h2>商品管理画面</h2>
        <form method="post" action="pro_branch.php">
          <table border="1" class="pro--list">
            <tr>
              <th>選択</th>
              <th>商品ID</th>
              <th>商品名</th>
              <th>価格</th>
            </tr>
            <!-- DBから取得したデータを表示する -->
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
                <td><input type="radio" name="pro_id" value="<?php echo $rec['id'] ?>"></td>
                <td><?php echo $rec['id'] ?></td>
                <td><?php echo $rec['name'] ?></td>
                <td><?php echo $rec['price'] ?></td>
              </tr>
            <?php
            } ?>
          </table>
          <input class="button pro--button__edit" type="submit" name="pro_disp" value="参照">
          <input class="button pro--button__edit" type="submit" name="pro_add" value="追加">
          <input class="button pro--button__edit" type="submit" name="pro_edit" value="修正">
          <input class="button pro--button__edit" type="submit" name="pro_delete" value="削除">
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