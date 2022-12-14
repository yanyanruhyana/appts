-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2022 pada 10.46
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
-- Database: `asset-it`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_departemen`
--

CREATE TABLE `tb_departemen` (
  `id` int(11) NOT NULL,
  `departemen` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_departemen`
--

INSERT INTO `tb_departemen` (`id`, `departemen`, `created_at`, `modified_at`) VALUES
(1, 'Engineeringssz', '2018-01-24 10:18:20', '2018-01-24 10:19:24'),
(2, 'IT', '2018-01-24 10:18:20', '2018-01-24 10:19:24'),
(3, 'Finance', '2018-01-24 10:18:20', '2018-01-24 10:19:24'),
(5, 'Production Facilities', '2018-01-24 10:18:20', '2018-01-24 10:19:24'),
(6, 'Show', '2018-01-24 10:18:20', '2018-01-24 10:19:24'),
(7, 'Food n Beverages', '2018-01-24 10:18:20', '2018-01-24 10:19:24'),
(8, 'Operation', '2018-01-24 10:18:20', '2018-01-24 10:19:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_habispakai`
--

CREATE TABLE `tb_habispakai` (
  `id` int(11) NOT NULL,
  `model` int(3) NOT NULL,
  `stok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_habispakai`
--

INSERT INTO `tb_habispakai` (`id`, `model`, `stok`) VALUES
(1, 11, 25),
(2, 13, 10),
(3, 15, 10),
(5, 16, 6),
(9, 14, 10),
(10, 17, 3),
(11, 12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_habispakai_in`
--

CREATE TABLE `tb_habispakai_in` (
  `id` int(11) NOT NULL,
  `model_habispakai` int(3) NOT NULL,
  `qty_in` int(3) NOT NULL,
  `tgl_order` date NOT NULL,
  `no_order` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_habispakai_in`
--

INSERT INTO `tb_habispakai_in` (`id`, `model_habispakai`, `qty_in`, `tgl_order`, `no_order`) VALUES
(5, 17, 2, '0000-00-00', '000'),
(7, 11, 10, '2018-02-03', 'po 101010'),
(8, 14, 1, '2018-02-03', 'po 11111'),
(9, 11, 1, '2018-02-03', ''),
(10, 11, 10, '0000-00-00', 'po sepuluh'),
(11, 11, 10, '2018-02-10', 'masuk lagi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_habispakai_out`
--

CREATE TABLE `tb_habispakai_out` (
  `id` int(11) NOT NULL,
  `model_habispakai` int(3) NOT NULL,
  `qty_out` int(3) NOT NULL,
  `tgl_order` date NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `id_nama` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_habispakai_out`
--

INSERT INTO `tb_habispakai_out` (`id`, `model_habispakai`, `qty_out`, `tgl_order`, `no_order`, `id_nama`) VALUES
(1, 11, 1, '0000-00-00', '', 2),
(2, 11, 10, '0000-00-00', 'mr sepuluh', 1),
(3, 11, 10, '0000-00-00', '10 lagi', 1),
(4, 11, 5, '0000-00-00', '55', 1),
(5, 11, 11, '0000-00-00', '11', 2),
(6, 11, 4, '0000-00-00', 'po empatt', 2),
(7, 11, 10, '2018-02-10', 'po 10101010', 3),
(8, 11, 5, '0000-00-00', '', 0),
(9, 11, 5, '0000-00-00', '', 2),
(10, 11, 5, '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tipe` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `kategori`, `tipe`, `created_at`, `modified_at`) VALUES
(1, 'Personal Computer', 1, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(2, 'Web Cam', 1, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(3, 'Switch', 1, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(4, 'LCD Monitor', 1, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(5, 'USB Mouse', 2, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(6, 'USB Keyboard', 2, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(7, 'Notebook', 1, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(8, 'Tinta Printer', 3, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(9, 'External Harddisk', 1, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(10, 'Konektor', 3, '2018-01-24 10:20:17', '2018-01-24 10:20:17'),
(11, 'Printer', 1, '2018-01-24 12:22:00', '2018-01-24 12:22:00'),
(12, 'Cartridge', 3, '2018-01-26 11:12:54', '2018-01-26 11:12:54'),
(13, 'metallicasz', 4, '2018-02-01 08:30:22', '2018-02-01 08:30:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE `tb_log` (
  `log_id` int(11) NOT NULL,
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_user` varchar(255) DEFAULT NULL,
  `log_tipe` int(11) DEFAULT NULL,
  `log_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`log_id`, `log_time`, `log_user`, `log_tipe`, `log_desc`) VALUES
(9, '2018-01-23 11:03:49', NULL, 4, 'mengubah data'),
(10, '2018-01-23 11:12:17', NULL, 4, 'mengubah data'),
(11, '2018-01-23 11:12:52', NULL, 4, 'mengubah data'),
(12, '2018-01-24 10:03:06', NULL, 4, 'mengubah data'),
(13, '2018-01-24 11:22:35', NULL, 4, 'mengubah data'),
(14, '2018-01-24 11:22:49', NULL, 4, 'mengubah data'),
(15, '2018-01-24 12:22:37', NULL, 4, 'mengubah data'),
(16, '2018-01-25 04:02:38', NULL, 4, 'mengubah data'),
(17, '2018-01-25 04:02:43', NULL, 4, 'mengubah data'),
(18, '2018-01-25 04:02:47', NULL, 4, 'mengubah data'),
(19, '2018-01-25 04:03:01', NULL, 4, 'mengubah data'),
(20, '2018-01-25 04:03:18', NULL, 4, 'mengubah data'),
(21, '2018-01-25 04:14:29', NULL, 4, 'mengubah data'),
(22, '2018-01-25 04:14:39', NULL, 4, 'mengubah data'),
(23, '2018-01-25 09:40:44', NULL, 4, 'mengubah data'),
(24, '2018-01-26 02:58:01', NULL, 4, 'mengubah data'),
(25, '2018-01-26 02:58:06', NULL, 4, 'mengubah data'),
(26, '2018-01-26 11:31:17', NULL, 4, 'mengubah data'),
(27, '2018-01-26 11:31:25', NULL, 4, 'mengubah data'),
(28, '2018-01-26 11:31:32', NULL, 4, 'mengubah data'),
(29, '2018-01-29 12:46:57', NULL, 4, 'mengubah data'),
(30, '2018-01-30 04:07:53', NULL, 4, 'mengubah data'),
(31, '2018-01-30 04:09:21', NULL, 4, 'mengubah data'),
(32, '2018-01-30 04:18:34', NULL, 4, 'mengubah data'),
(33, '2018-01-30 07:03:09', NULL, 4, 'mengubah data'),
(34, '2018-01-30 07:05:51', NULL, 4, 'mengubah data'),
(35, '2018-01-30 09:42:14', NULL, 4, 'mengubah data'),
(36, '2018-02-03 02:17:10', NULL, 4, 'mengubah data'),
(37, '2018-02-03 04:02:57', NULL, 4, 'mengubah data'),
(38, '2018-02-03 04:05:12', NULL, 4, 'mengubah data'),
(39, '2018-02-03 04:05:28', NULL, 4, 'mengubah data'),
(40, '2018-02-03 06:42:53', NULL, 4, 'menambah stok'),
(41, '2018-02-03 08:47:53', NULL, 4, 'mengeluarkan stok'),
(42, '2018-02-03 08:51:15', NULL, 4, 'mengeluarkan stok'),
(43, '2018-02-03 08:53:04', NULL, 4, 'mengeluarkan stok'),
(44, '2018-02-03 08:53:22', NULL, 4, 'mengeluarkan stok'),
(45, '2018-02-03 08:53:41', NULL, 4, 'mengeluarkan stok'),
(46, '2018-02-03 09:24:25', NULL, 4, 'mengeluarkan stok'),
(47, '2018-02-03 09:24:59', NULL, 4, 'menambah stok'),
(48, '2018-02-03 09:27:59', NULL, 4, 'menambah stok'),
(49, '2018-02-05 04:11:06', NULL, 4, 'mengeluarkan stok'),
(50, '2018-02-05 04:24:16', NULL, 4, 'mengeluarkan stok'),
(51, '2018-02-05 04:24:53', NULL, 4, 'mengeluarkan stok'),
(52, '2018-02-05 04:24:59', NULL, 4, 'mengeluarkan stok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id`, `lokasi`, `created_at`, `modified_at`) VALUES
(1, 'Office Atas', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(2, 'Office Bawah', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(3, 'Ruang IT', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(4, 'Panel Lost City', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(5, 'Panel Cartoon City', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(6, 'Panel Magic Corner', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(7, 'Ruang Show Basement', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(8, 'Kitchen Basement', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(9, 'Gudang Basement', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(10, 'Studio Mie', '2018-01-24 10:21:43', '2018-01-24 10:21:43'),
(15, 'Studio FriedChicken', '2018-01-31 08:25:10', '2018-01-31 08:25:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_manufaktur`
--

CREATE TABLE `tb_manufaktur` (
  `id` int(11) NOT NULL,
  `manufaktur` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_manufaktur`
--

INSERT INTO `tb_manufaktur` (`id`, `manufaktur`, `created_at`, `modified_at`) VALUES
(1, 'Acer', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(2, 'Canon', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(3, 'TP-Link', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(4, 'Cisco', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(5, 'D-Link', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(6, 'Epson', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(7, 'IBM', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(8, 'Asus', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(9, 'HP', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(10, 'Dell', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(11, 'ICA', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(12, 'Engenius', '2018-01-24 10:22:19', '2018-01-24 10:22:19'),
(13, 'BenQ', '2018-01-25 04:07:32', '2018-01-25 04:07:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_model`
--

CREATE TABLE `tb_model` (
  `id` int(11) NOT NULL,
  `model` varchar(25) NOT NULL,
  `manufaktur` int(3) NOT NULL,
  `kategori` int(3) NOT NULL,
  `catatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_model`
--

INSERT INTO `tb_model` (`id`, `model`, `manufaktur`, `kategori`, `catatan`, `created_at`, `modified_at`) VALUES
(1, 'Aspire 4732Zzzz', 1, 7, 'Catatan-mungkin saja bergunazzzz', '2018-01-24 10:25:24', '2018-01-24 10:25:24'),
(2, 'Aspire 4738Z', 1, 7, 'Laptop Office Standard', '2018-01-24 12:21:36', '2018-01-24 12:21:36'),
(3, 'IP1980', 2, 11, 'Inkjet Printers', '2018-01-24 12:23:06', '2018-01-24 12:23:06'),
(5, 'X163W 16 Inchi', 1, 4, '', '2018-01-25 04:08:06', '2018-01-25 04:08:06'),
(6, 'G610HDA 16 Inch', 13, 4, '', '2018-01-25 04:08:34', '2018-01-25 04:08:34'),
(7, 'IP2770', 2, 11, '', '2018-01-25 04:12:18', '2018-01-25 04:12:18'),
(8, '15 Inch', 10, 4, '', '2018-01-25 04:13:04', '2018-01-25 04:13:04'),
(9, '1008 DE 8 Port', 5, 3, '', '2018-01-25 04:13:25', '2018-01-25 04:13:25'),
(10, 'L220', 6, 11, '', '2018-01-25 04:13:53', '2018-01-25 04:13:53'),
(11, 'PG 40', 2, 12, '', '2018-01-26 11:13:16', '2018-01-26 11:13:16'),
(12, 'CL 41', 2, 12, '', '2018-01-29 06:15:16', '2018-01-29 06:15:16'),
(13, 'PG 810', 2, 12, '', '2018-01-29 06:15:51', '2018-01-29 06:15:51'),
(14, 'CL 811', 2, 12, 'Warna', '2018-01-29 06:16:38', '2018-01-29 06:16:38'),
(15, '60 Black', 9, 12, '', '2018-01-29 09:11:26', '2018-01-29 09:11:26'),
(16, '60 Color', 9, 12, 'Warna', '2018-01-29 09:11:39', '2018-01-29 09:11:39'),
(17, 'Cyan 1000mL', 2, 8, '', '2018-02-03 02:15:54', '2018-02-03 02:15:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemakai`
--

CREATE TABLE `tb_pemakai` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `departemen` int(3) NOT NULL,
  `lokasi` int(3) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `catatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_pemakai`
--

INSERT INTO `tb_pemakai` (`id`, `nama`, `nik`, `departemen`, `lokasi`, `alamat`, `no_telp`, `catatan`, `created_at`, `modified_at`) VALUES
(1, 'fajris', 'f09-0004', 3, 1, 'jl. tamangapa selatan', '08529977945', '', '2018-01-25 07:27:43', '2018-01-25 07:27:43'),
(2, 'Dewis', '', 1, 9, '', '0811ss', '', '2018-01-26 02:58:40', '2018-01-26 02:58:40'),
(3, 'Hendra', '', 3, 1, '', '0', '', '2018-02-04 15:46:45', '2018-02-04 15:46:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe`
--

CREATE TABLE `tb_tipe` (
  `id` int(11) NOT NULL,
  `tipe` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_tipe`
--

INSERT INTO `tb_tipe` (`id`, `tipe`, `created_at`, `modified_at`) VALUES
(1, 'Aset', '2018-01-24 10:23:18', '2018-01-24 10:23:18'),
(2, 'Asesoris', '2018-01-24 10:23:18', '2018-01-24 10:23:18'),
(3, 'Habis Pakai', '2018-01-24 10:23:18', '2018-01-24 10:23:18'),
(4, 'Komponen', '2018-01-24 10:23:18', '2018-01-24 10:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `first_name`, `last_name`) VALUES
(2, 'johnn', 'smit'),
(4, 'joni', 'iskandar'),
(5, 'iwan', 'sumarsan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_departemen`
--
ALTER TABLE `tb_departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_habispakai`
--
ALTER TABLE `tb_habispakai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `model` (`model`);

--
-- Indeks untuk tabel `tb_habispakai_in`
--
ALTER TABLE `tb_habispakai_in`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_habispakai_out`
--
ALTER TABLE `tb_habispakai_out`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indeks untuk tabel `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_manufaktur`
--
ALTER TABLE `tb_manufaktur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_model`
--
ALTER TABLE `tb_model`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pemakai`
--
ALTER TABLE `tb_pemakai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tipe`
--
ALTER TABLE `tb_tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_departemen`
--
ALTER TABLE `tb_departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_habispakai`
--
ALTER TABLE `tb_habispakai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_habispakai_in`
--
ALTER TABLE `tb_habispakai_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_habispakai_out`
--
ALTER TABLE `tb_habispakai_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_manufaktur`
--
ALTER TABLE `tb_manufaktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_model`
--
ALTER TABLE `tb_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_pemakai`
--
ALTER TABLE `tb_pemakai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_tipe`
--
ALTER TABLE `tb_tipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
