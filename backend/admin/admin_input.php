<?php
include 'cek_login.php';

$active = 'admin';
$page_title = 'Kelola Admin';

include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$currentUserName = trim($_GET['user_name'] ?? '');
$adminData = null;
$oldInput = $_SESSION['old_admin_input'] ?? [];
$isEditMode = $currentUserName !== '';

if ($isEditMode) {
    $query = "SELECT user_name, nama_admin FROM tb_admin WHERE user_name = ?";
    $statement = mysqli_prepare($koneksi, $query);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "s", $currentUserName);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $adminData = mysqli_fetch_assoc($result);
        mysqli_stmt_close($statement);

        if (!$adminData) {
            $isEditMode = false;
            $currentUserName = '';
        }
    }
}

$pageTitle = $isEditMode ? 'Edit Admin' : 'Tambah Admin';

if (!$isEditMode && !empty($oldInput)) {
    $adminData = [
        'nama_admin' => $oldInput['nama_admin'] ?? '',
        'user_name' => $oldInput['user_name'] ?? '',
    ];
    unset($_SESSION['old_admin_input']);
}
?>

<style>
    .f-wrap {
        max-width: 1250px;
        background: #fff;
        border: 1px solid #e2d9f3;
        border-radius: 10px;
        overflow: hidden;
    }

    .f-head {
        padding: 14px 20px;
        background: #ede8fa;
        border-bottom: 1px solid #e2d9f3;
        font-size: 0.95rem;
        font-weight: 600;
        color: #2d3748;
    }

    .f-body {
        padding: 24px 20px;
    }

    .f-body label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 5px;
    }

    .f-body .form-control {
        width: 100%;
        padding: 9px 12px;
        font-size: 0.88rem;
        border: 1px solid #d8cff0;
        border-radius: 7px;
        background: #fafafa;
        color: #2d3748;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: border-color 0.15s;
    }

    .f-body .form-control:focus {
        border-color: #7c5ec9;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(124, 94, 201, 0.1);
    }

    .f-row {
        display: flex;
        gap: 14px;
    }

    .f-row > div {
        flex: 1;
    }

    .f-group {
        margin-bottom: 16px;
    }

    .f-footer {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        padding-top: 8px;
        border-top: 1px solid #f0ebfa;
        margin-top: 4px;
    }

    .btn-save {
        padding: 9px 20px;
        background: #7c5ec9;
        color: #fff !important;
        border: none;
        border-radius: 7px;
        font-size: 0.87rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s;
    }

    .btn-save:hover {
        background: #6b4eb8;
    }

    .btn-back {
        padding: 9px 18px;
        background: #fff;
        color: #718096 !important;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 0.87rem;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        transition: background 0.2s;
    }

    .btn-back:hover {
        background: #f7f7f7;
    }

    .input-note {
        margin-top: 6px;
        font-size: 0.78rem;
        color: #718096;
    }
</style>

<div class="f-wrap">
    <div class="f-head"><?= htmlspecialchars($pageTitle) ?></div>

    <div class="f-body">
        <form action="admin_proses.php" method="post">
            <input type="hidden" name="old_user_name" value="<?= htmlspecialchars($adminData['user_name'] ?? '') ?>">

            <div class="f-row">
                <div class="f-group">
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

                <div class="f-group">
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

            <?php if ($isEditMode): ?>
                <div class="f-row">
                    <div class="f-group">
                        <label for="old_password">Password Lama</label>
                        <input
                            type="password"
                            name="old_password"
                            id="old_password"
                            class="form-control"
                            placeholder="Isi jika ingin ganti password"
                        >
                    </div>

                    <div class="f-group">
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

                <div class="input-note">Nama admin dan username bisa diubah tanpa mengganti password. Jika ingin ganti password, isi password lama dan password baru.</div>
            <?php else: ?>
                <div class="f-row">
                    <div class="f-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Masukkan password admin"
                            required
                        >
                    </div>

                    <div class="f-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input
                            type="password"
                            name="confirm_password"
                            id="confirm_password"
                            class="form-control"
                            placeholder="Ulangi password admin"
                            required
                        >
                    </div>
                </div>

                <div class="input-note">Password dan konfirmasi password harus sama.</div>
            <?php endif; ?>

            <div class="f-footer">
                <a href="admin_tampil.php" class="btn-back">Kembali</a>
                <button type="submit" class="btn-save">
                    <?= $isEditMode ? 'Simpan Perubahan' : 'Tambah' ?>
                </button>
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
