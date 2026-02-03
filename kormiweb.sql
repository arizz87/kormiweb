-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 03, 2026 at 09:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kormiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agenda`
--

CREATE TABLE `tbl_agenda` (
  `id_agenda` int(11) NOT NULL,
  `agenda_nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `agenda_mulai` varchar(45) NOT NULL,
  `agenda_selesai` varchar(45) NOT NULL,
  `agenda_waktu` varchar(45) NOT NULL,
  `agenda_deskripsi` text NOT NULL,
  `agenda_tempat` varchar(255) NOT NULL,
  `agenda_keterangan` text NOT NULL,
  `agenda_author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_agenda`
--

INSERT INTO `tbl_agenda` (`id_agenda`, `agenda_nama`, `created_at`, `agenda_mulai`, `agenda_selesai`, `agenda_waktu`, `agenda_deskripsi`, `agenda_tempat`, `agenda_keterangan`, `agenda_author`) VALUES
(1, 'Rapat Sosialisasi Dapodik Kab. Brebes', '2025-01-13 16:13:08', '2025-01-13', '2025-01-14', '08.00 s.d 12 WIB', '', 'Aula 1 Dindikpora Kab. Brebes', 'Dihadiri 120 Orang Operator Jenjang SMP', 'Administrator'),
(2, 'Rakor PPDB Jenjang SMP', '2025-01-13 17:15:47', '2025-08-10', '2025-08-10', '08.00 s.d 12.00 WIB', '', 'Hotel Lor In Solo', '-', 'Administrator'),
(3, 'Hari Jadi Brebes', '2025-01-20 11:52:20', '2025-02-18', '2025-02-19', '-', '<p>xxxx</p>\r\n', 'Alun-Alun Brebes', '-', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_balasan`
--

CREATE TABLE `tbl_balasan` (
  `id_balasan` int(11) NOT NULL,
  `balasan_nama` varchar(45) NOT NULL,
  `balasan_isi` text NOT NULL,
  `komentar_id` mediumint(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_balasan`
--

INSERT INTO `tbl_balasan` (`id_balasan`, `balasan_nama`, `balasan_isi`, `komentar_id`, `created_at`) VALUES
(1, 'Okaeri', 'mantap mantap\r\n', 3, '2021-06-02 09:26:54'),
(2, 'Arnold Raffles', 'Slurd ngab', 4, '2021-07-09 19:16:03'),
(3, 'admin', 'yeahhh', 5, '2025-01-20 01:22:10'),
(4, 'okkk', 'kkkkkk', 5, '2025-01-20 01:22:31'),
(5, 'Admin', 'iya apa kabar', 6, '2025-01-20 07:56:08'),
(6, 'Admin', 'Ok brooo', 1, '2025-01-28 12:30:04'),
(8, 'Aris', 'Iyaaaa', 10, '2025-02-02 02:37:57'),
(9, 'Aronn', 'Tidak seper itu brooo', 10, '2025-02-02 03:42:44'),
(10, 'Alex', 'Memang seperti itu', 10, '2025-02-02 03:45:07'),
(11, 'Figo', 'Jare sapa ???', 10, '2025-02-02 03:45:44'),
(12, 'Alexx', 'lah jare sapa ?', 17, '2025-02-02 03:46:35'),
(13, 'Figo', 'temenan brooo', 17, '2025-02-02 03:47:08'),
(14, 'RObiah', 'Wis wis aja kesuwen', 17, '2025-02-02 03:48:40'),
(15, 'Alexx', 'Mumeettt', 17, '2025-02-02 03:49:35'),
(16, 'Algojo', 'Aku sudah bisa move on brooo', 10, '2025-02-02 11:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `id_blog` mediumint(9) NOT NULL,
  `blog_slug` varchar(255) NOT NULL,
  `blog_tgl` varchar(20) NOT NULL,
  `blog_tgl_edit` varchar(20) NOT NULL,
  `blog_author` varchar(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_isi` text NOT NULL,
  `blog_img` varchar(255) DEFAULT NULL,
  `blog_thumb` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blog_kategori_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `komentar` varchar(20) NOT NULL,
  `posting` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id_blog`, `blog_slug`, `blog_tgl`, `blog_tgl_edit`, `blog_author`, `blog_title`, `blog_isi`, `blog_img`, `blog_thumb`, `created_at`, `blog_kategori_id`, `user_id`, `komentar`, `posting`) VALUES
(1, 'penguatan-paud-hi-melalui-kebijakan--keterlibatan-orang-tua--dan-inovasi-digital-1239696324', '2025-01-06 18:03:12', '2025-01-06', 'Administrator', 'Penguatan PAUD HI melalui Kebijakan, Keterlibatan Orang tua, dan Inovasi Digital', '<p><strong>Jakarta, Kemendikdasmen - </strong>Pendidikan Usia Dini Holistik Integratif (PAUD HI) merupakan sebuah proses komprehensif untuk mendukung perkembangan kognitif, fisik, emosi, dan sosial seorang anak sejak kecil. Pertumbuhan anak yang baik dapat melahirkan insan yang berkualitas dan berbudi pekerti di masa yang akan datang. Oleh karena itu Peluncuran Risalah Kebijakan PAUD HI, Modul PAUD, dan aplikasi Anaking pada tanggal 19 Desember 2024 bersama Southeast Asian Ministers of Education Organization Regional Center for Early Childhood Care Education and Parenting (SEAMEO CECCEP) di Plaza Insan Berprestasi Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen), telah sejalan dengan program nasional Wajib Belajar 13 tahun yang hadir sebagai salah satu upaya mendukung rencana mewujudkan PAUD HI.&nbsp;</p>\r\n\r\n<p><strong>Program Wajib Belajar 13 tahun.&nbsp;</strong></p>\r\n\r\n<p>Mengenai Perencanaan terkait PAUD HI, pemerintah menyadari bahwa Pendidikan Usia Dini kini menjadi kunci perkembangan siswa. Sebagaimana dikatakan Deputi Bidang Pembangunan Manusia, Masyarakat, dan Kebudayaan, Amich Alhumami. &ldquo;Anak usia sekolah akan ditarik menjadi tidak hanya sebatas antara Umur 7 hingga 18 tahun, setidaknya ada 1 tahun pra pendidikan formal, dalam rentang antara umur 5 tahun dan 6 tahun.&rdquo;</p>\r\n\r\n<p>Amich menambahkan bahwa rencana pelaksanaan wajib belajar 13 tahun akan mulai dilaksanakan saat periode pemerintahan saat ini. Program ini menjadi penting untuk menjawab isu terkait pemerataan pendidikan dan isu kualitas pendidikan yang harapannya akan mampu menjadikan pendidikan baik juga bermutu dapat diakses semua siswa.&nbsp;</p>\r\n\r\n<p>Dari sudut pandang pemerataan pendidikan, berdasarkan statistik pendidikan juga survey yang diterbitkan oleh Badan Pusat Statistik (BPS), menunjukkan bahwa tingkat pemerataan pendidikan sudah baik dan cenderung meningkat. Namun permasalahannya terkait kualitas pendidikan yang dapat diakses siswa.&nbsp;</p>\r\n\r\n<p>Merujuk pada data Asesmen Nasional (AN), kecakapan literasi dan numerasi anak Indonesia kategori SDMI saat ini hanya 63%. Hal ini dikarenakan sistem pengajaran yang menggunakan Bahasa Indonesia, sementara di beberapa daerah siswa menggunakan bahasa daerah dalam percakapan kesehariannya sehingga kemampuan anak untuk memahami materi sedikit terhambat dikarenakan keterbatasan kemahiran berbahasa Indonesia. &ldquo;Kami sangat merekomendasikan, untuk kelas awal, guru juga sebaiknya mengajar dalam Bahasa daerah,&rdquo; imbau Amich.&nbsp;</p>\r\n\r\n<p><strong>Pendidikan dan Pengasuhan, Mana yang Lebih Penting?&nbsp;</strong></p>\r\n\r\n<p>Deputi Bidang Koordinasi Peningkatan Kualitas Anak, Perempuan, dan Pemuda, Kementerian Koordinator Bidang Pembangunan Manusia dan Kebudayaan (Kemenko PMK), Woro Srihastuti Sulistyaningrum menyampaikan, &ldquo;10?ri jumlah penduduk Indonesia saat ini adalah Umur 0 sampai 5 tahun, artinya ada sekitar 28 juta anak usia dini, itu jumlah yang sangat besar, dan ini menjadi potensi kita yang perlu digarap secara luar biasa yang nanti akan mengisi pembangunan &rdquo;&nbsp;</p>\r\n\r\n<p>Dalam penjelasannya, Woro menyebut, kegentingan untuk memfokuskan pengembangan anak umur 0-5 tahun kali ini dilandasi oleh kesadaran bersama bahwa usia dini adalah periode emas di mana anak mengalami perkembangan yang sangat pesat. Menurutnya, anak membutuhkan stimulasi untuk memaksimalkan tumbuh kembangnya. Tentu, proses ini kerap menemukan tantangan, di antaranya ialah isu pemerataan dan kualitas Pendidikan, asupan gizi serta fasilitas kesehatan, juga pemberian pengasuhan yang baik. &ldquo;Ini butuh kerja sama multisektor, tidak biasa hanya dikerjakan satu sektor saja pada saat kita bicara perkembangan anak usia dini,&rdquo; tegas Woro.&nbsp;</p>\r\n\r\n<p>Lebih lanjut katanya, &ldquo;Setiap periode pertumbuhan anak memiliki kebutuhan yang berbeda-beda, intervensi yang dibutuhkan juga berbeda. Oleh karena itu, koordinasi dari setiap sektor dibutuhkan untuk menjadikan perkembangan anak maksimal dan sinergi,&rdquo; tuturnya.&nbsp;</p>\r\n\r\n<p>Kemenko PMK menjadi kepala gugus tugas untuk memastikan sinergi antar lembaga kementerian agar mampu mengisi kebutuhan-kebutuhan anak di setiap periode perkembangannya. Hal ini tertuang dalam rencana aksi nasional. Namun indikator pengembangan anak usia dini tidak hanya di lekatkan dengan kebutuhan layanannya saja tetapi ada lingkungan yang harus mendukung yaitu pentingnya peran pengasuh.&nbsp;</p>\r\n\r\n<p>Woro menjelaskan, 90% anak itu tinggal dalam keluarga yang utuh, maka penting sekali bagi anak memiliki keluarga atau sosok pengasuh yang baik. Sejauh ini koordinasi yang dapat dilakukan dan dievaluasi hanyalah terkait pendidikan. Tetapi dari segi pengasuhan belum terasah dengan baik. &ldquo;Sehingga penting bagi Kemenko PMK untuk berkoordinasi dalam menjamin penguatan keluarga terutama sosok pengasuh yang handal bagi anak,&rdquo; pungkasnya.&nbsp;</p>\r\n\r\n<p><strong>Program Layanan terkait PAUD HI&nbsp;</strong></p>\r\n\r\n<p>Direktur PAUD, Direktorat Jenderal PAUD Dikdasmen, Kemendikdasmen, Komalasari, menyampaikan bahwa pihaknya memiliki visi PAUD berkualitas. Ia memaparkan pentingnya bagi satuan gugus tugas untuk memastikan satuan PAUD Indonesia mampu memberikan Layanan untuk anak usia diri secara optimal sesuai dengan Peraturan Presiden Nomor 60 Tahun 2013. Anak harus mendapatkan kebutuhan yang meliputi pendidikan, gizi, kesehatan, pengasuhan, dan kesejahteraan.&nbsp;</p>\r\n\r\n<p>&ldquo;Direktorat PAUD mengimbau satuan PAUD di seluruh Indonesia mengimplementasikan PAUD berkualitas dengan memberikan pelayanan yang esensial melalui program PAUD HI,&rdquo; tegas Komalasari.&nbsp;</p>\r\n\r\n<p>Sejauh ini kementerian telah memberikan bantuan kepada satuan PAUD sejak tahun 2020 yang bertujuan untuk mensukseskan visi PAUD Berkualitas, yang secara spesifik mendorong pemerintah kabupaten dan kota untuk membentuk regulasi serta membangun komitmen untuk berkolaborasi mendukung layanan esensial ini.&nbsp;</p>\r\n\r\n<p>Komalasari menyampaikan, &ldquo;Saat ini kami telah mendampingi dan mengadvokasi, memberikan bantuan kepada 250 kabupaten/kota di Indonesia, dan mereka telah mendapatkan intervensi agar mereka dapat memenuhi regulasi terkait PAUD HI&rdquo;. Hal ini diharapkan mampu membentuk kolaborasi yang maksimal. Selain itu, telah dibentuk pula penguatan kapasitas yang ditujukan kepada pemerintah daerah agar mampu mendampingi satuan - satuan PAUD nya untuk memberikan Layanan Holistik Integratif .&nbsp;</p>\r\n\r\n<p>Ia turut menambahkan, &ldquo;Saat ini 76% satuan PAUD kita telah memenuhi minimal 6 dari 8 indikator PAUD HI&rdquo;. 8 indikator itu yakni, kelas orang tua, pemantauan pertumbuhan anak, pemantauan perkembangan anak, koordinasi dengan unit lain terkait pemenuhan gizi Dan kesehatan, penerapan PHBS Melalui pembiasaan, Pemberian PMT Dan makanan bergizi secara berkala, pemantauan kepemilikan identitas (NIK) peserta didik, dan ketersediaan fasilitas sanitasi dan air bersih. Untuk memastikan kelancaran implementasi PAUD berkualitas, di tahun 2025 Direktorat PAUD telah bekerjasama dengan World Bank dalam program, INEY, yang diharapkan mampu mendorong satuan - satuan PAUD di Indonesia mampu memenuhi 8 indikator PAUD HI.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://www.kemdikbud.go.id</strong></p>\r\n', 'berita-20260131180312-9348.jpeg', 'ccdc95ba4cc024f4ddfebe8aaa5e4a1d.png', '2026-01-31 11:03:12', 1, 58, 'Tidak', 'Posting'),
(2, 'integrasi-coding-dan-ai-di-dunia-pendidikan--langkah-indonesia-menuju-ekosistem-digital-global--189435157', '2025-01-14 18:02:53', '2025-01-14', 'Administrator', 'Integrasi Coding dan AI di Dunia Pendidikan: Langkah Indonesia Menuju Ekosistem Digital Global ', '<p><strong>Jakarta, Kemendikdasmen</strong> &ndash; Indonesia memiliki potensi besar untuk memasuki ekosistem digital global. Hal tersebut disampaikan oleh Staf Khusus Menteri Pendidikan Dasar dan Menengah, M. Muchlas Rowi, dalam sambutannya pada kegiatan Diskusi Kelompok Terpumpun (DKT) Pengembangan Pembelajaran <em>Coding</em> dan Kecerdasan Buatan pada Jenjang Sekolah Menengah Kejuruan (SMK) di Jakarta, pada Senin (16/12).<br />\r\n&nbsp;<br />\r\nMuchlas menyampaikan bahwa Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen) akan memulai langkah awal dengan mengintegrasikan pembelajaran <em>coding</em> dan kecerdasan buatan (<em>Artificial Intelligence/</em>AI) di sekolah-sekolah di Indonesia. Pendekatan tersebut dirancang agar anak-anak dapat mengenal sains dan teknologi sejak dini, membangun kemampuan berpikir kritis, dan memahami cara memanfaatkan teknologi secara bijak.<br />\r\n&nbsp;<br />\r\n&ldquo;Anak-anak perlu diajarkan bagaimana mengelompokkan informasi dan mengenal diri mereka melalui pendekatan-pendekatan sederhana,&rdquo; ujarnya.<br />\r\n&nbsp;<br />\r\nLebih lanjut, Muchlas memaparkan bahwa berdasarkan data dari World Economic Forum, <em>Artificial Intelligence</em> menempati posisi kedelapan dalam teknologi yang diprediksi akan diadopsi oleh organisasi pada tahun 2023-2027 dengan presentase sebesar 74,9%. Data tersebut menunjukkan bahwa pekerjaan yang bersifat rutin akan semakin terotomatisasi oleh AI. Hal ini menciptakan peluang sekaligus tantangan bagi Indonesia untuk mencetak tenaga kerja yang siap bersaing secara global.<br />\r\n&nbsp;<br />\r\n&ldquo;Pembelajaran <em>coding</em> dan AI pada tingkat SMK perlu diarahkan pada penguasaan teknologi ini untuk menyiapkan SDM (sumber daya manusia) menjadi tenaga kerja yang relevan dengan kebutuhan industri masa depan,&rdquo; terangnya.<br />\r\n&nbsp;<br />\r\n<strong>Potensi Indonesia dalam Memasuki Ekosistem Global</strong><br />\r\n&nbsp;<br />\r\nDalam Asta Cita Presiden Republik Indonesia, Prabowo Subianto, salah satu poin yang sangat relevan adalah memperkuat pembangunan SDM melalui peningkatan kualitas pendidikan, sains, dan teknologi. Pengembangan AI di Indonesia memainkan peran kunci dalam mencapai tujuan ini. Data dari Writers Buddy Report tahun 2022-2023 tercatat bahwa Indonesia menempati posisi ketiga sebagai negara dengan pengguna AI terbanyak.<br />\r\n&nbsp;<br />\r\n&ldquo;Pencapaian ini menunjukkan betapa besar potensi pengguna AI di Indonesia, yang dapat menjadi pendorong penting dalam mewujudkan sumber daya manusia (SDM) unggul,&rdquo; lanjut Muchlas.<br />\r\n&nbsp;<br />\r\nSelain itu, ucap Muchlas, data lain juga menyebutkan bahwa Indonesia merupakan negara paling optimis dengan AI. Survei Artificial Intelligence Index Report 2024 oleh Stanford University menunjukkan bahwa orang Indonesia termasuk yang paling optimis di dunia terhadap teknologi AI. Optimisme ini mengindikasikan bahwa masyarakat Indonesia melihat potensi besar yang dimiliki AI dalam meningkatkan berbagai aspek kehidupan.<br />\r\n&nbsp;<br />\r\nTingginya adopsi dan optimisme terhadap AI, ditambah dengan banyaknya talenta pengembang perangkat lunak, menciptakan peluang besar bagi Indonesia. Keterhubungan digital yang semakin luas serta intensitas penggunaan internet yang tinggi semakin memperkuat potensi tersebut.<br />\r\n&nbsp;<br />\r\n&ldquo;Untuk mengoptimalkan potensi ini, diperlukan peningkatan keterampilan digital, pelatihan teknologi berkelanjutan, serta pemerataan akses teknologi terutama di dunia pendidikan. Hal ini penting untuk menciptakan SDM yang benar-benar siap bersaing,&rdquo; pungkasnya.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://www.kemdikbud.go.id</strong></p>\r\n', 'berita-20260131180253-2675.jpg', '8ae6565dac222b8eafbc1b805505e85f.png', '2026-01-31 11:02:53', 3, 58, 'Tidak', 'Posting'),
(3, 'upaya-membangun-iklim-pembelajaran-yang-inklusif--aman--nyaman--dan-menggembirakan-632551525', '2025-01-22 18:02:33', '2025-01-22', 'Administrator', 'Upaya Membangun Iklim Pembelajaran yang Inklusif, Aman, Nyaman, dan Menggembirakan', '<p><strong>Jakarta, Kemendikdasmen ---</strong> Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen) dan Pimpinan Pusat Aisyiyah berkomitmen untuk memperkuat pendidikan karakter di Indonesia. Sejumlah langkah strategis dilakukan untuk membangun generasi yang berkarakter kuat, berintegritas, serta berdaya saing global. Program-program prioritas dalam pembangunan pendidikan nasional, khususnya yang berkaitan dengan karakter dan inklusivitas, terus diperkenalkan untuk menghadapi tantangan zaman yang semakin kompleks.<br />\r\n<br />\r\nDalam kesempatan paparan pertama, Kepala Pusat Penguatan Karakter (Kapuspeka), Rusprita Putri Utami, memaparkan tentang peran penting pendidikan karakter dalam mewujudkan visi pemerintahan yang lebih baik. Di dalam arahan yang diberikan, ia menyampaikan bahwa program-program prioritas dari Kabinet Merah Putih sangat berkaitan dengan isu penguatan karakter.<br />\r\n<br />\r\n&quot;Ada delapan program prioritas nasional, dan empat di antaranya sangat berkaitan erat dengan isu karakter. Ini terlihat jelas dalam upaya memperkokoh ideologi Pancasila, memperkuat pemberdayaan sumber daya manusia, serta menciptakan kebijakan yang inklusif dan berbasis gender,&quot; ujarnya.<br />\r\n<br />\r\nPentingnya integrasi nilai-nilai Pancasila dalam kehidupan sehari-hari, terutama di kalangan generasi muda, juga menjadi sorotan. Menurutnya, karakter bangsa harus terwujud dalam pendidikan yang mengedepankan nilai-nilai religius, moral, disiplin, kreatif, serta kerja keras. Tidak hanya itu, generasi muda juga diharapkan dapat mengimplementasikan nilai-nilai tersebut dalam kehidupan sehari-hari, serta memiliki kualifikasi global.<br />\r\n<br />\r\nSalah satu langkah yang dilakukan untuk mewujudkan pendidikan berkarakter ini adalah melalui program pelatihan bimbingan konseling untuk guru, peningkatan kompetensi guru BK dan guru agama, serta penanaman karakter melalui 7 Kebiasaan Anak Indonesia. Program ini bertujuan untuk mencegah perundungan dan kekerasan seksual yang marak terjadi di sekolah. Berdasarkan hasil PISA 2022, sebanyak 25% anak perempuan dan 30% anak laki-laki melaporkan menjadi korban perundungan beberapa kali dalam sebulan.<br />\r\n<br />\r\nSementara itu, data dari Komisi Perlindungan Anak Indonesia (KPAI) mencatatkan 2.133 kasus keluhan perlindungan anak pada tahun 2024, dengan kejahatan seksual dan kekerasan fisik/psikologis menjadi masalah yang paling dominan.<br />\r\n<br />\r\nPemerintah juga menekankan pentingnya lingkungan belajar yang aman, nyaman, dan menggembirakan, yang salah satunya dapat dicapai melalui pendidikan inklusif. Pendidikan inklusif berfokus pada penyediaan akses pendidikan bagi semua anak, termasuk mereka yang mengalami disabilitas, anak-anak rentan, serta mereka yang menjadi korban kekerasan.<br />\r\n<br />\r\nPaparan kedua yang disampaikan oleh Tim Ahli Mendikdasmen, Rita Pranawati mengangkat tema &quot;Membangun Zona Aman Belajar&quot; dengan fokus pada menciptakan lingkungan belajar yang inklusif dan berkarakter. Rita mengingatkan bahwa kebiasaan baik dan karakter positif harus diajarkan sejak dini. Dalam konteks ini, pendidikan karakter bukan hanya tugas sekolah, tetapi juga peran orang tua dan masyarakat.<br />\r\n<br />\r\n&quot;Kebiasaan baik, seperti tidur tepat waktu, bangun pagi, dan berolahraga, harus dibiasakan. Ini adalah bagian dari pendidikan karakter yang tidak bisa ditunda,&quot; ujarnya. Menurutnya, perkembangan teknologi dan media sosial juga memengaruhi karakter anak-anak, di mana banyak dari mereka yang menghabiskan waktu lebih banyak dengan ponsel daripada berinteraksi secara sosial.<br />\r\n<br />\r\nPendidikan inklusif adalah pendidikan yang memberikan kesempatan yang sama bagi setiap anak, terlepas dari latar belakang, kondisi fisik, maupun kemampuan intelektual mereka. Di dalamnya, semua anak memiliki hak yang sama untuk mendapatkan pendidikan yang layak, termasuk anak-anak yang memiliki kebutuhan khusus, seperti disabilitas atau anak-anak korban kekerasan.<br />\r\n<br />\r\n&quot;Pendidikan inklusif memberikan ruang untuk keberagaman, mengajarkan nilai-nilai seperti penghargaan terhadap perbedaan dan kesetaraan. Ini sangat penting untuk memastikan bahwa setiap anak dapat berkembang dengan baik, tanpa terkecuali,&quot; tambahnya.<br />\r\n<br />\r\nPentingnya kerja sama antara guru dan orang tua dalam menciptakan pendidikan karakter yang efektif juga menjadi sorotan. Guru harus menjadi teladan dan memberikan bimbingan yang tidak hanya bersifat akademik, tetapi juga karakter yang mencakup sikap disiplin, tanggung jawab, serta kerja sama yang baik dengan sesama.<br />\r\n<br />\r\nPaparan ketiga yang disampaikan oleh Dosen FIP Universitas Muhammadiyah Jakarta, Susilahati, menekankan pentingnya integrasi nilai-nilai karakter dalam kurikulum pendidikan. Susilahati menjelaskan bahwa pendidikan karakter harus diajarkan dalam semua mata pelajaran, mulai dari pendidikan agama, bahasa Indonesia, hingga ilmu pengetahuan alam (IPA).<br />\r\n<br />\r\n&quot;Karakter mencakup sikap seperti keinginan untuk melakukan yang terbaik, berpikir kritis, dan bertanggung jawab. Ini harus diintegrasikan dalam setiap mata pelajaran yang diajarkan di sekolah,&quot; jelasnya.<br />\r\n<br />\r\nMenurutnya, dalam Kurikulum Merdeka, nilai-nilai seperti religius, jujur, disiplin, kerja keras, kreatif, mandiri, serta gotong-royong harus menjadi bagian integral dari proses belajar-mengajar. Karakter ini tidak hanya harus diajarkan dalam konteks teori, tetapi juga dalam penerapannya sehari-hari, seperti dalam pelajaran matematika, IPA, olahraga, dan lainnya.<br />\r\n<br />\r\n&quot;Setiap mata pelajaran harus mengajarkan nilai-nilai karakter. Misalnya, dalam pelajaran matematika, kita bisa mengajarkan ketepatan, kesabaran, dan kerja sama. Sedangkan dalam pelajaran olahraga, kita bisa mengajarkan semangat sportivitas, disiplin, serta kerja sama dalam tim,&quot; tambahnya.<br />\r\n<br />\r\nPeserta seminar dari berbagai kalangan, seperti Erna, seorang guru di TK Aisyiyah 20 Tebet Barat, Jakarta Selatan, menyatakan pentingnya pembelajaran karakter yang mendalam. &quot;Kami banyak mendapatkan manfaat dari seminar ini, terutama dalam memahami bagaimana karakter anak, yang setiap anak itu berbeda. Kami belajar bagaimana cara menyikapi anak yang mungkin sedang tidak mood dan bagaimana memberikan pendekatan yang penuh kasih sayang,&quot; ujarnya.<br />\r\n<br />\r\nYuni Susanti, Kepala Sekolah di TK Aisyiyah 84 Cengkareng, juga menekankan pentingnya pendidikan karakter di usia dini. &quot;Kami sebagai sekolah penggerak selalu menekankan pentingnya pembiasaan dan penerapan disiplin positif untuk membentuk karakter anak sejak dini. Pembiasaan ini sangat penting agar anak dapat tumbuh menjadi individu yang bertanggung jawab dan mandiri,&quot; ungkapnya.<br />\r\n<br />\r\nAyu Nintias, anggota Komite Sekolah, menambahkan, &quot;Kerja sama antara guru, kepala sekolah, dan komite sangat penting untuk mendukung pembentukan karakter anak. Kami sangat mendukung sekolah inklusif karena ini memberikan kesempatan bagi semua anak, termasuk mereka yang berkebutuhan khusus, untuk mendapatkan pendidikan yang layak.&quot;<br />\r\n<br />\r\nPendidikan karakter yang inklusif dan berbasis nilai moral yang kuat menjadi pondasi penting bagi kemajuan bangsa. Melalui berbagai program dan kebijakan yang mengedepankan integritas, disiplin, serta penguatan karakter, pemerintah Indonesia berkomitmen untuk menciptakan generasi yang tidak hanya cerdas, tetapi juga memiliki karakter yang kuat dan mampu beradaptasi dengan tantangan global. Keterlibatan semua pihak, mulai dari sekolah, orang tua, hingga masyarakat, sangat diperlukan untuk mewujudkan tujuan ini.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://www.kemdikbud.go.id</strong></p>\r\n', 'berita-20260131180233-7199.png', 'f54800c3fe4b1b4166c0b8971bc774c4.jpg', '2026-01-31 11:02:33', 1, 58, 'Tidak', 'Posting'),
(4, 'kemendikdasmen-berkomitmen-mewujudkan-lingkungan-pendidikan-yang-nyaman--1658291407', '2025-01-28 18:02:04', '2025-01-28', 'Administrator', 'Kemendikdasmen Berkomitmen Mewujudkan Lingkungan Pendidikan yang Nyaman ', '<p><strong>Jakarta, Kemendikdasmen </strong>&mdash; Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen) kembali menunjukkan komitmennya dalam menciptakan sistem pendidikan yang inklusif, berkualitas, dan relevan dengan kebutuhan zaman melalui penyelenggaraan Taklimat Media Akhir Tahun 2024. Taklimat ini bertujuan untuk memberikan laporan capaian kinerja Kemendikdasmen selama tahun 2024 dan paparan mengenai arah kebijakan pendidikan pada tahun 2025. Acara yang dihadiri oleh lebih dari 60 wartawan dari berbagai media nasional tersebut, menjadi sarana penting untuk menyampaikan berbagai program unggulan yang dijalankan Kemendikdasmen, termasuk langkah-langkah penanganan masalah kekerasan dan bullying di dunia pendidikan.<br />\r\n<br />\r\nSalah satu hal yang sangat ditekankan dalam arah kebijakan Kemendikdasmen ke depan adalah pentingnya menciptakan lingkungan pendidikan yang aman dan bebas dari kekerasan serta bullying.<br />\r\n<br />\r\nMenteri Pendidikan Dasar dan Menengah (Mendikdasmen), Abdul Mu&rsquo;ti, menjelaskan bahwa Kemendikdasmen terus berupaya menciptakan lingkungan pendidikan yang aman, nyaman, dan mendukung perkembangan anak-anak di Indonesia. Menteri Mu&rsquo;ti menekankan bahwa pendidikan adalah prioritas utama dalam membangun masa depan bangsa, dan menciptakan lingkungan belajar yang bebas dari kekerasan adalah bagian dari upaya tersebut.<br />\r\n<br />\r\n&quot;Kami terus berkomitmen untuk menangani masalah kekerasan dan bullying di sekolah dengan serius. Ke depan, kami akan memastikan bahwa seluruh upaya yang kami lakukan sejalan dengan visi pendidikan yang inklusif dan penuh kasih sayang. Tidak ada tempat bagi kekerasan dalam dunia pendidikan,&quot; ujar Menteri Muti pada Selasa (31/12).<br />\r\n<br />\r\nDalam sesi tanya jawab, Direktur Jenderal Guru dan Tenaga Kependidikan (Dirjen GTK), Nunuk Suryani, turut menjelaskan langkah-langkah yang telah diambil oleh Kemendikdasmen dalam menangani masalah ini. Menurutnya, selain adanya Satgas yang telah dibentuk, penanganan kekerasan di sekolah kini juga melibatkan pelatihan bagi guru untuk meningkatkan kompetensi mereka dalam pencegahan kekerasan dan bullying.<br />\r\n<br />\r\n&quot;Selama dua bulan terakhir, kami telah melakukan pelatihan untuk guru kelas yang bertujuan agar mereka memiliki kompetensi dalam memberikan bimbingan kepada siswa, termasuk dalam hal pencegahan kekerasan. Kami sudah melatih lebih dari 1.264 orang guru, dan hasilnya cukup positif. Kami juga melatih guru Bimbingan dan Konseling (BK) dengan materi yang relevan mengenai perlindungan terhadap anak dan penanganan kekerasan. Pelatihan ini akan terus diperluas melalui model berbasis komunitas dan kelompok kerja, sehingga lebih banyak guru dapat mengakses pengetahuan dan keterampilan dalam menangani masalah ini,&quot; jelas Direktur Jenderal Guru dan Tenaga Kependidikan (Dirjen GTK), Nunuk Suryani.<br />\r\n<br />\r\nKemendikdasmen juga terus memperkuat struktur di tingkat provinsi dan kabupaten atau kota untuk menangani kasus kekerasan di satuan pendidikan. Sekretaris Jenderal Kemendikdasmen, Suharti, menjelaskan bahwa di tingkat provinsi, sudah ada 27 Satgas yang dibentuk untuk pencegahan dan penanganan kekerasan. Sementara itu, di tingkat kabupaten/kota, sebanyak 448 Satgas telah terbentuk, yang mencakup sekitar 86?ri total kabupaten/kota di Indonesia.<br />\r\n<br />\r\n&ldquo;Kami mendorong agar setiap satuan pendidikan membentuk tim khusus yang bertugas untuk menangani kekerasan. Pada 27 Desember 2024, sudah tercatat ada 406.000 satuan pendidikan yang memiliki tim pencegahan dan penanganan kekerasan,&quot; ujar Suharti.<br />\r\n<br />\r\nIa menambahkan bahwa meskipun jumlah laporan kasus kekerasan di sekolah meningkat, hal tersebut justru menunjukkan adanya keberanian dari komunitas sekolah, termasuk siswa dan orang tua, untuk melaporkan insiden kekerasan. Dengan dukungan tim Satgas yang terdiri dari berbagai pihak, termasuk dinas pendidikan, kepolisian, dan lembaga perlindungan anak, Kemendikdasmen optimis dapat meningkatkan efektivitas penanganan masalah ini di masa depan.<br />\r\n<br />\r\nKemendikdasmen terus bekerja sama dengan berbagai pihak untuk mewujudkan pendidikan yang aman dan bebas dari kekerasan. Hal ini meliputi kolaborasi dengan lembaga pemerintah, lembaga swadaya masyarakat (LSM), serta pihak kepolisian dan penegak hukum.<br />\r\n<br />\r\n&quot;Kami membutuhkan dukungan dari berbagai pihak, baik itu lembaga pendidikan, orang tua, maupun masyarakat. Semua pihak harus bersatu dalam mewujudkan pendidikan yang aman dan tidak ada tempat bagi kekerasan,&quot; tambah Menteri Muti.<br />\r\n<br />\r\nKemendikdasmen berkomitmen untuk terus meningkatkan kualitas pendidikan dan menciptakan lingkungan belajar yang aman bagi semua anak Indonesia. Melalui berbagai kebijakan dan program yang telah dilaksanakan, diharapkan pendidikan di Indonesia akan semakin berkualitas, inklusif, dan bebas dari kekerasan.<br />\r\n<br />\r\nSelain penanganan kekerasan, Kemendikdasmen juga menekankan pentingnya pendidikan karakter di sekolah sebagai bagian dari upaya menciptakan generasi penerus bangsa yang berakhlak mulia dan memiliki kepedulian terhadap sesama. Salah satu program yang dijalankan untuk mendukung hal ini adalah Program Makan Bergizi Gratis di sekolah, yang tidak hanya bertujuan untuk meningkatkan gizi siswa, tetapi juga menjadi bagian dari pendidikan karakter.<br />\r\n<br />\r\n&quot;Program makan bergizi gratis ini merupakan bagian dari pendidikan karakter di sekolah. Makan itu tidak sekadar untuk meningkatkan gizi, tetapi juga sebagai sarana untuk menanamkan nilai kebersamaan, disiplin, dan tanggung jawab. Melalui makan bersama, siswa akan belajar untuk menghargai waktu makan dan berinteraksi satu sama lain,&quot; ujar Menteri Muti.<br />\r\n<br />\r\nSelain memberikan manfaat dalam hal gizi, program makan bergizi gratis juga sejalan dengan upaya Kemendikdasmen untuk mendukung program sekolah sehat. Program ini bertujuan untuk menciptakan lingkungan sekolah yang tidak hanya mendukung keberhasilan akademik, tetapi juga kesejahteraan fisik dan mental siswa. Program sekolah sehat mencakup berbagai inisiatif yang mengedepankan pola hidup sehat, termasuk penyediaan makanan bergizi bagi siswa.<br />\r\n<br />\r\nDengan program makan bergizi gratis ini, Kemendikdasmen berupaya menjadikan sekolah sebagai tempat yang tidak hanya mendukung pencapaian akademik, tetapi juga kesejahteraan fisik dan mental siswa, yang pada akhirnya akan membentuk generasi yang sehat, cerdas, dan berkarakter.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://www.kemdikbud.go.id</strong></p>\r\n', 'berita-20260131180204-2616.png', '7b05eb52057662d47005cf0569bc722b.png', '2026-01-31 11:02:04', 1, 58, 'Tidak', 'Posting'),
(5, 'luar-biasa--tiga-siswa-smp-n-3-wanasari-juara-silat-internasional-1742775828', '2025-02-04 18:01:42', '2025-02-04', 'Administrator', 'Luar Biasa, Tiga Siswa SMP N 3 Wanasari Juara Silat Internasional', '<p>Adalah Intan Nur Aeisyah (7C), Desi Rahmawati (8E), Nabiel Zayyan Annafi (9E) siswa SMP N 3 Wanasari Kabupaten Brebes berhasil meraih juara 1 kejuaraan pencak silat tingkat internasional. Mereka berlaga di kejuaraan Indonesia Paku Bumi Open 13 th Pencak Silat Championship 2025, di Bedas Gymnasium Bandung, 31 Januari-2 Februari 2025 lalu.<br />\r\n<br />\r\n&ldquo;Alhamdulillah saya kembali juara 1 di kejuaraan silat internasional,&rdquo; ujar Desi saat dihubungi penulis di ruang Kepala Sekolah, Sabtu (9/2/2025).<br />\r\n<br />\r\nDesi berhasil menjadi juara 1 pada kelas C Putri dengan barat badan antara 39-41 Kg. Desi mengaku menggandrungi pencak silat sejak kelas IV SD bergabung dengan Perguruan Pencak Silat Pagar Nusa. Kini di sekolahnya bergabung dengan Perguruan Pencak Silat (PPS) Pusaka Arya Kamuning Seluruh Indonesia (PAKSI).<br />\r\n<br />\r\nAnak kelas 8 ini &nbsp;menjadi juara 1 tingkat internasional di kejuaraan Indonesia Paku Bumi Open 12 th dan 13 th Pencak Silat Championship 2025. Juga juara 2 tingkat nasional di Cirebon tahun 2024 lalu.<br />\r\n<br />\r\nSelain untuk mengisi waktu luang dan jaga diri, Desi seneng berlatih silat agar makin berprestasi sehingga bisa mendukung point masuk sekolah yang lebih tinggi lewat jalur prestasi. Setidaknya, cita cita Desa yang ingin jadi Pramugari bisa tercapai. Bahkan penggemar olahraga renang ini juga juara 1 atletik lari 400 meter Tingkat Kecamatan, juara 3 lompat jauh tingkat kabupaten.<br />\r\n<br />\r\nSementara Intan Nur Aeisyah (7C), selain juara 1 pencak silat juga menjadi juara 2 tolak peluru Tingkat kecamatan. Intan yang bercita-cita sebagai Koki itu menjadi juara di kelas H dengan berat badan 54-57 kg di Indonesia Paku Bumi Open 13 th Pencak Silat Championship 2025.<br />\r\n<br />\r\nSedangkan Nabiel Zayyan Annafi (9E) yang bercita-cita sebagai TNI menjadi juga menjadi juara 1 di Indonesia Paku Bumi Open 13 th Pencak Silat Championship 2025. Sebelumnya, Nabiel menjadi juara 1 IPSI Cup dan juara 1 tingkat nasional di Cirebon dan Pemalang,<br />\r\n<br />\r\nKejuaraan yang diikuti oleh atlet pencak silat dari seluruh Indonesia, Belanda, vietnam, dan Cina berlangsung meriah.<br />\r\n<br />\r\nPembina Pencak Silat SMP N 3 Wanasari Sidik Purnomo menjelaskan, peserta didiknya sangat semangat mengikuti kegiatan ekstrakurikuler setiap hari Senin dan Rabu sore. Lebih dari 40 anak yang ikut olah raga bela diri asli Indonesia itu. &nbsp;<br />\r\n<br />\r\nKepala SMP N 3 Wanasari Danang Margono mengungkapkan, bahwa pihak sekolah akan selalu support dengan memberikan reward bagi siswa maupun guru yang berprestasi, yang mengharumkan nama sekolah.<br />\r\n&ldquo;Untuk prestasi ini, sekolah memberikan reward berupa apresiasi gratis sumbangan komite selama enam bulan,&rdquo; pungkas Danang. (Wasdiun)</p>\r\n', 'berita-20260131180142-4841.jpeg', 'e9b917964ca283537570bc9b782228b6.jpeg', '2026-01-31 11:01:42', 1, 58, 'Tidak', 'Posting'),
(71, 'verifikasi-pendataan-ptk-di-lingkungan-pemerintah-kabupaten-brebes-1336720049', '2025-02-27 18:01:19', '2025-02-27', 'Administrator', 'Verifikasi Pendataan PTK di Lingkungan Pemerintah Kabupaten Brebes', '<p><strong>Pemerintah Kabupaten Brebes - </strong>Dinas Pendidikan, Pemuda dan Olahraga Kabupaten Brebes melalui Bidang Pembinaan Ketenagaan telah mengadakan kegiatan Rekonsiliasi dan Verifikasi Pendataan PTK Data Pokok Pendidikan Guru dan Tenaga Kependidikan pada sekolah negeri jenjang TK, SD dan SMP se Kabupaten Brebes yang dilaksanakan pada tanggal 17 s/d 26 Februari 2025 dengan lokasi rekonsiliasi di Aula PKG Korwilsatpendik Kecamatan Wanasari, Tonjong, Banjarharjo, Tanjung, Losari, Songgom, Jatibarang, Brebes, Bantarkawung dan Ketanggungan dengan tujuan data pokok pendidikan Guru dan Tenaga Kependidikan sesuai dengan data riil yang ada disekolah, dan keakuratan data keadaan dan kebutuhan guru dan tenaga kependidikan ditahun 2025.</p>\r\n', 'berita-20260131180120-2062.jpeg', '16863c7ffc8338ebe4dbfffbcf85bee8.jpeg', '2026-01-31 11:01:20', 1, 58, 'Tidak', 'Posting'),
(80, 'rapat-koordinasi-pendidikan--sekolah-negeri-harus-bebas-pungutan--512490541', '2025-03-06 18:00:49', '2025-03-06', 'Administrator', 'Rapat Koordinasi Pendidikan: Sekolah Negeri Harus Bebas Pungutan!', '<p><strong>Pemerintah Kabupaten Brebes - </strong>Rapat Koordinasi Pendidikan bersama Dinas Pendidikan, Pemuda, dan Olahraga Kabupaten Brebes yang dilaksanakan pada hari Kamis, tanggal 05 Maret 2025 yang dihadiri langsung oleh Bupati Brebes Ibu Paramitha Widya Kusuma dan Wakil Bupati Brebes Bapak Wurja, Plh Kepala Dindikpora Bapak Dr. Tahroni, M.Pd, Pejabat Struktural dan Staf di lingkungan Dinas Pendidikan, Pemuda dan Olahraga Kabupaten Brebes, Kordinator Wilayah Kecamatan (Korwilcam) Satpendik, MKKS Jenjang SMP dan KKKS Jenjang SD.</p>\r\n\r\n<p>Dalam kegiatan tersebut Bupati Brebes menegaskan : <em><strong>Tidak boleh ada pungutan di sekolah negeri! Pendidikan harus inklusif.</strong></em></p>\r\n\r\n<p>Pungutan dilarang! Sementara sumbangan bersifat sukarela, tanpa paksaan, dan tidak boleh membebani warga kurang mampu. Jika menemukan pelanggaran, segera laporkan!</p>\r\n\r\n<p>Mari wujudkan pendidikan yang bersih, transparan, dan berpihak pada rakyat.<br />\r\n#BrebesBeres #StopPungli</p>\r\n', 'berita-20260131180050-7680.jpg', '5350dffb632296e64b7e91641547a854.JPG', '2026-01-31 11:00:50', 1, 58, 'Tidak', 'Posting'),
(81, 'mendikdasmen-soroti-pentingnya-literasi-sebagai-bekal-peradaban-bangsa-372940991', '2025-09-16 18:00:11', '2025-09-16', 'Administrator', 'Mendikdasmen Soroti Pentingnya Literasi sebagai Bekal Peradaban Bangsa', '<p><strong>Jakarta, Kemendikdasmen</strong> &ndash; Jagat Literasi hadir sebagai ruang perjumpaan gagasan dan refleksi dalam memperkuat budaya literasi bangsa. Mengusung tema &ldquo;Menelusuri Semua Sisi, Jernih Memaknai&rdquo;, forum ini diselenggarakan oleh Kompas.com sebagai bagian dari perayaan ulang tahun ke-30, dan ditayangkan langsung melalui kanal YouTube Kompas.com dari Studio 2, Menara Kompas, Jakarta.</p>\r\n\r\n<p>Dalam acara tersebut, Menteri Pendidikan Dasar dan Menengah, Abdul Mu&rsquo;ti, menjadi pembicara kunci yang menekankan bahwa literasi adalah bekal peradaban bangsa. Menurutnya, literasi tidak berhenti pada keterampilan membaca dan menulis, tetapi juga kemampuan menafsirkan gagasan, berpikir kritis, serta membaca realitas di tengah derasnya arus teknologi dan disinformasi. &ldquo;Literasi bukan sekadar membaca aksara, tetapi juga membaca pemikiran, menelaah secara kritis, dan berani menyumbangkan gagasan yang mampu membawa perubahan,&rdquo; ujarnya.</p>\r\n\r\n<p>Ia menegaskan, perkembangan teknologi saat ini membuat batas antara fakta dan hoaks kian kabur. Karena itu, generasi muda perlu dibekali pendidikan literasi sejak dini agar tidak hanya gemar membaca, tetapi juga mampu menghargai karya orang lain serta berani melahirkan pemikiran baru. &ldquo;Generasi literat adalah generasi yang cerdas, beradab, dan siap menghadapi tantangan global,&rdquo; tambahnya.</p>\r\n\r\n<p>Sejalan dengan hal tersebut, Stephanie Riyadi, penasihat ahli Kemendikdasmen sekaligus Executive Director Pelita Harapan Group, turut memberikan pandangannya tentang pentingnya literasi dan pendidikan STEM <em>(Science, Technology, Engineering, Mathematics)</em> sebagai literasi abad ke-21. Ia menyoroti rendahnya capaian Indonesia dalam hasil PISA 2022, yang menjadi alarm penting untuk mendorong reformasi pendidikan STEM.</p>\r\n\r\n<p>&ldquo;Pendidikan STEM bukan sekadar soal rumus, robot, atau laboratorium, tetapi pola pikir yang mengajarkan keberanian bertanya, mencari solusi, dan berkolaborasi sebelum berkompetisi. Jika kita bersatu membangun ekosistem ini, kita sedang mempersiapkan generasi muda yang bukan hanya siap bersaing, tetapi juga siap memimpin dunia,&rdquo; ujarnya.</p>\r\n\r\n<p>Stephanie juga mengapresiasi peran Kompas.com sebagai media yang selama tiga dekade konsisten menyalakan cahaya literasi. Melalui kemitraan strategis, ia berharap dunia pendidikan, industri, pemerintah, media, dan masyarakat dapat saling bersinergi dalam membangun ekosistem literasi dan STEM yang kokoh.</p>\r\n\r\n<p>Perayaan HUT ke-30 Kompas.com ini pun menjadi momen refleksi, bukan hanya bagi perjalanan media daring tersebut, tetapi juga bagi upaya bersama menyiapkan masa depan bangsa yang literat, cerdas, dan berdaya saing global.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://kemdikdasmen.go.id</strong></p>\r\n', 'berita-20260131180012-1279.jpg', '84bfcfdfeb424ae53d98b0c5e606076c.jpg', '2026-01-31 11:00:12', 1, 58, 'Tidak', 'Posting'),
(82, 'pendidikan-bermutu-dimulai-dari-pendidikan-karakter-sejak-dini-1357837840', '2025-09-18 18:00:00', '2025-09-18', 'Administrator', 'Pendidikan Bermutu Dimulai dari Pendidikan Karakter Sejak Dini', '<p><strong>Medan, Kemendikdasmen</strong> &ndash; Pendidikan merupakan ujung tombak dalam menciptakan generasi Indonesia Emas tahun 2045. Di dalam prosesnya, pendidikan tidak hanya berfokus untuk mencetak sumber daya manusia (SDM) yang cerdas secara intelektual, tetapi juga harus memiliki karakter yang tangguh dan berdaya saing.</p>\r\n\r\n<p>Staf Khusus Menteri Pendidikan Dasar dan Menengah Bidang Pembelajaran dan Sekolah Unggul, Arif Jamali, mengatakan bahwa pendidikan bermutu termasuk di dalamnya pendidikan karakter. Pendidikan karakter sangat penting dalam rangka mempersiapkan anak Indonesia agar mampu menghadapi tantangan zaman.</p>\r\n\r\n<p>&ldquo;Tantangan ke depan akan jauh lebih besar dibandingkan hari ini. Kita tidak bisa memprediksi pergeseran budaya, kecanggihan teknologi, dan pola pikir anak-anak kita. Karena itu, pendidikan karakter menjadi penopang utama dalam membentuk anak-anak Indonesia menjadi generasi yang tangguh,&rdquo; ujarnya ketika membuka kegiatan Fasilitasi dan Advokasi Kebijakan Penguatan Karakter 2025 di Balai Penjaminan Mutu Pendidikan Provinsi Sumatera Utara, Medan, Senin (15/9).</p>\r\n\r\n<p>Arif mengungkapkan, bahwa pendidikan karakter seyogianya dapat diterapkan melalui dua cara, yaitu dengan mengintegrasikannya ke dalam pembelajaran dan dengan melaksanakan kegiatan kokurikuler yang mendukung proses pembelajaran.</p>\r\n\r\n<p>Menurutnya, Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen) telah mengembangkan pembelajaran mendalam (<em>deep learning</em>) yang juga mencakup pendidikan karakter. &ldquo;Pendidikan karakter yang ada di dalam pembelajaran mendalam itu tidak hanya transfer ilmu, tapi ada kebermaknaan. Anak-anak harus tahu apa yang dipelajari itu bermanfaat untuk kehidupan mereka,&rdquo; tuturnya.</p>\r\n\r\n<p>Selain itu, pendidikan karakter juga harus berkesadaran dan menggembirakan. &ldquo;Menggembirakan itu bagaimana guru bisa membangun suasana pembelajaran yang dapat membangun motivasi dan semangat belajar anak,&rdquo; imbuh Arif.</p>\r\n\r\n<p>Lebih lanjut, Arif mengatakan bahwa pendidikan karakter yang dilakukan melalui kegiatan kokurikuler dapat diwujudkan dalam tiga bentuk, yaitu proyek lintas mata pelajaran, implementasi Gerakan Tujuh Kebiasaan Anak Indonesia Hebat (G7KAIH), serta program-program yang disesuaikan dengan kekhasan masing-masing satuan pendidikan.</p>\r\n\r\n<p><strong>Tanggung Jawab Bersama</strong></p>\r\n\r\n<p>Namun demikian, Arif menegaskan, bahwa pendidikan karakter bukan hanya tanggung jawab satuan pendidikan, melainkan seluruh pemangku kepentingan juga memegang peranan yang sangat penting. Dalam hal ini, Catur Pusat Pendidikan yaitu keluarga, satuan pendidikan, masyarakat, dan media.</p>\r\n\r\n<p>&ldquo;Pendidikan karakter tidak bisa diserahkan ke satuan pendidikan saja, tapi tanggung jawab bersama. Tujuan akhirnya adalah menjadikan anak-anak kita memiliki karakter yang tangguh. Saya berharap dari kegiatan kita hari ini, G7KAIH dapat menjadi program besar Dinas Pendidikan di Sumatera Utara, kita evaluasi dampaknya ke depan,&rdquo; jelasnya.</p>\r\n\r\n<p>Pada kesempatan tersebut, Kepala SMP Negeri 1 Medan, Rohanim, mengatakan bahwa implementasi G7KAIH di satuan pendidikan telah memiliki dampak positif bagi murid. Hal itu terlihat antara lain dari menurunnya jumlah murid yang terlambat hadir ke satuan pendidikan.</p>\r\n\r\n<p>&ldquo;Anak-anak yang biasa terlambat sekarang mulai berkurang. Kami tanyakan ke orang tua itu karena mereka (anak-anak) sekarang tidurnya lebih cepat, tidak lagi asik bermain gadget di malam hari. Ini menjadi salah satu pembiasaan baik bagi anak&ndash;anak yang ada di dalam G7KAIH yaitu tidur cepat,&rdquo; tutur Rohanim.</p>\r\n\r\n<p>Ia pun menyatakan bahwa keberhasilan implementasi G7KAIH juga memerlukan peran dari orang tua, terutama dalam membimbing dan membiasakan anak dari rumah. Tidak sekadar memberikan paraf di dalam jurnal harian, namun juga memastikan anak menanamkan nilai-nilai karakter lewat pembiasaan 7KAIH.&nbsp;</p>\r\n\r\n<p>Senada dengan Rohanim, Kepala Bidang Pembinaan SMA Dinas Pendidikan Sumatera Utara, M. Basir Hasibuan, menekankan pentingnya peran lintas sektoral dalam implementasi G7KAIH. Ia berharap G7KAIH dapat diimplementasikan di seluruh satuan pendidikan dan terutama menjadi kebiasaan baik bagi murid.</p>\r\n\r\n<p>&ldquo;Setelah dari kegiatan ini, kami dari Dinas Pendidikan akan membuat Surat Edaran menindaklanjuti Surat Edaran Menteri Pendidikan Dasar dan Menengah tentang Pembiasaan G7KAIH dan mekanisme untuk melihat implementasinya apakah sudah berjalan dengan baik di satuan pendidikan atau belum,&rdquo; pungkasnya.</p>\r\n\r\n<p>Kegiatan Fasilitasi dan Advokasi Kebijakan Penguatan Karakter 2025 yang diselenggarakan di Balai Penjaminan Mutu Pendidikan Provinsi Sumatera Utara dihadiri oleh perwakilan dari berbagai pihak, di antaranya Dinas Pendidikan Provinsi dan Kabupaten/Kota di Sumatera Utara, Musyawarah Kerja Kepala Sekolah (MKKS) dan Komite Sekolah SMA, SMK, SLB, Komunitas <em>Parenting</em>, Organisasi Keagamaan, Ikatan Guru Taman Kanak-Kanak Indonesia (IGTKI), Himpunan Pendidik dan Tenaga Kependidikan Anak Usia Dini Indonesia (HIMPAUDI), dan juga media sebagai bagian dari catur pusat pendidikan.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://kemdikdasmen.go.id</strong></p>\r\n', 'berita-20260131180000-4831.png', '0f003432039a1a3e7ad977800f2e392f.jpg', '2026-01-31 11:00:00', 1, 58, 'Tidak', 'Posting'),
(83, 'digitalisasi-pembelajaran-percepat-pemerataan-mutu-pendidikan-di-indonesia-1284027058', '2025-09-24 17:59:46', '2025-09-24', 'Administrator', 'Digitalisasi Pembelajaran Percepat Pemerataan Mutu Pendidikan di Indonesia', '<p><strong>Surabaya,</strong> <strong>Kemendikdasmen</strong>&nbsp;&mdash; Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen) terus memperkuat komitmen menghadirkan pendidikan bermutu untuk semua melalui program Digitalisasi Pembelajaran. Wakil Menteri Pendidikan Dasar dan Menengah (Wamendikdasmen), Fajar Riza Ul Haq, menegaskan bahwa langkah ini merupakan bagian dari kebijakan Presiden Republik Indonesia, Prabowo Subianto, untuk mempercepat pemerataan kualitas pendidikan di seluruh wilayah Indonesia.<br />\r\n&nbsp;<br />\r\n&ldquo;Sejak awal kami diminta untuk mendorong Digitalisasi Pembelajaran, salah satunya melalui distribusi Papan Interaktif Digital atau&nbsp;<em>I</em><em>nteractive Flat Panel</em> (IFP). Dengan teknologi ini, anak-anak di seluruh daerah di Indonesia, akan bisa mengakses konten pembelajaran yang sama dengan anak-anak di kota besar,&rdquo; ujar Wamen Fajar dalam sambutannya pada kegiatan Bimbingan Teknis Digitalisasi Pembelajaran di Surabaya, Rabu (17/9).<br />\r\n&nbsp;<br />\r\nWamen Fajar menjelaskan, salah satu masalah utama pendidikan Indonesia adalah ketimpangan mutu antarwilayah. Kehadiran IFP diyakini dapat membantu mengurangi kesenjangan tersebut. &ldquo;Kata kuncinya adalah konten pembelajaran yang sama untuk semua anak Indonesia. Namun keberhasilannya tetap tergantung pada kompetensi pedagogis digital guru. Jangan sampai perangkat ini hanya jadi hiasan. Guru tetap memegang peran utama dalam menghidupkan suasana kelas,&rdquo; tegasnya.<br />\r\n&nbsp;<br />\r\nTahun 2025 pemerintah menyalurkan 288 ribu unit IFP, termasuk lebih dari 64 ribu untuk satuan PAUD, sebagai bagian dari revitalisasi infrastruktur pendidikan. Perangkat ini tidak hanya menampilkan gambar, suara, dan video, tetapi juga memungkinkan pembelajaran lebih interaktif dan menyenangkan. Menurut Wamen Fajar, kehadiran teknologi harus membuat anak lebih aktif, terstimulasi, dan termotivasi dalam proses belajar.<br />\r\n&nbsp;<br />\r\nMeski demikian, Wamen Fajar mengingatkan risiko penggunaan layar berlebihan. &ldquo;Menurut penelitian, batas maksimum anak-anak melihat layar adalah satu jam. Jangan sampai gara-gara ada IFP, anak-anak menjadi malas bergerak. Interaksi fisik dan motorik tetap harus didorong,&rdquo; jelasnya.<br />\r\n&nbsp;<br />\r\nIa juga menekankan bahwa teknologi digital seperti gawai dan internet ibarat pisau bermata dua, dapat memberi manfaat bila digunakan dengan benar, namun berpotensi menimbulkan dampak negatif bila tidak didampingi.<br />\r\n&nbsp;<br />\r\nSementara itu, Ketua Panitia Pelaksana Bimbingan Teknis Digitalisasi Pembelajaran, Mareta Wahyuni, dalam laporannya menyampaikan bahwa program ini dilaksanakan berdasarkan Instruksi Presiden Nomor 7 Tahun 2025 tentang Revitalisasi Satuan Pendidikan dan implementasi Digitalisasi Pembelajaran. &ldquo;Digitalisasi Pembelajaran bukan hanya menghadirkan perangkat, melainkan membangun ekosistem pembelajaran berbasis digital yang utuh, mencakup teknologi, ketersediaan konten, dukungan lingkungan belajar, dan strategi pedagogis,&rdquo; jelasnya.<br />\r\n&nbsp;<br />\r\nDirektorat PAUD menyiapkan skema penguatan kapasitas bagi satuan penerima IFP, antara lain 1) Bimbingan teknis luring kepada 2.160 satuan PAUD; 2) Bimbingan teknis bersama 34 UPT luring untuk 3.240 satuan PAUD; 3) Bimbingan teknis daring kepada 58.791 satuan PAUD; dan 4) Webinar dengan 10 tema terkait pemanfaatan IFP, konten digital interaktif, dan perawatan perangkat.<br />\r\n&nbsp;<br />\r\nHingga Agustus 2025, sebanyak 150 narasumber telah dilatih sebagai fasilitator nasional. Pada pekan ini, bimbingan teknis diberikan secara serentak kepada 720 satuan PAUD penerima IFP di Surabaya, Bogor, dan Padang, dengan 120 peserta hadir di Surabaya. Tujuan kegiatan ini antara lain meningkatkan pemahaman penggunaan IFP, mengembangkan metode pengajaran digital sesuai karakteristik anak usia dini, serta mendorong praktik pembelajaran inklusif dan interaktif.<br />\r\n&nbsp;<br />\r\nWamen Fajar menekankan bahwa Digitalisasi Pembelajaran harus berjalan seiring dengan peningkatan kapasitas guru. Karena itu, pemerintah juga menyiapkan program Revitalisasi Satuan Pendidikan, beasiswa S1/D4 untuk guru PAUD dan jenjang lain, serta program profesi guru (PPG). Langkah ini diharapkan mampu memperkuat kompetensi guru agar dapat mengintegrasikan teknologi ke dalam pembelajaran secara efektif.<br />\r\n&nbsp;<br />\r\n&ldquo;Digitalisasi Pembelajaran adalah jalan menuju pembelajaran yang interaktif, inklusif, dan kontekstual. Dengan dukungan perangkat, konten, serta kompetensi guru yang terus diperkuat, kita optimistis pemerataan mutu pendidikan di Indonesia dapat dipercepat,&rdquo; tutup Wamen Fajar.</p>\r\n\r\n<p><strong>Sumber :&nbsp;https://kemdikdasmen.go.id</strong></p>\r\n', 'berita-20260131175946-5363.jpg', 'afe1b17671bb1463846b6022f2bacdc8.jpg', '2026-01-31 10:59:46', 1, 58, 'Tidak', 'Posting');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galeri`
--

CREATE TABLE `tbl_galeri` (
  `id_galeri` int(11) NOT NULL,
  `judul_galeri` varchar(255) NOT NULL,
  `galeri_tgl` varchar(20) NOT NULL,
  `galeri_tgl_edit` varchar(20) NOT NULL,
  `galeri_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tampil` varchar(11) NOT NULL,
  `galeri_author` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`id_galeri`, `judul_galeri`, `galeri_tgl`, `galeri_tgl_edit`, `galeri_img`, `created_at`, `tampil`, `galeri_author`, `user_id`) VALUES
(1, 'Champion of ASIAFI ', '2026-01-19 17:54:49', '2026-01-19', 'Galeri-20260131175449-8855.jpg', '2026-01-31 10:54:49', 'Ya', 'Administrator', 58),
(2, 'Champion of INASSOC', '2026-01-19 17:54:37', '2026-01-19', 'Galeri-20260131175437-9534.jpg', '2026-01-31 10:54:37', 'Ya', 'Administrator', 58),
(3, 'Champion of ASPINA', '2026-01-19 17:55:02', '2026-01-19', 'Galeri-20260131175502-1893.jpg', '2026-01-31 10:55:02', 'Ya', 'Administrator', 58),
(4, 'Champion of FESPATI', '2026-01-19 17:54:01', '2026-01-19', 'Galeri-20260131175401-1645.jpg', '2026-01-31 10:54:01', 'Ya', 'Administrator', 58),
(5, 'Champion of ULD', '2026-01-19 17:53:37', '2026-01-19', 'Galeri-20260131175337-7846.jpg', '2026-01-31 10:53:37', 'Ya', 'Administrator', 58),
(6, 'Champion of KBI', '2026-01-19 22:55:41', '2026-01-19', 'Galeri-20260131175111-5975.jpg', '2026-01-31 15:55:41', 'Ya', 'Administrator', 58);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instansi`
--

CREATE TABLE `tbl_instansi` (
  `id_instansi` int(11) NOT NULL,
  `nama_lembaga` varchar(255) NOT NULL,
  `prolog` text NOT NULL,
  `sejarah` text NOT NULL,
  `pimpinan_img` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telpon` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `instragram` varchar(200) NOT NULL,
  `no_wa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `nama_lembaga`, `prolog`, `sejarah`, `pimpinan_img`, `alamat`, `no_telpon`, `email`, `facebook`, `instragram`, `no_wa`) VALUES
(1, 'KORMI Brebes', '<b>Komite Olahraga Masyarakat Indonesia (KORMI)</b> adalah lembaga yang menaungi berbagai induk olahraga (Inorga) rekreasi di Indonesia. Olahraga rekreasi adalah salah satu jenis olahraga yang diatur dalam UU Nomor 5 Tahun 2005 tentang Sistem Keolahragaan Nasional. Dalam UU tersebut, sistem keolahragaan nasional dibagi menjadi olahraga pendidikan, olahraga prestasi dan olahraga rekreasi. Atlet olahraga rekreasi sering disebut sebagai pegiat olahraga. KORMI merupakan anggota TAFISA, organisasi internasional yang menyebarluaskan gerakan Sport for All di dunia yang bertujuan agar olahraga dilakukan oleh semua orang dari segala usia dan tingkatan ekonomi. TAFISA bersama KORMI (saat itu bernama FORMI) dan Kemenpora menyelenggarakan TAFISA World Games edisi ke-6 pada tahun 2016 di Jakarta.</p>\r\n', '<b>KORMI</b> bermula dari <b>Federasi Olahraga Masyarakat Indonesia (FOMI)</b> yang didirikan oleh beberapa induk organisasi olahraga. Seiring berkembangnya waktu dan dinamika di Pemerintahan, FOMI pun bertransformasi menjadi <b>Federasi Olahraga Rekreasi Masyarakat Indonesia (FORMI)</b> dan pada tahun 2020 kembali melakukan perubahan menjadi <b>Komite Olahraga Rekreasi Masyarakat Indonesia</b> atau <b>KORMI</b> dan ditahun 2022 melakukan perubahan lagi dengan menghapuskan kata Rekreasi dan menjadi Komite Olahraga Masyarakat Indonesia melalui proses Musyawarah Nasional Luar Biasa (Munaslub) yang diselenggarakan pada hari Rabu 22 Februari 2023. ', 'profil-20260201212328-4165.jpeg', 'Komplek Stadion Karangbirahi\r\nJl. Veteran, Kaumanbaru, Kecamatan Brebes, \r\nKabupaten Brebes - Jawa Tengah (52212)', '0', 'kormi.brebeskab@gmail.com', ' kormi_brebes', 'kormi_brebes', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `id_komentar` bigint(20) NOT NULL,
  `blog_id` varchar(25) NOT NULL,
  `komentar_nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `komentar_isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`id_komentar`, `blog_id`, `komentar_nama`, `created_at`, `komentar_isi`) VALUES
(2, '33', 'ashiaaap', '2020-07-26 02:31:10', 'asahsasojaojsoasas'),
(3, '34', 'ashiap', '2021-06-02 09:25:43', 'asasasassmd'),
(4, '1', 'okasas', '2021-07-09 19:15:44', 'asasas\r\nasasasasa'),
(5, '2', 'aris', '2025-01-20 01:21:59', 'test'),
(6, '7', 'haloo', '2025-01-20 07:55:56', 'tessss'),
(9, '21', 'aris', '2025-02-01 09:47:06', 'aris'),
(10, '30', 'assdads', '2025-02-01 15:01:46', 'asdsadsd'),
(17, '30', 'dassda', '2025-02-02 01:54:53', 'sadsdads'),
(18, '30', 'sadsda', '2025-02-02 01:55:42', 'sadsda'),
(19, '30', 'sadsda', '2025-02-02 01:56:02', 'sadsda'),
(20, '30', 'xxxx\'xxx', '2025-02-02 01:56:33', 'xxxx\'xxxx'),
(21, '30', 'aSSAaS', '2025-02-02 01:58:10', 'Asas'),
(22, '30', 'SADSAD', '2025-02-02 01:58:26', 'SADSADAS'),
(23, '30', 'Aris', '2025-02-02 02:33:43', 'Haloooo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_activity`
--

CREATE TABLE `tbl_log_activity` (
  `id_log_activity` int(11) NOT NULL,
  `log_activity_name` varchar(255) DEFAULT NULL,
  `log_activity_user` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode` varchar(200) NOT NULL,
  `browser_pengguna` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pertanyaan`
--

CREATE TABLE `tbl_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `tampil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pertanyaan`
--

INSERT INTO `tbl_pertanyaan` (`id_pertanyaan`, `pertanyaan`, `jawaban`, `created_at`, `user_id`, `tampil`) VALUES
(1, 'Apa itu KORMI ?', 'KORMI merupakan satu-satunya wadah berhimpun dari organisasi-organisasi olahraga rekreasi yang tumbuh dan berkembang di masyarakat, baik secara nasional maupun di daerah, menjadi mitra strategis pemerintah, pemerintah daerah dan masyarakat dalam kerangka mendorong dan menggerakkan pembinaan dan pengembangan olahraga rekreasi di seluruh indonesia. ', '2026-01-29 12:03:16', 58, 'Ya'),
(2, 'Apa Landasan Hukumnya ?', 'Kegiatan KORMI berlandaskan pada Undang-Undang Nomor 11 Tahun 2022 tentang Keolahragaan. Dalam UU ini, Olahraga dibagi menjadi tiga pilar yaitu Olahraga Pendidikan, Olahraga Prestasi (di bawah KONI), Olahraga Masyarakat (di bawah KORMI). ', '2026-01-29 12:03:22', 58, 'Ya'),
(3, 'Apa Perbedaan KORMI dengan KONI?', ' KONI (Komite Olahraga Nasional Indonesia): Berfokus pada olahraga prestasi/olahraga Olimpiade dengan tujuan medali dan pemecahan rekor.<br><br>\r\nKORMI: Berfokus pada olahraga yang bersifat massal, kegembiraan, pelestarian budaya, dan kesehatan (tidak semata-mata mencari juara, tetapi lebih ke partisipasi).', '2026-01-29 12:03:27', 58, 'Ya'),
(4, 'Apa Saja Jenis Olahraga di KORMI ?', 'Olahraga di bawah naungan KORMI dikelompokkan ke dalam tiga kategori utama yaitu :\r\n<ol>\r\n<li>Olahraga Tradisional dan Kreasi Budaya, seperti : Egrang, Tarik Tambang, Pencak Silat Budaya, Senam Kreasi.</li>\r\n<li>Olahraga Kesehatan dan Kebugaran, seperti : Senam Tera, Senam Jantung Sehat, Yoga, Zumba.</li>\r\n<li>Olahraga Petualangan dan Tantangan, seperti : Skateboard, BMX, Airsoft Gun, Panahan Tradisional, E-sports.</li>\r\n</ol> ', '2026-01-29 12:03:33', 58, 'Ya'),
(5, 'Bagaimana Cara Bergabung ?', 'Masyarakat dapat bergabung melalui Induk Organisasi Olahraga (INORGA) yang terdaftar di KORMI di wilayah masing-masing (Provinsi atau Kabupaten/Kota).<br><br>\r\nInformasi lebih lanjut mengenai kegiatan terbaru dapat diakses melalui laman resmi KORMI Nasional.', '2026-01-29 12:03:39', 58, 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` smallint(6) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `failed_login_attempts` int(11) NOT NULL DEFAULT 0,
  `last_login_attempt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `nama_pengguna`, `email`, `password`, `level`, `date_created`, `failed_login_attempts`, `last_login_attempt`) VALUES
(58, 'admin', 'Administrator', 'arieswahyoe87@gmail.com', '$2y$10$EGGsEgxSnhnHIPifviu/DOsOl6g.w8CyAsAX9AUgJ3MMHZHhW71oa', 'admin', '2026-02-03 08:08:29', 0, '2026-02-03 15:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `id_video` int(11) NOT NULL,
  `judul_video` varchar(255) NOT NULL,
  `link_video` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `video_img` varchar(200) NOT NULL,
  `tampil` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`id_video`, `judul_video`, `link_video`, `nama_file`, `video_img`, `tampil`, `user_id`, `created_at`) VALUES
(5, 'Lomba Tradisional Hut RI Ke 79', 'http://localhost/webkormi/assets/video/', 'lomba-kormi.mp4', 'video-20260131180623-7901.jpg', 'Ya', 58, '2026-01-31 11:06:23'),
(6, 'Senam Sate Blengon Khas Brebes', 'http://localhost/webkormi/assets/video/', 'sate-blengong.mp4', 'video-20260131180614-2875.jpg', 'Ya', 58, '2026-01-31 11:06:14'),
(7, 'FORDA Jawa Tengah Tahun 2025', 'http://localhost/webkormi/assets/video/', 'forda-jateng-2025.mp4', 'video-20260131180605-6059.jpg', 'Ya', 58, '2026-01-31 11:06:05'),
(8, 'FORKAB Kabupaten Tahun 2025', 'http://localhost/webkormi/assets/video/', 'forkab-brebes-2025.mp4', 'video-20260131180555-6801.jpg', 'Ya', 58, '2026-01-31 11:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_video_header`
--

CREATE TABLE `tb_video_header` (
  `id_video` int(11) NOT NULL,
  `judul_video` varchar(200) NOT NULL,
  `link_video` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `sambutan` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_video_header`
--

INSERT INTO `tb_video_header` (`id_video`, `judul_video`, `link_video`, `nama_file`, `sambutan`, `user_id`, `created_at`) VALUES
(1, 'KORMI Kabupaten Brebes', 'http://localhost/webkormi/assets/video/', 'forkab-brebes-2025.mp4', 'KORMI merupakan satu-satunya wadah berhimpun dari organisasi-organisasi olahraga rekreasi yang tumbuh dan berkembang di masyarakat, baik secara nasional maupun di daerah, menjadi mitra strategis pemerintah, pemerintah daerah dan masyarakat dalam kerangka mendorong dan menggerakkan pembinaan dan pengembangan olahraga rekreasi di seluruh Indonesia. ', 58, '2026-01-31 08:08:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `tbl_balasan`
--
ALTER TABLE `tbl_balasan`
  ADD PRIMARY KEY (`id_balasan`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indexes for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `tbl_log_activity`
--
ALTER TABLE `tbl_log_activity`
  ADD PRIMARY KEY (`id_log_activity`);

--
-- Indexes for table `tbl_pertanyaan`
--
ALTER TABLE `tbl_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`id_video`);

--
-- Indexes for table `tb_video_header`
--
ALTER TABLE `tb_video_header`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_agenda`
--
ALTER TABLE `tbl_agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_balasan`
--
ALTER TABLE `tbl_balasan`
  MODIFY `id_balasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id_blog` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `id_komentar` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_log_activity`
--
ALTER TABLE `tbl_log_activity`
  MODIFY `id_log_activity` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pertanyaan`
--
ALTER TABLE `tbl_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_video_header`
--
ALTER TABLE `tb_video_header`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
