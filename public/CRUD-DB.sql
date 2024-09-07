-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table crud_db.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_state_id_foreign` (`state_id`),
  CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.cities: ~13 rows (approximately)
DELETE FROM `cities`;
INSERT INTO `cities` (`id`, `name`, `state_id`, `created_at`, `updated_at`) VALUES
	(1, 'Los Angeles', 1, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(2, 'San Francisco', 1, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(3, 'New York City', 2, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(4, 'Mumbai', 3, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(5, 'Pune', 3, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(6, 'Ahmedabad', 4, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(7, 'Toronto', 5, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(8, 'Ottawa', 5, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(9, 'Montreal', 6, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(10, 'Sydney', 7, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(11, 'Melbourne', 8, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(12, 'London', 9, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(13, 'Edinburgh', 10, '2024-09-07 02:24:22', '2024-09-07 02:24:22');

-- Dumping structure for table crud_db.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.countries: ~5 rows (approximately)
DELETE FROM `countries`;
INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'USA', '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(2, 'India', '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(3, 'Canada', '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(4, 'Australia', '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(5, 'United Kingdom', '2024-09-07 02:24:22', '2024-09-07 02:24:22');

-- Dumping structure for table crud_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table crud_db.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `state_id` bigint(20) unsigned NOT NULL,
  `city_id` bigint(20) unsigned NOT NULL,
  `terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forms_country_id_foreign` (`country_id`),
  KEY `forms_state_id_foreign` (`state_id`),
  KEY `forms_city_id_foreign` (`city_id`),
  CONSTRAINT `forms_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forms_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.forms: ~4 rows (approximately)
DELETE FROM `forms`;
INSERT INTO `forms` (`id`, `name`, `email`, `country_id`, `state_id`, `city_id`, `terms`, `gender`, `birthdate`, `file`, `created_at`, `updated_at`) VALUES
	(1, 'Thane Bates', 'zafy@mailinator.com', 3, 5, 7, 'accepted', 'male', '1980-03-04', '1725717523.jpg', '2024-09-07 03:42:19', '2024-09-07 08:28:43'),
	(3, 'Sage Stephenson', 'xobycecar@mailinator.com', 5, 9, 12, 'accepted', 'female', '2000-12-12', '1725704727.png', '2024-09-07 04:55:01', '2024-09-07 04:55:27'),
	(4, 'Carly Morrison', 'poridytys@mailinator.com', 3, 6, 9, 'on', 'female', '1983-02-27', '1725717246.jpg', '2024-09-07 08:24:06', '2024-09-07 08:24:06'),
	(5, 'Axel Brown', 'nygaxaja@mailinator.com', 2, 3, 4, 'on', 'female', '1999-03-05', '1725717350.jpg', '2024-09-07 08:25:50', '2024-09-07 08:25:50');

-- Dumping structure for table crud_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.migrations: ~8 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_09_07_074751_create_countries_table', 3),
	(7, '2024_09_07_074754_create_states_table', 4),
	(8, '2024_09_07_074759_create_cities_table', 4),
	(10, '2024_09_07_074256_create_forms_table', 5);

-- Dumping structure for table crud_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table crud_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table crud_db.states
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `states_country_id_foreign` (`country_id`),
  CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.states: ~10 rows (approximately)
DELETE FROM `states`;
INSERT INTO `states` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
	(1, 'California', 1, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(2, 'New York', 1, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(3, 'Maharashtra', 2, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(4, 'Gujarat', 2, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(5, 'Ontario', 3, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(6, 'Quebec', 3, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(7, 'New South Wales', 4, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(8, 'Victoria', 4, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(9, 'England', 5, '2024-09-07 02:24:22', '2024-09-07 02:24:22'),
	(10, 'Scotland', 5, '2024-09-07 02:24:22', '2024-09-07 02:24:22');

-- Dumping structure for table crud_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table crud_db.users: ~0 rows (approximately)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
