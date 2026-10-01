<?php
// ============================================
// Konfigurasi koneksi database
// Sesuaikan jika host/user/password MySQL berbeda
// ============================================
$DB_HOST = 'localhost';
$DB_NAME = 'woloan1';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO(
        "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage() . "<br>Pastikan sudah import database/schema.sql dan MySQL sedang berjalan.");
}
