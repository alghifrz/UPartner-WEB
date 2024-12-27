<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        // Definisikan nama-nama prodi dalam array
        $prodiNames = [
            'Ilmu Komputer',
            'Kimia',
            'Teknik Elektro',
            'Teknik Sipil',
            'Teknik Lingkungan',
            'Teknik Kimia',
            'Teknik Mesin',
            'Teknik Logisitik',
            'Teknik Perminyakan',
            'Teknik Geologi',
            'Teknik Geofisika',
            'Ilmu Komunikasi',
            'Manajemen',
            'Ekonomi',
            'Hubungan Internasional'
        ];

        // Looping untuk memasukkan data ke tabel prodi
        foreach ($prodiNames as $prodiName) {
            Prodi::create([
                'prodi_name' => $prodiName,
            ]);
        }
    }
}
