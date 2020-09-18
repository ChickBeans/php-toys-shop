<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');


if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
} else {
  // 注文情報を(dat_sales, dat_sales_product, mst_product)テーブルから取得,($_POST[year, month, day])
  $stmt = get_order($_POST);
  
  // csv出力用にデータを加工する
  $csv = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
  $csv .= "\n";
  while (true) {
    $rec = $stmt->fetch();
    if (empty($rec)) {
      break;
    } else {
      $csv .= $rec['id'];
      $csv .= ",";
      $csv .= $rec['date'];
      $csv .= ",";
      $csv .= $rec['member_id'];
      $csv .= ",";
      $csv .= $rec['ds_name'];
      $csv .= ",";
      $csv .= $rec['email'];
      $csv .= ",";
      $csv .= $rec['postal1'] . '-' . $rec['postal2'];
      $csv .= ",";
      $csv .= $rec['address'];
      $csv .= ",";
      $csv .= $rec['tel'];
      $csv .= ",";
      $csv .= $rec['product_id'];
      $csv .= ",";
      $csv .= $rec['mp_name'];
      $csv .= ",";
      $csv .= $rec['price'];
      $csv .= ",";
      $csv .= $rec['quantity'];
      $csv .= "\n";
    }
  }
  // csv向けにファイル文字コードの変換
  $file = fopen('./order_csv/'. date("Y/m/t") . 'order.csv', 'w');
  $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
  fputs($file, $csv);
  fclose($file);
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
        </header>
        <main class="main">
          <a href="order.csv">注文データのダウンロード</a>
          <a href="order_download.csv">日付選択へ</a>
        </div>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>