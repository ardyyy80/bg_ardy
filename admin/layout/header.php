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

        .sidebar-header {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h5 {
            margin: 0;
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

        .header-top {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-top h3 {
            margin: 0;
        }

        .content {
            background: #f4f6f9;
        }

    </style>
</head>
<body>
