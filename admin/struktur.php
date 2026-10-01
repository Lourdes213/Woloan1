<?php
require_once 'includes/auth.php';
require_admin();
$pageTitle = "Kelola Struktur Organisasi";

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM struktur_organisasi WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: struktur.php?deleted=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $urutan = (int) $_POST['urutan'];
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE struktur_organisasi SET nama=?, jabatan=?, urutan=? WHERE id=?");
        $stmt->execute([$nama, $jabatan, $urutan, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO struktur_organisasi (nama, jabatan, urutan) VALUES (?,?,?)");
        $stmt->execute([$nama, $jabatan, $urutan]);
    }
    header('Location: struktur.php?saved=1');
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM struktur_organisasi WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

$data = $pdo->query("SELECT * FROM struktur_organisasi ORDER BY urutan ASC")->fetchAll();
require 'includes/layout_top.php';
?>
<div class="topbar"><h1 style="color:#013C58;">Kelola Struktur Organisasi</h1></div>
<?php if (isset($_GET['saved'])): ?><div class="alert alert-success">Data berhasil disimpan.</div><?php endif; ?>
<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Data berhasil dihapus.</div><?php endif; ?>

<div class="card" style="margin-bottom:24px;"><div class="card-body">
    <h3><?= $editData ? 'Edit Anggota Struktur' : 'Tambah Anggota Struktur' ?></h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
        <div class="form-group"><label>Nama</label><input type="text" name="nama" required value="<?= htmlspecialchars($editData['nama'] ?? '') ?>"></div>
        <div class="form-group"><label>Jabatan</label><input type="text" name="jabatan" required value="<?= htmlspecialchars($editData['jabatan'] ?? '') ?>"></div>
        <div class="form-group"><label>Urutan Tampil</label><input type="number" name="urutan" value="<?= htmlspecialchars($editData['urutan'] ?? '0') ?>"></div>
        <button type="submit" class="btn"><?= $editData ? 'Update' : 'Simpan' ?></button>
        <?php if ($editData): ?><a href="struktur.php" class="btn btn-outline" style="color:#013C58; border-color:#013C58;">Batal</a><?php endif; ?>
    </form>
</div></div>

<div style="overflow-x:auto;">
<table>
    <thead><tr><th>Urutan</th><th>Nama</th><th>Jabatan</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php foreach ($data as $s): ?>
        <tr>
            <td><?= (int)$s['urutan'] ?></td>
            <td><?= htmlspecialchars($s['nama']) ?></td>
            <td><?= htmlspecialchars($s['jabatan']) ?></td>
            <td>
                <a href="struktur.php?edit=<?= $s['id'] ?>">✏️ Edit</a> |
                <a href="struktur.php?delete=<?= $s['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">🗑️ Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (empty($data)): ?><tr><td colspan="4">Belum ada data.</td></tr><?php endif; ?>
    </tbody>
</table>
</div>
<?php require 'includes/layout_bottom.php'; ?>
