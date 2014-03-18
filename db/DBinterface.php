<?php
require_once (__DIR__ . "/../utils/DBreader.php");
require_once (__DIR__ . "/../utils/DBwriter.php");

class DBinterface {
  private $host, $user, $pass, $db;
  public $Reader, $Writer;

  public function __construct() {
    $this -> host = "localhost";
    $this -> user = "user";
    $this -> pass = "password";
    $this -> db = "todo";
    $this -> Reader = new DBreader();
    $this -> Writer = new DBwriter();
  }
  
  
}
