<?php
include 'cek_login.php';

$active = 'merch';
$page_title = 'Merchandise';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$query = "SELECT * FROM tb_merch ORDER BY id_merch DESC";
$merchandiseList = mysqli_query($koneksi, $query);
?>

<div class="d-flex justify-content-end mb-3">
    <a href="merch_input.php" class="btn btn-success">+ Tambah Merchandise</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Judul</th>
                    <th width="120">Foto</th>
                    <th width="140">Harga</th>
                    <th width="100">Stok</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $rowNumber = 1;
            while ($merchandise = mysqli_fetch_assoc($merchandiseList)):
                $hasPhoto = !empty($merchandise['foto_merch']);
            ?>
                <tr>
                    <td><?= $rowNumber++ ?></td>
                    <td><?= htmlspecialchars($merchandise['judul_merch']) ?></td>
                    <td>
                        <?php if ($hasPhoto): ?>
                            <img src="../uploads/<?= htmlspecialchars($merchandise['foto_merch']) ?>" width="80" class="rounded">
                        <?php endif; ?>
                    </td>
                    <td>Rp <?= number_format($merchandise['harga_merch'], 0, ',', '.') ?></td>
                    <td><?= number_format($merchandise['stock_merch'], 0, ',', '.') ?></td>
                    <td>
                        <a href="merch_input.php?id=<?= $merchandise['id_merch'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <button 
                            onclick="confirmDelete('merch_proses.php?hapus=<?= $merchandise['id_merch'] ?>', 'merchandise <?= htmlspecialchars($merchandise['judul_merch']) ?>')" 
                            class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
<?php if (isset($_SESSION['success_message'])): ?>
    showSuccessNotification('<?= $_SESSION['success_message'] ?>');
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    showErrorNotification('<?= $_SESSION['error_message'] ?>');
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
</script>

<?php include 'layout/footer.php'; ?>
