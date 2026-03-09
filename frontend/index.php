<?php
session_start();
require_once '../backend/config/koneksi.php';
require_once '../backend/config/constants.php';
require_once '../backend/config/helpers.php';
require_once '../backend/services/MerchandiseService.php';
require_once '../backend/services/CommentService.php';

$merchandiseService = new MerchandiseService($koneksi);
$commentService = new CommentService($koneksi);

$merchandiseList = $merchandiseService->getAllMerchandise();
$recentComments = $commentService->getAllComments();

$commentError = getFlashMessage('error');
$commentSuccess = getFlashMessage('success');

$navPrefix = '';
$activeSection = '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapak Arwah Nusantara - Board Game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'components/page_loader.php'; ?>
    <?php include 'components/shared/navbar.php'; ?>
    <?php include 'components/sections/hero.php'; ?>
    <?php include 'components/sections/about.php'; ?>
    <?php include 'components/sections/game_showcase.php'; ?>
    <?php include 'components/sections/merchandise.php'; ?>
    <?php include 'components/sections/comment.php'; ?>
    <?php include 'components/shared/footer.php'; ?>

    <script type="module" src="js/main.js"></script>
</body>
</html>
