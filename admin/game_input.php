<?php
$active = 'game';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$id = $_GET['id'] ?? '';
$data = null;

if ($id) {
    $q = mysqli_query($koneksi, "SELECT * FROM tb_game WHERE id_game='$id'");
    $data = mysqli_fetch_assoc($q);
}
?>

<h3><?= $id ? 'Edit Game' : 'Tambah Game' ?></h3>

<form action="game_proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_game" value="<?= $data['id_game'] ?? '' ?>">

    <div class="mb-3">
        <label>Judul Game</label>
        <input type="text" name="judul_game" class="form-control" required
               value="<?= $data['judul_game'] ?? '' ?>">
    </div>

    <div class="mb-3">
        <label>Foto Game</label>
        <input type="file" name="foto_game" class="form-control">
        <?php if (!empty($data['foto_game'])): ?>
            <small>File lama: <?= $data['foto_game'] ?></small>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label>Detail Game</label>
        <textarea name="detail_game" class="form-control" rows="4" required><?= $data['detail_game'] ?? '' ?></textarea>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal_game" class="form-control" required
               value="<?= $data['tanggal_game'] ?? date('Y-m-d') ?>">
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="game_tampil.php" class="btn btn-secondary">Kembali</a>
</form>

<?php include 'layout/footer.php'; ?>
