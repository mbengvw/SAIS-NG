-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2026 at 10:56 AM
-- Server version: 10.11.18-MariaDB-cll-lve
-- PHP Version: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u9629718_sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color_class` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `route_name`, `icon`, `color_class`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard Admin', 'admin.dashboard', 'fa-dashboard', 'card-user', 1, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(2, 'Master Siswa', 'siswa.index', 'fa-users', 'card-siswa', 2, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(3, 'Master Kelas', 'kelas.index', 'fa-building', 'card-kelas', 3, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(4, 'Pengkelasan', 'grouping.index', 'fa-sitemap', 'card-grouping', 4, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(5, 'Tahun Akademik', 'tahun.index', 'fa-calendar-check-o', 'card-tahun', 5, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(6, 'Master Hukdis', 'mst_hukdis.index', 'fa-gavel', 'card-hukdis', 6, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(7, 'Manajemen Akun', 'userman.index', 'fa-user-circle', 'card-user', 7, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(8, 'Pengaturan Menu', 'menus.index', 'fa-list-ul', 'card-user', 8, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(9, 'Dashboard Piket', 'piket.index', 'fa-dashboard', 'card-kelas', 8, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(10, 'Absensi', 'presensi.index', 'fa-check-square-o', 'card-siswa', 9, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:45'),
(11, 'Hukuman Disiplin', 'hukdis.index', 'fa-warning', 'card-hukdis', 10, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:54'),
(12, 'Rekap Presensi', 'presensi.rekap', 'fa-file-text-o', 'card-tahun', 11, 1, '2026-08-15 03:44:21', '2026-08-15 03:45:04'),
(13, 'Dashboard Wali Kelas', 'walikelas.index', 'fa-dashboard', 'card-kelas', 12, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(14, 'Jurnal', 'jurnal.index', 'fa-book', 'card-siswa', 13, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(15, 'Absensi Kelas', 'presensi.list', 'fa-list-alt', 'card-tahun', 14, 1, '2026-08-15 03:44:21', '2026-08-15 03:44:21'),
(16, 'Detail Siswa', 'detail-siswa', 'fa-address-card', 'card-siswa', 15, 1, '2026-08-15 03:44:21', '2026-08-15 03:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`menu_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(12, 2),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_28_072244_create_mst_siswa', 1),
(6, '2022_10_28_073509_create_mst_kelas', 1),
(7, '2022_10_28_073530_create_mst_hukdis', 1),
(8, '2022_10_28_073552_create_tst_grouping', 1),
(9, '2022_10_28_073610_create_tst_pelanggaran', 1),
(10, '2022_10_28_073624_create_tst_kehadiran', 1),
(11, '2022_11_24_061526_create_mst_tahun_table', 1),
(12, '2024_06_17_035202_create_students_tabel', 1),
(13, '2024_08_21_010146_create_walikelas_table', 1),
(14, '2026_08_14_035931_create_permission_tables', 1),
(15, '2026_08_15_084619_create_menus_table', 2),
(16, '2026_08_15_084621_create_menu_role_table', 2),
(17, '2026_08_15_102902_drop_legacy_role_columns_from_users', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `mst_hukdis`
--

CREATE TABLE `mst_hukdis` (
  `id_hukdis` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` text NOT NULL,
  `poin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_kelas`
--

CREATE TABLE `mst_kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tingkat` int(11) NOT NULL,
  `paralel` int(11) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_kelas`
--

INSERT INTO `mst_kelas` (`id_kelas`, `id_tahun`, `tahun`, `jurusan`, `tingkat`, `paralel`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 1, 2026, 'IPA', 12, 1, '12.A.1.1', '2026-08-14 02:23:25', '2026-08-15 00:34:02'),
(2, 1, 2026, 'IPA', 12, 2, '12.A.1.2', '2026-08-15 00:34:40', '2026-08-15 00:34:40'),
(3, 1, 2026, 'IPA', 12, 3, '12.A.2.1', '2026-08-15 00:37:43', '2026-08-15 00:37:43'),
(4, 1, 2026, 'IPA', 12, 4, '12.A.2.2', '2026-08-15 00:38:03', '2026-08-15 00:38:03'),
(5, 1, 2026, 'IPS', 12, 5, '12.IPS.1.1', '2026-08-15 00:38:23', '2026-08-18 20:27:48'),
(6, 1, 2026, 'IPS', 12, 6, '12.IPS.1.2', '2026-08-15 00:38:43', '2026-08-18 20:27:43'),
(7, 1, 2026, 'IPS', 12, 7, '12.IPS.2.1', '2026-08-18 20:28:51', '2026-08-18 20:28:51'),
(8, 1, 2026, 'IPS', 12, 8, '12.IPS.2.2', '2026-08-18 20:29:13', '2026-08-18 20:29:13'),
(9, 1, 2026, 'BAHASA', 12, 9, '12 BAHASA', '2026-08-18 20:32:20', '2026-08-18 20:32:20'),
(10, 1, 2026, 'KEAGAMAAN', 12, 10, '12 KEAGAMAAN', '2026-08-18 20:32:51', '2026-08-18 20:32:51'),
(11, 1, 2026, '1', 11, 1, '11.1', '2026-08-19 20:05:36', '2026-08-19 20:05:36'),
(12, 1, 2026, '2', 11, 2, '11.2', '2026-08-19 20:06:07', '2026-08-19 20:06:07'),
(13, 1, 2026, '3', 11, 3, '11.3', '2026-08-19 20:06:20', '2026-08-19 20:06:20'),
(14, 1, 2026, '4', 11, 4, '11.4', '2026-08-19 20:06:35', '2026-08-19 20:06:35'),
(15, 1, 2026, '5', 11, 5, '11.5', '2026-08-19 20:06:52', '2026-08-19 20:06:52'),
(16, 1, 2026, '6', 11, 6, '11.6', '2026-08-19 20:07:07', '2026-08-19 20:07:07'),
(17, 1, 2026, '7', 11, 7, '11.7', '2026-08-19 20:07:20', '2026-08-19 20:07:20'),
(18, 1, 2026, '8', 11, 8, '11.8', '2026-08-19 20:07:37', '2026-08-19 20:07:37'),
(19, 1, 2026, '9', 11, 9, '11.9', '2026-08-19 20:07:51', '2026-08-19 20:07:51'),
(20, 1, 2026, '10', 11, 10, '11.10', '2026-08-19 20:08:06', '2026-08-19 20:08:06'),
(21, 1, 2026, 'A', 10, 1, '10.A', '2026-08-19 20:09:09', '2026-08-19 20:09:09'),
(22, 1, 2026, 'B', 10, 2, '10.B', '2026-08-19 20:09:25', '2026-08-19 20:09:25'),
(23, 1, 2026, 'C', 10, 3, '10.C', '2026-08-19 20:09:43', '2026-08-19 20:09:43'),
(24, 1, 2026, 'D', 10, 4, '10.D', '2026-08-19 20:09:59', '2026-08-19 20:09:59'),
(25, 1, 2026, 'E', 10, 5, '10.E', '2026-08-19 20:10:16', '2026-08-19 20:10:16'),
(26, 1, 2026, 'F', 10, 6, '10.F', '2026-08-19 20:10:31', '2026-08-19 20:10:31'),
(27, 1, 2026, 'G', 10, 7, '10.G', '2026-08-19 20:10:50', '2026-08-19 20:10:50'),
(28, 1, 2026, 'H', 10, 8, '10.H', '2026-08-19 20:11:04', '2026-08-19 20:11:04'),
(29, 1, 2026, 'I', 10, 9, '10.I', '2026-08-19 20:11:22', '2026-08-19 20:11:22'),
(30, 1, 2026, 'J', 10, 10, '10.J', '2026-08-19 20:11:36', '2026-08-19 20:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `mst_siswa`
--

CREATE TABLE `mst_siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `no_daftar` varchar(20) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `jalur` enum('REGULER','PRESTASI','PINDAHAN') NOT NULL,
  `asal_sltp` varchar(300) NOT NULL,
  `status` enum('A','T') NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_tahun`
--

CREATE TABLE `mst_tahun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `semester` smallint(6) NOT NULL,
  `alias_tahun` varchar(10) NOT NULL,
  `is_active` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_tahun`
--

INSERT INTO `mst_tahun` (`id`, `tahun`, `semester`, `alias_tahun`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2026', 1, '20261', 1, '2026-08-14 02:22:19', '2026-08-14 02:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-08-14 02:20:06', '2026-08-14 02:20:06'),
(2, 'guru-piket', 'web', '2026-08-14 02:20:06', '2026-08-14 02:20:06'),
(3, 'wali-kelas', 'web', '2026-08-14 02:20:06', '2026-08-14 02:20:06'),
(4, 'guru-mapel', 'web', '2026-08-14 02:20:06', '2026-08-14 02:20:06'),
(5, 'siswa', 'web', '2026-08-14 02:20:06', '2026-08-14 02:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tahun_masuk` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'A',
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nama`, `nisn`, `nik`, `tahun_masuk`, `tempat_lahir`, `tanggal_lahir`, `status`, `jenis_kelamin`, `alamat`, `nama_ayah`, `nama_ibu`, `nama_wali`, `created_at`, `updated_at`) VALUES
(1, 'ADE TRIANI RAHAYUNINGTYAS', '3085686018', '3208054311080002', '2024', 'KUNINGAN', '2008-11-03', 'A', 'P', 'sindangjawa rt06/rw05 dusun III', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(2, 'AFIF SHALAHUDIN', '94926487', '3208062410080001', '2024', 'BEKASI', '2008-10-24', 'A', 'L', 'BLOK WAGE RT/04. RW/02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(3, 'AGNES TRY YULIASTUTI', '91174888', '3212046305090001', '2024', 'INDRAMAYU', '2009-05-23', 'A', '', 'Dusun II RT 010 RW 003 Bantarpanjang Cibingbin', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(4, 'ALISA APRILIATUN NAZWA', '94357410', '3208056504090001', '2024', 'KUNINGAN', '2009-04-25', 'A', 'P', 'DUSUN PAHING RT 003 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(5, 'ANDITA WIDYANA NURSOFA', '91077012', '3208104410090002', '2024', 'KUNINGAN', '2009-10-04', 'A', 'P', 'Dusun Puhun Rt. 001 Rw. 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(6, 'ANNIK LUTFIYATUL KHULUQI', '98770689', '3329172710090003', '2024', 'BREBES', '2009-10-27', 'A', 'P', 'Dukuh Badodon RT 2 RW 5', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(7, 'AUFA ZAIDAN MUSYAFFA', '3089044911', '3215251912080003', '2024', 'KUNINGAN', '2008-12-19', 'A', 'L', 'Jl. Permata Bunda I Blok I', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(8, 'AURELIA RAMADANI', '87248600', '3208114809080001', '2024', 'KUNINGAN', '2008-09-08', 'A', 'P', 'DUSUN PUHUN RT 002 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(9, 'CHANIA RAHMADANI', '83026745', '2171125609080002', '2024', 'BATAM', '2008-09-16', 'A', 'P', 'RT.01 RW.01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(10, 'DAFFA QOLBI ROBBANI', '86833311', '3207101509080004', '2024', 'KUNINGAN', '2008-09-15', 'A', 'L', 'Dusun Panawangan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(11, 'DINDA NUR FAUZIYAH', '93172519', '3208244706090001', '2024', 'KUNINGAN', '2009-06-07', 'A', 'P', 'DUSUN PAHING RT 01 RW 03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(12, 'ELANG RAYHAN AGNI RAFIF', '3090108404', '3208112400090002', '2024', 'KUNINGAN', '2009-06-24', 'A', 'L', 'DUSUN PUHUN RT 001 RWW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(13, 'FERDI PIRMAN AKBAR', '76681888', '3208270711070001', '2024', 'KUNINGAN', '2007-11-07', 'A', 'L', 'Dusun Pahing RT.03/RW.01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(14, 'FINZANI ATIFAH USTUFIYAH', '93367463', '3208174206090001', '2024', 'KUNINGAN', '2009-06-02', 'A', 'P', 'Dusun Wage RT 009 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(15, 'GERKHA DIAN KHARIMAH', '89211389', '3208074612080003', '2024', 'KUNINGAN', '2008-12-06', 'A', 'P', 'DUSUN 1', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(16, 'JUAN PALESTINE AHMAD', '99242266', '3173010208090003', '2024', 'TANGGERANG', '2009-08-02', 'A', 'L', 'Dusun manis rt001/rw001 no.03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(17, 'KESYA OKTAPIYANI', '98990990', '3208324810090002', '2024', 'KUNINGAN', '2009-10-08', 'A', 'P', 'DUSUN KLIWON RT/RW 001/001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(18, 'KEYSA CAMILA PUTRI', '94895702', '3208245204090001', '2024', 'KUNINGAN', '2009-04-12', 'A', 'P', 'Dusun Manis, RT.007/RW.002 Desa Mulyajaya', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(19, 'MAYA HIKMATUL SHOLIHAH', '83937960', '320874112080001', '2024', 'KUNINGAN', '2008-12-01', 'A', 'P', 'Dusun Puhun RT 02 RW 04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(20, 'MUHAMAD SABIQUL KHOIROT', '98657769', '3208103107090004', '2024', 'KUNINGAN', '2009-07-31', 'A', 'L', 'Dusun Manis, RT.004/RW.004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(21, 'MUHAMAD SIDQI NURFIKRAH', '3098534292', '3208101602090001', '2024', 'KUNINGAN', '2009-02-16', 'A', 'L', 'Dusun Pahing Rt. 10 Rw.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(22, 'MUHAMMAD ARYA GANI SANJAYA PUTRA', '92551716', '3208320508090002', '2024', 'KUNINGAN', '2009-08-05', 'A', 'L', 'DUSUN 03 RT/RW 010/003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(23, 'MUHAMMAD NORMANSYAH', '96344386', '3208100911090002', '2024', 'KUNINGAN', '2009-11-09', 'A', 'L', 'desa cigarukgak dusun kaliwon rt 04/rw02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(24, 'MUHAMMAD ZIDAN FAHREZI', '81143551', '3208272212080003', '2024', 'KUNINGAN', '2008-12-22', 'A', 'L', 'DUSUN MANIS RT/TW 002/001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(25, 'MUTIARA AYU WULANDARI', '75827733', '3208024309070002', '2024', 'KUNINGAN', '2007-09-03', 'A', 'P', 'Dusun Jombang, RT.004/001 Desa Pamupukan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(26, 'NAFISHA MAGHFIROTUL AULIA', '95879399', '3208115006090001', '2024', 'KUNINGAN', '2009-06-10', 'A', 'P', 'CIHIDEUNGGIRANG,BLOK PUHUN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(27, 'NENDA LUTFI', '88189701', '3208240307080002', '2024', 'KUNINGAN', '2008-07-03', 'A', 'L', 'DESA MEKARJAYA KECAMATAN CIMAHI KABUPATEN KUNINGAN PROVINSI JAWA BARAT DUSUN WETAN RT.12 RW.04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(28, 'NISA LUTFI ARDIYANTI', '96817937', '3329176601090004', '2024', 'BREBES', '2009-01-26', 'A', 'P', 'BANDUNGSARI, RT 001 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(29, 'NITA DWI LEVINA', '81501441', '3329175303080001', '2024', 'BREBES', '2008-03-13', 'A', 'P', 'Rt:21/Rw:06 dusun cikuya,desa kertasari,kec.banjarharjo,kab.Brebes', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(30, 'OKTAFIANI ZAHRA', '3083278180', '3208305410080001', '2024', 'KUNINGAN', '2008-10-14', 'A', 'P', 'Dusun Walahar, RT.017/RW.005 Desa Cipakem', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(31, 'RIA AL KHAIRIYAH', '81215676', '3208104108080006', '2024', 'KUNINGAN', '2008-08-01', 'A', 'P', 'desa sidaraja', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(32, 'RIZKY ARDIANSYAH', '89610142', '3208043008080001', '2024', 'JAKARTA', '2024-08-30', 'A', 'L', 'Dusun cijambu kliwon2 rt 16 rw 8', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(33, 'SHILVIANA NUR KAZIMAH', '96740703', '3208045105090001', '2024', 'KUNINGAN', '2009-05-11', 'A', 'P', 'Dusun sukamaju desa ciwaru kecamatan ciwaru kabupaten kuningan RT 03/RW 09', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(34, 'SINDI AULIA', '98585339', '3208315405090001', '2024', 'KUNINGAN', '2009-05-14', 'A', 'P', 'dusun wage', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(35, 'SINDI AULIA AGUSTIN', '93606095', '3208056010090002', '2024', 'KUNINGAN', '2009-08-20', 'A', 'P', 'Dusun Kliwon Rt 006 Rw 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(36, 'SITI YAMI KHOTIMAH', '86703037', '3208075309080001', '2024', 'KUNINGAN', '2008-09-13', 'A', 'P', 'DUSUN 003 RT 15 RW 03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(37, 'YUSI FAZRIYAH FARHANI', '87893808', '3273085612080001', '2024', 'KUNINGAN', '2008-12-16', 'A', 'P', 'pahing', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(38, 'ADILLA HAFIZH ALBAR', '82472074', '3208062006080001', '2024', 'KUNINGAN', '2008-06-20', 'A', 'L', 'Dusun Tengah, RT.009/RW.004 Desa Cikandang', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(39, 'AGISNA SALAMAH', '3081357021', '3208054512080001', '2024', 'KUNINGAN', '2008-12-05', 'A', 'P', 'DUSUN III CITENJO RT 024 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(40, 'AGNIYA ZAKIYAH SAKHI', '98806985', '3208105912090001', '2024', 'KUNINGAN', '2009-12-19', 'A', 'P', 'Dusun Puhun Rt. 02 Rw. 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(41, 'AHMAD ZAENAL RASYID', '3096885907', '3208160405090003', '2024', 'KUNINGAN', '2009-05-04', 'A', 'L', 'DUSUN WAGE RT 10 RW 04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(42, 'AL-MALIKA GHISYA AZZAHRA', '95536581', '3208106302090001', '2024', 'KUNINGAN', '2019-02-23', 'A', 'P', 'cimenang', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(43, 'ANEUKEU ALTAFUNISA', '91267801', '3208245705090001', '2024', 'KUNINGAN', '2009-05-17', 'A', 'P', 'Dusun Kliwon RT 006 RW 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(44, 'ANNISA AYATUL HUSNA', '95022604', '3208065708090001', '2024', 'KUNINGAN', '2009-08-17', 'A', 'P', 'Dusun Puhun RT 03 RW 05', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(45, 'AZKA NAILAH SAKHI', '82091239', '3208247012080001', '2024', 'JAKARTA BARAT', '2008-12-30', 'A', 'P', 'Dusun Manis 1', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(46, 'DANU FAKHRUDDIN', '84880218', '3208062503080001', '2024', 'KUNINGAN', '2008-03-25', 'A', 'L', 'Dusun Wage, Rt07 Rw04, Ds.Cigedang , Kec.Luragung, Kab.Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(47, 'DARA PIANA INTAN PAHIRA', '92962978', '3208314304090001', '2024', 'KAB. KUNINGAN', '2009-04-03', 'A', 'P', 'DUSUN PAHINGRT 001 RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(48, 'DINI AMALIA', '85246183', '3208065212080001', '2024', 'KUNINGAN', '2008-12-12', 'A', 'P', 'Desa cikandang, RT 014/RW 006 Kec.Luragung, Kab.Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(49, 'FIKRI JAYID MUBAROK', '1', '3208102012080002', '2024', 'KUNINGAN', '2008-12-20', 'A', 'L', 'Dusun Wage Rt. 004 Rw. 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(50, 'GHINA NAJWAN', '85303612', '3208076610080001', '2024', 'KUNINGAN', '2008-10-26', 'A', 'P', 'Rt 03 Rw 11 Dusun Puhun Desa Pagundan Kec. Lebakwangi', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(51, 'HALIZAH AULIYA MUTHMA\'INNAH', '97676222', '3208116612090001', '2024', 'KUNINGAN', '2009-12-26', 'A', 'P', 'RT 02 / RW 03 Dusun Puhun', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(52, 'KAIZE HAFIEDZ', '99877629', '3208210307090001', '2024', 'KUNINGAN', '2009-07-03', 'A', 'L', 'Dusun Puhun Rt 04 Rw 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(53, 'KHAIRA TRI AGUSTIN', '3092449192', '3329176308090001', '2024', 'BREBES', '2009-08-23', 'A', 'P', 'Desa Malahayu RT/RW 08/03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(54, 'KORIAH', '3088826237', '3208275906080002', '2024', 'KUNINGAN', '2008-06-19', 'A', 'P', 'Dusun Kliwon RT 032 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(55, 'MAYLA SHAFIRA MAHARANI', '95102591', '3329175006090005', '2024', 'BREBES', '2009-05-10', 'A', 'P', 'Dukuh Limbangan, RT 001 RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(56, 'MUHAMAD ARIFIN', '94649862', '3208232606090001', '2024', 'KUNINGAN', '2009-06-26', 'A', 'L', 'Dusun 2, RT 007, RW 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(57, 'MUHAMMAD ABDUL KHOLIK', '98972878', '3208101604090001', '2024', 'KUNINGAN', '2009-04-16', 'A', 'P', 'Dusun Babakan manis 1 Rt.15 Rw.07', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(58, 'MUHAMMAD FACHRI AL-HADIQ', '91986203', '3208180905090004', '2024', 'KUNINGAN', '2009-05-09', 'A', 'L', 'Parenca', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(59, 'MUHAMMAD RAFA FACHRIDHOTUL ZIDDAN', '95760169', '3208112406090001', '2024', 'KUNINGAN', '2009-06-24', 'A', 'L', 'Dusun Pahing RT.003/RW.002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(60, 'NADINE AGHNI ALMAGHFIRA', '83492727', '3208105512080005', '2024', 'KUNINGAN', '2008-12-15', 'A', 'P', 'Dusun Manis, RT.001/RW.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(61, 'NAILA TRIAMARISA', '3098299909', '3208317103090001', '2024', 'KUNINGAN', '2009-03-31', 'A', 'P', 'Dusun Wage RT 012 RW 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(62, 'NIAM ABDUL ROZAQ ALMAGRIBI', '86293967', '3208111408080005', '2024', 'KUNINGAN', '2008-08-08', 'A', 'L', 'DUSUN PUHUN RT 05 RW 03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(63, 'NOVITA AULIA', '89822122', '3208296611080001', '2024', 'KUNINGAN', '2008-11-26', 'A', 'P', 'Dusun Sukahurip RT 8 RW 2', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(64, 'NUNI PITRIYANI', '92526399', '3208214502090001', '2024', 'KUNINGAN', '2009-02-05', 'A', 'P', 'Dusun Pahing RT 005 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(65, 'PADLI', '91302900', '3208060505090002', '2024', 'KUNINGAN', '2009-05-05', 'A', 'L', 'Dusun II RT 008 RW 003 Desa Panyosogan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(66, 'RAHMA HAURA KHADIJAH', '86806506', '3208044410080003', '2024', 'KUNINGAN', '2008-10-04', 'A', 'P', 'kmp. sindangkarsa Rt. 001 Rw. 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(67, 'RIFA FATIHATUL ULYA', '98123211', '3208104904090001', '2024', 'KUNINGAN', '2009-09-04', 'A', 'P', 'dusun puhun rt. 003 Rw. 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(68, 'SABILLA BALQIS NAZWA AL-RASYID', '94590770', '3208075806090001', '2024', 'KUNINGAN', '2009-06-18', 'A', 'P', 'Perum pesona ancaran blok c no.25', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(69, 'SINTIYA RAMADANI', '82351833', '3208096709080004', '2024', 'KUNINGAN', '2008-09-27', 'A', 'P', 'Dusun Bojong RT 30 RW 06', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(70, 'SUTRI AMBAR RATIH', '85999948', '3208314510080001', '2024', 'JAKARTA 05 OKTOBER 2008', '2008-10-05', 'A', 'P', 'Kampung depok dusun manis', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(71, 'TIAN ROSTIANA', '91065102', '3208106608090002', '2024', 'KUNINGAN', '2009-08-26', 'A', 'P', 'Desa ; Kadurama, RT/RW : 01/02, Dusun Wage, Kecamatan: Ciawigebang,', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(72, 'AGNI BILQIS HARIST', '97828310', '3.20808807020617E+017', '2024', 'KUNINGAN', '2009-04-13', 'A', 'P', 'Dusun puhun desa mekarmukti sindangagung', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(73, 'AGUS SUBARDA', '99869877', '3208100101090002', '2024', 'KAB. KUNINGAN', '2009-01-01', 'A', 'L', 'Jl Ciawi-Sukaraja Desa Cihaur', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(74, 'AINUN PUTRI RAMADANI', '89549362', '3208057009080001', '2024', 'KUNINGAN', '2008-09-30', 'A', 'P', 'RT04/RW03, Desa Sindangjawa', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(75, 'AKMAL AYDIN PRATAMA', '94875035', '3208163103090002', '2024', 'KUNINGAN', '2009-03-31', 'A', 'L', 'DUSUN PUHUN RT.004/ RW.002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(76, 'ALMIRA SANARI RUBINA', '95001161', '3208116906090001', '2024', 'KUNINGAN', '2009-06-29', 'A', 'P', 'Dusun Manis Rt 03 Rw 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(77, 'ANNA LAILATUL ANWARIYAH', '3089169517', '3208314409080001', '2024', 'KUNINGAN', '2008-09-04', 'A', 'P', 'Dusun Wage', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(78, 'ANNISA SALSABILA AGUSTIN', '86147989', '3329174802090001', '2024', 'BREBES', '2009-02-08', 'A', 'P', 'SINDANGHEULA RT 013 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(79, 'AZKIYAH ISTIKOMAH', '86434420', '3208316310080001', '2024', 'KUNINGAN', '2008-10-23', 'A', 'P', 'Dusun Kliwon', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(80, 'DEANNA RAHMAWATY', '84612489', '3208315012080002', '2024', 'KUNINGAN', '2008-10-12', 'A', 'P', 'Dusun Pahing Rt. 003 Rw. 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(81, 'DINO PRATAMA PUTRA', '89885393', '3208243103080001', '2024', 'KUNINGAN', '2008-03-31', 'A', 'L', 'Dusun 1 Rt. 004 Rw.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(82, 'DWI NOVITA PUTRI', '3080609603', '3.20807461108E+016', '2024', 'KUNINGAN', '2008-11-06', 'A', 'P', 'Dusun buah gama', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(83, 'HAMJAH ASKIA HAMDANI', '94363643', '3208120801090003', '2024', 'KUNINGAN', '2009-01-08', 'A', 'L', 'RT 17 RW 005 Dusun Wage', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(84, 'IIN SUPRIYATI', '96271055', '3208104706090001', '2024', 'KUNINGAN', '2009-07-07', 'A', 'P', 'dusun pahing rt02 rw01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(85, 'ILHAM MAULANA', '96375260', '3208311501090001', '2024', 'KUNINGAN', '2009-01-15', 'A', 'L', 'Dusun Pahiing RT 08 RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(86, 'KHANSA PUTRI BILQISAT TOBARI', '3083142795', '3208054212080001', '2024', 'KUNINGAN', '2008-12-02', 'A', 'P', 'DUSUN WAGE RT 007 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(87, 'LAURA SINTIASARI', '83379140', '3208044706080001', '2024', 'KUNINGAN', '2008-06-07', 'A', 'P', 'Rt 011/Rw 03 Blok Mekarsari , Dusun Mekarmukya', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(88, 'MELYSA SEFTYANI', '81391555', '3208076809080002', '2024', 'KUNINGAN', '2008-09-28', 'A', 'P', 'Dusun 3 RT 11 RW 3 Desa Sindang, kecamantan lebakwangi,kabupaten kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(89, 'MILDAN HUDAM MUTTAMAM', '89351840', '3208113103080002', '2024', 'KUNINGAN', '2008-03-31', 'A', 'L', 'Dusun Manis', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(90, 'MUHAMMAD BEN HARITS', '97339248', '3208310502090002', '2024', 'KUNINGAN', '2009-02-15', 'A', 'L', 'DUSUN 1', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(91, 'MUHAMMAD FADHIL EL-BASYUNI', '83918032', '3208122807080002', '2024', 'SEMARANG', '2008-07-28', 'A', 'L', 'Dusun Pahing RT.01 RW.01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(92, 'MUHAMMAD RAFI TAUFIK', '85240164', '320627111008002', '2024', 'TANGERANG', '2008-10-11', 'A', 'L', 'Dusun Manis Rt.01 Rw.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(93, 'NAILY HAANIYAH', '3094070813', '3209325105090001', '2024', 'CIREBON', '2009-05-11', 'A', 'P', 'Dusun 2 RT 002 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(94, 'NAYA TRIKANISA YASENDA', '96098817', '3208106201090002', '2024', 'KUNINGAN', '2009-01-22', 'A', 'P', 'dusun puhun RT/RW  011/003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(95, 'NUR AENI', '91316891', '3272074907090001', '2024', 'KUNINGAN', '2009-07-09', 'A', 'P', 'CIKUBANG MULYA', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(96, 'NUR SUCI RAMADHANI', '96901469', '3208245209090001', '2024', 'KUNINGAN', '2009-09-12', 'A', 'P', 'Dusun calingcing', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(97, 'PRATAMA MUTIA AJI', '95621858', '3208313105090001', '2024', 'KUNINGAN', '2009-05-31', 'A', 'L', 'RT RW 002 / 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(98, 'RAHMATUN NAZILA', '98335807', '3208215807090003', '2024', 'KUNINGAN', '2009-07-18', 'A', 'P', 'Dusun Kliwon, RT.003/RW.001 Desa Susukan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(99, 'RAIHAN NURYANDI', '93770019', '3028231705090001', '2024', 'KUNINGAN 17 MEI 2009', '2009-05-17', 'A', 'L', 'Cikeleng dusun Manis RT.10 RW.2 kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(100, 'RIRIN FAJRIATUL MUNAWAROH', '98516016', '3208105305090002', '2024', 'KUNINGAN', '2009-05-13', 'A', 'P', 'Ds Ciomas RT 04 RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(101, 'SAFAIRA NURUSSAFA', '91892793', '3208105602090004', '2024', 'KUNINGAN', '2009-02-16', 'A', 'P', 'Dusun Puhun Blok 2', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(102, 'SINTA SEPTIANI', '96345472', '3208214609090081', '2024', 'KUNINGAN', '2009-09-06', 'A', 'P', 'DUSUN PUHUN RT 004 RW 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(103, 'SITI AFIFA IQLIMATUL MUKHAROMAH', '97792049', '3208115902090001', '2024', 'KUNINGAN', '2009-02-19', 'A', 'P', 'DUSUN PUHUN RT 001 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(104, 'SYAILA FIDA NUR LATIFAH', '93642244', '3208115604090001', '2024', 'KUNINGAN', '2009-04-16', 'A', 'P', 'Dusun kliwon, RT 004/RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(105, 'ULFAH HAMIDAH', '88285105', '3208314302090001', '2024', 'KUNINGAN', '2009-02-03', 'A', 'P', 'pahing', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(106, 'AGUSTIN SETIAWATI', '97130088', '3208105608090005', '2024', 'KUNINGAN', '2009-08-16', 'A', 'P', 'Sidaraja blok puhun Rt/Rw 11/03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(107, 'AHMAD SYAUQI NURTAQIYAN', '84939577', '3208241504080002', '2024', 'KUNINGAN', '2008-04-15', 'A', 'L', 'Dusun Manis RT 014 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(108, 'AISYA SALSA BILA', '3089864873', '3208305612080001', '2024', 'KUNINGAN', '2008-12-16', 'A', 'P', 'Dusun Minggu, RT.007/RW.002 Desa Cipakem', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(109, 'ALYAA NABIILA', '86735566', '3208316005080001', '2024', 'KUNINGAN', '2008-05-20', 'A', 'P', 'Manis', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(110, 'AQILA MAHYA', '94212691', '3312204807090001', '2024', 'WONOGIRI', '2009-07-08', 'A', 'P', 'Jati Rt.001 Rw.002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(111, 'ARGITA WINDIRA', '83503770', '3208104202080002', '2024', 'KUNINGAN', '2008-02-02', 'A', 'P', 'DUSUN MANIS', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(112, 'BILQIS LAHDANIA FALAH', '81333200', '3208275811080001', '2024', 'KUNINGAN', '2024-11-18', 'A', 'P', 'desa partawangunan kec.kalimanggis kab.kuningan rt.11 rw.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(113, 'DEVI MARISA AFRILIA', '97991624', '3208235104090002', '2024', 'KUNINGAN', '2009-04-11', 'A', 'P', 'Blok Kliwon, RT.01/RW.01 Desa Kalimati', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(114, 'DWITA RAHMA AZAHRA', '87999008', '3208276706080002', '2024', 'KUNINGAN', '2008-06-27', 'A', 'P', 'DUSUN PUHUN RT 014/ RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(115, 'HOEROTUN NISA', '98793411', '3208106206080002', '2024', 'KUNINGAN', '2008-06-22', 'A', 'P', 'Dusun Puhun Rt.005 Rw. 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(116, 'IKA SITI NURKHOLISAH', '98384038', '3208116809090002', '2024', 'KUNINGAN', '2009-09-28', 'A', 'P', 'Dusun Puhun, RT 03/ RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(117, 'IMAM DAVA DZIMARA', '96964664', '2122011006', '2024', 'KUNINGAN', '2009-06-16', 'A', 'L', 'blok kliwon', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(118, 'KHOERUN NISA RAHMADINI', '98869413', '3208014509090001', '2024', 'KUNINGAN', '2009-09-05', 'A', 'P', 'DUSUN PUHUN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(119, 'LINTANG AYU SUSANTO', '99251138', '3208116402090001', '2024', 'JAKARTA', '2009-02-24', 'A', 'P', 'DUSUN PAHING RT 002 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(120, 'MEMEY NUR MAELY', '92233370', '3208096005090001', '2024', 'KUNINGAN', '2009-05-20', 'A', 'P', 'JL R.E MARTADINATA ANCARAN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(121, 'MOCH.FAUZAN', '85119533', '3208240407080001', '2024', 'KUNINGAN', '2008-07-04', 'A', 'L', 'RT 01 RW 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(122, 'MUHAMMAD ELVIN ANASATYA', '99401757', '3208292606090001', '2024', 'KUNINGAN', '2009-06-25', 'A', 'L', 'Dusun Gunung jawa', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(123, 'MUHAMMAD KHOIRUL MIZAN', '94918514', '3208312501090001', '2024', 'KUNINGAN', '2009-01-25', 'A', 'L', 'Rt 02 Rw 03 blok bilisuk pahing desa Babakan reuma', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(124, 'MUHAMMAD RIVAN AL GHIFARI', '3089932083', '3208101001080003', '2024', 'KUNINGAN', '2008-01-10', 'A', 'L', 'Dusun Kliwon RT. 014/RW. 005 Desa Pangkalan Kec. Ciawigebang Kab. Kuningan Jawa barat 45591', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(125, 'NAJLA ALIA KARIMAH', '99652386', '3208064705090003', '2024', 'KUNINGAN', '2009-05-07', 'A', 'P', 'DUSUN PAHING RT/RW 002/004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(126, 'NAYLA ALIKA PUTRI', '3094980298', '3171025107091003', '2024', 'KUNINGAN', '2009-07-11', 'A', 'P', 'Kampung Curug Rt.01 Rw.09', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(127, 'NUR ANIS AINUN', '3099763945', '3208106302090002', '2024', 'KUNINGAN', '2009-02-23', 'A', 'P', 'DUSUN WAGE RT 01 RW 09', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(128, 'NURHAYATI', '82170665', '3208275411080001', '2024', 'KUNINGAN', '2008-11-14', 'A', 'P', 'DUSUN MANIS RT 005/ RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(129, 'RAHMI EKAWATI', '99917514', '3208124608090001', '2024', 'KUNINGAN', '2009-08-06', 'A', 'P', 'RT.18 RW.05 Dusun wage', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(130, 'RAMA ALFATHIR', '87994378', '3208052710080006', '2024', 'KUNINGAN,27 OKTOBER 2008', '2008-10-27', 'A', 'L', 'dusun 2 Bantarpanjang RT 010/003 Bantarpanjang Cibingbin Jawa barat', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(131, 'RAMANDA ASKA SYAHIDAN', '89175215', '3173032710080002', '2024', 'JAKARTA', '2008-10-27', 'A', 'L', 'Dusun Wage Rt.003 Rw.003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(132, 'REZA FAQIH MUNAWAR', '76024140', '3208272511070002', '2024', 'KUNINGAN', '2007-11-25', 'A', 'L', 'Dusun puhun RT.03/RW.04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(133, 'RIRIN RIYANA', '3096472615', '3208075102090001', '2024', 'KUNINGAN', '2009-02-11', 'A', 'P', 'Dusun Buahgama, RT. 005/RW. 002 Desa Manggari', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(134, 'SAFIRA NADHIFAH', '93241318', '3208245802090001', '2024', 'KUNINGAN', '2009-02-18', 'A', 'P', 'Dusun Wage I RT 004 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(135, 'SITI FATUMATUL AZZAHRA', '94378252', '3208036208090002', '2024', 'KUNINGAN', '2009-08-22', 'A', 'P', 'Dusun 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(136, 'SITI LUWAIDA KIARATUL FUADAH', '3080031512', '3208105011080006', '2024', 'KUNINGAN', '2008-10-10', 'A', 'P', 'Ds.sukaraja kec.ciawigebang kab.kuningan RT.05 RW.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(137, 'SYIFA AULIA PUTRI', '92079698', '3208274906090001', '2024', 'KUNINGAN', '2009-06-09', 'A', 'P', 'Dusun Wage, RT.001/RW.004 Desa Cipancur', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(138, 'ULYA AZIZAH RAHY', '3080575748', '3208015110080001', '2024', 'KUNINGAN', '2008-10-11', 'A', 'P', 'DUSUN PAHING RT.003/001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(139, 'WILDAN MUHAMAD ROMDONI', '86566082', '3208101409080001', '2024', 'KUNINGAN', '2008-09-14', 'A', 'L', 'DUSUN MANIS RT 02 RW 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(140, 'AISY RIZKY ARDHANI', '96704692', '3208242207090001', '2024', 'KUNINGAN', '2009-07-22', 'A', 'P', 'Dusun Manis 2 Rt 013 Rw. 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(141, 'AJENG NURDIANDINI', '96756051', '3208074805090002', '2024', 'KAB. KUNINGAN', '2009-05-08', 'A', 'P', 'Dusun 1 Rt.002 Rw.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(142, 'ALYANA NAFISHA HEROBIAN', '96143555', '3217064404090001', '2024', 'BANDUNG', '2009-04-04', 'A', 'P', 'Dusun cimara RT 02 rw 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(143, 'ARKANA ATAYA RAMADANI', '3096375725', '3208315009090002', '2024', 'KAB. KUNINGAN', '2009-09-10', 'A', 'P', 'dusun Pahing Rt.01 Rw. 04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(144, 'CHIKA HANIFA  SORAYA', '97600744', '3208305606090001', '2024', 'KUNINGAN', '2009-06-16', 'A', 'P', 'Dusun 001 RT 001 RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(145, 'DEVI OKTAVIANI', '88498750', '3208266510080001', '2024', 'KUNINGAN', '2008-10-25', 'A', 'P', 'Dusun Cibodas RT.005/RW.002 Desa Pakapasangirang', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(146, 'ELSA PUTRI UTAMI', '81905178', '3208215407080002', '2024', 'KUNINGAN', '2008-07-14', 'A', 'P', 'RT 003/RW 004,dusun puhun, Desa Susukan, Kec. Cipicung, Kab. Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(147, 'FADLI RIFFALIZA AKBAR', '3096315312', '3208312502090002', '2024', 'KUNINGAN', '2009-02-25', 'A', 'L', 'Dusun Pahing Rt.005 Rw.003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(148, 'FAQIH ALPATAHILLAH', '89011545', '3208301112080002', '2024', 'KUNINGAN', '2008-12-11', 'A', 'L', 'Dusun babakan kidul', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(149, 'IKAH MUDRIKATUL HASANAH', '85779880', '3208275805080002', '2024', 'KUNINGAN', '2008-05-18', 'A', 'P', 'Dusun wage', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(150, 'ILMI HALIMATU AZIZAH', '81704124', '3208044806080005', '2024', 'KUNINGAN', '2008-06-08', 'A', 'P', 'Dusun Kliwon I RT 015 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(151, 'KHOLISATUL FITRIAH', '96342432', '3208096307090005', '2024', 'KUNINGAN', '2024-03-02', 'A', 'P', 'Dusun bojong rt 27 rw 06', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(152, 'LIRA NUR AWALIYAH', '92855858', '3204284107090005', '2024', 'BANDUNG', '2009-06-01', 'A', 'P', 'Dusun Wage, RT.003/RW.001 Desa Windujanten', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(153, 'MEYSA ELSYIFA', '98707230', '3208104706090003', '2024', 'KUNINGAN', '2009-06-07', 'A', 'P', 'Dusun Keramat Kesambi Rt. 004 Rw. 002 Desa Padarama', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(154, 'MIFTAH RAHMATULLAH', '3097075645', '3208302702090002', '2024', 'KABUPATEN KUNINGAN', '2009-02-27', 'A', 'L', 'Desa Mandalajaya RT 1 RW 2', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(155, 'MUHAMAD FAKHRI AZHAR', '96255983', '3215141306090005', '2024', 'KARAWANG', '2009-06-13', 'A', 'L', 'PERUM DE\'KRATON J.5/9 RT 008 RW 006', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(156, 'MUHAMMAD GHAISAN DHIYYA ADDIEN', '85499929', '3208101208080001', '2024', 'KUNINGAN', '2008-12-08', 'A', 'L', 'Dusun Puhun, RT.06 RW.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(157, 'MUHAMMAD NUR HAFIDZ', '91215087', '3216020103090004', '2024', 'BEKASI', '2009-03-01', 'A', 'L', 'Pondok Pesantren Nurul Ilmi Dusun Manis RT 01 RW 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(158, 'MUHAMMAD RONA NUGRAHA', '96691658', '3208290607090001', '2024', 'KUNINGAN', '2009-07-06', 'A', 'L', 'DUSUN REBO RT 07 RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(159, 'NAJMA KHALILA SYAHRANI', '81361101', '3208114211080005', '2024', 'KUNINGAN', '2008-11-02', 'A', 'P', 'DUSUN MANIS RT 002/ RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(160, 'NAYLA ALTHAFUNNISA', '98914321', '3208296204090001', '2024', 'KUNINGAN', '2009-04-22', 'A', 'P', 'Dusun Jabranti RT 03 RW 01 Desa Jabranti Kec. Karangkancana Kab. Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(161, 'NURUL KHOIRIYAH', '93423899', '3208274109090002', '2024', 'KUNINGAN', '2009-09-01', 'A', 'P', 'DUSUN MANIS RT 004  RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(162, 'RAZYA ZULFATUL AULIA', '93088291', '3175066401091006', '2024', 'KUNINGAN', '2009-01-24', 'A', 'P', 'KP. Rawa Badung RT 006 RW 007', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(163, 'REHAN', '96849576', '3208300202090001', '2024', 'KUNINGAN', '2009-02-02', 'A', 'L', 'Dusun Cisampih Rt.002 Rw.007', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(164, 'SALBIYYA FITRIANI', '87325830', '3273267010080002', '2024', 'BANDUNG', '2008-10-30', 'A', 'P', 'Jl. RE Martadinata, RT.16/RW.03 Dusun Puhun Desa Ancaran', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(165, 'SITI HANINA', '89316554', '3208106209080001', '2024', 'KUNINGAN', '2008-09-22', 'A', 'P', 'Dusun Puhun RT.03 RW.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(166, 'SITI NUR SYAMSIAH', '89210240', '3208065610080001', '2024', 'KUNINGAN', '2008-10-16', 'A', 'P', 'DUSUN MANI RT.003 RW.003 DESA KADURAMA', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(167, 'SYITI KHOLIFAH', '83040573', '3208105704080001', '2024', 'KUNINGAN', '2008-04-17', 'A', 'P', 'Desa cihurup', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(168, 'UJANG SUDRAJAT', '89968294', '3208210707090001', '2024', 'SUGANANGAN, KUNINGAN, JAWA BARAT', '2008-07-12', 'A', 'L', 'desa suganangan, rt/04, rw/02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(169, 'VIRA DWI FUTRI WULANDARI', '95463083', '3208114203090001', '2024', 'KUNINGAN JAWA BARAT CIHIDEUNGHILIIR', '2009-03-02', 'A', 'P', 'desa Cihideung hilir blok cilimus, gang sate palurah, kecamatan cidahu, kabupaten kuningan, jawa barat', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(170, 'AIDA SYAHRANI', '96600725', '3208056803090003', '2024', 'KUNINGAN', '2009-03-28', 'A', 'P', 'CITENJO RT 21 RW 05 DUSUN 03 TANJUNG JAYA', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(171, 'AINI HAFIDAH', '92167607', '3208055206090003', '2024', 'KUNINGAN', '2009-06-12', 'A', 'P', 'DUSUN PAHING RT 006 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(172, 'ALIFA NURLIAH MUHIBATILLAH', '3103187830', '3208104103100001', '2024', 'KUNINGAN', '2010-03-01', 'A', 'P', 'dusun tarikolot RT. 004 RW. 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(173, 'ALYKA OKTAVIANI UTAMI', '89078367', '3208066610080002', '2024', 'KUNINGAN', '2008-10-26', 'A', 'P', 'Desa Cikandang,Rt 06,Rw 03,dusun tengah', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(174, 'ASSYLA NAILA ALIFAH', '95112395', '3329176107090001', '2024', 'BREBES', '2009-07-21', 'A', 'P', 'RT 004 RW 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(175, 'ATIH NUR SEHATINI', '88593062', '3208114211080003', '2024', 'KUNINGAN', '2008-11-02', 'A', 'P', 'Dusun Pahing Rt.008 Rw.002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(176, 'AULIA NURBAITY', '92597023', '3208136107090001', '2024', 'KUNINGAN', '2009-07-21', 'A', 'P', 'DUSUN ENDANG JUMAGA NO 26', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(177, 'CITRA SARI DEWI', '3099837940', '3208306906090003', '2024', 'KUNINGAN 29 JUNI2009', '2024-06-29', 'A', 'P', 'Cipakem', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(178, 'DIAH RAHMAWATI NINGSIH', '98097999', '3208315204090001', '2024', 'KUNINGAN', '2009-04-12', 'A', 'P', 'Jl. Raya Desa Muncangela', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(179, 'ERVALINA ANSYA RAHMA', '92888966', '3208094805090001', '2024', 'KUNINGAN', '2009-05-08', 'A', 'P', 'Jl. RE. Martadinata RT.13/02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(180, 'FAHRI MAULANA RIDAWAN', '81243875', '320810100908003', '2024', 'KUNINGAN', '2008-09-10', 'A', 'L', 'Dusun Dukuh Rt.005 Rw.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(181, 'GHIVA DZIKRI AL GHIFARY', '88000963', '3208311707710002', '2024', 'KUNINGAN', '2008-01-20', 'A', 'L', 'Dusun Puhun RT.03 RW.01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(182, 'IMELDA MAULIDINA', '98903178', '3208244903090001', '2024', 'KUNINGAN', '2009-03-09', 'A', 'P', 'Dusun Manis 1', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(183, 'INAR MA\'ISYATUNNAJAH', '84473420', '3208104105080004', '2024', 'KUNINGAN', '2008-05-01', 'A', 'P', 'DUSUN PUHUN RT 013 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(184, 'JAKA WIGUNA', '95006465', '3208100708090004', '2024', 'KUNINGAN', '2008-08-07', 'A', 'L', 'DUSUN WAGE RT 006 RW 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(185, 'LAELA SAPIRA', '98651162', '320805305800003', '2024', 'KUNINGAN', '2009-05-13', 'A', 'P', 'Dusun wage', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(186, 'LULU NAPISATUL LULUAH', '82902784', '3208276906080001', '2024', 'KUNINGAN', '2008-06-29', 'A', 'P', 'Dusun Puhun RT/RW 10/03 Desa Kalimanggis wetan Kecamatan Kalimanggis Kabupaten Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(187, 'MIA ALMAGHFIRA RAMADHANI', '89783925', '3208105809080001', '2024', 'KUNINGAN', '2008-09-18', 'A', 'P', 'dusun manis RT 01/RW 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(188, 'MOHAMAD FAHRI AWALUDIN', '85808965', '3208110910080001', '2024', 'KUNINGAN', '2008-10-09', 'A', 'L', 'DUSUN PAHING RT 004 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(189, 'MUHAMAD FASHA', '94624422', '3208182207090002', '2024', 'KUNINGAN', '2009-07-22', 'A', 'L', 'DUSUN MALARAMAN RT 002 RW 007', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(190, 'MUHAMMAD HAFIZH', '95901213', '3208301506090001', '2024', 'KUNINGAM', '2009-06-15', 'A', 'L', 'DUSUN NAGREG', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(191, 'MUHAMMAD RIFQI GOJALI', '82408301', '3208303007080003', '2024', 'KUNINGAN', '2008-07-30', 'A', 'L', 'DUSUN PUHUN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(192, 'NAURA KAMILA ZAHRA', '3087375870', '3208090802063726', '2024', 'KUNINGAN', '2008-12-01', 'A', 'P', 'Lingkungan Serang', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(193, 'NAYLA SALSABILA', '81649908', '3208236211080004', '2024', 'KUNINGAN', '2008-11-22', 'A', 'P', 'BLOK WAGE RT 05 RW 02 DESA KALIMATI', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(194, 'NAZMI FAKHRI ZUHAILY', '96034318', '3208102202090002', '2024', 'KUNINGAN', '2009-02-22', 'A', 'L', 'Dusun wage RT 05 RW 02 desa ciawigebang, Kec. Ciawigebang KAB.kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(195, 'NUR RAHMA WATI', '92700696', '3208296202100002', '2024', 'DUSUN CIPARI', '2010-02-22', 'A', 'P', 'Dusun cipari', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(196, 'PRISKA SETIYA WATI', '3097710168', '3329174104090003', '2024', 'BREBES', '2009-04-01', 'A', 'P', 'MALAHAYU', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(197, 'REVAN EVANDRA', '85008766', '3208111809080002', '2024', 'KUNINGAN', '2008-09-18', 'A', 'L', 'Dusun Pahinh Rt. 014 Rw 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(198, 'RINDHU RAMADHANI DINEVA PUTRI', '84308580', '3208315209080002', '2024', 'KUNINGAN', '2008-09-12', 'A', 'P', 'Desa Kertayasa, RT.08 RW.04, Kec. Sindangagung, Kab. Kuningan, Jawa Barat', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(199, 'RIRIN SUNDARI', '98745660', '3208054805090002', '2024', 'KUNINGAN', '2009-05-08', 'A', 'P', 'Dusun1 rt2 rw1 desa ciangir kec.cibingbin', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(200, 'RITA RAODOTUL HASANAH', '96824235', '3208115305090001', '2024', 'KUNINGAN', '2009-05-13', 'A', 'P', 'Dusun pahing RT 06 RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(201, 'SALSA DWI FATSA', '88763939', '3208317103080002', '2024', 'KUNINGAN', '2008-03-31', 'A', 'P', 'Dusun Wage Rt.011 Rw.004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(202, 'SITI KHALIDA AHMAD', '3083237421', '3208104312080001', '2024', 'KUNINGAN', '2008-12-03', 'A', 'P', 'Dusun Kliwon Rt. 003 Rw. 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(203, 'SITI NURU\' SA\'ADAH', '3087919025', '3208106211080003', '2024', 'KUNINGAN', '2008-11-22', 'A', 'P', 'DUSUN PUHUN RT 008/ RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(204, 'UCI MUSYAROFAH', '85114207', '3208115007080003', '2024', 'KUNINGAN', '2008-07-10', 'A', 'P', 'DESA CIKEUSIK RT 009 RW 002 KEC.CIDAHU KAB.KUNINGAN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(205, 'WAHDINI DWI SAFITRI', '96508501', '3329175010090004', '2024', 'BREBES', '2009-10-10', 'A', 'P', 'Desa penanggapan RT 004/RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(206, 'WAHYU FIRMANSYAH', '99858130', '3208312502090003', '2024', 'KUNINGAN', '2009-02-25', 'A', 'L', 'DUSUN PAHING', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(207, 'AINUN SITI RUKHOYAH', '3096688345', '3208105803090008', '2024', 'KUNINGAN', '2009-03-18', 'A', 'P', 'Dusun Manis RT.002/RW.001 Desa Kapandayan Kec. Ciawigebang Kab. Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(208, 'ALIFTA SOLIHATUL ALIFFIYAH', '98050963', '320811465090001', '2024', 'KUNINGAN', '2009-05-06', 'A', 'P', 'Dusun cimulya', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(209, 'ANDRIYANSYAH', '99248238', '3208101006090002', '2024', 'KUNINGAN', '2009-06-10', 'A', 'L', 'Dusun Kliwon R.05 Rw. 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(210, 'ANGGUN TANIA PUTRI', '3095093963', '3208245310090001', '2024', 'KUNINGAN', '2009-10-13', 'A', 'P', 'kp gabus tengah desa srimukti rt02 rw 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(211, 'AUFA KHUZAIMAH', '81174060', '320823520608001', '2024', 'JAKARTA', '2008-06-11', 'A', 'P', 'Dusun Pahing, Blok munjul, RT.11/RW.3, Desa. Cikeleng, Japara  JAPARA, KAB. KUNINGAN, JAWA BARAT', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(212, 'AULIA PUTRI KIRANA', '95482090', '3329127006090001', '2024', 'BREBEA', '2009-06-30', 'A', 'P', 'Dk. Tembongrea-Ds. Bojongsari RT. 06/06', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(213, 'DEA HIDAYANTI', '98763562', '3208115503090002', '2024', 'KUNINGAN', '2009-03-15', 'A', 'P', 'dusun kliwon', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(214, 'DITA INDRIANI', '97334042', '3208116003090001', '2024', 'KUNINGAN', '2009-03-20', 'A', 'P', 'Dusun puhun desa jatimulya rt004 rw003 kec.cidahu kab.kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(215, 'ESA FITRIA NUR ADNIN', '98750826', '3208134109090001', '2024', 'KUNINGAN', '2009-09-01', 'A', 'P', 'Dusun Pon RT 015 RW 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(216, 'FAIZ ABDULROHMAN', '93676746', '3208311601090001', '2024', 'KUNINGAN', '2009-01-16', 'A', 'L', 'Dusun Puhun Rt. 003 Rw. 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(217, 'HAFIEDZ NUR RIZQY PRASETYA', '3090865727', '3208060705090001', '2024', 'KUNINGAN', '2009-05-07', 'A', 'L', 'Dusun manis rt 3 rw 2 desa luragunglandeuh', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(218, 'INAYAH HERNINGTYAS', '86155599', '3208075205080003', '2024', 'CIREBON', '2008-05-12', 'A', 'P', 'Blok Kidul Rt.001 Rw. 001 Desa Pajawankidul', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(219, 'INDAH NURHAPIPAH', '84766842', '3208315411080002', '2024', 'KUNINGAN', '2008-11-14', 'A', 'P', 'Dusun Kliwon Rt.01 rw.02 Desa balong kec.sindangagung kab.kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(220, 'LISTIA NURHOTIMAH', '92441408', '3208116408090001', '2024', 'KUNINGAN', '2009-08-24', 'A', 'P', 'Dusun Pahing RT/RW 008/002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(221, 'MAHDA ARSELA', '84496570', '3871048401080004', '2024', 'JAKARTA', '2008-10-24', 'A', 'P', 'Perum Alam Asri', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(222, 'MUHAMAD DIFA MURSYADAD', '3098535570', '3208109702090001', '2024', 'KUNINGAN', '2009-02-07', 'A', 'L', 'dusun wage Rt.001 Rw.003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(223, 'MUHAMAD RAIHAN', '81101503', '3208311804090002', '2024', 'KUNINGAN', '2009-04-18', 'A', 'L', 'dusun manis desa Kertayasa', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(224, 'MUHAMMAD IBNU HIKAM', '92067734', '3.209322002209E+016', '2024', 'KABUPATEN CIREBON', '2009-02-20', 'A', 'L', 'Dusun Mulya Sari RT 005 RW 005', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(225, 'MUHAMMAD MAULANA IQBAL', '81758122', '3208102303090002', '2024', 'KAB. KUNINGAN', '2009-03-28', 'A', 'L', 'Dusun Pahing Rt. 001 Rw.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(226, 'MUHAMMAD SEPTIAN NABIL RAMADHAN', '81703205', '3208020909080001', '2024', 'KUNINGAN, JAWA BARAT', '2008-09-09', 'A', 'L', 'Jl.MANGGAR BLK.P-15, RT/RW : 003/011, Kel/Desa : TUGU UTARA Kecamatan : KOJA', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(227, 'MUHAMMAD SULTAN ALGHIFARI', '3098696707', '3208100506090001', '2024', 'KUNINGAN', '2009-06-05', 'A', 'L', 'Perum Griya Sindang Asri RT 019 Rw 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(228, 'MUTYA AULIA SABINA', '83035672', '3208246612080003', '2024', 'KUNINGAN', '2008-12-26', 'A', 'P', 'DUSUN PUHUN RT 001 RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(229, 'NAURA SALSABILA QURRATU\'AIN', '93127027', '3208105307090003', '2024', 'KUNINGAN', '2009-07-13', 'A', 'P', 'Dusun Manis RT.002/RW.005 Desa Ciawigebang Kec. Ciawigebang Kab. Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(230, 'NAZWA SALSABILA', '98152312', '3208116608090001', '2024', 'KUNINGAN', '2009-08-26', 'A', 'P', 'Dusun manis RT.04 RW. 01 Desa Cihideunggirang', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(231, 'NUR SYIFA SALSA BILLA', '94663514', '3208276908090001', '2024', 'KUNINGAN', '2009-08-20', 'A', 'P', 'Jl. H. Sidik Rt.007 Rw.007', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(232, 'PUTRI SUCI NIRMALASARI', '91671491', '3208076102090003', '2024', 'CIAMIS', '2009-02-21', 'A', 'P', 'Dusun Manis RT 010 RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(233, 'RINDU AULYA PUTRI', '94020169', '3208315206090002', '2024', 'KUNINGAN JAWA BARAT', '2009-06-12', 'A', 'P', 'Rt04/Rw02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(234, 'SALWA SITI AMALIAH', '82298782', '3208275902080001', '2024', 'KUNINGAN', '2008-02-19', 'A', 'P', 'DUSUN PUHUN RT 006 RW 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(235, 'SHEIRA MAHDIYA KILA HAQANI', '89675888', '3273145810080001', '2024', 'BANDUNG', '2008-10-18', 'A', 'P', 'Perumahan Alam Asri Ciawigebang Jl. Gunung Karung No. C2', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(236, 'SITI MUBAROKAH', '98740826', '3208114609090001', '2024', 'KAB. KUNINGAN', '2009-09-06', 'A', 'P', 'Dusun Pahing Rt.003 Rw. 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(237, 'SITI SRI MULYANI SOLEHAH', '81935065', '3208116011080002', '2024', 'CIDAHU KUNINGAN', '2008-11-20', 'A', 'P', 'Dusun Pahing RT.03/RW.01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(238, 'WIKA NURMAYA', '86560535', '3329174908080002', '2024', 'BREBES', '2008-08-09', 'A', 'P', 'Malahayu Anjun', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(239, 'YUSUF MAULANA IBRAHIM', '89103143', '3208102605080001', '2024', 'KUNINGAN', '2008-05-26', 'A', 'L', 'Desa Kadurama Rt.01 Rw.03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(240, 'ZAHRA KHOERUNISA', '92039380', '3208114105090002', '2024', 'KUNINGAN', '2009-05-01', 'A', 'P', 'Dusun Puhun Rt.02 Rw.03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(241, 'AIRA OKTAVIANI', '3099348035', '3208324210090002', '2024', 'KUNINGAN', '2009-10-02', 'A', 'P', 'Desa Babakanjati', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(242, 'ALYA KINTANA HABIIBAH', '3085897542', '3208275612080001', '2024', 'KAB. KUNINGAN', '2008-12-16', 'A', 'P', 'Dusun Pahing Rt.011 Rw.002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(243, 'ANINDI RAFA NUR IZZATI', '91488110', '3208115802090001', '2024', 'KUNINGAN', '2009-02-18', 'A', 'P', 'Ds. Legok Dsn. Pohon RT. 001 RW. 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(244, 'ASMAHAN LUBIS', '88379231', '3173024711081001', '2024', 'JAKARTA', '2008-11-07', 'A', 'P', 'Dusun Manis, RT.004/RW.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(245, 'AULIA NURUL YUSRINA', '97758407', '3208317004090003', '2024', 'KUNINGAN', '2009-04-30', 'A', 'P', 'Dusun Wage Rt.001 Rw.002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(246, 'AULIA RAHMAWATI', '95731456', '3329124305090004', '2024', 'BREBES', '2009-05-03', 'A', 'P', 'RT.001/RW.003 Karangsambung', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(247, 'DEA NUR HIKMAH', '85818255', '3208114409080002', '2024', 'KUNINGAN', '2008-09-04', 'A', 'P', 'DUSUN KLIWON', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(248, 'DWI NUR WAHYU KUSUMA PUTRI', '82662472', '3208317011080003', '2024', 'KAB. KUNINGAN', '2008-11-30', 'A', 'P', 'DUSUN PUHUN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(249, 'FADIYA HASSYA IVANA', '95429994', '3208125501090001', '2024', 'KUNINGAN', '2009-01-15', 'A', 'P', 'Kamp.Cantilan RT.10 RW.04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(250, 'FARDAN ARDIANSYAH MUHAMAD PUTRA', '3092858952', '3204331606090002', '2024', 'BANDUNG', '2009-06-16', 'A', 'L', 'Jl. Letjend S. Parman Perum green Pabuaran', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(251, 'IBNU FATMANA', '71149677', '3208101910070001', '2024', 'KUNINGAN', '2007-10-19', 'A', 'L', 'Desa Ciawilor RT.03 RW.02 Kec.Ciawigebang Kab.Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(252, 'INSANNIA NUR AZZAHRA', '95763485', '3208304404090001', '2024', 'KUNINGAN', '2009-04-04', 'A', 'P', 'Dusun manis RT 05 RW 03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(253, 'JIHAN ALIP SITI ALIPAH', '91398840', '3208115904090001', '2024', 'KUNINGAN', '2009-04-19', 'A', 'P', 'Dusun Pahing RT 015 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(254, 'LIYA FADILAH', '96510016', '212207270', '2024', 'KUNINGAN', '2009-03-04', 'A', 'P', 'Dusun manis RT/RW 03/03 cipancur kec.kalimnggis kab Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16');
INSERT INTO `students` (`id`, `nama`, `nisn`, `nik`, `tahun_masuk`, `tempat_lahir`, `tanggal_lahir`, `status`, `jenis_kelamin`, `alamat`, `nama_ayah`, `nama_ibu`, `nama_wali`, `created_at`, `updated_at`) VALUES
(255, 'MAITSA FADILAH FAUZIYAH', '88352196', '32082869080001', '2024', 'KUNINGAN', '2008-09-20', 'A', 'P', 'Dusun Sukaraja Rt.007 w.004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(256, 'MOCHAMMAD RIVA FAUZIA DZAKIR', '99967202', '3208102505090005', '2024', 'KUNINGAN', '2009-05-25', 'A', 'L', 'DUSUN WAGE RT 02 RW 04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(257, 'MUHAMAD FACHRI SETIAWAN', '81646743', '3175071606080003', '2024', 'BEKASI', '2008-06-16', 'A', 'L', 'Rusun Klender Blok 42/I No. 2', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(258, 'MUHAMMAD ABDULLAH AFIF', '91106558', '3208102007090001', '2024', 'KUNINGAN', '2009-07-20', 'A', 'L', 'Kmp: Landeuh.  Dusun: manis.  RT:02 RW:01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(259, 'MUHAMMAD ISHAQ', '93938290', '3208213006090002', '2024', 'KUNINGAN', '2009-06-30', 'A', 'L', 'Dusun Puhun Rt 003 Rw 002 Desa Muncangela', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(260, 'MUHAMMAD SYAHIRUNNABIL', '81212464', '3172032107080011', '2024', 'JAKARTA', '2008-07-21', 'A', 'L', 'Ds Cimulya RT3 RW5', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(261, 'NABIL RIZAKI HABIBI', '96126555', '3208111810090001', '2024', 'KUNINGAN', '2009-10-18', 'A', 'L', 'Dusun Pahing Rt. 003 Rw. 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(262, 'NABILA FARIHATUL JANNAH', '92939737', '3208066106090002', '2024', 'KUNINGAN', '2009-06-21', 'A', 'P', 'DUSUN 1 RT 004/ RW 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(263, 'NAURA SYAHIRA NURSHAFA', '92742883', '3208104401090003', '2024', 'KUNINGAN', '2009-01-04', 'A', 'P', 'DUSUN PAHING RT 003/ RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(264, 'NIA HERAWATI', '81430600', '3208274505080002', '2024', 'KUNINGAN', '2008-05-05', 'A', 'P', 'Dusun pahing Rt. 07 Rw. 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(265, 'NURAINI AGUSTIN', '94886626', '3208314808090001', '2024', 'KUNINGAN', '2009-09-09', 'A', 'P', 'Kampung pahing desa kertayasa', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(266, 'RAHMADINA NUR FITRIANI', '82376370', '3208210801700001', '2024', 'KUNINGAN', '2008-09-22', 'A', 'P', 'Desa Cimarenten Dusun 2 RT/RW 10/04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(267, 'REZKI FADILLAH', '99809575', '3208241806090002', '2024', 'KUNINGAN', '2009-06-18', 'A', 'L', 'Dusun Kliwon Rt. 003 Rw. 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(268, 'RIRI RIFATUL HASANAH', '88045573', '3208276310080001', '2024', 'KUNINGAN', '2008-10-13', 'A', 'P', 'Dusun Puhun Rt. 003 Rw.004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(269, 'SASKIA NAFISATU ROHMAH', '89118116', '3208104309080001', '2024', 'KUNINGAN', '2008-09-03', 'A', 'P', 'Dusun Wage, RT.010/RW.004 Desa Pangkalan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(270, 'SITI NAILA MUSTAGIMAH', '97452175', '3208106102090002', '2024', 'KUNINGAN', '2009-02-21', 'A', 'P', 'dusun pahing Rt. 05 Rw. 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(271, 'SITI TUPAHATI SALWA', '89076374', '3208275410080001', '2024', 'KUNINGAN', '2008-10-14', 'A', 'P', 'Dusun Puhun RT 001 RW 002 Desa Cipancur', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(272, 'WILDAN BADRU ZAMMAN', '81704367', '3208041810080002', '2024', 'KUNINGAN', '2008-10-18', 'A', 'L', 'DUSUN KLIWON II RT/RW 016/006', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(273, 'ZAKIYA MUTMAINNAH', '97656736', '3208106410090002', '2024', 'KUNINGAN', '2009-10-24', 'A', 'P', 'DUSUN SITU RT 003 RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(274, 'AMANDA ZAHRA AULIA RAMADHANI', '97846947', '3208117108090001', '2024', 'KUNINGAN', '2009-08-31', 'A', 'P', 'Desa kertawinangun, dusun keliwon, RT03, RW01, kecamatan Cidahu kabupaten Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(275, 'ANISA FITRIYANI', '98675363', '3208104606090002', '2024', 'KUNINGAN', '2009-06-06', 'A', 'P', 'Rt/03 RW/03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(276, 'AULIA ZAHRA', '81294327', '3208065408080001', '2024', 'KUNINGAN', '2008-08-14', 'A', 'P', 'Blok Puhun', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(277, 'AULIA ZAHRA', '3080085429', '3208305708080001', '2024', 'KUNINGAN', '2008-08-17', 'A', 'P', 'Desa Manggari dusun oleced rt 01 rw 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(278, 'AURA MEILANI', '91705218', '3175044605091004', '2024', 'JAKARTA', '2009-05-06', 'A', 'P', 'Dusun Pahing RT 003 RW 001 Desa Lebaksiuh', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(279, 'AZRIEL KIFAHUL AL-MUHAYIR', '86848568', '3208052907080002', '2024', 'KUNINGAN', '2008-07-29', 'A', 'L', 'Dusun 1 Rt. 005 Rw.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(280, 'DESI NURAENI', '83962526', '3208274512080001', '2024', 'KUNINGAN', '2008-12-05', 'A', 'P', 'Dusun wage RT02 Rw02, desa kertawana', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(281, 'ERLIN REWINDA', '97138686', '3208105404090002', '2024', 'KUNINGAN', '2009-04-14', 'A', 'P', 'Dusun Kramat RT. 003 RW. 002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(282, 'FATAH ZHAHROATUL SIYAM', '98829622', '3208113008090001', '2024', 'KAB. KUNINGAN', '2009-08-30', 'A', 'L', 'Dusun Pahing Rt. 001 Rw.003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(283, 'FINA CHRISTININGRUM', '91930208', '3273046803080004', '2024', 'KUNINGAN', '2009-03-08', 'A', 'P', 'Dusun kliwon 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(284, 'IBNU MAS\'UD', '96325725', '3208280411090001', '2024', 'KUNINGAN', '2009-11-04', 'A', 'L', 'Dusun 2 rt 04/rw 03 blok mangen', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(285, 'JHINGGA JULYA GUNADI', '94913068', '1301074507090002', '2024', 'JAKARTA', '2009-07-05', 'A', 'P', 'Desa Kadurama', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(286, 'JUNAYAH', '97007577', '3208105005090001', '2024', 'KAB. KUNINGAN', '2009-05-10', 'A', 'P', 'Dusun Pahing Rt. 001 Rw.001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(287, 'LUNA ROSA RAHMADIAN', '93292816', '3208216106090001', '2024', 'KUNINGAN', '2009-06-21', 'A', 'P', 'DUSUN KLIWON RT 001/ RW 001 SALAREUMA', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(288, 'MARSYA OKTARI SYAFITRI', '92128792', '3171035510091006', '2024', 'KAB. KUNINGAN', '2009-10-15', 'A', 'P', 'Dusun tengah, RT 07 RW 02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(289, 'MUHAMAD RIDWAN NULOH APANDI', '81968835', '3208231911080001', '2024', 'KUNINGAN', '2008-11-19', 'A', 'L', 'RT 003 RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(290, 'MUHAMMAD ALFI MUBAROK', '3094499094', '3208100903090004', '2024', 'KUNINGAN', '2009-03-09', 'A', 'L', 'Dusun Wage RT 16 RW 004 Desa Sidaraja', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(291, 'MUHAMMAD FACHRI BILAD', '98971109', '3208290205090001', '2024', 'KUNINGAN', '2009-05-02', 'A', 'L', 'DUSUN GUNUNGJAWA RT/RW 009/004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(292, 'MUHAMMAD LUTHFI FAUZY NUGROHO', '3094033223', '3208300405090001', '2024', 'KUNINGAN', '2009-05-04', 'A', 'L', 'Dusun Kliwon Rt.002 Rw.001 Desa Kutaraja', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(293, 'MUHAMMAD WILDAN HILNANDA', '98068534', '3208212103090001', '2024', 'KUNINGAN', '2009-03-21', 'A', 'L', 'Dusun Manis RT.01 RW.01 Desa Muncangela Kec.Cipicung', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(294, 'NADIA AFRA AULIA', '93310738', '3208107107090002', '2024', 'KUNINGAN', '2009-07-31', 'A', 'P', 'Dusun puhun RT 2 RW 2', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(295, 'NAUVAL IKHSAN ZAMZAMI', '81167036', '3208102911080004', '2024', 'KUNINGAN', '2008-11-29', 'A', 'L', 'Blok kramat rt:003 rw:002', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(296, 'NAZALA ZIYADATUN NIKMAH', '95226622', '3208275811820002', '2024', 'KUNINGAN', '2008-08-19', 'A', 'P', 'DUSUN PAHING RT 006/ RW 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(297, 'NIDAA NUR JANNAH', '3083351852', '3208105107080004', '2024', 'KUNINGAN', '2008-07-11', 'A', 'P', 'Dusun Manis Rt. 5 Rw. 1', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(298, 'NUR AZIZAH', '83989166', '3215016811080004', '2024', 'KARAWANG', '2008-11-28', 'A', 'P', 'RT.03/RW.03 Desa Geresik', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(299, 'NURI AINUN HAYAH', '98687896', '3208075002090001', '2024', 'KUNINGAN', '2009-02-10', 'A', 'P', 'Dusun Manis Rt.02 Rw. 01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(300, 'REFA SETIYANA', '98859978', '3208244907090002', '2024', 'KUNINGAN', '2009-07-09', 'A', 'P', 'Dusun acoran', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(301, 'RIRIN SITI KHOERIYAH', '91833807', '3208076909090001', '2024', 'KUNINGAN', '2009-09-29', 'A', 'P', 'Dusun Puhun RT 10 RW 04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(302, 'SHERLY PATA WULANDARI', '88119727', '3208115301080002', '2024', 'KUNINGAN', '2008-01-13', 'A', 'P', 'Desa Cidahu, Dusun Puhun, RT.01/RW.02', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(303, 'SHOLIHATUL UMMAH', '83840071', '0', '2024', 'KUNINGAN', '2008-07-21', 'A', 'P', 'Partawangunan RT 11 RW 2 dusun manis kec', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(304, 'SILPI AULIA ROHMAH', '89050153', '3208115712080003', '2024', 'KUNINGAN', '2008-12-17', 'A', 'P', 'Desa Cihideunggirang RT 002 RW 003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(305, 'SITI NUR AZIZAH', '3098086256', '3208314903090001', '2024', 'KUNINGAN', '2009-03-09', 'A', 'P', 'Dusun wage rt 11 rw 04', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(306, 'SYIFA SURYANI', '99572933', '3208265602090001', '2024', 'KUNINGAN', '2009-02-16', 'A', 'P', 'Dusun Ciasuhan Rt 003 Rw 001', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(307, 'WINDA TRIANI', '97715316', '3208315107090002', '2024', 'KUNINGAN', '2009-07-11', 'A', 'P', 'Desa Taraju rt 21 rw 4 sindangagung kuningan jawa barat', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(308, 'WISNU PUTRA SEJATI', '94895116', '3274011010090002', '2024', 'INDRAMAYU', '2009-10-10', 'A', 'L', 'Dusun Manis Rt.02 Rw.01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(309, 'AL-AYIF ISMAIL', '87870414', '3208101110080003', '2024', 'KUNINGAN', '2008-10-11', 'A', 'L', 'Dusun Pon, RT.006/RW.008 Desa Geresik', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(310, 'ALICIA NURUL AZKIYATUL FUADAH', '91200438', '3208274902090001', '2024', 'KUNINGAN', '2009-02-09', 'A', 'P', 'Dusun puhun rt006/rw004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(311, 'ANASTASYA PUTRI', '88258620', '3208215311080003', '2024', 'TANGERANG', '2008-11-13', 'A', 'P', 'Dusun 1 cipicung', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(312, 'ANJAR FEBRIYANA', '96595432', '3208210102090001', '2024', 'KUNINGAN', '2009-02-01', 'A', 'L', 'Rt:4 Rw:5', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(313, 'AUREL PRANDIATI', '88498841', '3208276010080001', '2024', 'KUNINGAN', '2008-10-20', 'A', 'P', 'Dusun puhun', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(314, 'AYU RAHMAWATI', '87741093', '3208276806080001', '2024', 'KAB. KUNINGAN', '2008-06-28', 'A', 'P', 'Dusun manis Rt.001 Rw.003', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(315, 'BAGUS DWI HARDIANSYAH', '92875675', '3208112706090001', '2024', 'CIREBON', '2009-06-27', 'A', 'L', 'DUSUN PUHUN', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(316, 'DINDA KIRANIA', '81875795', '3208315709080003', '2024', 'KUNINGAN', '2008-09-17', 'A', 'P', 'JL.pasirjati, kertaungaran, RT 11, RW 06,dusun Wage,kec sindangagung', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(317, 'FARHATUL MUSYAROFAH', '83756779', '3208225910080001', '2024', 'KUNINGAN,', '2008-10-19', 'A', 'P', 'dusun karangwangi', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(318, 'FAWWAZ DZAKIRI ANNAJMI', '95385010', '3208180901090001', '2024', 'KAB. KUNINGAN', '2009-01-09', 'A', 'L', 'Dusun Pahing', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(319, 'FINKA NURBAETY', '94131910', '3208285702090001', '2024', 'KUNINGAN', '2009-02-17', 'A', 'P', 'RT 07 RW 04 dusun 2 Sukaraja Desa Sukarapih', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(320, 'IKIN SODIKIN', '86207651', '3208210612080002', '2024', 'KUNINGAN', '2008-12-06', 'A', 'L', 'Dusun Pahing RT/06 RW/03', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(321, 'KAEILANI SOEDARSONO', '3096076291', '3210110305090021', '2024', 'MAJALENGKA', '2009-05-03', 'A', 'P', 'Perum Graha Mutiara Blok A4/01', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(322, 'KARMILA', '85175632', '3208104308080001', '2024', 'KUNINGAN', '2008-08-03', 'A', 'P', 'Dusun kliwon RT.002/RW.003 Desa Sukadana Kec. Ciawigebang Kab. Kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(323, 'MAURA HARFIYANI PERTIWI', '87592545', '3671134603080004', '2024', 'KUNINGAN', '2008-03-06', 'A', 'P', 'Jl. INPRES V NO 13 RT/RW 002/013 KELURAHAN GAGA, KECAMATAN LARANGAN, KOTA TANGERANG', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(324, 'MEIRA KHARIDA JANNAH', '91141451', '3208078405090001', '2024', 'KUNINGAN', '2009-05-24', 'A', 'P', 'Dusun IV Rt. 016 Rw. 004', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(325, 'MUHAMAD RIFAL', '85596495', '3208270701080001', '2024', 'KUNINGAN', '2008-01-07', 'A', 'L', 'Dusun Wage Rt 002 Rw 002 Desa Kertawana Kecamatan Kalimanggis', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(326, 'MUHAMMAD ALVAN NUGRAHA', '83214856', '3208210311080001', '2024', 'KUNINGAN', '2008-11-03', 'A', 'L', 'dusun wage rt.008/004 desa muncangela', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(327, 'MUHAMMAD NAJMUDIIN', '88438902', '3276011911080002', '2024', 'DEPOK', '2008-11-19', 'A', 'L', 'Jl.Cidahu, rt 01/02, dusun pahing', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(328, 'MUHAMMAD ZAIDAN HIBATULLAH', '87366190', '3208090702065052', '2024', 'KUNINGAN', '2008-11-01', 'A', 'L', 'Jl. Pramuka no 330 kel Purwawinangun, kec kuningan, kab. kuningan', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(329, 'NADIN REYHANA SALWA', '94889099', '3208284105090002', '2024', 'KUNINGAN', '2009-05-01', 'A', 'P', 'Dusun III RT 004 RW 006', '', '', '', '2026-08-14 02:24:16', '2026-08-14 02:24:16'),
(330, 'NAJZIA ESSI ASSYDIQI', '3080538225', '3208106211080005', '2024', 'KUNINGAN', '2008-11-22', 'A', 'P', 'DUSUN SITU RT 001 RW 001', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(331, 'NAZWA RAHMANIA PUTRI', '3098737638', '3208054106090002', '2024', 'JAKARTA', '2009-06-01', 'A', 'P', 'KMP. SUKASARI RT 003 RW 002', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(332, 'NIHAYATUL FITRIYAH', '77788614', '3208105805090002', '2024', 'KUNINGAN', '2009-05-18', 'A', 'P', 'Dusun manis RT 001 RW 004', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(333, 'NURUL NAZWA', '3096055234', '3208104703090004', '2024', 'TEGAL', '2009-03-07', 'A', 'P', 'Dusun Manis Rt. 003 Rw. 003', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(334, 'REZZA NUR AZIZAH', '96587576', '3208075106090003', '2024', 'KUNINGAN', '2009-06-11', 'A', 'P', 'Dusun IV Rt16/Rw04 Desa Bendungan Kec. Lebakwangi kab. Kuningan Jawa Barat', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(335, 'RIZKIA FARHAH TSANI', '75970037', '3208314810070001', '2024', 'KUNINGAN', '2007-10-08', 'A', 'P', 'Dusun Manis Rt.003 Rw. 002', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(336, 'SHEZA GHEFIRA AZIZAH', '84348917', '3208316212080001', '2024', 'KUNINGAN', '2008-12-22', 'A', 'P', 'Dusun manis RT 001/ RW 001', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(337, 'SILPI SALPIANI', '84816066', '3208114606080004', '2024', 'KUNINGAN', '2008-06-06', 'A', 'P', 'DUSUN PUHUN DESA NANGGELA KEC. CIDAHU', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(338, 'SRI HARYATI', '81456673', '3208286310080001', '2024', 'KUNINGAN', '2008-10-23', 'A', 'P', 'DUSUN II RT 005 RW 003', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(339, 'SUSI SUSILAWATI', '85042059', '3208244312080001', '2024', 'KUNINGAN', '2008-02-04', 'A', 'P', 'Dusun 1 Rt 1 Rw 1', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(340, 'YUNITA KHAYRANI PRIMAWATI', '96501329', '3208105406090003', '2024', 'KUNINGAN', '2009-06-14', 'A', 'P', 'Kab Kuningan, Kec Ciawigebang, Desa sukadana, blok manis, rt 04 rw 04', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(341, 'ZANNUBA ADWA SYAUQIYA', '91842044', '3217104906090004', '2024', 'KUNINGAN', '2009-06-09', 'A', 'P', 'Blok Pahing Rt.04 Rw. 02', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(342, 'HAIDAR AHMAD MUSLIH', '71847835', '123456789', '2024', 'Bekasi', '2007-06-28', 'A', 'L', 'Desa Tarik Kolot Dusun 2 RT.02 RW.02 Kecamatan Ciberem Kuningan', '', '', '', '2026-08-14 02:24:17', '2026-08-14 02:24:17'),
(343, 'AZIZ HUMAEDI', '0083115245', '-', '2014', 'KUNINGAN', '2016-02-01', 'A', 'L', 'kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 18:50:04', '2026-08-18 18:50:04'),
(344, 'AZIZ HUMAEDI', '0083115245', '-', '2024', 'KUNINGAN', '2016-01-01', 'A', 'L', 'kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 18:54:11', '2026-08-18 18:54:11'),
(345, 'ERLAND GAVYN MARVELINO', '0099904834', '-', '2024', 'KUNINGAN', '2016-02-02', 'A', 'L', 'kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 18:56:16', '2026-08-18 18:56:16'),
(346, 'HALIZA SYIFA VANIA', '0089810678', '-', '2024', 'KUNINGAN', '2016-03-03', 'A', 'P', 'Kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 18:58:03', '2026-08-18 19:00:06'),
(347, 'KANSA PUTRI BILQIS ATHOBARI', '3083142795', '-', '2024', 'KUNINGAN', '2016-04-04', 'A', 'P', 'Kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 19:00:58', '2026-08-18 19:00:58'),
(348, 'MUHAMMAD GHIFFARI', '3072550798', '-', '2024', 'KUNINGAN', '2016-05-05', 'A', 'L', 'Kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 19:03:40', '2026-08-18 19:03:40'),
(349, 'MUHAMMAD RONI NUGRAHA', '0094706556', '-', '2024', 'KUNINGAN', '2016-06-06', 'A', 'L', 'Kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 19:05:55', '2026-08-18 19:05:55'),
(350, 'NASHI ULWAN', '0082686983', '-', '2024', 'KUNINGAN', '2016-07-07', 'A', 'L', 'Kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 19:08:41', '2026-08-18 19:08:41'),
(351, 'NAYLA TAZKIYATUL MUNIROH', '0098292938', '-', '2024', 'KUNINGAN', '2016-07-07', 'A', 'P', 'Kuningan', '-', '-', 'Hj. MERDEWI, S.Pd., M.Pd', '2026-08-18 19:10:16', '2026-08-18 19:10:16'),
(352, 'ANNISA TUL FITRI', '0086746676', '-', '2024', 'KUNINGAN', '2016-08-08', 'A', 'P', 'Kuningan', '-', '-', 'LUSI LUTHFIATI RAMDLIYANI, S.Pd.I', '2026-08-18 19:21:58', '2026-08-18 19:21:58'),
(353, 'HADRIAN KUSUMA', '0099297264', '-', '2024', 'KUNINGAN', '2016-09-09', 'A', 'L', 'Kuningan', '-', '-', 'LUSI LUTHFIATI RAMDLIYANI, S.Pd.I', '2026-08-18 19:25:10', '2026-08-18 19:25:10'),
(354, 'ADINDA ASYFI INDANA', '0981223456', '-', '2024', 'KUNINGAN', '2016-10-10', 'A', 'P', 'Kuningan', '-', '-', 'Hj. YAYAH RODIYAH, S.Pd.', '2026-08-18 19:35:33', '2026-08-18 19:35:33'),
(355, 'KHOLISOTUL FITRIAH', '0096342432', '-', '2024', 'KUNINGAN', '2016-11-11', 'A', 'P', 'Kuningan', '-', '-', 'Hj. YAYAH RODIYAH, S.Pd.', '2026-08-18 19:40:31', '2026-08-18 19:40:31'),
(356, 'MUHAMMAD LUTHFI FAUZI NUGROHO', '3094033223', '-', '2024', 'KUNINGAN', '2016-11-11', 'A', 'L', 'Kuningan', '-', '-', 'Hj. YAYAH RODIYAH, S.Pd.', '2026-08-18 19:42:33', '2026-08-18 19:42:33'),
(357, 'SITI FATIMATUL AZZAHRA', '0094378252', '-', '2024', 'KUNINGAN', '2016-12-12', 'A', 'P', 'Kuningan', '-', '-', 'Hj. YAYAH RODIYAH, S.Pd.', '2026-08-18 19:47:38', '2026-08-18 19:47:38'),
(358, 'NAILUL MUNA', '0099709750', '-', '2024', 'KUNINGAN', '2016-12-13', 'A', 'P', 'Kuningan', '-', '-', 'EUIS KURNIASARI, S.Pd.I', '2026-08-18 19:55:07', '2026-08-18 19:55:07'),
(359, 'SITI SOVIAH', '0074034030', '-', '2024', 'KUNINGAN', '2016-12-14', 'A', 'P', 'Kuningan', '-', '-', 'EUIS KURNIASARI, S.Pd.I', '2026-08-18 19:58:46', '2026-08-18 19:58:46'),
(360, 'FAZRI ANDRIANSYAH', '0096743871', '-', '2024', 'KUNINGAN', '2016-12-14', 'A', 'L', 'Kuningan', '-', '-', 'RIZAL MAULANA, S.Pd.', '2026-08-18 20:07:02', '2026-08-18 20:07:02'),
(361, 'JIAN SALSABILA KHAIRUNNISA', '009520786', '-', '2024', 'KUNINGAN', '2016-12-15', 'A', 'P', 'Kuningan', '-', '-', 'RIZAL MAULANA, S.Pd.', '2026-08-18 20:09:04', '2026-08-18 20:09:04'),
(362, 'MUHAMMAD ALIF', '0096313069', '-', '2024', 'KUNINGAN', '2016-12-16', 'A', 'L', 'Kuningan', '-', '-', 'RIZAL MAULANA, S.Pd.', '2026-08-18 20:11:15', '2026-08-18 20:11:15'),
(363, 'KAEILANI SOEDARSONO', '3096076291', '-', '2024', 'KUNINGAN', '2016-12-16', 'A', 'P', 'Kuningan', '-', '-', 'REPI TRI ASTUTI, S.Pd.', '2026-08-18 20:17:04', '2026-08-18 20:17:04'),
(364, 'KAEILANI SOEDARSONO', '3096076291', '-', '2024', 'KUNINGAN', '2016-12-16', 'A', 'L', 'Kuningan', '-', '-', 'REPI TRI ASTUTI, S.Pd.', '2026-08-18 20:19:28', '2026-08-18 20:19:28'),
(365, 'ADILLA HAFIZH ALBAR', '0082472074', '-', '2024', 'KUNINGAN', '2008-11-11', 'A', 'L', 'Kuningan', '-', '-', 'MUHAMMAD TAUFIK HIDAYAT, S.Pd', '2026-08-18 21:15:38', '2026-08-18 21:15:38'),
(366, 'NUR KHOLIFAH', '0081987651', '-', '2024', 'KUNINGAN', '2008-12-12', 'A', 'P', 'Kuningan', '-', '-', 'MUHAMMAD TAUFIK HIDAYAT, S.Pd', '2026-08-18 21:24:20', '2026-08-18 21:24:20'),
(367, 'GHINA ZAKIYYAH EL GRISKA', '3092349116', '-', '2024', 'KUNINGAN', '2008-12-20', 'A', 'P', 'Kuningan', '-', '-', 'IKA KURNIAWATI, S.Pd.', '2026-08-18 21:30:49', '2026-08-18 21:30:49'),
(368, 'HANI ABDURRAHIM AR-RIFAI', '0083115244', '-', '2024', 'KUNINGAN', '2008-12-12', 'A', 'L', 'Kuningan', '-', '-', 'IKA KURNIAWATI, S.Pd.', '2026-08-18 21:32:44', '2026-08-18 21:32:44'),
(369, 'ADI DARMAWAN', '0081085363', '-', '2024', 'KUNINGAN', '2008-12-23', 'A', 'L', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:10:43', '2026-08-19 18:10:43'),
(370, 'ALIYA AN NADHZIFAH', '0086753496', '-', '2024', 'KUNINGAN', '2009-08-20', 'A', 'P', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:16:41', '2026-08-19 18:16:41'),
(371, 'MUHAMAD GILANG PERMANA', '3091326203', '-', '2024', 'KUNINGAN', '2009-12-20', 'A', 'L', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:22:11', '2026-08-19 18:22:11'),
(372, 'MUHAMAD PAKIH RAMDANI', '0098137972', '-', '2024', 'KUNINGAN', '2008-02-02', 'A', 'L', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:25:01', '2026-08-19 18:25:01'),
(373, 'SALSA HIBATILLAH ASSAHYRA', '3099753756', '-', '2024', 'KUNINGAN', '2009-12-10', 'A', 'P', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:28:38', '2026-08-19 18:28:38'),
(374, 'SERGIO NABIL ANNAJMI', '3097131733', '-', '2024', 'KUNINGAN', '2009-12-12', 'A', 'L', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:30:14', '2026-08-19 18:30:14'),
(375, 'SHOLIHATUL UMMAH', '0083840071', '-', '2024', 'KUNINGAN', '2008-10-10', 'A', 'P', 'Kuningan', '-', '-', 'ASEP WAHYUDIN,S.Pd.', '2026-08-19 18:32:44', '2026-08-19 18:32:44'),
(376, 'AISYAH NURFITRIA', '0097630942', '-', '2024', 'KUNINGAN', '2008-10-10', 'A', 'P', 'Kuningan', '-', '-', 'Hj. IMAS MAESYAROH, M.Pd.I', '2026-08-19 18:36:29', '2026-08-19 18:36:29'),
(377, 'ALSYA LISTAMI PUTRI', '0083242337', '-', '2024', 'KUNINGAN', '2008-12-10', 'A', 'P', 'Kuningan', '-', '-', 'Hj. IMAS MAESYAROH, M.Pd.I', '2026-08-19 18:37:35', '2026-08-19 18:37:35'),
(378, 'PADLI', '0091302900', '-', '2024', 'KUNINGAN', '2008-08-08', 'A', 'L', 'Kuningan', '-', '-', 'Hj. IMAS MAESYAROH, M.Pd.I', '2026-08-19 18:42:38', '2026-08-19 18:42:38'),
(379, 'ABDULLAH AHNAF DZULFIKAR', '3099506944', '-', '2025', 'Kuningan', '2010-01-01', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(380, 'ADI TRIA NUGRAHA', '94549296', '-', '2025', 'Kuningan', '2010-01-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(381, 'AFREZA JALALUDIN RUMI', '105330998', '-', '2025', 'Kuningan', '2010-01-03', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(382, 'AHMAD FIKRI WIJAYA', '3095750791', '-', '2025', 'Kuningan', '2010-01-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(383, 'ALDI PRASETYA NUGRAHA', '109694331', '-', '2025', 'Kuningan', '2010-01-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(384, 'ALISA KANIA DEWI', '99210942', '-', '2025', 'Kuningan', '2010-01-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(385, 'ANANDA GALANG FIRMANSYAH', '94300475', '-', '2025', 'Kuningan', '2010-01-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(386, 'CINTYA SHAFA RAIDAH', '106995054', '-', '2025', 'Kuningan', '2010-01-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(387, 'DEMIAN PUTRA MILANISTI', '101419281', '-', '2025', 'Kuningan', '2010-01-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(388, 'DINI AULIA FITRI', '101649088', '-', '2025', 'Kuningan', '2010-01-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(389, 'FAKHRI AGIL ZULFIKRI', '3102264880', '-', '2025', 'Kuningan', '2010-01-11', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(390, 'FAZRIN FATIHATUL ALIF', '3104239644', '-', '2025', 'Kuningan', '2010-01-12', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(391, 'HISYAM MUHAMAD ZAIN', '103867510', '-', '2025', 'Kuningan', '2010-01-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(392, 'KEYZA DYA\'URROHMAH', '87818936', '-', '2025', 'Kuningan', '2010-01-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(393, 'MAHARANI RAKA PUTRI', '104771163', '-', '2025', 'Kuningan', '2010-01-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(394, 'MALIQ ANUAR ALFARABI', '103621670', '-', '2025', 'Kuningan', '2010-01-16', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(395, 'MOHAMMAD FARID AL PINO', '101158899', '-', '2025', 'Kuningan', '2010-01-17', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(396, 'MUHAMAD NUR IKHSAN', '3090301982', '-', '2025', 'Kuningan', '2010-01-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(397, 'MUHAMMAD EGAS REVIANA', '91343983', '-', '2025', 'Kuningan', '2010-01-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(398, 'NADIA GHEFIRA FAUZIAH', '3109929881', '-', '2025', 'Kuningan', '2010-01-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(399, 'RAFA AFTABUDDIN ', '3108735674', '-', '2025', 'Kuningan', '2010-01-21', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(400, 'ROSAILA NURUL AULIA', '97762952', '-', '2025', 'Kuningan', '2010-01-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(401, 'SAFA ALZENA AFIFAH', '105896529', '-', '2025', 'Kuningan', '2010-01-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(402, 'SATRIA DZIKRI AMIRULLAH', '99220794', '-', '2025', 'Kuningan', '2010-01-24', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(403, 'SHEILA SAKHI VITUGRAH', '106506706', '-', '2025', 'Kuningan', '2010-01-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(404, 'SIDIK MUHAMMAD APRIANTO', '3104696131', '-', '2025', 'Kuningan', '2010-01-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(405, 'SINDI APRILIYANI', '103872493', '-', '2025', 'Kuningan', '2010-01-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(406, 'SITI PADILAH', '3085022977', '-', '2025', 'Kuningan', '2010-01-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'EDY MUHARYANTO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(407, 'ADIT RAHAYU', '97947490', '-', '2025', 'Kuningan', '2010-01-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(408, 'AHMAD ZAKY MAULANA', '101281162', '-', '2025', 'Kuningan', '2010-01-30', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(409, 'ALMIRA FITRIANI ULFACH', '96783019', '-', '2025', 'Kuningan', '2010-01-31', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(410, 'ANISA RAMADHANI', '99526306', '-', '2025', 'Kuningan', '2010-02-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(411, 'ARDHAN FIRDAUS', '106779975', '-', '2025', 'Kuningan', '2010-02-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(412, 'FAHMI AGUNG MIFTAH SIDIK', '3092726472', '-', '2025', 'Kuningan', '2010-02-03', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(413, 'FARIS HAFIDZ DZIKRI ', '95524280', '-', '2025', 'Kuningan', '2010-02-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(414, 'FATHIMAH NAJMA TSAKIB', '3101235678', '-', '2025', 'Kuningan', '2010-02-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(415, 'HENDRIK', '91422478', '-', '2025', 'Kuningan', '2010-02-06', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(416, 'IKBAL PATUR ROHMAN', '109452137', '-', '2025', 'Kuningan', '2010-02-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(417, 'INDI KHOIRI', '93485054', '-', '2025', 'Kuningan', '2010-02-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(418, 'IZZATULFAIZ MUSHLIH MUHARIQ', '91597220', '-', '2025', 'Kuningan', '2010-02-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(419, 'MELAN PAJARINA', '91907512', '-', '2025', 'Kuningan', '2010-02-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(420, 'MUHAMAD IPANK ALFARIZI', '111262202', '-', '2025', 'Kuningan', '2010-02-11', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(421, 'MUHAMAD IRSYAD HAFIFUDIN', '105707931', '-', '2025', 'Kuningan', '2010-02-12', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(422, 'MUHAMAD KHIAR', '91680875', '-', '2025', 'Kuningan', '2010-02-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(423, 'MUHAMAMAD BINTANG JAELANI', '92447725', '-', '2025', 'Kuningan', '2010-02-14', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(424, 'MUHAMMAD HADI DULFIKAR', '3096040554', '-', '2025', 'Kuningan', '2010-02-15', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(425, 'MUHAMMAD HAFIZ', '106754036', '-', '2025', 'Kuningan', '2010-02-16', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(426, 'MUHAMMAD NUR AGIS', '97898890', '-', '2025', 'Kuningan', '2010-02-17', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(427, 'PUTRI INTAN RAMADHANI', '3108013269', '-', '2025', 'Kuningan', '2010-02-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(428, 'PUTRI QAIREEN AFIFAH LATUNNISA', '103390396', '-', '2025', 'Kuningan', '2010-02-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(429, 'PUTRI ZAENATUL MA\'WA', '92828158', '-', '2025', 'Kuningan', '2010-02-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(430, 'REVANI ALICIA PUTRI', '105553627', '-', '2025', 'Kuningan', '2010-02-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(431, 'RIZQIA KHAIRUNNISA', '105759326', '-', '2025', 'Kuningan', '2010-02-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(432, 'SABRINA ADISTY SALSABILA', '102746886', '-', '2025', 'Kuningan', '2010-02-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(433, 'WILY SANTOSO', '93322104', '-', '2025', 'Kuningan', '2010-02-24', 'Aktif', 'L', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(434, 'ZHAAFIRA NABILA SALIMA', '109564134', '-', '2025', 'Kuningan', '2010-02-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'IWAN SETIAWAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(435, 'ADIT RAMADAN', '101059874', '-', '2025', 'Kuningan', '2010-02-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(436, 'AINIYA FAIDA AZMI', '101339369', '-', '2025', 'Kuningan', '2010-02-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(437, 'AIRA SYAHIRA', '103046061', '-', '2025', 'Kuningan', '2010-02-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(438, 'AISYAH SITI FATIMAH', '104315869', '-', '2025', 'Kuningan', '2010-03-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(439, 'AIZAR FAIQUL UMAM', '94807656', '-', '2025', 'Kuningan', '2010-03-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(440, 'DALFA AUFA NURDZIHNI', '107163255', '-', '2025', 'Kuningan', '2010-03-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(441, 'DEPITA IKAWATI', '103780970', '-', '2025', 'Kuningan', '2010-03-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(442, 'DINI AMINARTI', '93734896', '-', '2025', 'Kuningan', '2010-03-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(443, 'EGHIE FARIATUL AZIZAH ', '95321427', '-', '2025', 'Kuningan', '2010-03-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(444, 'FAHRI HUSAENI', '104321515', '-', '2025', 'Kuningan', '2010-03-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(445, 'FAISAL DESPRILIADI', '92652517', '-', '2025', 'Kuningan', '2010-03-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(446, 'FIFIN SOFIATUN', '107414907', '-', '2025', 'Kuningan', '2010-03-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(447, 'HUSEIN FAKHRULLAH', '103749974', '-', '2025', 'Kuningan', '2010-03-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(448, 'HUSNA KHOIRUL ATHIYYAH', '91188671', '-', '2025', 'Kuningan', '2010-03-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(449, 'LAESA NUR AULIA', '3093067065', '-', '2025', 'Kuningan', '2010-03-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(450, 'MUHAMAD FIKRI PERMANA', '3098465426', '-', '2025', 'Kuningan', '2010-03-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(451, 'MYSHA AZKARINA HAURAHAYUN', '3101312607', '-', '2025', 'Kuningan', '2010-03-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(452, 'NADIA HANIFAH', '93806242', '-', '2025', 'Kuningan', '2010-03-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(453, 'NATASYA NUR SABITA', '108829438', '-', '2025', 'Kuningan', '2010-03-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(454, 'NURLELA', '103526147', '-', '2025', 'Kuningan', '2010-03-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(455, 'NURWITA MAHARANI', '104469994', '-', '2025', 'Kuningan', '2010-03-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(456, 'PRIMANINDA', '109749099', '-', '2025', 'Kuningan', '2010-03-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(457, 'RIA RATNASARI', '97682139', '-', '2025', 'Kuningan', '2010-03-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(458, 'RIDHA KHOERUNISA ', '3103591988', '-', '2025', 'Kuningan', '2010-03-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(459, 'SALSABILA KHOIRUN NISA ', '106454923', '-', '2025', 'Kuningan', '2010-03-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(460, 'SITI NURJANNAH', '103668158', '-', '2025', 'Kuningan', '2010-03-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(461, 'SITI UMAYAH', '96005206', '-', '2025', 'Kuningan', '2010-03-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(462, 'TASYA AL-HADI', '3109673459', '-', '2025', 'Kuningan', '2010-03-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. AAM SITI AMANAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(463, 'ADINDA NADIA BIBAH', '3103672791', '-', '2025', 'Kuningan', '2010-03-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(464, 'AGNIA SALSABILA NI\'MATUL MAULIA', '91458182', '-', '2025', 'Kuningan', '2010-03-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(465, 'AISYAH HAYFA ABIGAIL', '3101299803', '-', '2025', 'Kuningan', '2010-03-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(466, 'AKMAL NURFIRMANSYAH', '95260050', '-', '2025', 'Kuningan', '2010-03-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(467, 'ANNISA FEBRICHA ANGGRAINI', '102736211', '-', '2025', 'Kuningan', '2010-03-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(468, 'AZHAR FAHMI ZAHRAN', '103604085', '-', '2025', 'Kuningan', '2010-03-31', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(469, 'ELFAN ALVIANO', '96489726', '-', '2025', 'Kuningan', '2010-04-01', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(470, 'EVI SOPIATURROHMAH', '102335707', '-', '2025', 'Kuningan', '2010-04-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(471, 'FAISAL RIZKI RAMADANI', '3104260912', '-', '2025', 'Kuningan', '2010-04-03', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(472, 'HANA NURHANIFAH SIROJ', '99268462', '-', '2025', 'Kuningan', '2010-04-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(473, 'IMANINA FADHIYA AHMAD', '3107881217', '-', '2025', 'Kuningan', '2010-04-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(474, 'KAILA NOVITASARI', '85505076', '-', '2025', 'Kuningan', '2010-04-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(475, 'MUHAMMAD ARIF FAUZAN', '102442293', '-', '2025', 'Kuningan', '2010-04-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(476, 'NABILA KHUSNUL KHOTIMAH', '3103841058', '-', '2025', 'Kuningan', '2010-04-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(477, 'NAILAL AZKIYA', '3107647415', '-', '2025', 'Kuningan', '2010-04-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(478, 'NAJWA AULIA', '103661355', '-', '2025', 'Kuningan', '2010-04-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(479, 'NINDY AYU LESTARI', '96712435', '-', '2025', 'Kuningan', '2010-04-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(480, 'NOVI SYAMROTUL PUADAH', '91946749', '-', '2025', 'Kuningan', '2010-04-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(481, 'QUINSHA  SAFA AL-HUMAIRA', '102981640', '-', '2025', 'Kuningan', '2010-04-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(482, 'RESTU MAULIDA PURWANIATUN', '103674785', '-', '2025', 'Kuningan', '2010-04-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(483, 'RINI SEPTIANI RAMDANI', '97439913', '-', '2025', 'Kuningan', '2010-04-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(484, 'RISMA MAULIDA KAMILA', '3099091367', '-', '2025', 'Kuningan', '2010-04-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(485, 'SALSABILA RAMADANI', '3104267226', '-', '2025', 'Kuningan', '2010-04-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(486, 'SIGIT KIYANSYAH PUTRA', '3108602695', '-', '2025', 'Kuningan', '2010-04-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(487, 'SITI SYAHIRA AL- MAULIDA', '95888493', '-', '2025', 'Kuningan', '2010-04-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(488, 'SITI WULAN MAULANI', '107413453', '-', '2025', 'Kuningan', '2010-04-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(489, 'SYIFA NURUL JANAH ', '99611061', '-', '2025', 'Kuningan', '2010-04-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(490, 'TRI BAQIYATUS SOLIHAH', '91220383', '-', '2025', 'Kuningan', '2010-04-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(491, 'ZAZKYA NURHASANAH', '3108258716', '-', '2025', 'Kuningan', '2010-04-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALFAN FALAH, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(492, 'ADINDA NURHALIZA', '109362794', '-', '2025', 'Kuningan', '2010-04-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(493, 'ADNINDA NUR HUSNA', '109925530', '-', '2025', 'Kuningan', '2010-04-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(494, 'AGASHA MUZAKKI ALFATHIN', '3104245980', '-', '2025', 'Kuningan', '2010-04-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(495, 'ALYA JAJILAH', '3109494259', '-', '2025', 'Kuningan', '2010-04-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(496, 'DENI PRATAMA', '92196908', '-', '2025', 'Kuningan', '2010-04-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(497, 'DIANA PUTRI WULANDARI', '3100995967', '-', '2025', 'Kuningan', '2010-04-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(498, 'ELSYIFA ANAJIM', '93495525', '-', '2025', 'Kuningan', '2010-04-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(499, 'FAHIRA HANIF', '3104016630', '-', '2025', 'Kuningan', '2010-05-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(500, 'FAHRI DARMAWAN', '99174598', '-', '2025', 'Kuningan', '2010-05-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(501, 'GHEFIRA A\'LIYATUN NISA', '96917189', '-', '2025', 'Kuningan', '2010-05-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(502, 'HAFID MAULANA MAJID', '93267321', '-', '2025', 'Kuningan', '2010-05-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(503, 'HILYA RASYIFA FAUZIAH', '106324157', '-', '2025', 'Kuningan', '2010-05-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(504, 'JIHAN FILDZAH SAGITA', '109058078', '-', '2025', 'Kuningan', '2010-05-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(505, 'LALA MUTIARA', '101169145', '-', '2025', 'Kuningan', '2010-05-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(506, 'MUHAMMAD YUSUF MAULANA', '109660835', '-', '2025', 'Kuningan', '2010-05-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(507, 'NANDA NI\'AMATUS SHUFIAH', '104742264', '-', '2025', 'Kuningan', '2010-05-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(508, 'NAZLA NABILA KHOERUNNISA', '92743812', '-', '2025', 'Kuningan', '2010-05-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(509, 'PIPIT YUPITASARI', '95677089', '-', '2025', 'Kuningan', '2010-05-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(510, 'QIRANI RAHMA MAULIDA', '107502439', '-', '2025', 'Kuningan', '2010-05-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(511, 'RAODATUSSYIFA', '98258478', '-', '2025', 'Kuningan', '2010-05-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(512, 'RENDY ALFAHREZI', '96963974', '-', '2025', 'Kuningan', '2010-05-14', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(513, 'RISMA SRI  NUGRAHA', '95001641', '-', '2025', 'Kuningan', '2010-05-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(514, 'SALSA BILAH NUR FEBRIANTI', '107850829', '-', '2025', 'Kuningan', '2010-05-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(515, 'SELVIANA PUTRI OKTAPIANI', '94916963', '-', '2025', 'Kuningan', '2010-05-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(516, 'SHALAHUDIN AL AYYUBI', '107261254', '-', '2025', 'Kuningan', '2010-05-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55');
INSERT INTO `students` (`id`, `nama`, `nisn`, `nik`, `tahun_masuk`, `tempat_lahir`, `tanggal_lahir`, `status`, `jenis_kelamin`, `alamat`, `nama_ayah`, `nama_ibu`, `nama_wali`, `created_at`, `updated_at`) VALUES
(517, 'SYAHRANI SALSA SOBARIAH', '109350150', '-', '2025', 'Kuningan', '2010-05-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(518, 'TONI ADITYA', '95512588', '-', '2025', 'Kuningan', '2010-05-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(519, 'WIWI WIDIASARI', '108374248', '-', '2025', 'Kuningan', '2010-05-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(520, 'ZAHIRA AZZAHRA', '3100812947', '-', '2025', 'Kuningan', '2010-05-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(521, 'ZAHRIA DWI MAHARANI', '91320722', '-', '2025', 'Kuningan', '2010-05-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'KHOIRUR ROHMAH, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(522, 'AHMAD FAUZAN', '3103836462', '-', '2025', 'Kuningan', '2010-05-24', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(523, 'AINURHIDAYAH', '103516741', '-', '2025', 'Kuningan', '2010-05-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(524, 'AISAH MAULIDA ', '106072571', '-', '2025', 'Kuningan', '2010-05-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(525, 'ANANDA DIVA SHIFIA', '103529318', '-', '2025', 'Kuningan', '2010-05-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(526, 'AZKIYA AMALINA', '93513887', '-', '2025', 'Kuningan', '2010-05-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(527, 'CAHYA FITRIA RAMADHANI', '3105366232', '-', '2025', 'Kuningan', '2010-05-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(528, 'DIMAS BILI RAMADHAN', '93735008', '-', '2025', 'Kuningan', '2010-05-30', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(529, 'EKI ZULFANIA', '106576787', '-', '2025', 'Kuningan', '2010-05-31', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(530, 'ELSA ROHMATUN NISA', '94222411', '-', '2025', 'Kuningan', '2010-06-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(531, 'FUJI ATINA MARTHA', '93153594', '-', '2025', 'Kuningan', '2010-06-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(532, 'FUJI FAUZIAH NINGSIH', '3107976470', '-', '2025', 'Kuningan', '2010-06-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(533, 'GYAN NIZAR RAHMAN', '94979893', '-', '2025', 'Kuningan', '2010-06-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(534, 'JIHAN FAIHA AQILAH', '82488240', '-', '2025', 'Kuningan', '2010-06-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(535, 'JULPATUS SAADAH', '108172203', '-', '2025', 'Kuningan', '2010-06-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(536, 'KEISHA ZAKIYATUL FAKHIROH', '106259815', '-', '2025', 'Kuningan', '2010-06-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(537, 'KIRANIA NURUL HIKMAH', '95235700', '-', '2025', 'Kuningan', '2010-06-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(538, 'MITHA NURINTAN PUTRIANA', '107104104', '-', '2025', 'Kuningan', '2010-06-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(539, 'MOCHAMAD AZMI HAFIDZ', '104433587', '-', '2025', 'Kuningan', '2010-06-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(540, 'MOHAMAD FAQIH', '3096154441', '-', '2025', 'Kuningan', '2010-06-11', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(541, 'MUHAMMAD NAFIZ', '93871624', '-', '2025', 'Kuningan', '2010-06-12', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(542, 'MUTIARA ASRI RAHAYU', '3102180062', '-', '2025', 'Kuningan', '2010-06-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(543, 'NAJWA SALSABIL RAMADHANI', '3109947209', '-', '2025', 'Kuningan', '2010-06-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(544, 'NISA NUR OKTAVIA', '98232681', '-', '2025', 'Kuningan', '2010-06-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(545, 'NURMASITOH', '106458881', '-', '2025', 'Kuningan', '2010-06-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(546, 'PANDU NOVAN SAPUTRA', '96964674', '-', '2025', 'Kuningan', '2010-06-17', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(547, 'RAYSHA', '96767397', '-', '2025', 'Kuningan', '2010-06-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(548, 'RIYA ZIVATUNNISA', '94198643', '-', '2025', 'Kuningan', '2010-06-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(549, 'SITI DINDA KIRANA', '96832049', '-', '2025', 'Kuningan', '2010-06-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(550, 'SYIFA TRYANI AZZAHRA', '3109049929', '-', '2025', 'Kuningan', '2010-06-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(551, 'TANIA', '109464284', '-', '2025', 'Kuningan', '2010-06-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'DANU SULAEMAN, S.Pd.', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(552, 'AHMAD RIZKI PRATAMA', '102794217', '-', '2025', 'Kuningan', '2010-06-23', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(553, 'AMANDA MIFTAHUL JANNAH', '3105603627', '-', '2025', 'Kuningan', '2010-06-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(554, 'ATIK MARDLIATAN HASANAH', '94505278', '-', '2025', 'Kuningan', '2010-06-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(555, 'CAHYA RAMDHANI', '93649567', '-', '2025', 'Kuningan', '2010-06-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(556, 'DAFFA DAARUN NAJAH', '108410385', '-', '2025', 'Kuningan', '2010-06-27', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(557, 'DEDI RAMDANI', '92013924', '-', '2025', 'Kuningan', '2010-06-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(558, 'DIKA JANUAR', '106707424', '-', '2025', 'Kuningan', '2010-06-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(559, 'DILLA NURUL HIKMAH', '96267266', '-', '2025', 'Kuningan', '2010-06-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(560, 'ELSI ROHMATUSYIFA ', '94736324', '-', '2025', 'Kuningan', '2010-07-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(561, 'EVRI ESA FEBRIANSYAH', '99534297', '-', '2025', 'Kuningan', '2010-07-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(562, 'FAHMI HAFID ARRAZI', '98792651', '-', '2025', 'Kuningan', '2010-07-03', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(563, 'FEBY SILVIA RAHMAWATI', '115179884', '-', '2025', 'Kuningan', '2010-07-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(564, 'FIKRI PRATAMA', '93767691', '-', '2025', 'Kuningan', '2010-07-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(565, 'GILANG PUTRA PRATAMA', '103981762', '-', '2025', 'Kuningan', '2010-07-06', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(566, 'HILMI DONNY FIRDAUS', '104283612', '-', '2025', 'Kuningan', '2010-07-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(567, 'MARWA HUMAIDAH', '92409001', '-', '2025', 'Kuningan', '2010-07-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(568, 'MILA SABRIYAH MUTMAINAH', '92203022', '-', '2025', 'Kuningan', '2010-07-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(569, 'MUHAMMAD AFDHAL FAJRI', '102122592', '-', '2025', 'Kuningan', '2010-07-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:55', '2026-08-19 21:19:55'),
(570, 'NAJWA MINHATUL MAWLA', '99781505', '-', '2025', 'Kuningan', '2010-07-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(571, 'NUR AROFAH', '3091083318', '-', '2025', 'Kuningan', '2010-07-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(572, 'NURSALIMAH', '91428141', '-', '2025', 'Kuningan', '2010-07-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(573, 'PUTRI SETYA APRILIA', '93002208', '-', '2025', 'Kuningan', '2010-07-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(574, 'RAFFI RODIAL MANAN', '82083860', '-', '2025', 'Kuningan', '2010-07-15', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(575, 'REDDI HENDRIYANTO', '94256115', '-', '2025', 'Kuningan', '2010-07-16', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(576, 'REVA NEVARISA', '123587711', '-', '2025', 'Kuningan', '2010-07-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(577, 'RIFALDI', '94183329', '-', '2025', 'Kuningan', '2010-07-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(578, 'SATRIO PUTRA PAMUNGKAS', '98524523', '-', '2025', 'Kuningan', '2010-07-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(579, 'SYIFA KHOIRUNNISA', '99074473', '-', '2025', 'Kuningan', '2010-07-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(580, 'WINDY OKTA AULIA', '104737148', '-', '2025', 'Kuningan', '2010-07-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(581, 'YULIYATA', '109277137', '-', '2025', 'Kuningan', '2010-07-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(582, 'ZILVA AENUL ULYA', '105836927', '-', '2025', 'Kuningan', '2010-07-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'MUHAMMAD NURGIANTORO, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(583, 'ALVIN NUZRUL FALLAH', '109893562', '-', '2025', 'Kuningan', '2010-07-24', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(584, 'ANISYAH NURUL NUR JANAH', '101747216', '-', '2025', 'Kuningan', '2010-07-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(585, 'ARINDRA SATYA PUTRA', '104432628', '-', '2025', 'Kuningan', '2010-07-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(586, 'ASTRID DWI LINGGA', '102822779', '-', '2025', 'Kuningan', '2010-07-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(587, 'DEKA ADITIA WIJAYA', '92809515', '-', '2025', 'Kuningan', '2010-07-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(588, 'DENIS LUTVIAN ADILFI', '98963268', '-', '2025', 'Kuningan', '2010-07-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(589, 'DHARA SENDAYU', '93148568', '-', '2025', 'Kuningan', '2010-07-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(590, 'DIMAS AL FAHRI', '106128987', '-', '2025', 'Kuningan', '2010-07-31', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(591, 'FADILLAH WILDANSYAH ', '203477388', '-', '2025', 'Kuningan', '2010-08-01', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(592, 'FARID MIQDAM AL-HABSYI', '107582084', '-', '2025', 'Kuningan', '2010-08-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(593, 'FARIZ FATUROHMAN', '82743469', '-', '2025', 'Kuningan', '2010-08-03', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(594, 'GATHNER MUTIARA ALFAHZAR', '103471089', '-', '2025', 'Kuningan', '2010-08-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(595, 'GRESSA RAPAEL', '97582551', '-', '2025', 'Kuningan', '2010-08-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(596, 'HAFNA IZZATUL WAFIRAH', '103844210', '-', '2025', 'Kuningan', '2010-08-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(597, 'MUHAMAD DIRANA SEPTIRIANO', '92640453', '-', '2025', 'Kuningan', '2010-08-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(598, 'MUHAMAD HAMZI RIZIQ', '3093942029', '-', '2025', 'Kuningan', '2010-08-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(599, 'NAILY KAMILA', '98248384', '-', '2025', 'Kuningan', '2010-08-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(600, 'PRADITA SUWITNO', '3107197661', '-', '2025', 'Kuningan', '2010-08-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(601, 'RADITYA PRATAMA', '107114720', '-', '2025', 'Kuningan', '2010-08-11', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(602, 'RIAN ADE HIDAYAT', '95242271', '-', '2025', 'Kuningan', '2010-08-12', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(603, 'RIDWAN NURYAMAN', '97058100', '-', '2025', 'Kuningan', '2010-08-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(604, 'SINTIA MAYLANI', '94479298', '-', '2025', 'Kuningan', '2010-08-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(605, 'SITI DILA NURAENI', '106777508', '-', '2025', 'Kuningan', '2010-08-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(606, 'SITI HAMIDAH', '107454355', '-', '2025', 'Kuningan', '2010-08-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(607, 'SOFIA HAURA AZZAHRA', '106651054', '-', '2025', 'Kuningan', '2010-08-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(608, 'TRI ANJANI', '3101236879', '-', '2025', 'Kuningan', '2010-08-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(609, 'WIDI HADINATA', '92147714', '-', '2025', 'Kuningan', '2010-08-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(610, 'WULAN SARI', '98665588', '-', '2025', 'Kuningan', '2010-08-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(611, 'YOGA ADI PERMANA', '103028491', '-', '2025', 'Kuningan', '2010-08-21', 'Aktif', 'L', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(612, 'YULI MULIYA ANDRIYANI', '96042538', '-', '2025', 'Kuningan', '2010-08-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(613, 'YUSY YUSTIAR YASSIN', '99624545', '-', '2025', 'Kuningan', '2010-08-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'PUTRI YUNITA APRILIANITA, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(614, 'ADINDA TIARA', '109496475', '-', '2025', 'Kuningan', '2010-08-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(615, 'ALIF JAENALDY', '104399929', '-', '2025', 'Kuningan', '2010-08-25', 'Aktif', 'L', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(616, 'DEWI NUR FITRIYANI', '109513004', '-', '2025', 'Kuningan', '2010-08-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(617, 'DIAS FAJAR SIDIQ', '97301204', '-', '2025', 'Kuningan', '2010-08-27', 'Aktif', 'L', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(618, 'DWI ANGGINI', '97358302', '-', '2025', 'Kuningan', '2010-08-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(619, 'EVALYNA SYAHDA TIRANY', '108934104', '-', '2025', 'Kuningan', '2010-08-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(620, 'HILMA HILYATU RAMADHANA', '3107210066', '-', '2025', 'Kuningan', '2010-08-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(621, 'HILYA NAFISA YASMIN', '3090505746', '-', '2025', 'Kuningan', '2010-08-31', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(622, 'IHA ROYHATUL JANNAH', '102453716', '-', '2025', 'Kuningan', '2010-09-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(623, 'KAESYA AURA JANEETA', '109529751', '-', '2025', 'Kuningan', '2010-09-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(624, 'KENDY NURLAELA', '109632816', '-', '2025', 'Kuningan', '2010-09-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(625, 'M. HIBAN ALGIFARI', '97585504', '-', '2025', 'Kuningan', '2010-09-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(626, 'MOCHAMAD AYANK YAHYA', '63525800', '-', '2025', 'Kuningan', '2010-09-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(627, 'MUHAMMAD AZHAR BAEHAQI', '106894116', '-', '2025', 'Kuningan', '2010-09-06', 'Aktif', 'L', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(628, 'NADIYATUL HUSNA SOFIYAN ', '82044733', '-', '2025', 'Kuningan', '2010-09-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(629, 'NAILA FITRIA ZAFIRA', '101140577', '-', '2025', 'Kuningan', '2010-09-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(630, 'NIKITA JAMILAH', '107651000', '-', '2025', 'Kuningan', '2010-09-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(631, 'NIKITA WILI', '96969363', '-', '2025', 'Kuningan', '2010-09-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(632, 'NUR APRILIA HASANAH', '99722801', '-', '2025', 'Kuningan', '2010-09-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(633, 'RAIFHA AISYATUL NAJWAH ', '3097252889', '-', '2025', 'Kuningan', '2010-09-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(634, 'RANIA FAKHRUNNISA ', '3109516772', '-', '2025', 'Kuningan', '2010-09-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(635, 'RISKA APRIANI ', '105878260', '-', '2025', 'Kuningan', '2010-09-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(636, 'SENO AHMAD WIJAYA', '91291243', '-', '2025', 'Kuningan', '2010-09-15', 'Aktif', 'L', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(637, 'SITI NUR CHOMARIYAH', '94306863', '-', '2025', 'Kuningan', '2010-09-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(638, 'SYIFA DWI CAHYANI', '107899100', '-', '2025', 'Kuningan', '2010-09-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(639, 'SYIFA FAUZIA SHIHAB', '3099250600', '-', '2025', 'Kuningan', '2010-09-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(640, 'ULYA FAIDATUSSIRRIYYAH KARIMAH ', '3108182943', '-', '2025', 'Kuningan', '2010-09-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(641, 'YUSHIKA ARRAFAH', '102032696', '-', '2025', 'Kuningan', '2010-09-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(642, 'ZAHRA QUROTA A\'YUN', '101317859', '-', '2025', 'Kuningan', '2010-09-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'YULIANTI NASHRULLAH, S.Pd.I.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(643, 'AIDA AZHANI NASAR', '107420983', '-', '2025', 'Kuningan', '2010-09-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(644, 'ALIFA NAURA MAULIDA', '106432657', '-', '2025', 'Kuningan', '2010-09-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(645, 'ALIMAH LARASATI', '104977808', '-', '2025', 'Kuningan', '2010-09-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(646, 'ALIN DURROTUN NAFISAH', '108982519', '-', '2025', 'Kuningan', '2010-09-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(647, 'ALIYUDIN KHIDIR', '95221080', '-', '2025', 'Kuningan', '2010-09-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(648, 'ALYA QOTRUNNADA', '3102061455', '-', '2025', 'Kuningan', '2010-09-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(649, 'ANDIKA RAFA AL MUZAQI', '97277399', '-', '2025', 'Kuningan', '2010-09-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(650, 'ANGGUN SELA ALPIANI', '103287513', '-', '2025', 'Kuningan', '2010-09-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(651, 'ANNISA ANNURLILLAH', '91554582', '-', '2025', 'Kuningan', '2010-09-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(652, 'CAHAYA CINTA RAHMADANI', '105191361', '-', '2025', 'Kuningan', '2010-10-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(653, 'CECEP PERMANA', '95425950', '-', '2025', 'Kuningan', '2010-10-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(654, 'DINI WILIANTI', '105632246', '-', '2025', 'Kuningan', '2010-10-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(655, 'EVI ROHMATUL AFIAH', '109050230', '-', '2025', 'Kuningan', '2010-10-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(656, 'FAIHA PUTRI H', '104958049', '-', '2025', 'Kuningan', '2010-10-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(657, 'FATHURROHMAH NURUS SA\'DIYAH', '85460400', '-', '2025', 'Kuningan', '2010-10-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(658, 'GHINA KASIH WIJAYA', '102303121', '-', '2025', 'Kuningan', '2010-10-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(659, 'IRHAM YAZIDS', '98242624', '-', '2025', 'Kuningan', '2010-10-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(660, 'JAUZA BALQIS HUMAIRA', '3107946647', '-', '2025', 'Kuningan', '2010-10-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(661, 'KHILDA SITI NURHASANAH', '96551484', '-', '2025', 'Kuningan', '2010-10-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(662, 'MUHAMAD FAQIH ASNAWI', '92270278', '-', '2025', 'Kuningan', '2010-10-11', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(663, 'MUHAMMAD HAIDAR MAHASIN', '3098903887', '-', '2025', 'Kuningan', '2010-10-12', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(664, 'MUHAMMAD REZNA HUDAYA', '3095495265', '-', '2025', 'Kuningan', '2010-10-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(665, 'MUTHIYARA HASNA SYARIFA', '94188402', '-', '2025', 'Kuningan', '2010-10-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(666, 'MUTIA SARI', '106324678', '-', '2025', 'Kuningan', '2010-10-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(667, 'MUTIATUZAUJI', '86303178', '-', '2025', 'Kuningan', '2010-10-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(668, 'NAISYA AMALIA', '99158806', '-', '2025', 'Kuningan', '2010-10-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(669, 'NAZZA KHOIRIYATUL UMMAH', '104990655', '-', '2025', 'Kuningan', '2010-10-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(670, 'NURUL MUTMAINAH', '92838888', '-', '2025', 'Kuningan', '2010-10-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(671, 'RIAN HIDAYAT', '91266117', '-', '2025', 'Kuningan', '2010-10-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(672, 'RISTI SAIDAH', '97230938', '-', '2025', 'Kuningan', '2010-10-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(673, 'RIZKI PADILAH', '105390055', '-', '2025', 'Kuningan', '2010-10-22', 'Aktif', 'L', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(674, 'SHELA FEBRIATIN', '103238629', '-', '2025', 'Kuningan', '2010-10-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'Hj. ROHANAH, S.Ag', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(675, 'Agis Selamet Riadi', '119705747', '-', '2026', 'Kuningan', '2011-02-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(676, 'Alya Fitri Alfyana', '112317643', '-', '2026', 'Kuningan', '2011-02-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(677, 'Arfan Zakky Al-Muttaqien', '114013515', '-', '2026', 'Kuningan', '2011-02-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(678, 'Ayu Meylinda Putri', '119520488', '-', '2026', 'Kuningan', '2011-02-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(679, 'Azka Nur Alia Hidayatu Rohman', '3108000240', '-', '2026', 'Kuningan', '2011-02-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(680, 'Cika Qurotun Uyun', '105776527', '-', '2026', 'Kuningan', '2011-02-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(681, 'Dela Julia Putri', '113928296', '-', '2026', 'Kuningan', '2011-02-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(682, 'Dini Candra Dinata', '105819089', '-', '2026', 'Kuningan', '2011-02-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(683, 'Dzaki Ashiri', '109399652', '-', '2026', 'Kuningan', '2011-02-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(684, 'Itsna Hilma Fauziyah', '113393369', '-', '2026', 'Kuningan', '2011-02-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(685, 'Latasya Amira Putri', '119677541', '-', '2026', 'Kuningan', '2011-02-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(686, 'Latifah', '113948688', '-', '2026', 'Kuningan', '2011-02-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(687, 'Lukman Hakim', '3113303155', '-', '2026', 'Kuningan', '2011-02-14', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(688, 'Marhaya Putri Vicenza', '3118559660', '-', '2026', 'Kuningan', '2011-02-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(689, 'Monika Auliya Putri', '105873337', '-', '2026', 'Kuningan', '2011-02-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(690, 'Muhamad Akil Sahrul Mubarok', '111251535', '-', '2026', 'Kuningan', '2011-02-17', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(691, 'Muhamad Firmansah', '113956209', '-', '2026', 'Kuningan', '2011-02-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(692, 'Muhammad Badru Tamam', '108998087', '-', '2026', 'Kuningan', '2011-02-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(693, 'Muhammad Reza El Sina Jahva', '115329973', '-', '2026', 'Kuningan', '2011-02-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(694, 'Nabila Hauladina Alifah', '113084624', '-', '2026', 'Kuningan', '2011-02-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(695, 'Raisha Yahya Ramadhani', '116546981', '-', '2026', 'Kuningan', '2011-02-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(696, 'Royan Apriyagung', '119980359', '-', '2026', 'Kuningan', '2011-02-23', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(697, 'Sifa Zainul Aulia', '119759767', '-', '2026', 'Kuningan', '2011-02-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(698, 'Silmi Nur Elbayyinah', '108446720', '-', '2026', 'Kuningan', '2011-02-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(699, 'Siti Linda Purnama Sari', '101598920', '-', '2026', 'Kuningan', '2011-02-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(700, 'Siti Mardiah', '104647435', '-', '2026', 'Kuningan', '2011-02-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(701, 'Siti Nazia Alzaira', '104176997', '-', '2026', 'Kuningan', '2011-02-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(702, 'Siti Nurhalizah', '104752524', '-', '2026', 'Kuningan', '2011-03-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(703, 'Sri Handayani', '104752525', '-', '2026', 'Kuningan', '2011-03-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(704, 'Sulis Wulidatunisa', '116895612', '-', '2026', 'Kuningan', '2011-03-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(705, 'Tivani Larasati', '3100415083', '-', '2026', 'Kuningan', '2011-03-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(706, 'Wahyu Atha Naufal Putra', '3102632437', '-', '2026', 'Kuningan', '2011-03-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(707, 'Zahra Nafisatul Fuadah', '103619373', '-', '2026', 'Kuningan', '2011-03-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'AGHNIYAH MAWADDAH MAHAR AS, M.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(708, 'Adinda Sri Ratu', '104319502', '-', '2026', 'Kuningan', '2011-03-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(709, 'Alena Maila Azka Syarip', '104865451', '-', '2026', 'Kuningan', '2011-03-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(710, 'Alfatih Hamdani', '114475173', '-', '2026', 'Kuningan', '2011-03-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(711, 'Anggi Maulana Adman', '119903533', '-', '2026', 'Kuningan', '2011-03-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(712, 'Annadia Assabarina', '3111067007', '-', '2026', 'Kuningan', '2011-03-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(713, 'Azizah Nur Adawiyah Ambar', '109054351', '-', '2026', 'Kuningan', '2011-03-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(714, 'Bunga Cahaya Kamila', '106940541', '-', '2026', 'Kuningan', '2011-03-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(715, 'Dara Astrella Athayya', '119058872', '-', '2026', 'Kuningan', '2011-03-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(716, 'Dealova Hadiyatul Hikmah', '109056636', '-', '2026', 'Kuningan', '2011-03-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(717, 'Dhia Putri Syarafana Utami', '115740103', '-', '2026', 'Kuningan', '2011-03-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(718, 'Dinda Maelani', '115932394', '-', '2026', 'Kuningan', '2011-03-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(719, 'Elfira Octavia Putri', '119504973', '-', '2026', 'Kuningan', '2011-03-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(720, 'Lu\'Lu Maulida Ulfiyah', '117164956', '-', '2026', 'Kuningan', '2011-03-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(721, 'Mawar Sri Aulia', '116624845', '-', '2026', 'Kuningan', '2011-03-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(722, 'Memey Maehera', '106807603', '-', '2026', 'Kuningan', '2011-03-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(723, 'Muhamad Fadilurohman', '115315199', '-', '2026', 'Kuningan', '2011-03-22', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(724, 'Muhamad Melkhy Afryansyah', '108278869', '-', '2026', 'Kuningan', '2011-03-23', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(725, 'Muhammad Faqih Shofiullah', '109745268', '-', '2026', 'Kuningan', '2011-03-24', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(726, 'Nadya Lathifaturrohmah', '3115015219', '-', '2026', 'Kuningan', '2011-03-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(727, 'Neisya Sabila', '158912764', '-', '2026', 'Kuningan', '2011-03-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(728, 'Nida Aulia Mustika', '119873468', '-', '2026', 'Kuningan', '2011-03-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(729, 'Prabu Aly El Luma', '118379236', '-', '2026', 'Kuningan', '2011-03-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(730, 'Rahma Khoirunnisa', '106017216', '-', '2026', 'Kuningan', '2011-03-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(731, 'Rahmi Afiani Zakiah', '113941944', '-', '2026', 'Kuningan', '2011-03-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(732, 'Ridho Akbar Darmawan', '108022237', '-', '2026', 'Kuningan', '2011-03-31', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(733, 'Rini Parida Rosdiani', '115101050', '-', '2026', 'Kuningan', '2011-04-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(734, 'Salwa Andriani', '3099542186', '-', '2026', 'Kuningan', '2011-04-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(735, 'Siti Nur Alisah', '111258396', '-', '2026', 'Kuningan', '2011-04-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(736, 'Siti Rohmah Paujan', '106780356', '-', '2026', 'Kuningan', '2011-04-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(737, 'Syabilla Mutiara Azizah', '111502702', '-', '2026', 'Kuningan', '2011-04-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(738, 'Tasya Alpiyatul Hasanah', '107407370', '-', '2026', 'Kuningan', '2011-04-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(739, 'Wildan Ramdanu', '112095429', '-', '2026', 'Kuningan', '2011-04-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(740, 'Zidane Zavier', '104649125', '-', '2026', 'Kuningan', '2011-04-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'RERES TANTRA GARISHAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(741, 'Abdur Rahman Latif', '112636704', '-', '2026', 'Kuningan', '2011-04-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(742, 'Afnaila Khoerunnisa', '107120472', '-', '2026', 'Kuningan', '2011-04-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(743, 'Agisna Yamanda Ulya', '3108209300', '-', '2026', 'Kuningan', '2011-04-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(744, 'Alifa Yuniarti', '113319420', '-', '2026', 'Kuningan', '2011-04-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(745, 'Aulia Shafira', '116749671', '-', '2026', 'Kuningan', '2011-04-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(746, 'Ayu Susilawati', '108258189', '-', '2026', 'Kuningan', '2011-04-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(747, 'Az\'Zahra Rihadatul Aizy', '3110434319', '-', '2026', 'Kuningan', '2011-04-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(748, 'Diksha Selsylia Nuur\'Ainnun', '105358724', '-', '2026', 'Kuningan', '2011-04-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(749, 'Diva Zahra Aulia', '104724519', '-', '2026', 'Kuningan', '2011-04-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(750, 'Fahmi Hidayat', '119752092', '-', '2026', 'Kuningan', '2011-04-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(751, 'Fina Lutfina', '103358929', '-', '2026', 'Kuningan', '2011-04-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(752, 'Gisya Aida Zulfa', '106521087', '-', '2026', 'Kuningan', '2011-04-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(753, 'Inayatul Muasyaroh', '104134796', '-', '2026', 'Kuningan', '2011-04-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(754, 'Isvara Fakhrunisa Qiana', '3116427094', '-', '2026', 'Kuningan', '2011-04-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(755, 'Lilis Sofiani', '116895927', '-', '2026', 'Kuningan', '2011-04-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(756, 'Maya Rahmadina', '103452039', '-', '2026', 'Kuningan', '2011-04-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(757, 'Muhamad Albar Algifari', '3107377189', '-', '2026', 'Kuningan', '2011-04-25', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(758, 'Muhammad Farell Zacky Rayhan', '116609779', '-', '2026', 'Kuningan', '2011-04-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(759, 'Muhammad Ghazi Algifari Abdurahman', '105409601', '-', '2026', 'Kuningan', '2011-04-27', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(760, 'Muhammad Nashihul Amin', '101372139', '-', '2026', 'Kuningan', '2011-04-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(761, 'Nadia Novitasari', '102651312', '-', '2026', 'Kuningan', '2011-04-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(762, 'Najma Sabiya Nirbita', '3102995660', '-', '2026', 'Kuningan', '2011-04-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(763, 'Nur Alifah', '105209456', '-', '2026', 'Kuningan', '2011-05-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(764, 'Ovi Sofiatul Fu\'Adah', '109469771', '-', '2026', 'Kuningan', '2011-05-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(765, 'Putri Aliya Noviyanti', '109725829', '-', '2026', 'Kuningan', '2011-05-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(766, 'Ramadhani', '111498547', '-', '2026', 'Kuningan', '2011-05-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(767, 'Rizki Akbar Maulana', '113562610', '-', '2026', 'Kuningan', '2011-05-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(768, 'Segina Noviantika', '116830110', '-', '2026', 'Kuningan', '2011-05-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(769, 'Syahla Ade Lia', '98765491', '-', '2026', 'Kuningan', '2011-05-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(770, 'Syifa Azahra', '3105129955', '-', '2026', 'Kuningan', '2011-05-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(771, 'Tasya Nurlita', '114212498', '-', '2026', 'Kuningan', '2011-05-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(772, 'Zahra Hamidah Ramadani', '3109240668', '-', '2026', 'Kuningan', '2011-05-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(773, 'Zidny Radisty Novan', '101931875', '-', '2026', 'Kuningan', '2011-05-11', 'Aktif', 'L', 'Kuningan', '-', '-', 'AEN ALIMATUN AMALIAH, S.Hum', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(774, 'Alya Sasmita Rahayu', '106664570', '-', '2026', 'Kuningan', '2011-05-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(775, 'Amel Sriwanyuni', '119294383', '-', '2026', 'Kuningan', '2011-05-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(776, 'Aqila Zifarra Ahmad', '3109241314', '-', '2026', 'Kuningan', '2011-05-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(777, 'Difa Aurahima', '117798365', '-', '2026', 'Kuningan', '2011-05-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56');
INSERT INTO `students` (`id`, `nama`, `nisn`, `nik`, `tahun_masuk`, `tempat_lahir`, `tanggal_lahir`, `status`, `jenis_kelamin`, `alamat`, `nama_ayah`, `nama_ibu`, `nama_wali`, `created_at`, `updated_at`) VALUES
(778, 'Eki Siti Nurazkia', '109790372', '-', '2026', 'Kuningan', '2011-05-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(779, 'Evi Siti Ropiatul Adawiyah', '102132036', '-', '2026', 'Kuningan', '2011-05-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(780, 'Fadhil Anwar', '112739647', '-', '2026', 'Kuningan', '2011-05-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(781, 'Gadis Paraswati', '104219284', '-', '2026', 'Kuningan', '2011-05-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(782, 'Gilang Maulana Anwar', '115598080', '-', '2026', 'Kuningan', '2011-05-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(783, 'Haidar Dhiaul Haq', '3106851031', '-', '2026', 'Kuningan', '2011-05-21', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(784, 'Haris Maulana', '3107226018', '-', '2026', 'Kuningan', '2011-05-22', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(785, 'Inna Aqniyah', '121197963', '-', '2026', 'Kuningan', '2011-05-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(786, 'Kameliyah Balqis Ar Ridwan', '3115542113', '-', '2026', 'Kuningan', '2011-05-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(787, 'Keyla Rahayu Ramadhanti', '112775314', '-', '2026', 'Kuningan', '2011-05-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(788, 'Lisna Khoerul Nisa', '117623421', '-', '2026', 'Kuningan', '2011-05-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(789, 'Maahirah Rihhadatul \'Aisy', '105302146', '-', '2026', 'Kuningan', '2011-05-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(790, 'Muhamad Fahri Husaeni', '103289413', '-', '2026', 'Kuningan', '2011-05-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(791, 'Muhammad Fathurrahman', '116980651', '-', '2026', 'Kuningan', '2011-05-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(792, 'Muhammad Yusuf', '104843377', '-', '2026', 'Kuningan', '2011-05-30', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(793, 'Nandyne Dwi Aditya Putri', '107907490', '-', '2026', 'Kuningan', '2011-05-31', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(794, 'Nina Agustia', '116805275', '-', '2026', 'Kuningan', '2011-06-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(795, 'Refan Maulana', '106983801', '-', '2026', 'Kuningan', '2011-06-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(796, 'Sahila Aisyalhana', '106671835', '-', '2026', 'Kuningan', '2011-06-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(797, 'Salsha Apriliyani', '3104423314', '-', '2026', 'Kuningan', '2011-06-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(798, 'Silpiyanti Qolia', '103292922', '-', '2026', 'Kuningan', '2011-06-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(799, 'Siti Aisah', '114259809', '-', '2026', 'Kuningan', '2011-06-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(800, 'Siti Aisyah Nurauliya', '115734929', '-', '2026', 'Kuningan', '2011-06-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(801, 'Syafa Miftahul Zanah', '3115677394', '-', '2026', 'Kuningan', '2011-06-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(802, 'Tri Nazwha Ananda', '3115677395', '-', '2026', 'Kuningan', '2011-06-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(803, 'Tsabitha Shifwah', '119648161', '-', '2026', 'Kuningan', '2011-06-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(804, 'Vina Octaviani', '3102817800', '-', '2026', 'Kuningan', '2011-06-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(805, 'Zahira Putri Nursyifa', '105324208', '-', '2026', 'Kuningan', '2011-06-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(806, 'Zuniandra Ardiansyah', '119483946', '-', '2026', 'Kuningan', '2011-06-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'DEWI PARTIWI RAHAYU, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(807, 'Agus Ramdani', '114185003', '-', '2026', 'Kuningan', '2011-06-14', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(808, 'Ajeng Aminatul Muidah', '115326688', '-', '2026', 'Kuningan', '2011-06-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(809, 'Alif Ahmad Mudzakki', '115465547', '-', '2026', 'Kuningan', '2011-06-16', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(810, 'Alipatul Badriyah', '109273065', '-', '2026', 'Kuningan', '2011-06-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(811, 'Amel Widianingsih', '108810102', '-', '2026', 'Kuningan', '2011-06-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(812, 'Dea Nur Sahla', '3103186459', '-', '2026', 'Kuningan', '2011-06-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(813, 'Dira Nadhirotussadiyah', '112611542', '-', '2026', 'Kuningan', '2011-06-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(814, 'Fadhil Zhaahir Hamid', '118193348', '-', '2026', 'Kuningan', '2011-06-21', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(815, 'Fahmi Idrus Al-Musyawi', '116198355', '-', '2026', 'Kuningan', '2011-06-22', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(816, 'Fatimah Adinda Putri', '114271932', '-', '2026', 'Kuningan', '2011-06-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(817, 'Fatimatu Jahro', '104179029', '-', '2026', 'Kuningan', '2011-06-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(818, 'Hadziq Nabhan', '106766935', '-', '2026', 'Kuningan', '2011-06-25', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(819, 'Helna Ayu Rianti', '106616340', '-', '2026', 'Kuningan', '2011-06-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(820, 'Hilmi Alfarizzi', '104846441', '-', '2026', 'Kuningan', '2011-06-27', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(821, 'IAn Jayyidatunnisa', '3111013657', '-', '2026', 'Kuningan', '2011-06-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(822, 'Iyis Ihlasiah Padilah', '3102884526', '-', '2026', 'Kuningan', '2011-06-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(823, 'Jihan Ainulfarida Syam', '3117565858', '-', '2026', 'Kuningan', '2011-06-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(824, 'Lugina Aluna Ilmi', '101577714', '-', '2026', 'Kuningan', '2011-07-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(825, 'Lu\'Lu Qurrota\'Ayun', '3119369620', '-', '2026', 'Kuningan', '2011-07-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(826, 'Marsya Nur Fauziyah', '113957452', '-', '2026', 'Kuningan', '2011-07-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(827, 'Muhamad Raehan Al Fiansyah', '101959538', '-', '2026', 'Kuningan', '2011-07-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(828, 'Nailah Nur Rosyad', '107694126', '-', '2026', 'Kuningan', '2011-07-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(829, 'Nuraini Fauziah', '109651703', '-', '2026', 'Kuningan', '2011-07-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(830, 'Nuraisyah', '103368522', '-', '2026', 'Kuningan', '2011-07-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(831, 'Nurul Hikmah Syiami', '104204543', '-', '2026', 'Kuningan', '2011-07-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(832, 'Olivia', '105423928', '-', '2026', 'Kuningan', '2011-07-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(833, 'Radit Ramadhan', '114725290', '-', '2026', 'Kuningan', '2011-07-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(834, 'Tika Nurfalina Indah', '101856872', '-', '2026', 'Kuningan', '2011-07-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(835, 'Tsania Quinn Maghfira', '111700364', '-', '2026', 'Kuningan', '2011-07-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(836, 'Tuti Juniarsih', '119866264', '-', '2026', 'Kuningan', '2011-07-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(837, 'Zivana Paramita', '115523397', '-', '2026', 'Kuningan', '2011-07-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(838, 'Zoya Meygi Dina', '107555457', '-', '2026', 'Kuningan', '2011-07-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'BELLA ADELASARI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(839, 'Ade Aolia Agustin', '119138839', '-', '2026', 'Kuningan', '2011-07-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(840, 'Afwan Maulana Azidan', '107878835', '-', '2026', 'Kuningan', '2011-07-17', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(841, 'Agni Ni\'Mal Maulani', '93783977', '-', '2026', 'Kuningan', '2011-07-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(842, 'Ahmad Rapi\'I', '111019481', '-', '2026', 'Kuningan', '2011-07-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(843, 'Ainun Nur Aisah', '114695507', '-', '2026', 'Kuningan', '2011-07-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(844, 'Andin Krisnawati', '3101985345', '-', '2026', 'Kuningan', '2011-07-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(845, 'Arjuna Pamungkas', '117499398', '-', '2026', 'Kuningan', '2011-07-22', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(846, 'Fika Zahratul Kolbi', '109714695', '-', '2026', 'Kuningan', '2011-07-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(847, 'Ghibran Al-Gifari', '107881267', '-', '2026', 'Kuningan', '2011-07-24', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(848, 'Ghina Khoirunisa', '3106692427', '-', '2026', 'Kuningan', '2011-07-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(849, 'Isma Rismayanti', '102723289', '-', '2026', 'Kuningan', '2011-07-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(850, 'Kania Nur Aini', '108075050', '-', '2026', 'Kuningan', '2011-07-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(851, 'Khansa Haura Shahibah', '105173099', '-', '2026', 'Kuningan', '2011-07-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(852, 'Mandala Thirta Guntara', '111550210', '-', '2026', 'Kuningan', '2011-07-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(853, 'Marisa Adzkiani', '3107006893', '-', '2026', 'Kuningan', '2011-07-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(854, 'Muhamad Setia Pratama', '3115066121', '-', '2026', 'Kuningan', '2011-07-31', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(855, 'Muhamad Yud\'A Jamiilul Alam', '106900525', '-', '2026', 'Kuningan', '2011-08-01', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(856, 'Muhammad Nizar Sonjaya', '3110827115', '-', '2026', 'Kuningan', '2011-08-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(857, 'Najma Faqihatul Fikriyah', '3104139082', '-', '2026', 'Kuningan', '2011-08-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(858, 'Nur Ainiya Azmi', '113873185', '-', '2026', 'Kuningan', '2011-08-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(859, 'Nur Alifah Fitriani', '116872244', '-', '2026', 'Kuningan', '2011-08-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(860, 'Okta Najiyah Khoirunnisa', '113337848', '-', '2026', 'Kuningan', '2011-08-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(861, 'Olif Hikmatu Sya\'Diyah', '107880325', '-', '2026', 'Kuningan', '2011-08-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(862, 'Puji Laila', '106800527', '-', '2026', 'Kuningan', '2011-08-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(863, 'Putri Niswatun Nafiah', '106808121', '-', '2026', 'Kuningan', '2011-08-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(864, 'Radittia Pratama', '106355699', '-', '2026', 'Kuningan', '2011-08-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(865, 'Rasyad Ghiffari', '108148908', '-', '2026', 'Kuningan', '2011-08-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(866, 'Ririn Anggraeni', '107613611', '-', '2026', 'Kuningan', '2011-08-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(867, 'Sakina Nurbaiti', '111227314', '-', '2026', 'Kuningan', '2011-08-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(868, 'Siti Ummu Habibah', '107230155', '-', '2026', 'Kuningan', '2011-08-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(869, 'Wafa Nurazizah', '119657156', '-', '2026', 'Kuningan', '2011-08-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(870, 'Wardah Kaddihani', '109749527', '-', '2026', 'Kuningan', '2011-08-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'SITI HUMAEROH FITRIANI DEWI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(871, 'Adima Isnaynur Ramadhan', '3117906400', '-', '2026', 'Kuningan', '2011-08-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(872, 'Aghni Mumtaz Meddinah', '119433617', '-', '2026', 'Kuningan', '2011-08-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(873, 'Ahmad Firmansyah', '117317403', '-', '2026', 'Kuningan', '2011-08-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(874, 'Aida Putri Pratama', '105242242', '-', '2026', 'Kuningan', '2011-08-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(875, 'Alicia Maldami', '3105167886', '-', '2026', 'Kuningan', '2011-08-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(876, 'Bianca Khairani Az\'Zahra', '114261719', '-', '2026', 'Kuningan', '2011-08-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(877, 'Cikha Andini Pratama', '117953496', '-', '2026', 'Kuningan', '2011-08-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(878, 'Endang Sri Astuti', '102936552', '-', '2026', 'Kuningan', '2011-08-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(879, 'Ghedza Al Ghotafani', '112773415', '-', '2026', 'Kuningan', '2011-08-25', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(880, 'Habiburrahman Algifari', '117860792', '-', '2026', 'Kuningan', '2011-08-26', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(881, 'Hasya Nafisa Ramadani', '101025569', '-', '2026', 'Kuningan', '2011-08-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(882, 'Imam Royani', '111151220', '-', '2026', 'Kuningan', '2011-08-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(883, 'Kaila Qotrun Nada', '108254884', '-', '2026', 'Kuningan', '2011-08-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(884, 'Kamalia Nuurul Mutmaunah', '3102523004', '-', '2026', 'Kuningan', '2011-08-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(885, 'Karina Nurhawati', '115822953', '-', '2026', 'Kuningan', '2011-08-31', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(886, 'Kasyafah Dina Kamilah', '101006729', '-', '2026', 'Kuningan', '2011-09-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(887, 'Khanza Adiba Azzura', '106033348', '-', '2026', 'Kuningan', '2011-09-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(888, 'Khirani Dwi Annisa', '107303582', '-', '2026', 'Kuningan', '2011-09-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(889, 'Levina Claresta Khozin Zahran', '114103574', '-', '2026', 'Kuningan', '2011-09-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(890, 'Mila Kamilatun Nimah', '3100428714', '-', '2026', 'Kuningan', '2011-09-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(891, 'Nabila Safania Sidad', '94208034', '-', '2026', 'Kuningan', '2011-09-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(892, 'Najilaturrohmah', '104626874', '-', '2026', 'Kuningan', '2011-09-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(893, 'Novi Kurnia Aryanti', '103960026', '-', '2026', 'Kuningan', '2011-09-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(894, 'Pauzi Saputra', '113599037', '-', '2026', 'Kuningan', '2011-09-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(895, 'Putri Nazwa Habibah', '112838549', '-', '2026', 'Kuningan', '2011-09-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(896, 'Quinsa Malika Nur Azeeza', '104272925', '-', '2026', 'Kuningan', '2011-09-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(897, 'Reisa Aprillia', '102798437', '-', '2026', 'Kuningan', '2011-09-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(898, 'Rian Surya Lesmana', '104580584', '-', '2026', 'Kuningan', '2011-09-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(899, 'Rodhiyatun Khoirunnisa Yolandi', '3101546838', '-', '2026', 'Kuningan', '2011-09-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(900, 'Siti Masfufatul Husna', '3116072332', '-', '2026', 'Kuningan', '2011-09-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(901, 'Tubagus Bima Satria', '108954383', '-', '2026', 'Kuningan', '2011-09-16', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(902, 'Wisnu Ardiansah', '3104270438', '-', '2026', 'Kuningan', '2011-09-17', 'Aktif', 'L', 'Kuningan', '-', '-', 'WIDANENGSIH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(903, 'Adli Hammam Al Farruq', '104178342', '-', '2026', 'Kuningan', '2011-09-18', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(904, 'Aida Nur Fadilah', '106638530', '-', '2026', 'Kuningan', '2011-09-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(905, 'Ajeng Eva Fitria', '107910746', '-', '2026', 'Kuningan', '2011-09-20', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(906, 'Alisya Indria Futri', '117536772', '-', '2026', 'Kuningan', '2011-09-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(907, 'Allysa Aprillia Nur\'Aini', '111357743', '-', '2026', 'Kuningan', '2011-09-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(908, 'Alpiano', '107786492', '-', '2026', 'Kuningan', '2011-09-23', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(909, 'Andara Adinda Putri', '3104212236', '-', '2026', 'Kuningan', '2011-09-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(910, 'Aryadika Rachmansyah', '102911433', '-', '2026', 'Kuningan', '2011-09-25', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(911, 'Azka Fauziah', '107677602', '-', '2026', 'Kuningan', '2011-09-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(912, 'Cutia Candraningtyas', '106897765', '-', '2026', 'Kuningan', '2011-09-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(913, 'Diana Aulia Hasanah', '109379377', '-', '2026', 'Kuningan', '2011-09-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(914, 'Faiz Abdurrahman', '109121519', '-', '2026', 'Kuningan', '2011-09-29', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(915, 'Fitri Anjani', '94623885', '-', '2026', 'Kuningan', '2011-09-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(916, 'Hanif Azhar Khairi', '107190759', '-', '2026', 'Kuningan', '2011-10-01', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(917, 'Irna Erlina', '3110861833', '-', '2026', 'Kuningan', '2011-10-02', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(918, 'Kaila Cahya Ningrum', '109561086', '-', '2026', 'Kuningan', '2011-10-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(919, 'Keyla Alifaturohman', '108985002', '-', '2026', 'Kuningan', '2011-10-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(920, 'Lala Lailatul Husna', '117854976', '-', '2026', 'Kuningan', '2011-10-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(921, 'Lilis Kurniasih', '119475721', '-', '2026', 'Kuningan', '2011-10-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(922, 'Luqya Mufidah', '107702023', '-', '2026', 'Kuningan', '2011-10-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(923, 'Muhamad Nur Albais', '107609133', '-', '2026', 'Kuningan', '2011-10-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(924, 'Muhammad Alif Riziq Ash Sidqi Mastin', '105826796', '-', '2026', 'Kuningan', '2011-10-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(925, 'Naufal Munif', '105826797', '-', '2026', 'Kuningan', '2011-10-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(926, 'Qory Nurul Adzkiya', '101371570', '-', '2026', 'Kuningan', '2011-10-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(927, 'Rahma Nurul Aulia', '117902744', '-', '2026', 'Kuningan', '2011-10-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(928, 'Renita Lutviana Anggraeni', '118161716', '-', '2026', 'Kuningan', '2011-10-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(929, 'Risma Huryyatuljanah', '3119930522', '-', '2026', 'Kuningan', '2011-10-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(930, 'Rofaah Ramdani', '118531746', '-', '2026', 'Kuningan', '2011-10-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(931, 'Sahrul Pratama', '115898630', '-', '2026', 'Kuningan', '2011-10-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(932, 'Silvia Nuraeni', '114479581', '-', '2026', 'Kuningan', '2011-10-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(933, 'Siti Khoerun Nisaa\'', '105272241', '-', '2026', 'Kuningan', '2011-10-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(934, 'Zidan Dimitri', '118938210', '-', '2026', 'Kuningan', '2011-10-19', 'Aktif', 'L', 'Kuningan', '-', '-', 'ALY IMANUL HAKIEM, S.Pd', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(935, 'Abil Labibul Jami', '108226935', '-', '2026', 'Kuningan', '2011-10-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(936, 'Alya Nadia Safwah', '102936373', '-', '2026', 'Kuningan', '2011-10-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(937, 'Annisa Artha Novia', '113568284', '-', '2026', 'Kuningan', '2011-10-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(938, 'Azizah Qomariyah', '114656041', '-', '2026', 'Kuningan', '2011-10-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(939, 'Demalia Putri', '114122236', '-', '2026', 'Kuningan', '2011-10-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(940, 'Detry Marva Nahrotama', '106951810', '-', '2026', 'Kuningan', '2011-10-25', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(941, 'Elsa Aulia', '104319504', '-', '2026', 'Kuningan', '2011-10-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(942, 'Elsa Nur Hasanah', '3121109992', '-', '2026', 'Kuningan', '2011-10-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(943, 'Evan Ahmad Fauzan', '117018893', '-', '2026', 'Kuningan', '2011-10-28', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(944, 'Fairuz Aulia Rahmah', '107166754', '-', '2026', 'Kuningan', '2011-10-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(945, 'Galang Fratama', '105362440', '-', '2026', 'Kuningan', '2011-10-30', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(946, 'Gea Nur Rinjani Ajaibul Qolbi', '3108879651', '-', '2026', 'Kuningan', '2011-10-31', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(947, 'Gita Amaliya', '107929055', '-', '2026', 'Kuningan', '2011-11-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(948, 'Hilmi Assaid', '3111809043', '-', '2026', 'Kuningan', '2011-11-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(949, 'Ira Khumaira', '117130446', '-', '2026', 'Kuningan', '2011-11-03', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(950, 'Irma Nuryanti', '106360796', '-', '2026', 'Kuningan', '2011-11-04', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(951, 'Kaila Putri Rahayu', '105210164', '-', '2026', 'Kuningan', '2011-11-05', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(952, 'Khairul Azhar Kurnia', '114944494', '-', '2026', 'Kuningan', '2011-11-06', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(953, 'Melinda Sopia Lestari', '3110751777', '-', '2026', 'Kuningan', '2011-11-07', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(954, 'Muhamad Syahrul Mubarok', '2425020029', '-', '2026', 'Kuningan', '2011-11-08', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(955, 'Muhammad Luthfi Maulana', '109088373', '-', '2026', 'Kuningan', '2011-11-09', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(956, 'Muziya Siti Nur Fatihah', '3109385804', '-', '2026', 'Kuningan', '2011-11-10', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(957, 'Rania Dalfa Thanzihah', '3114094932', '-', '2026', 'Kuningan', '2011-11-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(958, 'Rasya Alfahri', '117567423', '-', '2026', 'Kuningan', '2011-11-12', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(959, 'Saeful Bahri', '3101910502', '-', '2026', 'Kuningan', '2011-11-13', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(960, 'Sheiva Sakina Estevan', '118265966', '-', '2026', 'Kuningan', '2011-11-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(961, 'Siti Lailatul Aliifah', '105935529', '-', '2026', 'Kuningan', '2011-11-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(962, 'Siti Novalisa', '111798876', '-', '2026', 'Kuningan', '2011-11-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(963, 'Siti Nur Alifah', '101264143', '-', '2026', 'Kuningan', '2011-11-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(964, 'Siti Syafa\'Atul Husna', '103106485', '-', '2026', 'Kuningan', '2011-11-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(965, 'Sonia Meyranita Putri', '3186468044', '-', '2026', 'Kuningan', '2011-11-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(966, 'Wahendra Dwi Tama', '103748705', '-', '2026', 'Kuningan', '2011-11-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'MILLATI SILMI, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(967, 'Afwa Syakila Putri', '3110125356', '-', '2026', 'Kuningan', '2011-11-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(968, 'Ajeng Muhalifah', '103147063', '-', '2026', 'Kuningan', '2011-11-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(969, 'Azzahra Solihatul Ghina', '3109377907', '-', '2026', 'Kuningan', '2011-11-23', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(970, 'Dhafa Dwi Purnama', '3119552172', '-', '2026', 'Kuningan', '2011-11-24', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(971, 'Hana Syifaul Aulia', '111952921', '-', '2026', 'Kuningan', '2011-11-25', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(972, 'Hasya Al Zhahirah Rahma', '3106430899', '-', '2026', 'Kuningan', '2011-11-26', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(973, 'Izza Nazlur Rohmatu Zahra', '116818187', '-', '2026', 'Kuningan', '2011-11-27', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(974, 'Jihan Ayatul Husna', '108883166', '-', '2026', 'Kuningan', '2011-11-28', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(975, 'Jiran Siti Nurpadilah', '117905774', '-', '2026', 'Kuningan', '2011-11-29', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(976, 'Kamalia Rahmah', '115573687', '-', '2026', 'Kuningan', '2011-11-30', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(977, 'Maura Aldilah', '113841942', '-', '2026', 'Kuningan', '2011-12-01', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(978, 'Misbahuddin', '117796241', '-', '2026', 'Kuningan', '2011-12-02', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(979, 'Muhamad Agus Mubaroq', '119279657', '-', '2026', 'Kuningan', '2011-12-03', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(980, 'Muhamad Fayyadh Al Ghifari', '117040481', '-', '2026', 'Kuningan', '2011-12-04', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(981, 'Muhammad Fikri Baihaqi', '116334179', '-', '2026', 'Kuningan', '2011-12-05', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(982, 'Muhammad Kepin Nusa Putra', '116924599', '-', '2026', 'Kuningan', '2011-12-06', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(983, 'Muhammad Shihabuddin Irsyad', '126325863', '-', '2026', 'Kuningan', '2011-12-07', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(984, 'Naila Zulfa', '109627026', '-', '2026', 'Kuningan', '2011-12-08', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(985, 'Nazwa Nadiatun Nafis', '104734641', '-', '2026', 'Kuningan', '2011-12-09', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(986, 'Nizar Deliana Prayoga', '3101132436', '-', '2026', 'Kuningan', '2011-12-10', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(987, 'Nurul Adelia Putri', '107375601', '-', '2026', 'Kuningan', '2011-12-11', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(988, 'Queen Latifa', '112082043', '-', '2026', 'Kuningan', '2011-12-12', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(989, 'Restu Ilham Saputra', '114689085', '-', '2026', 'Kuningan', '2011-12-13', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(990, 'Sazkia Aurelia Putri', '111261046', '-', '2026', 'Kuningan', '2011-12-14', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(991, 'Sesi Nindi Kirana', '116417920', '-', '2026', 'Kuningan', '2011-12-15', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(992, 'Sheila \'Ainun Mahya', '119105908', '-', '2026', 'Kuningan', '2011-12-16', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(993, 'Siti Hasanah', '108163769', '-', '2026', 'Kuningan', '2011-12-17', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(994, 'Syairil Apriza Azzahra', '114956573', '-', '2026', 'Kuningan', '2011-12-18', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(995, 'Viega Zahira', '3104832907', '-', '2026', 'Kuningan', '2011-12-19', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(996, 'Wahendri Triana', '3109902478', '-', '2026', 'Kuningan', '2011-12-20', 'Aktif', 'L', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(997, 'Zahra', '3107089979', '-', '2026', 'Kuningan', '2011-12-21', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56'),
(998, 'Zivvana Leony Putri', '119748347', '-', '2026', 'Kuningan', '2011-12-22', 'Aktif', 'P', 'Kuningan', '-', '-', 'PIPIN PINAHUNATUL BAROKAH, S.Pd.', '2026-08-19 21:19:56', '2026-08-19 21:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `tst_grouping`
--

CREATE TABLE `tst_grouping` (
  `id_grouping` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` bigint(20) NOT NULL,
  `id_kelas` bigint(20) NOT NULL,
  `id_tahun` bigint(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tst_grouping`
--

INSERT INTO `tst_grouping` (`id_grouping`, `id_siswa`, `id_kelas`, `id_tahun`, `tahun`, `created_at`, `updated_at`) VALUES
(7, 76, 1, 1, 2026, NULL, NULL),
(8, 172, 1, 1, 2026, NULL, NULL),
(9, 312, 1, 1, 2026, NULL, NULL),
(10, 311, 1, 1, 2026, NULL, NULL),
(11, 44, 1, 1, 2026, NULL, NULL),
(12, 174, 1, 1, 2026, NULL, NULL),
(13, 246, 1, 1, 2026, NULL, NULL),
(14, 343, 1, 1, 2026, NULL, NULL),
(15, 113, 1, 1, 2026, NULL, NULL),
(16, 344, 1, 1, 2026, NULL, NULL),
(17, 82, 1, 1, 2026, NULL, NULL),
(18, 12, 1, 1, 2026, NULL, NULL),
(19, 345, 1, 1, 2026, NULL, NULL),
(20, 346, 1, 1, 2026, NULL, NULL),
(21, 182, 1, 1, 2026, NULL, NULL),
(22, 219, 1, 1, 2026, NULL, NULL),
(23, 16, 1, 1, 2026, NULL, NULL),
(24, 347, 1, 1, 2026, NULL, NULL),
(25, 53, 1, 1, 2026, NULL, NULL),
(26, 220, 1, 1, 2026, NULL, NULL),
(27, 186, 1, 1, 2026, NULL, NULL),
(28, 121, 1, 1, 2026, NULL, NULL),
(29, 155, 1, 1, 2026, NULL, NULL),
(30, 348, 1, 1, 2026, NULL, NULL),
(31, 349, 1, 1, 2026, NULL, NULL),
(32, 262, 1, 1, 2026, NULL, NULL),
(33, 26, 1, 1, 2026, NULL, NULL),
(34, 350, 1, 1, 2026, NULL, NULL),
(35, 351, 1, 1, 2026, NULL, NULL),
(36, 96, 1, 1, 2026, NULL, NULL),
(37, 335, 1, 1, 2026, NULL, NULL),
(38, 201, 1, 1, 2026, NULL, NULL),
(39, 271, 1, 1, 2026, NULL, NULL),
(40, 306, 1, 1, 2026, NULL, NULL),
(41, 71, 1, 1, 2026, NULL, NULL),
(42, 206, 1, 1, 2026, NULL, NULL),
(43, 74, 2, 1, 2026, NULL, NULL),
(44, 310, 2, 1, 2026, NULL, NULL),
(45, 243, 2, 1, 2026, NULL, NULL),
(46, 352, 2, 1, 2026, NULL, NULL),
(47, 278, 2, 1, 2026, NULL, NULL),
(48, 112, 2, 1, 2026, NULL, NULL),
(49, 47, 2, 1, 2026, NULL, NULL),
(50, 214, 2, 1, 2026, NULL, NULL),
(51, 179, 2, 1, 2026, NULL, NULL),
(52, 282, 2, 1, 2026, NULL, NULL),
(53, 353, 2, 1, 2026, NULL, NULL),
(54, 115, 2, 1, 2026, NULL, NULL),
(55, 285, 2, 1, 2026, NULL, NULL),
(56, 18, 2, 1, 2026, NULL, NULL),
(57, 119, 2, 1, 2026, NULL, NULL),
(58, 221, 2, 1, 2026, NULL, NULL),
(59, 323, 2, 1, 2026, NULL, NULL),
(60, 256, 2, 1, 2026, NULL, NULL),
(61, 258, 2, 1, 2026, NULL, NULL),
(62, 123, 2, 1, 2026, NULL, NULL),
(63, 23, 2, 1, 2026, NULL, NULL),
(64, 158, 2, 1, 2026, NULL, NULL),
(65, 227, 2, 1, 2026, NULL, NULL),
(66, 93, 2, 1, 2026, NULL, NULL),
(67, 159, 2, 1, 2026, NULL, NULL),
(68, 332, 2, 1, 2026, NULL, NULL),
(69, 63, 2, 1, 2026, NULL, NULL),
(70, 127, 2, 1, 2026, NULL, NULL),
(71, 66, 2, 1, 2026, NULL, NULL),
(72, 162, 2, 1, 2026, NULL, NULL),
(73, 133, 2, 1, 2026, NULL, NULL),
(74, 269, 2, 1, 2026, NULL, NULL),
(75, 236, 2, 1, 2026, NULL, NULL),
(76, 104, 2, 1, 2026, NULL, NULL),
(77, 273, 2, 1, 2026, NULL, NULL),
(78, 354, 3, 1, 2026, NULL, NULL),
(79, 41, 3, 1, 2026, NULL, NULL),
(80, 140, 3, 1, 2026, NULL, NULL),
(81, 43, 3, 1, 2026, NULL, NULL),
(82, 275, 3, 1, 2026, NULL, NULL),
(83, 212, 3, 1, 2026, NULL, NULL),
(84, 46, 3, 1, 2026, NULL, NULL),
(85, 146, 3, 1, 2026, NULL, NULL),
(86, 148, 3, 1, 2026, NULL, NULL),
(87, 319, 3, 1, 2026, NULL, NULL),
(88, 217, 3, 1, 2026, NULL, NULL),
(89, 51, 3, 1, 2026, NULL, NULL),
(90, 17, 3, 1, 2026, NULL, NULL),
(91, 355, 3, 1, 2026, NULL, NULL),
(92, 324, 3, 1, 2026, NULL, NULL),
(93, 22, 3, 1, 2026, NULL, NULL),
(94, 356, 3, 1, 2026, NULL, NULL),
(95, 226, 3, 1, 2026, NULL, NULL),
(96, 261, 3, 1, 2026, NULL, NULL),
(97, 330, 3, 1, 2026, NULL, NULL),
(98, 94, 3, 1, 2026, NULL, NULL),
(99, 296, 3, 1, 2026, NULL, NULL),
(100, 62, 3, 1, 2026, NULL, NULL),
(101, 28, 3, 1, 2026, NULL, NULL),
(102, 161, 3, 1, 2026, NULL, NULL),
(103, 98, 3, 1, 2026, NULL, NULL),
(104, 198, 3, 1, 2026, NULL, NULL),
(105, 199, 3, 1, 2026, NULL, NULL),
(106, 302, 3, 1, 2026, NULL, NULL),
(107, 357, 3, 1, 2026, NULL, NULL),
(108, 37, 3, 1, 2026, NULL, NULL),
(109, 171, 4, 1, 2026, NULL, NULL),
(110, 309, 4, 1, 2026, NULL, NULL),
(111, 142, 4, 1, 2026, NULL, NULL),
(112, 274, 4, 1, 2026, NULL, NULL),
(113, 210, 4, 1, 2026, NULL, NULL),
(114, 6, 4, 1, 2026, NULL, NULL),
(115, 79, 4, 1, 2026, NULL, NULL),
(116, 315, 4, 1, 2026, NULL, NULL),
(117, 215, 4, 1, 2026, NULL, NULL),
(118, 13, 4, 1, 2026, NULL, NULL),
(119, 50, 4, 1, 2026, NULL, NULL),
(120, 254, 4, 1, 2026, NULL, NULL),
(121, 154, 4, 1, 2026, NULL, NULL),
(122, 189, 4, 1, 2026, NULL, NULL),
(123, 223, 4, 1, 2026, NULL, NULL),
(124, 58, 4, 1, 2026, NULL, NULL),
(125, 91, 4, 1, 2026, NULL, NULL),
(126, 294, 4, 1, 2026, NULL, NULL),
(127, 61, 4, 1, 2026, NULL, NULL),
(128, 358, 4, 1, 2026, NULL, NULL),
(129, 126, 4, 1, 2026, NULL, NULL),
(130, 160, 4, 1, 2026, NULL, NULL),
(131, 299, 4, 1, 2026, NULL, NULL),
(132, 129, 4, 1, 2026, NULL, NULL),
(133, 31, 4, 1, 2026, NULL, NULL),
(134, 32, 4, 1, 2026, NULL, NULL),
(135, 304, 4, 1, 2026, NULL, NULL),
(136, 102, 4, 1, 2026, NULL, NULL),
(137, 202, 4, 1, 2026, NULL, NULL),
(138, 166, 4, 1, 2026, NULL, NULL),
(139, 359, 4, 1, 2026, NULL, NULL),
(140, 238, 4, 1, 2026, NULL, NULL),
(141, 2, 5, 1, 2026, NULL, NULL),
(142, 72, 5, 1, 2026, NULL, NULL),
(143, 173, 5, 1, 2026, NULL, NULL),
(144, 276, 5, 1, 2026, NULL, NULL),
(145, 9, 5, 1, 2026, NULL, NULL),
(146, 145, 5, 1, 2026, NULL, NULL),
(147, 316, 5, 1, 2026, NULL, NULL),
(148, 114, 5, 1, 2026, NULL, NULL),
(149, 180, 5, 1, 2026, NULL, NULL),
(150, 216, 5, 1, 2026, NULL, NULL),
(151, 360, 5, 1, 2026, NULL, NULL),
(152, 49, 5, 1, 2026, NULL, NULL),
(153, 320, 5, 1, 2026, NULL, NULL),
(154, 85, 5, 1, 2026, NULL, NULL),
(155, 252, 5, 1, 2026, NULL, NULL),
(156, 361, 5, 1, 2026, NULL, NULL),
(157, 152, 5, 1, 2026, NULL, NULL),
(158, 287, 5, 1, 2026, NULL, NULL),
(159, 255, 5, 1, 2026, NULL, NULL),
(160, 188, 5, 1, 2026, NULL, NULL),
(161, 122, 5, 1, 2026, NULL, NULL),
(162, 362, 5, 1, 2026, NULL, NULL),
(163, 329, 5, 1, 2026, NULL, NULL),
(164, 229, 5, 1, 2026, NULL, NULL),
(165, 295, 5, 1, 2026, NULL, NULL),
(166, 194, 5, 1, 2026, NULL, NULL),
(167, 297, 5, 1, 2026, NULL, NULL),
(168, 29, 5, 1, 2026, NULL, NULL),
(169, 95, 5, 1, 2026, NULL, NULL),
(170, 196, 5, 1, 2026, NULL, NULL),
(171, 134, 5, 1, 2026, NULL, NULL),
(172, 164, 5, 1, 2026, NULL, NULL),
(173, 234, 5, 1, 2026, NULL, NULL),
(174, 336, 5, 1, 2026, NULL, NULL),
(175, 70, 5, 1, 2026, NULL, NULL),
(176, 75, 6, 1, 2026, NULL, NULL),
(177, 5, 6, 1, 2026, NULL, NULL),
(178, 209, 6, 1, 2026, NULL, NULL),
(179, 245, 6, 1, 2026, NULL, NULL),
(180, 144, 6, 1, 2026, NULL, NULL),
(181, 48, 6, 1, 2026, NULL, NULL),
(182, 281, 6, 1, 2026, NULL, NULL),
(183, 147, 6, 1, 2026, NULL, NULL),
(184, 83, 6, 1, 2026, NULL, NULL),
(185, 116, 6, 1, 2026, NULL, NULL),
(186, 253, 6, 1, 2026, NULL, NULL),
(187, 321, 6, 1, 2026, NULL, NULL),
(188, 87, 6, 1, 2026, NULL, NULL),
(189, 288, 6, 1, 2026, NULL, NULL),
(190, 120, 6, 1, 2026, NULL, NULL),
(191, 21, 6, 1, 2026, NULL, NULL),
(192, 59, 6, 1, 2026, NULL, NULL),
(193, 328, 6, 1, 2026, NULL, NULL),
(194, 263, 6, 1, 2026, NULL, NULL),
(195, 230, 6, 1, 2026, NULL, NULL),
(196, 264, 6, 1, 2026, NULL, NULL),
(197, 298, 6, 1, 2026, NULL, NULL),
(198, 195, 6, 1, 2026, NULL, NULL),
(199, 30, 6, 1, 2026, NULL, NULL),
(200, 99, 6, 1, 2026, NULL, NULL),
(201, 197, 6, 1, 2026, NULL, NULL),
(202, 132, 6, 1, 2026, NULL, NULL),
(203, 267, 6, 1, 2026, NULL, NULL),
(204, 67, 6, 1, 2026, NULL, NULL),
(205, 33, 6, 1, 2026, NULL, NULL),
(206, 337, 6, 1, 2026, NULL, NULL),
(207, 35, 6, 1, 2026, NULL, NULL),
(208, 305, 6, 1, 2026, NULL, NULL),
(209, 307, 6, 1, 2026, NULL, NULL),
(210, 38, 7, 1, 2026, NULL, NULL),
(211, 170, 7, 1, 2026, NULL, NULL),
(212, 242, 7, 1, 2026, NULL, NULL),
(213, 110, 7, 1, 2026, NULL, NULL),
(214, 175, 7, 1, 2026, NULL, NULL),
(215, 313, 7, 1, 2026, NULL, NULL),
(216, 45, 7, 1, 2026, NULL, NULL),
(217, 10, 7, 1, 2026, NULL, NULL),
(218, 213, 7, 1, 2026, NULL, NULL),
(219, 247, 7, 1, 2026, NULL, NULL),
(220, 248, 7, 1, 2026, NULL, NULL),
(221, 250, 7, 1, 2026, NULL, NULL),
(222, 84, 7, 1, 2026, NULL, NULL),
(223, 183, 7, 1, 2026, NULL, NULL),
(224, 19, 7, 1, 2026, NULL, NULL),
(225, 153, 7, 1, 2026, NULL, NULL),
(226, 222, 7, 1, 2026, NULL, NULL),
(227, 65, 7, 1, 2026, NULL, NULL),
(228, 57, 7, 1, 2026, NULL, NULL),
(229, 290, 7, 1, 2026, NULL, NULL),
(230, 190, 7, 1, 2026, NULL, NULL),
(231, 327, 7, 1, 2026, NULL, NULL),
(232, 24, 7, 1, 2026, NULL, NULL),
(233, 60, 7, 1, 2026, NULL, NULL),
(234, 331, 7, 1, 2026, NULL, NULL),
(235, 366, 7, 1, 2026, NULL, NULL),
(236, 97, 7, 1, 2026, NULL, NULL),
(237, 130, 7, 1, 2026, NULL, NULL),
(238, 268, 7, 1, 2026, NULL, NULL),
(239, 100, 7, 1, 2026, NULL, NULL),
(240, 237, 7, 1, 2026, NULL, NULL),
(241, 136, 7, 1, 2026, NULL, NULL),
(242, 338, 7, 1, 2026, NULL, NULL),
(243, 167, 7, 1, 2026, NULL, NULL),
(244, 204, 7, 1, 2026, NULL, NULL),
(245, 340, 7, 1, 2026, NULL, NULL),
(246, 106, 8, 1, 2026, NULL, NULL),
(247, 107, 8, 1, 2026, NULL, NULL),
(248, 241, 8, 1, 2026, NULL, NULL),
(249, 208, 8, 1, 2026, NULL, NULL),
(250, 109, 8, 1, 2026, NULL, NULL),
(251, 143, 8, 1, 2026, NULL, NULL),
(252, 314, 8, 1, 2026, NULL, NULL),
(253, 81, 8, 1, 2026, NULL, NULL),
(254, 367, 8, 1, 2026, NULL, NULL),
(255, 368, 8, 1, 2026, NULL, NULL),
(256, 284, 8, 1, 2026, NULL, NULL),
(257, 149, 8, 1, 2026, NULL, NULL),
(258, 286, 8, 1, 2026, NULL, NULL),
(259, 185, 8, 1, 2026, NULL, NULL),
(260, 56, 8, 1, 2026, NULL, NULL),
(261, 289, 8, 1, 2026, NULL, NULL),
(262, 293, 8, 1, 2026, NULL, NULL),
(263, 326, 8, 1, 2026, NULL, NULL),
(264, 90, 8, 1, 2026, NULL, NULL),
(265, 224, 8, 1, 2026, NULL, NULL),
(266, 259, 8, 1, 2026, NULL, NULL),
(267, 27, 8, 1, 2026, NULL, NULL),
(268, 265, 8, 1, 2026, NULL, NULL),
(269, 334, 8, 1, 2026, NULL, NULL),
(270, 301, 8, 1, 2026, NULL, NULL),
(271, 34, 8, 1, 2026, NULL, NULL),
(272, 69, 8, 1, 2026, NULL, NULL),
(273, 165, 8, 1, 2026, NULL, NULL),
(274, 270, 8, 1, 2026, NULL, NULL),
(275, 203, 8, 1, 2026, NULL, NULL),
(276, 105, 8, 1, 2026, NULL, NULL),
(277, 138, 8, 1, 2026, NULL, NULL),
(278, 169, 8, 1, 2026, NULL, NULL),
(279, 272, 8, 1, 2026, NULL, NULL),
(280, 240, 8, 1, 2026, NULL, NULL),
(281, 369, 9, 1, 2026, NULL, NULL),
(282, 40, 9, 1, 2026, NULL, NULL),
(283, 73, 9, 1, 2026, NULL, NULL),
(284, 42, 9, 1, 2026, NULL, NULL),
(285, 4, 9, 1, 2026, NULL, NULL),
(286, 370, 9, 1, 2026, NULL, NULL),
(287, 78, 9, 1, 2026, NULL, NULL),
(288, 111, 9, 1, 2026, NULL, NULL),
(289, 80, 9, 1, 2026, NULL, NULL),
(290, 178, 9, 1, 2026, NULL, NULL),
(291, 317, 9, 1, 2026, NULL, NULL),
(292, 283, 9, 1, 2026, NULL, NULL),
(293, 218, 9, 1, 2026, NULL, NULL),
(294, 52, 9, 1, 2026, NULL, NULL),
(295, 89, 9, 1, 2026, NULL, NULL),
(296, 371, 9, 1, 2026, NULL, NULL),
(297, 372, 9, 1, 2026, NULL, NULL),
(298, 20, 9, 1, 2026, NULL, NULL),
(299, 291, 9, 1, 2026, NULL, NULL),
(300, 92, 9, 1, 2026, NULL, NULL),
(301, 333, 9, 1, 2026, NULL, NULL),
(302, 232, 9, 1, 2026, NULL, NULL),
(303, 131, 9, 1, 2026, NULL, NULL),
(304, 200, 9, 1, 2026, NULL, NULL),
(305, 68, 9, 1, 2026, NULL, NULL),
(306, 373, 9, 1, 2026, NULL, NULL),
(307, 374, 9, 1, 2026, NULL, NULL),
(308, 235, 9, 1, 2026, NULL, NULL),
(309, 303, 9, 1, 2026, NULL, NULL),
(310, 375, 9, 1, 2026, NULL, NULL),
(311, 139, 9, 1, 2026, NULL, NULL),
(312, 308, 9, 1, 2026, NULL, NULL),
(313, 239, 9, 1, 2026, NULL, NULL),
(314, 341, 9, 1, 2026, NULL, NULL),
(315, 39, 10, 1, 2026, NULL, NULL),
(316, 108, 10, 1, 2026, NULL, NULL),
(317, 376, 10, 1, 2026, NULL, NULL),
(318, 377, 10, 1, 2026, NULL, NULL),
(319, 77, 10, 1, 2026, NULL, NULL),
(320, 7, 10, 1, 2026, NULL, NULL),
(321, 8, 10, 1, 2026, NULL, NULL),
(322, 279, 10, 1, 2026, NULL, NULL),
(323, 177, 10, 1, 2026, NULL, NULL),
(324, 280, 10, 1, 2026, NULL, NULL),
(325, 15, 10, 1, 2026, NULL, NULL),
(326, 181, 10, 1, 2026, NULL, NULL),
(327, 251, 10, 1, 2026, NULL, NULL),
(328, 150, 10, 1, 2026, NULL, NULL),
(329, 117, 10, 1, 2026, NULL, NULL),
(330, 322, 10, 1, 2026, NULL, NULL),
(331, 118, 10, 1, 2026, NULL, NULL),
(332, 88, 10, 1, 2026, NULL, NULL),
(333, 187, 10, 1, 2026, NULL, NULL),
(334, 156, 10, 1, 2026, NULL, NULL),
(335, 157, 10, 1, 2026, NULL, NULL),
(336, 191, 10, 1, 2026, NULL, NULL),
(337, 124, 10, 1, 2026, NULL, NULL),
(338, 25, 10, 1, 2026, NULL, NULL),
(339, 125, 10, 1, 2026, NULL, NULL),
(340, 192, 10, 1, 2026, NULL, NULL),
(341, 193, 10, 1, 2026, NULL, NULL),
(342, 128, 10, 1, 2026, NULL, NULL),
(343, 378, 10, 1, 2026, NULL, NULL),
(344, 266, 10, 1, 2026, NULL, NULL),
(345, 163, 10, 1, 2026, NULL, NULL),
(346, 233, 10, 1, 2026, NULL, NULL),
(347, 379, 11, 1, 2026, NULL, NULL),
(348, 380, 11, 1, 2026, NULL, NULL),
(349, 381, 11, 1, 2026, NULL, NULL),
(350, 382, 11, 1, 2026, NULL, NULL),
(351, 383, 11, 1, 2026, NULL, NULL),
(352, 384, 11, 1, 2026, NULL, NULL),
(353, 385, 11, 1, 2026, NULL, NULL),
(354, 386, 11, 1, 2026, NULL, NULL),
(355, 387, 11, 1, 2026, NULL, NULL),
(356, 388, 11, 1, 2026, NULL, NULL),
(357, 389, 11, 1, 2026, NULL, NULL),
(358, 390, 11, 1, 2026, NULL, NULL),
(360, 391, 11, 1, 2026, NULL, NULL),
(361, 392, 11, 1, 2026, NULL, NULL),
(362, 393, 11, 1, 2026, NULL, NULL),
(363, 394, 11, 1, 2026, NULL, NULL),
(364, 395, 11, 1, 2026, NULL, NULL),
(365, 396, 11, 1, 2026, NULL, NULL),
(366, 397, 11, 1, 2026, NULL, NULL),
(367, 398, 11, 1, 2026, NULL, NULL),
(368, 399, 11, 1, 2026, NULL, NULL),
(369, 400, 11, 1, 2026, NULL, NULL),
(370, 401, 11, 1, 2026, NULL, NULL),
(371, 402, 11, 1, 2026, NULL, NULL),
(372, 403, 11, 1, 2026, NULL, NULL),
(373, 404, 11, 1, 2026, NULL, NULL),
(374, 405, 11, 1, 2026, NULL, NULL),
(375, 406, 11, 1, 2026, NULL, NULL),
(376, 407, 12, 1, 2026, NULL, NULL),
(377, 408, 12, 1, 2026, NULL, NULL),
(378, 409, 12, 1, 2026, NULL, NULL),
(379, 410, 12, 1, 2026, NULL, NULL),
(380, 411, 12, 1, 2026, NULL, NULL),
(381, 412, 12, 1, 2026, NULL, NULL),
(382, 413, 12, 1, 2026, NULL, NULL),
(383, 414, 12, 1, 2026, NULL, NULL),
(384, 415, 12, 1, 2026, NULL, NULL),
(385, 416, 12, 1, 2026, NULL, NULL),
(386, 417, 12, 1, 2026, NULL, NULL),
(387, 418, 12, 1, 2026, NULL, NULL),
(388, 419, 12, 1, 2026, NULL, NULL),
(389, 420, 12, 1, 2026, NULL, NULL),
(390, 421, 12, 1, 2026, NULL, NULL),
(391, 422, 12, 1, 2026, NULL, NULL),
(392, 423, 12, 1, 2026, NULL, NULL),
(393, 424, 12, 1, 2026, NULL, NULL),
(394, 425, 12, 1, 2026, NULL, NULL),
(395, 426, 12, 1, 2026, NULL, NULL),
(396, 427, 12, 1, 2026, NULL, NULL),
(397, 428, 12, 1, 2026, NULL, NULL),
(398, 429, 12, 1, 2026, NULL, NULL),
(399, 430, 12, 1, 2026, NULL, NULL),
(400, 431, 12, 1, 2026, NULL, NULL),
(401, 432, 12, 1, 2026, NULL, NULL),
(402, 433, 12, 1, 2026, NULL, NULL),
(403, 434, 12, 1, 2026, NULL, NULL),
(404, 435, 13, 1, 2026, NULL, NULL),
(405, 436, 13, 1, 2026, NULL, NULL),
(406, 437, 13, 1, 2026, NULL, NULL),
(407, 438, 13, 1, 2026, NULL, NULL),
(408, 439, 13, 1, 2026, NULL, NULL),
(409, 440, 13, 1, 2026, NULL, NULL),
(410, 441, 13, 1, 2026, NULL, NULL),
(411, 442, 13, 1, 2026, NULL, NULL),
(412, 443, 13, 1, 2026, NULL, NULL),
(413, 444, 13, 1, 2026, NULL, NULL),
(414, 445, 13, 1, 2026, NULL, NULL),
(415, 446, 13, 1, 2026, NULL, NULL),
(416, 447, 13, 1, 2026, NULL, NULL),
(417, 448, 13, 1, 2026, NULL, NULL),
(418, 449, 13, 1, 2026, NULL, NULL),
(419, 450, 13, 1, 2026, NULL, NULL),
(420, 451, 13, 1, 2026, NULL, NULL),
(421, 452, 13, 1, 2026, NULL, NULL),
(422, 453, 13, 1, 2026, NULL, NULL),
(423, 454, 13, 1, 2026, NULL, NULL),
(424, 455, 13, 1, 2026, NULL, NULL),
(425, 456, 13, 1, 2026, NULL, NULL),
(426, 457, 13, 1, 2026, NULL, NULL),
(427, 458, 13, 1, 2026, NULL, NULL),
(428, 459, 13, 1, 2026, NULL, NULL),
(429, 460, 13, 1, 2026, NULL, NULL),
(430, 461, 13, 1, 2026, NULL, NULL),
(431, 462, 13, 1, 2026, NULL, NULL),
(432, 463, 14, 1, 2026, NULL, NULL),
(433, 464, 14, 1, 2026, NULL, NULL),
(434, 465, 14, 1, 2026, NULL, NULL),
(435, 466, 14, 1, 2026, NULL, NULL),
(436, 467, 14, 1, 2026, NULL, NULL),
(437, 468, 14, 1, 2026, NULL, NULL),
(438, 469, 14, 1, 2026, NULL, NULL),
(439, 470, 14, 1, 2026, NULL, NULL),
(440, 471, 14, 1, 2026, NULL, NULL),
(441, 472, 14, 1, 2026, NULL, NULL),
(442, 473, 14, 1, 2026, NULL, NULL),
(443, 474, 14, 1, 2026, NULL, NULL),
(444, 475, 14, 1, 2026, NULL, NULL),
(445, 476, 14, 1, 2026, NULL, NULL),
(446, 477, 14, 1, 2026, NULL, NULL),
(447, 478, 14, 1, 2026, NULL, NULL),
(448, 479, 14, 1, 2026, NULL, NULL),
(449, 480, 14, 1, 2026, NULL, NULL),
(450, 481, 14, 1, 2026, NULL, NULL),
(451, 482, 14, 1, 2026, NULL, NULL),
(452, 485, 14, 1, 2026, NULL, NULL),
(453, 486, 14, 1, 2026, NULL, NULL),
(454, 486, 14, 1, 2026, NULL, NULL),
(455, 487, 14, 1, 2026, NULL, NULL),
(456, 488, 14, 1, 2026, NULL, NULL),
(457, 489, 14, 1, 2026, NULL, NULL),
(458, 490, 14, 1, 2026, NULL, NULL),
(459, 491, 14, 1, 2026, NULL, NULL),
(460, 492, 15, 1, 2026, NULL, NULL),
(461, 493, 15, 1, 2026, NULL, NULL),
(462, 494, 15, 1, 2026, NULL, NULL),
(463, 495, 15, 1, 2026, NULL, NULL),
(464, 496, 15, 1, 2026, NULL, NULL),
(465, 497, 15, 1, 2026, NULL, NULL),
(466, 498, 15, 1, 2026, NULL, NULL),
(467, 499, 15, 1, 2026, NULL, NULL),
(468, 500, 15, 1, 2026, NULL, NULL),
(469, 501, 15, 1, 2026, NULL, NULL),
(470, 502, 15, 1, 2026, NULL, NULL),
(471, 503, 15, 1, 2026, NULL, NULL),
(472, 504, 15, 1, 2026, NULL, NULL),
(473, 505, 15, 1, 2026, NULL, NULL),
(474, 506, 15, 1, 2026, NULL, NULL),
(475, 507, 15, 1, 2026, NULL, NULL),
(476, 508, 15, 1, 2026, NULL, NULL),
(477, 509, 15, 1, 2026, NULL, NULL),
(478, 510, 15, 1, 2026, NULL, NULL),
(479, 511, 15, 1, 2026, NULL, NULL),
(480, 512, 15, 1, 2026, NULL, NULL),
(481, 513, 15, 1, 2026, NULL, NULL),
(482, 514, 15, 1, 2026, NULL, NULL),
(483, 515, 15, 1, 2026, NULL, NULL),
(485, 516, 15, 1, 2026, NULL, NULL),
(486, 517, 15, 1, 2026, NULL, NULL),
(487, 518, 15, 1, 2026, NULL, NULL),
(488, 519, 15, 1, 2026, NULL, NULL),
(489, 520, 15, 1, 2026, NULL, NULL),
(490, 521, 15, 1, 2026, NULL, NULL),
(491, 522, 16, 1, 2026, NULL, NULL),
(492, 523, 16, 1, 2026, NULL, NULL),
(493, 524, 16, 1, 2026, NULL, NULL),
(494, 525, 16, 1, 2026, NULL, NULL),
(495, 526, 16, 1, 2026, NULL, NULL),
(496, 527, 16, 1, 2026, NULL, NULL),
(497, 528, 16, 1, 2026, NULL, NULL),
(498, 529, 16, 1, 2026, NULL, NULL),
(499, 530, 16, 1, 2026, NULL, NULL),
(500, 531, 16, 1, 2026, NULL, NULL),
(501, 532, 16, 1, 2026, NULL, NULL),
(502, 533, 16, 1, 2026, NULL, NULL),
(503, 534, 16, 1, 2026, NULL, NULL),
(504, 535, 16, 1, 2026, NULL, NULL),
(505, 536, 16, 1, 2026, NULL, NULL),
(506, 537, 16, 1, 2026, NULL, NULL),
(507, 538, 16, 1, 2026, NULL, NULL),
(508, 539, 16, 1, 2026, NULL, NULL),
(509, 540, 16, 1, 2026, NULL, NULL),
(510, 541, 16, 1, 2026, NULL, NULL),
(511, 542, 16, 1, 2026, NULL, NULL),
(512, 543, 16, 1, 2026, NULL, NULL),
(513, 544, 16, 1, 2026, NULL, NULL),
(514, 545, 16, 1, 2026, NULL, NULL),
(515, 546, 16, 1, 2026, NULL, NULL),
(516, 547, 16, 1, 2026, NULL, NULL),
(517, 548, 16, 1, 2026, NULL, NULL),
(518, 549, 16, 1, 2026, NULL, NULL),
(519, 550, 16, 1, 2026, NULL, NULL),
(520, 551, 16, 1, 2026, NULL, NULL),
(521, 552, 17, 1, 2026, NULL, NULL),
(522, 553, 17, 1, 2026, NULL, NULL),
(523, 554, 17, 1, 2026, NULL, NULL),
(524, 555, 17, 1, 2026, NULL, NULL),
(525, 556, 17, 1, 2026, NULL, NULL),
(526, 557, 17, 1, 2026, NULL, NULL),
(527, 558, 17, 1, 2026, NULL, NULL),
(528, 559, 17, 1, 2026, NULL, NULL),
(529, 560, 17, 1, 2026, NULL, NULL),
(530, 561, 17, 1, 2026, NULL, NULL),
(531, 562, 17, 1, 2026, NULL, NULL),
(532, 563, 17, 1, 2026, NULL, NULL),
(533, 564, 17, 1, 2026, NULL, NULL),
(534, 565, 17, 1, 2026, NULL, NULL),
(535, 566, 17, 1, 2026, NULL, NULL),
(536, 567, 17, 1, 2026, NULL, NULL),
(537, 568, 17, 1, 2026, NULL, NULL),
(538, 569, 17, 1, 2026, NULL, NULL),
(539, 570, 17, 1, 2026, NULL, NULL),
(540, 571, 17, 1, 2026, NULL, NULL),
(541, 572, 17, 1, 2026, NULL, NULL),
(542, 573, 17, 1, 2026, NULL, NULL),
(543, 574, 17, 1, 2026, NULL, NULL),
(544, 575, 17, 1, 2026, NULL, NULL),
(545, 576, 17, 1, 2026, NULL, NULL),
(547, 577, 17, 1, 2026, NULL, NULL),
(548, 578, 17, 1, 2026, NULL, NULL),
(549, 579, 17, 1, 2026, NULL, NULL),
(550, 580, 17, 1, 2026, NULL, NULL),
(551, 581, 17, 1, 2026, NULL, NULL),
(552, 582, 17, 1, 2026, NULL, NULL),
(553, 583, 18, 1, 2026, NULL, NULL),
(554, 584, 18, 1, 2026, NULL, NULL),
(555, 585, 18, 1, 2026, NULL, NULL),
(556, 586, 18, 1, 2026, NULL, NULL),
(557, 587, 18, 1, 2026, NULL, NULL),
(558, 588, 18, 1, 2026, NULL, NULL),
(559, 589, 18, 1, 2026, NULL, NULL),
(560, 590, 18, 1, 2026, NULL, NULL),
(561, 591, 18, 1, 2026, NULL, NULL),
(562, 592, 18, 1, 2026, NULL, NULL),
(563, 593, 18, 1, 2026, NULL, NULL),
(564, 594, 18, 1, 2026, NULL, NULL),
(565, 595, 18, 1, 2026, NULL, NULL),
(566, 596, 18, 1, 2026, NULL, NULL),
(567, 597, 18, 1, 2026, NULL, NULL),
(568, 598, 18, 1, 2026, NULL, NULL),
(570, 599, 18, 1, 2026, NULL, NULL),
(571, 600, 18, 1, 2026, NULL, NULL),
(572, 601, 18, 1, 2026, NULL, NULL),
(573, 602, 18, 1, 2026, NULL, NULL),
(574, 603, 18, 1, 2026, NULL, NULL),
(575, 604, 18, 1, 2026, NULL, NULL),
(576, 605, 18, 1, 2026, NULL, NULL),
(577, 606, 18, 1, 2026, NULL, NULL),
(578, 607, 18, 1, 2026, NULL, NULL),
(579, 608, 18, 1, 2026, NULL, NULL),
(580, 609, 18, 1, 2026, NULL, NULL),
(581, 610, 18, 1, 2026, NULL, NULL),
(582, 611, 18, 1, 2026, NULL, NULL),
(583, 612, 18, 1, 2026, NULL, NULL),
(584, 613, 18, 1, 2026, NULL, NULL),
(585, 614, 19, 1, 2026, NULL, NULL),
(586, 615, 19, 1, 2026, NULL, NULL),
(587, 616, 19, 1, 2026, NULL, NULL),
(588, 617, 19, 1, 2026, NULL, NULL),
(589, 618, 19, 1, 2026, NULL, NULL),
(590, 619, 19, 1, 2026, NULL, NULL),
(591, 620, 19, 1, 2026, NULL, NULL),
(592, 620, 19, 1, 2026, NULL, NULL),
(593, 622, 19, 1, 2026, NULL, NULL),
(594, 623, 19, 1, 2026, NULL, NULL),
(595, 624, 19, 1, 2026, NULL, NULL),
(596, 625, 19, 1, 2026, NULL, NULL),
(597, 626, 19, 1, 2026, NULL, NULL),
(598, 627, 19, 1, 2026, NULL, NULL),
(599, 628, 19, 1, 2026, NULL, NULL),
(600, 629, 19, 1, 2026, NULL, NULL),
(601, 630, 19, 1, 2026, NULL, NULL),
(602, 632, 19, 1, 2026, NULL, NULL),
(603, 633, 19, 1, 2026, NULL, NULL),
(604, 634, 19, 1, 2026, NULL, NULL),
(605, 635, 19, 1, 2026, NULL, NULL),
(606, 636, 19, 1, 2026, NULL, NULL),
(607, 637, 19, 1, 2026, NULL, NULL),
(608, 638, 19, 1, 2026, NULL, NULL),
(609, 638, 19, 1, 2026, NULL, NULL),
(610, 639, 19, 1, 2026, NULL, NULL),
(611, 640, 19, 1, 2026, NULL, NULL),
(612, 641, 19, 1, 2026, NULL, NULL),
(613, 642, 19, 1, 2026, NULL, NULL),
(614, 643, 20, 1, 2026, NULL, NULL),
(615, 644, 20, 1, 2026, NULL, NULL),
(616, 645, 20, 1, 2026, NULL, NULL),
(617, 646, 20, 1, 2026, NULL, NULL),
(618, 647, 20, 1, 2026, NULL, NULL),
(619, 648, 20, 1, 2026, NULL, NULL),
(620, 649, 20, 1, 2026, NULL, NULL),
(621, 650, 20, 1, 2026, NULL, NULL),
(622, 651, 20, 1, 2026, NULL, NULL),
(623, 652, 20, 1, 2026, NULL, NULL),
(624, 653, 20, 1, 2026, NULL, NULL),
(625, 654, 20, 1, 2026, NULL, NULL),
(626, 655, 20, 1, 2026, NULL, NULL),
(627, 656, 20, 1, 2026, NULL, NULL),
(628, 657, 20, 1, 2026, NULL, NULL),
(629, 658, 20, 1, 2026, NULL, NULL),
(630, 659, 20, 1, 2026, NULL, NULL),
(631, 660, 20, 1, 2026, NULL, NULL),
(632, 661, 20, 1, 2026, NULL, NULL),
(633, 662, 20, 1, 2026, NULL, NULL),
(634, 663, 20, 1, 2026, NULL, NULL),
(635, 664, 20, 1, 2026, NULL, NULL),
(636, 665, 20, 1, 2026, NULL, NULL),
(637, 666, 20, 1, 2026, NULL, NULL),
(638, 667, 20, 1, 2026, NULL, NULL),
(639, 668, 20, 1, 2026, NULL, NULL),
(640, 669, 20, 1, 2026, NULL, NULL),
(641, 670, 20, 1, 2026, NULL, NULL),
(642, 671, 20, 1, 2026, NULL, NULL),
(643, 672, 20, 1, 2026, NULL, NULL),
(644, 673, 20, 1, 2026, NULL, NULL),
(645, 674, 20, 1, 2026, NULL, NULL),
(646, 675, 21, 1, 2026, NULL, NULL),
(647, 676, 21, 1, 2026, NULL, NULL),
(648, 677, 21, 1, 2026, NULL, NULL),
(649, 678, 21, 1, 2026, NULL, NULL),
(650, 679, 21, 1, 2026, NULL, NULL),
(651, 680, 21, 1, 2026, NULL, NULL),
(652, 681, 21, 1, 2026, NULL, NULL),
(653, 682, 21, 1, 2026, NULL, NULL),
(654, 683, 21, 1, 2026, NULL, NULL),
(655, 684, 21, 1, 2026, NULL, NULL),
(656, 685, 21, 1, 2026, NULL, NULL),
(657, 686, 21, 1, 2026, NULL, NULL),
(658, 687, 21, 1, 2026, NULL, NULL),
(659, 688, 21, 1, 2026, NULL, NULL),
(660, 689, 21, 1, 2026, NULL, NULL),
(661, 690, 21, 1, 2026, NULL, NULL),
(662, 691, 21, 1, 2026, NULL, NULL),
(663, 692, 21, 1, 2026, NULL, NULL),
(664, 693, 21, 1, 2026, NULL, NULL),
(665, 694, 21, 1, 2026, NULL, NULL),
(666, 695, 21, 1, 2026, NULL, NULL),
(667, 696, 21, 1, 2026, NULL, NULL),
(668, 697, 21, 1, 2026, NULL, NULL),
(669, 698, 21, 1, 2026, NULL, NULL),
(670, 699, 21, 1, 2026, NULL, NULL),
(671, 700, 21, 1, 2026, NULL, NULL),
(672, 701, 21, 1, 2026, NULL, NULL),
(673, 702, 21, 1, 2026, NULL, NULL),
(674, 703, 21, 1, 2026, NULL, NULL),
(675, 704, 21, 1, 2026, NULL, NULL),
(676, 705, 21, 1, 2026, NULL, NULL),
(677, 706, 21, 1, 2026, NULL, NULL),
(678, 707, 21, 1, 2026, NULL, NULL),
(679, 708, 22, 1, 2026, NULL, NULL),
(680, 709, 22, 1, 2026, NULL, NULL),
(681, 710, 22, 1, 2026, NULL, NULL),
(682, 711, 22, 1, 2026, NULL, NULL),
(683, 712, 22, 1, 2026, NULL, NULL),
(684, 713, 22, 1, 2026, NULL, NULL),
(685, 714, 22, 1, 2026, NULL, NULL),
(686, 715, 22, 1, 2026, NULL, NULL),
(687, 716, 22, 1, 2026, NULL, NULL),
(688, 717, 22, 1, 2026, NULL, NULL),
(689, 718, 22, 1, 2026, NULL, NULL),
(690, 719, 22, 1, 2026, NULL, NULL),
(691, 720, 22, 1, 2026, NULL, NULL),
(692, 721, 22, 1, 2026, NULL, NULL),
(693, 722, 22, 1, 2026, NULL, NULL),
(694, 723, 22, 1, 2026, NULL, NULL),
(695, 727, 22, 1, 2026, NULL, NULL),
(696, 728, 22, 1, 2026, NULL, NULL),
(697, 729, 22, 1, 2026, NULL, NULL),
(698, 730, 22, 1, 2026, NULL, NULL),
(699, 731, 22, 1, 2026, NULL, NULL),
(700, 732, 22, 1, 2026, NULL, NULL),
(701, 733, 22, 1, 2026, NULL, NULL),
(702, 734, 22, 1, 2026, NULL, NULL),
(703, 735, 22, 1, 2026, NULL, NULL),
(704, 736, 22, 1, 2026, NULL, NULL),
(705, 737, 22, 1, 2026, NULL, NULL),
(706, 738, 22, 1, 2026, NULL, NULL),
(707, 739, 22, 1, 2026, NULL, NULL),
(708, 740, 22, 1, 2026, NULL, NULL),
(709, 724, 22, 1, 2026, NULL, NULL),
(710, 725, 22, 1, 2026, NULL, NULL),
(711, 726, 22, 1, 2026, NULL, NULL),
(712, 741, 23, 1, 2026, NULL, NULL),
(713, 742, 23, 1, 2026, NULL, NULL),
(714, 743, 23, 1, 2026, NULL, NULL),
(715, 744, 23, 1, 2026, NULL, NULL),
(716, 745, 23, 1, 2026, NULL, NULL),
(717, 746, 23, 1, 2026, NULL, NULL),
(718, 747, 23, 1, 2026, NULL, NULL),
(719, 748, 23, 1, 2026, NULL, NULL),
(720, 749, 23, 1, 2026, NULL, NULL),
(721, 750, 23, 1, 2026, NULL, NULL),
(722, 751, 23, 1, 2026, NULL, NULL),
(723, 752, 23, 1, 2026, NULL, NULL),
(724, 753, 23, 1, 2026, NULL, NULL),
(725, 754, 23, 1, 2026, NULL, NULL),
(726, 755, 23, 1, 2026, NULL, NULL),
(727, 756, 23, 1, 2026, NULL, NULL),
(728, 757, 23, 1, 2026, NULL, NULL),
(729, 759, 23, 1, 2026, NULL, NULL),
(730, 760, 23, 1, 2026, NULL, NULL),
(731, 761, 23, 1, 2026, NULL, NULL),
(732, 762, 23, 1, 2026, NULL, NULL),
(733, 763, 23, 1, 2026, NULL, NULL),
(734, 764, 23, 1, 2026, NULL, NULL),
(735, 765, 23, 1, 2026, NULL, NULL),
(736, 766, 23, 1, 2026, NULL, NULL),
(737, 767, 23, 1, 2026, NULL, NULL),
(738, 768, 23, 1, 2026, NULL, NULL),
(739, 769, 23, 1, 2026, NULL, NULL),
(740, 770, 23, 1, 2026, NULL, NULL),
(741, 771, 23, 1, 2026, NULL, NULL),
(742, 772, 23, 1, 2026, NULL, NULL),
(743, 773, 23, 1, 2026, NULL, NULL),
(744, 774, 24, 1, 2026, NULL, NULL),
(745, 775, 24, 1, 2026, NULL, NULL),
(746, 776, 24, 1, 2026, NULL, NULL),
(747, 777, 24, 1, 2026, NULL, NULL),
(748, 778, 24, 1, 2026, NULL, NULL),
(749, 779, 24, 1, 2026, NULL, NULL),
(750, 780, 24, 1, 2026, NULL, NULL),
(751, 781, 24, 1, 2026, NULL, NULL),
(752, 782, 24, 1, 2026, NULL, NULL),
(753, 783, 24, 1, 2026, NULL, NULL),
(754, 784, 24, 1, 2026, NULL, NULL),
(755, 785, 24, 1, 2026, NULL, NULL),
(756, 786, 24, 1, 2026, NULL, NULL),
(757, 787, 24, 1, 2026, NULL, NULL),
(758, 788, 24, 1, 2026, NULL, NULL),
(759, 789, 24, 1, 2026, NULL, NULL),
(760, 790, 24, 1, 2026, NULL, NULL),
(761, 791, 24, 1, 2026, NULL, NULL),
(762, 792, 24, 1, 2026, NULL, NULL),
(763, 793, 24, 1, 2026, NULL, NULL),
(764, 794, 24, 1, 2026, NULL, NULL),
(765, 795, 24, 1, 2026, NULL, NULL),
(766, 796, 24, 1, 2026, NULL, NULL),
(767, 797, 24, 1, 2026, NULL, NULL),
(768, 798, 24, 1, 2026, NULL, NULL),
(769, 799, 24, 1, 2026, NULL, NULL),
(770, 800, 24, 1, 2026, NULL, NULL),
(771, 801, 24, 1, 2026, NULL, NULL),
(772, 802, 24, 1, 2026, NULL, NULL),
(773, 803, 24, 1, 2026, NULL, NULL),
(774, 804, 24, 1, 2026, NULL, NULL),
(775, 805, 24, 1, 2026, NULL, NULL),
(776, 806, 24, 1, 2026, NULL, NULL),
(777, 807, 25, 1, 2026, NULL, NULL),
(778, 808, 25, 1, 2026, NULL, NULL),
(779, 809, 25, 1, 2026, NULL, NULL),
(780, 810, 25, 1, 2026, NULL, NULL),
(781, 811, 25, 1, 2026, NULL, NULL),
(782, 812, 25, 1, 2026, NULL, NULL),
(783, 813, 25, 1, 2026, NULL, NULL),
(784, 814, 25, 1, 2026, NULL, NULL),
(785, 815, 25, 1, 2026, NULL, NULL),
(786, 816, 25, 1, 2026, NULL, NULL),
(787, 817, 25, 1, 2026, NULL, NULL),
(788, 818, 25, 1, 2026, NULL, NULL),
(789, 819, 25, 1, 2026, NULL, NULL),
(790, 820, 25, 1, 2026, NULL, NULL),
(791, 821, 25, 1, 2026, NULL, NULL),
(792, 822, 25, 1, 2026, NULL, NULL),
(793, 823, 25, 1, 2026, NULL, NULL),
(794, 824, 25, 1, 2026, NULL, NULL),
(795, 825, 25, 1, 2026, NULL, NULL),
(796, 826, 25, 1, 2026, NULL, NULL),
(797, 827, 25, 1, 2026, NULL, NULL),
(798, 828, 25, 1, 2026, NULL, NULL),
(799, 829, 25, 1, 2026, NULL, NULL),
(800, 830, 25, 1, 2026, NULL, NULL),
(801, 831, 25, 1, 2026, NULL, NULL),
(802, 832, 25, 1, 2026, NULL, NULL),
(803, 833, 25, 1, 2026, NULL, NULL),
(804, 834, 25, 1, 2026, NULL, NULL),
(805, 835, 25, 1, 2026, NULL, NULL),
(806, 836, 25, 1, 2026, NULL, NULL),
(807, 837, 25, 1, 2026, NULL, NULL),
(808, 838, 25, 1, 2026, NULL, NULL),
(809, 839, 26, 1, 2026, NULL, NULL),
(810, 840, 26, 1, 2026, NULL, NULL),
(811, 841, 26, 1, 2026, NULL, NULL),
(812, 842, 26, 1, 2026, NULL, NULL),
(813, 843, 26, 1, 2026, NULL, NULL),
(814, 844, 26, 1, 2026, NULL, NULL),
(815, 845, 26, 1, 2026, NULL, NULL),
(816, 846, 26, 1, 2026, NULL, NULL),
(817, 847, 26, 1, 2026, NULL, NULL),
(818, 848, 26, 1, 2026, NULL, NULL),
(819, 849, 26, 1, 2026, NULL, NULL),
(820, 850, 26, 1, 2026, NULL, NULL),
(821, 851, 26, 1, 2026, NULL, NULL),
(822, 852, 26, 1, 2026, NULL, NULL),
(823, 853, 26, 1, 2026, NULL, NULL),
(824, 854, 26, 1, 2026, NULL, NULL),
(825, 855, 26, 1, 2026, NULL, NULL),
(826, 856, 26, 1, 2026, NULL, NULL),
(827, 857, 26, 1, 2026, NULL, NULL),
(828, 858, 26, 1, 2026, NULL, NULL),
(829, 859, 26, 1, 2026, NULL, NULL),
(830, 860, 26, 1, 2026, NULL, NULL),
(831, 861, 26, 1, 2026, NULL, NULL),
(832, 862, 26, 1, 2026, NULL, NULL),
(833, 863, 26, 1, 2026, NULL, NULL),
(834, 864, 26, 1, 2026, NULL, NULL),
(835, 865, 26, 1, 2026, NULL, NULL),
(836, 866, 26, 1, 2026, NULL, NULL),
(837, 867, 26, 1, 2026, NULL, NULL),
(838, 868, 26, 1, 2026, NULL, NULL),
(839, 869, 26, 1, 2026, NULL, NULL),
(840, 870, 26, 1, 2026, NULL, NULL),
(841, 871, 27, 1, 2026, NULL, NULL),
(842, 872, 27, 1, 2026, NULL, NULL),
(843, 873, 27, 1, 2026, NULL, NULL),
(844, 874, 27, 1, 2026, NULL, NULL),
(845, 875, 27, 1, 2026, NULL, NULL),
(846, 876, 27, 1, 2026, NULL, NULL),
(847, 877, 27, 1, 2026, NULL, NULL),
(848, 878, 27, 1, 2026, NULL, NULL),
(849, 879, 27, 1, 2026, NULL, NULL),
(850, 880, 27, 1, 2026, NULL, NULL),
(851, 881, 27, 1, 2026, NULL, NULL),
(852, 882, 27, 1, 2026, NULL, NULL),
(853, 883, 27, 1, 2026, NULL, NULL),
(854, 884, 27, 1, 2026, NULL, NULL),
(855, 885, 27, 1, 2026, NULL, NULL),
(856, 886, 27, 1, 2026, NULL, NULL),
(857, 887, 27, 1, 2026, NULL, NULL),
(858, 888, 27, 1, 2026, NULL, NULL),
(859, 889, 27, 1, 2026, NULL, NULL),
(860, 890, 27, 1, 2026, NULL, NULL),
(861, 891, 27, 1, 2026, NULL, NULL),
(862, 892, 27, 1, 2026, NULL, NULL),
(863, 893, 27, 1, 2026, NULL, NULL),
(864, 894, 27, 1, 2026, NULL, NULL),
(865, 895, 27, 1, 2026, NULL, NULL),
(866, 896, 27, 1, 2026, NULL, NULL),
(867, 897, 27, 1, 2026, NULL, NULL),
(868, 898, 27, 1, 2026, NULL, NULL),
(869, 899, 27, 1, 2026, NULL, NULL),
(870, 900, 27, 1, 2026, NULL, NULL),
(871, 901, 27, 1, 2026, NULL, NULL),
(872, 902, 27, 1, 2026, NULL, NULL),
(873, 903, 28, 1, 2026, NULL, NULL),
(874, 904, 28, 1, 2026, NULL, NULL),
(875, 905, 28, 1, 2026, NULL, NULL),
(876, 906, 28, 1, 2026, NULL, NULL),
(877, 908, 28, 1, 2026, NULL, NULL),
(878, 909, 28, 1, 2026, NULL, NULL),
(879, 910, 28, 1, 2026, NULL, NULL),
(880, 911, 28, 1, 2026, NULL, NULL),
(881, 912, 28, 1, 2026, NULL, NULL),
(882, 913, 28, 1, 2026, NULL, NULL),
(883, 914, 28, 1, 2026, NULL, NULL),
(884, 915, 28, 1, 2026, NULL, NULL),
(885, 916, 28, 1, 2026, NULL, NULL),
(886, 917, 28, 1, 2026, NULL, NULL),
(887, 918, 28, 1, 2026, NULL, NULL),
(888, 919, 28, 1, 2026, NULL, NULL),
(889, 920, 28, 1, 2026, NULL, NULL),
(890, 921, 28, 1, 2026, NULL, NULL),
(891, 922, 28, 1, 2026, NULL, NULL),
(892, 923, 28, 1, 2026, NULL, NULL),
(893, 924, 28, 1, 2026, NULL, NULL),
(894, 925, 28, 1, 2026, NULL, NULL),
(895, 926, 28, 1, 2026, NULL, NULL),
(896, 927, 28, 1, 2026, NULL, NULL),
(897, 928, 28, 1, 2026, NULL, NULL),
(898, 929, 28, 1, 2026, NULL, NULL),
(899, 930, 28, 1, 2026, NULL, NULL),
(900, 931, 28, 1, 2026, NULL, NULL),
(901, 932, 28, 1, 2026, NULL, NULL),
(902, 933, 28, 1, 2026, NULL, NULL),
(903, 934, 28, 1, 2026, NULL, NULL),
(904, 935, 28, 1, 2026, NULL, NULL),
(905, 936, 28, 1, 2026, NULL, NULL),
(906, 937, 28, 1, 2026, NULL, NULL),
(907, 935, 29, 1, 2026, NULL, NULL),
(908, 936, 29, 1, 2026, NULL, NULL),
(909, 937, 29, 1, 2026, NULL, NULL),
(910, 938, 29, 1, 2026, NULL, NULL),
(911, 939, 29, 1, 2026, NULL, NULL),
(912, 940, 29, 1, 2026, NULL, NULL),
(913, 941, 29, 1, 2026, NULL, NULL),
(914, 942, 29, 1, 2026, NULL, NULL),
(915, 943, 29, 1, 2026, NULL, NULL),
(916, 944, 29, 1, 2026, NULL, NULL),
(917, 945, 29, 1, 2026, NULL, NULL),
(918, 946, 29, 1, 2026, NULL, NULL),
(919, 947, 29, 1, 2026, NULL, NULL),
(920, 948, 29, 1, 2026, NULL, NULL),
(921, 949, 29, 1, 2026, NULL, NULL),
(922, 950, 29, 1, 2026, NULL, NULL),
(923, 951, 29, 1, 2026, NULL, NULL),
(924, 952, 29, 1, 2026, NULL, NULL),
(925, 953, 29, 1, 2026, NULL, NULL),
(926, 954, 29, 1, 2026, NULL, NULL),
(927, 955, 29, 1, 2026, NULL, NULL),
(928, 956, 29, 1, 2026, NULL, NULL),
(929, 957, 29, 1, 2026, NULL, NULL),
(930, 958, 29, 1, 2026, NULL, NULL),
(931, 959, 29, 1, 2026, NULL, NULL),
(932, 960, 29, 1, 2026, NULL, NULL),
(933, 961, 29, 1, 2026, NULL, NULL),
(934, 962, 29, 1, 2026, NULL, NULL),
(935, 963, 29, 1, 2026, NULL, NULL),
(936, 964, 29, 1, 2026, NULL, NULL),
(937, 965, 29, 1, 2026, NULL, NULL),
(938, 966, 29, 1, 2026, NULL, NULL),
(939, 967, 30, 1, 2026, NULL, NULL),
(940, 968, 30, 1, 2026, NULL, NULL),
(941, 969, 30, 1, 2026, NULL, NULL),
(942, 970, 30, 1, 2026, NULL, NULL),
(943, 971, 30, 1, 2026, NULL, NULL),
(944, 972, 30, 1, 2026, NULL, NULL),
(945, 973, 30, 1, 2026, NULL, NULL),
(946, 974, 30, 1, 2026, NULL, NULL),
(947, 975, 30, 1, 2026, NULL, NULL),
(948, 976, 30, 1, 2026, NULL, NULL),
(949, 977, 30, 1, 2026, NULL, NULL),
(950, 978, 30, 1, 2026, NULL, NULL),
(951, 979, 30, 1, 2026, NULL, NULL),
(952, 980, 30, 1, 2026, NULL, NULL),
(953, 981, 30, 1, 2026, NULL, NULL),
(954, 982, 30, 1, 2026, NULL, NULL),
(955, 983, 30, 1, 2026, NULL, NULL),
(956, 984, 30, 1, 2026, NULL, NULL),
(957, 985, 30, 1, 2026, NULL, NULL),
(958, 986, 30, 1, 2026, NULL, NULL),
(959, 987, 30, 1, 2026, NULL, NULL),
(960, 988, 30, 1, 2026, NULL, NULL),
(961, 989, 30, 1, 2026, NULL, NULL),
(962, 990, 30, 1, 2026, NULL, NULL),
(963, 991, 30, 1, 2026, NULL, NULL),
(964, 992, 30, 1, 2026, NULL, NULL),
(965, 993, 30, 1, 2026, NULL, NULL),
(966, 994, 30, 1, 2026, NULL, NULL),
(967, 995, 30, 1, 2026, NULL, NULL),
(968, 996, 30, 1, 2026, NULL, NULL),
(969, 998, 30, 1, 2026, NULL, NULL),
(970, 997, 30, 1, 2026, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tst_kehadiran`
--

CREATE TABLE `tst_kehadiran` (
  `id_kehadiran` bigint(20) UNSIGNED NOT NULL,
  `id_grouping` bigint(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('S','I','A') NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tst_pelanggaran`
--

CREATE TABLE `tst_pelanggaran` (
  `id_pelanggaran` bigint(20) UNSIGNED NOT NULL,
  `id_hukdis` bigint(20) NOT NULL,
  `id_grouping` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sistem', 'admin@example.com', NULL, '$2y$10$67P0K4aBSAQQGv/m7hnA7uDjL9Q4/42Pl/9dTtXNC1tZp16Fu9gfC', NULL, '2026-08-14 02:20:06', '2026-08-14 02:20:06'),
(2, 'Bapak Guru Piket', 'piket@example.com', NULL, '$2y$10$J4aTOleqioycqF2IpZ9o1uaOqNbc/y17PuCyyZh4N4TN3p.EuyW7m', NULL, '2026-08-14 02:20:06', '2026-08-14 02:20:06'),
(3, 'Ibu Wali Kelas', 'walikelas@example.com', NULL, '$2y$10$i1Il7w5J4aRHnAD1StB0Y.2McMOWd5/oq.DK2wWDm2qqv9ix1H116', NULL, '2026-08-14 02:20:07', '2026-08-14 02:20:07'),
(4, 'Bapak Guru Mapel', 'gurumapel@example.com', NULL, '$2y$10$1DZZw7w/4tr36xcn7YjZ6uOqcavpxaBdylyXFSbvq/iBSjoOdIrr2', NULL, '2026-08-14 02:20:07', '2026-08-14 02:20:07'),
(5, 'Siswa Teladan', 'siswa@example.com', NULL, '$2y$10$6m4cRCsW3XoMbsZ0B1F2xeHnPNVKWpraklEPJG5WflenlnSb2erZq', NULL, '2026-08-14 02:20:07', '2026-08-14 02:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `walikelas`
--

CREATE TABLE `walikelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`menu_id`,`role_id`),
  ADD KEY `menu_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mst_hukdis`
--
ALTER TABLE `mst_hukdis`
  ADD PRIMARY KEY (`id_hukdis`);

--
-- Indexes for table `mst_kelas`
--
ALTER TABLE `mst_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mst_siswa`
--
ALTER TABLE `mst_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `mst_tahun`
--
ALTER TABLE `mst_tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tst_grouping`
--
ALTER TABLE `tst_grouping`
  ADD PRIMARY KEY (`id_grouping`);

--
-- Indexes for table `tst_kehadiran`
--
ALTER TABLE `tst_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indexes for table `tst_pelanggaran`
--
ALTER TABLE `tst_pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `walikelas`
--
ALTER TABLE `walikelas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mst_hukdis`
--
ALTER TABLE `mst_hukdis`
  MODIFY `id_hukdis` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_kelas`
--
ALTER TABLE `mst_kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `mst_siswa`
--
ALTER TABLE `mst_siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_tahun`
--
ALTER TABLE `mst_tahun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `tst_grouping`
--
ALTER TABLE `tst_grouping`
  MODIFY `id_grouping` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=971;

--
-- AUTO_INCREMENT for table `tst_kehadiran`
--
ALTER TABLE `tst_kehadiran`
  MODIFY `id_kehadiran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tst_pelanggaran`
--
ALTER TABLE `tst_pelanggaran`
  MODIFY `id_pelanggaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `walikelas`
--
ALTER TABLE `walikelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
