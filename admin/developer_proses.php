<?php
include '../config/koneksi.php';

/* ===== DELETE ===== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $q = mysqli_query($koneksi, "SELECT foto_dev FROM tb_developer WHERE id_dev='$id'");
    $data = mysqli_fetch_assoc($q);

    if (!empty($data['foto_dev'])) {
        unlink("../uploads/" . $data['foto_dev']);
    }

    mysqli_query($koneksi, "DELETE FROM tb_developer WHERE id_dev='$id'");
    header("Location: developer_tampil.php");
    exit;
}

/* ===== INSERT / UPDATE ===== */
$id   = $_POST['id_dev'] ?? '';
$nama = $_POST['nama_dev'] ?? '';
$bio  = $_POST['biodata_dev'] ?? '';

$foto = $_FILES['foto_dev']['name'] ?? '';
$tmp  = $_FILES['foto_dev']['tmp_name'] ?? '';

if ($foto) {
    $nama_foto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/$nama_foto");
} else {
    $nama_foto = $_POST['foto_lama'] ?? '';
}

if ($id) {
    mysqli_query($koneksi, "UPDATE tb_developer SET
        nama_dev='$nama',
        foto_dev='$nama_foto',
        biodata_dev='$bio'
        WHERE id_dev='$id'
    ");
} else {
    mysqli_query($koneksi, "INSERT INTO tb_developer VALUES (
        NULL,
        '$nama',
        '$nama_foto',
        '$bio'
    )");
}

header("Location: developer_tampil.php");
