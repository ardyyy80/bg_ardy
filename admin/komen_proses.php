<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tb_komen WHERE id_komen = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    log_activity($koneksi, 'Menghapus komentar', 'Komentar');
    header("Location: komen_tampil.php");
    exit;
}
