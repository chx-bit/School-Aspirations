<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';
checkRole('siswa');
allowUsers();

$log = '';
if (isset($_POST['btn'])) {
  $opsi = $_POST['id_kategori'];
  $loc = $_POST['lokasi'];
  $ket = $_POST['keterangan'];
  $date = date('d F Y, H:i');

  $list_kat = [
    1 => "Fasilitas & Sarana",
    2 => "Kebersihan Lingkungan",
    3 => "Kurikulum & Pembelajaran",
    4 => "Keamanan Sekolah",
    5 => "Kedisiplinan Siswa",
    6 => "Ekstrakurikuler",
    7 => "Kantin & Konsumsi",
    8 => "Layanan Administrasi",
    9 => "Kesehatan & UKS",
    10 => "Lainnya"
  ];


  if (!filled($opsi, $loc, $ket)) {
    $log = '<div class="log-box" style="background: #fee2e2; border-color: #fecaca; color: #991b1b;">Mohon lengkapi semua isian form.</div>';
  } else {
    try {
      clean($opsi, $loc, $ket);
      run("INSERT INTO Input_Aspirasi (nis, id_kategori, lokasi, ket) VALUES (?, ?, ?, ?)", $_SESSION['nis'], $opsi, $loc, $ket);
      run("INSERT INTO Aspirasi (id_pelaporan, status, feedback, id_kategori) VALUES (LAST_INSERT_ID(), 'Menunggu', '-', ?)", $opsi);
      
      $log = "<div class='log-box'>
                <b>Sukses Mengirim!</b><br>
                Kategori: {$list_kat[$opsi]} <br> 
                Lokasi: $loc <br> 
                Waktu: $date
              </div>";
    } catch (Exception $e) {
      $log = '<div class="log-box" style="background: #fee2e2; border-color: #fecaca; color: #991b1b;">Gagal Mengirim Aspirasi</div>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/siswa.css">
  <title>Form Aspirasi</title>
</head>

<body>
  <nav>
    <div class="nav-logo">
      <i data-feather="edit-3"></i>
      Form Aspirasi
    </div>
    <a href="dashboard.php">Kembali</a>
  </nav>
  
  <div class="glow"></div>

  <h2>Sampaikan Aspirasi Anda</h2>
  
  <form action="" method="POST">
    <?= $log ?>
    
    <label for="id_kategori">Kategori</label>
    <select name="id_kategori" id="id_kategori" required>
      <option value="" disabled selected>-- Pilih Kategori --</option>
      <option value="1">Fasilitas & Sarana</option>
      <option value="2">Kebersihan Lingkungan</option>
      <option value="3">Kurikulum & Pembelajaran</option>
      <option value="4">Keamanan Sekolah</option>
      <option value="5">Kedisiplinan Siswa</option>
      <option value="6">Ekstrakurikuler</option>
      <option value="7">Kantin & Konsumsi</option>
      <option value="8">Layanan Administrasi</option>
      <option value="9">Kesehatan & UKS</option>
      <option value="10">Lainnya</option>
    </select>

    <label for="lokasi">Lokasi Kejadian</label>
    <input maxlength="50" type="text" name="lokasi" id="lokasi" placeholder="Contoh: Kelas XII RPL 1, Kantin Utama" required>

    <label for="keterangan">Detail Keluhan / Masukan</label>
    <textarea maxlength="50" name="keterangan" id="keterangan" rows="6" placeholder="Jelaskan aspirasi anda secara detail..." required></textarea>

    <div class="form-action">
      <button type="submit" name="btn">Kirim Aspirasi</button>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>
</body>

</html>
