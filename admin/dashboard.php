<?php
include 'cek_login.php';
$active = 'dashboard';
$page_title = 'Dashboard';
include 'layout/header.php';
include 'layout/sidebar.php';
include '../config/koneksi.php';

$merch = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_merch"))['total'];
$komen = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_komen"))['total'];
?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Merch</h6>
                <h3><?= $merch ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Komentar</h6>
                <h3><?= $komen ?></h3>
            </div>
        </div>
    </div>
</div>

<?php
include 'layout/footer.php';
?>
