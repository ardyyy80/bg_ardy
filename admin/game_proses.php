<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';
include '../config/helpers.php';

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    
    $stmt = mysqli_prepare($koneksi, "SELECT foto_game FROM tb_game WHERE id_game = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($data) {
        deleteFile($data['foto_game']);
        
        $stmt = mysqli_prepare($koneksi, "DELETE FROM tb_game WHERE id_game = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        log_activity($koneksi, 'Menghapus game', 'Game');
    }
    
    header("Location: game_tampil.php");
    exit;
}

$id = intval($_POST['id_game'] ?? 0);
$judul = sanitizeInput($koneksi, $_POST['judul_game'] ?? '');
$detail = sanitizeInput($koneksi, $_POST['detail_game'] ?? '');
$tgl = sanitizeInput($koneksi, $_POST['tanggal_game'] ?? '');
$foto_lama = sanitizeInput($koneksi, $_POST['foto_lama'] ?? '');

$nama_foto = handleFileUpload($_FILES['foto_game'] ?? [], $foto_lama);

if ($id > 0) {
    $stmt = mysqli_prepare($koneksi, "UPDATE tb_game SET judul_game = ?, foto_game = ?, detail_game = ?, tanggal_game = ? WHERE id_game = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $judul, $nama_foto, $detail, $tgl, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    log_activity($koneksi, "Mengupdate game: $judul", 'Game');
} else {
    $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_game (judul_game, foto_game, detail_game, tanggal_game) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $judul, $nama_foto, $detail, $tgl);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    log_activity($koneksi, "Menambah game: $judul", 'Game');
}

header("Location: game_tampil.php");
