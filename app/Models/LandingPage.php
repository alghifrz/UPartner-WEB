<?php

namespace App\Models;

class LandingPage {
    public static function getData() {
        return [
            'header' => 'UPartner',
            'title' => 'Temukan Partner Hebat, Wujudkan Proyek Impian!',
            'description' => 'Platform untuk Kolaborasi dan Realisasi Projek',
            'button' => 'Pelajari Lebih Lanjut >',
            'image' => 'https://sanbercode.com/assets_new/images/f-homepage/illustrasi%201_07%200002.png',
            'content' => [
                'judul' => [
                    'Apa itu UPartner?',
                    'Tujuannya?',
                ],
                'description' => [
                    'UPartner adalah platform yang dirancang untuk memudahkan mahasiswa dan dosen dalam <span class="font-bold">menemukan</span> dan <span class="font-bold">berpartisipasi dalam proyek </span> yang sesuai dengan <span class="font-bold">minat mereka </span>, serta membantu dosen dalam <span class="font-bold">mendapatkan anggota </span> yang ingin terlibat dalam proyek yang ditawarkan.',
                    'UPartner bertujuan untuk <span class="font-bold">menjembatani kolaborasi</span> antara mahasiswa dan dosen dalam mengerjakan proyek-proyek tertentu secara efektif dan terorganisir dengan menyediakan platform terpusat yang memfasilitasi seluruh proses tersebut.'
                ],
                'gambar' => [
                    'https://sanbercode.com/assets_new/images/f-homepage/illustrasi%203_05%200003.png',
                    'https://sanbercode.com/assets_new/images/f-homepage/illustrasi%202_13%200003.png',
                ]
            ],
            'judulFitur' => 'Fitur UPartner',
            'fitur' => [
                [
                    'link' => '/',
                    'gambar' => 'https://sanbercode.com/assets_new/images/icons/Biaya%20terjangkau.png',
                    'isi' => 'Pencarian Proyek Berdasarkan Jurusan',
                ],
                [
                    'link' => '/',
                    'gambar' => 'https://sanbercode.com/assets_new/images/icons/Zero%20to%20Hero.png',
                    'isi' => 'Pendaftaran Proyek bagi Mahasiswa dan Dosen',
                ],
                [
                    'link' => '/',
                    'gambar' => 'https://sanbercode.com/assets_new/images/icons/Zero%20to%20Hero.png',
                    'isi' => 'Pembuatan & Pengelolaan Proyek bagi Dosen',
                ],
                [
                    'link' => '/',
                    'gambar' => 'https://sanbercode.com/assets_new/images/icons/Zero%20to%20Hero.png',
                    'isi' => 'Riwayat Linimasa Proyek',
                ],
                [
                    'link' => '/',
                    'gambar' => 'https://sanbercode.com/assets_new/images/icons/Zero%20to%20Hero.png',
                    'isi' => 'Pengelolaan Profil',
                ],
            ],
            'judulAlasan' => 'Kenapa Harus UPartner ?',
            'alasan' => [
                [
                    'link' => '/',
                    'gambar' => '/img/alasan1.png',
                    'isi' => 'Pengerjaan proyek terorganisir',
                ],
                [
                    'link' => '/',
                    'gambar' => '/img/alasan2.png',
                    'isi' => 'Kolaborasi tim dalam suatu proyek ',
                ],
                [
                    'link' => '/',
                    'gambar' => '/img/alasan3.png',
                    'isi' => 'Penjadwalan proyek terstruktur',
                ]
                ],
                'ajak' => 'Yuk, tunggu apalagi, segera daftarkan dirimu'
        ];
    }
}



?>