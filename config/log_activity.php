<?php
function log_activity($koneksi, $activity, $module) {
    if (!isset($_SESSION['user_name']) || !isset($_SESSION['nama_admin'])) {
        return false;
    }
    
    $user_name = mysqli_real_escape_string($koneksi, $_SESSION['user_name']);
    $nama_admin = mysqli_real_escape_string($koneksi, $_SESSION['nama_admin']);
    $activity = mysqli_real_escape_string($koneksi, $activity);
    $module = mysqli_real_escape_string($koneksi, $module);
    
    $query = "INSERT INTO tb_activity_log (user_name, nama_admin, activity, module) 
              VALUES ('$user_name', '$nama_admin', '$activity', '$module')";
    
    return mysqli_query($koneksi, $query);
}
