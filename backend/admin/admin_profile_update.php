<?php
include 'cek_login.php';
include '../config/koneksi.php';
include '../config/log_activity.php';
include '../config/helpers.php';

if (isset($_GET['hapus'])) {
    $_SESSION['error_message'] = 'Fitur hapus admin tidak tersedia pada setting profil.';
    header("Location: admin_profile_view.php");
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
    header("Location: admin_profile_view.php");
    exit;
}

$isUpdate = $oldUserName !== '';

if (!$isUpdate) {
    $_SESSION['error_message'] = 'Fitur tambah admin tidak tersedia pada setting profil.';
    header("Location: admin_profile_view.php");
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
        header("Location: admin_profile_view.php");
        exit;
    }

    if (($currentAdmin['user_name'] ?? '') !== ($_SESSION['user_name'] ?? '')) {
        $_SESSION['error_message'] = 'Anda hanya dapat mengubah profil admin yang sedang login.';
        header("Location: admin_profile_view.php");
        exit;
    }

    $hasOldPassword = trim($oldPassword) !== '';
    $hasNewPassword = trim($newPassword) !== '';
    $shouldUpdatePassword = $hasOldPassword || $hasNewPassword;

    if ($shouldUpdatePassword) {
        if (!$hasOldPassword || !$hasNewPassword) {
            $_SESSION['error_message'] = 'Password lama dan password baru wajib diisi jika ingin mengganti password!';
            header("Location: admin_profile.php?user_name=" . urlencode($oldUserName));
            exit;
        }

        if (md5($oldPassword) !== ($currentAdmin['password'] ?? '')) {
            $_SESSION['error_message'] = 'Password lama tidak cocok!';
            header("Location: admin_profile.php?user_name=" . urlencode($oldUserName));
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

if ($duplicateAdmin && $duplicateAdmin['user_name'] !== $oldUserName) {
    $_SESSION['error_message'] = 'Username admin sudah digunakan, silakan gunakan username lain!';
    header("Location: admin_profile.php?user_name=" . urlencode($oldUserName));
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
}

header("Location: admin_profile_view.php");
exit;

