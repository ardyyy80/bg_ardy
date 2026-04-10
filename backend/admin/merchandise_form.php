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

<div class="admin-form-shell">
    <div class="admin-form-shell__head"><?= $pageTitle ?></div>

    <div class="admin-form-shell__body">
        <form action="merchandise_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_merch" value="<?= htmlspecialchars($merchandiseData['id_merch'] ?? '') ?>">
            <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($merchandiseData['foto_merch'] ?? '') ?>">

            <div class="admin-form-shell__group">
                <label>Judul Merchandise</label>
                <input type="text" name="judul_merch" class="form-control"
                    value="<?= htmlspecialchars($merchandiseData['judul_merch'] ?? '') ?>" required>
            </div>

            <div class="admin-form-shell__row">
                <div class="admin-form-shell__group">
                    <label>Harga</label>
                    <input type="number" step="0.01" name="harga_merch" class="form-control"
                        value="<?= htmlspecialchars($merchandiseData['harga_merch'] ?? '') ?>" required>
                </div>
                <div class="admin-form-shell__group">
                    <label>Stok</label>
                    <input type="number" name="stock_merch" class="form-control"
                        value="<?= htmlspecialchars($merchandiseData['stock_merch'] ?? '0') ?>" required min="0">
                </div>
            </div>

            <div class="admin-form-shell__group">
                <label>Detail Merchandise</label>
                <textarea name="detail_merch" class="form-control"
                    required><?= htmlspecialchars($merchandiseData['detail_merch'] ?? '') ?></textarea>
            </div>

            <div class="admin-form-shell__group">
                <label>Foto Merchandise</label>
                <input type="file" name="foto_merch" class="form-control" accept="image/*">
                <?php if (!empty($merchandiseData['foto_merch'])): ?>
                    <div class="admin-form-shell__photo">
                        <img src="../uploads/<?= htmlspecialchars($merchandiseData['foto_merch']) ?>" alt="Foto lama">
                        <?= htmlspecialchars($merchandiseData['foto_merch']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="admin-form-shell__footer">
                <a href="merchandise_list.php" class="admin-btn-back">Kembali</a>
                <button type="submit" class="admin-btn-save">
                    <?= $isEditMode ? 'Simpan Perubahan' : 'Tambah' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
