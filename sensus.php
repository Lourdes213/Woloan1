<?php
$pageTitle = "Sensus Penduduk";
require 'config/database.php';
$data = $pdo->query("SELECT * FROM sensus_penduduk ORDER BY nama ASC")->fetchAll();
require 'includes/header.php';
?>

<section class="section">
    <h2>Data Sensus Penduduk</h2>
    <div style="overflow-x:auto;">
    <table>
        <thead>
            <tr><th>NIK</th><th>Nama</th><th>L/P</th><th>Tempat, Tgl Lahir</th><th>Alamat</th><th>Pekerjaan</th><th>Status</th></tr>
        </thead>
        <tbody>
        <?php foreach ($data as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['nik']) ?></td>
                <td><?= htmlspecialchars($d['nama']) ?></td>
                <td><?= $d['jenis_kelamin'] ?></td>
                <td><?= htmlspecialchars($d['tempat_lahir']) ?>, <?= date('d-m-Y', strtotime($d['tanggal_lahir'])) ?></td>
                <td><?= htmlspecialchars($d['alamat']) ?></td>
                <td><?= htmlspecialchars($d['pekerjaan']) ?></td>
                <td><?= htmlspecialchars($d['status_perkawinan']) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($data)): ?>
            <tr><td colspan="7">Belum ada data.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
