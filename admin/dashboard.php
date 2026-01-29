<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';

checkRole('admin');

$log = '';
$list_kat = [
  1 => 'Fasilitas & Sarana',
  2 => 'Kebersihan Lingkungan',
  3 => 'Kurikulum & Pembelajaran',
  4 => 'Keamanan Sekolah',
  5 => 'Kedisiplinan Siswa',
  6 => 'Ekstrakurikuler',
  7 => 'Kantin & Konsumsi',
  8 => 'Layanan Administrasi',
  9 => 'Kesehatan & UKS',
  10 => 'Lainnya'
];

if (isset($_POST['filter'])) {
  $date = $_POST['date'] ?? null;
  $nis = (int) $_POST['nis'] ?? null;
  $kategori = $_POST['kategori'] ?? null;
  $status = $_POST['status'] ?? null;

  if (!$date && !$nis && !$kategori && !$status) {
    $log = 'Tidak ada filter yang dipilih. Menampilkan semua data.';
  } else {
    try {
      $sql = '
        SELECT
          i.id_pelaporan,
          s.nama_lengkap,
          k.ket_kategori,
          i.ket AS keluhan,
          a.status,
          a.feedback
        FROM Input_Aspirasi i
        JOIN Siswa s ON i.nis = s.nis
        JOIN Kategori k ON i.id_kategori = k.id_kategori
        LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan
        WHERE 1=1
      ';

      $params = [];

      if ($date) {
        $sql .= ' AND DATE(i.tanggal_lapor) = ?';
        $params[] = $date;
      }

      if ($nis) {
        $sql .= ' AND i.nis = ?';
        $params[] = $nis;
      }

      if ($kategori) {
        $sql .= ' AND k.id_kategori = ?';
        $params[] = $kategori;
      }

      if ($status) {
        $sql .= ' AND a.status = ?';
        $params[] = $status;
      }

      $filter_data = run($sql, ...$params)->fetchAll();
      if (empty($filter_data)) {
        $log = 'Tidak Menemukan Data';
      }
    } catch (Exception $e) {
      $log = $e;
    }
  }
}

$output_data = run(
  'SELECT
    i.id_pelaporan,
    s.nama_lengkap,
    k.ket_kategori,
    i.ket AS keluhan,
    a.status,
    a.feedback
   FROM Input_Aspirasi i
   JOIN Siswa s ON i.nis = s.nis
   JOIN Kategori k ON i.id_kategori = k.id_kategori
   LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan
   ORDER BY i.id_pelaporan ASC'
)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description" content="Aspirasi-sekolah ypm 4 taman" />
  <link rel="stylesheet" href="../assets/admin.css">
  <title>Document</title>
</head>

<body>
  <nav>
    <div class="nav-logo">
      <i data-feather="airplay"></i>
      Aspirasi Sekolah
    </div>
    <div style="display: flex; gap: 1rem;">
      <a
        href="<?= BASE_URL ?>logout.php"
        onclick="return confirm('Apakah Anda yakin ingin keluar?')">
        Logout
      </a>
      <a
        href="<?= BASE_URL ?>admin/report.php">
        Print Report
      </a>
    </div>

  </nav>
  <div class="glow">
  </div>
  <div class="filterForm">
    <form method="POST">
      <h2>Filter Data</h2>

      <div class="containerFilter">
        <div class="input-group">
          <label>Tanggal</label>
          <input type="date" name="date" />
        </div>

        <div class="input-group">
          <label>NIS</label>
          <input type="number" name="nis" />
        </div>

        <div class="input-group">
          <label>Kategori</label>
          <select name="kategori" id="id_kategori">
            <option value="" disabled selected>-- Pilih Kategori --</option>
            <?php foreach ($list_kat as $id => $nama) : ?>
              <option value="<?= $id; ?>"><?= $nama; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="input-group">
          <label>Status</label>
          <select name="status">
            <option value="" disabled selected>-- Status --</option>
            <option value="Selesai">Selesai</option>
            <option value="Menunggu">Menunggu</option>
            <option value="Proses">Proses</option>
          </select>
        </div>
      </div>

      <div class="form-action">
        <button class="btn" type="submit" name="filter">Filter</button>
      </div>
    </form>
  </div>

  <h1><?= $log ?></h1>

  <?php if (!empty($filter_data)) : ?>
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
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <?php foreach ($filter_data as $row) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['id_pelaporan']; ?></td>
            <td><?= $row['nama_lengkap']; ?></td>
            <td><?= $row['ket_kategori']; ?></td>
            <td><?= $row['keluhan']; ?></td>
            <td><?= $row['status']; ?></td>
            <td><?= $row['feedback']; ?></td>
            <?php if ($row['status'] !== 'Selesai') : ?>
              <td>
                <a href="edit.php?id_pelaporan=<?= $row['id_pelaporan']; ?>">
                  Edit
                </a>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>


  <table border="1" cellpadding="8" cellspacing="0" class="table-all">
    <thead>
      <tr>
        <th>No</th>
        <th>ID Pelaporan</th>
        <th>Nama Siswa</th>
        <th>Kategori</th>
        <th>Keluhan</th>
        <th>Status</th>
        <th>Feedback</th>
        <th>Aksi</th>
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
            <?php if ($row['status'] !== 'Selesai') : ?>
              <td>
                <a href="edit.php?id_pelaporan=<?= $row['id_pelaporan']; ?>">
                  Edit
                </a>
              </td>
            <?php endif; ?>
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