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
