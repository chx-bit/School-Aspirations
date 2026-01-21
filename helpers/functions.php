<?php
require_once 'engine.php';
function filled(...$inputs){
  foreach ($inputs as $data){
    if (!isset($data) || trim($data) == '') {
      return false;
      exit;
    }
  }
  return true;
}
function purify(&...$inputs) {
  foreach ($inputs as &$data){
    $data = htmlspecialchars(trim($data));
  }
}
function redirectTo($target) {
  return header('Location: ' . BASE_URL . $target);
}
function adminSession($role, $username) {
  $_SESSION = [];
  $_SESSION['role'] = $role;
  $_SESSION['username'] = $username;
}
function siswaSession($role, $long_name, $nis) {
  $_SESSION = [];
  $_SESSION['role'] = $role;
  $_SESSION['nama_lengkap'] = $long_name;
  $_SESSION['nis'] = $nis;
}
function isLogIn() {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            redirectTo('admin/dashboard.php');
        } else {
            redirectTo('siswa/dashboard.php');
        }
        exit;
    }
}

