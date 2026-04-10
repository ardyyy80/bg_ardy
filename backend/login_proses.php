<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/constants.php';
require_once 'config/helpers.php';
require_once 'config/log_activity.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('login.php');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    setFlashMessage('error', ERROR_MESSAGES['empty']);
    redirectTo('login.php');
}

$query = "SELECT * FROM tb_admin WHERE user_name = ?";
$statement = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($statement, "s", $username);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

if (mysqli_num_rows($result) === 1) {
    $userData = mysqli_fetch_assoc($result);
    
    if (md5($password) === $userData['password']) {
        $_SESSION['login'] = true;
        $_SESSION['user_name'] = $userData['user_name'];
        $_SESSION['nama_admin'] = $userData['nama_admin'];
        
        mysqli_stmt_close($statement);
        log_activity($koneksi, 'Login ke sistem', 'Auth');
        
        redirectTo('admin/dashboard.php');
    }
}

mysqli_stmt_close($statement);
setFlashMessage('error', ERROR_MESSAGES['invalid']);
redirectTo('login.php');
