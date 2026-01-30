<?php
require_once __DIR__ . '/helpers/engine.php';
require_once __DIR__ . '/helpers/functions.php';

allowUsers();

$log = '';
$success = false;

if (isset($_GET['status']) && $_GET['status'] === 'success') {
  $success = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nis = (int) $_POST['nis-input'];
  $nama = strtolower($_POST['nama-input']);
  $kelas = $_POST['kelas'];

  clean($nis, $nama, $kelas);

  if (!filled($nis, $nama, $kelas)) {
    $log = 'Mohon lengkapi semua data (NIS, Nama, Kelas)';
  } else {
    try {
      run(
        'INSERT INTO Siswa (nis, nama_lengkap, kelas) VALUES (?,?,?)',
        $nis,
        $nama,
        $kelas
      );
      redirectTo('register.php?status=success');
    } catch (PDOException $e) {
      $log = 'Gagal menyimpan data. NIS mungkin sudah terdaftar.';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Akun | Aspirasi Sekolah</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/login-register.css" />
  </head>
  <body>
    <div class="glow-bg"></div>

    <?php if ($success): ?>
      <div class="modal">
        <div class="modal-content">
          <h3>Berhasil!</h3>
          <p>Akun siswa telah berhasil dibuat.</p>
          <button
            class="btn-close"
            onclick="location.href='login.php'"
          >
            Login Sekarang
          </button>
        </div>
      </div>
    <?php endif; ?>

    <div class="auth-container">
      <div class="auth-header">
        <h2>Daftar Akun</h2>
        <p>Mulai suarakan aspirasimu untuk sekolah.</p>
      </div>

      <?php if ($log !== ''): ?>
        <div class="alert">
          <span><?= $log; ?></span>
        </div>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group">
          <label>Nomor Induk Siswa (NIS)</label>
          <input
            type="text"
            inputmode="numeric"
            name="nis-input"
            class="input-box"
            placeholder="Contoh: 102030"
            maxlength="10"
            required
          />
        </div>

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input
            type="text"
            name="nama-input"
            class="input-box"
            placeholder="Nama Lengkap Sesuai Absen"
            maxlength="255"
            required
          />
        </div>

        <div class="form-group">
          <select name="kelas" required>
            <option value="" disabled selected>
              -- PILIH KELAS --
            </option>

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

        <button type="submit" class="btn-submit">
          Daftar Sekarang
        </button>
      </form>

      <div class="auth-footer">
        Sudah punya akun? <a href="login.php">Masuk disini</a>
        <br />
        <a href="index.php" class="back-link">
          ← Kembali ke Beranda
        </a>
      </div>
    </div>
  </body>
</html>