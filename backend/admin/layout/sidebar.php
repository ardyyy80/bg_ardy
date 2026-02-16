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
            <i class="fas fa-comments menu-icon"></i> Komentar
        </a>

        <div class="mt-auto">
            <a href="../logout.php" class="logout-btn">
                <i class="fas fa-arrow-right-from-bracket menu-icon"></i> Logout
            </a>
        </div>
    </div>

    <div class="flex-fill">
        <div class="header-top">
            <h3><?= htmlspecialchars($page_title ?? 'Admin Panel') ?></h3>
        </div>

        <div class="content p-4">
