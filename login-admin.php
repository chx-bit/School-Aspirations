<?php
require_once __DIR__ . '/helpers/engine.php';
require_once __DIR__ . '/helpers/functions.php';
allowUsers();

$log = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_input =  $_POST['user-input'];
  $pass_input =  $_POST['pass-input'];

  clean($user_input , $pass_input);
    if (!filled($user_input, $pass_input)) {
      $log = 'Username dan Password wajib diisi.';
    } else {
      $stmt = run('SELECT * FROM Admin WHERE username = ?',$user_input);
      $admin = $stmt->fetch();

      if ($admin && password_verify($pass_input, $admin['password'])) {
        allowSession('admin',$admin);
        redirectTo('admin/dashboard.php');
      }

      $log = 'Akun tidak ditemukan atau Password salah.';
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
      <p>Masuk untuk mengelola aspirasi siswa</p>
    </div>

    <?php if ($log !== ''): ?>
      <div class="alert">
        <span><?= $log; ?></span>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label>Username Admin</label>
        <input
          type="text"
          name="user-input"
          class="input-box"
          placeholder="Masukkan Username"
          required
        >
      </div>

      <div class="form-group">
        <label>Password Admin</label>
        <input
          type="password"
          name="pass-input"
          class="input-box"
          placeholder="Masukkan password"
          required
        >
      </div>
      <button type="submit" class="btn-submit">Masuk Akun</button>
    </form>

    <div class="auth-footer">
      <a href="index.php" class="back-link">← Kembali ke Beranda</a>
    </div>
  </div>
</body>
</html>