<?php
require_once __DIR__ . '/../helpers/engine.php';
function filled(...$inputs){
  foreach ($inputs as $data){
    if (!isset($data) || trim($data) == '') {
      return false;
      exit;
    }
  }
  return true;
}
function clean(&...$inputs) {
  foreach ($inputs as &$data){
    $data = htmlspecialchars(trim($data));
  }
  return true;
}

function redirectTo($target) {
    $target = trim($target);
    $target = trim($target, '/');

    header('Location: ' . BASE_URL . $target);
    exit;
}

function allowSession($role,$data){
  session_regenerate_id(true);
  $_SESSION = [];
  $_SESSION['role'] = $role;
  
  foreach ($data as $key => $value){
    if($key !== 'password'){
      $_SESSION[$key] = $value;
    }
  }
}
function allowUsers() {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            redirectTo('admin/dashboard.php');
        } else {
            redirectTo('siswa/dashboard.php');
        }
        exit;
    }
}

