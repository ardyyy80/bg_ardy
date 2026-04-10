<?php

define('BOARD_IMAGE', 'assets/Papan Permainan Tapak Arwah Nusantara new.png');

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
            ['name' => 'Kartu Hantu', 'image' => 'assets/Card Hantu new.png'],
            ['name' => 'Kartu Manusia', 'image' => 'assets/Card Manusia new.png'],
            ['name' => 'Pion Manusia', 'image' => 'assets/pion1.jpeg'],
            ['name' => 'Pion Hantu', 'image' => 'assets/pion2.jpeg'],
            ['name' => 'Nyawa', 'image' => 'assets/token nyawa new.jpeg'],
            ['name' => 'Dadu', 'image' => 'assets/dadu new.jpg']
        ]
    ],

    'persiapan' => [
        'title' => 'Persiapan Permainan',
        'items' => [
            ['text' => 'Terdapat 2 pemain: Hantu dan Manusia.'],
            ['text' => 'Masing-masing pemain memiliki 3 nyawa.'],
            ['text' => 'Kedua pion ditempatkan di petak Start.']
        ]
    ],

    'menentukan_giliran' => [
        'title' => 'Menentukan Giliran',
        'intro' => 'Untuk menentukan pemain pertama:',
        'items' => [
            'Kedua pemain melempar dadu 1 kali.',
            'Jika hasil seri, lempar ulang.',
            'Pemain dengan angka terbesar mendapat giliran pertama.'
        ]
    ],

    'giliran' => [
        'title' => 'Alur Giliran',
        'intro' => 'Dalam setiap giliran, pemain melakukan langkah berikut:',
        'phases' => [
            ['name' => 'a. Lempar dadu', 'desc' => 'Lempar dadu untuk menentukan jumlah langkah.'],
            ['name' => 'b. Gerakkan pion', 'desc' => 'Gerakkan pion sesuai jumlah angka pada dadu.'],
            ['name' => 'c. Jalankan efek petak', 'desc' => 'Jalankan efek petak tempat pemain berhenti.'],
            ['name' => 'd. Gunakan 1 kartu (opsional)', 'desc' => 'Kartu buff dapat disimpan, sedangkan kartu debuff langsung berlaku.'],
        ],
        'outro' => 'Setelah semua langkah selesai, giliran berpindah ke pemain berikutnya.'
    ],

    'petak' => [
        'title' => 'Efek Petak di Papan',
        'items' => [
            [
                'name' => 'Hijau',
                'sub_items' => [
                    'Manusia → mengambil 1 kartu buff.',
                    'Hantu → mengambil 1 kartu debuff.',
                ]
            ],
            [
                'name' => 'Ungu',
                'sub_items' => [
                    'Hantu → mengambil 1 kartu buff.',
                    'Manusia → mengambil 1 kartu debuff.',
                ]
            ],
            [
                'name' => 'Wilayah Suci',
                'sub_items' => [
                    'Hantu → tidak dapat menyerang pada giliran berikutnya.',
                    'Manusia → menghapus 1 debuff (jika ada).',
                ]
            ],
            [
                'name' => 'Wilayah Terkutuk',
                'sub_items' => [
                    'Manusia → tidak dapat menggunakan buff pada giliran berikutnya.',
                    'Hantu → menghapus 1 debuff (jika ada).',
                ]
            ],
            [
                'name' => 'Putih',
                'desc' => 'Jalankan efek petak. Jika tidak ada keterangan, petak bersifat netral.'
            ],
            [
                'name' => 'Perangkap',
                'desc' => 'Pemain melewatkan 1 giliran berikutnya.'
            ],
            [
                'name' => 'Serangan',
                'desc' => 'Terjadi saat kedua pemain berada di petak yang sama.'
            ],
        ]
    ],

    'serangan' => [
        'title' => 'Interaksi & Efek Zona',
        'intro' => 'Jika Hantu dan Manusia berada di petak yang sama, maka terjadi serangan. Ikuti aturan serangan sesuai zona.',
        'zones' => [
            [
                'name' => 'Zona Siang',
                'items' => [
                    'Hantu melempar dadu untuk menyerang.',
                    'Jika hasil 4, Manusia kehilangan 1 nyawa.',
                    'Jika Hantu gagal, Manusia melempar dadu untuk melawan.',
                    'Jika hasil 3–4, Hantu kehilangan 1 nyawa.',
                ]
            ],
            [
                'name' => 'Zona Malam',
                'items' => [
                    'Hantu langsung menyerang.',
                    'Manusia melempar dadu untuk bertahan.',
                    'Jika hasil 1–2, Manusia kehilangan 1 nyawa.',
                    'Jika hasil 3, Manusia berhasil bertahan.',
                    'Jika hasil 4, Manusia berhasil bertahan dan Hantu kehilangan 1 nyawa.',
                ]
            ],
        ],
        'outro' => 'Serangan hanya terjadi ketika kedua pemain berada di petak yang sama.'
    ],

    'kondisi' => [
        'title' => 'Kondisi Menang',
        'roles' => [
            [
                'name' => 'Tujuan Permainan',
                'items' => [
                    'Kurangi nyawa lawan hingga habis untuk memenangkan permainan.',
                ]
            ],
            [
                'name' => 'Manusia Menang Jika',
                'items' => [
                    'Seluruh nyawa Hantu habis.',
                ]
            ],
            [
                'name' => 'Hantu Menang Jika',
                'items' => [
                    'Seluruh nyawa Manusia habis.',
                ]
            ],
        ]
    ],

    'akhir' => [
        'title' => 'Akhir Permainan',
        'content' => 'Permainan berakhir segera setelah salah satu pemain memenuhi kondisi menang.'
    ],

    'button_back' => 'Kembali ke Home'
];
