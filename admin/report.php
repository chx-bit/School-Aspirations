<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';
checkRole('admin');
allowUsers();

$output_data = run(
  'SELECT
    i.id_pelaporan,
    s.nama_lengkap,
    k.ket_kategori,
    i.ket AS keluhan,
    a.status,
    a.feedback,
    Date(i.tanggal_lapor) tanggal_lapor
   FROM Input_Aspirasi i
   JOIN Siswa s ON i.nis = s.nis
   JOIN Kategori k ON i.id_kategori = k.id_kategori
   LEFT JOIN Aspirasi a ON i.id_pelaporan = a.id_pelaporan
   ORDER BY i.id_pelaporan ASC'
)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/admin.css" />
    <title>print</title>

    <style>
      @media print {
        @page {
          size: A4 portrait;
          margin: 15mm;
        }

        body {
          font-family: Arial, Helvetica, sans-serif;
          font-size: 10px;
          color: #000;
          overflow: visible !important;
        }

        h2 {
          text-align: center;
          font-size: 14px;
          margin-bottom: 10px;
          text-transform: uppercase;
        }

        tr {
          page-break-inside: avoid;
        }

        table {
          border-collapse: collapse;
          width: auto !important;
          max-width: 100% !important;
          table-layout: auto !important;
          overflow: visible !important;
        }

        th,
        td {
          border: 1px solid #000;
          padding: 4px;
          vertical-align: top;
          white-space: normal;
          text-align: center;
          word-break: break-word;
        }

        th {
          background: #eee;
          font-weight: bold;
        }

        td:nth-child(5),
        td:nth-child(7) {
          text-align: left;
        }

        .print-btn {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    <h2 class="print-title">Laporan Pengaduan Siswa</h2>

    <table border="1" cellpadding="8" cellspacing="0" class="table-all">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Pelaporan</th>
          <th>Nama Siswa</th>
          <th>Kategori</th>
          <th>Keluhan</th>
          <th>Status</th>
          <th>Feedback</th>
          <th>Tanggal Lapor</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($output_data)) : ?>
          <tr>
            <td colspan="7" align="center">Data tidak tersedia</td>
          </tr>
        <?php else : ?>
          <?php $no = 1; ?>
          <?php foreach ($output_data as $row) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['id_pelaporan']; ?></td>
              <td><?= $row['nama_lengkap']; ?></td>
              <td><?= $row['ket_kategori']; ?></td>
              <td><?= $row['keluhan']; ?></td>
              <td><?= $row['status']; ?></td>
              <td><?= $row['feedback']; ?></td>
              <td><?= $row['tanggal_lapor']; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    
    <div class="btn-print-group">
    <button
      aria-label="Cetak laporan"
      onclick="window.print(); return false;"
      class="print-btn"
    >
      <i data-feather="printer"></i>
      Print
    </button>

    <button
      aria-label="Cetak laporan"
      onclick="savePdf();"
      class="print-btn"
    >
      <i data-feather="file-text"></i>
      Save PDF
    </button>
    </div>
    <a href="dashboard.php" class="print-btn" style="margin-bottom:3rem;"><i data-feather="arrow-left"></i>Kembali</a>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <!-- <script src="../assets/js/feather.min.js"></script> -->
    <script>
      feather.replace();

      function savePdf() {
        const title = document.title;
        const date = new Date()
          .toLocaleString('sv-SE')
          .slice(0, 16)
          .replace(/[-: ]/g, '_');

        document.title = 'Laporan_Aspirasi_Siswa_' + date;
        window.print();
        document.title = title;
      }
    </script>
  </body>
</html>