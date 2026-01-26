<?php
//SET
session_set_cookie_params(3600);
date_default_timezone_set('Asia/Jakarta');
session_start();

//BASE URL
$serveo = 'https://aspirations.serveousercontent.com/';
$local = 'http://0.0.0.0:8080/';
define('BASE_URL', $local);
function dbConnect() {
  $host = '127.0.0.1';
  $user = 'root';
  $pass = 'db';
  $db   = 'aspirasi_sekolah';
  static $pdo = null;

  if ($pdo === null) {
    $pdo = new PDO(
      "mysql:host=$host;dbname=$db",
      "$user",
      "$pass"
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  return $pdo;
}


function run($query, ...$params) {
  $pdo  = dbConnect();
  $stmt = $pdo->prepare($query);
  $stmt->execute($params);
  
  return $stmt;
}
