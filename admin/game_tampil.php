<?php
include 'cek_login.php';
$active = 'game';
$page_title = 'Data Game';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_game ORDER BY id_game DESC");
?>

<div class="d-flex justify-content-end mb-3">
    <a href="game_input.php" class="btn btn-success">+ Tambah Game</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Judul</th>
                    <th width="120">Foto</th>
                    <th width="140">Tanggal</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $no=1; while($g = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $g['judul_game'] ?></td>
                    <td>
                        <?php if ($g['foto_game']): ?>
                            <img src="../uploads/<?= $g['foto_game'] ?>" width="80" class="rounded">
                        <?php endif; ?>
                    </td>
                    <td><?= $g['tanggal_game'] ?></td>
                    <td>
                        <a href="game_input.php?id=<?= $g['id_game'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <button onclick="confirmDelete(<?= $g['id_game'] ?>, 'game_proses.php')" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
