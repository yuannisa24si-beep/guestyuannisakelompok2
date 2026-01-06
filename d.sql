-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for project_kel2
CREATE DATABASE IF NOT EXISTS `project_kel2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `project_kel2`;

-- Dumping structure for table project_kel2.anggota_lembaga
CREATE TABLE IF NOT EXISTS `anggota_lembaga` (
  `anggota_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lembaga_id` bigint unsigned NOT NULL,
  `warga_id` bigint unsigned NOT NULL,
  `jabatan_id` bigint unsigned DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`anggota_id`),
  KEY `anggota_lembaga_warga_id_foreign` (`warga_id`),
  KEY `anggota_lembaga_jabatan_id_foreign` (`jabatan_id`),
  KEY `anggota_lembaga_lembaga_id_warga_id_tgl_mulai_tgl_selesai_index` (`lembaga_id`,`warga_id`,`tgl_mulai`,`tgl_selesai`),
  CONSTRAINT `anggota_lembaga_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `anggota_lembaga_lembaga_id_foreign` FOREIGN KEY (`lembaga_id`) REFERENCES `lembaga_desa` (`lembaga_id`) ON DELETE CASCADE,
  CONSTRAINT `anggota_lembaga_warga_id_foreign` FOREIGN KEY (`warga_id`) REFERENCES `wargas` (`warga_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.anggota_lembaga: ~2 rows (approximately)
INSERT INTO `anggota_lembaga` (`anggota_id`, `lembaga_id`, `warga_id`, `jabatan_id`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '2024-01-01', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(2, 16, 30, 16, '2025-12-17', NULL, '2025-12-16 17:29:48', '2025-12-16 17:30:03');

-- Dumping structure for table project_kel2.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.cache: ~0 rows (approximately)

-- Dumping structure for table project_kel2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.cache_locks: ~0 rows (approximately)

-- Dumping structure for table project_kel2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table project_kel2.jabatans
CREATE TABLE IF NOT EXISTS `jabatans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lembaga_id` bigint unsigned NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jabatans_lembaga_id_foreign` (`lembaga_id`),
  CONSTRAINT `jabatans_lembaga_id_foreign` FOREIGN KEY (`lembaga_id`) REFERENCES `lembaga_desa` (`lembaga_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.jabatans: ~20 rows (approximately)
INSERT INTO `jabatans` (`id`, `lembaga_id`, `nama_jabatan`, `level`, `created_at`, `updated_at`) VALUES
	(1, 19, 'Kepala Desa', 'Manager', '2025-12-15 02:02:29', '2025-12-15 02:11:52'),
	(2, 17, 'Sekretaris Desa', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(3, 13, 'Kepala Urusan Pemerintahan', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(4, 8, 'Kepala Urusan Pembangunan', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(5, 19, 'Kepala Urusan Kesejahteraan Rakyat', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(6, 11, 'Kepala Urusan Keuangan', 'Staff', '2025-12-15 02:02:29', '2025-12-15 02:56:01'),
	(7, 3, 'Kepala Urusan Umum', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(8, 19, 'Kepala Dusun I', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(9, 5, 'Kepala Dusun II', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(10, 1, 'Kepala Dusun III', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(11, 9, 'Ketua BPD', 'Tinggi', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(12, 10, 'Wakil Ketua BPD', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(13, 17, 'Sekretaris BPD', 'Rendah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(14, 6, 'Ketua LPM', 'Tinggi', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(15, 11, 'Ketua PKK', 'Tinggi', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(16, 20, 'Ketua Karang Taruna', 'Tinggi', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(17, 15, 'Ketua RT 001', 'Rendah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(18, 2, 'Ketua RT 002', 'Rendah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(19, 9, 'Ketua RW 001', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(20, 7, 'Ketua RW 002', 'Menengah', '2025-12-15 02:02:29', '2025-12-15 02:02:29');

-- Dumping structure for table project_kel2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.jobs: ~0 rows (approximately)

-- Dumping structure for table project_kel2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.job_batches: ~0 rows (approximately)

-- Dumping structure for table project_kel2.lembaga_desa
CREATE TABLE IF NOT EXISTS `lembaga_desa` (
  `lembaga_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_lembaga` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lembaga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.lembaga_desa: ~20 rows (approximately)
INSERT INTO `lembaga_desa` (`lembaga_id`, `nama_lembaga`, `deskripsi`, `kontak`, `created_at`, `updated_at`) VALUES
	(1, 'Badan Permusyawaratan Desa (BPD)', 'Lembaga yang menampung dan menyalurkan aspirasi masyarakat desa serta melakukan pengawasan terhadap penyelenggaraan pemerintahan desa.', '081234567890', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(2, 'Lembaga Pemberdayaan Masyarakat (LPM)', 'Lembaga yang bertugas menyusun rencana pembangunan secara partisipatif, menggerakkan swadaya gotong royong masyarakat.', '081234567891', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(3, 'Pemberdayaan Kesejahteraan Keluarga (PKK)', 'Organisasi kemasyarakatan yang memberdayakan perempuan untuk turut berpartisipasi dalam pembangunan Indonesia.', '081234567892', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(4, 'Karang Taruna', 'Organisasi sosial kemasyarakatan sebagai wadah dan sarana pengembangan setiap anggota masyarakat yang tumbuh atas dasar kesadaran.', '081234567893', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(5, 'Rukun Tetangga (RT)', 'Organisasi masyarakat yang diakui dan dibina oleh pemerintah untuk memelihara dan melestarikan nilai-nilai kehidupan masyarakat.', '081234567894', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(6, 'Rukun Warga (RW)', 'Lembaga yang dibentuk oleh masyarakat melalui musyawarah masyarakat setempat dalam rangka pelayanan pemerintahan.', '081234567895', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(7, 'Pos Pelayanan Terpadu (Posyandu)', 'Salah satu bentuk Upaya Kesehatan Bersumber Daya Masyarakat (UKBM) yang dikelola dan diselenggarakan dari, oleh, untuk dan bersama masyarakat.', '081234567896', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(8, 'Kelompok Tani', 'Kumpulan petani/peternak/pekebun yang dibentuk atas dasar kesamaan kepentingan, kesamaan kondisi lingkungan sosial, ekonomi, sumberdaya.', '081234567897', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(9, 'Lembaga Adat', 'Organisasi kemasyarakatan baik yang sengaja dibentuk maupun yang secara wajar telah tumbuh dan berkembang di dalam sejarah masyarakat.', '081234567898', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(10, 'Kelompok Usaha Bersama (KUBE)', 'Himpunan keluarga miskin yang dibentuk, tumbuh, dan berkembang atas prakarsanya sendiri berdasarkan azas kesetiakawanan.', '081234567899', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(11, 'Tim Penggerak PKK Desa', 'Tim yang bertugas menggerakkan dan membina kegiatan PKK di tingkat desa untuk meningkatkan kesejahteraan keluarga.', '081234567800', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(12, 'Koperasi Desa', 'Badan usaha yang beranggotakan orang-seorang atau badan hukum koperasi dengan melandaskan kegiatannya berdasarkan prinsip koperasi.', '081234567801', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(13, 'Kelompok Sadar Wisata (Pokdarwis)', 'Kelompok dari masyarakat yang peduli dan bertanggung jawab serta berperan sebagai penggerak dalam mendukung terciptanya iklim kondusif.', '081234567802', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(14, 'Forum Anak Desa', 'Wadah partisipasi anak di tingkat desa yang dibentuk untuk menyuarakan kepentingan terbaik bagi anak.', '081234567803', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(15, 'Kelompok Informasi Masyarakat (KIM)', 'Lembaga atau kelompok yang dibentuk dari, oleh, dan untuk masyarakat secara mandiri dan kreatif.', '081234567804', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(16, 'Badan Usaha Milik Desa (BUMDes)', 'Badan usaha yang seluruh atau sebagian besar modalnya dimiliki oleh desa melalui penyertaan secara langsung.', '081234567805', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(17, 'Kelompok Wanita Tani (KWT)', 'Kumpulan ibu-ibu tani yang tergabung dalam suatu kelompok untuk melakukan kegiatan pertanian bersama.', '081234567806', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(18, 'Lembaga Keswadayaan Masyarakat (LKM)', 'Lembaga yang dibentuk atas prakarsa masyarakat sebagai mitra pemerintah desa dalam memberdayakan masyarakat.', '081234567807', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(19, 'Kelompok Siaga Bencana', 'Kelompok masyarakat yang dibentuk untuk meningkatkan kesiapsiagaan dalam menghadapi bencana alam.', '081234567808', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(20, 'Organisasi Kepemudaan Desa', 'Wadah pengembangan generasi muda yang tumbuh dan berkembang atas dasar kesadaran dan tanggung jawab sosial.', '081234567809', '2025-12-15 02:02:29', '2025-12-15 02:02:29');

-- Dumping structure for table project_kel2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.migrations: ~16 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_11_12_003453_table_lembaga_desas', 1),
	(5, '2025_11_12_004908_create_wargas_table', 1),
	(6, '2025_11_14_190427_create_jabatans_table', 1),
	(7, '2025_11_14_190609_add_foreign_key_to_jabatans_table', 1),
	(8, '2025_11_26_010000_add_foto_profil_to_wargas_table', 1),
	(9, '2025_11_26_020000_create_warga_files_table', 1),
	(10, '2025_11_27_000000_add_role_to_users_table', 1),
	(11, '2025_12_04_create_perangkat_desa_table', 1),
	(12, '2025_12_07_000000_modify_telp_column_in_wargas_table', 1),
	(13, '2025_12_07_add_unique_constraints_to_perangkat_desa', 1),
	(14, '2025_12_10_000001_create_rw_table', 1),
	(15, '2025_12_10_000002_create_rt_table', 1),
	(16, '2025_12_10_000003_create_anggota_lembaga_table', 1);

-- Dumping structure for table project_kel2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table project_kel2.perangkat_desa
CREATE TABLE IF NOT EXISTS `perangkat_desa` (
  `perangkat_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warga_id` bigint unsigned NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periode_mulai` date NOT NULL,
  `periode_selesai` date DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`perangkat_id`),
  UNIQUE KEY `perangkat_desa_nip_unique` (`nip`),
  UNIQUE KEY `perangkat_desa_kontak_unique` (`kontak`),
  KEY `perangkat_desa_warga_id_foreign` (`warga_id`),
  CONSTRAINT `perangkat_desa_warga_id_foreign` FOREIGN KEY (`warga_id`) REFERENCES `wargas` (`warga_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.perangkat_desa: ~20 rows (approximately)
INSERT INTO `perangkat_desa` (`perangkat_id`, `warga_id`, `jabatan`, `nip`, `kontak`, `periode_mulai`, `periode_selesai`, `foto`, `created_at`, `updated_at`) VALUES
	(1, 91, 'Ketua RW 002', '9135688350', '956.464.8172', '2024-09-21', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(2, 92, 'Ketua LPM', NULL, '(806) 947-1996', '2023-10-05', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(3, 71, 'Kepala Urusan Pembangunan', '6719654814', '+1 (409) 293-8563', '2022-10-20', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(4, 53, 'Kepala Dusun II', '8383785924', '+1 (810) 856-1385', '2022-02-04', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(5, 71, 'Ketua BPD', '0126181003', '930.325.1455', '2021-09-18', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(6, 56, 'Kepala Urusan Kesejahteraan Rakyat', '5629020354', '(951) 885-9259', '2023-09-21', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(7, 15, 'Sekretaris Desa', '0273859063', '1-765-200-9847', '2021-03-16', '2026-04-07', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(8, 89, 'Ketua RT 002', '1382114954', '+1 (562) 785-3085', '2023-01-19', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(9, 80, 'Ketua RT 001', '9287088024', NULL, '2023-03-03', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(10, 85, 'Ketua PKK', NULL, NULL, '2022-04-04', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(11, 78, 'Sekretaris BPD', NULL, '+1-240-687-0917', '2021-10-19', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(12, 95, 'Kepala Desa', NULL, '(762) 528-5659', '2022-10-02', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(13, 97, 'Ketua RW 002', '7030063205', '747.207.7105', '2024-06-23', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(14, 38, 'Sekretaris BPD', '3628011677', NULL, '2024-12-02', '2027-06-05', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(15, 7, 'Ketua LPM', '0599647177', '+1-832-401-7670', '2024-06-08', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(16, 32, 'Sekretaris Desa', '7153784856', '838.349.9248', '2024-09-24', NULL, NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(17, 12, 'Sekretaris BPD', '8973479', '314.252.0499', '2023-12-25', NULL, NULL, '2025-12-15 02:02:29', '2025-12-16 17:28:21'),
	(18, 53, 'Kepala Urusan Umum', '983347', '(820) 620-6999', '2021-10-09', '2027-04-10', 'perangkat_foto/j84NAeCGCVLl8LGoYfLs6WCc4fhG5VBRHVawKqdy.jpg', '2025-12-15 02:02:29', '2025-12-16 17:27:55'),
	(19, 62, 'Ketua PKK', '8374786', '+1-606-950-7471', '2023-02-14', NULL, 'perangkat_foto/iCKxFLVfUPZ9opNAhM8TFs3VM3cXH8aeivzgQyt2.jpg', '2025-12-15 02:02:29', '2025-12-16 17:27:43'),
	(20, 49, 'Kepala Desa', '2692194344', NULL, '2021-06-15', NULL, 'perangkat_foto/LTulIR5nwLm0qWwbMLuWoSvzI75PRl7lfX6T9QtG.jpg', '2025-12-15 02:02:29', '2025-12-16 17:15:13');

-- Dumping structure for table project_kel2.rt
CREATE TABLE IF NOT EXISTS `rt` (
  `rt_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rw_id` bigint unsigned NOT NULL,
  `nomor_rt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua_rt_warga_id` bigint unsigned DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rt_id`),
  UNIQUE KEY `rt_rw_id_nomor_rt_unique` (`rw_id`,`nomor_rt`),
  KEY `rt_ketua_rt_warga_id_foreign` (`ketua_rt_warga_id`),
  CONSTRAINT `rt_ketua_rt_warga_id_foreign` FOREIGN KEY (`ketua_rt_warga_id`) REFERENCES `wargas` (`warga_id`) ON DELETE SET NULL,
  CONSTRAINT `rt_rw_id_foreign` FOREIGN KEY (`rw_id`) REFERENCES `rw` (`rw_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.rt: ~20 rows (approximately)
INSERT INTO `rt` (`rt_id`, `rw_id`, `nomor_rt`, `ketua_rt_warga_id`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 1, '001', 24, 'RT 001 RW 001 - RW 001 Desa Maju - Jl. Merdeka No. 1-50', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(2, 2, '002', 84, 'RT 002 RW 002 - RW 002 Desa Maju - Jl. Proklamasi No. 51-100', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(3, 3, '003', 64, 'RT 003 RW 003 - RW 003 Desa Maju - Jl. Pancasila No. 101-150', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(4, 4, '004', 94, 'RT 004 RW 004 - RW 004 Desa Maju - Jl. Garuda No. 151-200', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(5, 5, '005', 19, 'RT 005 RW 005 - RW 005 Desa Maju - Jl. Diponegoro No. 201-250', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(6, 6, '006', 6, 'RT 006 RW 006 - RW 006 Desa Sejahtera - Jl. Sudirman No. 1-40', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(7, 7, '007', 67, 'RT 007 RW 007 - RW 007 Desa Sejahtera - Jl. Thamrin No. 41-80', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(8, 8, '008', 13, 'RT 008 RW 008 - RW 008 Desa Sejahtera - Jl. Kartini No. 81-120', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(9, 9, '009', 51, 'RT 009 RW 009 - RW 009 Desa Makmur - Jl. Pahlawan No. 1-60', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(10, 10, '010', 36, 'RT 010 RW 010 - RW 010 Desa Makmur - Jl. Veteran No. 61-120', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(11, 11, '011', 61, 'RT 011 RW 011 - RW 011 Desa Damai - Jl. Melati No. 1-45', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(12, 12, '012', 24, 'RT 012 RW 012 - RW 012 Desa Damai - Jl. Mawar No. 46-90', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(13, 13, '013', 99, 'RT 013 RW 013 - RW 013 Desa Harmoni - Jl. Anggrek No. 1-50', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(14, 14, '014', 67, 'RT 014 RW 014 - RW 014 Desa Harmoni - Jl. Kenanga No. 51-100', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(15, 15, '015', 15, 'RT 015 RW 015 - RW 015 Desa Bahagia - Jl. Cempaka No. 1-40', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(16, 16, '016', 5, 'RT 016 RW 016 - RW 016 Desa Bahagia - Jl. Dahlia No. 41-80', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(17, 17, '017', 31, 'RT 017 RW 017 - RW 017 Desa Sentosa - Jl. Flamboyan No. 1-55', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(18, 18, '018', 40, 'RT 018 RW 018 - RW 018 Desa Sentosa - Jl. Bougenville No. 56-110', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(19, 19, '019', 14, 'RT 019 RW 019 - RW 019 Desa Indah - Jl. Sakura No. 1-65', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(20, 20, '020', 30, 'RT 020 RW 020 - RW 020 Desa Indah - Jl. Tulip No. 66-130', '2025-12-15 02:02:29', '2025-12-15 02:02:29');

-- Dumping structure for table project_kel2.rw
CREATE TABLE IF NOT EXISTS `rw` (
  `rw_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_rw` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua_rw_warga_id` bigint unsigned DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rw_id`),
  UNIQUE KEY `rw_nomor_rw_unique` (`nomor_rw`),
  KEY `rw_ketua_rw_warga_id_foreign` (`ketua_rw_warga_id`),
  CONSTRAINT `rw_ketua_rw_warga_id_foreign` FOREIGN KEY (`ketua_rw_warga_id`) REFERENCES `wargas` (`warga_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.rw: ~20 rows (approximately)
INSERT INTO `rw` (`rw_id`, `nomor_rw`, `ketua_rw_warga_id`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, '001', 1, 'RW 001 Desa Maju - Jl. Merdeka No. 1-50', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(2, '002', 2, 'RW 002 Desa Maju - Jl. Proklamasi No. 51-100', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(3, '003', 3, 'RW 003 Desa Maju - Jl. Pancasila No. 101-150', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(4, '004', 4, 'RW 004 Desa Maju - Jl. Garuda No. 151-200', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(5, '005', 5, 'RW 005 Desa Maju - Jl. Diponegoro No. 201-250', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(6, '006', 6, 'RW 006 Desa Sejahtera - Jl. Sudirman No. 1-40', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(7, '007', 7, 'RW 007 Desa Sejahtera - Jl. Thamrin No. 41-80', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(8, '008', 8, 'RW 008 Desa Sejahtera - Jl. Kartini No. 81-120', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(9, '009', 9, 'RW 009 Desa Makmur - Jl. Pahlawan No. 1-60', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(10, '010', 10, 'RW 010 Desa Makmur - Jl. Veteran No. 61-120', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(11, '011', 11, 'RW 011 Desa Damai - Jl. Melati No. 1-45', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(12, '012', 12, 'RW 012 Desa Damai - Jl. Mawar No. 46-90', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(13, '013', 13, 'RW 013 Desa Harmoni - Jl. Anggrek No. 1-50', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(14, '014', 14, 'RW 014 Desa Harmoni - Jl. Kenanga No. 51-100', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(15, '015', 15, 'RW 015 Desa Bahagia - Jl. Cempaka No. 1-40', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(16, '016', 16, 'RW 016 Desa Bahagia - Jl. Dahlia No. 41-80', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(17, '017', 17, 'RW 017 Desa Sentosa - Jl. Flamboyan No. 1-55', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(18, '018', 18, 'RW 018 Desa Sentosa - Jl. Bougenville No. 56-110', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(19, '019', 19, 'RW 019 Desa Indah - Jl. Sakura No. 1-65', '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(20, '020', 20, 'RW 020 Desa Indah - Jl. Tulip No. 66-130', '2025-12-15 02:02:29', '2025-12-15 02:02:29');

-- Dumping structure for table project_kel2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('pb8Xanl22AI4teUdyfnjQCLU11SD1Z8yuRTJxRkO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Avast/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieXN2VXFjNGJJRGNLR2pHejY0ZTJrRGF4ZE5xNml6R3dwcVhqbFViUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZW1iYWdhIjtzOjU6InJvdXRlIjtzOjEzOiJsZW1iYWdhLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1767686543);

-- Dumping structure for table project_kel2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pelanggan',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'alea@gmail.com', NULL, '$2y$12$wrHG44MFgt2zxhpVz6wo3uqrLWSNUI5XscEeRRqyUHC1yEDMrcnIy', 'Admin', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29');

-- Dumping structure for table project_kel2.wargas
CREATE TABLE IF NOT EXISTS `wargas` (
  `warga_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_ktp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`warga_id`),
  UNIQUE KEY `wargas_no_ktp_unique` (`no_ktp`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.wargas: ~100 rows (approximately)
INSERT INTO `wargas` (`warga_id`, `no_ktp`, `nama`, `jenis_kelamin`, `agama`, `pekerjaan`, `telp`, `email`, `foto_profil_path`, `created_at`, `updated_at`) VALUES
	(1, '9593296766170728', 'Wisnu Hidayanto', 'P', 'Hindu', 'Pramugari', '0993 7503 356', 'suryono.fathonah@example.net', 'warga/profiles/UjiToqNBCO4vpNbaEGobOdMOqkVjJlxOekxkiULz.jpg', '2025-12-15 02:02:29', '2025-12-16 04:00:34'),
	(2, '2959546836423331', 'Darsirah Simbolon', 'P', 'Konghucu', 'Imam Masjid', '0983 4759 972', 'siti.handayani@example.net', 'warga/profiles/nXMfWqGuQoY8w0AkgUcXIoftf5UZfn1CWvkr7qNh.jpg', '2025-12-15 02:02:29', '2025-12-16 06:18:34'),
	(3, '7571004978926977', 'Latika Ratna Lailasari S.Ked', 'L', 'Islam', 'Wartawan', '0835 8237 245', 'ppradipta@example.net', 'warga/profiles/tsnxrmVVNrrbeHscSipCEoFosMh2nmje1INdDUXp.jpg', '2025-12-15 02:02:29', '2025-12-16 17:14:56'),
	(4, '4866142554102895', 'Yulia Namaga', 'L', 'Islam', 'Penata Busana', '(+62) 483 3537 8662', 'gandewa97@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(5, '9916729529681274', 'Candra Ozy Prasasta M.M.', 'L', 'Konghucu', 'Tabib', '0734 7961 904', 'ella.prasetyo@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(6, '1427067642000793', 'Omar Martani Simanjuntak S.E.', 'P', 'Budha', 'Promotor Acara', '(+62) 363 2189 186', 'zanggraini@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(7, '9062190916764352', 'Wirda Cici Utami', 'L', 'Hindu', 'Industri', '0426 5797 7801', 'osuartini@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(8, '7499217119250096', 'Devi Malika Nasyiah', 'L', 'Katolik', 'Paraji', '0783 0924 291', 'raina46@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(9, '4597045886428537', 'Oliva Maryati', 'L', 'Budha', 'Pemandu Wisata', '(+62) 874 9163 797', 'intan07@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(10, '4128045346843319', 'Sakura Nasyiah S.I.Kom', 'L', 'Hindu', 'Wakil Presiden', '0235 3525 2376', 'hasna.wijayanti@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(11, '2809406726925601', 'Manah Mansur M.Farm', 'L', 'Kristen', 'Karyawan BUMD', '0833 599 099', 'sihotang.yuliana@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(12, '1777916081617826', 'Okto Samosir', 'P', 'Konghucu', 'Karyawan Honorer', '023 8773 3682', 'sagustina@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(13, '1127455152778303', 'Hasim Nashiruddin', 'P', 'Islam', 'Apoteker', '022 8294 0337', 'mursinin15@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(14, '7780437943049467', 'Yance Nasyiah S.Gz', 'L', 'Hindu', 'Programmer', '(+62) 559 1978 5695', 'lala.hartati@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(15, '6118199697070291', 'Estiono Budiman', 'L', 'Katolik', 'Penulis', '0315 5839 012', 'sihombing.ana@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(16, '6292107929541522', 'Elon Ihsan Salahudin S.Ked', 'P', 'Hindu', 'Masinis', '0653 2162 987', 'bella.padmasari@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(17, '3965899516972163', 'Rusman Dimas Nababan', 'P', 'Katolik', 'Perangkat Desa', '0349 0196 351', 'nugroho.bakiadi@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(18, '7003789340965278', 'Putri Prastuti', 'P', 'Budha', 'Imam Masjid', '0798 1958 6750', 'ositumorang@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(19, '1328640592984678', 'Karman Pratama', 'L', 'Katolik', 'Pialang', '(+62) 862 8493 2682', 'ywidiastuti@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(20, '0287866997763840', 'Yulia Uyainah', 'P', 'Hindu', 'Masinis', '0885 3767 788', 'manullang.fitriani@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(21, '1928501813541362', 'Rahayu Mandasari', 'L', 'Konghucu', 'Mengurus Rumah Tangga', '0906 4484 8359', 'gaman.winarsih@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(22, '1841579044755373', 'Betania Ida Widiastuti S.Pd', 'L', 'Hindu', 'Penyiar Radio', '(+62) 276 4757 573', 'yuni35@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(23, '6922168109070333', 'Saadat Mansur S.Pd', 'P', 'Budha', 'Buruh Peternakan', '0345 2364 742', 'belinda.pertiwi@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(24, '1617147897421998', 'Samiah Suryatmi', 'P', 'Katolik', 'Tukang Kayu', '0395 6579 4372', 'rizki.hassanah@example.com', 'warga/profiles/mAwyQrxf9Gw5T3KquFRaaVAhW6FrGuXAAMrnsjBg.jpg', '2025-12-15 02:02:29', '2025-12-16 17:16:13'),
	(25, '9046542081261579', 'Victoria Pratiwi', 'L', 'Islam', 'Peternak', '0678 1824 662', 'putri.sirait@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(26, '6518085515977603', 'Puti Prastuti S.Gz', 'P', 'Katolik', 'Pendeta', '020 4484 2460', 'csamosir@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(27, '8689186815294889', 'Parman Uwais M.TI.', 'P', 'Kristen', 'Tukang Las / Pandai Besi', '026 1804 112', 'amegantara@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(28, '5698729090117333', 'Genta Widiastuti M.Farm', 'L', 'Konghucu', 'Kondektur', '(+62) 887 2494 362', 'ilsa.wacana@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(29, '8581064707752351', 'Caturangga Ozy Permadi S.Gz', 'L', 'Budha', 'Akuntan', '0986 4791 429', 'yolanda.yessi@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(30, '3198575446966236', 'Cinta Yuliarti', 'L', 'Katolik', 'Masinis', '0729 3826 0601', 'winarno.imam@example.net', 'warga/profiles/QEQYZvbeDe28UAzriydCIoCnByIYR1nGC8ulkqys.jpg', '2025-12-15 02:02:29', '2025-12-16 17:30:55'),
	(31, '6613385773916592', 'Ani Jamalia Wulandari', 'P', 'Katolik', 'Pedagang', '(+62) 368 0846 430', 'ade97@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(32, '0800390846336102', 'Limar Utama S.E.I', 'P', 'Hindu', 'Penyiar Radio', '(+62) 572 0227 0934', 'zulkarnain.cinthia@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(33, '4644942645164955', 'Ophelia Padmasari', 'L', 'Islam', 'Peternak', '(+62) 226 8167 370', 'melani.oliva@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(34, '2934400505014841', 'Lasmanto Prakasa', 'P', 'Kristen', 'Karyawan Swasta', '(+62) 24 3983 169', 'gabriella.haryanti@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(35, '7037651266922558', 'Intan Winarsih', 'L', 'Konghucu', 'Buruh Tani / Perkebunan', '0569 0682 451', 'nasyidah.gangsar@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(36, '2529567131363874', 'Perkasa Harjasa Prakasa', 'L', 'Kristen', 'Nelayan / Perikanan', '(+62) 375 3391 211', 'jhardiansyah@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(37, '3049715867897850', 'Panca Sirait M.Farm', 'P', 'Budha', 'Penyelam', '(+62) 762 6286 966', 'firgantoro.emin@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(38, '5784934807950620', 'Zalindra Hamima Riyanti M.Ak', 'L', 'Konghucu', 'Tukang Listrik', '(+62) 269 4421 8726', 'hutasoit.pia@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(39, '8694820210430692', 'Maya Safitri', 'P', 'Kristen', 'Programmer', '0420 0306 8077', 'ophelia.yulianti@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(40, '9599813265143182', 'Zahra Rahayu', 'L', 'Katolik', 'Pilot', '022 5402 958', 'smulyani@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(41, '9716313712735067', 'Anastasia Nasyiah', 'L', 'Katolik', 'Pensiunan', '0792 2047 8734', 'fujiati.cahyadi@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(42, '4592550839299237', 'Danu Uda Kurniawan', 'L', 'Konghucu', 'Konstruksi', '0308 3408 4458', 'jaiman.wasita@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(43, '1686015494587866', 'Yoga Jaswadi Kusumo', 'P', 'Islam', 'Apoteker', '(+62) 293 7089 510', 'oandriani@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(44, '2946408170395217', 'Natalia Lintang Susanti S.Gz', 'L', 'Katolik', 'Penulis', '(+62) 847 0526 8450', 'fnovitasari@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(45, '3059788301882486', 'Irma Padmasari', 'P', 'Kristen', 'Tukang Listrik', '(+62) 836 3566 986', 'qnatsir@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(46, '3184205592279389', 'Yance Eva Mardhiyah M.Kom.', 'P', 'Islam', 'Kepala Desa', '0869 129 145', 'ratna.hidayat@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(47, '2243629881559439', 'Galur Latupono', 'L', 'Hindu', 'Karyawan BUMD', '(+62) 940 2917 558', 'lsiregar@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(48, '5098304992550181', 'Darmana Hutapea', 'L', 'Kristen', 'Tukang Listrik', '(+62) 222 8823 324', 'haryanti.kayla@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(49, '8261027963579384', 'Siti Padmasari', 'L', 'Konghucu', 'Perawat', '0844 6078 732', 'susada@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(50, '0725915730924603', 'Ina Nuraini', 'L', 'Kristen', 'Sopir', '0758 0521 434', 'juli.susanti@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(51, '6946375069869322', 'Damu Habibi', 'L', 'Islam', 'Nelayan / Perikanan', '(+62) 602 8162 8470', 'astuti.uli@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(52, '9127627261165027', 'Hasta Nashiruddin', 'P', 'Konghucu', 'Peneliti', '0321 7534 674', 'balangga04@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(53, '8364538173061311', 'Dadap Suwarno', 'P', 'Kristen', 'Masinis', '0424 7250 0561', 'gunawan.mila@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(54, '4271920836464472', 'Cindy Titi Haryanti S.H.', 'L', 'Budha', 'Kepala Desa', '0290 5627 4140', 'bala93@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(55, '3470124506236937', 'Cawisono Hardiansyah', 'L', 'Katolik', 'Mekanik', '024 4102 156', 'ohalimah@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(56, '6534733858861834', 'Rachel Prastuti S.T.', 'L', 'Katolik', 'Perancang Busana', '(+62) 986 4497 157', 'balijan75@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(57, '4609235839814109', 'Ajimin Nababan', 'L', 'Budha', 'Penambang', '022 2689 968', 'asmianto.wahyudin@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(58, '8342802839526085', 'Jelita Nuraini S.E.I', 'P', 'Hindu', 'Penerjemah', '(+62) 853 7816 7030', 'kadir22@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(59, '9829426190943627', 'Oni Humaira Laksita S.Pd', 'L', 'Islam', 'Penulis', '0459 8836 8650', 'lhardiansyah@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(60, '1775267896026851', 'Purwa Jailani', 'P', 'Konghucu', 'Montir', '(+62) 543 8621 398', 'gaiman24@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(61, '6985831897057272', 'Aisyah Hasna Winarsih S.Farm', 'L', 'Konghucu', 'Kondektur', '0245 2601 741', 'wprasetyo@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(62, '8754178673304177', 'Violet Rina Wijayanti', 'L', 'Islam', 'Juru Masak', '0592 3747 9643', 'hairyanto77@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(63, '5584056584597700', 'Puspa Hana Rahayu', 'P', 'Budha', 'Pramugari', '(+62) 255 4753 939', 'hartati.naradi@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(64, '1058349752507555', 'Kacung Mulya Dongoran S.Sos', 'P', 'Hindu', 'Karyawan BUMD', '(+62) 228 6864 0688', 'hidayanto.johan@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(65, '3203954420329439', 'Jarwa Suryono', 'L', 'Kristen', 'Arsitek', '(+62) 388 2557 5428', 'hutagalung.ghaliyati@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(66, '3986922663636542', 'Ridwan Oman Wibowo', 'P', 'Hindu', 'Presiden', '0569 4337 660', 'jarwi.mulyani@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(67, '6621710272857363', 'Rina Farida', 'P', 'Islam', 'Tabib', '0340 3240 994', 'hhandayani@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(68, '8692196684826089', 'Gatot Wacana S.E.', 'P', 'Kristen', 'Desainer', '(+62) 415 2259 1350', 'manullang.kalim@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(69, '8378246090007231', 'Jarwa Widodo', 'P', 'Islam', 'Akuntan', '(+62) 678 1805 159', 'hastuti.widya@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(70, '2705514008895981', 'Ina Puspasari S.I.Kom', 'P', 'Budha', 'Satpam', '029 1045 1625', 'galak21@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(71, '9770800754728152', 'Tugiman Mansur S.Pd', 'L', 'Hindu', 'Karyawan BUMD', '(+62) 22 6398 0721', 'natalia.wulandari@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(72, '5854790358929701', 'Restu Cinthia Permata S.Gz', 'P', 'Konghucu', 'Juru Masak', '(+62) 888 8823 8130', 'michelle90@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(73, '3077653209458958', 'Cemani Wijaya', 'P', 'Hindu', 'Pialang', '(+62) 514 6650 439', 'imam97@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(74, '1646390572595380', 'Gabriella Usamah', 'P', 'Konghucu', 'Kepolisian RI (POLRI)', '0627 8842 9007', 'oskar66@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(75, '5420144339984460', 'Lanang Purwanto Sirait', 'P', 'Katolik', 'Atlet', '0947 4474 1452', 'usinaga@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(76, '0873219337541420', 'Galih Habibi', 'L', 'Islam', 'Programmer', '0813 077 006', 'sakura.rajasa@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(77, '5228172982900973', 'Makuta Jailani S.Psi', 'L', 'Budha', 'Mekanik', '0508 5978 1241', 'cinthia.salahudin@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(78, '8355278204054866', 'Viktor Sihombing', 'P', 'Kristen', 'Juru Masak', '0461 2780 6300', 'nasyiah.gatra@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(79, '5045645725176861', 'Puti Hafshah Laksmiwati', 'P', 'Islam', 'Desainer', '0463 9033 133', 'jamalia02@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(80, '8007934850161450', 'Jaka Harsanto Putra', 'L', 'Islam', 'Montir', '(+62) 267 4739 7064', 'gandi.winarno@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(81, '6176622783180464', 'Zamira Safitri', 'L', 'Islam', 'Nelayan / Perikanan', '(+62) 709 0266 1080', 'alatupono@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(82, '5625070121949097', 'Lalita Laksmiwati', 'L', 'Budha', 'Tukang Cukur', '(+62) 26 8242 2261', 'kwastuti@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(83, '6186635091676990', 'Nurul Sari Astuti M.Farm', 'P', 'Konghucu', 'Satpam', '(+62) 979 0292 227', 'jati.tampubolon@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(84, '3420863522361593', 'Rahmi Winarsih', 'L', 'Hindu', 'Karyawan BUMD', '(+62) 28 2355 050', 'bpermadi@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(85, '6529702640565109', 'Latika Permata', 'P', 'Konghucu', 'Nelayan / Perikanan', '(+62) 739 2376 3603', 'wwinarno@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(86, '4428617933967453', 'Martani Latupono', 'P', 'Budha', 'Tukang Gigi', '(+62) 284 2032 7876', 'riyanti.kamaria@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(87, '8352427428692862', 'Ika Anggraini', 'L', 'Kristen', 'Montir', '0320 8884 4134', 'akarsana09@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(88, '7267674919937958', 'Tirta Wibisono M.M.', 'L', 'Islam', 'Tukang Sol Sepatu', '(+62) 739 6514 395', 'koko60@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(89, '4353524209447892', 'Digdaya Ajimat Damanik S.Farm', 'L', 'Budha', 'Kepala Desa', '(+62) 212 4207 7313', 'lailasari.padmi@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(90, '8928016182248139', 'Gandi Hutapea', 'P', 'Konghucu', 'Arsitek', '(+62) 687 3348 5894', 'gatra83@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(91, '2725432446822130', 'Laras Uyainah S.Psi', 'L', 'Budha', 'Dosen', '(+62) 880 2506 571', 'wnasyiah@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(92, '2575506868967652', 'Cengkal Sihombing', 'L', 'Hindu', 'Penerjemah', '(+62) 612 7393 345', 'budi10@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(93, '8743042792609917', 'Cakrawala Siregar S.T.', 'P', 'Konghucu', 'Nahkoda', '(+62) 379 4760 646', 'mardhiyah.kawaya@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(94, '1778692043261155', 'Laksana Firgantoro', 'L', 'Konghucu', 'Arsitek', '0318 8399 494', 'blailasari@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(95, '3615472227916470', 'Jamal Prasetyo', 'L', 'Islam', 'Penyiar Televisi', '0624 2316 2059', 'jane54@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(96, '2978822884985244', 'Ratna Sudiati S.T.', 'L', 'Katolik', 'Buruh Peternakan', '0585 5508 472', 'utama.rahayu@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(97, '7640595023022775', 'Kani Rini Puspita S.IP', 'P', 'Islam', 'Kondektur', '(+62) 637 2041 5898', 'glailasari@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(98, '0459311841830616', 'Cengkal Kuswoyo', 'L', 'Katolik', 'Mekanik', '(+62) 330 7683 7208', 'maria67@example.com', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(99, '4016379362564442', 'Prayoga Budiman', 'P', 'Islam', 'Wakil Presiden', '(+62) 807 736 807', 'epratiwi@example.org', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29'),
	(100, '3551152415160922', 'Farhunnisa Ella Rahmawati', 'P', 'Konghucu', 'Notaris', '(+62) 685 8305 652', 'latupono.sadina@example.net', NULL, '2025-12-15 02:02:29', '2025-12-15 02:02:29');

-- Dumping structure for table project_kel2.warga_files
CREATE TABLE IF NOT EXISTS `warga_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `warga_id` bigint unsigned NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint unsigned NOT NULL DEFAULT '0',
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warga_files_warga_id_foreign` (`warga_id`),
  CONSTRAINT `warga_files_warga_id_foreign` FOREIGN KEY (`warga_id`) REFERENCES `wargas` (`warga_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_kel2.warga_files: ~2 rows (approximately)
INSERT INTO `warga_files` (`id`, `warga_id`, `original_name`, `file_path`, `file_size`, `mime_type`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Fuggler (2).jpg', 'warga/files/nXAVQRJ0GUmTgBQCBHuAuTm4eydfJPKMFW4z343q.jpg', 107738, 'image/jpeg', '2025-12-16 17:14:56', '2025-12-16 17:14:56'),
	(2, 30, 'fuggler (1).jpg', 'warga/files/OZaTSsBERZL4o5RiiwwHzbJXZIZH33Fw3HYKY3rT.jpg', 73270, 'image/jpeg', '2025-12-16 17:30:55', '2025-12-16 17:30:55');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
