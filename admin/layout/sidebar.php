<div class="d-flex">
    <div class="sidebar">
        <div class="sidebar-header">
            <h5 style="color: #7c5ec9; font-weight: bold;">ADMIN</h5>
        </div>

        <a href="dashboard.php" class="<?= ($active == 'dashboard') ? 'active' : '' ?>">Dashboard</a>

        <a href="game_tampil.php" class="<?= ($active == 'game') ? 'active' : '' ?>">Data Game</a>

        <a href="merch_tampil.php" class="<?= ($active == 'merch') ? 'active' : '' ?>">Merchandise</a>

        <a href="komen_tampil.php" class="<?= ($active == 'komen') ? 'active' : '' ?>">Komentar</a>
    </div>

    <div class="flex-fill">
        <div class="header-top">
            <h3><?= isset($page_title) ? $page_title : 'Admin Panel' ?></h3>
            <button onclick="confirmLogout()" class="btn btn-danger">Logout</button>
        </div>

        <div class="content p-4">
        
        <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../logout.php';
                }
            });
        }
        </script>
