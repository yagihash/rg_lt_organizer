<?php
function issueToken() {
  $token = bin2hex(openssl_random_pseudo_bytes(32));
  $_SESSION["token"] = $token;
  return $token;
}

function checkToken($token) {
  return $_SESSION["token"] === $token;
}