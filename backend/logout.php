<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/helpers.php';
require_once 'config/log_activity.php';

log_activity($koneksi, 'Logout dari sistem', 'Auth');

session_destroy();
session_start();

setFlashMessage('success', 'Anda telah logout!');
redirectTo('../frontend/login.php');
