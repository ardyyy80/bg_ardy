<?php
$active = 'berita';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_berita ORDER BY id_berita DESC");
?>

<h3 class="mb-3">Data Berita</h3>

<a href="berita_input.php" class="btn btn-success mb-3">+ Tambah Berita</a>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead class="table-primary"> <!-- bst=dark,info,primary -->
                <!-- Header tabel berita -->
                <tr>
                    <th width="50">No</th>
                    <th>Judul</th>
                    <th width="140">Tanggal</th>
                    <th width="120">Foto</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; while($b = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $b['judul_berita'] ?></td>
                    <td><?= $b['tanggal_berita'] ?></td>
                    <td>
                        <?php if ($b['foto_berita']): ?>
                            <img src="../uploads/<?= $b['foto_berita'] ?>" width="80" class="rounded">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="berita_input.php?id=<?= $b['id_berita'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="berita_proses.php?hapus=<?= $b['id_berita'] ?>"
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
