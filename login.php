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

$authinfra = new Authenticator();
$current_user = $authinfra -> passwordAuth($login_name, $password);
//$auth = TRUE;
if ($current_user !== false) {
  $_SESSION["name"] = $current_user->login_name;
  $_SESSION["current_id"] = $current_user->id;
  header("Location: {$dest}");
  die("");
} else {
?>

<!DOCTYPE html>

<html lang="ja">
  <head>
<?php
require_once (__DIR__ . "/head.php");
?>
  </head>

  <body>
<?php
require_once(__DIR__ . "/top_bar.php");
?>
    <div id="wrap">
<?php
require_once(__DIR__ . "/page_header.php");
?>
      <div id="main" class="content">
        <h2>Error</h2>
        <p>
          Login error.
        </p>
      </div>
    </div>
  </body>
</html>


<?php
}
