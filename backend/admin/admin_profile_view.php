<?php
include 'cek_login.php';

$currentUserName = $_SESSION['user_name'] ?? '';

header("Location: admin_profile.php?user_name=" . urlencode($currentUserName));
exit;

