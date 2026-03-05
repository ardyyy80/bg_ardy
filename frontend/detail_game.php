<?php
$text = require_once 'game_text.php';

if (!is_array($text)) {
    die('Error loading game content');
}
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
                <li><a href="index.php#game" class="active">Game</a></li>
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
                <div class="detail-section">
                    <h2><?= $text['komponen']['title'] ?></h2>
                    <div class="components-grid">
                        <?php foreach($text['komponen']['items'] as $komponen): ?>
                        <div class="component-card">
                            <div class="component-image">
                                <img src="<?= $komponen['image'] ?>" alt="<?= $komponen['name'] ?>">
                            </div>
                            <h3><?= $komponen['name'] ?></h3>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="detail-section highlight-section">
                    <h2><?= $text['persiapan']['title'] ?></h2>
                    <ol class="elegant-list">
                        <?php foreach($text['persiapan']['items'] as $item): ?>
                        <li><?= $item['text'] ?>
                            <?php if(isset($item['sub_items'])): ?>
                            <ul>
                                <?php foreach($item['sub_items'] as $sub): ?>
                                <li><?= $sub ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="detail-section">
                    <h2><?= $text['menentukan_giliran']['title'] ?></h2>
                    <p><?= $text['menentukan_giliran']['intro'] ?></p>
                    <ol>
                        <?php foreach($text['menentukan_giliran']['items'] as $item): ?>
                        <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="detail-section">
                    <h2><?= $text['giliran']['title'] ?></h2>
                    <p><?= $text['giliran']['intro'] ?></p>
                    <ol>
                        <?php foreach($text['giliran']['phases'] as $phase): ?>
                        <li><strong><?= $phase['name'] ?></strong> <?= $phase['desc'] ?></li>
                        <?php endforeach; ?>
                    </ol>
                    <p><?= $text['giliran']['outro'] ?></p>
                </div>

                <div class="detail-section">
                    <h2><?= $text['petak']['title'] ?></h2>
                    <ul class="location-list">
                        <?php foreach($text['petak']['items'] as $petak): ?>
                        <li>
                            <strong><?= $petak['name'] ?></strong>
                            <?php if(isset($petak['desc'])): ?>
                            — <?= $petak['desc'] ?>
                            <?php endif; ?>
                            <?php if(isset($petak['sub_items'])): ?>
                            <ul>
                                <?php foreach($petak['sub_items'] as $sub): ?>
                                <li><?= $sub ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="detail-section">
                    <h2><?= $text['serangan']['title'] ?></h2>
                    <p><?= $text['serangan']['intro'] ?></p>
                    <?php foreach($text['serangan']['zones'] as $zone): ?>
                    <h3><?= $zone['name'] ?></h3>
                    <ul>
                        <?php foreach($zone['items'] as $item): ?>
                        <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                    <p><?= $text['serangan']['outro'] ?></p>
                </div>

                <div class="detail-section win-section">
                    <h2><?= $text['kondisi']['title'] ?></h2>
                    <?php foreach($text['kondisi']['roles'] as $role): ?>
                    <h3><?= $role['name'] ?></h3>
                    <ul>
                        <?php foreach($role['items'] as $item): ?>
                        <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                </div>

                <div class="detail-section">
                    <h2><?= $text['akhir']['title'] ?></h2>
                    <p><?= $text['akhir']['content'] ?></p>
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
