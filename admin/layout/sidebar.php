<div class="d-flex">
    <div class="sidebar">
        <h5 class="text-white text-center py-3 border-bottom">ADMIN</h5>

        <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">Dashboard</a>

        <a href="game_tampil.php" class="<?= ($active == 'game') ? 'active' : '' ?>">Data Game</a>

        <a href="berita_tampil.php" class="<?= ($active == 'berita') ? 'active' : '' ?>">Berita</a>

        <a href="merch_tampil.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">Merchandise</a>

        <a href="developer_tampil.php" class="<?= ($active == 'developer') ? 'active' : '' ?>">Developer</a>

        <a href="komen_tampil.php" class="<?= ($active == 'komen') ? 'active' : '' ?>">Komentar</a>

        <a href="../logout.php" class="text-danger">Logout</a>
    </div>

    <div class="flex-fill p-4">
