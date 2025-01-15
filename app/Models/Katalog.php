<?php

namespace App\Models;

class Katalog {
    public static function getData() {
        return [
            'judul' => 'Katalog Proyek',
            'quotes' => [ 
                'Proyek di UPartner Berbasis Teknologi dan Bisnis Energi',
                'UPartner menyediakan berbagai proyek yang sesuai dan relevan dengan Universitas Pertamina, sebagai kampus teknologi dan bisnis energi'
            ]
        ];
    }
}

?>