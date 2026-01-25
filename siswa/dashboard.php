<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';
checkRole('siswa');

$output_data = run('SELECT 
    i.id_pelaporan,
    s.nama_lengkap,
    k.ket_kategori,
    i.ket AS keluhan,
    a.status,
    a.feedback
FROM Input_Aspirasi i
JOIN Siswa s ON i.nis = s.nis
JOIN Kategori k ON i.id_kategori = k.id_kategori
LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan;')->fetchAll();

$history = run('SELECT 
    i.id_pelaporan,
    s.nama_lengkap,
    k.ket_kategori,
    i.ket AS keluhan,
    a.status,
    a.feedback
FROM Input_Aspirasi i
JOIN Siswa s ON i.nis = s.nis
JOIN Kategori k ON i.id_kategori = k.id_kategori
LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan WHERE s.nis = ? ;',$_SESSION['nis'])->fetchAll();
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
  <h1>iki all data</h1>
  <table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Pelaporan</th>
            <th>Nama Siswa</th>
            <th>Kategori</th>
            <th>Keluhan</th>
            <th>Status</th>
            <th>Feedback</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($output_data)) : ?>
            <tr>
                <td colspan="7" align="center">Data tidak tersedia</td>
            </tr>
        <?php else : ?>
            <?php $no = 1; ?>
            <?php foreach ($output_data as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_pelaporan']; ?></td>
                    <td><?= $row['nama_lengkap']; ?></td>
                    <td><?= $row['ket_kategori']; ?></td>
                    <td><?= $row['keluhan']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['feedback']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
    <br> 
    <h1>lek iki riwayat</h1>
  <table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Pelaporan</th>
            <th>Nama Siswa</th>
            <th>Kategori</th>
            <th>Keluhan</th>
            <th>Status</th>
            <th>Feedback</th>
        </tr>
    </thead>
    
    <tbody>
        <?php if (empty($history)) : ?>
            <tr>
                <td colspan="7" align="center">Data tidak tersedia</td>
            </tr>
        <?php else : ?>
            <?php $no = 1; ?>
            <?php foreach ($history as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_pelaporan']; ?></td>
                    <td><?= $row['nama_lengkap']; ?></td>
                    <td><?= $row['ket_kategori']; ?></td>
                    <td><?= $row['keluhan']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['feedback']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
  <a href="<?= BASE_URL ?>logout.php" 
   onclick="return confirm('Apakah Anda yakin ingin keluar?')">
   Keluar
   </a>
  <a href="<?= BASE_URL ?>siswa/form.php">FORM</a>
</body>
</html>
