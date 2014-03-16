<?php
require_once (__DIR__ . "/common.php");

if (isset($_SESSION["name"])) {
  header("Location: {$base_url}/");
  die("");
}

// validate posted parameter
if (isset($_POST["login_name"]) and
    !is_array($_POST["login_name"]) and
    isset($_POST["password"]) and
    !is_array($_POST["password"])) {
  $login_name = $_POST["login_name"];
  $password = $_POST["password"];
} else {
  header("Location: {$base_url}/");
  die("");
}

// $LDAP_CON = new $LDAP_IF();
// $auth = $LDAP_CON -> auth($login_name, $password);
$auth = TRUE;
if($auth) {
  $_SESSION["name"] = $login_name;
  header("Location: {$base_url}/");
  die("");
}
?>
<!DOCTYPE html>

<html lang="ja">
  <head>
    <?php
    require_once (__DIR__ . "/head.php");
    ?>
  </head>

  <body>

  </body>
</html>