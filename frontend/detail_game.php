<?php
$text = include 'game_text.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Bermain - Tapak Arwah Nusantara</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container nav-container">
            <div class="logo">
                <img src="assets/logonavbar.png" alt="Logo Tapak Arwah Nusantara">
            </div>
            <ul class="nav-menu">
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#game">Game</a></li>
                <li><a href="index.php#merchandise">Merchandise</a></li>
                <li><a href="index.php#comment">Comment</a></li>
            </ul>
        </div>
    </nav>

    <section class="detail-game-section">
        <div class="container">
            <h1 class="page-title"><?= $text['page_title'] ?></h1>
            
            <div class="board-preview-section">
                <div class="board-preview-card">
                    <img src="<?= $text['board_preview']['image'] ?>" alt="Arena Tapak Arwah Nusantara" class="board-preview-image">
                    <div class="board-preview-caption">
                        <span class="caption-text"><?= $text['board_preview']['caption'] ?></span>
                    </div>
                </div>
            </div>
            
            <div class="game-detail-content">
                <div class="detail-section highlight-section">
                    <h2><?= $text['persiapan']['title'] ?></h2>
                    <ol class="elegant-list">
                        <?php foreach($text['persiapan']['items'] as $item): ?>
                        <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="detail-section goal-section">
                    <h2><?= $text['tujuan']['title'] ?></h2>
                    <div class="goal-content">
                        <p><?= $text['tujuan']['content'] ?></p>
                    </div>
                </div>

                <div class="detail-section">
                    <h2><?= $text['giliran']['title'] ?></h2>
                    <p><?= $text['giliran']['intro'] ?></p>
                    <ol>
                        <?php foreach($text['giliran']['phases'] as $phase): ?>
                        <li><strong><?= $phase['name'] ?></strong> <?= $phase['desc'] ?>
                            <?php if(isset($phase['sub_items'])): ?>
                            <ul>
                                <?php foreach($phase['sub_items'] as $sub): ?>
                                <li><?= $sub ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="detail-section">
                    <h2><?= $text['lokasi']['title'] ?></h2>
                    <ul class="location-list">
                        <?php foreach($text['lokasi']['items'] as $lokasi): ?>
                        <li><strong><?= $lokasi['name'] ?></strong> <?= $lokasi['desc'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="detail-section">
                    <h2><?= $text['kartu']['title'] ?></h2>
                    <h3><?= $text['kartu']['artefak']['subtitle'] ?></h3>
                    <p><?= $text['kartu']['artefak']['desc'] ?></p>
                    
                    <h3><?= $text['kartu']['kejadian']['subtitle'] ?></h3>
                    <p><?= $text['kartu']['kejadian']['desc'] ?></p>
                    <ul>
                        <?php foreach($text['kartu']['kejadian']['items'] as $item): ?>
                        <li><strong><?= $item['name'] ?></strong> <?= $item['desc'] ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h3><?= $text['kartu']['aksi']['subtitle'] ?></h3>
                    <p><?= $text['kartu']['aksi']['desc'] ?></p>
                    <ul>
                        <?php foreach($text['kartu']['aksi']['items'] as $item): ?>
                        <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="detail-section win-section">
                    <h2><?= $text['menang']['title'] ?></h2>
                    <div class="win-content">
                        <p><?= $text['menang']['content'] ?></p>
                    </div>
                </div>

                <div class="detail-section lose-section">
                    <h2><?= $text['kalah']['title'] ?></h2>
                    <div class="lose-content">
                        <p><?= $text['kalah']['content'] ?></p>
                    </div>
                </div>

                <div class="detail-section tips-section">
                    <h2><?= $text['tips']['title'] ?></h2>
                    <ul class="tips-list">
                        <?php foreach($text['tips']['items'] as $tip): ?>
                        <li><?= $tip ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="detail-section variant-section">
                    <h2><?= $text['variasi']['title'] ?></h2>
                    <?php foreach($text['variasi']['modes'] as $mode): ?>
                    <h3><?= $mode['name'] ?></h3>
                    <p><?= $mode['desc'] ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="back-button-container">
                    <a href="index.php#game" class="btn btn-primary btn-back">
                        <span><?= $text['button_back'] ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Tapak Arwah Nusantara. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
