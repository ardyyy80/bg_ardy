<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';

/* ================= DELETE ================= */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // (opsional) ambil nama foto dulu
    $q = mysqli_query($koneksi, "SELECT foto_game FROM tb_game WHERE id_game='$id'");
    $data = mysqli_fetch_assoc($q);

    if (!empty($data['foto_game'])) {
        unlink("../uploads/" . $data['foto_game']);
    }

    mysqli_query($koneksi, "DELETE FROM tb_game WHERE id_game='$id'");
    log_activity($koneksi, 'Menghapus game', 'Game');
    header("Location: game_tampil.php");
    exit;
}
/* ========================================= */

$id     = $_POST['id_game'] ?? '';
$judul  = $_POST['judul_game'] ?? '';
$detail = $_POST['detail_game'] ?? '';
$tgl    = $_POST['tanggal_game'] ?? '';

$foto = $_FILES['foto_game']['name'] ?? '';
$tmp  = $_FILES['foto_game']['tmp_name'] ?? '';

if ($foto) {
    $nama_foto = time() . '_' . $foto;
    move_uploaded_file($tmp, "../uploads/$nama_foto");
} else {
    $nama_foto = $_POST['foto_lama'] ?? '';
}

if ($id) {
    // UPDATE
    mysqli_query($koneksi, "UPDATE tb_game SET
        judul_game='$judul',
        foto_game='$nama_foto',
        detail_game='$detail',
        tanggal_game='$tgl'
        WHERE id_game='$id'
    ");
    log_activity($koneksi, "Mengupdate game: $judul", 'Game');
} else {
    // INSERT
    mysqli_query($koneksi, "INSERT INTO tb_game VALUES (
        NULL,
        '$judul',
        '$nama_foto',
        '$detail',
        '$tgl'
    )");
    log_activity($koneksi, "Menambah game: $judul", 'Game');
}

header("Location: game_tampil.php");
