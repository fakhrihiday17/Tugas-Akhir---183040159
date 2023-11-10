-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 07:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(255) NOT NULL,
  `novel_id` varchar(255) NOT NULL,
  `chapter_number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `novel_id`, `chapter_number`, `title`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'Bab 1', '2023-08-30 23:57:01', '2023-08-31 06:57:01'),
(3, '1', '2', 'bab 2', '2023-08-31 00:23:50', '2023-08-31 07:23:50'),
(4, '1', '3', 'bab 3', '2023-09-08 19:44:16', '2023-08-31 07:38:16'),
(5, '1', '5', 'bab 5', '2023-11-01 23:24:59', '2023-11-02 06:24:59'),
(6, '2', '1', 'bab 1', '2023-11-01 23:30:35', '2023-11-02 06:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `novels`
--

CREATE TABLE `novels` (
  `id` int(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `sinopsis` longtext NOT NULL,
  `status_favorit` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `novels`
--

INSERT INTO `novels` (`id`, `cover_image`, `title`, `genre`, `author`, `sinopsis`, `status_favorit`, `created_at`, `updated_at`) VALUES
(1, 'buku1.jpg', 'Buku 1.1', 'Horor', 'Hidayat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus harum inventore ad omnis adipisci, voluptates libero sunt ut eveniet corrupti vitae perspiciatis tenetur quo alias id corporis, pariatur veniam ducimus? Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus harum inventore ad omnis adipisci, voluptates libero sunt ut eveniet corrupti vitae perspiciatis tenetur quo alias id corporis, pariatur veniam ducimus?', 1, '2023-10-31 05:53:42', '2023-10-31 05:53:42'),
(2, 'buku2.png', 'Buku 3', 'Komedi', 'Ahmad', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus harum inventore ad omnis adipisci, voluptates libero sunt ut eveniet corrupti vitae perspiciatis tenetur quo alias id corporis, pariatur veniam ducimus? Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus harum inventore ad omnis adipisci, voluptates libero sunt ut eveniet corrupti vitae perspiciatis tenetur quo alias id corporis, pariatur veniam ducimus?', 0, '2023-10-23 19:47:33', '2023-10-23 19:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(255) NOT NULL,
  `chapter_id` varchar(255) NOT NULL,
  `page_number` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `bookmark_text` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `chapter_id`, `page_number`, `content`, `bookmark_text`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum culpa perspiciatis eos eum quibusdam ipsum eveniet amet alias repudiandae saepe mollitia vel illum nihil nemo suscipit, nesciunt autem repellat dicta!', 'nesciunt autem repellat dicta!', '2023-11-02 14:48:25', '2023-11-02 14:48:25'),
(2, '3', '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem quisquam necessitatibus cupiditate possimus adipisci repudiandae facilis aliquam, incidunt ut iure ex qui quos voluptates, cumque quidem consequuntur, fugiat delectus suscipit.Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem quisquam necessitatibus cupiditate possimus adipisci repudiandae facilis aliquam, incidunt ut iure ex qui quos voluptates, cumque quidem consequuntur, fugiat delectus suscipit.', 'Lorem', '2023-10-23 19:06:44', '2023-10-23 19:06:44'),
(3, '1', '2', 'if ($isFirstPage && $chapterNumber > 1) {\r\n            // Pengguna berada di halaman pertama chapter, arahkan ke halaman terakhir dari chapter sebelumnya\r\n            $previousChapter = Chapter::where(\'novel_id\', $novelId)\r\n                ->where(\'chapter_number\', $chapterNumber - 1)\r\n                ->first();\r\n\r\n            $previousPage = Page::where(\'chapter_id\', $previousChapter->id)\r\n                ->orderBy(\'page_number\', \'desc\')\r\n                ->first();\r\n\r\n            return redirect()->route(\'reader.show\', [\r\n                \'novelId\' => $novel->id,\r\n                \'chapterNumber\' => $previousChapter->chapter_number,\r\n                \'pageNumber\' => $previousPage->page_number,\r\n            ]);\r\n        if ($isFirstPage && $chapterNumber > 1) {\r\n            // Pengguna berada di halaman pertama chapter, arahkan ke halaman terakhir dari chapter sebelumnya\r\n            $previousChapter = Chapter::where(\'novel_id\', $novelId)\r\n                ->where(\'chapter_number\', $chapterNumber - 1)\r\n                ->first();\r\n\r\n            $previousPage = Page::where(\'chapter_id\', $previousChapter->id)\r\n                ->orderBy(\'page_number\', \'desc\')\r\n                ->first();\r\n\r\n            return redirect()->route(\'reader.show\', [\r\n                \'novelId\' => $novel->id,\r\n                \'chapterNumber\' => $previousChapter->chapter_number,\r\n                \'pageNumber\' => $previousPage->page_number,\r\n            ]);', '($isFirstPage && $chapterNumber > 1', '2023-10-23 20:46:38', '2023-10-23 20:46:38'),
(4, '1', '3', 'Pada contoh di atas, kami menggunakan Bootstrap class d-flex dan justify-content-center untuk mengatur teks di tengah horizontal halaman, dan align-items-center untuk mengatur teks di tengah vertikal halaman. Kami juga menambahkan style=\"min-height: 400px;\" untuk memberikan tinggi minimum pada kontainer teks agar halaman tetap terlihat baik saat teksnya sedikit atau banyak.\r\n\r\nAnda dapat menyesuaikan nilai min-height sesuai dengan preferensi Anda. Pastikan bahwa Anda telah memuat Bootstrap CSS di halaman Anda untuk menggunakan class-class Bootstrap tersebut. Juga, perhatikan bahwa kami menggunakan class=\"text-center\" untuk mengatur teks di tengah secara horizontal di dalam div konten.', 'Pada contoh di atas,', '2023-10-23 19:00:58', '2023-10-23 19:00:58'),
(5, '4', '1', '@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)@if ($nextChapter && !$isLastChapter)', '', '2023-09-11 12:31:58', '2023-09-08 19:44:48'),
(6, '3', '2', '1. Bagi mahasiswa yg belum melakukan Perwalian Semester Ganjil 2023/2024 dengan pembayaran DPP sudah 25%, dapat melakukan perwalian (Add Matakuliah) pada laman SITU.2 pada tanggal 11 September 2023. Dan apabila pembayaran DPP belum singkron dan ada kendala saat melakukan perwalian, silahkan mengunjungi ruang SB109 untuk dilakukan singkronisasi.', '', '2023-09-11 05:45:39', '2023-09-11 12:45:39'),
(7, '4', '2', '2. Pelaksanaan Add & Drop  Matakuliah Semester Ganjil 2023/2024 dibuka pada tanggal 12 September 2023, dengan membawa Meom/Surat Rekomendaasi dari Dosen Wali atau DIKJAR (WAJIB). Pelayanan dilakukan offfiline di ruang SB109\r\n\r\n\r\nTerimakasih', '', '2023-09-11 05:46:01', '2023-09-11 12:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_user`, `email_user`, `password`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'asd@gmail.com', '$2y$10$FXleEn7f49JDB04ecSVWkO.EYBXqSqopoDhUf7KC4IS.44Aes9soi', '2023-11-08 09:36:24', '2023-11-08 16:36:24'),
(2, '123', '123@gmail.com', '$2y$10$20ygHrgKJRrXtUF7BPsaKeZsNGLIr3qakiSqJe3kwyNJGgDmQQhou', '2023-11-08 14:13:32', '2023-11-08 21:13:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novels`
--
ALTER TABLE `novels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `novels`
--
ALTER TABLE `novels`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
