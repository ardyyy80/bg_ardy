<?php
include 'cek_login.php';

$active = 'dashboard';
$page_title = 'Dashboard';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$adminQuery = "SELECT COUNT(*) as total FROM tb_admin";
$adminResult = mysqli_query($koneksi, $adminQuery);
$totalAdmin = mysqli_fetch_assoc($adminResult)['total'];

$merchandiseQuery = "SELECT COUNT(*) as total FROM tb_merch";
$merchandiseResult = mysqli_query($koneksi, $merchandiseQuery);
$totalMerchandise = mysqli_fetch_assoc($merchandiseResult)['total'];

$commentQuery = "SELECT COUNT(*) as total FROM tb_komen";
$commentResult = mysqli_query($koneksi, $commentQuery);
$totalComments = mysqli_fetch_assoc($commentResult)['total'];

$adminListQuery = "SELECT nama_admin, user_name FROM tb_admin ORDER BY nama_admin ASC";
$adminListResult = mysqli_query($koneksi, $adminListQuery);
$hasAdminList = mysqli_num_rows($adminListResult) > 0;

$activityQuery = "SELECT * FROM tb_activity_log ORDER BY created_at DESC";
$activityList = mysqli_query($koneksi, $activityQuery);
$hasActivities = mysqli_num_rows($activityList) > 0;
?>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h6>Admin</h6>
                <h3><?= $totalAdmin ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h6>Merch</h6>
                <h3><?= $totalMerchandise ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                <h6>Komentar</h6>
                <h3><?= $totalComments ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm h-100 admin-dashboard-panel">
            <div class="card-header admin-panel-header">
                <div>
                    <h5 class="mb-0">Daftar Admin</h5>
                    <small class="admin-panel-subtitle">Lihat daftar admin aktif beserta username yang digunakan.</small>
                </div>
                <a href="admin_tampil.php" class="btn btn-primary btn-sm admin-panel-action">Buka Setting Admin</a>
            </div>
            <div class="card-body">
                <div class="table-responsive admin-table-wrapper">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Admin</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($hasAdminList): ?>
                                <?php
                                $adminNumber = 1;
                                while ($admin = mysqli_fetch_assoc($adminListResult)):
                                ?>
                                <tr>
                                    <td><?= $adminNumber++ ?></td>
                                    <td><?= htmlspecialchars($admin['nama_admin']) ?></td>
                                    <td><?= htmlspecialchars($admin['user_name']) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">Data admin belum tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7 mb-4">
        <div class="card shadow-sm h-100 admin-dashboard-panel">
            <div class="card-header admin-panel-header">
                <div>
                    <h5 class="mb-0">Riwayat Aktivitas Admin</h5>
                    <small class="admin-panel-subtitle">Pantau aktivitas terbaru yang dilakukan oleh admin.</small>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive activity-table-wrapper">
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
                            <?php if ($hasActivities): ?>
                                <?php 
                                $rowNumber = 1;
                                while ($activity = mysqli_fetch_assoc($activityList)): 
                                    $formattedDate = date('d/m/Y H:i:s', strtotime($activity['created_at']));
                                ?>
                                <tr>
                                    <td><?= $rowNumber++ ?></td>
                                    <td><?= htmlspecialchars($activity['nama_admin']) ?></td>
                                    <td><?= htmlspecialchars($activity['activity']) ?></td>
                                    <td><span class="badge bg-primary"><?= htmlspecialchars($activity['module']) ?></span></td>
                                    <td><?= $formattedDate ?></td>
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
