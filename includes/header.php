<?php $current = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : '' ?>Woloan 1</title>
<link rel="icon" href="assets/img/logo.png">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="navbar">
    <a class="brand" href="index.php">
        <img src="assets/img/logo.png" alt="Logo Woloan 1">
        <span>Woloan 1</span>
    </a>
    <nav>
        <a href="index.php" class="<?= $current=='index.php'?'active':'' ?>">Beranda</a>
        <a href="rumah-panggung.php" class="<?= $current=='rumah-panggung.php'?'active':'' ?>">Rumah Panggung</a>
        <a href="sensus.php" class="<?= $current=='sensus.php'?'active':'' ?>">Sensus Penduduk</a>
        <a href="struktur.php" class="<?= $current=='struktur.php'?'active':'' ?>">Struktur Organisasi</a>
        <a href="admin/login.php">Login Admin</a>
    </nav>
</header>
