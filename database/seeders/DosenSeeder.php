<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Daftar nama lengkap dosen
        $names = [
            'Aditya Wicaksono', 'Agus Priyanto', 'Andi Pratama', 'Anton Rahardian', 'Anton Saputra', 'Anwar Suprapto', 'Ardi Saputra', 'Ari Wibowo', 'Bagus Gunawan', 'Bambang Irawan',
            'Bayu Nugroho', 'Dedi Supriadi', 'Desi Anggraini', 'Devi Handayani', 'Dewi Sulastri', 'Dinda Pratiwi', 'Dwi Susanto', 'Fahrul Basri', 'Gina Anggraini', 'Haryanto Widodo',
            'Ida Lestari', 'Ina Rahayu', 'Ira Susanti', 'Irfan Maulana', 'Joni Hartono', 'Kiki Susanti', 'Lidya Utami', 'Lila Putri', 'Lisa Utami', 'Lukman Hakim', 'Maria Apriani',
            'Melati Wulandari', 'Nana Suryani', 'Nino Wibisono', 'Panca Sasongko', 'Rani Widodo', 'Ratna Sari', 'Reni Marlina', 'Rika Yuliani', 'Rina Marlina', 'Rini Triani',
            'Rini Widiastuti', 'Rizki Pratama', 'Rudi Hartono', 'Siti Maulani', 'Susilo Bambang', 'Tama Pratama', 'Tri Handayani', 'Tuti Hidayati', 'Vino Santoso'
        ];

        // Loop untuk memasukkan 50 data dosen
        for ($i = 0; $i < 50; $i++) {
            Dosen::create([
                'nip' => '116' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'name' => $names[$i],
                'email' => strtolower(str_replace(' ', '', $names[$i])) . '@gmail.com',
                'prodi_id' => rand(1, 15),
                'password' => bcrypt('12345678'),
                'photo' => '/uploads/dosen/' . str_replace(' ', '_', $names[$i]) . '.jpg', // Menggunakan nama lengkap dengan spasi diubah menjadi _
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
