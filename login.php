<?php
session_start();
require_once 'helpers/engine.php';
require_once 'helpers/functions.php';

isLogIn();

$log = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_input = $_POST['user-input'];
  $pass_input = $_POST['pass-input'];
  $name_input = strtolower($_POST['name-input']);

  purify($user_input, $pass_input, $name_input);

  $isAdmin = !is_numeric($user_input);

  if ($isAdmin) {
    if (!filled($user_input, $pass_input)) {
      $log = 'Username dan Password wajib diisi.';
    } else {
      $stmt = $pdo->prepare(
        'SELECT * FROM Admin WHERE Username = :user'
      );
      $stmt->execute([':user' => $user_input]);
      $admin = $stmt->fetch();

      if ($admin && password_verify($pass_input, $admin['password'])) {
        adminSession('admin', $admin['Username']);
        redirectTo('admin/dashboard.php');
        exit;
      }

      $log = 'Akun tidak ditemukan atau Password salah.';
    }
  } else {
    if (!filled($user_input, $name_input)) {
      $log = 'NIS dan Nama Lengkap wajib diisi.';
    } else {
      $stmt = $pdo->prepare(
        'SELECT * FROM Siswa WHERE nis = :nis AND nama_lengkap = :nama'
      );
      $stmt->execute([
        ':nis'  => $user_input,
        ':nama' => $name_input
      ]);
      $siswa = $stmt->fetch();

      if ($siswa) {
        siswaSession('siswa', $name_input, $siswa['nis']);
        redirectTo('siswa/dashboard.php');
        exit;
      }

      $log = 'Login Gagal. NIS atau Nama salah.';
    }
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
  <link rel="stylesheet" href="assets/login-register-style.css">
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
        <label>Username / Nomor Induk Siswa</label>
        <input
          type="text"
          name="user-input"
          class="input-box"
          placeholder="Masukkan Username atau NIS"
          required
        >
      </div>

      <div class="form-group">
        <label>Nama Lengkap Khusus Siswa</label>
        <input
          type="text"
          name="name-input"
          class="input-box"
          placeholder="Nama Lengkap Siswa"
          required
        >
      </div>

      <div class="form-group">
        <label>Kata Sandi Khusus Admin</label>
        <input
          type="password"
          name="pass-input"
          class="input-box"
          placeholder="Kata Sandi"
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