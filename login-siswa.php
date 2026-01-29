<?php
require_once __DIR__ . '/helpers/engine.php';
require_once __DIR__ . '/helpers/functions.php';
allowUsers();

$log = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_input = (int) $_POST['user-input'];
  $name_input = strtolower($_POST['name-input']);

  clean($user_input , $name_input);
    if (!filled($user_input, $name_input)) {
      $log = 'NIS dan Nama Lengkap wajib diisi.';
    } else {
      $stmt = run('SELECT * FROM Siswa WHERE nis = ? AND nama_lengkap = ?',$user_input,$name_input);
      $siswa = $stmt->fetch();
      if ($siswa) {
        allowSession('siswa',$siswa);
        redirectTo('siswa/dashboard.php');
      }
      $log = 'Login Gagal. NIS atau Nama salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk | Aspirasi Sekolah</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  >
  <link rel="stylesheet" href="assets/login-register.css">
</head>
<body>
  <div class="glow-bg"></div>
  <div class="auth-container">
    <div class="auth-header">
      <h2>Selamat Datang</h2>
      <p>Masuk untuk mulai melapor atau mengelola aspirasi.</p>
    </div>

    <?php if ($log !== ''): ?>
      <div class="alert">
        <span><?= $log; ?></span>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label>Nomor Induk Siswa</label>
        <input
          type="text"
          name="user-input"
          class="input-box"
          inputmode="numeric"
          placeholder="Masukkan NIS"
          required
        >
      </div>

      <div class="form-group">
        <label>Nama Lengkap</label>
        <input
          type="text"
          name="name-input"
          class="input-box"
          placeholder="Nama Lengkap Siswa"
          required
        >
      </div>
      <button type="submit" class="btn-submit">Masuk Akun</button>
    </form>

    <div class="auth-footer">
      Belum punya akun siswa?
      <a href="register.php">Daftar disini</a>
      <br>
      <a href="index.php" class="back-link">← Kembali ke Beranda</a>
    </div>
  </div>
</body>
</html>