<?php
$utils = glob(__DIR__ . "/utils/*.php");
foreach ($utils as $file_path)
  require_once ($file_path);
