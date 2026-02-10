<?php
include 'cek_login.php';
$active = 'dashboard';
$page_title = 'Dashboard';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_merch");
$merch = mysqli_fetch_assoc($result)['total'];

$result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_komen");
$komen = mysqli_fetch_assoc($result)['total'];

$activity_query = mysqli_query($koneksi, "SELECT * FROM tb_activity_log ORDER BY created_at DESC LIMIT 10");
?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Merch</h6>
                <h3><?= $merch ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Komentar</h6>
                <h3><?= $komen ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Riwayat Aktivitas Admin</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Admin</th>
                                <th>Aktivitas</th>
                                <th>Module</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($activity_query) > 0): ?>
                                <?php 
                                $no = 1;
                                while ($activity = mysqli_fetch_assoc($activity_query)): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($activity['nama_admin']) ?></td>
                                    <td><?= htmlspecialchars($activity['activity']) ?></td>
                                    <td><span class="badge bg-primary"><?= htmlspecialchars($activity['module']) ?></span></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($activity['created_at'])) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada aktivitas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'layout/footer.php';
?>
