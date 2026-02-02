<?php
include 'cek_login.php';
$active = 'komen';
$page_title = 'Komentar';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_komen ORDER BY id_komen DESC");
?>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
                <!-- Header tabel komentar -->
                <tr>
                    <th width="50">No</th>
                    <th>Nama Penulis</th>
                    <th>Komentar</th>
                    <th width="140">Tanggal</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; while($k = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($k['nama_penulis']) ?></td>
                    <td><?= htmlspecialchars($k['detail_komen']) ?></td>
                    <td><?= $k['tanggal_komen'] ?></td>
                    <td>
                        <button onclick="confirmDelete(<?= $k['id_komen'] ?>)" class="btn btn-danger btn-sm">Hapus</button>
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
        text: 'Apakah Anda yakin ingin menghapus komentar ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'komen_proses.php?hapus=' + id;
        }
    });
}
</script>

<?php include 'layout/footer.php'; ?>
