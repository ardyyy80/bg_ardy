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
            ['text' => 'Letakkan papan permainan di tengah meja.'],
            ['text' => 'Permainan dimainkan oleh 2 pemain, yaitu Hantu dan Manusia.'],
            [
                'text' => 'Setiap pemain:',
                'sub_items' => [
                    'Memilih pion sesuai perannya.',
                    'Memulai permainan dari petak Start.',
                    'Memiliki 3 poin nyawa.',
                ]
            ],
            ['text' => 'Siapkan deck kartu Buff dan Debuff, lalu kocok dan letakkan menghadap ke bawah di tempat yang telah ditentukan pada papan permainan.'],
        ]
    ],

    'menentukan_giliran' => [
        'title' => 'Menentukan Giliran',
        'intro' => 'Untuk menentukan pemain pertama:',
        'items' => [
            'Kedua pemain melempar dadu sebanyak 2 kali.',
            'Jumlahkan hasil kedua lemparan.',
            'Pemain dengan total angka terbesar mendapat giliran pertama.',
            'Jika hasilnya sama, kedua pemain mengulang lemparan hingga ada pemenang.',
        ]
    ],

    'giliran' => [
        'title' => 'Giliran Pemain',
        'intro' => 'Dalam 1 giliran, pemain melakukan 3 langkah berikut:',
        'phases' => [
            ['name' => 'Fase Lempar Dadu:', 'desc' => 'Lempar dadu untuk menentukan jumlah langkah.'],
            ['name' => 'Fase Pergerakan:', 'desc' => 'Gerakkan pion sesuai angka yang muncul pada dadu.'],
            ['name' => 'Fase Efek Petak:', 'desc' => 'Jalankan efek dari petak tempat pion berhenti.'],
        ],
        'outro' => 'Setelah semua langkah selesai, giliran berpindah ke pemain berikutnya.'
    ],

    'petak' => [
        'title' => 'Jenis Petak di Papan',
        'items' => [
            [
                'name' => 'Petak Hijau',
                'sub_items' => [
                    'Manusia → mengambil kartu Buff.',
                    'Hantu → mengambil kartu Debuff.',
                ]
            ],
            [
                'name' => 'Petak Ungu',
                'sub_items' => [
                    'Hantu → mengambil kartu Buff.',
                    'Manusia → mengambil kartu Debuff.',
                ]
            ],
            [
                'name' => 'Petak Putih',
                'desc' => 'Tidak memiliki efek khusus.'
            ],
            [
                'name' => 'Wilayah Suci',
                'sub_items' => [
                    'Hantu tidak dapat melakukan serangan pada giliran berikutnya.',
                    'Jika Manusia berada di petak ini, ia dapat menghapus 1 kartu Debuff yang dimiliki (jika ada).',
                ]
            ],
            [
                'name' => 'Wilayah Terkutuk',
                'sub_items' => [
                    'Manusia tidak dapat menggunakan Buff pada giliran berikutnya.',
                    'Jika Hantu berada di petak ini, ia dapat menghapus 1 kartu Debuff yang dimiliki (jika ada).',
                ]
            ],
            [
                'name' => 'Perangkap',
                'desc' => 'Pemain yang berhenti di petak ini harus melewatkan 1 giliran.'
            ],
        ]
    ],

    'serangan' => [
        'title' => 'Mekanisme Serangan',
        'intro' => 'Serangan terjadi jika Hantu dan Manusia berada di petak yang sama.',
        'zones' => [
            [
                'name' => 'Zona Siang',
                'items' => [
                    'Hantu harus melempar dadu untuk menyerang.',
                    'Serangan berhasil hanya jika mendapat angka 4.',
                    'Manusia memiliki peluang bertahan lebih besar.',
                ]
            ],
            [
                'name' => 'Zona Malam',
                'items' => [
                    'Hantu dapat langsung menyerang tanpa melempar dadu.',
                    'Manusia lebih sulit bertahan dari serangan.',
                ]
            ],
        ],
        'outro' => 'Jika serangan berhasil, nyawa lawan berkurang 1 poin.'
    ],

    'kondisi' => [
        'title' => 'Kondisi Menang & Kalah',
        'roles' => [
            [
                'name' => 'Manusia Menang Jika',
                'items' => [
                    'Berhasil mencapai petak Finish dengan minimal 1 nyawa, atau',
                    'Semua nyawa Hantu habis.',
                ]
            ],
            [
                'name' => 'Manusia Kalah Jika',
                'items' => [
                    'Semua nyawanya habis, atau',
                    'Hantu mencapai Finish lebih dahulu.',
                ]
            ],
            [
                'name' => 'Hantu Menang Jika',
                'items' => [
                    'Semua nyawa Manusia habis, atau',
                    'Berhasil mencapai Finish lebih dahulu.',
                ]
            ],
            [
                'name' => 'Hantu Kalah Jika',
                'items' => [
                    'Semua nyawanya habis, atau',
                    'Manusia mencapai Finish dengan minimal 1 nyawa.',
                ]
            ],
        ]
    ],

    'akhir' => [
        'title' => 'Akhir Permainan',
        'content' => 'Permainan langsung berakhir ketika salah satu kondisi menang atau kalah terpenuhi.'
    ],

    'button_back' => 'Kembali ke Home'
];
