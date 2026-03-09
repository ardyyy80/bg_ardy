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
