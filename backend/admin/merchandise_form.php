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

<style>
    .f-wrap {
        max-width: 1250px;
        background: #fff;
        border: 1px solid #e2d9f3;
        border-radius: 10px;
        overflow: hidden;
    }

    .f-head {
        padding: 14px 20px;
        background: #ede8fa;
        border-bottom: 1px solid #e2d9f3;
        font-size: 0.95rem;
        font-weight: 600;
        color: #2d3748;
    }

    .f-body {
        padding: 24px 20px;
    }

    .f-body label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 5px;
    }

    .f-body .form-control {
        width: 100%;
        padding: 9px 12px;
        font-size: 0.88rem;
        border: 1px solid #d8cff0;
        border-radius: 7px;
        background: #fafafa;
        color: #2d3748;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.15s;
    }

    .f-body .form-control:focus {
        border-color: #7c5ec9;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(124, 94, 201, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    .f-row {
        display: flex;
        gap: 14px;
    }

    .f-row > div {
        flex: 1;
    }

    .f-group {
        margin-bottom: 16px;
    }

    .foto-lama {
        margin-top: 8px;
        font-size: 0.8rem;
        color: #718096;
    }

    .foto-lama img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #d8cff0;
        vertical-align: middle;
        margin-right: 6px;
    }

    .f-footer {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        padding-top: 8px;
        border-top: 1px solid #f0ebfa;
        margin-top: 4px;
    }

    .btn-save {
        padding: 9px 20px;
        background: #7c5ec9;
        color: #fff !important;
        border: none;
        border-radius: 7px;
        font-size: 0.87rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s;
    }

    .btn-save:hover {
        background: #6b4eb8;
    }

    .btn-back {
        padding: 9px 18px;
        background: #fff;
        color: #718096 !important;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 0.87rem;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s;
    }

    .btn-back:hover {
        background: #f7f7f7;
    }
</style>

<div class="f-wrap">
    <div class="f-head"><?= $pageTitle ?></div>

    <div class="f-body">
        <form action="merchandise_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_merch" value="<?= htmlspecialchars($merchandiseData['id_merch'] ?? '') ?>">
            <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($merchandiseData['foto_merch'] ?? '') ?>">

            <div class="f-group">
                <label>Judul Merchandise</label>
                <input type="text" name="judul_merch" class="form-control"
                    value="<?= htmlspecialchars($merchandiseData['judul_merch'] ?? '') ?>" required>
            </div>

            <div class="f-row">
                <div class="f-group">
                    <label>Harga</label>
                    <input type="number" step="0.01" name="harga_merch" class="form-control"
                        value="<?= htmlspecialchars($merchandiseData['harga_merch'] ?? '') ?>" required>
                </div>
                <div class="f-group">
                    <label>Stok</label>
                    <input type="number" name="stock_merch" class="form-control"
                        value="<?= htmlspecialchars($merchandiseData['stock_merch'] ?? '0') ?>" required min="0">
                </div>
            </div>

            <div class="f-group">
                <label>Detail Merchandise</label>
                <textarea name="detail_merch" class="form-control"
                    required><?= htmlspecialchars($merchandiseData['detail_merch'] ?? '') ?></textarea>
            </div>

            <div class="f-group">
                <label>Foto Merchandise</label>
                <input type="file" name="foto_merch" class="form-control" accept="image/*">
                <?php if (!empty($merchandiseData['foto_merch'])): ?>
                    <div class="foto-lama">
                        <img src="../uploads/<?= htmlspecialchars($merchandiseData['foto_merch']) ?>" alt="Foto lama">
                        <?= htmlspecialchars($merchandiseData['foto_merch']) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="f-footer">
                <a href="merchandise_list.php" class="btn-back">Kembali</a>
                <button type="submit" class="btn-save">
                    <?= $isEditMode ? 'Simpan Perubahan' : 'Tambah' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>

