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
        <div class="sidebar-brand">
            <img src="../../frontend/assets/logonavbar.png" alt="Logo Navbar" class="sidebar-brand-logo">
        </div>

        <div class="sidebar-menu">
            <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">
            <i class="fas fa-chart-line menu-icon"></i> Dashboard
        </a>

        <a href="merchandise_list.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">
            <i class="fas fa-shopping-bag menu-icon"></i> Merchandise
        </a>

        <a href="comment_list.php" class="<?= ($active == 'komen') ? 'active' : '' ?>">
            <span class="menu-label-with-badge">
                <span><i class="fas fa-comments menu-icon"></i> Komentar</span>
                <?php if ($commentNotificationCount > 0): ?>
                    <span class="menu-badge"><?= $commentNotificationCount ?></span>
                <?php endif; ?>
            </span>
        </a>
        </div>

        <div class="admin-profile admin-profile-bottom">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <div class="profile-name"><?= htmlspecialchars($_SESSION['nama_admin'] ?? 'Admin') ?></div>
                <div class="profile-role">Admin</div>
            </div>
        </div>
    </div>

    <div class="flex-fill">
        <div class="header-top">
            <h3><?= htmlspecialchars($page_title ?? 'Admin Panel') ?></h3>

            <div class="header-actions">
                <details class="header-account-menu">
                    <summary class="header-action-btn <?= ($active == 'admin') ? 'active' : '' ?>">
                        <i class="fas fa-user-circle"></i>
                        <i class="fas fa-chevron-down header-dropdown-icon"></i>
                    </summary>

                    <div class="header-dropdown-list">
                        <a href="admin_profile_view.php" class="header-dropdown-item <?= ($active == 'admin') ? 'active' : '' ?>">
                            <i class="fas fa-user-shield"></i>
                            <span>Setting Profil</span>
                        </a>

                        <a href="javascript:void(0)" onclick="confirmLogout('../logout.php')" class="header-dropdown-item logout-header-btn">
                            <i class="fas fa-arrow-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </details>
            </div>
        </div>

        <div class="content p-4">

