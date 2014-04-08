<?php
function postParamValidate($param) {
  return (isset($_POST[$param]) and !is_array($_POST[$param])) ? $_POST[$param] : false;
}

function escapeHTML($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
function hashPassword($pass){
  $t_hasher = new PasswordHash(4, FALSE);
  return $t_hasher->HashPassword($pass);
}

function checkPassword($pass,$hash){
  $t_hasher = new PasswordHash(4, FALSE);
  return $t_hasher->CheckPassword($pass,$hash);
}
