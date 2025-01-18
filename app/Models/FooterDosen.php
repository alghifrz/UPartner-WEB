<?php

namespace App\Models;

class FooterDosen {
    public static function getData() {
        return [
            'logo' => [
                'link' => '#',
                'judul' => 'UPartner',
                'img' => '/img/logoUPartner.png'
            ],
            'address' => [
                'link' => 'https://maps.app.goo.gl/GHKwKGoAzY3n4SPZ7',
                'icon' => '/img/location.png',
                'judul' => 'UPartner Base',
                'alamat' => 'Jl. Teuku Nyak Arief, RT.7/RW.8, Simprug, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12220',
                'contact' => [
                    'email' => [
                        'icon' => '/img/mail.png',
                        'mail' => 'upartner2024@gmail.com',
                        'link' => 'upartner2024@gmail.com',
                    ],
                    'phone' => [
                        'icon' => '/img/wa.png',
                        'wa' => '+62 812 3456 7890',
                        'link' => '+62 821 7277 2394',
                    ]
                ]
            ],
            'menu' => [
                'judul' => 'UPartner:',
                'link' => [
                    [
                        'judul' => 'Tentang Kami',
                        'link' => route('dosen.tentang'),
                    ],
                    [
                        'judul' => 'Hubungi Kami',
                        'link' => route('dosen.kontak'),
                    ],
                    [
                        'judul' => 'Kebijakan Privasi',
                        'link' => route('dosen.privasi'),
                    ]
                ]
            ],
            'partner' => [
                'judul' => 'Bagian dari:',
                'link' => [
                    'img' => '/img/logoUP.png',
                    'link' => 'https://universitaspertamina.ac.id/',
                ]
            ],
            'sosmed' => [
                'judul' => 'Ikuti Kami:',
            ],
            'copyright' => [
                'judul' => 'Copyright © 2024 UPartner. All rights reserved.',
            ]
        ];
    }
}


?>