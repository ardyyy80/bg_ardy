<?php

function uploadFile($file, $uploadDirectory = '../uploads/') {
    if (empty($file['name'])) {
        return '';
    }
    
    $uniqueFileName = time() . '_' . basename($file['name']);
    $fullPath = $uploadDirectory . $uniqueFileName;
    
    $isUploaded = move_uploaded_file($file['tmp_name'], $fullPath);
    
    if ($isUploaded) {
        return $uniqueFileName;
    }
    
    return '';
}

function deleteFile($fileName, $uploadDirectory = '../uploads/') {
    $filePath = $uploadDirectory . $fileName;
    $fileExists = !empty($fileName) && file_exists($filePath);
    
    if ($fileExists) {
        unlink($filePath);
        return true;
    }
    
    return false;
}

function sanitizeInput($connection, $input) {
    $cleanInput = trim($input);
    return mysqli_real_escape_string($connection, $cleanInput);
}

function handleFileUpload($newFile, $oldFile = '', $uploadDirectory = '../uploads/') {
    $hasNewFile = !empty($newFile['name']);
    
    if ($hasNewFile) {
        if (!empty($oldFile)) {
            deleteFile($oldFile, $uploadDirectory);
        }
        return uploadFile($newFile, $uploadDirectory);
    }
    
    return $oldFile;
}
