<?php

function formatPrice($price) {
    return number_format($price, 0, ',', '.');
}

function formatDate($date, $format = 'd M Y') {
    $timestamp = strtotime($date);
    if ($format === 'd M Y H:i') {
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];
        $day = date('d', $timestamp);
        $month = $months[date('n', $timestamp) - 1];
        $year = date('Y', $timestamp);
        $time = date('H:i', $timestamp);
        return "{$day} {$month} {$year} {$time}";
    }
    return date($format, $timestamp);
}

function generateWhatsAppLink($productName, $price) {
    $formattedPrice = formatPrice($price);
    $message = "Halo, saya tertarik untuk membeli *{$productName}* dengan harga Rp {$formattedPrice}. Apakah masih tersedia?";
    return "https://wa.me/" . WHATSAPP_NUMBER . "?text=" . urlencode($message);
}

function sanitizeOutput($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function redirectTo($url) {
    header("Location: {$url}");
    exit;
}

function setFlashMessage($key, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'][$key] = $message;
}

function getFlashMessage($key) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
    
    return null;
}

function hasFlashMessage($key) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['flash'][$key]);
}
