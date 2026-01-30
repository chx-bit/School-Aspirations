SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE Aspirasi;
TRUNCATE TABLE Input_Aspirasi;
TRUNCATE TABLE Siswa;
TRUNCATE TABLE Admin;
TRUNCATE TABLE Kategori;

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO Kategori (id_kategori, ket_kategori) VALUES
(1,'Fasilitas & Sarana'),
(2,'Kebersihan Lingkungan'),
(3,'Kurikulum & Pembelajaran'),
(4,'Keamanan Sekolah'),
(5,'Kedisiplinan Siswa'),
(6,'Ekstrakurikuler'),
(7,'Kantin & Konsumsi'),
(8,'Layanan Administrasi'),
(9,'Kesehatan & UKS'),
(10,'Lainnya');

INSERT INTO Siswa (nis, nama_lengkap, kelas) VALUES
('2024000001','Ahmad Rizki','X RPL'),
('2024000002','Budi Santoso','X TAV'),
('2024000003','Citra Lestari','X TKR 1'),
('2024000004','Dimas Pratama','XI RPL'),
('2024000005','Eka Putri','XI TAV'),
('2024000006','Fajar Nugroho','XI TKR 3'),
('2024000007','Gina Maharani','XII RPL'),
('2024000008','Hadi Saputra','XII TAV'),
('2024000009','Indah Permata','XII TKR 2'),
('2024000010','Joko Widodo','XII TKR 6');

INSERT INTO Admin (username, password) VALUES
('admin01','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin02','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin03','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin04','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin05','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin06','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin07','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin08','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin09','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy'),
('admin10','$2a$12$79Y3l2x7mZIFsLgaUkQEUeukACOCNery7LfbGEdsZS4C2cStgGxoy');

INSERT INTO Input_Aspirasi (nis, id_kategori, lokasi, ket) VALUES
('2024000001',1,'KELAS','KURSI RUSAK'),
('2024000002',2,'HALAMAN','SAMPAH BERSERAK'),
('2024000003',3,'KELAS','MATERI KURANG JELAS'),
('2024000004',4,'GERBANG','KEAMANAN KURANG'),
('2024000005',5,'KELAS','TERLAMBAT MASUK'),
('2024000006',6,'LAPANGAN','EKSKUL KURANG'),
('2024000007',7,'KANTIN','MAKANAN MAHAL'),
('2024000008',8,'TU','LAYANAN LAMBAT'),
('2024000009',9,'UKS','OBAT KURANG'),
('2024000010',10,'SEKOLAH','LAINNYA');

INSERT INTO Aspirasi (id_pelaporan, username, status, id_kategori, feedback) VALUES
(1,'admin01','Menunggu',1,'AKAN DICEK'),
(2,'admin02','Proses',2,'SEDANG DIBERSIHKAN'),
(3,'admin03','Menunggu',3,'AKAN DIEVALUASI'),
(4,'admin04','Selesai',4,'SUDAH DITANGANI'),
(5,'admin05','Proses',5,'DALAM PEMANTAUAN'),
(6,'admin06','Menunggu',6,'AKAN DIBAHAS'),
(7,'admin07','Selesai',7,'SUDAH DITINDAK'),
(8,'admin08','Proses',8,'SEDANG DIPROSES'),
(9,'admin09','Menunggu',9,'AKAN DILENGKAPI'),
(10,'admin10','Selesai',10,'SELESAI');

UPDATE Siswa
SET nama_lengkap = LOWER(nama_lengkap);
-- User 2024000010 Joko Widodo
-- Admin admin01 admin