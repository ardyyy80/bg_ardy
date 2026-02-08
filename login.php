<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: admin/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Backend Gameardy</title>
    <link rel="stylesheet" href="admin/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    if ($_GET['error'] == 'invalid') {
                        echo "Username atau password salah!";
                    } elseif ($_GET['error'] == 'empty') {
                        echo "Username dan password harus diisi!";
                    } elseif ($_GET['error'] == 'logout') {
                        echo "Anda telah logout!";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="login_proses.php" method="POST">
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
