<?php
$active = 'developer';
$page_title = 'Developer';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_developer ORDER BY id_dev DESC");
?>

<div class="d-flex justify-content-end mb-3">
    <a href="developer_input.php" class="btn btn-success">+ Tambah Developer</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead class="table-primary">
                <!-- Header tabel developer -->
                <tr>
                    <th width="50">No</th>
                    <th>Nama</th>
                    <th width="120">Foto</th>
                    <th>Biodata</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; while($d = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama_dev'] ?></td>
                    <td>
                        <?php if ($d['foto_dev']): ?>
                            <img src="../uploads/<?= $d['foto_dev'] ?>" width="80" class="rounded">
                        <?php endif; ?>
                    </td>
                    <td><?= substr($d['biodata_dev'], 0, 100) ?>...</td>
                    <td>
                        <a href="developer_input.php?id=<?= $d['id_dev'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="developer_proses.php?hapus=<?= $d['id_dev'] ?>"
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
