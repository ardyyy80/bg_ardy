<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/helpers.php';
require_once 'services/CommentService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('../frontend/index.php');
}

$authorName = trim($_POST['nama_penulis'] ?? '');
$commentText = trim($_POST['detail_komen'] ?? '');

if (empty($authorName) || empty($commentText)) {
    setFlashMessage('error', 'Nama dan komentar harus diisi!');
    redirectTo('../frontend/index.php#comment');
}

$commentService = new CommentService($koneksi);
$success = $commentService->createComment($authorName, $commentText);

if ($success) {
    setFlashMessage('success', 'Komentar berhasil dikirim!');
} else {
    setFlashMessage('error', 'Gagal mengirim komentar!');
}

redirectTo('../frontend/index.php#comment');
