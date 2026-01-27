<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';
checkRole('siswa');

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
    $log = 'isi semua input';
  } else {
    try {
      clean($opsi, $loc, $ket);
      run("INSERT INTO Input_Aspirasi (nis, id_kategori, lokasi, ket) VALUES (?, ?, ?, ?)", $_SESSION['nis'], $opsi, $loc, $ket);
      run("INSERT INTO Aspirasi (id_pelaporan, status, feedback, id_kategori) VALUES (LAST_INSERT_ID(), 'Menunggu', '-', ?)", $opsi);
      
      $log = "<b>Sukses Mengirim!</b><br>
                Kategori: {$list_kat[$opsi]} <br> 
                Lokasi: $loc <br> 
                Ket: $ket <br> 
                Tanggal: $date <br>
                User: {$_SESSION['nama_lengkap']} ({$_SESSION['nis']})";
    } catch (Exception $e) {
      $log = 'Gagal: ' . $e->getMessage();
    }
  }
}
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
  <form action="" method="POST">
    <div class="form-group">
      <label for="id_kategori">Kategori Aspirasi</label>
      <select name="id_kategori" id="id_kategori" class="input-box" required>
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
      <input type="text" name="lokasi" id="" placeholder="lokasi cth. : Kelas,Kantin,Toilet">
      <textarea name="keterangan" id="" cols="30" rows="10" placeholder="full keterangan"></textarea>
      <button type="submit" name="btn">test</button>
      <h3><?= $log ?></h3>
    </div>
  </form>
  <a href="dashboard.php">back</a>
</body>

</html>