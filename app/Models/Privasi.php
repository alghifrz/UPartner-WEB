<?php

namespace App\Models;

class Privasi
{
    public static function getData() {
        $filePath = __FILE__;
        $lastUpdated = filemtime($filePath);

        return [
            'header' => 'Kebijakan Privasi',
            'waktu' => $lastUpdated ? date('d F Y', $lastUpdated) : 'Tanggal tidak ditemukan',
            'content' => [
                '<span class="leading-relaxed">Kebijakan Privasi ini menjelaskan bagaimana UPartner mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat Anda menggunakan platform kami. Dengan mengakses atau menggunakan UPartner, Anda setuju dengan praktik yang dijelaskan dalam Kebijakan Privasi ini.</span>',
                'isi' => [
                    'judul' => [
                        'Informasi yang Kami Kumpulkan',
                        'Penggunaan Informasi',
                        'Berbagi Informasi',
                        'Keamanan Data',
                        'Hak Anda',
                        'Perubahan pada Kebijakan Privasi',
                    ],
                    'detail' => [
                        '<span class="leading-relaxed">Kami mengumpulkan berbagai informasi untuk memastikan pengalaman pengguna yang optimal. Informasi pribadi yang kami kumpulkan meliputi nama, alamat email, nomor telepon, dan informasi kontak lainnya yang Anda berikan saat mendaftar. Selain itu, kami juga mengumpulkan informasi akademik seperti jurusan, universitas, tahun masuk, dan data terkait akademik lainnya. Data proyek yang Anda berikan saat membuat atau bergabung dalam proyek, seperti deskripsi proyek, linimasa, dan dokumen terkait, juga kami simpan. Kami juga mengumpulkan data penggunaan, termasuk log aktivitas, preferensi, dan interaksi Anda dengan fitur platform.</span>',
                        '<span class="leading-relaxed">Informasi yang kami kumpulkan digunakan untuk berbagai tujuan. Pertama, kami menggunakan informasi tersebut untuk memfasilitasi kolaborasi antara mahasiswa dan dosen. Kedua, informasi ini membantu kami meningkatkan dan mengoptimalkan platform UPartner. Kami juga menggunakan informasi Anda untuk mengirimkan pemberitahuan, pembaruan, dan informasi relevan terkait proyek. Selain itu, data Anda digunakan untuk memastikan keamanan dan integritas platform. Terakhir, kami menganalisis tren penggunaan untuk pengembangan fitur baru yang lebih baik.</span>',
                        '<span class="leading-relaxed">Kami tidak menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa izin Anda, kecuali dalam situasi tertentu. Informasi Anda dapat dibagikan dengan anggota tim atau dosen/mahasiswa yang terlibat dalam proyek yang sama untuk memfasilitasi kolaborasi. Kami juga dapat membagikan informasi jika diwajibkan oleh hukum atau untuk melindungi hak, properti, atau keselamatan kami atau pengguna lain. Selain itu, kami mungkin menggunakan penyedia layanan pihak ketiga untuk membantu mengoperasikan platform, dan mereka dapat mengakses informasi Anda hanya untuk tujuan tersebut.</span>',
                        '<span class="leading-relaxed">Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Namun, penting untuk diingat bahwa tidak ada metode transmisi atau penyimpanan data yang 100% aman. Oleh karena itu, meskipun kami berusaha keras melindungi data Anda, kami tidak dapat menjamin keamanan absolut.</span>',
                        'Anda memiliki beberapa hak terkait informasi pribadi Anda. Anda dapat mengakses dan memperbarui informasi pribadi Anda kapan saja melalui akun Anda. Jika Anda memutuskan untuk menghapus akun, data Anda juga akan dihapus dari platform. Anda juga memiliki hak untuk menolak penggunaan data Anda untuk tujuan tertentu. Jika Anda memiliki pertanyaan atau keluhan tentang kebijakan privasi kami, jangan ragu untuk menghubungi kami.</span>',
                        '<span class="leading-relaxed">Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu untuk mencerminkan perubahan dalam praktik kami atau peraturan yang berlaku. Perubahan tersebut akan diberitahukan melalui platform atau email. Jika Anda terus menggunakan UPartner setelah perubahan tersebut, itu berarti Anda telah menerima kebijakan privasi yang diperbarui.</span>'
                    ]

                ]
            ]
        ];
    }
}


?>