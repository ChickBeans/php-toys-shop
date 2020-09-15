<?php
if (!isset($_POST['pro_id'])) {
  if (isset($_POST['pro_add'])) {
    header('Location: pro_add.php?pro_id=' . $pro_id);
    exit();
  }
  header('Location: pro_ng.php');
  exit();
} else {
  $pro_id = $_POST['pro_id'];
  if (isset($_POST['pro_disp'])) {
    header('Location: pro_disp.php?pro_id=' . $pro_id);
    exit();
  }
  if (isset($_POST['pro_edit'])) {
    header('Location: pro_edit.php?pro_id=' . $pro_id);
    exit();
  }
  if (isset($_POST['pro_delete'])) {
    header('Location: pro_delete.php?pro_id=' . $pro_id);
    exit();
  }
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
          <h2 class="title">TOYS SHOP 管理画面</h2>
        </div>
      </header>
      <main class="main">
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>