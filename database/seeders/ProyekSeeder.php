<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Proyek;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Daftar nama lengkap yang akan digunakan
        $judul = [
            'Pengembangan Chatbot untuk Layanan',
            'Pengembangan Aplikasi Mobile untuk Manajemen Tugas',
            'Sistem Informasi Manajemen untuk Inventaris',
            'Sistem Rekomendasi Produk untuk E-Commerce',
            'Pengembangan Game Edukasi untuk Anak',
            'Website e-Learning untuk Kursus Online',
            'Aplikasi Sistem Manajemen Proyek Tim',
            'Sistem Keamanan Jaringan untuk Data',
            'Aplikasi Manajemen Keuangan Pribadi',
            'Sistem Pemantauan Kesehatan Pengguna',
            'Analisis Data Besar untuk Perusahaan',
            'Sistem Informasi Geografis untuk Data Geografis',
            'Pengembangan Website Portfolio Pribadi',
            'Aplikasi Pencatatan Pengeluaran Harian',
            'Aplikasi Pemesanan Makanan Secara Online',
            'Rencana Pemasaran Digital untuk Produk Baru',
            'Rencana Pemasaran Digital untuk Produk Baru',
            'Pengembangan Sistem Manajemen Sumber Daya Manusia',
            'Analisis Kinerja Keuangan Perusahaan',
            'Pengembangan Program Pelatihan Karyawan',
            'Rencana Strategis Perusahaan untuk Jangka Panjang',
            'Implementasi Sistem Manajemen Mutu',
            'Riset Kepuasan Pelanggan terhadap Produk',
            'Penyusunan Protokol Tata Kelola Perusahaan',
            'Pengembangan Aplikasi Manajemen Proyek',
            'Penyusunan Laporan Keberlanjutan Perusahaan',
            'Rencana Pengembangan Produk Baru yang Inovatif',
            'Pengelolaan Krisis dalam Perusahaan',
            'Peningkatan Proses Operasional di Perusahaan',
            'Studi Kasus Perusahaan Sukses',
            'Kampanye Media Sosial untuk Produk Baru',
            'Riset Media Sosial di Kalangan Remaja',
            'Kampanye Kesadaran Sosial tentang Isu Lingkungan',
            'Produksi Video Dokumenter tentang Budaya Lokal',
            'Pengembangan Podcast tentang Isu Terkini',
            'Desain Kampanye Iklan untuk Produk Baru',
            'Penelitian Perilaku Konsumen terhadap Produk',
            'Penyusunan Laporan Media tentang Dampak Opini Publik',
            'Pengembangan Strategi Komunikasi Internal',
            'Produksi Konten untuk Media Digital',
            'Analisis Efektivitas Iklan yang Diluncurkan',
            'Pembuatan Panduan Komunikasi Krisis',
            'Studi Kasus Media dan Pengaruhnya',
            'Desain Jembatan untuk Menghubungkan Dua Daerah',
            'Rancangan Jembatan untuk Kondisi Geografis Sulit',
            'Pembangunan Jalan Raya untuk Aksesibilitas',
            'Rancangan Gedung Perkantoran Modern',
            'Pengelolaan Drainase Kota untuk Mengatasi Genangan',
            'Konservasi Bangunan Bersejarah yang Terancam Punah',
            'Penelitian Material Konstruksi Ramah Lingkungan',
            ];

        $deskripsi = [
            'Membuat chatbot untuk layanan pelanggan. Proyek ini bertujuan untuk meningkatkan interaksi antara perusahaan dan pelanggan melalui penggunaan teknologi chatbot. Dengan chatbot, pelanggan dapat mendapatkan jawaban atas pertanyaan mereka secara cepat dan efisien, tanpa harus menunggu lama untuk berbicara dengan perwakilan layanan pelanggan. Selain itu, chatbot dapat beroperasi 24/7, memberikan kemudahan bagi pelanggan untuk mengakses informasi kapan saja.',

            'Membangun aplikasi mobile untuk manajemen tugas. Aplikasi ini dirancang untuk membantu pengguna dalam mengatur dan mengelola tugas sehari-hari mereka dengan lebih efektif. Fitur-fitur seperti pengingat, daftar tugas, dan integrasi dengan kalender akan memudahkan pengguna dalam merencanakan aktivitas mereka. Dengan aplikasi ini, diharapkan pengguna dapat meningkatkan produktivitas dan mengurangi stres akibat tugas yang menumpuk.',

            'Membangun sistem informasi untuk manajemen inventaris. Proyek ini bertujuan untuk menciptakan sistem yang efisien dalam mengelola stok barang di perusahaan. Dengan sistem ini, perusahaan dapat memantau jumlah barang yang tersedia, mengatur pengadaan, dan mengurangi risiko kehabisan stok. Selain itu, sistem informasi ini juga akan memberikan laporan analisis yang membantu manajemen dalam pengambilan keputusan terkait inventaris.',

            'Mengembangkan sistem rekomendasi berbasis machine learning untuk e-commerce. Proyek ini bertujuan untuk meningkatkan pengalaman belanja online dengan memberikan rekomendasi produk yang relevan kepada pengguna. Dengan menganalisis data perilaku pengguna, sistem ini dapat menyarankan produk yang sesuai dengan preferensi dan kebutuhan mereka. Hal ini diharapkan dapat meningkatkan penjualan dan kepuasan pelanggan.',

            'Membuat game edukasi untuk anak-anak tentang sains. Proyek ini bertujuan untuk mengajarkan konsep-konsep sains kepada anak-anak dengan cara yang menyenangkan dan interaktif. Melalui permainan, anak-anak dapat belajar tentang berbagai topik sains, seperti biologi, fisika, dan kimia, sambil bermain. Game ini diharapkan dapat meningkatkan minat anak-anak terhadap sains dan pendidikan secara umum.',

            'Membangun platform e-learning untuk kursus online. Proyek ini bertujuan untuk menyediakan akses pendidikan yang lebih luas melalui kursus online. Dengan platform ini, pengguna dapat mengikuti berbagai kursus dari berbagai bidang, kapan saja dan di mana saja. Fitur interaktif seperti forum diskusi dan kuis akan meningkatkan keterlibatan peserta dalam proses belajar.',

            'Mengembangkan aplikasi untuk manajemen proyek tim. Proyek ini bertujuan untuk memfasilitasi kolaborasi antar anggota tim dalam mengelola proyek. Aplikasi ini akan menyediakan fitur untuk perencanaan, pelacakan kemajuan, dan komunikasi antar anggota tim. Dengan aplikasi ini, diharapkan proyek dapat diselesaikan dengan lebih efisien dan terorganisir.',

            'Membangun sistem keamanan untuk melindungi data jaringan. Proyek ini bertujuan untuk mengembangkan sistem yang dapat mendeteksi dan mencegah ancaman terhadap data yang disimpan dalam jaringan. Dengan menggunakan teknologi terbaru, sistem ini akan memberikan perlindungan yang lebih baik terhadap serangan siber. Hal ini sangat penting untuk menjaga integritas dan kerahasiaan data perusahaan.',

            'Mengembangkan aplikasi untuk membantu pengguna mengelola keuangan pribadi. Proyek ini bertujuan untuk memberikan alat yang memudahkan pengguna dalam mencatat dan menganalisis pengeluaran mereka. Dengan fitur seperti anggaran dan laporan keuangan, pengguna dapat lebih memahami pola pengeluaran mereka dan membuat keputusan keuangan yang lebih baik. Aplikasi ini diharapkan dapat membantu pengguna mencapai tujuan keuangan mereka.',

            'Mengembangkan aplikasi untuk pemantauan kesehatan pengguna. Proyek ini bertujuan untuk memberikan informasi dan analisis tentang kesehatan pengguna melalui aplikasi mobile. Dengan fitur pelacakan aktivitas, diet, dan kesehatan mental, pengguna dapat memantau kondisi kesehatan mereka secara menyeluruh. Aplikasi ini diharapkan dapat meningkatkan kesadaran pengguna tentang pentingnya menjaga kesehatan.',

            'Menerapkan teknik analisis big data untuk data perusahaan. Proyek ini bertujuan untuk memanfaatkan data besar yang dimiliki perusahaan untuk mendapatkan wawasan yang lebih dalam. Dengan menggunakan teknik analisis yang canggih, perusahaan dapat mengidentifikasi tren, pola, dan hubungan dalam data yang dapat membantu dalam pengambilan keputusan strategis. Proyek ini diharapkan dapat meningkatkan efisiensi operasional dan daya saing perusahaan.',

            'Mengembangkan aplikasi SIG untuk analisis data geografis. Proyek ini bertujuan untuk menyediakan alat yang memungkinkan pengguna untuk menganalisis dan memvisualisasikan data geografis dengan lebih baik. Dengan fitur pemetaan dan analisis spasial, pengguna dapat membuat keputusan yang lebih informasional berdasarkan data geografis. Aplikasi ini diharapkan dapat digunakan dalam berbagai bidang, termasuk perencanaan kota dan manajemen sumber daya.',

            'Membangun website untuk menampilkan portfolio pribadi. Proyek ini bertujuan untuk memberikan platform bagi individu untuk menampilkan karya dan pengalaman mereka. Dengan desain yang menarik dan fungsional, website ini akan memudahkan pengunjung untuk melihat dan memahami keahlian pemiliknya. Proyek ini diharapkan dapat membantu individu dalam membangun reputasi profesional mereka.',

            'Mengembangkan aplikasi untuk mencatat pengeluaran harian. Proyek ini bertujuan untuk memberikan alat yang sederhana dan efektif bagi pengguna untuk mencatat dan mengelola pengeluaran mereka. Dengan fitur pengingat dan analisis pengeluaran, pengguna dapat lebih mudah mengontrol keuangan mereka. Aplikasi ini diharapkan dapat membantu pengguna dalam mencapai tujuan keuangan mereka.',

            'Mengembangkan aplikasi untuk pemesanan makanan secara online. Proyek ini bertujuan untuk memudahkan pengguna dalam memesan makanan dari berbagai restoran. Dengan antarmuka yang user-friendly dan fitur pelacakan pesanan, pengguna dapat menikmati pengalaman memesan makanan yang lebih baik. Proyek ini diharapkan dapat meningkatkan kepuasan pelanggan dan penjualan restoran.',

            'Menyusun rencana pemasaran untuk produk baru. Proyek ini bertujuan untuk merancang strategi pemasaran yang efektif untuk produk yang akan diluncurkan. Dengan melakukan analisis pasar dan identifikasi target audiens, tim akan mengembangkan rencana yang mencakup berbagai saluran pemasaran. Proyek ini diharapkan dapat meningkatkan kesadaran dan penjualan produk.',

            'Proyek ini bertujuan untuk menyusun rencana pemasaran digital untuk produk baru yang akan diluncurkan. Tim akan melakukan analisis pasar untuk memahami kebutuhan dan preferensi konsumen, serta mengembangkan strategi pemasaran yang efektif. Rencana ini akan mencakup penggunaan media sosial, konten marketing, dan iklan digital untuk mencapai target audiens yang lebih luas.',

            'Proyek ini bertujuan untuk menciptakan sistem manajemen sumber daya manusia (SDM) yang efisien untuk perusahaan. Sistem ini akan memfasilitasi pengelolaan data karyawan, absensi, gaji, dan penilaian kinerja. Dengan sistem ini, diharapkan akan meningkatkan produktivitas dan transparansi dalam pengelolaan SDM.',

            'Proyek ini akan menganalisis kinerja keuangan sebuah perusahaan untuk menentukan kesehatan finansialnya. Tim akan mengumpulkan data keuangan dari laporan tahunan dan melakukan analisis rasio untuk mendapatkan insight yang lebih dalam. Hasil analisis ini akan digunakan untuk memberikan rekomendasi strategis bagi manajemen.',

            'Proyek ini bertujuan untuk merancang program pelatihan bagi karyawan untuk meningkatkan keterampilan dan produktivitas mereka. Tim akan melakukan analisis kebutuhan pelatihan dan merancang kurikulum yang sesuai dengan kebutuhan perusahaan. Program ini diharapkan dapat meningkatkan kinerja tim dan kepuasan kerja karyawan.',

            'Proyek ini bertujuan untuk menyusun rencana strategis jangka panjang bagi perusahaan. Tim akan melakukan analisis SWOT untuk mengidentifikasi kekuatan, kelemahan, peluang, dan ancaman yang dihadapi perusahaan. Rencana ini akan menjadi panduan bagi manajemen dalam pengambilan keputusan strategis di masa depan.',

            'Proyek ini bertujuan untuk mengimplementasikan sistem manajemen mutu di perusahaan. Sistem ini akan memastikan bahwa produk dan layanan yang dihasilkan memenuhi standar kualitas yang ditetapkan. Dengan demikian, perusahaan dapat meningkatkan kepuasan pelanggan dan efisiensi operasional.',

            'Proyek ini akan meneliti kepuasan pelanggan terhadap produk dan layanan yang diberikan oleh perusahaan. Tim akan melakukan survei dan analisis data untuk mendapatkan wawasan tentang pengalaman pelanggan. Hasil riset ini akan digunakan untuk meningkatkan kualitas produk dan layanan.',

            'Proyek ini bertujuan untuk menyusun protokol tata kelola perusahaan yang baik. Protokol ini akan mengatur hubungan antara manajemen dan pemangku kepentingan, serta memastikan transparansi dan akuntabilitas. Dengan adanya protokol ini, perusahaan diharapkan dapat meningkatkan kepercayaan investor dan masyarakat.',

            'Proyek ini bertujuan untuk mengembangkan aplikasi yang dapat membantu tim dalam mengelola proyek secara efektif. Aplikasi ini akan menyediakan fitur untuk perencanaan, pelacakan, dan kolaborasi antar anggota tim. Dengan adanya aplikasi ini, diharapkan manajemen proyek dapat dilakukan dengan lebih efisien dan terstruktur.',

            'Proyek ini bertujuan untuk menyusun laporan keberlanjutan yang mencerminkan komitmen perusahaan terhadap tanggung jawab sosial dan lingkungan. Tim akan mengumpulkan data terkait dampak sosial dan lingkungan dari kegiatan perusahaan. Laporan ini diharapkan dapat meningkatkan reputasi perusahaan di mata publik.',

            'Proyek ini bertujuan untuk menyusun rencana pengembangan produk baru yang inovatif. Tim akan melakukan riset pasar untuk mengidentifikasi tren dan kebutuhan konsumen. Rencana ini akan mencakup strategi pengembangan, peluncuran, dan pemasaran produk baru.',

            'Proyek ini bertujuan untuk merancang rencana pengelolaan krisis yang efektif untuk perusahaan. Tim akan menganalisis potensi risiko yang dapat mengganggu operasional perusahaan dan menyusun strategi mitigasi. Dengan adanya rencana ini, diharapkan perusahaan dapat lebih siap menghadapi situasi krisis.',

            'Proyek ini bertujuan untuk menganalisis dan meningkatkan proses operasional di perusahaan. Tim akan melakukan pemetaan proses untuk mengidentifikasi area yang memerlukan perbaikan. Hasil dari proyek ini diharapkan dapat meningkatkan efisiensi dan mengurangi biaya operasional.',

            'Proyek ini bertujuan untuk melakukan studi kasus terhadap perusahaan yang sukses dalam industri tertentu. Tim akan menganalisis strategi yang diterapkan dan faktor-faktor yang berkontribusi pada kesuksesan perusahaan tersebut. Hasil studi ini diharapkan dapat memberikan wawasan berharga bagi perusahaan lain dalam merumuskan strategi bisnis.',

            'Proyek ini bertujuan untuk merancang kampanye visual untuk produk baru. Tim akan melakukan riset konsep visual dan menciptakan desain yang menarik untuk menarik perhatian konsumen. Kampanye ini diharapkan dapat meningkatkan kesadaran merek dan penjualan produk.',

            'Proyek ini bertujuan untuk melakukan riset mengenai penggunaan media sosial di kalangan remaja. Tim akan mengumpulkan data tentang platform yang paling banyak digunakan, serta pola interaksi dan konten yang dibagikan. Hasil riset ini akan memberikan wawasan berharga bagi pemasar dan pengembang konten untuk memahami perilaku audiens muda.',

            'Proyek ini bertujuan untuk merancang dan melaksanakan kampanye kesadaran sosial tentang isu lingkungan. Tim akan menciptakan konten yang menarik dan informatif untuk disebarluaskan melalui berbagai platform media. Dengan kampanye ini, diharapkan dapat meningkatkan kesadaran masyarakat dan mendorong tindakan positif terhadap lingkungan.',

            'Proyek ini bertujuan untuk memproduksi video dokumenter tentang budaya lokal. Tim akan melakukan riset mendalam dan wawancara dengan tokoh masyarakat untuk mengumpulkan informasi. Video ini diharapkan dapat memberikan gambaran yang jelas dan menarik tentang kekayaan budaya yang ada serta meningkatkan apresiasi masyarakat terhadap warisan budaya.',

            'Proyek ini bertujuan untuk mengembangkan seri podcast yang membahas isu-isu terkini di masyarakat. Tim akan merancang format, konten, dan memilih narasumber yang relevan untuk setiap episode. Dengan podcast ini, diharapkan dapat menjangkau audiens yang lebih luas dan menyediakan platform untuk diskusi yang informatif.',

            'Proyek ini bertujuan untuk mendesain kampanye iklan untuk produk baru. Tim akan bekerja sama dengan klien untuk memahami visi dan misi produk, serta mengembangkan konsep iklan yang menarik. Kampanye ini akan diluncurkan di berbagai platform media untuk menjangkau audiens yang lebih luas dan meningkatkan penjualan.',

            'Proyek ini akan meneliti perilaku konsumen terhadap produk tertentu di pasar. Tim akan melakukan survei dan wawancara untuk memahami preferensi dan kebiasaan pembelian konsumen. Hasil penelitian ini akan digunakan untuk merumuskan strategi pemasaran yang lebih efektif.',

            'Proyek ini bertujuan untuk menyusun laporan tentang dampak media terhadap opini publik. Tim akan mengumpulkan data dari berbagai sumber media dan menganalisis bagaimana informasi disebarluaskan. Laporan ini diharapkan dapat memberikan wawasan bagi pembuat kebijakan dan praktisi komunikasi.',

            'Proyek ini bertujuan untuk mengembangkan strategi komunikasi internal yang efektif dalam perusahaan. Tim akan melakukan analisis terhadap saluran komunikasi yang ada dan mengidentifikasi area yang perlu diperbaiki. Dengan strategi yang lebih baik, diharapkan komunikasi antar karyawan dapat menjadi lebih lancar dan produktif.',

            'Proyek ini bertujuan untuk memproduksi konten berkualitas tinggi untuk platform media digital. Tim akan merancang dan membuat artikel, video, dan infografis yang menarik dan informatif. Konten ini akan disalurkan melalui berbagai saluran untuk meningkatkan jangkauan dan interaksi dengan audiens.',

            'Proyek ini bertujuan untuk menganalisis efektivitas kampanye iklan yang telah diluncurkan. Tim akan mengumpulkan data dari berbagai sumber dan melakukan evaluasi terhadap hasil yang dicapai. Analisis ini akan memberikan rekomendasi untuk perbaikan kampanye di masa mendatang.',

            'Proyek ini bertujuan untuk menyusun panduan komunikasi krisis yang dapat digunakan oleh perusahaan saat menghadapi situasi darurat. Tim akan mengidentifikasi potensi risiko dan merancang strategi komunikasi yang sesuai. Panduan ini diharapkan dapat membantu perusahaan dalam mengelola citra publik dan menjaga kepercayaan pemangku kepentingan.',

            'Proyek ini bertujuan untuk melakukan studi kasus tentang bagaimana media mempengaruhi opini publik terkait isu tertentu. Tim akan mengumpulkan dan menganalisis data dari berbagai sumber media untuk memahami dampaknya. Hasil studi ini diharapkan dapat memberikan wawasan bagi peneliti dan praktisi komunikasi.',

            'Proyek ini bertujuan untuk merancang jembatan untuk menghubungkan dua daerah. Tim akan melakukan riset lokasi dan analisis struktural untuk memastikan desain jembatan dapat menahan beban dan kondisi cuaca yang ekstrem. Rancangan akhir akan mencakup gambar teknik dan spesifikasi material yang diperlukan untuk pembangunan.',

            'Proyek ini bertujuan untuk merancang jembatan yang menghubungkan dua daerah dengan kondisi geografis yang sulit. Tim akan melakukan analisis lokasi dan kebutuhan untuk memastikan desain jembatan dapat berfungsi dengan baik. Rancangan akhir akan mencakup gambar teknik dan spesifikasi material yang diperlukan untuk pembangunan.',

            'Proyek ini bertujuan untuk merancang dan membangun jalan raya baru untuk meningkatkan aksesibilitas antar daerah. Tim akan melakukan survei tanah dan analisis lalu lintas untuk menentukan rute terbaik dan spesifikasi teknik. Pembangunan jalan ini diharapkan dapat mengurangi kemacetan dan mempercepat distribusi barang.',

            'Proyek ini bertujuan untuk merancang gedung perkantoran modern yang efisien dari segi energi dan ruang. Tim akan melakukan studi kelayakan dan analisis kebutuhan untuk menentukan desain yang optimal. Rancangan ini akan mencakup aspek arsitektur, struktur, dan sistem mekanikal-elektrikal yang terintegrasi.',

            'Proyek ini bertujuan untuk merancang sistem drainase yang efektif untuk mengatasi masalah genangan air di perkotaan. Tim akan melakukan analisis aliran air dan studi topografi untuk merancang sistem yang efisien. Dengan adanya sistem ini, diharapkan dapat mengurangi risiko banjir dan meningkatkan kualitas hidup masyarakat.',

            'Proyek ini bertujuan untuk merestorasi dan melestarikan bangunan bersejarah yang terancam punah. Tim akan melakukan analisis struktur bangunan dan mendokumentasikan nilai sejarahnya. Melalui proyek ini, diharapkan dapat meningkatkan kesadaran masyarakat tentang pentingnya pelestarian warisan budaya.',

            'Proyek ini bertujuan untuk meneliti dan mengembangkan material konstruksi ramah lingkungan. Tim akan melakukan pengujian dan analisis untuk menentukan karakteristik dan keunggulan material baru. Hasil penelitian ini diharapkan dapat digunakan untuk meningkatkan keberlanjutan dalam industri konstruksi.',
            ];
        
        $tanggal_mulai = ['2024-02-01 09:14:32', '2024-01-01 14:21:42', '2024-02-01 16:04:58', '2024-04-01 21:27:11', '2024-01-01 18:42:07', '2024-02-01 11:19:15', '2024-01-01 02:58:19', '2024-02-01 08:51:23', '2024-01-01 19:02:28', '2024-04-01 05:10:41', '2024-01-01 12:59:45', '2024-02-01 20:43:51', '2024-01-01 23:38:14', '2024-02-01 04:24:36', '2024-04-01 07:45:00', '2024-01-01 22:10:58', '2024-01-01 15:37:22', '2024-02-01 09:50:12', '2024-03-01 10:58:47', '2024-03-01 13:31:28', '2024-01-01 21:16:19', '2024-01-01 17:25:51', '2024-02-01 13:48:30', '2024-02-01 16:14:10', '2024-02-01 02:06:50', '2025-03-01 23:31:45', '2025-01-01 08:53:10', '2025-01-01 01:47:27', '2025-02-01 04:20:31', '2025-02-01 17:35:13', '2025-02-01 03:41:04', '2025-01-01 12:29:25', '2025-02-01 09:56:18', '2025-03-01 20:02:07', '2025-03-01 11:24:13', '2025-02-01 19:42:33', '2025-01-01 10:58:42', '2025-01-01 16:23:36', '2025-02-01 18:14:51', '2025-02-01 21:05:26', '2025-01-01 23:59:59', '2025-02-01 14:27:04', '2025-02-01 06:56:30', '2025-01-01 05:15:43', '2025-02-01 10:49:58', '2025-02-01 07:21:10'];
        
        $tanggal_selesai = ['2024-04-30 02:17:02', '2024-03-30 21:19:35', '2024-04-30 17:03:07', '2024-06-30 05:08:58', '2024-09-30 02:01:28', '2024-05-31 20:16:02', '2024-04-30 03:26:22', '2024-06-30 15:47:47', '2024-03-30 20:20:42', '2024-06-30 09:19:12', '2024-06-30 20:06:22', '2024-06-30 11:36:50', '2024-03-15 08:07:23', '2024-04-30 22:17:41', '2024-06-30 16:33:58', '2024-01-30 23:43:04', '2024-01-30 07:55:58', '2024-05-30 02:21:00', '2024-05-30 11:54:58', '2024-04-30 10:29:06', '2024-04-30 23:34:56', '2024-06-30 12:39:32', '2024-06-30 20:00:57', '2024-09-30 16:32:00', '2024-09-30 18:26:40', '2025-06-30 00:24:37', '2025-06-30 02:46:52', '2025-06-30 03:39:01', '2025-06-30 08:50:59', '2025-06-30 11:08:56', '2025-06-30 21:15:57', '2025-06-30 18:32:51', '2025-09-30 02:35:15', '2025-12-30 21:56:40', '2025-12-30 04:29:24', '2025-06-30 11:11:28', '2025-06-30 19:01:32', '2025-06-30 07:17:13', '2025-06-30 13:45:56', '2025-06-30 03:01:18', '2025-09-30 17:48:49', '2025-06-30 01:00:01', '2025-06-30 11:16:08', '2025-09-30 20:01:30', '2025-09-30 13:30:23', '2025-09-30 12:50:49', '2025-06-30 05:42:49', '2025-09-30 08:59:40', '2025-09-30 03:16:16', '2025-06-30 09:50:45'];
        
            $persyaratan_kemampuan = [
                '{"1": {"nama": "Critical Thinking"}, "2": {"nama": "Problem Solving"}},',
                '{"1": {"nama": "Teamwork"}, "2": {"nama": "Leadership"}},',
                '{"1": {"nama": "Data Science"}, "2": {"nama": "Python"}, "3": {"nama": "R"}},',
                '{"1": {"nama": "Project Management"}, "2": {"nama": "Agile"}},',
                '{"1": {"nama": "Machine Learning"}, "2": {"nama": "TensorFlow"}},',
                '{"1": {"nama": "Cloud Computing"}, "2": {"nama": "AWS"}, "3": {"nama": "Azure"}},',
                '{"1": {"nama": "Blockchain"}, "2": {"nama": "Cryptography"}},',
                '{"1": {"nama": "Graphic Design"}, "2": {"nama": "Photoshop"}},',
                '{"1": {"nama": "SEO"}, "2": {"nama": "Content Marketing"}},',
                '{"1": {"nama": "Digital Marketing"}, "2": {"nama": "Google Ads"}},',
                '{"1": {"nama": "IoT"}, "2": {"nama": "Embedded Systems"}},',
                '{"1": {"nama": "Robotics"}, "2": {"nama": "C++"}, "3": {"nama": "Python"}},',
                '{"1": {"nama": "Video Editing"}, "2": {"nama": "Adobe Premiere"}},',
                '{"1": {"nama": "Public Speaking"}, "2": {"nama": "Presentation Skills"}},',
                '{"1": {"nama": "Business Analysis"}, "2": {"nama": "Requirement Gathering"}},',
                '{"1": {"nama": "Software Engineering"}, "2": {"nama": "Code Review"}},',
                '{"1": {"nama": "UI/UX"}, "2": {"nama": "Figma"}},',
                '{"1": {"nama": "Mobile App Development"}, "2": {"nama": "Flutter"}},',
                '{"1": {"nama": "Human-Computer Interaction"}, "2": {"nama": "User Research"}},',
                '{"1": {"nama": "Mathematics"}, "2": {"nama": "Linear Algebra"}},',
                '{"1": {"nama": "Physics"}, "2": {"nama": "Mechanics"}},',
                '{"1": {"nama": "Data Visualization"}, "2": {"nama": "Tableau"}},',
                '{"1": {"nama": "Artificial Intelligence"}, "2": {"nama": "Neural Networks"}},',
                '{"1": {"nama": "Programming"}, "2": {"nama": "C"}, "3": {"nama": "C++"}},',
                '{"1": {"nama": "Game Design"}, "2": {"nama": "Level Design"}},',
                '{"1": {"nama": "DevOps"}, "2": {"nama": "CI/CD"}},',
                '{"1": {"nama": "Testing"}, "2": {"nama": "Automation"}},',
                '{"1": {"nama": "Renewable Energy"}, "2": {"nama": "Solar Technology"}},',
                '{"1": {"nama": "Mechanical Engineering"}, "2": {"nama": "CAD"}},',
                '{"1": {"nama": "Electrical Engineering"}, "2": {"nama": "Circuit Design"}},',
                '{"1": {"nama": "Entrepreneurship"}, "2": {"nama": "Business Planning"}}'
            ];

            $role = [
                '{"1": {"nama": "Software Engineer"}, "2": {"nama": "Data Scientist"}, "3": {"nama": "Frontend Developer"}, "4": {"nama": "Backend Developer"}},',
                '{"1": {"nama": "Project Manager"}, "2": {"nama": "Scrum Master"}, "3": {"nama": "Business Analyst"}, "4": {"nama": "Product Manager"}},',
                '{"1": {"nama": "AI Engineer"}, "2": {"nama": "Machine Learning Specialist"}, "3": {"nama": "Deep Learning Engineer"}, "4": {"nama": "NLP Expert"}},',
                '{"1": {"nama": "Web Developer"}, "2": {"nama": "UI/UX Designer"}, "3": {"nama": "Full Stack Developer"}, "4": {"nama": "DevOps Engineer"}},',
                '{"1": {"nama": "Cybersecurity Specialist"}, "2": {"nama": "Ethical Hacker"}, "3": {"nama": "Network Administrator"}, "4": {"nama": "Security Analyst"}},',
                '{"1": {"nama": "Data Analyst"}, "2": {"nama": "Business Intelligence Analyst"}, "3": {"nama": "Database Administrator"}, "4": {"nama": "ETL Developer"}},',
                '{"1": {"nama": "Mobile Developer"}, "2": {"nama": "iOS Developer"}, "3": {"nama": "Android Developer"}, "4": {"nama": "Flutter Developer"}},',
                '{"1": {"nama": "Game Developer"}, "2": {"nama": "Game Designer"}, "3": {"nama": "3D Artist"}, "4": {"nama": "Unity Developer"}},',
                '{"1": {"nama": "Cloud Engineer"}, "2": {"nama": "AWS Solutions Architect"}, "3": {"nama": "Azure Developer"}, "4": {"nama": "Google Cloud Engineer"}},',
                '{"1": {"nama": "Digital Marketer"}, "2": {"nama": "SEO Specialist"}, "3": {"nama": "Content Creator"}, "4": {"nama": "Social Media Manager"}},',
                '{"1": {"nama": "HR Manager"}, "2": {"nama": "Recruiter"}, "3": {"nama": "Talent Acquisition Specialist"}, "4": {"nama": "Employee Relations Manager"}},',
                '{"1": {"nama": "Financial Analyst"}, "2": {"nama": "Accountant"}, "3": {"nama": "Tax Consultant"}, "4": {"nama": "Investment Analyst"}},',
                '{"1": {"nama": "Mechanical Engineer"}, "2": {"nama": "CAD Designer"}, "3": {"nama": "Maintenance Engineer"}, "4": {"nama": "Automation Engineer"}},',
                '{"1": {"nama": "Electrical Engineer"}, "2": {"nama": "Power Systems Engineer"}, "3": {"nama": "Electronics Engineer"}, "4": {"nama": "Instrumentation Engineer"}},',
                '{"1": {"nama": "Research Scientist"}, "2": {"nama": "Biotechnologist"}, "3": {"nama": "Lab Technician"}, "4": {"nama": "Clinical Researcher"}},',
                '{"1": {"nama": "Architect"}, "2": {"nama": "Interior Designer"}, "3": {"nama": "Urban Planner"}, "4": {"nama": "Landscape Architect"}},',
                '{"1": {"nama": "Teacher"}, "2": {"nama": "Lecturer"}, "3": {"nama": "Instructional Designer"}, "4": {"nama": "Curriculum Developer"}},',
                '{"1": {"nama": "Creative Director"}, "2": {"nama": "Art Director"}, "3": {"nama": "Graphic Designer"}, "4": {"nama": "Animator"}},',
                '{"1": {"nama": "Video Editor"}, "2": {"nama": "Cinematographer"}, "3": {"nama": "Film Director"}, "4": {"nama": "Scriptwriter"}},',
                '{"1": {"nama": "Content Writer"}, "2": {"nama": "Copywriter"}, "3": {"nama": "Technical Writer"}, "4": {"nama": "Editor"}},',
                '{"1": {"nama": "Operations Manager"}, "2": {"nama": "Logistics Manager"}, "3": {"nama": "Supply Chain Analyst"}, "4": {"nama": "Warehouse Supervisor"}},',
                '{"1": {"nama": "Environmental Scientist"}, "2": {"nama": "Sustainability Consultant"}, "3": {"nama": "Ecologist"}, "4": {"nama": "Climate Change Analyst"}},',
                '{"1": {"nama": "Legal Advisor"}, "2": {"nama": "Corporate Lawyer"}, "3": {"nama": "Paralegal"}, "4": {"nama": "Compliance Officer"}},',
                '{"1": {"nama": "Sales Executive"}, "2": {"nama": "Account Manager"}, "3": {"nama": "Customer Success Manager"}, "4": {"nama": "Business Development Manager"}},',
                '{"1": {"nama": "Automation Tester"}, "2": {"nama": "Manual Tester"}, "3": {"nama": "QA Engineer"}, "4": {"nama": "Test Manager"}},',
                '{"1": {"nama": "Pharmacist"}, "2": {"nama": "Clinical Pharmacologist"}, "3": {"nama": "Medical Representative"}, "4": {"nama": "Pharmaceutical Researcher"}},',
                '{"1": {"nama": "Public Relations Officer"}, "2": {"nama": "Event Manager"}, "3": {"nama": "Brand Strategist"}, "4": {"nama": "Media Planner"}},',
                '{"1": {"nama": "Network Engineer"}, "2": {"nama": "System Administrator"}, "3": {"nama": "IT Support Specialist"}, "4": {"nama": "Infrastructure Engineer"}},',
                '{"1": {"nama": "Agricultural Scientist"}, "2": {"nama": "Soil Scientist"}, "3": {"nama": "Crop Advisor"}, "4": {"nama": "Irrigation Specialist"}},',
                '{"1": {"nama": "Customer Service Representative"}, "2": {"nama": "Technical Support Agent"}, "3": {"nama": "Call Center Manager"}, "4": {"nama": "Help Desk Technician"}},',
                '{"1": {"nama": "Digital Artist"}, "2": {"nama": "2D Animator"}, "3": {"nama": "3D Animator"}, "4": {"nama": "Illustrator"}},',
                '{"1": {"nama": "Renewable Energy Engineer"}, "2": {"nama": "Solar Panel Technician"}, "3": {"nama": "Wind Turbine Specialist"}, "4": {"nama": "Energy Consultant"}},',
                '{"1": {"nama": "Entrepreneur"}, "2": {"nama": "Startup Advisor"}, "3": {"nama": "Small Business Owner"}, "4": {"nama": "Investor"}},',
                '{"1": {"nama": "Fitness Trainer"}, "2": {"nama": "Physiotherapist"}, "3": {"nama": "Dietitian"}, "4": {"nama": "Sports Coach"}},',
                '{"1": {"nama": "Language Translator"}, "2": {"nama": "Interpreter"}, "3": {"nama": "Language Teacher"}, "4": {"nama": "Linguist"}},',
                '{"1": {"nama": "Economist"}, "2": {"nama": "Policy Analyst"}, "3": {"nama": "Market Researcher"}, "4": {"nama": "Statistician"}},',
                '{"1": {"nama": "Artificial Intelligence Researcher"}, "2": {"nama": "AI Developer"}, "3": {"nama": "AI Product Manager"}, "4": {"nama": "Ethics Consultant for AI"}},',                
            ];

        // Loop untuk memasukkan 50 data user
        for ($i = 0; $i < 50; $i++) {
            Proyek::create([
                'judul_proyek' => $judul[$i],
                'deskripsi_proyek' => $deskripsi[$i],
                'tanggal_mulai' => $tanggal_mulai[$i],
                'tanggal_selesai' => $tanggal_selesai[$i],
                'persyaratan_kemampuan' => $persyaratan_kemampuan[$i],
                'role' => $role,
                'status_proyek' => 'belum dimulai',
                'proyek_manajer_id' => rand(1, 53),
                'sampul' => 'uploads/sampul/Project ' . $i . '.png',
            ]);
        }
    }
}