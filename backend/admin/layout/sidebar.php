<?php
if (!isset($commentNotificationCount)) {
    include_once '../config/koneksi.php';
    require_once '../services/CommentService.php';

    $commentService = new CommentService($koneksi);
    $commentNotificationCount = $commentService->getUnreadCount();
}
?>

<div class="d-flex">
    <div class="sidebar">
        <div class="admin-profile">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <div class="profile-name"><?= htmlspecialchars($_SESSION['nama_admin'] ?? 'Admin') ?></div>
                <div class="profile-role">Admin</div>
            </div>
        </div>

        <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">
            <i class="fas fa-chart-line menu-icon"></i> Dashboard
        </a>

        <a href="merch_tampil.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">
            <i class="fas fa-shopping-bag menu-icon"></i> Merchandise
        </a>

        <a href="komen_tampil.php" class="<?= ($active == 'komen') ? 'active' : '' ?>">
            <span class="menu-label-with-badge">
                <span><i class="fas fa-comments menu-icon"></i> Komentar</span>
                <?php if ($commentNotificationCount > 0): ?>
                    <span class="menu-badge"><?= $commentNotificationCount ?></span>
                <?php endif; ?>
            </span>
        </a>

        <a href="admin_tampil.php" class="<?= ($active == 'admin') ? 'active' : '' ?>">
            <i class="fas fa-user-shield menu-icon"></i> Setting Admin
        </a>

        <div class="mt-auto">
            <a href="javascript:void(0)" onclick="confirmLogout('../logout.php')" class="logout-btn">
                <i class="fas fa-arrow-right-from-bracket menu-icon"></i> Logout
            </a>
        </div>
    </div>

    <div class="flex-fill">
        <div class="header-top">
            <h3><?= htmlspecialchars($page_title ?? 'Admin Panel') ?></h3>
        </div>

        <div class="content p-4">
