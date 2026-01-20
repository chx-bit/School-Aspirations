<?php
session_start();
require 'helpers/engine.php';
require 'helpers/functions.php';

$log = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_input = $_POST['user-input'];
  $pass_input = $_POST['pass-input'];

  purify($user_input, $pass_input);

  if (!filled($user_input, $pass_input)) {
    $log = "Mohon lengkapi Username/NIS dan Password/Nama.";
  } else {
    try {
      $sql_admin = "SELECT * FROM Admin WHERE Username = :user";
      $stmt = $pdo->prepare($sql_admin);
      $stmt->execute([':user' => $user_input]);
      $admin = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($admin && password_verify($pass_input, $admin['password'])) {
        $_SESSION['user'] = $admin;
        $_SESSION['role'] = 'admin';
        
        header('Location: admin/dashboard.php');
        exit();
      } elseif (is_numeric($user_input)) {
        
        $pass_input = strtolower($pass_input);

        $sql_siswa = "SELECT * FROM Siswa WHERE nis = :nis AND nama_lengkap = :nama";
        $stmt_siswa = $pdo->prepare($sql_siswa);
        $stmt_siswa->execute([
            ':nis'  => $user_input,
            ':nama' => $pass_input
        ]);
        $siswa = $stmt_siswa->fetch(PDO::FETCH_ASSOC);

        if ($siswa) {
          $_SESSION['user'] = $siswa;
          $_SESSION['role'] = 'siswa';
          $_SESSION['nis']  = $siswa['nis']; 
          
          header('Location: siswa/dashboard.php');
          exit();
        } else {
          $log = "Login Gagal. Pastikan NIS dan Nama Lengkap sesuai.";
        }
      } else {
        $log = "Akun tidak ditemukan atau Password salah.";
      }

    } catch (PDOException $e) {
      $log = "Terjadi kesalahan sistem.";
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/login-register-style.css">
</head>
<body>

  <div class="glow-bg"></div>

  <div class="auth-container">
    <div class="auth-header">
      <h2>Selamat Datang</h2>
      <p>Masuk untuk mulai melapor atau mengelola aspirasi.</p>
    </div>

    <?php if ($log !== ""): ?>
      <div class="alert">
        <span><?= $log; ?></span>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label>Username / Nomor Induk Siswa</label>
        <input type="text" name="user-input" class="input-box" placeholder="Masukkan Username atau NIS" required>
      </div>

      <div class="form-group">
        <label>Password / Nama Lengkap Siswa</label>
        <input type="password" name="pass-input" class="input-box" placeholder="Kata Sandi atau Nama Lengkap Siswa" required>
      </div>

      <button type="submit" class="btn-submit">Masuk Akun</button>
    </form>

    <div class="auth-footer">
      Belum punya akun siswa? <a href="register.php">Daftar disini</a>
      <br>
      <a href="index.php" class="back-link">← Kembali ke Beranda</a>
    </div>
  </div>

</body>
</html>
