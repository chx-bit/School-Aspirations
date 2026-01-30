<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';
checkRole('siswa');
allowUsers();

$output_data = run('SELECT 
    i.id_pelaporan,
    a.id_aspirasi,
    s.nama_lengkap,
    s.kelas,
    k.ket_kategori,
    i.ket AS keluhan,
    i.tanggal_lapor,
    a.status,
    a.feedback
FROM Input_Aspirasi i
JOIN Siswa s ON i.nis = s.nis
JOIN Kategori k ON i.id_kategori = k.id_kategori
LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan
ORDER BY i.tanggal_lapor DESC;')->fetchAll();

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
LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan WHERE s.nis = ? ;', $_SESSION['nis'])->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/siswa.css">
    <title>Dashboard Siswa</title>
</head>

<body>
    <nav>
        <div class="nav-logo">
            <i data-feather="airplay"></i>
            Aspirasi Sekolah
        </div>
        <div class="btn-redirect-group">
            <a href="<?= BASE_URL ?>logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                Logout
            </a>
        </div>
    </nav>
    
    <div class="glow"></div>

    <h2>Riwayat Aspirasi Saya</h2>
    <div class="btn-cta">
        <a href="<?= BASE_URL ?>siswa/form.php" class="btn">
            <i data-feather="plus-circle" style="vertical-align: middle; margin-right: 5px;"></i>
            Buat Aspirasi Baru
        </a>
    </div>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Kategori</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($history)) : ?>
                <tr>
                    <td colspan="6" align="center">Belum ada riwayat aspirasi</td>
                </tr>
            <?php else : ?>
                <?php $no = 1; ?>
                <?php foreach ($history as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['id_pelaporan']; ?></td>
                        <td><?= $row['ket_kategori']; ?></td>
                        <td><?= $row['keluhan']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td><?= $row['feedback']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <h2>Semua Aspirasi Masuk</h2>
    <table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Siswa</th>
            <th>Kelas</th>
            <th>Kategori</th>
            <th>Keluhan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Feedback</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($output_data)) : ?>
            <tr>
                <td colspan="8" align="center">Data tidak tersedia</td>
            </tr>
        <?php else : ?>
            <?php $no = 1; ?>
            <?php foreach ($output_data as $row) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td><?= htmlspecialchars($row['kelas']); ?></td>
                    <td><?= htmlspecialchars($row['ket_kategori']); ?></td>
                    <td><?= nl2br(htmlspecialchars($row['keluhan'])); ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($row['tanggal_lapor'])); ?></td>
                    <td><?= $row['status'] ?? 'Menunggu'; ?></td>
                    <td><?= $row['feedback'] ?: '-'; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>
