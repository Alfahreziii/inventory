# ************************************************************
# Sequel Ace SQL dump
# Version 20094
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 9.3.0)
# Database: inventory_db
# Generation Time: 2025-07-20 13:13:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bahanbakus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bahanbakus`;

CREATE TABLE `bahanbakus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tgl_kadaluarsa` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_bahan` bigint unsigned NOT NULL,
  `sisa` int NOT NULL,
  `harga_total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bahanbakus_id_bahan_foreign` (`id_bahan`),
  CONSTRAINT `bahanbakus_id_bahan_foreign` FOREIGN KEY (`id_bahan`) REFERENCES `namabahans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bahanbakus` WRITE;
/*!40000 ALTER TABLE `bahanbakus` DISABLE KEYS */;

INSERT INTO `bahanbakus` (`id`, `tgl_kadaluarsa`, `tgl_masuk`, `id_bahan`, `sisa`, `harga_total`, `created_at`, `updated_at`)
VALUES
	(5,'2025-07-07','2025-07-14',2,5,615615,'2025-07-20 18:05:18','2025-07-20 19:56:57'),
	(6,'2025-07-21','2025-07-21',2,8,984984,'2025-07-20 19:56:24','2025-07-20 19:56:24');

/*!40000 ALTER TABLE `bahanbakus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table eoqs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eoqs`;

CREATE TABLE `eoqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_bahan` bigint unsigned NOT NULL,
  `demand` int NOT NULL,
  `biaya_simpan` int NOT NULL,
  `biaya_pesan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eoqs_id_bahan_foreign` (`id_bahan`),
  CONSTRAINT `eoqs_id_bahan_foreign` FOREIGN KEY (`id_bahan`) REFERENCES `namabahans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `eoqs` WRITE;
/*!40000 ALTER TABLE `eoqs` DISABLE KEYS */;

INSERT INTO `eoqs` (`id`, `id_bahan`, `demand`, `biaya_simpan`, `biaya_pesan`, `created_at`, `updated_at`)
VALUES
	(2,2,5,12,12,'2025-07-20 19:22:44','2025-07-20 19:22:44');

/*!40000 ALTER TABLE `eoqs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
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



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(5,'2025_02_21_070507_create_namabahans_table',1),
	(6,'2025_02_23_152817_create_bahanbakus_table',1),
	(7,'2025_02_26_082247_add_last_login_to_users_table',1),
	(8,'2025_02_26_210915_add_nilai_x_to_bahanbakus_table',1),
	(9,'2025_05_17_230627_create_riwayat_pengeluarans_table',1),
	(10,'2025_05_21_185843_add_suplier_to_namabahans_table',1),
	(11,'2025_05_21_232003_add_user_id_to_riwayat_pengeluarans_table',1),
	(12,'2025_07_19_204333_add_code_barang_to_namabahans',2),
	(13,'2025_07_19_205034_add_alamat_suplier_and_no_hp_suplier_to_namabahans',3),
	(14,'2025_07_20_180826_create_eoqs_table',4);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table namabahans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `namabahans`;

CREATE TABLE `namabahans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `suplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp_suplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_suplier` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `namabahans_code_barang_unique` (`code_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `namabahans` WRITE;
/*!40000 ALTER TABLE `namabahans` DISABLE KEYS */;

INSERT INTO `namabahans` (`id`, `code_barang`, `nama_bahan`, `harga`, `suplier`, `no_hp_suplier`, `alamat_suplier`, `created_at`, `updated_at`)
VALUES
	(2,'CB-0001','Boba milk tea',123123,'PT Sejahtera','01823212','Depok','2025-07-19 21:03:29','2025-07-19 21:03:29');

/*!40000 ALTER TABLE `namabahans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table riwayat_pengeluarans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `riwayat_pengeluarans`;

CREATE TABLE `riwayat_pengeluarans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `id_bahan` int NOT NULL,
  `jumlah` int NOT NULL,
  `tgl_keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `riwayat_pengeluarans` WRITE;
/*!40000 ALTER TABLE `riwayat_pengeluarans` DISABLE KEYS */;

INSERT INTO `riwayat_pengeluarans` (`id`, `user_id`, `id_bahan`, `jumlah`, `tgl_keluar`, `created_at`, `updated_at`)
VALUES
	(5,2,2,5,'2025-07-19','2025-07-19 23:42:53','2025-07-19 23:42:53');

/*!40000 ALTER TABLE `riwayat_pengeluarans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `last_login_at`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(2,'Alfahrezi','sulthan.alfahrezy@gmail.com','2025-07-20 15:38:12','admin','2025-07-19 13:12:17','$2y$10$K4KzzC7dk90N7ww2KLcd2OlK5E7U9I9ZejARk6h01MGgdYgoBbCJq',NULL,'2025-07-19 13:12:03','2025-07-20 15:38:12');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
