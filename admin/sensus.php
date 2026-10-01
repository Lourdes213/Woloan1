<?php
require_once 'includes/auth.php';
require_admin();
$pageTitle = "Kelola Sensus Penduduk";

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM sensus_penduduk WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: sensus.php?deleted=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = trim($_POST['nik']);
    $nama = trim($_POST['nama']);
    $jk = $_POST['jenis_kelamin'];
    $tempat = trim($_POST['tempat_lahir']);
    $tgl = $_POST['tanggal_lahir'];
    $alamat = trim($_POST['alamat']);
    $pekerjaan = trim($_POST['pekerjaan']);
    $status = $_POST['status_perkawinan'];
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE sensus_penduduk SET nik=?,nama=?,jenis_kelamin=?,tempat_lahir=?,tanggal_lahir=?,alamat=?,pekerjaan=?,status_perkawinan=? WHERE id=?");
        $stmt->execute([$nik,$nama,$jk,$tempat,$tgl,$alamat,$pekerjaan,$status,$id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO sensus_penduduk (nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,alamat,pekerjaan,status_perkawinan) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$nik,$nama,$jk,$tempat,$tgl,$alamat,$pekerjaan,$status]);
    }
    header('Location: sensus.php?saved=1');
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM sensus_penduduk WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

$data = $pdo->query("SELECT * FROM sensus_penduduk ORDER BY nama ASC")->fetchAll();
require 'includes/layout_top.php';
?>
<div class="topbar"><h1 style="color:#013C58;">Kelola Sensus Penduduk</h1></div>
<?php if (isset($_GET['saved'])): ?><div class="alert alert-success">Data berhasil disimpan.</div><?php endif; ?>
<?php if (isset($_GET['deleted'])): ?><div class="alert alert-success">Data berhasil dihapus.</div><?php endif; ?>

<div class="card" style="margin-bottom:24px;"><div class="card-body">
    <h3><?= $editData ? 'Edit Data Penduduk' : 'Tambah Data Penduduk' ?></h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
        <div class="form-group"><label>NIK</label><input type="text" name="nik" required value="<?= htmlspecialchars($editData['nik'] ?? '') ?>"></div>
        <div class="form-group"><label>Nama</label><input type="text" name="nama" required value="<?= htmlspecialchars($editData['nama'] ?? '') ?>"></div>
        <div class="form-group"><label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
                <option value="L" <?= (($editData['jenis_kelamin'] ?? '')=='L')?'selected':'' ?>>Laki-laki</option>
                <option value="P" <?= (($editData['jenis_kelamin'] ?? '')=='P')?'selected':'' ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group"><label>Tempat Lahir</label><input type="text" name="tempat_lahir" value="<?= htmlspecialchars($editData['tempat_lahir'] ?? '') ?>"></div>
        <div class="form-group"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($editData['tanggal_lahir'] ?? '') ?>"></div>
        <div class="form-group"><label>Alamat</label><input type="text" name="alamat" value="<?= htmlspecialchars($editData['alamat'] ?? '') ?>"></div>
        <div class="form-group"><label>Pekerjaan</label><input type="text" name="pekerjaan" value="<?= htmlspecialchars($editData['pekerjaan'] ?? '') ?>"></div>
        <div class="form-group"><label>Status Perkawinan</label>
            <select name="status_perkawinan">
                <?php foreach (['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $st): ?>
                <option value="<?= $st ?>" <?= (($editData['status_perkawinan'] ?? '')==$st)?'selected':'' ?>><?= $st ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn"><?= $editData ? 'Update' : 'Simpan' ?></button>
        <?php if ($editData): ?><a href="sensus.php" class="btn btn-outline" style="color:#013C58; border-color:#013C58;">Batal</a><?php endif; ?>
    </form>
</div></div>

<div style="overflow-x:auto;">
<table>
    <thead><tr><th>NIK</th><th>Nama</th><th>L/P</th><th>Alamat</th><th>Pekerjaan</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><?= htmlspecialchars($d['nik']) ?></td>
            <td><?= htmlspecialchars($d['nama']) ?></td>
            <td><?= $d['jenis_kelamin'] ?></td>
            <td><?= htmlspecialchars($d['alamat']) ?></td>
            <td><?= htmlspecialchars($d['pekerjaan']) ?></td>
            <td>
                <a href="sensus.php?edit=<?= $d['id'] ?>">✏️ Edit</a> |
                <a href="sensus.php?delete=<?= $d['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">🗑️ Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (empty($data)): ?><tr><td colspan="6">Belum ada data.</td></tr><?php endif; ?>
    </tbody>
</table>
</div>
<?php require 'includes/layout_bottom.php'; ?>
