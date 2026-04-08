<?php
include 'cek_login.php';

$currentUserName = $_SESSION['user_name'] ?? '';

header("Location: admin_input.php?user_name=" . urlencode($currentUserName));
exit;
