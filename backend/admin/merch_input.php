<?php
include 'cek_login.php';

$active = 'merch';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$merchandiseId = intval($_GET['id'] ?? 0);
$merchandiseData = null;

$isEditMode = $merchandiseId > 0;

if ($isEditMode) {
    $query = "SELECT * FROM tb_merch WHERE id_merch = ?";
    $statement = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($statement, "i", $merchandiseId);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $merchandiseData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);
}

$pageTitle = $isEditMode ? 'Edit Merchandise' : 'Tambah Merchandise';
?>

<h3 class="mb-3"><?= $pageTitle ?></h3>

<form action="merch_proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_merch" value="<?= htmlspecialchars($merchandiseData['id_merch'] ?? '') ?>">
    <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($merchandiseData['foto_merch'] ?? '') ?>">

    <div class="mb-3">
        <label>Judul Merchandise</label>
        <input type="text" name="judul_merch" class="form-control" value="<?= htmlspecialchars($merchandiseData['judul_merch'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" step="0.01" name="harga_merch" class="form-control" value="<?= htmlspecialchars($merchandiseData['harga_merch'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stock_merch" class="form-control" value="<?= htmlspecialchars($merchandiseData['stock_merch'] ?? '0') ?>" required min="0">
    </div>

    <div class="mb-3">
        <label>Detail Merchandise</label>
        <textarea name="detail_merch" class="form-control" rows="4" required><?= htmlspecialchars($merchandiseData['detail_merch'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Merchandise</label>
        <input type="file" name="foto_merch" class="form-control">
        <?php if (!empty($merchandiseData['foto_merch'])): ?>
            <small>Foto lama: <?= htmlspecialchars($merchandiseData['foto_merch']) ?></small>
        <?php endif; ?>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="merch_tampil.php" class="btn btn-secondary">Kembali</a>
</form>

<?php include 'layout/footer.php'; ?>
