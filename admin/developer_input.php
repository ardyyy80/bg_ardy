<?php
$active = 'developer';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'] ?? '';
$data = [];

if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM tb_developer WHERE id_dev='$id'");
    $data = mysqli_fetch_assoc($q);
}
?>

<h3 class="mb-3"><?= $id ? 'Edit Developer' : 'Tambah Developer' ?></h3>

<form action="developer_proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_dev" value="<?= $data['id_dev'] ?? '' ?>">
    <input type="hidden" name="foto_lama" value="<?= $data['foto_dev'] ?? '' ?>">

    <div class="mb-3">
        <label>Nama Developer</label>
        <input type="text" name="nama_dev" class="form-control"
               value="<?= $data['nama_dev'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label>Biodata</label>
        <textarea name="biodata_dev" class="form-control" rows="5" required><?= $data['biodata_dev'] ?? '' ?></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Developer</label>
        <input type="file" name="foto_dev" class="form-control">
        <?php if (!empty($data['foto_dev'])): ?>
            <small>Foto lama: <?= $data['foto_dev'] ?></small>
        <?php endif; ?>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="developer_tampil.php" class="btn btn-secondary">Kembali</a>
</form>

<?php include 'layout/footer.php'; ?>
