<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';

checkRole('admin');

$id = $_GET['id_pelaporan'] ?? null;
if (!$id) {
    redirectTo('admin/dashboard.php');
    exit;
}

if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];

    run("UPDATE Aspirasi SET status = ?, feedback = ? WHERE id_pelaporan = ?", 
        $status, $feedback, $id);
    redirectTo('dashboard.php');
    exit;
}

$sql = "SELECT i.id_pelaporan, i.ket, i.lokasi, s.nama_lengkap, k.ket_kategori, a.status, a.feedback 
        FROM Input_Aspirasi i
        JOIN Siswa s ON i.nis = s.nis
        JOIN Kategori k ON i.id_kategori = k.id_kategori
        LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan
        WHERE i.id_pelaporan = ?";

$data = run($sql, $id)->fetch();

if (!$data) exit("Data tidak ditemukan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aspirasi</title>
</head>
<body>
    <h2>Tindak Lanjut Aspirasi</h2>
    <a href="dashboard.php">Kembali</a>
    <hr>
    <table border="0" cellpadding="8">
        <tr>
            <td>ID Laporan</td>
            <td>: <?= $data['id_pelaporan'] ?></td>
        </tr>
        <tr>
            <td>Pelapor</td>
            <td>: <?= $data['nama_lengkap'] ?></td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>: <?= $data['ket_kategori'] ?></td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>: <?= $data['lokasi'] ?></td>
        </tr>
        <tr>
            <td>Keluhan</td>
            <td>: <?= $data['ket'] ?></td>
        </tr>
    </table>
    <hr>
    <form method="POST">
        <label>Status:</label><br>
        <select name="status">
            <option value="Menunggu" <?= ($data['status'] == 'Menunggu') ? 'selected' : '' ?>>Menunggu</option>
            <option value="Proses" <?= ($data['status'] == 'Proses') ? 'selected' : '' ?>>Proses</option>
            <option value="Selesai" <?= ($data['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
        </select>
        <br><br>
        <label>Feedback:</label><br>
        <textarea name="feedback" rows="5" cols="50" required><?= $data['feedback'] ?></textarea>
        <br><br>
        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
</body>
</html>