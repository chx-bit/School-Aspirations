<?php
$host = '127.0.0.1';
$user = 'root';
$pass = 'db';
$db = 'aspirasi_sekolah';

try {
  //PDO DECLARATION
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

  //PDO ATRR
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $err) {
echo 'error mbot: ' . $err->getMessage();
}