<?php
include 'cek_login.php';

$active = 'komen';
$page_title = 'Komentar';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$query = "SELECT * FROM tb_komen ORDER BY id_komen DESC";
$commentList = mysqli_query($koneksi, $query);
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
            $rowNumber = 1;
            while ($comment = mysqli_fetch_assoc($commentList)):
            ?>
                <tr>
                    <td><?= $rowNumber++ ?></td>
                    <td><?= htmlspecialchars($comment['nama_penulis']) ?></td>
                    <td><?= htmlspecialchars($comment['detail_komen']) ?></td>
                    <td><?= htmlspecialchars($comment['tanggal_komen']) ?></td>
                    <td>
                        <a href="komen_proses.php?hapus=<?= $comment['id_komen'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
