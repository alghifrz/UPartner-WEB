<?php

namespace App\Models;

class Tentang{
    public static function getData() {
        $proyek = Proyek::count();
        $dosen = Dosen::count();
        $mahasiswa = User::count();
        return [
            'judul' => 'Tentang Kami',
            'deskripsi' => 'Kami adalah mahasiswa Ilmu Komputer Universitas Pertamina yang bersemangat belajar dan berinovasi untuk menciptakan solusi teknologi yang bermanfaat bagi banyak orang.',
            'foto' => '/img/tentangkami.png',
            'insight' => [
                ['value' => $proyek, 'label' => 'Total Proyek'],
                ['value' => $dosen, 'label' => 'Total Dosen'],
                ['value' => $mahasiswa, 'label' => 'Total Mahasiswa'],
            ],
            'visi' => [
                'judul' => 'Visi Kami',
                'detail' => 'Menjadi platform kolaborasi terdepan yang menghubungkan mahasiswa dan dosen untuk menciptakan solusi inovatif melalui proyek yang terorganisir, efektif, dan bermanfaat dalam dunia pendidikan.'
            ],
            'misi' => [
                'judul' => 'Misi Kami',
                'detail' => [
                    [
                    // 'judul' => 'Misi 1',
                    'detail' => '1. Memfasilitasi mahasiswa dan dosen dalam menemukan dan berkontribusi pada proyek sesuai minat dan keahlian.'
                    ],
                    [
                    // 'judul' => 'Misi 2',
                    'detail' => '2. Membangun hubungan kolaborasi yang produktif antara mahasiswa dan dosen melalui teknologi yang inovatif.'
                    ],
                    [
                    // 'judul' => 'Misi 3',
                    'detail' => '3. Menyediakan alat yang mendukung pengelolaan proyek secara terstruktur, efisien, dan mudah diakses.'
                    ],
                    [
                    // 'judul' => 'Misi 4',
                    'detail' => '4. Mendorong pengembangan keterampilan praktis mahasiswa dan memaksimalkan dampak dari proyek akademik.'
                    ]
                ]
            ],
            'tim' => [
                'judul' => 'Tim Kami',
                'detail' => [
                    [
                        'nama' => 'Fauzan Azhima',
                        'nim' => '105222003',
                        'foto' => '/img/fauzan.png',
                        'email' => 'fauzannazhimaa@gmail.com',
                        'sosmed' => [
                            'https://github.com/Fauzan-Azh',
                            '',
                            'https://www.instagram.com/fauzanazhima._/',
                            'https://www.linkedin.com/in/fauzannazhimaa'
                        ]
                    ],
                    [
                        'nama' => 'Alghifari Rasyid Zola',
                        'nim' => '105222006',
                        'foto' => '/img/alghif.png',
                        'email' => 'alghifarirasyidzola@gmail.com',
                        'sosmed' => [
                            'https://github.com/alghifrz',
                            'https://www.facebook.com/alghifari.rasyidzola',
                            'https://www.instagram.com/agifrz/',
                            'https://www.linkedin.com/in/alghifarirasyidzola/'
                        ]
                    ],
                    [
                        'nama' => 'Faris Farhan',
                        'nim' => '105222013',
                        'foto' => '/img/faris.png',
                        'email' => 'farisfarhans2004@gmail.com',
                        'sosmed' => [
                            'https://github.com/FarisFarhan17',
                            '',
                            'https://www.instagram.com/far1s.frhn/',
                            'https://www.linkedin.com/in/faris-farhan-54b9b1287/'
                        ]
                    ],
                    [
                        'nama' => 'Pebry Ajeng Cahyani',
                        'nim' => '105222031',
                        'foto' => '/img/pebry.png',
                        'email' => 'pebryac12@gmail.com',
                        'sosmed' => [
                            'https://github.com/PebryAjeng',
                            '',
                            'https://www.instagram.com/y.ourexp/',
                            ''
                        ]
                    ],
                    [
                        'nama' => 'Fadira Mutiara Syafa',
                        'nim' => '105222034',
                        'foto' => '/img/fadira.png',
                        'email' => 'fadirasyafa@gmail.com',
                        'sosmed' => [
                            'https://github.com/FadiraMutiara',
                            '',
                            'https://www.instagram.com/fdrmtr04/',
                            'https://www.linkedin.com/in/fadira-syafa-382489270/'
                        ]
                    ]

                ]
            ],
                'ajak' => 'Yuk, tunggu apalagi, segera daftarkan dirimu'
            ];
    }
}



?>