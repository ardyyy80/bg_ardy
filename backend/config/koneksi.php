<?php
$database_host = "localhost";
$database_user = "root";
$database_password = "";
$database_name = "db_bgardy";

$koneksi = mysqli_connect($database_host, $database_user, $database_password, $database_name);

if (!$koneksi) {
    die("Database connection failed: " . mysqli_connect_error());
}
