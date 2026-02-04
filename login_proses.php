<?php
session_start();
include 'config/koneksi.php';
include 'config/log_activity.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit;
    }
    
    $username = mysqli_real_escape_string($koneksi, $username);
    
    $query = "SELECT * FROM tb_admin WHERE user_name = '$username'";
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['nama_admin'] = $row['nama_admin'];
            
            log_activity($koneksi, 'Login ke sistem', 'Auth');
            
            header("Location: admin/dashboard.php");
            exit;
        } else {
            header("Location: login.php?error=invalid");
            exit;
        }
    } else {
        header("Location: login.php?error=invalid");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
