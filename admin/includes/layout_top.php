<?php $current = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : '' ?>Admin Woloan 1</title>
<link rel="icon" href="../assets/img/logo.png">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <div class="brand">
            <img src="../assets/img/logo.png" alt="Logo">
            <span><strong>Woloan 1</strong><br><small>Admin Panel</small></span>
        </div>
        <a href="dashboard.php" class="<?= $current=='dashboard.php'?'active':'' ?>">📊 Dashboard</a>
        <a href="rumah_panggung.php" class="<?= $current=='rumah_panggung.php'?'active':'' ?>">🏠 Rumah Panggung</a>
        <a href="sensus.php" class="<?= $current=='sensus.php'?'active':'' ?>">📄 Sensus Penduduk</a>
        <a href="struktur.php" class="<?= $current=='struktur.php'?'active':'' ?>">🧑‍🤝‍🧑 Struktur Organisasi</a>
        <a href="../index.php">🔙 Lihat Website</a>
        <a href="logout.php">🚪 Logout</a>
    </aside>
    <main class="admin-content">
