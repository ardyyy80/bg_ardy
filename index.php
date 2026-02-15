<?php
include 'config/koneksi.php';

$merch_data = mysqli_query($koneksi, "SELECT * FROM tb_merch ORDER BY id_merch DESC");
$komen_data = mysqli_query($koneksi, "SELECT * FROM tb_komen ORDER BY id_komen DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapak Arwah Nusantara - Board Game</title>
    <link rel="stylesheet" href="frontend/css/style.css">
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container nav-container">
            <div class="logo">
                <img src="assets/logonavbar.png" alt="Logo Tapak Arwah Nusantara">
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#game">Game</a></li>
                <li><a href="#merchandise">Merchandise</a></li>
                <li><a href="#comment">Comment</a></li>
            </ul>
        </div>
    </nav>

    <section id="home" class="hero-section">
        <div class="container hero-content">
            <img src="assets/logoutama.png" alt="Logo Tapak Arwah Nusantara" class="hero-logo">
            <h1 class="hero-title">Tapak Arwah Nusantara</h1>
            <p class="hero-description">
                Langkahkan takdirmu, Hadapi arwah.<br>
                Rebut takhta Nusantara.
            </p>
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="container">
            <h2 class="section-title">About</h2>
            <div class="profile-card">
                <div class="profile-image">
                    <img src="assets/WhatsApp Image 2026-02-07 at 05.31.02.jpeg" alt="M Ardy Irwansyah">
                </div>
                <div class="profile-info">
                    <h3>M Ardy Irwansyah</h3>
                    <div class="profile-quote">
                        <div class="quote-header">
                            <svg class="quote-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/>
                            </svg>
                            <strong class="quote-title">Singkat Cerita</strong>
                        </div>
                        <p class="quote-text">Pelajar yang ingin Belajar</p>
            </div>
        </div>
    </section>

    <section id="game" class="game-section">
        <div class="container">
            <h2 class="section-title">Game Preview</h2>
            <div class="game-card">
                <div class="game-preview">
                    <img src="assets/Arena%20Tapak%20Arwah%20Nusantara.png" alt="Arena Tapak Arwah Nusantara" class="board-image">
                </div>
                <div class="game-info">
                    <h3>Tapak Arwah Nusantara Board Game</h3>
                    <p>
                        Board game strategi untuk 2-4 pemain yang membawa Anda menjelajahi dunia mistis Nusantara. 
                        Setiap pemain berperan sebagai pemburu arwah yang harus mengumpulkan artefak mistis sambil 
                        menghindari kutukan dan makhluk supernatural.
                    </p>
                    <ul class="game-features">
                        <li>🎲 2-4 Pemain</li>
                        <li>⏱️ Durasi: 45-90 menit</li>
                        <li>👻 Tema: Supernatural Indonesia</li>
                        <li>🎯 Strategi & Petualangan</li>
                    </ul>
                    <a href="detail_game.php" class="btn btn-primary">Cara Bermain</a>
                </div>
            </div>
        </div>
    </section>

    <section id="merchandise" class="merchandise-section">
        <div class="container">
            <h2 class="section-title">Merchandise</h2>
            <div class="merch-grid">
                <?php while ($m = mysqli_fetch_assoc($merch_data)): ?>
                <div class="merch-card">
                    <?php if ($m['foto_merch']): ?>
                        <img src="uploads/<?= htmlspecialchars($m['foto_merch']) ?>" alt="<?= htmlspecialchars($m['judul_merch']) ?>" class="merch-image">
                    <?php else: ?>
                        <div class="merch-no-image">No Image</div>
                    <?php endif; ?>
                    <div class="merch-body">
                        <h3 class="merch-title"><?= htmlspecialchars($m['judul_merch']) ?></h3>
                        <p class="merch-price">Rp <?= number_format($m['harga_merch'], 0, ',', '.') ?></p>
                        <p class="merch-stock">Stok: <?= number_format($m['stock_merch'], 0, ',', '.') ?></p>
                        <?php if ($m['detail_merch']): ?>
                            <p class="merch-detail"><?= nl2br(htmlspecialchars($m['detail_merch'])) ?></p>
                        <?php endif; ?>
                        <?php
                        $wa_number = "6282131266756";
                        $message = "Halo, saya tertarik untuk membeli *" . $m['judul_merch'] . "* dengan harga Rp " . number_format($m['harga_merch'], 0, ',', '.') . ". Apakah masih tersedia?";
                        $wa_link = "https://wa.me/" . $wa_number . "?text=" . urlencode($message);
                        ?>
                        <a href="<?= $wa_link ?>" target="_blank" class="btn btn-success">Beli Sekarang</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <section id="comment" class="comment-section">
        <div class="container">
            <h2 class="section-title">Comment</h2>
            <div class="comment-wrapper">
                <form action="submit_comment.php" method="POST" class="comment-form">
                    <div class="form-group">
                        <label for="nama_penulis">Nama</label>
                        <input type="text" id="nama_penulis" name="nama_penulis" required>
                    </div>
                    <div class="form-group">
                        <label for="detail_komen">Komentar</label>
                        <textarea id="detail_komen" name="detail_komen" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                </form>

                <div class="comments-list">
                    <h3>Komentar Terbaru</h3>
                    <?php while ($k = mysqli_fetch_assoc($komen_data)): ?>
                    <div class="comment-item">
                        <div class="comment-header">
                            <strong><?= htmlspecialchars($k['nama_penulis']) ?></strong>
                            <span class="comment-date"><?= date('d M Y', strtotime($k['tanggal_komen'])) ?></span>
                        </div>
                        <p class="comment-text"><?= nl2br(htmlspecialchars($k['detail_komen'])) ?></p>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Tapak Arwah Nusantara. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="frontend/js/script.js"></script>
</body>
</html>
