<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = sanitize($_POST);

// カート内合計数を確認
$max = $post['max'];

// カート内の商品数だけループを回す
for($i=0; $i<$max; $i++) {
  $pro_quantity[] = $post['pro_quantity' . $i];
}

$cart = $_SESSION['cart'];

// チェックが付いた商品を削除する
for($i=$max; 0<=$i; $i--) {
  if(isset($_POST['pro_delete' . $i])) {
    array_splice($cart, $i , 1);
    array_splice($pro_quantity, $i , 1);
  }
}

$_SESSION['cart'] = $cart;
$_SESSION['pro_quantity'] = $pro_quantity;

header('Location: shop_cartlook.php');
exit();
