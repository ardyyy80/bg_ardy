<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';
include '../config/helpers.php';

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    
    $stmt = mysqli_prepare($koneksi, "SELECT foto_merch FROM tb_merch WHERE id_merch = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($data) {
        deleteFile($data['foto_merch']);
        
        $stmt = mysqli_prepare($koneksi, "DELETE FROM tb_merch WHERE id_merch = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        log_activity($koneksi, 'Menghapus merchandise', 'Merch');
    }
    
    header("Location: merch_tampil.php");
    exit;
}

$id = intval($_POST['id_merch'] ?? 0);
$judul = sanitizeInput($koneksi, $_POST['judul_merch'] ?? '');
$harga = floatval($_POST['harga_merch'] ?? 0);
$detail = sanitizeInput($koneksi, $_POST['detail_merch'] ?? '');
$foto_lama = sanitizeInput($koneksi, $_POST['foto_lama'] ?? '');

$nama_foto = handleFileUpload($_FILES['foto_merch'] ?? [], $foto_lama);

if ($id > 0) {
    $stmt = mysqli_prepare($koneksi, "UPDATE tb_merch SET judul_merch = ?, foto_merch = ?, harga_merch = ?, detail_merch = ? WHERE id_merch = ?");
    mysqli_stmt_bind_param($stmt, "ssdsi", $judul, $nama_foto, $harga, $detail, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    log_activity($koneksi, "Mengupdate merchandise: $judul", 'Merch');
} else {
    $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_merch (judul_merch, foto_merch, harga_merch, detail_merch) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssds", $judul, $nama_foto, $harga, $detail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    log_activity($koneksi, "Menambah merchandise: $judul", 'Merch');
}

header("Location: merch_tampil.php");
