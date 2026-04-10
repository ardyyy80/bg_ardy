<?php
include 'cek_login.php';

$active = 'admin';
$page_title = 'Edit Profil';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$currentUserName = $_SESSION['user_name'] ?? '';
$requestedUserName = trim($_GET['user_name'] ?? $currentUserName);
$adminData = null;
$isEditMode = true;

if ($requestedUserName !== $currentUserName) {
    $_SESSION['error_message'] = 'Anda hanya dapat mengedit profil admin yang sedang login.';
    header("Location: admin_profile_view.php");
    exit;
}

$query = "SELECT user_name, nama_admin FROM tb_admin WHERE user_name = ?";
$statement = mysqli_prepare($koneksi, $query);

if ($statement) {
    mysqli_stmt_bind_param($statement, "s", $currentUserName);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $adminData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);
}

if (!$adminData) {
    $_SESSION['error_message'] = 'Data profil admin tidak ditemukan.';
    header("Location: admin_profile_view.php");
    exit;
}

$pageTitle = 'Edit Profil';
?>

<div class="admin-form-shell">
    <div class="admin-form-shell__head"><?= htmlspecialchars($pageTitle) ?></div>

    <div class="admin-form-shell__body">
        <form action="admin_profile_update.php" method="post">
            <input type="hidden" name="old_user_name" value="<?= htmlspecialchars($adminData['user_name'] ?? '') ?>">

            <div class="admin-form-shell__row">
                <div class="admin-form-shell__group">
                    <label for="nama_admin">Nama Admin</label>
                    <input
                        type="text"
                        name="nama_admin"
                        id="nama_admin"
                        class="form-control"
                        value="<?= htmlspecialchars($adminData['nama_admin'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="admin-form-shell__group">
                    <label for="user_name">Username</label>
                    <input
                        type="text"
                        name="user_name"
                        id="user_name"
                        class="form-control"
                        value="<?= htmlspecialchars($adminData['user_name'] ?? '') ?>"
                        required
                    >
                </div>
            </div>

            <div class="admin-form-shell__row">
                <div class="admin-form-shell__group">
                    <label for="old_password">Password Lama</label>
                    <input
                        type="password"
                        name="old_password"
                        id="old_password"
                        class="form-control"
                        placeholder="Isi jika ingin ganti password"
                    >
                </div>

                <div class="admin-form-shell__group">
                    <label for="new_password">Password Baru</label>
                    <input
                        type="password"
                        name="new_password"
                        id="new_password"
                        class="form-control"
                        placeholder="Isi jika ingin ganti password"
                    >
                </div>
            </div>

            <div class="admin-form-shell__note">Nama admin dan username bisa diubah tanpa mengganti password. Jika ingin ganti password, isi password lama dan password baru.</div>

            <div class="admin-form-shell__footer">
                <a href="dashboard.php" class="admin-btn-back">Kembali</a>
                <button type="submit" class="admin-btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
<?php if (isset($_SESSION['error_message'])): ?>
    showErrorNotification('<?= $_SESSION['error_message'] ?>');
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
</script>

<?php include 'layout/footer.php'; ?>
