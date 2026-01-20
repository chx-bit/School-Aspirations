<?php
require 'helpers/engine.php';
require 'helpers/functions.php';

$log = "";
$success = false;

if (isset($_GET['status']) && $_GET['status'] == 'success') {
  $success = true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nis = (int) $_POST['nis-input'];
  $nama = strtolower($_POST['nama-input']);
  $kelas = strtoupper($_POST['kelas-input']);

  purify($nis, $nama, $kelas);

  if (!filled($nis, $nama, $kelas)) {
    $log = 'Mohon lengkapi semua data (NIS, Nama, Kelas)';
  } else {
    try {
      $sql = "INSERT INTO Siswa (nis, nama_lengkap, kelas) VALUES (:nis, :nama, :kelas)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':nis'   => $nis,
        ':nama'  => $nama,
        ':kelas' => $kelas
      ]);
      
      header('Location: register.php?status=success');
      exit();
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        $log = "NIS tersebut sudah terdaftar";
      } else {
        $log = "Terjadi kesalahan sistem";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun | Aspirasi Sekolah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/login-register-style.css">
</head>
<body>

  <div class="glow-bg"></div>

  <?php if ($success): ?>
    <div class="modal">
      <div class="modal-content">
        <h3>Berhasil!</h3>
        <p>Akun siswa telah berhasil dibuat.</p>
        <button class="btn-close" onclick="location.href='login.php'">Login Sekarang</button>
      </div>
    </div>
  <?php endif; ?>

  <div class="auth-container">
    <div class="auth-header">
      <h2>Daftar Akun</h2>
      <p>Mulai suarakan aspirasimu untuk sekolah.</p>
    </div>

    <?php if ($log !== ""): ?>
      <div class="alert">
        <span><?= $log; ?></span>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label>Nomor Induk Siswa (NIS)</label>
        <input type="number" name="nis-input" class="input-box" placeholder="Contoh: 102030" required>
      </div>

      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama-input" class="input-box" placeholder="Nama Lengkap Sesuai Absen" required>
      </div>

      <div class="form-group">
        <label>Kelas</label>
        <input type="text" name="kelas-input" class="input-box" placeholder="Contoh: XII RPL 1" required>
      </div>

      <button type="submit" class="btn-submit">Daftar Sekarang</button>
    </form>

    <div class="auth-footer">
      Sudah punya akun? <a href="login.php">Masuk disini</a>
      <br>
      <a href="index.php" class="back-link">← Kembali ke Beranda</a>
    </div>
  </div>

</body>
</html>
