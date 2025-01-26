<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Daftar nama lengkap yang akan digunakan
        $names = [
            'Agus Santoso', 'Ahmad Fauzan', 'Bella Anggraini', 'Budi Susanto', 'Chandra Setiawan', 'Citra Wulandari', 'Dewi Anggraini', 'Dian Purnama', 'Eka Novita', 'Eko Prasetyo',
            'Fajar Pratama', 'Fitriani Safitri', 'Galuh Rahayu', 'Gita Permata', 'Hariyadi Rahman', 'Hasan Basri', 'Indra Kusuma', 'Intan Lestari', 'Joko Saputra', 'Julia Sari',
            'Kartika Dewi', 'Krisna Aditya', 'Lestari Putri', 'Lia Puspita', 'Mardiyah Setiawan', 'Miko Hidayat', 'Nanda Wijaya', 'Nina Syafitri', 'Oka Yulianto', 'Oktaviani Sari',
            'Putri Maulani', 'Putu Mahendra', 'Ria Lestari', 'Rian Febrianto', 'Siti Rahmawati', 'Surya Pratama', 'Tania Maulani', 'Toni Saputra', 'Umar Syahputra', 'Umi Kalsum',
            'Vina Pratiwi', 'Vivi Anggraini', 'Wahyu Santoso', 'Wawan Santoso', 'Yohana Lestari', 'Yulia Setiawati', 'Yuniarti Fitri', 'Zaenal Mustofa', 'Zainal Arifin', 'Zulfa Mahendra'
        ];

        // Loop untuk memasukkan 50 data user
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'nim' => '10522700' . str_pad($i + 1, 2, '0', STR_PAD_LEFT),
                'name' => $names[$i],
                'email' => strtolower(str_replace(' ', '', $names[$i])) . '@gmail.com',
                'password' => bcrypt('12345678'),
                'prodi_id' => rand(1, 15), // Prodi ID random antara 1 hingga 15
                'photo' => 'uploads/mhs/' . $names[$i] . '.jpg', // Menggunakan format nama asli dengan spasi dan ekstensi .jpg
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
