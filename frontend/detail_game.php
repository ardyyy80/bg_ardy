<?php
$text = require_once 'data/game_text.php';

if (!is_array($text)) {
    die('Error loading game content');
}

$navPrefix = 'index.php';
$activeSection = 'game';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Bermain | Tapak Arwah Nusantara</title>
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'components/shared/navbar.php'; ?>

    <section class="detail-game-section">
        <div class="container">
            <h1 class="page-title"><?= $text['page_title'] ?></h1>
            
            <?php include 'components/game-detail/board_preview.php'; ?>
            
            <div class="game-detail-content">
                <?php include 'components/game-detail/komponen.php'; ?>
                <?php include 'components/game-detail/persiapan.php'; ?>
                <?php include 'components/game-detail/menentukan_giliran.php'; ?>
                <?php include 'components/game-detail/giliran.php'; ?>
                <?php include 'components/game-detail/petak.php'; ?>
                <?php include 'components/game-detail/serangan.php'; ?>
                <?php include 'components/game-detail/kondisi.php'; ?>
                <?php include 'components/game-detail/akhir.php'; ?>

                <div class="back-button-container">
                    <a href="index.php#game" class="btn btn-primary btn-back">
                        <span><?= $text['button_back'] ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'components/shared/footer.php'; ?>

    <script type="module" src="js/main.js"></script>
</body>
</html>
