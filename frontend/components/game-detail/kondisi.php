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
