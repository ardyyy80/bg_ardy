<?php
$navPrefix = $navPrefix ?? '';
$activeSection = $activeSection ?? '';
?>
<nav class="navbar" id="navbar">
    <div class="container nav-container">
        <div class="logo">
            <img src="assets/logonavbar.png" alt="Logo Tapak Arwah Nusantara">
        </div>
        <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <ul class="nav-menu" id="navMenu">
            <li><a href="<?= $navPrefix ?>#home"<?= $activeSection === 'home' ? ' class="active"' : '' ?>>Home</a></li>
            <li><a href="<?= $navPrefix ?>#about"<?= $activeSection === 'about' ? ' class="active"' : '' ?>>About</a></li>
            <li><a href="<?= $navPrefix ?>#game"<?= $activeSection === 'game' ? ' class="active"' : '' ?>>Game</a></li>
            <li><a href="<?= $navPrefix ?>#merchandise"<?= $activeSection === 'merchandise' ? ' class="active"' : '' ?>>Merchandise</a></li>
            <li><a href="<?= $navPrefix ?>#comment"<?= $activeSection === 'comment' ? ' class="active"' : '' ?>>Comment</a></li>
        </ul>
    </div>
</nav>
