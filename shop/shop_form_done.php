<?php
session_start();
session_regenerate_id(true);

require('../common/dbconnect.php');
require_once('../common/common.php');

$post = sanitize($_POST);

$name = $post['name'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];
// 会員登録用
$order = $post['order'];
$pass = $post['pass'];
$gender = $post['gender'];
$birth = $post['birth'];

if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
  $pro_quantity = $_SESSION['pro_quantity'];
  $max = count($cart);
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
          <h2 class="title">TOYS SHOP</h2>
        </div>
      </header>
      <main class="main">
        <?php
        // メール本文を作成する
        $message = "";
        $message .= $name . "様\n\n この度はご注文ありがとうございました。\n";
        $message .= "\n";
        $message .= "ご注文商品\n";
        $message .= "--------------------------\n";

        for ($i = 0; $i < $max; $i++) {
          $stmt = $db->prepare('SELECT * FROM mst_product WHERE id=?');
          $stmt->execute(array(
            $cart[$i]
          ));
          $rec = $stmt->fetch();

          $pro_name = $rec['name'];
          $pro_price = $rec['price'];
          $pro_price_ary[] = $pro_price;
          $sum_pro_quantity = $pro_quantity[$i];
          $sum_pro_price = $pro_price * $sum_pro_quantity;

          $message .= "・" . $pro_name . " ";
          $message .= $pro_price .  "円 x";
          $message .= $sum_pro_quantity . "個 =";
          $message .= $sum_pro_price . "円 \n";
        }

        // 登録処理が終了するまでデータベースに書き込み制限をかける
        $stmt = $db->query('LOCK TABLES dats_sales WRITE, dat_sales_product WRITE');

        // 会員登録する場合、dat_membersテーブルに情報を登録する
        $last_member_id = 0;
        if ($order === 'order_reg') {
          $stmt = $db->prepare('INSERT INTO dat_member SET password=?, name=?, email=?, postal1=?, postal2=?, address=?, tel=?, gender=?, birth=?');
          $stmt->execute(array(
            md5($pass),
            $name,
            $email,
            $postal1,
            $postal2,
            $address,
            $tel,
            $gender,
            $birth
          ));

          $stmt = $db->query('SELECT LAST_INSERT_ID()');
          $rec = $stmt->fetch();
          // 最後にdat_memberテーブルに書き込みをしたIDを取得
          $last_member_id = $rec['LAST_INSERT_ID()'];
        }

        // dat_salesテーブルに購入者情報を登録する
        $stmt = $db->prepare('INSERT INTO dat_sales SET member_id=?, name=?, email=?, postal1=?, postal2=?, address=?, tel=?');
        $stmt->execute(array(
          $last_member_id,
          $name,
          $email,
          $postal1,
          $postal2,
          $address,
          $tel
        ));

        // 最後にDBに書き込んだIDを取得する
        $stmt = $db->query('SELECT LAST_INSERT_ID()');
        $rec = $stmt->fetch();
        $last_id = $rec['LAST_INSERT_ID()'];

        // dat_sales_productテーブルに購入情報（商品）を登録する。
        for ($i = 0; $i < $max; $i++) {
          $stmt = $db->prepare('INSERT INTO dat_sales_product SET sales_id=?, product_id=?, price=?, quantity=?');
          $stmt->execute(array(
            $last_id,
            $cart[$i],
            $pro_price_ary[$i],
            $pro_quantity[$i],
          ));
        }

        // 登録処理が終了したのでデータベースの書き込み制限を解除する
        $stmt = $db->query('UNLOCK TABLES');

        $message .= "送料は無料です。 \n";
        $message .= "--------------------------\n";
        if ($order === 'order_reg') {
          $message .= "会員登録が完了致しました。\n";
          $message .= "次回からメールアドレスとパスワードを入力しログインしてください。\n";
          $message .= "ご注文が簡単にできる用になります。";
          $message .= "\n";
        }
        $message .= "\n";
        $message .= "代金は以下の口座にお振込みください。\n";
        $message .= "おもちゃ銀行 遠い支店 普通口座0000000\n";
        $message .= "入金が取れ次第発送させていただきます。";
        $message .= "\n";
        $message .= "□□□□□□□□□□□□□□□□□□□□□□□□□\n";
        $message .= "〜個性がいっぱいのおもちゃ箱〜\n";
        $message .= "\n";
        $message .= "石川県能美市鬼瓦2-23\n";
        $message .= "電話：076-111-1111\n";
        $message .= "メール：contactKusakaForm@gmail.com\n";
        $message .= "□□□□□□□□□□□□□□□□□□□□□□□□□\n";

        // お客様宛ての注文確認メールを作成、送信する。
        $title = 'ご注文ありがとうございます';
        $header = 'From:konnabakanakimochi@yahoo.co.jp';
        $message = html_entity_decode($message, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email, $title, $message, $header);

        // お店宛の注文確認メールを作成、送信する
        $title = 'ご注文ありがとうございます';
        $header = 'From:' . $email;
        $message = html_entity_decode($message, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('konnabakanakimochi@yahoo.co.jp', $title, $message, $header);

        // セッションをクリアする
        clearSession($_SESSION);
        ?>
        <p><?php echo $name ?>様</p>
        <p>ご注文ありがとうございました</p>
        <p><?php echo $email ?>にメールをお送りしましたのでご確認ください。</p>
        <p>商品は以下の住所にお送りさせていただきます。</p>
        <p><?php echo '〒 ' . $postal1 . '-' . $postal2 ?></p>
        <p><?php echo $address ?></p>
        <p><?php echo '☎ ' . $tel ?></p>
        <a href="shop_list.php">商品画面へ</a>
      </main>
      <footer class.="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>