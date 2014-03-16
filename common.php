<?php
$utils = glob(__DIR__ . "/utils/*.php");
foreach ($utils as $file_path)
  require_once ($file_path);

$base_url = dirname($_SERVER["SCRIPT_NAME"]);

ini_set("session.use_only_cookies", 1);
ini_set("session.cookie_httponly", true);
ini_set("session.gc_maxlifetime", 60 * 60 * 10);
