# Website Woloan 1

Website kelurahan dengan fitur katalog rumah panggung, sensus penduduk, struktur organisasi,
dan panel admin (role ADMIN) untuk mengelola ketiganya.

## Cara Install (XAMPP)

1. Extract isi zip ini ke dalam folder `C:\xampp\htdocs\DESAWOLOAN1` (timpa file lama kalau perlu,
   atau pakai nama folder lain sesuai keinginan).
2. Buka phpMyAdmin (`http://localhost:8080/phpmyadmin`), buat database baru atau langsung import:
   - Klik tab **Import** > pilih file `database/schema.sql` > klik **Go**.
   - Ini otomatis membuat database `woloan1` beserta tabel dan data contoh.
3. Buka `config/database.php`, sesuaikan jika username/password MySQL kamu berbeda dari default XAMPP
   (default: host `localhost`, user `root`, password kosong).
4. Buka di browser: `http://localhost:8080/` (sesuai nama folder & port Apache kamu).

## Login Admin

- URL: `http://localhost:8080/admin/login.php`
- Username: `admin`
- Password: `admin123`

**PENTING:** segera ganti password admin setelah login pertama kali (lewat phpMyAdmin,
update kolom password di tabel `users` dengan hash bcrypt baru, atau tambahkan halaman ganti password).

## Struktur Folder

```
├── index.php              Halaman utama (publik)
├── rumah-panggung.php     Katalog tipe rumah panggung (publik)
├── sensus.php             Data sensus penduduk (publik)
├── struktur.php           Struktur organisasi (publik)
├── config/database.php    Koneksi database
├── database/schema.sql    Struktur tabel + data contoh
├── includes/              Header/footer halaman publik
├── assets/                CSS, gambar, logo
└── admin/                 Panel admin (login wajib, role ADMIN)
    ├── login.php
    ├── dashboard.php
    ├── rumah_panggung.php     CRUD tipe rumah panggung
    ├── sensus.php             CRUD data penduduk
    └── struktur.php           CRUD struktur organisasi
```

## Warna Tema

Diambil dari color palette yang diberikan:
- `#A8E8F9` light blue (background)
- `#00537A` mid blue (navbar/judul)
- `#013C58` dark navy (sidebar admin, footer)
- `#F5A201` orange (tombol/aksen utama)
- `#FFBA42` orange muda (hover)
- `#FFD35B` kuning (highlight/badge)

Logo yang di-upload otomatis dipakai di navbar, favicon, halaman login, dan sidebar admin
(`assets/img/logo.png`).
