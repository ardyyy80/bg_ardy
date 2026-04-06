<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';
include '../config/helpers.php';

if (isset($_GET['hapus'])) {
    $targetUserName = sanitizeInput($koneksi, $_GET['hapus'] ?? '');

    if ($targetUserName === '') {
        $_SESSION['error_message'] = 'Data admin tidak valid!';
        header("Location: admin_tampil.php");
        exit;
    }

    $selectQuery = "SELECT user_name, nama_admin FROM tb_admin WHERE user_name = ?";
    $selectStatement = mysqli_prepare($koneksi, $selectQuery);
    mysqli_stmt_bind_param($selectStatement, "s", $targetUserName);
    mysqli_stmt_execute($selectStatement);
    $selectResult = mysqli_stmt_get_result($selectStatement);
    $adminData = mysqli_fetch_assoc($selectResult);
    mysqli_stmt_close($selectStatement);

    if (empty($adminData)) {
        $_SESSION['error_message'] = 'Data admin tidak ditemukan!';
        header("Location: admin_tampil.php");
        exit;
    }

    if (($adminData['user_name'] ?? '') === ($_SESSION['user_name'] ?? '')) {
        $_SESSION['error_message'] = 'Admin yang sedang login tidak dapat dihapus!';
        header("Location: admin_tampil.php");
        exit;
    }

    $totalAdminQuery = "SELECT COUNT(*) AS total_admin FROM tb_admin";
    $totalAdminResult = mysqli_query($koneksi, $totalAdminQuery);
    $totalAdminData = $totalAdminResult ? mysqli_fetch_assoc($totalAdminResult) : ['total_admin' => 0];
    $totalAdmin = (int) ($totalAdminData['total_admin'] ?? 0);

    if ($totalAdmin <= 1) {
        $_SESSION['error_message'] = 'Minimal harus ada 1 admin dalam sistem!';
        header("Location: admin_tampil.php");
        exit;
    }

    $deleteQuery = "DELETE FROM tb_admin WHERE user_name = ?";
    $deleteStatement = mysqli_prepare($koneksi, $deleteQuery);
    mysqli_stmt_bind_param($deleteStatement, "s", $targetUserName);
    $isDeleted = mysqli_stmt_execute($deleteStatement);
    mysqli_stmt_close($deleteStatement);

    if ($isDeleted) {
        log_activity($koneksi, "Menghapus admin: " . $adminData['nama_admin'], 'Admin');
        $_SESSION['success_message'] = 'Data admin berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus data admin!';
    }

    header("Location: admin_tampil.php");
    exit;
}

$oldUserName = sanitizeInput($koneksi, $_POST['old_user_name'] ?? '');
$namaAdmin = sanitizeInput($koneksi, $_POST['nama_admin'] ?? '');
$userName = sanitizeInput($koneksi, $_POST['user_name'] ?? '');
$password = $_POST['password'] ?? '';
$oldPassword = $_POST['old_password'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if ($namaAdmin === '' || $userName === '') {
    $_SESSION['error_message'] = 'Nama admin dan username wajib diisi!';
    header("Location: admin_tampil.php");
    exit;
}

$isUpdate = $oldUserName !== '';

if (!$isUpdate && trim($password) === '') {
    $_SESSION['old_admin_input'] = [
        'nama_admin' => $namaAdmin,
        'user_name' => $userName,
    ];
    $_SESSION['error_message'] = 'Password wajib diisi untuk menambah admin!';
    header("Location: admin_input.php");
    exit;
}

if (!$isUpdate && $password !== $confirmPassword) {
    $_SESSION['old_admin_input'] = [
        'nama_admin' => $namaAdmin,
        'user_name' => $userName,
    ];
    $_SESSION['error_message'] = 'Password tidak cocok!';
    header("Location: admin_input.php");
    exit;
}

$currentAdmin = null;
$shouldUpdatePassword = false;

if ($isUpdate) {
    $checkCurrentQuery = "SELECT user_name, password FROM tb_admin WHERE user_name = ?";
    $checkCurrentStatement = mysqli_prepare($koneksi, $checkCurrentQuery);
    mysqli_stmt_bind_param($checkCurrentStatement, "s", $oldUserName);
    mysqli_stmt_execute($checkCurrentStatement);
    $checkCurrentResult = mysqli_stmt_get_result($checkCurrentStatement);
    $currentAdmin = mysqli_fetch_assoc($checkCurrentResult);
    mysqli_stmt_close($checkCurrentStatement);

    if (!$currentAdmin) {
        $_SESSION['error_message'] = 'Data admin yang akan diupdate tidak ditemukan!';
        header("Location: admin_tampil.php");
        exit;
    }

    $hasOldPassword = trim($oldPassword) !== '';
    $hasNewPassword = trim($newPassword) !== '';
    $shouldUpdatePassword = $hasOldPassword || $hasNewPassword;

    if ($shouldUpdatePassword) {
        if (!$hasOldPassword || !$hasNewPassword) {
            $_SESSION['error_message'] = 'Password lama dan password baru wajib diisi jika ingin mengganti password!';
            header("Location: admin_input.php?user_name=" . urlencode($oldUserName));
            exit;
        }

        if (md5($oldPassword) !== ($currentAdmin['password'] ?? '')) {
            $_SESSION['error_message'] = 'Password lama tidak cocok!';
            header("Location: admin_input.php?user_name=" . urlencode($oldUserName));
            exit;
        }
    }
}

$checkQuery = "SELECT user_name FROM tb_admin WHERE user_name = ?";
$checkStatement = mysqli_prepare($koneksi, $checkQuery);
mysqli_stmt_bind_param($checkStatement, "s", $userName);
mysqli_stmt_execute($checkStatement);
$checkResult = mysqli_stmt_get_result($checkStatement);
$duplicateAdmin = mysqli_fetch_assoc($checkResult);
mysqli_stmt_close($checkStatement);

if ($duplicateAdmin && (!$isUpdate || $duplicateAdmin['user_name'] !== $oldUserName)) {
    if (!$isUpdate) {
        $_SESSION['old_admin_input'] = [
            'nama_admin' => $namaAdmin,
            'user_name' => $userName,
        ];
        header("Location: admin_input.php");
    } else {
        header("Location: admin_tampil.php");
    }

    $_SESSION['error_message'] = 'Username admin sudah digunakan, silakan gunakan username lain!';
    exit;
}

if ($isUpdate) {
    if ($shouldUpdatePassword) {
        $hashedPassword = md5($newPassword);
        $updateQuery = "UPDATE tb_admin SET nama_admin = ?, user_name = ?, password = ? WHERE user_name = ?";
        $updateStatement = mysqli_prepare($koneksi, $updateQuery);
        mysqli_stmt_bind_param($updateStatement, "ssss", $namaAdmin, $userName, $hashedPassword, $oldUserName);
    } else {
        $updateQuery = "UPDATE tb_admin SET nama_admin = ?, user_name = ? WHERE user_name = ?";
        $updateStatement = mysqli_prepare($koneksi, $updateQuery);
        mysqli_stmt_bind_param($updateStatement, "sss", $namaAdmin, $userName, $oldUserName);
    }

    $isSuccess = mysqli_stmt_execute($updateStatement);
    mysqli_stmt_close($updateStatement);

    if ($isSuccess) {
        if (($_SESSION['user_name'] ?? '') === $oldUserName) {
            $_SESSION['nama_admin'] = $namaAdmin;
            $_SESSION['user_name'] = $userName;
        }

        log_activity($koneksi, "Mengupdate admin: " . $namaAdmin, 'Admin');
        $_SESSION['success_message'] = $shouldUpdatePassword
            ? 'Data admin dan password berhasil diupdate!'
            : 'Data admin berhasil diupdate tanpa mengubah password!';
    } else {
        $_SESSION['error_message'] = 'Gagal mengupdate data admin!';
    }
} else {
    $hashedPassword = md5($password);
    $insertQuery = "INSERT INTO tb_admin (nama_admin, user_name, password) VALUES (?, ?, ?)";
    $insertStatement = mysqli_prepare($koneksi, $insertQuery);
    mysqli_stmt_bind_param($insertStatement, "sss", $namaAdmin, $userName, $hashedPassword);
    $isSuccess = mysqli_stmt_execute($insertStatement);
    mysqli_stmt_close($insertStatement);

    if ($isSuccess) {
        unset($_SESSION['old_admin_input']);
        $_SESSION['new_admin_user_name'] = $userName;
        log_activity($koneksi, "Menambah admin: " . $namaAdmin, 'Admin');
        $_SESSION['success_message'] = 'Data admin berhasil ditambahkan!';
    } else {
        $_SESSION['old_admin_input'] = [
            'nama_admin' => $namaAdmin,
            'user_name' => $userName,
        ];
        $_SESSION['error_message'] = 'Gagal menambahkan data admin!';
        header("Location: admin_input.php");
        exit;
    }
}

header("Location: admin_tampil.php");
exit;
