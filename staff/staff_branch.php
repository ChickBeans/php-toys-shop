<?php
session_start();
session_regenerate_id(true);

// staff_login_checkでセッション変数が登録されていない場合、ログインが面へ移行する
if (!isset($_SESSION['staff_login'])) {
  $error['staff_login'] = 'failed';
  header('Location: ../staff_login/staff_login.html');
  exit();
}

// スタッフが選択されている場合
if (!isset($_POST['staff_id'])) {
  if (isset($_POST['staff_add'])) {
    header('Location: staff_add.php?staff_id=' . $staff_id);
    exit();
  }
  header('Location: staff_ng.php');
  exit();
} else {
  $staff_id = $_POST['staff_id'];
  if (isset($_POST['staff_add'])) {
    $error['staff_add'] = 'selected';
  }
  if (isset($_POST['staff_disp'])) {
    header('Location: staff_disp.php?staff_id=' . $staff_id);
    exit();
  }
  if (isset($_POST['staff_edit'])) {
    header('Location: staff_edit.php?staff_id=' . $staff_id);
    exit();
  }
  if (isset($_POST['staff_delete'])) {
    header('Location: staff_delete.php?staff_id=' . $staff_id);
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

        <?php if ($error['staff_add'] === 'selected') : ?>
          <p class="error">※スタッフを選択せずに「追加」ボタンを押下してください。</p>
          <input class="button staff--button__back" type="button" onclick="history.back()" value="戻る">
        <?php endif ?>
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>