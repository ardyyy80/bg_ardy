<?php
include 'config/koneksi.php';

$isPostRequest = $_SERVER['REQUEST_METHOD'] === 'POST';

if (!$isPostRequest) {
    header("Location: ../frontend/index.php");
    exit;
}

$authorName = mysqli_real_escape_string($koneksi, $_POST['nama_penulis']);
$commentText = mysqli_real_escape_string($koneksi, $_POST['detail_komen']);
$currentDateTime = date('Y-m-d H:i:s');

$query = "INSERT INTO tb_komen (nama_penulis, detail_komen, tanggal_komen) VALUES (?, ?, ?)";
$statement = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($statement, "sss", $authorName, $commentText, $currentDateTime);

$isSuccess = mysqli_stmt_execute($statement);

mysqli_stmt_close($statement);

if ($isSuccess) {
    header("Location: ../frontend/index.php#comment");
    exit;
} else {
    echo "Error: " . mysqli_error($koneksi);
}
