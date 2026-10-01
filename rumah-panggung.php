<?php
$pageTitle = "Rumah Panggung";
require 'config/database.php';
$items = $pdo->query("SELECT * FROM rumah_panggung ORDER BY id DESC")->fetchAll();
require 'includes/header.php';
?>

<section class="section">
    <h2>Jenis Rumah Panggung Woloan</h2>
    <div class="grid">
        <?php foreach ($items as $r): ?>
        <div class="card">
            <img src="<?= $r['foto'] ? 'assets/img/rumah/'.htmlspecialchars($r['foto']) : 'assets/img/logo.png' ?>" alt="<?= htmlspecialchars($r['nama_tipe']) ?>">
            <div class="card-body">
                <h3><?= htmlspecialchars($r['nama_tipe']) ?></h3>
                <p><?= nl2br(htmlspecialchars($r['deskripsi'])) ?></p>
                <p>Ukuran: <strong><?= htmlspecialchars($r['ukuran']) ?></strong></p>
                <div class="price">Rp <?= number_format($r['harga_estimasi'], 0, ',', '.') ?></div>
                <span class="badge"><?= (int)$r['jumlah_tersedia'] ?> unit tersedia</span>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($items)): ?>
            <p>Belum ada data rumah panggung.</p>
        <?php endif; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
