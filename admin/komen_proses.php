<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM tb_komen WHERE id_komen='$id'");
    log_activity($koneksi, 'Menghapus komentar', 'Komentar');
    header("Location: komen_tampil.php");
    exit;
}
