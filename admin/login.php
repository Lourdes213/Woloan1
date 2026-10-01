<?php
session_start();
require_once '../config/database.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin - Woloan 1</title>
<link rel="icon" href="../assets/img/logo.png">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="form-box">
    <div style="text-align:center; margin-bottom:16px;">
        <img src="../assets/img/logo.png" alt="Logo" style="height:70px; margin:0 auto;">
    </div>
    <h2>Login Admin</h2>
    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn" style="width:100%;">Masuk</button>
    </form>
    <p style="margin-top:14px; font-size:.85rem; color:#567;">Default: admin / admin123</p>
</div>
</body>
</html>
