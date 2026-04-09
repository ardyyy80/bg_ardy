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
    $isDeleted = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    
    if ($isDeleted) {
        log_activity($koneksi, 'Menghapus komentar', 'Komentar');
        $_SESSION['success_message'] = 'Komentar berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus komentar!';
    }
    
    header("Location: comment_list.php");
    exit;
}

