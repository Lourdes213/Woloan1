<?php
require_once 'includes/auth.php';
require_admin();
$pageTitle = "Dashboard";

$jumlahTipe = $pdo->query("SELECT COUNT(*) FROM rumah_panggung")->fetchColumn();
$jumlahRumah = $pdo->query("SELECT COALESCE(SUM(jumlah_tersedia),0) FROM rumah_panggung")->fetchColumn();
$jumlahPenduduk = $pdo->query("SELECT COUNT(*) FROM sensus_penduduk")->fetchColumn();
$jumlahStruktur = $pdo->query("SELECT COUNT(*) FROM struktur_organisasi")->fetchColumn();

require 'includes/layout_top.php';
?>
<div class="topbar">
    <h1 style="color:#013C58;">Selamat datang, <?= htmlspecialchars($_SESSION['nama_lengkap']) ?> 👋</h1>
    <span class="btn-logout">Role: <?= htmlspecialchars($_SESSION['role']) ?></span>
</div>

<div class="stat-cards">
    <div class="stat-card">
        <div class="num"><?= $jumlahTipe ?></div>
        <div class="label">Tipe Rumah Panggung</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $jumlahRumah ?></div>
        <div class="label">Total Unit Rumah Panggung</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $jumlahPenduduk ?></div>
        <div class="label">Data Sensus Penduduk</div>
    </div>
    <div class="stat-card">
        <div class="num"><?= $jumlahStruktur ?></div>
        <div class="label">Anggota Struktur Organisasi</div>
    </div>
</div>

<div class="card"><div class="card-body">
    <h3>Mulai Kelola Data</h3>
    <p>Gunakan menu di samping untuk menambah, mengubah, atau menghapus data rumah panggung, sensus penduduk, dan struktur organisasi.</p>
</div></div>

<?php require 'includes/layout_bottom.php'; ?>
