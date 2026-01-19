INSERT INTO admin (username, password) VALUES
('admin1', '$2y$10$abcdefghijklmnopqrstuv'),
('admin2', '$2y$10$abcdefghijklmnopqrstuv'),
('admin3', '$2y$10$abcdefghijklmnopqrstuv'),
('admin4', '$2y$10$abcdefghijklmnopqrstuv'),
('admin5', '$2y$10$abcdefghijklmnopqrstuv'),
('admin6', '$2y$10$abcdefghijklmnopqrstuv'),
('admin7', '$2y$10$abcdefghijklmnopqrstuv'),
('admin8', '$2y$10$abcdefghijklmnopqrstuv'),
('admin9', '$2y$10$abcdefghijklmnopqrstuv'),
('admin10','$2y$10$abcdefghijklmnopqrstuv');

INSERT INTO siswa (nis, kelas, nama_lengkap) VALUES
(1001,'X RPL 1','Andi Saputra'),
(1002,'X RPL 1','Budi Santoso'),
(1003,'X RPL 2','Citra Lestari'),
(1004,'X RPL 2','Dewi Puspita'),
(1005,'XI RPL 1','Eka Pratama'),
(1006,'XI RPL 1','Fajar Nugroho'),
(1007,'XI RPL 2','Gilang Ramadhan'),
(1008,'XI RPL 2','Hana Aulia'),
(1009,'XII RPL','Indra Wijaya'),
(1010,'XII RPL','Joko Susilo');

INSERT INTO kategori (id_kategori, ket_kategori) VALUES
(1,'Sarana'),
(2,'Kebersihan'),
(3,'Keamanan'),
(4,'Fasilitas'),
(5,'Pelayanan'),
(6,'Lingkungan'),
(7,'Parkir'),
(8,'Toilet'),
(9,'Kantin'),
(10,'Lainnya');
INSERT INTO input_aspirasi 
(id_pelaporan, nis, id_kategori, lokasi, ket, tgl_lapor) VALUES
(1,1001,1,'Lab RPL','Komputer rusak','2025-01-01'),
(2,1002,2,'Toilet','Kotor','2025-01-02'),
(3,1003,3,'Parkiran','Kurang aman','2025-01-03'),
(4,1004,4,'Kelas','AC mati','2025-01-04'),
(5,1005,5,'TU','Pelayanan lama','2025-01-05'),
(6,1006,6,'Halaman','Banyak sampah','2025-01-06'),
(7,1007,7,'Parkiran','Motor berantakan','2025-01-07'),
(8,1008,8,'Toilet','Air mati','2025-01-08'),
(9,1009,9,'Kantin','Harga mahal','2025-01-09'),
(10,1010,10,'Sekolah','Lain-lain','2025-01-10');

INSERT INTO aspirasi 
(id_aspirasi, id_pelaporan, id_kategori, status, feedback, username) VALUES
(1,1,1,'menunggu',NULL,'admin1'),
(2,2,2,'proses','Sedang dibersihkan','admin2'),
(3,3,3,'selesai','Sudah ditangani','admin3'),
(4,4,4,'menunggu',NULL,'admin4'),
(5,5,5,'proses','Diproses TU','admin5'),
(6,6,6,'selesai','Area dibersihkan','admin6'),
(7,7,7,'menunggu',NULL,'admin7'),
(8,8,8,'proses','Air diperbaiki','admin8'),
(9,9,9,'selesai','Harga diturunkan','admin9'),
(10,10,10,'menunggu',NULL,'admin10');
