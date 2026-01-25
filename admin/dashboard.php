<?php
require_once __DIR__ . '/../helpers/engine.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/role.php';

checkRole('admin');

$output_data = run(
  'SELECT
    i.id_pelaporan,
    s.nama_lengkap,
    k.ket_kategori,
    i.ket AS keluhan,
    a.status,
    a.feedback
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
  </head>
  <body>
    <table border="1" cellpadding="8" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Pelaporan</th>
          <th>Nama Siswa</th>
          <th>Kategori</th>
          <th>Keluhan</th>
          <th>Status</th>
          <th>Feedback</th>
          <th>Aksi</th>
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
              <?php if ($row['status'] !== 'Selesai') : ?>
                <td>
                  <a href="edit.php?id_pelaporan=<?= $row['id_pelaporan']; ?>">
                    Edit
                  </a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

    <a
      href="<?= BASE_URL ?>logout.php"
      onclick="return confirm('Apakah Anda yakin ingin keluar?')"
    >
      keluar
    </a>
  </body>
</html>