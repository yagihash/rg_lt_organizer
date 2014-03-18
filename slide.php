<?php
require_once (__DIR__ . "/common.php");

// file a2fd468a4ec4d3074920.pdf
$file_name = isset($_GET["f"]) ? $_GET["f"] : "";
$file_path = "./slides/" . basename($file_name);
if ($isAuthed or preg_match("/\A\.\/slides\/[a-z0-9]{20}\.pdf\z/", $file_path) or file_exists($file_path)) {
  header("Content-Type: application/pdf");
  readfile($file_path);
} else {
  header("HTTP/1.1 403 Forbidden");
  die("403 Forbidden");
}
