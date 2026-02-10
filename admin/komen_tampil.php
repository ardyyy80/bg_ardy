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
                <tr>
                    <th width="50">No</th>
                    <th>Nama Penulis</th>
                    <th>Komentar</th>
                    <th width="140">Tanggal</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            while ($k = mysqli_fetch_assoc($data)):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($k['nama_penulis']) ?></td>
                    <td><?= htmlspecialchars($k['detail_komen']) ?></td>
                    <td><?= htmlspecialchars($k['tanggal_komen']) ?></td>
                    <td>
                        <button onclick="confirmDelete(<?= $k['id_komen'] ?>, 'komen_proses.php')" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
