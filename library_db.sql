-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2026 at 03:46 PM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `description`, `model_type`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'create', 'Registered borrower: Camela Kim Arcalas', 'Borrower', 1, '2026-05-03 05:56:42', '2026-05-03 05:56:42'),
(2, 2, 'create', 'Added category: Fictions', 'Category', 1, '2026-05-04 05:47:54', '2026-05-04 05:47:54'),
(3, 2, 'create', 'Added category: Non-Fictions', 'Category', 2, '2026-05-04 05:48:16', '2026-05-04 05:48:16'),
(4, 2, 'create', 'Added category: Fan', 'Category', 3, '2026-05-04 05:48:27', '2026-05-04 05:48:27'),
(5, 2, 'update', 'Updated category: Fantasy', 'Category', 3, '2026-05-04 05:48:52', '2026-05-04 05:48:52'),
(6, 2, 'create', 'Added category: Science Fiction', 'Category', 4, '2026-05-04 05:49:19', '2026-05-04 05:49:19'),
(7, 2, 'create', 'Added category: Mystery', 'Category', 5, '2026-05-04 05:50:04', '2026-05-04 05:50:04'),
(8, 2, 'create', 'Added new book: To Kill a Mockingbird', 'Book', 1, '2026-05-04 05:53:27', '2026-05-04 05:53:27'),
(9, 2, 'create', 'Added new book: 1984', 'Book', 2, '2026-05-04 05:55:14', '2026-05-04 05:55:14'),
(10, 2, 'create', 'Added new book: Harry Potter and the Sorcerer’s Stone', 'Book', 3, '2026-05-04 05:56:25', '2026-05-04 05:56:25'),
(11, 2, 'create', 'Added new book: A Brief History of Humankind', 'Book', 4, '2026-05-04 05:59:01', '2026-05-04 05:59:01'),
(12, 2, 'create', 'Added new book: The Girl with the Dragon Tattoo', 'Book', 5, '2026-05-04 06:01:24', '2026-05-04 06:01:24'),
(13, 4, 'borrow', 'Camela Kim Arcalas borrowed \'To Kill a Mockingbird\'', 'BookTransaction', 1, '2026-05-04 06:02:58', '2026-05-04 06:02:58'),
(14, 4, 'borrow', 'Camela Kim Arcalas borrowed \'1984\'', 'BookTransaction', 2, '2026-05-04 06:03:01', '2026-05-04 06:03:01'),
(15, 4, 'borrow', 'Camela Kim Arcalas borrowed \'Harry Potter and the Sorcerer’s Stone\'', 'BookTransaction', 3, '2026-05-04 06:03:04', '2026-05-04 06:03:04'),
(16, 4, 'borrow', 'Camela Kim Arcalas borrowed \'A Brief History of Humankind\'', 'BookTransaction', 4, '2026-05-06 05:10:22', '2026-05-06 05:10:22'),
(17, 4, 'borrow', 'Camela Kim Arcalas borrowed \'The Girl with the Dragon Tattoo\'', 'BookTransaction', 5, '2026-05-06 05:10:26', '2026-05-06 05:10:26'),
(18, 4, 'return', 'Camela Kim Arcalas returned \'The Girl with the Dragon Tattoo\'', 'BookTransaction', 5, '2026-05-08 04:03:04', '2026-05-08 04:03:04'),
(19, 2, 'create', 'Registered borrower: Andrea Arcalas', 'Borrower', 2, '2026-05-08 05:13:30', '2026-05-08 05:13:30'),
(20, 5, 'borrow', 'Andrea Arcalas borrowed \'To Kill a Mockingbird\'', 'BookTransaction', 6, '2026-05-08 05:36:32', '2026-05-08 05:36:32'),
(21, 5, 'borrow', 'Andrea Arcalas borrowed \'1984\'', 'BookTransaction', 7, '2026-05-08 05:36:35', '2026-05-08 05:36:35'),
(22, 5, 'borrow', 'Andrea Arcalas borrowed \'Harry Potter and the Sorcerer’s Stone\'', 'BookTransaction', 8, '2026-05-08 05:36:38', '2026-05-08 05:36:38'),
(23, 5, 'borrow', 'Andrea Arcalas borrowed \'A Brief History of Humankind\'', 'BookTransaction', 9, '2026-05-08 05:36:41', '2026-05-08 05:36:41'),
(24, 5, 'borrow', 'Andrea Arcalas borrowed \'The Girl with the Dragon Tattoo\'', 'BookTransaction', 10, '2026-05-08 05:36:43', '2026-05-08 05:36:43'),
(25, 2, 'update_due_date', 'Updated due date for transaction #1', 'BookTransaction', 1, '2026-05-08 06:30:40', '2026-05-08 06:30:40'),
(26, 4, 'borrow', 'Camela Kim Arcalas borrowed \'The Girl with the Dragon Tattoo\'', 'BookTransaction', 11, '2026-05-08 07:43:02', '2026-05-08 07:43:02'),
(27, 2, 'create', 'Registered borrower: Drew Pogi', 'Borrower', 3, '2026-05-08 08:07:27', '2026-05-08 08:07:27'),
(28, 6, 'borrow', 'Drew Pogi borrowed \'To Kill a Mockingbird\'', 'BookTransaction', 12, '2026-05-08 08:07:48', '2026-05-08 08:07:48'),
(29, 6, 'borrow', 'Drew Pogi borrowed \'1984\'', 'BookTransaction', 13, '2026-05-09 05:07:02', '2026-05-09 05:07:02'),
(30, 6, 'borrow', 'Drew Pogi borrowed \'Harry Potter and the Sorcerer’s Stone\'', 'BookTransaction', 14, '2026-05-09 05:17:09', '2026-05-09 05:17:09'),
(31, 6, 'borrow', 'Drew Pogi borrowed \'A Brief History of Humankind\'', 'BookTransaction', 15, '2026-05-09 05:17:19', '2026-05-09 05:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `total_copies` int(11) NOT NULL,
  `available_copies` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `published_year` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `category_id`, `total_copies`, `available_copies`, `description`, `publisher`, `published_year`, `created_at`, `updated_at`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', '9780061120084', 1, 10, 7, 'A powerful story about racial injustice and moral growth in the American South, seen through the eyes of a young girl.', 'J.B. Lippincott & Co.', '1960', '2026-05-04 05:53:27', '2026-05-08 08:07:48'),
(2, '1984', 'George Orwell', '9780451524935', 4, 10, 7, 'A chilling depiction of a totalitarian society where surveillance, control, and propaganda dominate everyday life.', 'Secker & Warburg', '1949', '2026-05-04 05:55:14', '2026-05-09 05:07:02'),
(3, 'Harry Potter and the Sorcerer’s Stone', 'J.K. Rowling', '9780590353427', 3, 10, 7, 'A young boy discovers he is a wizard and begins his magical journey at Hogwarts, uncovering secrets about his past.', 'Bloomsbury', '1997', '2026-05-04 05:56:25', '2026-05-09 05:17:08'),
(4, 'A Brief History of Humankind', 'Yuval Noah Harari', '9780062316097', 2, 10, 7, 'Explores the history of humankind from the Stone Age to the modern era, examining how humans shaped the world.', 'Harper', '2011', '2026-05-04 05:59:01', '2026-05-09 05:17:19'),
(5, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', '9780307454546', 5, 10, 8, 'A journalist and a hacker investigate a decades-old disappearance tied to a wealthy family’s dark secrets.', 'Norstedts Förlag', '2004', '2026-05-04 06:01:24', '2026-05-08 07:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `book_transactions`
--

CREATE TABLE `book_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrower_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `status` enum('borrowed','returned','overdue') NOT NULL DEFAULT 'borrowed',
  `fine_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fine_paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_transactions`
--

INSERT INTO `book_transactions` (`id`, `borrower_id`, `book_id`, `borrow_date`, `due_date`, `return_date`, `status`, `fine_amount`, `fine_paid`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-05-04 00:00:00', '2026-05-09 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-04 06:02:58', '2026-05-08 06:30:40'),
(2, 1, 2, '2026-05-04 00:00:00', '2026-05-18 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-04 06:03:01', '2026-05-04 06:03:01'),
(3, 1, 3, '2026-05-04 00:00:00', '2026-05-18 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-04 06:03:04', '2026-05-04 06:03:04'),
(4, 1, 4, '2026-05-06 00:00:00', '2026-05-20 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-06 05:10:22', '2026-05-06 05:10:22'),
(5, 1, 5, '2026-05-06 00:00:00', '2026-05-20 00:00:00', '2026-05-08 00:00:00', 'returned', 0.00, 0, '2026-05-06 05:10:26', '2026-05-08 04:03:04'),
(6, 2, 1, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 05:36:31', '2026-05-08 05:36:31'),
(7, 2, 2, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 05:36:35', '2026-05-08 05:36:35'),
(8, 2, 3, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 05:36:38', '2026-05-08 05:36:38'),
(9, 2, 4, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 05:36:40', '2026-05-08 05:36:40'),
(10, 2, 5, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 05:36:43', '2026-05-08 05:36:43'),
(11, 1, 5, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 07:43:02', '2026-05-08 07:43:02'),
(12, 3, 1, '2026-05-08 00:00:00', '2026-05-22 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-08 08:07:48', '2026-05-08 08:07:48'),
(13, 3, 2, '2026-05-09 00:00:00', '2026-05-23 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-09 05:07:02', '2026-05-09 05:07:02'),
(14, 3, 3, '2026-05-09 00:00:00', '2026-05-23 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-09 05:17:08', '2026-05-09 05:17:08'),
(15, 3, 4, '2026-05-09 00:00:00', '2026-05-23 00:00:00', NULL, 'borrowed', 0.00, 0, '2026-05-09 05:17:19', '2026-05-09 05:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `membership_id` varchar(255) NOT NULL,
  `membership_date` date NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `user_id`, `membership_id`, `membership_date`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'MEM-KNDEB9TC', '2026-05-03', NULL, NULL, 'active', '2026-05-03 05:56:42', '2026-05-03 05:56:42'),
(2, 5, 'MEM-59ICWC0P', '2026-05-08', NULL, NULL, 'active', '2026-05-08 05:13:30', '2026-05-08 05:13:30'),
(3, 6, 'MEM-EW5VT36W', '2026-05-08', NULL, NULL, 'active', '2026-05-08 08:07:27', '2026-05-08 08:07:27');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Fictions', 'Stories created from imagination that are not presented as real events, though they may be inspired by reality.', '2026-05-04 05:47:54', '2026-05-04 05:47:54'),
(2, 'Non-Fictions', 'Books based on real facts, events, and information such as history, science, and real-life stories.', '2026-05-04 05:48:16', '2026-05-04 05:48:16'),
(3, 'Fantasy', 'Fiction set in imaginary worlds, often involving magic, mythical creatures, and supernatural elements.', '2026-05-04 05:48:27', '2026-05-04 05:48:52'),
(4, 'Science Fiction', 'Stories based on futuristic concepts like advanced technology, space exploration, time travel, and science.', '2026-05-04 05:49:19', '2026-05-04 05:49:19'),
(5, 'Mystery', 'Focuses on solving a crime or uncovering secrets, often involving detectives or investigators.', '2026-05-04 05:50:04', '2026-05-04 05:50:04');

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
(1, '2026_02_10_000001_create_users_table', 1),
(2, '2026_02_10_000002_create_categories_table', 1),
(3, '2026_05_01_000000_add_phone_address_to_borrowers', 1),
(4, '2026_02_11_012406_create_cache_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '', 'admin@gmail.com', '0000000000', NULL, 'admin', NULL, '$2y$12$1tEwqBc36KxoFaE1wOUgpOLxJujqVHzfmP81ni.m5Lj5VXmJo.mVq', NULL, NULL, '2026-05-01 17:21:20'),
(4, 'Camela Kim Arcalas', 'camelakimarcalas@gmail.com', '09064872805', 'San Andres Balungao', 'user', NULL, '$2y$12$tRzdF51gzcPPBioxOwah7OFsZub1AcXFtce4Udw1ymg2JaItCNqaK', NULL, '2026-05-03 05:53:46', '2026-05-03 05:53:46'),
(5, 'Andrea Arcalas', 'andreaarcalas12@gmail.com', '09300505312', 'San Andres Balungao', 'user', NULL, '$2y$12$aOJyig1DEMmvIix/pvpU/upTlBB26TSFuIhBnRT6wgecWwkiAOIOe', NULL, '2026-05-08 05:12:53', '2026-05-08 05:12:53'),
(6, 'Drew Pogi', 'DungisAndrew@gmail.com', '09956789012', 'Aliaga Nueva Ecija', 'user', NULL, '$2y$12$//4f.YL.DV6B3cE.yaighuOVV2BXB7IR7mG4CUNEAKphEQ4ZZnGLm', NULL, '2026-05-08 08:06:39', '2026-05-08 08:06:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `book_transactions`
--
ALTER TABLE `book_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_transactions_borrower_id_foreign` (`borrower_id`),
  ADD KEY `book_transactions_book_id_foreign` (`book_id`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `borrowers_membership_id_unique` (`membership_id`),
  ADD KEY `borrowers_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_transactions`
--
ALTER TABLE `book_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `book_transactions`
--
ALTER TABLE `book_transactions`
  ADD CONSTRAINT `book_transactions_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_transactions_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
