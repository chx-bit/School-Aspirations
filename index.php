<?php
require_once __DIR__ . '/helpers/engine.php';
require_once __DIR__ . '/helpers/functions.php';
allowUsers();
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
    <link rel="stylesheet" href="assets/index.css">

</head>

<body>

    <nav>
        <div class="nav-logo">
            <i data-feather="airplay"></i>
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
                    <a href="login-siswa.php" class="btn btn-primary" style="padding: 10px 24px; font-size: 0.9rem;">Masuk Sebagai Siswa</a>
                    <a href="login-admin.php" class="btn btn-primary" style="padding: 10px 24px; font-size: 0.9rem;">Masuk Sebagai Admin</a>
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
                        <i data-feather="trending-up"></i>
                        <h3>Efisiensi Laporan</h3>
                    </div>
                    <p>Tidak perlu birokrasi berbelit. Cukup login, tulis laporan, dan kirim. Sistem akan otomatis meneruskan ke admin sekolah.</p>
                </div>
                <div class="card">
                    <div class="card-top">
                        <i data-feather="shield"></i>
                        <h3>Privasi Terjamin</h3>
                    </div>
                    <p>Data pelapor dilindungi dalam sistem. Laporan Anda fokus pada perbaikan fasilitas tanpa rasa khawatir.</p>
                </div>
                <div class="card">
                    <div class="card-top">
                        <i data-feather="eye"></i>
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
                <a href="register.php" class="btn-white">Buat Laporan Sekarang</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2025/2026 Uji Kompetensi Keahlian - Rekayasa Perangkat Lunak.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <!-- <script src="assets/js/feather.min.js"></script> -->
    <script>
        feather.replace();
    </script>

</body>

</html>