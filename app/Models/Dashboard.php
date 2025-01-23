<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Proyek;

class Dashboard {
    public static function getData() {
        return [
            $proyek = Proyek::count(),
            $dosen = Dosen::count(),
            $mahasiswa = User::count(),
            'quotes' => [
                'Temukan Partner Hebat, Wujudkan Proyek Impian',
                'Platform untuk Kolaborasi dan Realisasi Projek',
                'button' => 'Cari Proyek <span class="ml-8">&rarr;</span>',
            ],
            'content' => [
                'judul' => 'Proyek Terbaru',
                'show' => 'Tampilkan Semua',
            ],
            'expose' => [
                ['value' => $proyek, 'label' => 'Total Proyek'],
                ['value' => $dosen, 'label' => 'Total Dosen'],
                ['value' => $mahasiswa, 'label' => 'Total Mahasiswa'],
            ],
        ];
    }
}

?>