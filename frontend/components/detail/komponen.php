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
