<?php
require_once (__DIR__ . "/common.php");

ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_httponly", true);
ini_set("session.gc_maxlifetime", 60 * 60 * 10);

session_start();
$_SESSION = array();
setcookie(session_name(), '', time() - 2592000, '/');
if (session_destroy()) {
  header("Secure-Session: 0");
  header("Location: " . $base_url . "/login.php");
}
