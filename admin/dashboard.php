<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';
checkRole('admin');
allowUsers();

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

$base_sql = 'SELECT
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
LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan';

if (isset($_POST['filter'])) {
  $date = $_POST['date'] ?? null;
  $nis_name = $_POST['nis_name'] ?? null;
  $kategori = $_POST['kategori'] ?? null;
  $status = $_POST['status'] ?? null;
  $kelas = $_POST['kelas'] ?? null;

  if (!$date && !$nis_name && !$kategori && !$status && !$kelas) {
    $log = 'Tidak ada filter yang dipilih. Menampilkan semua data.';
  } else {
    $sql = $base_sql . ' WHERE 1=1';
    $params = [];

    if ($date) {
      $sql .= ' AND DATE(i.tanggal_lapor) = ?';
      $params[] = $date;
    }

    if ($nis_name) {
      if (is_numeric($nis_name)) {
        $sql .= ' AND i.nis = ?';
        $params[] = (int) $nis_name;
      } else {
        $sql .= ' AND s.nama_lengkap LIKE ?';
        $params[] = $nis_name . '%';
      }
    }

    if ($kategori) {
      $sql .= ' AND k.id_kategori = ?';
      $params[] = $kategori;
    }

    if ($status) {
      $sql .= ' AND a.status = ?';
      $params[] = $status;
    }

    if ($kelas) {
      $sql .= ' AND s.kelas = ?';
      $params[] = $kelas;
    }

    $filter_data = run($sql, ...$params)->fetchAll();

    if (empty($filter_data)) {
      $log = 'Tidak Menemukan Data';
    }
  }
}

$output_data = run(
  $base_sql . ' ORDER BY i.tanggal_lapor DESC'
)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="Aspirasi-sekolah ypm 4 taman" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
    <title>Document</title>
  </head>
  <body>
    <nav>
      <div class="nav-logo">
        <i data-feather="airplay"></i>
        Aspirasi Sekolah
      </div>
      <div style="display: flex; gap: 1rem">
        <a
          href="<?= BASE_URL ?>logout.php"
          onclick="return confirm('Apakah Anda yakin ingin keluar?')"
        >
          Logout
        </a>
        <a href="<?= BASE_URL ?>admin/report.php">Print Report</a>
      </div>
    </nav>

    <div class="glow"></div>

    <div class="filterForm">
      <form method="POST">
        <h2>Filter Data</h2>

        <div class="containerFilter">
          <div class="input-group">
            <label>Tanggal</label>
            <input type="date" name="date" />
          </div>

          <div class="input-group">
            <label>NIS atau Nama Siswa</label>
            <input
              type="text"
              maxlength="50"
              name="nis_name"
              placeholder="Masukkan NIS atau Nama Lengkap Siswa"
            />
          </div>

          <div class="input-group">
            <label>Kategori</label>
            <select name="kategori">
              <option value="" disabled selected>
                -- Pilih Kategori --
              </option>
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

          <div class="input-group">
            <label>Kelas</label>
            <select name="kelas" required>
              <option value="" disabled selected>-- Pilih Kelas --</option>

              <optgroup label="KELAS X">
                <option value="X RPL">X RPL</option>
                <option value="X TAV">X TAV</option>
                <option value="X TKR 1">X TKR 1</option>
                <option value="X TKR 2">X TKR 2</option>
                <option value="X TKR 3">X TKR 3</option>
                <option value="X TKR 4">X TKR 4</option>
                <option value="X TKR 5">X TKR 5</option>
                <option value="X TKR 6">X TKR 6</option>
              </optgroup>

              <optgroup label="KELAS XI">
                <option value="XI RPL">XI RPL</option>
                <option value="XI TAV">XI TAV</option>
                <option value="XI TKR 1">XI TKR 1</option>
                <option value="XI TKR 2">XI TKR 2</option>
                <option value="XI TKR 3">XI TKR 3</option>
                <option value="XI TKR 4">XI TKR 4</option>
                <option value="XI TKR 5">XI TKR 5</option>
                <option value="XI TKR 6">XI TKR 6</option>
              </optgroup>

              <optgroup label="KELAS XII">
                <option value="XII RPL">XII RPL</option>
                <option value="XII TAV">XII TAV</option>
                <option value="XII TKR 1">XII TKR 1</option>
                <option value="XII TKR 2">XII TKR 2</option>
                <option value="XII TKR 3">XII TKR 3</option>
                <option value="XII TKR 4">XII TKR 4</option>
                <option value="XII TKR 5">XII TKR 5</option>
                <option value="XII TKR 6">XII TKR 6</option>
              </optgroup>
            </select>
          </div>
        </div>

        <div class="form-action">
          <button class="btn" type="submit" name="filter">
            Filter
          </button>
        </div>
      </form>
    </div>

    <h1><?= $log ?></h1>

    <?php if (!empty($filter_data)) : ?>
      <?php $no = 1; ?>
      <table border="1" cellpadding="8" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pelaporan</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Kategori</th>
            <th>Keluhan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Feedback</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($filter_data as $row) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['id_pelaporan']; ?></td>
              <td><?= $row['nama_lengkap']; ?></td>
              <td><?= $row['kelas']; ?></td>
              <td><?= $row['ket_kategori']; ?></td>
              <td><?= $row['keluhan']; ?></td>
              <td><?= $row['tanggal_lapor']; ?></td>
              <td><?= $row['status']; ?></td>
              <td><?= $row['feedback']; ?></td>
              <?php if ($row['status'] !== 'Selesai') : ?>
                <td>
                  <a href="edit.php?id_pelaporan=<?= $row['id_pelaporan']; ?>">
                    Edit
                  </a>
                </td>
              <?php else : ?>
                <td>-</td>
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
          <th>Kelas</th>
          <th>Kategori</th>
          <th>Keluhan</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Feedback</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($output_data)) : ?>
          <tr>
            <td colspan="10" align="center">Data tidak tersedia</td>
          </tr>
        <?php else : ?>
          <?php $no = 1; ?>
          <?php foreach ($output_data as $row) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['id_pelaporan']; ?></td>
              <td><?= $row['nama_lengkap']; ?></td>
              <td><?= $row['kelas']; ?></td>
              <td><?= $row['ket_kategori']; ?></td>
              <td><?= $row['keluhan']; ?></td>
              <td><?= $row['tanggal_lapor']; ?></td>
              <td><?= $row['status']; ?></td>
              <td><?= $row['feedback']; ?></td>
              <?php if ($row['status'] !== 'Selesai') : ?>
                <td>
                  <a href="edit.php?id_pelaporan=<?= $row['id_pelaporan']; ?>">
                    Edit
                  </a>
                </td>
              <?php else : ?>
                <td>-</td>
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