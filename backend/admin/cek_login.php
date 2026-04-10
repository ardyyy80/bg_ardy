<?php
session_start();

$isLoggedIn = isset($_SESSION['login']);

if (!$isLoggedIn) {
    header("Location: ../login.php");
    exit;
}
