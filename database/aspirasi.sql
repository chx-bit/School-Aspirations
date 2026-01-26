INSERT INTO Admin (Username, password) VALUES
('admin1', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin2', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin3', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin4', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin5', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin6', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin7', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin8', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin9', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'),
('admin10', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm');
INSERT INTO Kategori (id_kategori, ket_kategori) VALUES
(1, 'Fasilitas & Sarana'),
(2, 'Kebersihan Lingkungan'),
(3, 'Kurikulum & Pengajaran'),
(4, 'Keamanan Sekolah'),
(5, 'Kedisiplinan Siswa'),
(6, 'Ekstrakurikuler'),
(7, 'Kantin & Gizi'),
(8, 'Administrasi & TU'),
(9, 'Kesehatan & UKS'),
(10, 'Teknologi & Lab Komputer');

INSERT INTO Siswa (nis, nama_lengkap, kelas) VALUES
(1001, 'Aditya Pratama', 'XII RPL 1'),
(1002, 'Budi Santoso', 'XI TKJ 2'),
(1003, 'Citra Kirana', 'X DKV 1'),
(1004, 'Dewi Lestari', 'XII RPL 2'),
(1005, 'Eko Kurniawan', 'XI TSM 1'),
(1006, 'Fajar Nugraha', 'X AKL 3'),
(1007, 'Gita Gutawa', 'XII OTKP 1'),
(1008, 'Hendra Setiawan', 'XI TKJ 1'),
(1009, 'Indah Permata', 'X BDP 2'),
(1010, 'Joko Anwar', 'XII MM 1');

INSERT INTO Input_Aspirasi (id_pelaporan, nis, id_kategori, lokasi, ket, tanggal_lapor) VALUES
(1, 1001, 1, 'Ruang Kelas XII RPL 1', 'AC mati total panas sekali', '2026-01-20 08:00:00'),
(2, 1002, 2, 'Toilet Pria Lantai 2', 'Kran air patah dan air meluber', '2026-01-20 09:30:00'),
(3, 1003, 7, 'Kantin Sehat', 'Harga gorengan naik tidak wajar', '2026-01-21 10:15:00'),
(4, 1004, 10, 'Lab Komputer 3', 'Mouse banyak yang hilang', '2026-01-21 11:00:00'),
(5, 1005, 4, 'Parkiran Motor Siswa', 'Helm sering tertukar posisinya', '2026-01-22 07:00:00'),
(6, 1006, 6, 'Lapangan Basket', 'Ring basket miring bahaya', '2026-01-22 16:00:00'),
(7, 1007, 3, 'Perpustakaan', 'Buku paket matematika kurang', '2026-01-23 09:00:00'),
(8, 1008, 1, 'Masjid Sekolah', 'Karpet bau apek perlu dicuci', '2026-01-23 12:30:00'),
(9, 1009, 9, 'Ruang UKS', 'Obat merah habis stok kosong', '2026-01-24 08:45:00'),
(10, 1010, 5, 'Gerbang Depan', 'Siswa sering lompat pagar', '2026-01-24 14:00:00');

INSERT INTO Aspirasi
(id_aspirasi, id_pelaporan, id_kategori, status, feedback, Username)
VALUES
(1, 1, 1, 'Proses',   'Teknisi sudah dipanggil',            'admin1'),
(2, 2, 2, 'Selesai',  'Kran sudah diganti baru',            'admin2'),
(3, 3, 7, 'Menunggu', 'Akan didiskusikan dgn kantin',       'admin3'),
(4, 4, 10,'Proses',   'Sedang pengadaan mouse baru',       'admin4'),
(5, 5, 4, 'Selesai',  'CCTV parkiran ditambah',            'admin5'),
(6, 6, 6, 'Menunggu', 'Menunggu dana BOS cair',            'admin6'),
(7, 7, 3, 'Proses',   'Buku sedang dipesan',               'admin7'),
(8, 8, 1, 'Selesai',  'Karpet sudah di laundry',           'admin8'),
(9, 9, 9, 'Proses',   'Obat sudah dibeli PMR',             'admin9'),
(10,10,5, 'Menunggu', 'Akan dirazia besok pagi',           'admin10');

