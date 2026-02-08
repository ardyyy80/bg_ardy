<div class="d-flex">
    <div class="sidebar">
        <div class="sidebar-header">
            <h5 style="color: #7c5ec9; font-weight: bold;">ADMIN</h5>
        </div>

        <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">
            <i class="fas fa-chart-line menu-icon"></i> Dashboard
        </a>

        <a href="game_tampil.php" class="<?= ($active == 'game') ? 'active' : '' ?>">
            <i class="fas fa-gamepad menu-icon"></i> Data Game
        </a>

        <a href="merch_tampil.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">
            <i class="fas fa-shopping-bag menu-icon"></i> Merchandise
        </a>

        <a href="komen_tampil.php" class="<?= ($active == 'komen') ? 'active' : '' ?>">
            <i class="fas fa-comments menu-icon"></i> Komentar
        </a>

        <div class="mt-auto">
            <button onclick="confirmLogout()" class="btn btn-danger w-100">
                <i class="fas fa-arrow-right-from-bracket menu-icon"></i> Logout
            </button>
        </div>
    </div>

    <div class="flex-fill">
        <div class="header-top">
            <h3><?= isset($page_title) ? $page_title : 'Admin Panel' ?></h3>
        </div>

        <div class="content p-4">
