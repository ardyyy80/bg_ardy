<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';
include '../config/helpers.php';

$isDeleteRequest = isset($_GET['hapus']);

if ($isDeleteRequest) {
    $merchandiseId = intval($_GET['hapus']);
    
    $query = "SELECT foto_merch FROM tb_merch WHERE id_merch = ?";
    $statement = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($statement, "i", $merchandiseId);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $merchandiseData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);
    
    $merchandiseExists = !empty($merchandiseData);
    
    if ($merchandiseExists) {
        deleteFile($merchandiseData['foto_merch']);
        
        $deleteQuery = "DELETE FROM tb_merch WHERE id_merch = ?";
        $deleteStatement = mysqli_prepare($koneksi, $deleteQuery);
        mysqli_stmt_bind_param($deleteStatement, "i", $merchandiseId);
        mysqli_stmt_execute($deleteStatement);
        mysqli_stmt_close($deleteStatement);
        
        log_activity($koneksi, 'Menghapus merchandise', 'Merch');
    }
    
    header("Location: merch_tampil.php");
    exit;
}

$merchandiseId = intval($_POST['id_merch'] ?? 0);
$title = sanitizeInput($koneksi, $_POST['judul_merch'] ?? '');
$price = floatval($_POST['harga_merch'] ?? 0);
$stock = intval($_POST['stock_merch'] ?? 0);
$description = sanitizeInput($koneksi, $_POST['detail_merch'] ?? '');
$oldPhotoName = sanitizeInput($koneksi, $_POST['foto_lama'] ?? '');

$newPhotoName = handleFileUpload($_FILES['foto_merch'] ?? [], $oldPhotoName);

$isUpdate = $merchandiseId > 0;

if ($isUpdate) {
    $updateQuery = "UPDATE tb_merch SET judul_merch = ?, foto_merch = ?, harga_merch = ?, stock_merch = ?, detail_merch = ? WHERE id_merch = ?";
    $statement = mysqli_prepare($koneksi, $updateQuery);
    mysqli_stmt_bind_param($statement, "ssdisi", $title, $newPhotoName, $price, $stock, $description, $merchandiseId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    
    log_activity($koneksi, "Mengupdate merchandise: $title", 'Merch');
} else {
    $insertQuery = "INSERT INTO tb_merch (judul_merch, foto_merch, harga_merch, stock_merch, detail_merch) VALUES (?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($koneksi, $insertQuery);
    mysqli_stmt_bind_param($statement, "ssdis", $title, $newPhotoName, $price, $stock, $description);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    
    log_activity($koneksi, "Menambah merchandise: $title", 'Merch');
}

header("Location: merch_tampil.php");
