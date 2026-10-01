<?php
$pageTitle = "Beranda";
require 'config/database.php';
$jumlahTipe = $pdo->query("SELECT COUNT(*) FROM rumah_panggung")->fetchColumn();
$jumlahRumah = $pdo->query("SELECT COALESCE(SUM(jumlah_tersedia),0) FROM rumah_panggung")->fetchColumn();
$jumlahPenduduk = $pdo->query("SELECT COUNT(*) FROM sensus_penduduk")->fetchColumn();
require 'includes/header.php';
?>

<section class="hero">
    <h1>Rumah Panggung Khas Woloan</h1>
    <p>Woloan dikenal lewat pengrajin rumah panggung kayu yang dikirim ke berbagai daerah.
       Kelurahan Woloan 1 menjaga tradisi itu sambil melayani warga dengan cara yang lebih mudah.</p>
    <a href="rumah-panggung.php" class="btn">Lihat Jenis Rumah Panggung</a>
    <a href="struktur.php" class="btn btn-outline">Struktur Organisasi</a>
</section>

<section class="section">
    <h2>Sekilas Data</h2>
    <div class="stat-cards">
        <div class="stat-card"><div class="num"><?= $jumlahTipe ?></div><div class="label">Tipe Rumah Panggung</div></div>
        <div class="stat-card"><div class="num"><?= $jumlahRumah ?></div><div class="label">Unit Tersedia</div></div>
        <div class="stat-card"><div class="num"><?= $jumlahPenduduk ?></div><div class="label">Data Penduduk Tercatat</div></div>
    </div>
</section>

<section class="section">
    <h2>Layanan untuk Warga</h2>
    <div class="grid">
        <div class="card"><div class="card-body">
            <h3>📄 Sensus Penduduk</h3>
            <p>Lihat dan kelola data kependudukan warga Woloan 1.</p>
        </div></div>
        <div class="card"><div class="card-body">
            <h3>🏠 Rumah Panggung</h3>
            <p>Jelajahi berbagai tipe rumah panggung khas Woloan.</p>
        </div></div>
        <div class="card"><div class="card-body">
            <h3>🧑‍🤝‍🧑 Struktur Organisasi</h3>
            <p>Kenali perangkat kelurahan yang melayani warga.</p>
        </div></div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
