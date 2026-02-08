<?php
session_start();
include 'config/koneksi.php';
include 'config/log_activity.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit;
    }
    
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_admin WHERE user_name = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['nama_admin'] = $row['nama_admin'];
            
            mysqli_stmt_close($stmt);
            log_activity($koneksi, 'Login ke sistem', 'Auth');
            
            header("Location: admin/dashboard.php");
            exit;
        }
    }
    
    mysqli_stmt_close($stmt);
    header("Location: login.php?error=invalid");
    exit;
} else {
    header("Location: login.php");
    exit;
}
