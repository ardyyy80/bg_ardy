<div class="d-flex">
    <div class="sidebar">
        <div class="sidebar-header">
            <h5 class="text-white">ADMIN</h5>
        </div>

        <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">Dashboard</a>

        <a href="game_tampil.php" class="<?= ($active == 'game') ? 'active' : '' ?>">Data Game</a>

        <a href="berita_tampil.php" class="<?= ($active == 'berita') ? 'active' : '' ?>">Berita</a>

        <a href="merch_tampil.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">Merchandise</a>

        <a href="developer_tampil.php" class="<?= ($active == 'developer') ? 'active' : '' ?>">Developer</a>

        <a href="komen_tampil.php" class="<?= ($active == 'komen') ? 'active' : '' ?>">Komentar</a>
    </div>

    <div class="flex-fill">
        <div class="header-top">
            <h3><?= isset($page_title) ? $page_title : 'Admin Panel' ?></h3>
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="content p-4">
