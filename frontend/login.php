<?php
session_start();
require_once '../backend/config/constants.php';
require_once '../backend/config/helpers.php';

if (isset($_SESSION['login'])) {
    redirectTo('../backend/admin/dashboard.php');
}

$errorMessage = getFlashMessage('error');
$successMessage = getFlashMessage('success');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Tapak Arwah Nusantara</title>
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="../backend/admin/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger">
                <?= sanitizeOutput($errorMessage) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($successMessage): ?>
            <div class="alert alert-success">
                <?= sanitizeOutput($successMessage) ?>
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
