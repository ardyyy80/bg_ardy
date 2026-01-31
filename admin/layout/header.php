<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f4f6f9;   /* iki background utama e */
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #212529;    /* iki background side bar */
        }
        .sidebar a {
            color: #ddd;        /*ganti warna teks menu e sidebar*/
            text-decoration: none;
            display: block;
            padding: 12px 16px;
        }
        .sidebar a:hover {          
            background: #40343b;   /* menu ganti warna lak ape di sentuh mouse */
            color: #fff;
        }

        .sidebar a.active {
            background: #495057;   /* hover e sek murup terus,lak ndek halaman seng di leboni */
            color: #fff;
            font-weight: bold;
        }

    </style>
</head>
<body>
