<?php
function postParamValidate($param) {
  return (isset($_POST[$param]) and !is_array($_POST[$param])) ? $_POST[$param] : false;
}
