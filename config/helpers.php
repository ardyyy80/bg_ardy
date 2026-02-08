<?php

function uploadFile($file, $uploadDir = '../uploads/') {
    if (empty($file['name'])) {
        return '';
    }
    
    $fileName = time() . '_' . basename($file['name']);
    $targetPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return $fileName;
    }
    
    return '';
}

function deleteFile($fileName, $uploadDir = '../uploads/') {
    if (!empty($fileName) && file_exists($uploadDir . $fileName)) {
        unlink($uploadDir . $fileName);
        return true;
    }
    return false;
}

function sanitizeInput($koneksi, $data) {
    return mysqli_real_escape_string($koneksi, trim($data));
}

function handleFileUpload($newFile, $oldFile = '', $uploadDir = '../uploads/') {
    if (!empty($newFile['name'])) {
        if (!empty($oldFile)) {
            deleteFile($oldFile, $uploadDir);
        }
        return uploadFile($newFile, $uploadDir);
    }
    return $oldFile;
}
