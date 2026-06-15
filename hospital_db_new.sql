-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 08:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `reason` text DEFAULT NULL,
  `consultation_fee` decimal(10,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_id` varchar(255) DEFAULT NULL,
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `consultation_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `specialization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `about` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `slot_duration` int(11) NOT NULL DEFAULT 30,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monday` tinyint(1) NOT NULL DEFAULT 0,
  `tuesday` tinyint(1) NOT NULL DEFAULT 0,
  `wednesday` tinyint(1) NOT NULL DEFAULT 0,
  `thursday` tinyint(1) NOT NULL DEFAULT 0,
  `friday` tinyint(1) NOT NULL DEFAULT 0,
  `saturday` tinyint(1) NOT NULL DEFAULT 0,
  `sunday` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosis` longtext DEFAULT NULL,
  `prescription` longtext DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_record_files`
--

CREATE TABLE `medical_record_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medical_record_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_06_05_110630_create_users_table', 1),
(4, '2026_06_05_110807_create_patients_table', 1),
(5, '2026_06_05_110900_create_doctors_table', 1),
(6, '2026_06_05_111746_create_appointments_table', 1),
(7, '2026_06_05_124139_add_health_profile_fields_to_patients_table', 2),
(8, '2026_06_05_163317_create_specializations_table', 3),
(9, '2026_06_05_164943_add_doctor_details_to_doctors_table', 4),
(10, '2026_06_05_174609_replace_specialization_with_specialization_id_in_doctors_table', 4),
(11, '2026_06_05_175230_remove_specialization_column_from_doctors_table', 4),
(12, '2026_06_06_085342_create_doctor_schedules_table', 4),
(13, '2026_06_06_092011_modify_doctor_schedules_for_weekly_availability', 5),
(14, '2026_06_07_172044_create_medical_records_table', 6),
(15, '2026_06_07_173007_add_appointment_id_to_medical_records_table', 7),
(16, '2026_06_11_181621_create_medical_record_files_table', 8),
(17, '2026_06_11_213208_add_profile_fields_to_doctors_table', 9),
(18, '2026_06_12_124057_add_profile_photo_to_doctors_table', 10),
(19, '2026_06_12_134421_add_profile_photo_to_patients_table', 11),
(20, '2026_06_12_140201_create_notifications_table', 12),
(21, '2026_06_13_000001_add_payment_fields_to_appointments_table', 13),
(22, '2024_01_01_000002_create_payment_transactions_table', 14),
(23, '2026_06_13_102103_add_payment_fields_to_appointments_table', 15),
(24, '2026_06_13_182108_add_signature_to_doctors_table', 16),
(25, '2026_06_13_190040_add_link_to_notifications_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `profile_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `has_diabetes` tinyint(1) NOT NULL DEFAULT 0,
  `has_hypertension` tinyint(1) NOT NULL DEFAULT 0,
  `has_heart_disease` tinyint(1) NOT NULL DEFAULT 0,
  `has_asthma` tinyint(1) NOT NULL DEFAULT 0,
  `current_medications` text DEFAULT NULL,
  `past_surgeries` text DEFAULT NULL,
  `last_health_checkup` date DEFAULT NULL,
  `smoker` tinyint(1) NOT NULL DEFAULT 0,
  `alcohol_consumer` tinyint(1) NOT NULL DEFAULT 0,
  `family_medical_history` text DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `razorpay_order_id` varchar(255) NOT NULL,
  `razorpay_payment_id` varchar(255) DEFAULT NULL,
  `razorpay_signature` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `status` enum('created','paid','failed','refunded') NOT NULL DEFAULT 'created',
  `gateway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gateway_response`)),
  `method` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT NULL,
  `vpa` varchar(255) DEFAULT NULL,
  `error_code` varchar(255) DEFAULT NULL,
  `error_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('patient','doctor','admin') NOT NULL DEFAULT 'patient',
  `profile_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_license_number_unique` (`license_number`),
  ADD KEY `doctors_user_id_foreign` (`user_id`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_schedules_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_record_files`
--
ALTER TABLE `medical_record_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_user_id_foreign` (`user_id`);

--
-- Indexes for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_transactions_razorpay_order_id_unique` (`razorpay_order_id`),
  ADD KEY `payment_transactions_appointment_id_foreign` (`appointment_id`),
  ADD KEY `payment_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medical_record_files`
--
ALTER TABLE `medical_record_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `doctor_schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD CONSTRAINT `payment_transactions_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
