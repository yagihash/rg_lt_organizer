<?php
require_once (__DIR__ . "/common.php");

$dest = isset($_SESSION['view_page']) ? $_SESSION['view_page'] : $base_url;
unset($_SESSION['view_page']);

if (isset($_SESSION["name"])) {
  header("Location: {$dest}");
  die("");
}

// validate posted parameter
$token = postParamValidate("token");
$login_name = postParamValidate("login_name");
$password = postParamValidate("password");
if (!($token and $login_name and $password)) {
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
