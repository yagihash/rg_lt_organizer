<?php
require_once (__DIR__ . "/common.php");

$_SESSION = array();
setcookie(session_name(), '', time() - 2592000, '/');
if (session_destroy()) {
  header("Secure-Session: 0");
  header("Location: {$base_url}/login.php");
}
