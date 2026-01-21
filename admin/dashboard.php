<?php
session_start();
require_once '../helpers/engine.php';
require_once '../helpers/auth.php';
require_once '../helpers/role.php';
require_once '../helpers/functions.php';
checkRole('admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <a href="<?= BASE_URL ?>logout.php" 
   onclick="return confirm('Apakah Anda yakin ingin keluar?')">
   keluar
   </a>
</body>
</html>
