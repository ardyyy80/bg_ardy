<?php
include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM tb_komen WHERE id_komen='$id'");
    header("Location: komen_tampil.php");
    exit;
}
