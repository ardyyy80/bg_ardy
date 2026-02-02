<?php
include 'cek_login.php';
$active = 'merch';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'] ?? '';
$data = [];

if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM tb_merch WHERE id_merch='$id'");
    $data = mysqli_fetch_assoc($q);
}
?>

<h3 class="mb-3"><?= $id ? 'Edit Merchandise' : 'Tambah Merchandise' ?></h3>

<form action="merch_proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_merch" value="<?= $data['id_merch'] ?? '' ?>">
    <input type="hidden" name="foto_lama" value="<?= $data['foto_merch'] ?? '' ?>">

    <div class="mb-3">
        <label>Judul Merchandise</label>
        <input type="text" name="judul_merch" class="form-control"
               value="<?= $data['judul_merch'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" step="0.01" name="harga_merch" class="form-control"
               value="<?= $data['harga_merch'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Detail Merchandise</label>
        <textarea name="detail_merch" class="form-control" rows="4" required><?= $data['detail_merch'] ?? '' ?></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Merchandise</label>
        <input type="file" name="foto_merch" class="form-control">
        <?php if (!empty($data['foto_merch'])): ?>
            <small>Foto lama: <?= $data['foto_merch'] ?></small>
        <?php endif; ?>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="merch_tampil.php" class="btn btn-secondary">Kembali</a>
</form>

<?php include 'layout/footer.php'; ?>
