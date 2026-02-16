<?php
session_start();

$isLoggedIn = isset($_SESSION['login']);

if (!$isLoggedIn) {
    header("Location: ../../frontend/login.php");
    exit;
}
