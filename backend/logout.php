<?php
session_start();
include 'config/koneksi.php';
include 'config/log_activity.php';

log_activity($koneksi, 'Logout dari sistem', 'Auth');

session_destroy();

header("Location: ../frontend/login.php?error=logout");
exit;
