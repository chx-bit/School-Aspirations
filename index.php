<?php
session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin/dashboard.php');
    } else {
        header('Location: siswa/dashboard.php');
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Sekolah | Layanan Pengaduan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styleIndex.css">
</head>
<body>

    <nav>
        <div class="nav-logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
            Aspirasi Sekolah
        </div>
    </nav>
    <div class="glow">
    </div>
    <header class="hero">
        <div class="container">
            <span class="badge">Sistem Pengaduan Sekolah </span>
            <h1>Suarakan Aspirasimu Membangun Sekolah</h1>
            <p class="subtitle">Platform terpadu untuk menyampaikan kritik, saran, dan laporan sarana prasarana sekolah secara transparan, aman, dan responsif.</p>
            
            <div class="btn-group">
               <div class="btn-cta-group">
                 <a href="register.php" class="btn btn-primary" style="padding: 10px 24px; font-size: 0.9rem;">Buat Akun</a>
                 <a href="login.php" class="btn btn-primary" style="padding: 10px 24px; font-size: 0.9rem;">Masuk Akun</a>
               </div>
                <a href="#about" class="btn btn-secondary">Pelajari Sistem</a>
            </div>
        </div>
    </header>

    <section id="about" class="section">
        <div class="container">
            <div class="section-header">
                <h2>Mengapa Menggunakan <br> Website Ini?</h2>
                <p style="color: var(--text-muted);">Sistem ini dirancang untuk menggantikan kotak saran konvensional dengan teknologi yang menjamin data tersimpan rapi dan status yang terpantau.</p>
            </div>

            <div class="grid-cards">
                <div class="card">
                  <div class="card-top">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#090909" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap-icon lucide-zap"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
                    <h3>Efisiensi Laporan</h3>
                  </div>
                    <p>Tidak perlu birokrasi berbelit. Cukup login, tulis laporan, dan kirim. Sistem akan otomatis meneruskan ke admin sekolah.</p>
                </div>
                <div class="card">
                    <div class="card-top">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe-lock-icon lucide-globe-lock"><path d="M15.686 15A14.5 14.5 0 0 1 12 22a14.5 14.5 0 0 1 0-20 10 10 0 1 0 9.542 13"/><path d="M2 12h8.5"/><path d="M20 6V4a2 2 0 1 0-4 0v2"/><rect width="8" height="5" x="14" y="6" rx="1"/></svg>
                      <h3>Privasi Terjamin</h3>
                    </div>
                    <p>Data pelapor dilindungi dalam sistem. Laporan Anda fokus pada perbaikan fasilitas tanpa rasa khawatir.</p>
                </div>
                <div class="card">
                    <div class="card-top">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database-zap-icon lucide-database-zap"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 15 21.84"/><path d="M21 5V8"/><path d="M21 12L18 17H22L19 22"/><path d="M3 12A9 3 0 0 0 14.59 14.87"/></svg>
                      <h3>Transparansi Proses</h3>
                    </div>
                    <p>Pantau status laporanmu dari "Menunggu", "Diproses", hingga "Selesai" secara realtime melalui dashboard siswa.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: linear-gradient(to bottom, transparent, #f5f5f5);">
        <div class="container">
            <div class="flow-container">
                <div class="section-header">
                    <h2>Alur Penyelesaian</h2>
                    <p>Proses sederhana dari laporan masuk hingga penyelesaian masalah.</p>
                </div>

                <div class="step-list">
                    <div class="step-item">
                        <div class="step-num">01</div>
                        <div class="step-content">
                            <h3>Kirim Aspirasi</h3>
                            <p>Siswa mengisi form pengaduan dilengkapi lokasi dan kategori kerusakan.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">02</div>
                        <div class="step-content">
                            <h3>Verifikasi Admin</h3>
                            <p>Admin memvalidasi laporan. Status berubah menjadi "Sedang Diproses".</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">03</div>
                        <div class="step-content">
                            <h3>Tindak Lanjut</h3>
                            <p>Perbaikan dilakukan. Admin memberikan umpan balik dan bukti penyelesaian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="big-cta">
                <h2>Sekolah Yang Lebih Baik<br>Dimulai Dari Kamu</h2>
                <p>Jangan biarkan fasilitas rusak mengganggu proses belajar. Laporkan sekarang untuk kenyamanan bersama.</p>
                <a href="login.php" class="btn-white">Buat Laporan Sekarang</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025/2026 Uji Kompetensi Keahlian - Rekayasa Perangkat Lunak.</p>
        </div>
    </footer>
    
</body>
</html>
