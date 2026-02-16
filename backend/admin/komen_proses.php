<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';

$isDeleteRequest = isset($_GET['hapus']);

if ($isDeleteRequest) {
    $commentId = intval($_GET['hapus']);
    
    $query = "DELETE FROM tb_komen WHERE id_komen = ?";
    $statement = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($statement, "i", $commentId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    
    log_activity($koneksi, 'Menghapus komentar', 'Komentar');
    
    header("Location: komen_tampil.php");
    exit;
}
