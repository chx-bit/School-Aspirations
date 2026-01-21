<?php
require_once __DIR__ . '/../helpers/engine.php';
if (!isset($_SESSION['role'])){
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}
