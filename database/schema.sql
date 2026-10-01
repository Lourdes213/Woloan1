-- ============================================
-- Database: woloan1
-- Website Kelurahan Woloan 1
-- ============================================

CREATE DATABASE IF NOT EXISTS woloan1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE woloan1;

-- ----------------------------
-- Tabel Users (untuk login admin)
-- ----------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    role ENUM('ADMIN','STAFF') NOT NULL DEFAULT 'STAFF',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Password default: admin123  (sudah di-hash dengan password_hash PHP - bcrypt)
INSERT INTO users (username, password, nama_lengkap, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'ADMIN');

-- ----------------------------
-- Tabel Rumah Panggung (tipe/jenis rumah panggung khas Woloan)
-- ----------------------------
CREATE TABLE IF NOT EXISTS rumah_panggung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tipe VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    ukuran VARCHAR(50),
    harga_estimasi DECIMAL(15,2) DEFAULT 0,
    jumlah_tersedia INT DEFAULT 0,
    foto VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO rumah_panggung (nama_tipe, deskripsi, ukuran, harga_estimasi, jumlah_tersedia) VALUES
('Tipe Klasik', 'Rumah panggung kayu tradisional dengan atap pelana khas Woloan.', '6x8 m', 85000000, 4),
('Tipe Modern Minimalis', 'Rumah panggung dengan sentuhan desain modern, jendela besar.', '7x9 m', 110000000, 2),
('Tipe Keluarga Besar', 'Rumah panggung dua lantai untuk kebutuhan keluarga besar.', '10x12 m', 175000000, 1);

-- ----------------------------
-- Tabel Sensus Penduduk
-- ----------------------------
CREATE TABLE IF NOT EXISTS sensus_penduduk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P') NOT NULL,
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    alamat VARCHAR(255),
    pekerjaan VARCHAR(100),
    status_perkawinan ENUM('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') DEFAULT 'Belum Kawin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO sensus_penduduk (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, pekerjaan, status_perkawinan) VALUES
('7171010101900001', 'Johanes Mandagi', 'L', 'Tomohon', '1990-01-01', 'Jl. Woloan Raya No. 12', 'Pengrajin Kayu', 'Kawin'),
('7171010101920002', 'Maria Wenas', 'P', 'Tomohon', '1992-05-14', 'Jl. Woloan Raya No. 15', 'Ibu Rumah Tangga', 'Kawin');

-- ----------------------------
-- Tabel Struktur Organisasi
-- ----------------------------
CREATE TABLE IF NOT EXISTS struktur_organisasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jabatan VARCHAR(100) NOT NULL,
    urutan INT DEFAULT 0,
    foto VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO struktur_organisasi (nama, jabatan, urutan) VALUES
('Bpk. Steven Rumagit', 'Lurah Woloan 1', 1),
('Ibu Fera Lumingkewas', 'Sekretaris Lurah', 2),
('Bpk. Denny Pangemanan', 'Kepala Lingkungan I', 3);
