<?php
session_start();
include 'config/koneksi.php';
include 'config/log_activity.php';

$isPostRequest = $_SERVER['REQUEST_METHOD'] === 'POST';

if (!$isPostRequest) {
    header("Location: ../frontend/login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$hasEmptyField = empty($username) || empty($password);

if ($hasEmptyField) {
    header("Location: ../frontend/login.php?error=empty");
    exit;
}

$query = "SELECT * FROM tb_admin WHERE user_name = ?";
$statement = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($statement, "s", $username);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$userFound = mysqli_num_rows($result) === 1;

if ($userFound) {
    $userData = mysqli_fetch_assoc($result);
    $isPasswordCorrect = password_verify($password, $userData['password']);
    
    if ($isPasswordCorrect) {
        $_SESSION['login'] = true;
        $_SESSION['user_name'] = $userData['user_name'];
        $_SESSION['nama_admin'] = $userData['nama_admin'];
        
        mysqli_stmt_close($statement);
        log_activity($koneksi, 'Login ke sistem', 'Auth');
        
        header("Location: admin/dashboard.php");
        exit;
    }
}

mysqli_stmt_close($statement);
header("Location: ../frontend/login.php?error=invalid");
exit;
