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
    <div id="pageLoader" class="page-loader">
        <div class="loader-spinner"></div>
    </div>
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
            </div>
        </div>
    </section>

    <section id="game" class="game-section">
        <div class="container">
            <h2 class="section-title">Game</h2>
            <div class="game-showcase">
                <div class="game-card">
                    <div class="game-preview">
                        <div class="image-frame">
                            <img src="assets/Arena Tapak Arwah Nusantara.png" alt="Arena Tapak Arwah Nusantara" class="board-image">
                            <div class="image-overlay">
                                <span class="overlay-badge">Papan Permainan</span>
                            </div>
                        </div>
                    </div>
                    <div class="game-info">
                        <div class="game-header">
                            <h3 class="game-title">Tapak Arwah Nusantara</h3>
                            <span class="game-subtitle">Board Game Premium</span>
                        </div>
                        <p class="game-description">
                            Board game strategi untuk 2-4 pemain yang membawa Anda menjelajahi dunia mistis Nusantara. 
                            Setiap pemain berperan sebagai pemburu arwah yang harus mengumpulkan artefak mistis sambil 
                            menghindari kutukan dan makhluk supernatural.
                        </p>
                        <div class="game-specs">
                            <div class="spec-item">
                                <div class="spec-content">
                                    <span class="spec-label">Pemain</span>
                                    <span class="spec-value">2-4 Orang</span>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-content">
                                    <span class="spec-label">Durasi</span>
                                    <span class="spec-value">45-90 Menit</span>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-content">
                                    <span class="spec-label">Tema</span>
                                    <span class="spec-value">Supernatural Indonesia</span>
                                </div>
                            </div>
                            <div class="spec-item">
                                <div class="spec-content">
                                    <span class="spec-label">Genre</span>
                                    <span class="spec-value">Strategi & Petualangan</span>
                                </div>
                            </div>
                        </div>
                        <a href="detail_game.php" class="btn btn-primary">
                            <span>Cara Bermain</span>
                            <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="merchandise" class="merchandise-section">
        <div class="container">
            <h2 class="section-title">Merchandise</h2>
            <div class="merch-grid">
                <?php while ($merchandise = mysqli_fetch_assoc($merchandiseList)): 
                    $hasPhoto = $merchandiseService->hasPhoto($merchandise);
                    $hasDescription = $merchandiseService->hasDescription($merchandise);
                    $whatsappLink = generateWhatsAppLink($merchandise['judul_merch'], $merchandise['harga_merch']);
                ?>
                <div class="merch-card">
                    <div class="merch-header">
                        <h3 class="merch-title"><?= sanitizeOutput($merchandise['judul_merch']) ?></h3>
                    </div>
                    <div class="merch-image-wrapper">
                        <?php if ($hasPhoto): ?>
                            <img src="../backend/uploads/<?= sanitizeOutput($merchandise['foto_merch']) ?>" alt="<?= sanitizeOutput($merchandise['judul_merch']) ?>" class="merch-image">
                        <?php else: ?>
                            <div class="merch-no-image">No Image</div>
                        <?php endif; ?>
                    </div>
                    <div class="merch-body">
                        <?php if ($hasDescription): ?>
                            <p class="merch-desc"><?= sanitizeOutput($merchandise['detail_merch']) ?></p>
                        <?php endif; ?>
                        <p class="merch-price">Rp <?= formatPrice($merchandise['harga_merch']) ?></p>
                        <p class="merch-stock">Stok: <?= formatPrice($merchandise['stock_merch']) ?></p>
                        <a href="<?= $whatsappLink ?>" target="_blank" class="btn btn-success">
                            <svg class="wa-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            Beli Sekarang
                        </a>
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
                <?php if ($commentError): ?>
                    <div class="alert alert-danger" style="margin-bottom: 1rem; padding: 1.2rem 1.5rem; background: rgba(139, 69, 69, 0.15); color: #6A3535; border-radius: 12px; border: 2px solid #8B4545;">
                        <?= sanitizeOutput($commentError) ?>
                    </div>
                <?php endif; ?>
                
                <div id="successModal" class="success-modal" <?= $commentSuccess ? 'style="display: flex;"' : '' ?>>
                    <div class="success-modal-content">
                        <div class="success-checkmark">
                            <svg viewBox="0 0 52 52">
                                <circle cx="26" cy="26" r="25" fill="none"/>
                                <path fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                        <h2 class="success-title">Done</h2>
                        <button class="success-ok-btn" onclick="closeSuccessModal()">OK</button>
                    </div>
                </div>
                
                <form action="../backend/submit_comment.php" method="POST" class="comment-form">
                    <div class="form-group">
                        <label for="nama_penulis">Nama</label>
                        <input type="text" id="nama_penulis" name="nama_penulis" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group textarea-group">
                        <label for="detail_komen">Komentar</label>
                        <textarea id="detail_komen" name="detail_komen" rows="5" placeholder="Bagaimana pendapat Anda tentang board game ini?" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </div>
                </form>

                <div class="comments-list">
                    <h3>Komentar Terbaru</h3>
                    <div class="comments-container">
                        <?php while ($comment = mysqli_fetch_assoc($recentComments)): ?>
                        <div class="comment-item">
                            <div class="comment-header">
                                <strong><?= sanitizeOutput($comment['nama_penulis']) ?></strong>
                                <span class="comment-date"><?= formatDate($comment['tanggal_komen'], 'd M Y H:i') ?></span>
                            </div>
                            <p class="comment-text"><?= nl2br(sanitizeOutput($comment['detail_komen'])) ?></p>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Tapak Arwah Nusantara. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        function closeSuccessModal() {
            document.getElementById('successModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('successModal');
            if (event.target == modal) {
                closeSuccessModal();
            }
        }
    </script>
    <script src="js/main.js"></script>
</body>
</html>
