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
