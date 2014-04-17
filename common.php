<?php
// for debugging
ini_set("error_reporting", E_ALL);
ini_set("display_errors", "1");
ini_set("session.cookie_httponly", 1);

date_default_timezone_set('Asia/Tokyo');

require_once (__DIR__ . "/lib/passwordhash.php");
$utils = glob(__DIR__ . "/utils/*.php");
foreach ($utils as $file_path)
  require_once ($file_path);

require_once (__DIR__ . "/lib/j4mie/idiorm.php");
ORM::configure("sqlite:./.rg.sqlite");
require_once (__DIR__ . "/lib/j4mie/paris.php");

spl_autoload_register(function ($class) {
  include_once (__DIR__ . "/class/" . $class . ".php");
});


$base_url = dirname($_SERVER["SCRIPT_NAME"]);

ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_httponly", true);
ini_set("session.gc_maxlifetime", 60 * 60 * 10);
session_start();

$isAuthed = isset($_SESSION["current_id"]);
$current_user = false;
if ($isAuthed) {
  session_regenerate_id(true);
  $current_user = User::find_one($_SESSION["current_id"]);
}
