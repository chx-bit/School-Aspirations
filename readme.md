# School Aspirations Management System

Sistem ini merupakan aplikasi manajemen aspirasi sekolah berbasis **PHP Native** yang memungkinkan siswa menyampaikan aspirasi dan admin memproses serta memberikan feedback.

---

## 🛠️ Tech Stack

- PHP (Native)
- HTML & CSS
- MySQL

---

## 📄 Database Documentation

Database pada sistem ini digunakan untuk menyimpan seluruh data yang dibutuhkan, mulai dari data pengguna, kategori aspirasi, hingga aspirasi yang dikirimkan oleh siswa, beserta status dan feedback yang dikelola oleh admin secara teratur dan saling terhubung.

### Admin

```sql
CREATE TABLE Admin (
    Username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (Username)
);
```

### Siswa

```sql
CREATE TABLE Siswa (
    nis INT(10) NOT NULL,
    kelas VARCHAR(10) NOT NULL,
    nama_lengkap VARCHAR(255) NOT NULL,
    PRIMARY KEY (nis)
);
```

### Kategori

```sql
CREATE TABLE Kategori (
    Id_kategori INT(5) NOT NULL AUTO_INCREMENT,
    ket_kategori VARCHAR(30) NOT NULL,
    PRIMARY KEY (Id_kategori)
);
```

### Input_Aspirasi

```sql
CREATE TABLE Input_Aspirasi (
    Id_pelaporan INT(5) NOT NULL AUTO_INCREMENT,
    nis INT(10) NOT NULL,
    id_kategori INT(5) NOT NULL,
    lokasi VARCHAR(50) NOT NULL,
    ket VARCHAR(50) NOT NULL,
    feedback VARCHAR(30) NOT NULL,
    PRIMARY KEY (Id_pelaporan),
    CONSTRAINT fk_input_siswa
        FOREIGN KEY (nis) REFERENCES Siswa(nis)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_input_kategori
        FOREIGN KEY (id_kategori) REFERENCES Kategori(Id_kategori)
        ON DELETE CASCADE ON UPDATE CASCADE
);
```

### Aspirasi

```sql
CREATE TABLE Aspirasi (
    id_aspirasi INT(5) NOT NULL AUTO_INCREMENT,
    status ENUM('Menunggu', 'Proses', 'Selesai') NOT NULL,
    id_kategori INT(5) NOT NULL,
    feedback VARCHAR(30) NOT NULL,
    PRIMARY KEY (id_aspirasi),
    CONSTRAINT fk_aspirasi_kategori
        FOREIGN KEY (id_kategori) REFERENCES Kategori(Id_kategori)
        ON DELETE CASCADE ON UPDATE CASCADE
);
```

---

## 📊 Diagram Database (ERD)

```mermaid
erDiagram
    Admin {
        varchar Username PK
        varchar password
    }

    Siswa {
        int nis PK
        varchar kelas
        varchar nama_lengkap
    }

    Kategori {
        int Id_kategori PK
        varchar ket_kategori
    }

    Input_Aspirasi {
        int Id_pelaporan PK
        int nis FK
        int id_kategori FK
        varchar lokasi
        varchar ket
        varchar feedback
    }

    Aspirasi {
        int id_aspirasi PK
        enum status
        int id_kategori FK
        varchar feedback
    }

    Siswa ||--o{ Input_Aspirasi : submits
    Kategori ||--o{ Input_Aspirasi : categorizes
    Kategori ||--o{ Aspirasi : categorizes
```

---

## 🔁 Flowchart Admin

```mermaid
flowchart TD
    Start([Mulai]) --> LoginPage[Halaman Login Admin]
    LoginPage --> InputAdm[/Input Username & Password/]
    InputAdm --> Validasi{Cek Tabel Admin}

    Validasi -- Salah --> LoginPage
    Validasi -- Benar --> DashAdm[Dashboard Admin]

    DashAdm --> ViewList[Lihat Daftar Aspirasi]
    ViewList --> Filter[/Filter: Tanggal / Kategori / Siswa/]
    Filter --> SelectItem[Pilih Aspirasi]

    SelectItem --> Action{Aksi}

    Action -- Ubah Status --> UpdateStatus[/Pilih: Menunggu / Proses / Selesai/]
    UpdateStatus --> SaveStatus[(UPDATE tabel Aspirasi)]

    Action -- Beri Feedback --> InputFeed[/Input Feedback/]
    InputFeed --> SaveFeed[(UPDATE tabel Aspirasi)]

    SaveStatus --> Finish[Selesai] --> DashAdm
    SaveFeed --> Finish
```

---

## 🔁 Flowchart Siswa

```mermaid
flowchart TD
    Start([Mulai]) --> LoginUI[Halaman Login Siswa]
    LoginUI --> InputNIS[/Input NIS/]
    InputNIS --> CekNIS{Cek NIS di Database?}

    CekNIS -- Tidak Ditemukan --> Error[Tampilkan NIS Tidak Terdaftar]
    Error --> LoginUI

    CekNIS -- Ditemukan --> SetSession[Set Session NIS]
    SetSession --> Dashboard[Dashboard Siswa]

    Dashboard --> Menu{Pilih Menu}

    Menu -- Lapor --> FormLapor[Form Input Aspirasi]
    FormLapor --> InputData[/Kategori, Lokasi, Keterangan/]
    InputData --> Simpan[(INSERT ke Input_Aspirasi)]
    Simpan --> Success[Tampilkan Sukses]
    Success --> Dashboard

    Menu -- Histori --> GetHistori[(SELECT FROM Input_Aspirasi)]
    GetHistori --> Show[Tampilkan Status & Feedback]
    Show --> Dashboard
```

---

## 📝 Update Log

- Menambahkan kolom `nama_lengkap` **NOT NULL** pada tabel `Siswa`
- Mengubah tipe data kolom `feedback` pada tabel `Input_Aspirasi` menjadi `VARCHAR(30)`
- Mengubah tipe data kolom `feedback` pada tabel `Aspirasi` menjadi `VARCHAR(30)`
- Menambahkan dokumentasi **Flowchart Admin**
- Menambahkan dokumentasi **Flowchart Siswa**
- Menambahkan **Diagram Database (ERD)** sesuai Document Version
- Merapikan struktur README agar lebih konsisten dan profesional

---

## 👤 Author

- chx-bit

## 👥 Contributors
- [@Lightning-88](https://github.com/Lightning-88)

- [@Dhevanda04](https://github.com/Dhevanda04)
