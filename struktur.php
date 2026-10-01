<?php
$pageTitle = "Struktur Organisasi";
require 'config/database.php';
$data = $pdo->query("SELECT * FROM struktur_organisasi ORDER BY urutan ASC")->fetchAll();
require 'includes/header.php';
?>

<section class="section">
    <h2>Struktur Organisasi Kelurahan Woloan 1</h2>
    <div class="grid">
        <?php foreach ($data as $s): ?>
        <div class="card">
            <img src="<?= $s['foto'] ? 'assets/img/struktur/'.htmlspecialchars($s['foto']) : 'assets/img/logo.png' ?>" alt="<?= htmlspecialchars($s['nama']) ?>">
            <div class="card-body">
                <h3><?= htmlspecialchars($s['nama']) ?></h3>
                <p><?= htmlspecialchars($s['jabatan']) ?></p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($data)): ?>
            <p>Belum ada data struktur organisasi.</p>
        <?php endif; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
