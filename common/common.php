<?php
// sanitaizeして返す
function sanitize($before)
{
    foreach ($before as $key => $value) {
        $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $after;
}

function clearSession($session) {
  session_start();
  $session = array();
  if (isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time()-42000, '/');
  }
  session_destroy();
}
