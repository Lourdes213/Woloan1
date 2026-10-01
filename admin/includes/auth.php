<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

function require_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

function require_admin() {
    require_login();
    if (($_SESSION['role'] ?? '') !== 'ADMIN') {
        die('Akses ditolak. Halaman ini khusus untuk role ADMIN.');
    }
}
