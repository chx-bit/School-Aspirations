<?php
function filled(...$inputs){
  foreach ($inputs as $data){
    if (!isset($data) || trim($data) == '') {
      return false;
    }
  }
  return true;
}
function purify(&...$inputs) {
  foreach ($inputs as &$data){
    $data = htmlspecialchars(trim($data));
  }
}
