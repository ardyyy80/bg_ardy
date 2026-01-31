<?php
include '../config/koneksi.php';

/* ===== DELETE ===== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $q = mysqli_query($koneksi, "SELECT foto_berita FROM tb_berita WHERE id_berita='$id'");
    $data = mysqli_fetch_assoc($q);

    if (!empty($data['foto_berita'])) {
        unlink("../uploads/" . $data['foto_berita']);
    }

    mysqli_query($koneksi, "DELETE FROM tb_berita WHERE id_berita='$id'");
    header("Location: berita_tampil.php");
    exit;
}

/* ===== INSERT / UPDATE ===== */
$id     = $_POST['id_berita'] ?? '';
$judul  = $_POST['judul_berita'] ?? '';
$tgl    = $_POST['tanggal_berita'] ?? '';
$detail = $_POST['detail_berita'] ?? '';

$foto = $_FILES['foto_berita']['name'] ?? '';
$tmp  = $_FILES['foto_berita']['tmp_name'] ?? '';

if ($foto) {
    $nama_foto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/$nama_foto");
} else {
    $nama_foto = $_POST['foto_lama'] ?? '';
}

if ($id) {
    mysqli_query($koneksi, "UPDATE tb_berita SET
        judul_berita='$judul',
        tanggal_berita='$tgl',
        detail_berita='$detail',
        foto_berita='$nama_foto'
        WHERE id_berita='$id'
    ");
} else {
    mysqli_query($koneksi, "INSERT INTO tb_berita VALUES (
        NULL,
        '$judul',
        '$tgl',
        '$detail',
        '$nama_foto'
    )");
}

header("Location: berita_tampil.php");
