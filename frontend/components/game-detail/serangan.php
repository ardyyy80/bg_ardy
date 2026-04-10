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
