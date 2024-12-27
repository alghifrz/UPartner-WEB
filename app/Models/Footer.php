<?php

namespace App\Models;

class Footer {
    public static function getData() {
        return [
            'logo' => [
                'link' => '#',
                'judul' => 'UPartner',
                'img' => 'img/logoUPartner.png'
            ],
            'address' => [
                'link' => '#',
                'icon' => 'img/location.png',
                'judul' => 'UPartner Base',
                'alamat' => 'Jl. Teuku Nyak Arief, RT.7/RW.8, Simprug, Kec. Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12220',
                'contact' => [
                    'email' => [
                        'icon' => 'img/mail.png',
                        'mail' => 'upartner@gmail.com',
                        'link' => 'upartner@gmail.com',
                    ],
                    'phone' => [
                        'icon' => 'img/wa.png',
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
                        'link' => '#',
                    ],
                    [
                        'judul' => 'Hubungi Kami',
                        'link' => '#',
                    ],
                    [
                        'judul' => 'Kebijakan Privasi',
                        'link' => '#',
                    ]
                ]
            ],
            'partner' => [
                'judul' => 'Bagian dari:',
                'link' => [
                    'img' => 'img/logoUP.png',
                    'link' => 'https://universitaspertamina.ac.id/',
                ]
            ],
            'sosmed' => [
                'judul' => 'Ikuti Kami:',
            ],
            'copyright' => [
                'judul' => 'Copyright © 2023 UPartner. All rights reserved.',
            ]
        ];
    }
}


?>