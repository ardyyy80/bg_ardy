<?php

define('BOARD_IMAGE', 'assets/Arena Tapak Arwah Nusantara.png');

return [
    'page_title' => 'Cara Bermain Tapak Arwah Nusantara',
    
    'board_preview' => [
        'image' => BOARD_IMAGE,
        'caption' => 'Papan Permainan'
    ],
    
    'komponen' => [
        'title' => 'Komponen Permainan',
        'items' => [
            ['name' => 'Papan Permainan', 'image' => BOARD_IMAGE],
            ['name' => 'Kartu Buff', 'image' => 'assets/cardbuff.png'],
            ['name' => 'Kartu Debuff', 'image' => 'assets/carddebuff.png'],
            ['name' => 'Pion Merah', 'image' => 'assets/pion1.jpeg'],
            ['name' => 'Pion Biru', 'image' => 'assets/pion2.jpeg'],
            ['name' => 'Token Nyawa', 'image' => 'assets/logoutama.png'],
            ['name' => 'Dadu', 'image' => 'assets/dadu.png']
        ]
    ],
    
    'persiapan' => [
        'title' => 'Persiapan Permainan',
        'items' => [
            'Letakkan papan permainan di tengah meja',
            'Setiap pemain memilih karakter pemburu arwah dan mengambil pawn sesuai warna',
            'Kocok deck kartu artefak dan letakkan menghadap ke bawah',
            'Kocok deck kartu kejadian dan letakkan di tempatnya',
            'Setiap pemain mendapat 3 kartu awal dan nyawa sebanyak 5 poin',
            'Tentukan pemain pertama dengan melempar dadu tertinggi'
        ]
    ],
    
    'tujuan' => [
        'title' => 'Tujuan Permainan',
        'content' => 'Menjadi pemain pertama yang mengumpulkan 5 artefak mistis dari berbagai daerah di Nusantara sambil mempertahankan nyawa Anda dari serangan makhluk supernatural.'
    ],
    
    'giliran' => [
        'title' => 'Giliran Pemain',
        'intro' => 'Setiap giliran pemain terdiri dari fase-fase berikut:',
        'phases' => [
            ['name' => 'Fase Pergerakan:', 'desc' => 'Lempar dadu dan gerakkan pawn sesuai angka yang keluar'],
            [
                'name' => 'Fase Aksi:', 
                'desc' => 'Lakukan salah satu aksi berikut:',
                'sub_items' => [
                    'Ambil kartu artefak jika berada di lokasi artefak',
                    'Gunakan kartu khusus dari tangan Anda',
                    'Beristirahat untuk memulihkan 1 poin nyawa'
                ]
            ],
            ['name' => 'Fase Kejadian:', 'desc' => 'Ambil 1 kartu kejadian dan ikuti instruksinya'],
            ['name' => 'Fase Akhir:', 'desc' => 'Giliran berakhir, pemain berikutnya memulai giliran']
        ]
    ],
    
    'lokasi' => [
        'title' => 'Jenis Lokasi di Papan',
        'items' => [
            ['name' => 'Candi:', 'desc' => 'Lokasi artefak Jawa'],
            ['name' => 'Hutan:', 'desc' => 'Lokasi artefak Kalimantan'],
            ['name' => 'Gunung:', 'desc' => 'Lokasi artefak Sumatra'],
            ['name' => 'Pulau:', 'desc' => 'Lokasi artefak Sulawesi'],
            ['name' => 'Rumah Adat:', 'desc' => 'Lokasi pemulihan nyawa'],
            ['name' => 'Zona Gelap:', 'desc' => 'Area berbahaya, ambil 2 kartu kejadian']
        ]
    ],
    
    'kartu' => [
        'title' => 'Kartu dalam Permainan',
        'artefak' => [
            'subtitle' => 'Kartu Artefak',
            'desc' => 'Kartu yang harus dikumpulkan untuk memenangkan permainan. Setiap daerah memiliki artefak unik dengan kekuatan khusus.'
        ],
        'kejadian' => [
            'subtitle' => 'Kartu Kejadian',
            'desc' => 'Kartu yang berisi berbagai peristiwa supernatural:',
            'items' => [
                ['name' => 'Serangan Hantu:', 'desc' => 'Kurangi nyawa pemain'],
                ['name' => 'Berkat Leluhur:', 'desc' => 'Tambah nyawa atau kartu bonus'],
                ['name' => 'Kutukan:', 'desc' => 'Lewati giliran atau kehilangan artefak'],
                ['name' => 'Pertolongan:', 'desc' => 'Dapatkan keuntungan khusus']
            ]
        ],
        'aksi' => [
            'subtitle' => 'Kartu Aksi Khusus',
            'desc' => 'Kartu yang dapat digunakan kapan saja untuk melindungi diri atau menyerang lawan:',
            'items' => [
                'Jimat Pelindung - Blokir 1 serangan',
                'Mantra Pengusir - Hindari kartu kejadian negatif',
                'Sesaji - Pulihkan 2 poin nyawa',
                'Santet - Kurangi 1 nyawa lawan'
            ]
        ]
    ],
    
    'menang' => [
        'title' => 'Kondisi Menang',
        'content' => 'Pemain yang pertama kali mengumpulkan 5 artefak dari minimal 3 daerah berbeda memenangkan permainan.'
    ],
    
    'kalah' => [
        'title' => 'Kondisi Kalah',
        'content' => 'Jika nyawa pemain habis (0 poin), pemain tersebut gugur dan tidak dapat melanjutkan permainan.'
    ],
    
    'tips' => [
        'title' => 'Tips Strategi',
        'items' => [
            'Kumpulkan kartu aksi khusus untuk proteksi',
            'Hindari zona gelap jika nyawa sedang rendah',
            'Manfaatkan rumah adat untuk memulihkan nyawa sebelum masuk area berbahaya',
            'Perhatikan artefak lawan dan gunakan kartu santet di saat yang tepat',
            'Seimbangkan antara mengumpulkan artefak dan menjaga nyawa'
        ]
    ],
    
    'variasi' => [
        'title' => 'Variasi Permainan',
        'modes' => [
            [
                'name' => 'Mode Kooperatif',
                'desc' => 'Semua pemain bekerja sama melawan deck kejadian untuk mengumpulkan total 15 artefak sebelum waktu habis.'
            ],
            [
                'name' => 'Mode Expert',
                'desc' => 'Tambahkan kartu bos arwah yang muncul setiap 5 giliran. Pemain harus mengalahkan bos bersama-sama atau kehilangan artefak.'
            ]
        ]
    ],
    
    'button_back' => 'Kembali ke Home'
];
