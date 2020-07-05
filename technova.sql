-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2020 pada 17.30
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technova`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_07_03_155237_create_roles_table', 2),
(4, '2020_07_03_155245_create_permissions_table', 2),
(5, '2020_07_03_155252_create_permission_role_table', 2),
(7, '2020_07_03_155702_add_role_id_to_users_table', 3),
(8, '2020_07_04_065407_create_tasks_table', 4),
(10, '2020_07_05_132641_add_status_to_users_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mriyadh103@gmail.com', '$2y$10$LGJQm3VIt2WlULDOWCR7/eGhOLT1m0dgXRUCOdACkYvvPwqzQ0IAu', '2020-07-05 06:15:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'create karyawan', NULL, NULL),
(2, 'read karyawan', NULL, NULL),
(3, 'update karyawan', NULL, NULL),
(4, 'delete karyawan', NULL, NULL),
(5, 'master', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(7, 2, 2, NULL, NULL),
(8, 1, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'employee', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tugas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('not_started','in_progress','awaiting_feedback','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `tanggal`, `tugas`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(3, 11, '2020-07-11', 'dfhdkjsafh', 'ahfjh', 'awaiting_feedback', '2020-07-04 07:41:47', '2020-07-05 02:00:29'),
(13, 8, '2020-07-24', 'djkfasdgfjhds', 'jdkdajfhasdfk', 'not_started', '2020-07-04 08:00:38', '2020-07-04 08:00:38'),
(17, 8, '2020-07-24', 'sssdafgdghss', 'fjdskjfksfh', 'not_started', '2020-07-04 08:10:57', '2020-07-04 08:10:57'),
(24, 17, '2020-07-05', 'Tambah fitur pencarian di website A', 'hdskfasjdf', 'not_started', '2020-07-05 06:59:49', '2020-07-05 06:59:49'),
(25, 17, '2020-07-22', 'Tambah fitur pencarian di website A', 'jdakhdaksjdh', 'not_started', '2020-07-05 07:01:11', '2020-07-05 07:01:11'),
(26, 17, '2020-07-23', 'Tambah fitur pencarian di website A hahahah', '<p><img alt=\"\" src=\"http://localhost/technova/public/uploads/practice21356124236-2-1_1593959661.jpg\" style=\"height:241px; width:200px\" /></p>\r\n\r\n<p>testing</p>', 'in_progress', '2020-07-05 07:34:54', '2020-07-05 08:24:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') COLLATE utf8mb4_unicode_ci DEFAULT 'aktif',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `status`, `name`, `nip`, `email`, `email_verified_at`, `password`, `tanggal_lahir`, `jenis_kelamin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'admin', NULL, 'admin@admin.com', NULL, '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, NULL, NULL, '2020-07-15 12:19:40', NULL),
(3, 2, 'aktif', 'employee 1', '123213', 'employee1@mail.com', '2020-07-08 06:39:05', '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', '2020-07-12', 'P', NULL, '2020-07-27 12:19:28', NULL),
(4, 2, 'aktif', 'employee 2', '2324567', 'employee 2', '2020-07-30 06:39:05', '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', '2020-07-29', 'P', NULL, '2020-07-01 12:19:48', NULL),
(5, 2, 'tidak_aktif', 'employee 3', '43289787', 'employee3@mail.com', NULL, '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'P', NULL, '2020-07-14 12:19:45', NULL),
(6, 2, 'aktif', 'employee 4', '1234256', 'employee4@mail.com', NULL, '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'P', NULL, '2020-07-02 12:19:18', NULL),
(7, 2, 'aktif', 'employee 5', '32532453', 'employee5@mail.com', NULL, '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'L', NULL, '2020-10-12 12:19:14', NULL),
(8, 2, 'tidak_aktif', 'employee 6', '43232386', 'employee6@mail.com', NULL, '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'L', NULL, '2020-03-10 12:19:05', NULL),
(10, 2, 'tidak_aktif', 'employee8', '32425152', 'employee8@mail.com', NULL, '', NULL, 'P', NULL, '2020-06-23 12:18:50', NULL),
(11, 2, 'aktif', 'employee9', '345678', 'employee9@mail.com', NULL, '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'P', NULL, '2020-07-15 12:19:25', NULL),
(13, 2, 'aktif', 'employee11', '482567', 'employee11@mail.com', '2020-07-15 06:45:10', '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'P', NULL, '2020-07-14 12:18:41', NULL),
(14, 2, 'tidak_aktif', 'employee12', '2413123', 'employee12', '2020-07-23 06:45:10', '$2y$10$nKGyMlJm2cm0TMrW.jo2v.8CK9HaUHQ7r4co/bp9ZMeS9Ycm1NETy', NULL, 'P', NULL, '2020-07-08 12:18:37', NULL),
(17, 2, 'aktif', 'Riyadh muhammad', '456262523', 'mriyadh103@gmail.com', NULL, '$2y$10$U//1HBVu85Suq/bmCVZjcefpDXmpeKoPIE/ZM/r8NEIPWDLru4Hk.', NULL, NULL, NULL, '2020-07-05 04:51:16', '2020-07-05 04:51:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
