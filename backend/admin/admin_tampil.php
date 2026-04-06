<?php
include 'cek_login.php';

$active = 'admin';
$page_title = 'Kelola Admin';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$totalAdminQuery = "SELECT COUNT(*) AS total_admin FROM tb_admin";
$totalAdminResult = mysqli_query($koneksi, $totalAdminQuery);
$totalAdminData = $totalAdminResult ? mysqli_fetch_assoc($totalAdminResult) : ['total_admin' => 0];
$totalAdmin = (int) ($totalAdminData['total_admin'] ?? 0);

$currentUserName = $_SESSION['user_name'] ?? '';
$newAdminUserName = $_SESSION['new_admin_user_name'] ?? '';

$query = "
    SELECT user_name, nama_admin
    FROM tb_admin
    ORDER BY
        CASE
            WHEN user_name = ? THEN 0
            WHEN user_name = ? THEN 1
            ELSE 2
        END,
        user_name ASC
";
$statement = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($statement, "ss", $currentUserName, $newAdminUserName);
mysqli_stmt_execute($statement);
$adminList = mysqli_stmt_get_result($statement);
mysqli_stmt_close($statement);

if ($newAdminUserName !== '' && $newAdminUserName !== $currentUserName) {
    unset($_SESSION['new_admin_user_name']);
}
?>

<div class="d-flex justify-content-end mb-3">
    <a href="admin_input.php" class="btn btn-success">+ Tambah Admin</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Admin</th>
                    <th>Username</th>
                    <th width="240">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $rowNumber = 1;

            if ($adminList && mysqli_num_rows($adminList) > 0):
                while ($admin = mysqli_fetch_assoc($adminList)):
                    $isCurrentUser = isset($_SESSION['user_name']) && $_SESSION['user_name'] === $admin['user_name'];
                    $canDelete = $totalAdmin > 1 && !$isCurrentUser;
            ?>
                <tr>
                    <td><?= $rowNumber++ ?></td>
                    <td><?= htmlspecialchars($admin['nama_admin']) ?></td>
                    <td><?= htmlspecialchars($admin['user_name']) ?></td>
                    <td>
                        <a href="admin_input.php?user_name=<?= urlencode($admin['user_name']) ?>" class="btn btn-warning btn-sm">Edit</a>

                        <?php if ($canDelete): ?>
                            <button
                                onclick="confirmDelete('admin_proses.php?hapus=<?= urlencode($admin['user_name']) ?>', 'admin <?= htmlspecialchars($admin['nama_admin']) ?>')"
                                class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        <?php elseif ($isCurrentUser): ?>
                            <button class="btn btn-secondary btn-sm" disabled>Sedang Login</button>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>Minimal 1 Admin</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="4" class="text-center">Data admin belum tersedia.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
<?php if (isset($_SESSION['success_message'])): ?>
    showSuccessNotification('<?= $_SESSION['success_message'] ?>');
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    showErrorNotification('<?= $_SESSION['error_message'] ?>');
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
</script>

<?php include 'layout/footer.php'; ?>
