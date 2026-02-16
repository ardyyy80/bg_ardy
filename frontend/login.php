<?php
session_start();

$isAlreadyLoggedIn = isset($_SESSION['login']);

if ($isAlreadyLoggedIn) {
    header("Location: ../backend/admin/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Backend Gameardy</title>
    <link rel="stylesheet" href="../backend/admin/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                $errorType = $_GET['error'];
                $errorMessages = [
                    'invalid' => 'Username atau password salah!',
                    'empty' => 'Username dan password harus diisi!',
                    'logout' => 'Anda telah logout!'
                ];
                echo $errorMessages[$errorType] ?? 'Terjadi kesalahan!';
                ?>
            </div>
        <?php endif; ?>

        <form action="../backend/login_proses.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
