-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2024 pada 05.42
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_crud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `shapes`
--

CREATE TABLE `shapes` (
  `id` int(5) NOT NULL,
  `shape` varchar(10) NOT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `radius` int(11) DEFAULT NULL,
  `clickable` tinytext,
  `title` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `text` varchar(10) NOT NULL,
  `title_shape` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `subtitle_font_size` float NOT NULL DEFAULT '14',
  `text_subtitle` varchar(255) NOT NULL,
  `font_size` float NOT NULL DEFAULT '12',
  `coordinat` int(10) NOT NULL,
  `text_title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `shapes`
--

INSERT INTO `shapes` (`id`, `shape`, `x`, `y`, `width`, `height`, `radius`, `clickable`, `title`, `created_at`, `update_at`, `text`, `title_shape`, `subtitle`, `subtitle_font_size`, `text_subtitle`, `font_size`, `coordinat`, `text_title`, `image`) VALUES
(5, 'rectangle', 585, 325, 239, 233, 0, 'Yes', NULL, '2024-11-04 03:31:15', '2024-11-04 03:31:15', '', 'data rectangel', NULL, 12, 'v393', 16, 0, 'v670', '1730665834_kotak.jpg'),
(59, 'circle', 589, 329, 0, 0, 342, 'Yes', NULL, '2024-11-04 10:19:02', '2024-11-04 16:19:02', '', 'data circles', NULL, 12, 'v3990', 16, 0, 'v67888', '1730711942_circle.jpg'),
(83, 'circle', 589, 329, 0, 0, 350, 'Yes', NULL, '2024-11-05 09:33:13', '2024-11-05 15:33:13', '', 'circle', NULL, 12, 'v3999', 16, 0, 'v234', '1730795593_circle.jpg'),
(87, 'circle', 580, 323, 609, 500, 40, 'Yes', NULL, '2024-11-06 05:25:28', '2024-11-06 11:25:28', '', 'data rectangel', NULL, 18, 'kn', 20, 0, 'hahaha', '1730867128_WIN_20240526_20_05_37_Pro.jpg'),
(88, 'circle', 589, 323, 239, 500, 342, 'Yes', NULL, '2024-11-06 05:26:56', '2024-11-06 11:26:56', '', 'data rectangel', NULL, 18, 'v397', 20, 0, '12', ''),
(89, 'circle', 589, 300, 400, 500, 40, 'Yes', NULL, '2024-11-06 05:28:53', '2024-11-06 11:28:53', '', 'data rectangel', NULL, 18, 'IH', 18, 0, 'AH', ''),
(90, 'rectangle', 500, 600, 500, 600, 40, 'Yes', NULL, '2024-11-06 05:33:06', '2024-11-06 11:33:06', '', 'data rectangel', NULL, 18, 'v387', 20, 0, 'v678', ''),
(91, 'rectangle', 500, 600, 500, 600, 40, 'Yes', NULL, '2024-11-06 05:33:08', '2024-11-06 11:33:08', '', 'data rectangel', NULL, 18, 'v387', 20, 0, 'v678', ''),
(92, 'rectangle', 500, 600, 500, 600, 40, 'Yes', NULL, '2024-11-06 05:33:08', '2024-11-06 11:33:08', '', 'data rectangel', NULL, 18, 'v387', 20, 0, 'v678', ''),
(93, 'rectangle', 500, 600, 500, 600, 40, 'Yes', NULL, '2024-11-06 05:33:08', '2024-11-06 11:33:08', '', 'data rectangel', NULL, 18, 'v387', 20, 0, 'v678', ''),
(94, 'rectangle', 500, 600, 500, 600, 40, 'Yes', NULL, '2024-11-06 05:33:08', '2024-11-06 11:33:08', '', 'data rectangel', NULL, 18, 'v387', 20, 0, 'v678', ''),
(95, 'circle', 500, 600, 500, 600, 40, 'Yes', NULL, '2024-11-06 05:38:21', '2024-11-06 11:38:21', '', 'data rectangel', NULL, 18, 'ha', 18, 0, 'v234', ''),
(96, 'circle', 0, 0, 0, 0, 0, '', NULL, '2024-11-06 06:26:11', '2024-11-06 12:26:11', '', 'data rectangel', NULL, 0, '', 0, 0, '', '1730870771_WIN_20240526_20_05_37_Pro.jpg'),
(97, 'rectangle', 600, 500, 600, 500, 100, 'Yes', NULL, '2024-11-06 06:28:54', '2024-11-06 12:28:54', '', 'data rectangel', NULL, 18, 'v387', 20, 0, 'v67888', '1730870934_WIN_20240526_20_05_37_Pro.jpg'),
(101, 'circle', 589, 329, 609, 0, 0, 'Yes', NULL, '2024-11-06 11:04:19', '2024-11-06 17:04:19', '', 'data rectangel', NULL, 12, 'v397', 16, 0, 'v678', ''),
(102, 'circle', 589, 329, 609, 0, 0, 'Yes', NULL, '2024-11-06 11:04:22', '2024-11-06 17:04:22', '', 'data rectangel', NULL, 12, 'v397', 16, 0, 'v678', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `shapes`
--
ALTER TABLE `shapes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `shapes`
--
ALTER TABLE `shapes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
