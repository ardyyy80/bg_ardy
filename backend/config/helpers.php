<?php

function sanitizeInput($connection, $input) {
    return mysqli_real_escape_string($connection, htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8'));
}

function handleFileUpload($fileData, $oldFileName = '') {
    if (empty($fileData) || !isset($fileData['tmp_name']) || $fileData['error'] !== UPLOAD_ERR_OK) {
        return $oldFileName;
    }

    $uploadDir = __DIR__ . '/../uploads/';
    $originalName = basename($fileData['name']);
    $newFileName = time() . '_' . $originalName;
    $destination = $uploadDir . $newFileName;

    if (move_uploaded_file($fileData['tmp_name'], $destination)) {
        if (!empty($oldFileName)) {
            deleteFile($oldFileName);
        }
        return $newFileName;
    }

    return $oldFileName;
}

function deleteFile($fileName) {
    if (empty($fileName)) {
        return false;
    }
    $filePath = __DIR__ . '/../uploads/' . $fileName;
    if (file_exists($filePath)) {
        return unlink($filePath);
    }
    return false;
}

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
