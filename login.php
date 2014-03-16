<?php
require_once (__DIR__ . "/common.php");

session_start();
if (isset($_SESSION["name"]))
  session_regenerate_id(true);

if (isset($_SESSION["name"])) {
  header("Location: " . $base_url . "/");
  die("");
}

// validate posted parameter
if (isset($_POST["login_name"]) and
    !is_array($_POST["login_name"]) and
    isset($_POST["password"]) and
    !is_array($_POST["password"])) {
  $login_name = $_POST["name"];
  $password = $_POST["password"];
}

$LDAP_CON = new $LDAP_IF();
$auth = $LDAP_CON -> auth($login_name, $password);
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