<?php
// for debugging
ini_set('error_reporting', E_ALL);
ini_set('display_errors', '1');
ini_set('session.cookie_httponly', 1);

$utils = glob(__DIR__ . "/utils/*.php");
foreach ($utils as $file_path)
  require_once ($file_path);

require_once __DIR__ . '/lib/j4mie/idiorm.php';
ORM::configure('mysql:dbname=rg;host=127.0.0.1;charset=utf8;');
ORM::configure('username', 'rg');
ORM::configure('password', 'smARFbVawcUXCKaj');
require_once __DIR__ . '/lib/j4mie/paris.php';

spl_autoload_register(function ($class) {
    include_once __DIR__ . '/class/' . $class . '.php';
});


$base_url = dirname($_SERVER["SCRIPT_NAME"]);

ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_httponly", true);
ini_set("session.gc_maxlifetime", 60 * 60 * 10);
session_start();

$isAuthed = isset($_SESSION["name"]);
if ($isAuthed) {
  session_regenerate_id(true);
}
