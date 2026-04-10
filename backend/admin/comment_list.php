<?php
include 'cek_login.php';

$active = 'komen';
$page_title = 'Komentar';

include '../config/koneksi.php';
require_once '../services/CommentService.php';

$commentService = new CommentService($koneksi);
$latestNotificationComment = $commentService->getLatestUnnotifiedComment();

if ($latestNotificationComment) {
    $commentService->markAsNotified((int) $latestNotificationComment['id_komen']);
}

$commentService->markAllAsRead();
$commentNotificationCount = 0;

include 'layout/header.php';
include 'layout/sidebar.php';

$query = "SELECT * FROM tb_komen ORDER BY id_komen DESC";
$commentList = mysqli_query($koneksi, $query);
?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive table-responsive--tall">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penulis</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $rowNumber = 1;
                while ($comment = mysqli_fetch_assoc($commentList)):
                ?>
                    <tr>
                        <td><?= $rowNumber++ ?></td>
                        <td><?= htmlspecialchars($comment['nama_penulis']) ?></td>
                        <td><?= htmlspecialchars($comment['detail_komen']) ?></td>
                        <td><?= htmlspecialchars($comment['tanggal_komen']) ?></td>
                        <td>
                            <button 
                                onclick="confirmDelete('comment_process.php?hapus=<?= $comment['id_komen'] ?>', 'komentar ini')" 
                                class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
<?php if ($latestNotificationComment): ?>
    showSuccessNotification('Komentar baru dari <?= htmlspecialchars(addslashes($latestNotificationComment['nama_penulis'])) ?> berhasil masuk.');
<?php endif; ?>

<?php if (isset($_SESSION['success_message'])): ?>
    showSuccessNotification('<?= htmlspecialchars(addslashes($_SESSION['success_message'])) ?>');
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    showErrorNotification('<?= htmlspecialchars(addslashes($_SESSION['error_message'])) ?>');
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
</script>

<?php include 'layout/footer.php'; ?>
