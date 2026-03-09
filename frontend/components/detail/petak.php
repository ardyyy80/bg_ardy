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
