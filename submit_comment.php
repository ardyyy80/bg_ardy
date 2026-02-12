<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_penulis = mysqli_real_escape_string($koneksi, $_POST['nama_penulis']);
    $detail_komen = mysqli_real_escape_string($koneksi, $_POST['detail_komen']);
    $tanggal_komen = date('Y-m-d H:i:s');
    
    $stmt = mysqli_prepare($koneksi, "INSERT INTO tb_komen (nama_penulis, detail_komen, tanggal_komen) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $nama_penulis, $detail_komen, $tanggal_komen);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: index.php#comment");
        exit;
    } else {
        mysqli_stmt_close($stmt);
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: index.php");
    exit;
}
