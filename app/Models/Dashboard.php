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
                ['link' => route('katalog'), 'icon' => 'fas fa-users fa-fw', 'value' => $proyek, 'label' => 'Total Proyek'],
                ['link' => route('pengguna'), 'icon' => 'fas fa-chalkboard-teacher fa-fw', 'value' => $dosen, 'label' => 'Total Dosen'],
                ['link' => route('pengguna'), 'icon' => 'fas fa-graduation-cap fa-fw', 'value' => $mahasiswa, 'label' => 'Total Mahasiswa'],
            ],
            'exposedosen' => [
                ['link' => route('dosen.katalog'), 'icon' => 'fas fa-users fa-fw', 'value' => $proyek, 'label' => 'Total Proyek'],
                ['link' => route('dosen.pengguna'), 'icon' => 'fas fa-chalkboard-teacher fa-fw', 'value' => $dosen, 'label' => 'Total Dosen'],
                ['link' => route('dosen.pengguna'), 'icon' => 'fas fa-graduation-cap fa-fw', 'value' => $mahasiswa, 'label' => 'Total Mahasiswa'],
            ],
            'exposeguest' => [
                ['link' => route('katalogguest'), 'icon' => 'fas fa-users fa-fw', 'value' => $proyek, 'label' => 'Total Proyek'],
                ['link' => route('penggunaguest'), 'icon' => 'fas fa-chalkboard-teacher fa-fw', 'value' => $dosen, 'label' => 'Total Dosen'],
                ['link' => route('penggunaguest'), 'icon' => 'fas fa-graduation-cap fa-fw', 'value' => $mahasiswa, 'label' => 'Total Mahasiswa'],
            ],
        ];
    }
}

?>