<?php
include 'cek_login.php';
$active = 'merch';
$page_title = 'Merchandise';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_merch ORDER BY id_merch DESC");
?>

<div class="d-flex justify-content-end mb-3">
    <a href="merch_input.php" class="btn btn-success">+ Tambah Merchandise</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
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
                        <button onclick="confirmDelete(<?= $m['id_merch'] ?>)" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'merch_proses.php?hapus=' + id;
        }
    });
}
</script>

<?php include 'layout/footer.php'; ?>
