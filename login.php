<?php
require_once (__DIR__ . "/common.php");

$dest = isset($_SESSION['view_page']) ? $_SESSION['view_page'] : $base_url;
unset($_SESSION['view_page']);

if (isset($_SESSION["name"])) {
  header("Location: {$dest}");
  die("");
}

// validate posted parameter
if (isset($_POST["token"]) and checkToken($_POST["token"]) and isset($_POST["login_name"]) and !is_array($_POST["login_name"]) and isset($_POST["password"]) and !is_array($_POST["password"])) {
  $login_name = $_POST["login_name"];
  $password = $_POST["password"];
} else {
  header("Location: {$dest}");
  die("");
}

// $LDAP_CON = new $LDAP_IF();
// $auth = $LDAP_CON -> auth($login_name, $password);
$auth = TRUE;
if ($auth) {
  $_SESSION["name"] = $login_name;
  header("Location: {$dest}");
  die("");
}
