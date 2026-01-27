<?php
//SET
session_set_cookie_params(3600);
date_default_timezone_set('Asia/Jakarta');
session_start();

//BASE URL
$protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off") ? "https://" : "http://";
$host = $_SERVER["HTTP_HOST"];
$path = str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
$project_name = explode("/", $path)[1];
$base_url = $protocol . $host . "/" . $project_name;

define("BASE_URL", $base_url);
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
