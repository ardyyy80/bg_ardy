<?php
function log_activity($connection, $activityDescription, $moduleName) {
    $isUserLoggedIn = isset($_SESSION['user_name']) && isset($_SESSION['nama_admin']);
    
    if (!$isUserLoggedIn) {
        return false;
    }
    
    $userName = mysqli_real_escape_string($connection, $_SESSION['user_name']);
    $adminName = mysqli_real_escape_string($connection, $_SESSION['nama_admin']);
    $cleanActivity = mysqli_real_escape_string($connection, $activityDescription);
    $cleanModule = mysqli_real_escape_string($connection, $moduleName);
    
    $query = "INSERT INTO tb_activity_log (user_name, nama_admin, activity, module) 
              VALUES ('$userName', '$adminName', '$cleanActivity', '$cleanModule')";
    
    $result = mysqli_query($connection, $query);
    
    return $result;
}
