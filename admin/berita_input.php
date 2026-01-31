<?php
$active = 'berita';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'] ?? '';
$data = [];

if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE id_berita='$id'");
    $data = mysqli_fetch_assoc($q);
}
?>

<h3 class="mb-3"><?= $id ? 'Edit Berita' : 'Tambah Berita' ?></h3>

<form action="berita_proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_berita" value="<?= $data['id_berita'] ?? '' ?>">
    <input type="hidden" name="foto_lama" value="<?= $data['foto_berita'] ?? '' ?>">

    <div class="mb-3">
        <label>Judul Berita</label>
        <input type="text" name="judul_berita" class="form-control"
               value="<?= $data['judul_berita'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal_berita" class="form-control"
               value="<?= $data['tanggal_berita'] ?? date('Y-m-d') ?>" required>
    </div>

    <div class="mb-3">
        <label>Detail Berita</label>
        <textarea name="detail_berita" class="form-control" rows="4" required><?= $data['detail_berita'] ?? '' ?></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Berita</label>
        <input type="file" name="foto_berita" class="form-control">
        <?php if (!empty($data['foto_berita'])): ?>
            <small>Foto lama: <?= $data['foto_berita'] ?></small>
        <?php endif; ?>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="berita_tampil.php" class="btn btn-secondary">Kembali</a>
</form>

<?php include 'layout/footer.php'; ?>
