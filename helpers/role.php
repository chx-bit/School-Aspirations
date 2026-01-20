<?php
if ($_SESSION['role'] !== 'admin') {
    header('Location: ' . BASE_URL . 'siswa/dashboard.php');
    exit;
}

if ($_SESSION['role'] !== 'siswa') {
    header('Location: ' . BASE_URL . 'admin/dashboard.php');
    exit;
}
