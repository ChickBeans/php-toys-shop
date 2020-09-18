<?php
// sanitaizeして返す
function sanitize($before)
{
  foreach ($before as $key => $value) {
    $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
  return $after;
}

// セッションを削除する。
function clearSession($session)
{
  session_start();
  $session = array();
  if (isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
  }
  session_destroy();
}

?>

<!-- 年のプルダウンを作成 -->
<?php function create_pulldown_year()
{ ?>
  <select name="year">
    <?php for ($i = 2017; $i <= 2020; $i++) : ?>
      <option value="<?php echo $i ?>"><?php echo $i ?></option>
    <?php endfor ?>
  </select>
<?php } ?>
<!-- 月のプルダウンを作成 -->
<?php function create_pulldown_month()
{ ?>
  <select name="month">
    <?php for ($i = 1; $i <= 12; $i++) : ?>
      <?php if ($i < 10) : ?>
        <option value="<?php echo '0' . $i ?>"><?php echo $i ?></option>
      <?php else : ?>
        <option value="<?php echo $i ?>"><?php echo $i ?></option>
      <?php endif ?>
    <?php endfor ?>
  </select>
<?php } ?>

<!-- 日のプルダウンを作成 -->
<?php function create_pulldown_day()
{ ?>
  <select name="day">
    <?php for ($i = 1; $i <= 31; $i++) : ?>
      <?php if ($i < 10) : ?>
        <option value="<?php echo '0' . $i ?>"><?php echo $i ?></option>
      <?php else : ?>
        <option value="<?php echo $i ?>"><?php echo $i ?></option>
      <?php endif ?>
    <?php endfor ?>
  </select>
<?php } ?>

<!-- 生まれた年代のプルダウンを作成 -->
<?php function create_pulldown_birth()
{ ?>
  <select name="birth">
    <?php for ($i = 1920; $i <= 2020; $i += 10) : ?>
        <option value="<?php echo $i ?>"><?php echo $i ?></option>
    <?php endfor ?>
  </select>
<?php } ?>