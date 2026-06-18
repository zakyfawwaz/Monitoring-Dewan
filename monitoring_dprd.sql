-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2026 at 08:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_dprd`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `anggota_dewan_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('paripurna','komisi','fraksi','pansus','reses','aspirasi','sosialisasi','monitoring','inspeksi','audiensi','seminar','mendadak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_kegiatan` text COLLATE utf8mb4_unicode_ci,
  `dokumentasi_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dibuat_oleh` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `anggota_dewan_id`, `tanggal`, `waktu`, `nama_kegiatan`, `kategori`, `lokasi`, `deskripsi_kegiatan`, `dokumentasi_foto`, `dibuat_oleh`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-03-28', '15:30:00', 'Kunjungan Kerja Mendadak ke RSUD', 'mendadak', 'RSUD Kardinah Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(2, 3, '2026-04-28', '10:00:00', 'Rapat Komisi I — Pembahasan APBD', 'komisi', 'Ruang Komisi I DPRD', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(3, 4, '2026-03-13', '13:00:00', 'Rapat Pansus Perda Pendidikan', 'pansus', 'Gedung DPRD Kota Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(4, 2, '2026-04-16', '10:00:00', 'Audiensi dengan Dinas Pendidikan', 'audiensi', 'Kantor Dinas Pendidikan', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(5, 3, '2026-04-13', '09:00:00', 'Kunjungan Kerja Mendadak ke RSUD', 'mendadak', 'RSUD Kardinah Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(6, 3, '2026-05-12', '15:30:00', 'Rapat Fraksi PKS — Konsolidasi', 'fraksi', 'Ruang Fraksi PKS', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(7, 3, '2026-04-17', '14:00:00', 'Rapat Fraksi PKS — Konsolidasi', 'fraksi', 'Ruang Fraksi PKS', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(8, 1, '2026-05-28', '09:00:00', 'Monitoring Pembangunan Jalan', 'monitoring', 'Jl. Proklamasi, Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(9, 4, '2026-04-23', '08:00:00', 'Rapat Komisi II — Bidang Ekonomi', 'komisi', 'Ruang Komisi II DPRD', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(10, 5, '2026-03-12', '09:00:00', 'Inspeksi Pasar Pagi Kota Tegal', 'inspeksi', 'Pasar Pagi Kota Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(11, 5, '2026-05-03', '10:00:00', 'Rapat Paripurna DPRD Kota Tegal', 'paripurna', 'Gedung DPRD Kota Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(12, 3, '2026-04-24', '10:00:00', 'Kunjungan Kerja Mendadak ke RSUD', 'mendadak', 'RSUD Kardinah Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(13, 5, '2026-04-21', '09:00:00', 'Audiensi dengan Dinas Pendidikan', 'audiensi', 'Kantor Dinas Pendidikan', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(14, 1, '2026-03-31', '09:00:00', 'Audiensi dengan Dinas Pendidikan', 'audiensi', 'Kantor Dinas Pendidikan', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(15, 3, '2026-05-12', '08:00:00', 'Monitoring Pembangunan Jalan', 'monitoring', 'Jl. Proklamasi, Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(16, 5, '2026-05-05', '14:00:00', 'Penjaringan Aspirasi Masyarakat', 'aspirasi', 'Kecamatan Tegal Barat', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(17, 4, '2026-03-30', '13:00:00', 'Rapat Paripurna DPRD Kota Tegal', 'paripurna', 'Gedung DPRD Kota Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(18, 2, '2026-03-18', '15:30:00', 'Sosialisasi Perda Kesehatan', 'sosialisasi', 'Balai Desa Kejambon', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(19, 3, '2026-03-20', '09:00:00', 'Kunjungan Kerja Mendadak ke RSUD', 'mendadak', 'RSUD Kardinah Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(20, 5, '2026-05-10', '14:00:00', 'Sosialisasi Program Bantuan UMKM', 'sosialisasi', 'Aula Kecamatan Tegal Timur', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(21, 4, '2026-03-15', '10:00:00', 'Seminar Nasional Legislasi Daerah', 'seminar', 'Hotel Grand Karlita, Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(22, 3, '2026-03-24', '09:00:00', 'Audiensi dengan Dinas Pendidikan', 'audiensi', 'Kantor Dinas Pendidikan', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(23, 3, '2026-06-07', '15:30:00', 'Rapat Pansus Perda Pendidikan', 'pansus', 'Gedung DPRD Kota Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(24, 5, '2026-04-26', '14:00:00', 'Seminar Nasional Legislasi Daerah', 'seminar', 'Hotel Grand Karlita, Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(25, 3, '2026-06-08', '15:30:00', 'Reses di Kelurahan Margadana', 'reses', 'Kelurahan Margadana', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', 'aktivitas/wOCmm9ZEAjj3ROqbvvioAf3AiRu1fGoO8XLoteDs.jpg', 1, '2026-06-08 00:26:45', '2026-06-08 20:21:06'),
(26, 3, '2026-04-24', '08:00:00', 'Inspeksi Pasar Pagi Kota Tegal', 'inspeksi', 'Pasar Pagi Kota Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(27, 2, '2026-05-23', '08:00:00', 'Monitoring Pembangunan Jalan', 'monitoring', 'Jl. Proklamasi, Tegal', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(28, 4, '2026-05-08', '13:00:00', 'Sosialisasi Perda Kesehatan', 'sosialisasi', 'Balai Desa Kejambon', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(29, 4, '2026-05-07', '10:00:00', 'Rapat Komisi II — Bidang Ekonomi', 'komisi', 'Ruang Komisi II DPRD', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(30, 3, '2026-05-27', '08:00:00', 'Rapat Fraksi PKS — Konsolidasi', 'fraksi', 'Ruang Fraksi PKS', 'Kegiatan dilaksanakan sesuai jadwal yang telah ditetapkan.', NULL, 1, '2026-06-08 00:26:45', '2026-06-08 00:26:45'),
(31, 1, '2026-06-10', '10:00:00', 'Paripurna Penetapan Raperda Penyelenggaraan Ketahanan Pangan dan Raperda Penyelenggaraan Penanaman Modal', 'paripurna', 'Ruang Rapat Paripurna', 'Ketahanan pangan adalah persoalan kedaulatan. Bagi Kota Tegal yang memiliki keterbatasan lahan, ketahanan pangan tidak bisa hanya mengandalkan produksi lokal, namun harus didukung sistem distribusi yang kuat dan manajemen cadangan pangan yang tanggap. \r\nSebelum kami menyampaikan Pendapat Akhir, izinkan kami mengucapkan Selamat Hari Lingkungan Hidup yang diperingati 5 Juni. Momentum ini menjadi pengingat bagi kita semua untuk terus menjaga kelestarian ekosistem laut, sebagai tumpuan utama kehidupan nelayan dan masa depan ketahanan pangan kita. \r\nFraksi PKS memandang bahwa paradigma ketahanan pangan di Kota Tegal harus segera bergeser dari ketergantungan pada komoditas beras menuju diversifikasi pangan yang berbasis pada keunggulan lokal, yakni sektor perikanan tangkap dan pengolahan hasil laut. Mengingat potensi besar yang dimiliki Kota Tegal, kami menyampaikan pandangan dan langkah strategis sebagai berikut:\r\n1. Fraksi PKS mendorong Pemerintah Kota Tegal untuk secara sistematis meningkatkan konsumsi ikan di masyarakat sebagai sumber utama protein hewani. Kami mendesak agar program \"Gemar Makan Ikan\" menjadi gerakan masif yang menyasar institusi pendidikan serta unit keluarga. Edukasi mengenai urgensi gizi ikan harus menjadi bagian dari upaya kita bersama dalam menekan angka stunting dan menciptakan generasi yang sehat serta cerdas.\r\n2. Fraksi PKS menyoroti pentingnya pengembangan ekosistem industri pengolahan ikan di dalam daerah. Kami berpendapat bahwa nilai tambah ekonomi harus tetap berputar di Kota Tegal. Oleh karena itu, Pemerintah Kota wajib memfasilitasi penguatan kapasitas UMKM pengolahan ikan agar mampu menghasilkan produk bernilai jual tinggi, sehingga kita tidak hanya menjadi eksportir bahan mentah, tetapi juga produsen produk olahan yang berdaya saing.\r\n3. Ketahanan pangan tidak akan terwujud tanpa efisiensi distribusi. Fraksi PKS menekankan perlunya jaminan keberlangsungan rantai dingin (cold chain) yang terintegrasi, mulai dari nelayan di pelabuhan hingga sampai ke tangan konsumen. Investasi pada penyediaan gudang pendingin (cold storage) dan sarana transportasi berpendingin yang memadai adalah kewajiban pemerintah untuk meminimalisasi tingkat kerusakan hasil laut dan menjaga stabilitas harga di tingkat nelayan maupun konsumen.\r\n4. Fraksi PKS menekankan agar Pemerintah Kota tidak hanya sekadar menetapkan cadangan pangan sebagai regulasi semata. Kami mendesak agar Dinas terkait memastikan bahwa mekanisme cadangan pangan (yang termuat pada Pasal 7-13) benar-benar operasional, terutama dalam mengantisipasi gejolak harga dan keadaan darurat pangan yang seringkali membebani masyarakat berpenghasilan rendah.\r\nKedua, RAPERDA TENTANG PENYELENGGARAAN PENANAMAN MODAL\r\nPenanaman modal harus dipandang sebagai lokomotif untuk menyejahterakan masyarakat Tegal, bukan sekadar angka statistik investasi yang tinggi namun minim serapan tenaga kerja lokal.\r\n1.	Fraksi PKS memberikan catatan pada Pasal 23-29 mengenai Kemitraan dengan UMKM. Investasi besar yang masuk ke Kota Tegal wajib melibatkan pelaku UMKM lokal. Jangan sampai UMKM hanya menjadi penonton di tanah sendiri. Kami meminta pengawasan ketat terhadap kewajiban kemitraan ini. \r\n2.	Sistem OSS harus mempermudah, bukan mempesulit. Kami meminta Pemerintah Kota Tegal menjamin bahwa pelayanan penanaman modal tetap memberikan ruang bagi pelaku usaha mikro untuk bertumbuh, serta memastikan bahwa setiap investasi yang masuk wajib memperhatikan aspek lingkungan dan kearifan lokal Tegal. \r\n3.	Kami mendukung ketegasan sanksi administratif bagi penanam modal yang melanggar kewajiban (sebagaimana tercantum pada Pasal 19-20). Investasi tetap harus mengedepankan etika; perusahaan yang mengabaikan tanggung jawab sosial dan lingkungan harus diberikan sanksi yang nyata, bukan sekadar peringatan administratif.', NULL, 1, '2026-06-09 20:34:58', '2026-06-09 20:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_staf_administrasi`
--

CREATE TABLE `aktivitas_staf_administrasi` (
  `id` bigint UNSIGNED NOT NULL,
  `staf_administrasi_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dibuat_oleh` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_tenaga_ahli`
--

CREATE TABLE `aktivitas_tenaga_ahli` (
  `id` bigint UNSIGNED NOT NULL,
  `tenaga_ahli_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `dibuat_oleh` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_dewans`
--

CREATE TABLE `anggota_dewans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nikd` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fraksi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PKS',
  `nomor_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggota_dewans`
--

INSERT INTO `anggota_dewans` (`id`, `nama_lengkap`, `nikd`, `jabatan`, `komisi`, `fraksi`, `nomor_hp`, `foto`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'H. Abdul Ghoni, S.E', NULL, 'Ketua Fraksi', 'Komisi III', 'PKS', '081234567001', NULL, 1, '2026-06-08 00:26:42', '2026-06-08 00:49:30'),
(2, 'Hj. Erni Ratnani, S.E.,M.M', NULL, 'Wakil Ketua Fraksi', 'Komisi I', 'PKS', '081234567002', NULL, 1, '2026-06-08 00:26:42', '2026-06-08 00:51:03'),
(3, 'Mochamad Ali Mashuri, S.A.P', NULL, 'Sekretaris Fraksi', 'Komisi III', 'PKS', '081234567003', NULL, 1, '2026-06-08 00:26:42', '2026-06-08 00:52:21'),
(4, 'Zaenal Nurohman, S.A.P', NULL, 'Anggota', 'Komisi II', 'PKS', '081234567004', NULL, 1, '2026-06-08 00:26:42', '2026-06-08 00:54:08'),
(5, 'H. Amiruddin, Lc', NULL, 'Anggota', 'Wakil Ketua DPRD', 'PKS', '081234567005', NULL, 1, '2026-06-08 00:26:42', '2026-06-08 00:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_000000_create_anggota_dewans_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2014_10_12_100001_create_aktivitas_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2024_06_10_000001_create_tenaga_ahli_table', 2),
(8, '2024_06_10_000002_create_staf_administrasi_table', 2),
(9, '2024_06_10_100001_create_aktivitas_tenaga_ahli_table', 3),
(10, '2024_06_10_100002_create_aktivitas_staf_administrasi_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staf_administrasi`
--

CREATE TABLE `staf_administrasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staf_administrasi`
--

INSERT INTO `staf_administrasi` (`id`, `nama_lengkap`, `jabatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hanif Murtadho, S.Pd.', 'Staf Administrasi Fraksi', 1, '2026-06-09 21:49:27', '2026-06-09 21:49:27'),
(2, 'A.Muh Yasier A.R, S.K.M.', 'Staff Administrasi Fraksi PKS', 1, '2026-06-09 21:50:43', '2026-06-09 21:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_ahli`
--

CREATE TABLE `tenaga_ahli` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenaga_ahli`
--

INSERT INTO `tenaga_ahli` (`id`, `nama_lengkap`, `jabatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ali Irfan, S.Pd.I., M.Pd.', 'Tenaga Ahli Fraksi', 1, '2026-06-09 21:48:49', '2026-06-09 21:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `anggota_dewan_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `anggota_dewan_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Fraksi PKS', 'admin@pks-tegal.id', NULL, '$2y$12$GgZS/NUK4INa5TIdOZaXrOUhNHkiOd1BmskHGRDhR5fKJze9LW48S', 'admin', NULL, NULL, '2026-06-08 00:26:42', '2026-06-08 00:26:42'),
(2, 'H. Ahmad Fauzi, S.Ag', 'anggota1@pks-tegal.id', NULL, '$2y$12$sMvDLjB0c4leGAMLomaDsOE/SXn1EBCI5zHMewfQ7dnERmwCPVRli', 'anggota', 1, NULL, '2026-06-08 00:26:43', '2026-06-08 00:26:43'),
(3, 'Dra. Siti Nurhaliza', 'anggota2@pks-tegal.id', NULL, '$2y$12$p7QYdArzsU1JEPsKWR6ScOjFDENTU38lgptCSwbE9/lBEpQg5NWIG', 'anggota', 2, NULL, '2026-06-08 00:26:43', '2026-06-08 00:26:43'),
(4, 'Muhammad Rizki, S.H.', 'anggota3@pks-tegal.id', NULL, '$2y$12$haEIsvDgG.S0ZTVOTlNBbOll0LlwilTTQPwvZR7sEtqIQCQurBxLe', 'anggota', 3, NULL, '2026-06-08 00:26:44', '2026-06-08 00:26:44'),
(5, 'Hj. Fatimah Az-Zahra', 'anggota4@pks-tegal.id', NULL, '$2y$12$T9QtWxXQobaJLxbZDtRAUuGEuA6Pp1EG4hPMedzf8Re8dzPEHf3Me', 'anggota', 4, NULL, '2026-06-08 00:26:44', '2026-06-08 00:26:44'),
(6, 'Ir. Bambang Suryanto', 'anggota5@pks-tegal.id', NULL, '$2y$12$qdu9fjR1myRMH8W/HhmQLeX702WeJpXhEGzV1bNLfiOkuCLxrn5q2', 'anggota', 5, NULL, '2026-06-08 00:26:45', '2026-06-08 00:26:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aktivitas_dibuat_oleh_foreign` (`dibuat_oleh`),
  ADD KEY `aktivitas_tanggal_index` (`tanggal`),
  ADD KEY `aktivitas_kategori_index` (`kategori`),
  ADD KEY `aktivitas_anggota_dewan_id_tanggal_index` (`anggota_dewan_id`,`tanggal`);

--
-- Indexes for table `aktivitas_staf_administrasi`
--
ALTER TABLE `aktivitas_staf_administrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aktivitas_staf_administrasi_dibuat_oleh_foreign` (`dibuat_oleh`),
  ADD KEY `aktivitas_staf_administrasi_tanggal_index` (`tanggal`),
  ADD KEY `aktivitas_staf_administrasi_staf_administrasi_id_tanggal_index` (`staf_administrasi_id`,`tanggal`);

--
-- Indexes for table `aktivitas_tenaga_ahli`
--
ALTER TABLE `aktivitas_tenaga_ahli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aktivitas_tenaga_ahli_dibuat_oleh_foreign` (`dibuat_oleh`),
  ADD KEY `aktivitas_tenaga_ahli_tanggal_index` (`tanggal`),
  ADD KEY `aktivitas_tenaga_ahli_tenaga_ahli_id_tanggal_index` (`tenaga_ahli_id`,`tanggal`);

--
-- Indexes for table `anggota_dewans`
--
ALTER TABLE `anggota_dewans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_dewans_nikd_unique` (`nikd`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `staf_administrasi`
--
ALTER TABLE `staf_administrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenaga_ahli`
--
ALTER TABLE `tenaga_ahli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_anggota_dewan_id_foreign` (`anggota_dewan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `aktivitas_staf_administrasi`
--
ALTER TABLE `aktivitas_staf_administrasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aktivitas_tenaga_ahli`
--
ALTER TABLE `aktivitas_tenaga_ahli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anggota_dewans`
--
ALTER TABLE `anggota_dewans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staf_administrasi`
--
ALTER TABLE `staf_administrasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenaga_ahli`
--
ALTER TABLE `tenaga_ahli`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_anggota_dewan_id_foreign` FOREIGN KEY (`anggota_dewan_id`) REFERENCES `anggota_dewans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aktivitas_dibuat_oleh_foreign` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aktivitas_staf_administrasi`
--
ALTER TABLE `aktivitas_staf_administrasi`
  ADD CONSTRAINT `aktivitas_staf_administrasi_dibuat_oleh_foreign` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aktivitas_staf_administrasi_staf_administrasi_id_foreign` FOREIGN KEY (`staf_administrasi_id`) REFERENCES `staf_administrasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aktivitas_tenaga_ahli`
--
ALTER TABLE `aktivitas_tenaga_ahli`
  ADD CONSTRAINT `aktivitas_tenaga_ahli_dibuat_oleh_foreign` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aktivitas_tenaga_ahli_tenaga_ahli_id_foreign` FOREIGN KEY (`tenaga_ahli_id`) REFERENCES `tenaga_ahli` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_anggota_dewan_id_foreign` FOREIGN KEY (`anggota_dewan_id`) REFERENCES `anggota_dewans` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
