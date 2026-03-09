<div class="detail-section">
    <h2><?= $text['menentukan_giliran']['title'] ?></h2>
    <p><?= $text['menentukan_giliran']['intro'] ?></p>
    <ol>
        <?php foreach($text['menentukan_giliran']['items'] as $item): ?>
        <li><?= $item ?></li>
        <?php endforeach; ?>
    </ol>
</div>
