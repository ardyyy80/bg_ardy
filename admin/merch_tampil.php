<?php
$active = 'merch';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_merch ORDER BY id_merch DESC");
?>

<h3 class="mb-3">Data Merchandise</h3>

<a href="merch_input.php" class="btn btn-success mb-3">+ Tambah Merchandise</a>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead class="table-primary">
                <!-- Header tabel merchandise -->
                <tr>
                    <th width="50">No</th>
                    <th>Judul</th>
                    <th width="120">Foto</th>
                    <th width="140">Harga</th>
                    <th width="200">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; while($m = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $m['judul_merch'] ?></td>
                    <td>
                        <?php if ($m['foto_merch']): ?>
                            <img src="../uploads/<?= $m['foto_merch'] ?>" width="80" class="rounded">
                        <?php endif; ?>
                    </td>
                    <td>Rp <?= number_format($m['harga_merch'], 0, ',', '.') ?></td>
                    <td>
                        <a href="merch_input.php?id=<?= $m['id_merch'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="merch_proses.php?hapus=<?= $m['id_merch'] ?>"
                           onclick="return confirm('Hapus data?')"
                           class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
