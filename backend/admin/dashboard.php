<?php
include 'cek_login.php';

$active = 'dashboard';
$page_title = 'Dashboard';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$merchandiseQuery = "SELECT COUNT(*) as total FROM tb_merch";
$merchandiseResult = mysqli_query($koneksi, $merchandiseQuery);
$totalMerchandise = mysqli_fetch_assoc($merchandiseResult)['total'];

$commentQuery = "SELECT COUNT(*) as total FROM tb_komen";
$commentResult = mysqli_query($koneksi, $commentQuery);
$totalComments = mysqli_fetch_assoc($commentResult)['total'];

$activityQuery = "SELECT * FROM tb_activity_log ORDER BY created_at DESC LIMIT 10";
$activityList = mysqli_query($koneksi, $activityQuery);
$hasActivities = mysqli_num_rows($activityList) > 0;
?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Merch</h6>
                <h3><?= $totalMerchandise ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Komentar</h6>
                <h3><?= $totalComments ?></h3>
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
