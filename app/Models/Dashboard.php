<?php

namespace App\Models;

class Dashboard {
    public static function getData() {
        return [
            'quotes' => [
                'Temukan Partner Hebat, Wujudkan Proyek Impian',
                'Platform untuk Kolaborasi dan Realisasi Projek',
                'button' => 'Mulai Sekarang <span class="ml-8">&rarr;</span>',
            ],
            'content' => [
                'judul' => 'Rekomendasi Proyek',
            ],
        ];
    }
}

?>