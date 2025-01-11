<?php

namespace App\Models;

class NavbarLanding {
    public static function getData() {
        return [
            'menu' => [
                [
                    'judul' => 'Tentang Kami',
                    'link' => '/tentang',
                ],
                [
                    'judul' => 'Kontak',
                    'link' => '/kontak',
                ]
            ],
            'button' => [
                [
                    'judul' => 'Masuk',
                ],
                [
                    'judul' => 'Daftar',
                ],
            ]
        ];
    }
}

?>