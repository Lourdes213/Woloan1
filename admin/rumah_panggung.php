<?php
require_once 'includes/auth.php';
require_admin();
$pageTitle = "Kelola Rumah Panggung";
$msg = '';

// DELETE
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM rumah_panggung WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: rumah_panggung.php?deleted=1');
    exit;
}

// CREATE / UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_tipe = trim($_POST['nama_tipe']);
    $deskripsi = trim($_POST['deskripsi']);
    $ukuran = trim($_POST['ukuran']);
    $harga = (float) str_replace(['.', ','], ['', '.'], $_POST['harga_estimasi']);
    $jumlah = (int) $_POST['jumlah_tersedia'];
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE rumah_panggung SET nama_tipe=?, deskripsi=?, ukuran=?, harga_estimasi=?, jumlah_tersedia=? WHERE id=?");
        $stmt->execute([$nama_tipe, $deskripsi, $ukuran, $harga, $jumlah, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO rumah_panggung (nama_tipe, deskripsi, ukuran, harga_estimasi, jumlah_tersedia) VALUES (?,?,?,?,?)");
        $stmt->execute([$nama_tipe, $deskripsi, $ukuran, $harga, $jumlah]);
    }
    header('Location: rumah_panggung.php?saved=1');
    exit;
}

// Load for edit
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM rumah_panggung WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

$items = $pdo->query("SELECT * FROM rumah_panggung ORDER BY id DESC")->fetchAll();
require 'includes/layout_top.php';
?>
<div class="topbar"><h1 style="color:#013C58;">Kelola Rumah Panggung</h1></div>

<?php if (isset($_GET['saved'])): ?><div class="alert alert-success">Data berhasil disimpan.</div><?php endif; ?>
<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Data berhasil dihapus.</div><?php endif; ?>

<div class="card" style="margin-bottom:24px;"><div class="card-body">
    <h3><?= $editData ? 'Edit Tipe Rumah Panggung' : 'Tambah Tipe Rumah Panggung' ?></h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
        <div class="form-group">
            <label>Nama Tipe</label>
            <input type="text" name="nama_tipe" required value="<?= htmlspecialchars($editData['nama_tipe'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="3"><?= htmlspecialchars($editData['deskripsi'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Ukuran (contoh: 6x8 m)</label>
            <input type="text" name="ukuran" value="<?= htmlspecialchars($editData['ukuran'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Harga Estimasi (Rp)</label>
            <input type="text" name="harga_estimasi" value="<?= htmlspecialchars($editData['harga_estimasi'] ?? '0') ?>">
        </div>
        <div class="form-group">
            <label>Jumlah Tersedia (unit)</label>
            <input type="number" name="jumlah_tersedia" min="0" value="<?= htmlspecialchars($editData['jumlah_tersedia'] ?? '0') ?>">
        </div>
        <button type="submit" class="btn"><?= $editData ? 'Update' : 'Simpan' ?></button>
        <?php if ($editData): ?><a href="rumah_panggung.php" class="btn btn-outline" style="color:#013C58; border-color:#013C58;">Batal</a><?php endif; ?>
    </form>
</div></div>

<div style="overflow-x:auto;">
<table>
    <thead><tr><th>Nama Tipe</th><th>Ukuran</th><th>Harga</th><th>Jumlah</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php foreach ($items as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['nama_tipe']) ?></td>
            <td><?= htmlspecialchars($r['ukuran']) ?></td>
            <td>Rp <?= number_format($r['harga_estimasi'],0,',','.') ?></td>
            <td><?= (int)$r['jumlah_tersedia'] ?> unit</td>
            <td>
                <a href="rumah_panggung.php?edit=<?= $r['id'] ?>">✏️ Edit</a> |
                <a href="rumah_panggung.php?delete=<?= $r['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">🗑️ Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (empty($items)): ?><tr><td colspan="5">Belum ada data.</td></tr><?php endif; ?>
    </tbody>
</table>
</div>

<?php require 'includes/layout_bottom.php'; ?>
