<?php
if (!isset($_POST['staff_id'])) {
  if (isset($_POST['staff_add'])) {
    header('Location: staff_add.php?staff_id=' . $staff_id);
    exit();
  }
  header('Location: staff_ng.php');
  exit();
} else {
  $staff_id = $_POST['staff_id'];
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
      </main>
      <footer class="footer">
        <div class="footer--inner">
        </div>
      </footer>
    </div>
  </div>

</body>

</html>