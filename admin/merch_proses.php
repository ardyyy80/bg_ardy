<?php
include '../config/koneksi.php';

/* ===== DELETE ===== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $q = mysqli_query($koneksi, "SELECT foto_merch FROM tb_merch WHERE id_merch='$id'");
    $data = mysqli_fetch_assoc($q);

    if (!empty($data['foto_merch'])) {
        unlink("../uploads/" . $data['foto_merch']);
    }

    mysqli_query($koneksi, "DELETE FROM tb_merch WHERE id_merch='$id'");
    header("Location: merch_tampil.php");
    exit;
}

/* ===== INSERT / UPDATE ===== */
$id     = $_POST['id_merch'] ?? '';
$judul  = $_POST['judul_merch'] ?? '';
$harga  = $_POST['harga_merch'] ?? 0;
$detail = $_POST['detail_merch'] ?? '';

$foto = $_FILES['foto_merch']['name'] ?? '';
$tmp  = $_FILES['foto_merch']['tmp_name'] ?? '';

if ($foto) {
    $nama_foto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/$nama_foto");
} else {
    $nama_foto = $_POST['foto_lama'] ?? '';
}

if ($id) {
    mysqli_query($koneksi, "UPDATE tb_merch SET
        judul_merch='$judul',
        foto_merch='$nama_foto',
        harga_merch='$harga',
        detail_merch='$detail'
        WHERE id_merch='$id'
    ");
} else {
    mysqli_query($koneksi, "INSERT INTO tb_merch VALUES (
        NULL,
        '$judul',
        '$nama_foto',
        '$harga',
        '$detail'
    )");
}

header("Location: merch_tampil.php");
