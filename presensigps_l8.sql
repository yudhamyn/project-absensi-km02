-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2023 pada 18.01
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensigps_l8`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_absensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pegawai` int(11) NOT NULL,
  `jumlah_pegawai_masuk` int(11) DEFAULT NULL,
  `jumlah_pegawai_pulang` int(11) DEFAULT NULL,
  `jumlah_izin` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tgl_absen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `kode_absensi`, `jumlah_pegawai`, `jumlah_pegawai_masuk`, `jumlah_pegawai_pulang`, `jumlah_izin`, `total`, `tgl_absen`) VALUES
(1, 't9lpkN3xThw4nWtZlIRR', 1, 1, NULL, NULL, 1, '02-Sep-2023'),
(2, '7Ava1fDN6seNHvPYgbGF', 1, NULL, NULL, NULL, NULL, '27-Oct-2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_detail`
--

CREATE TABLE `absensi_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_absensi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `absen_masuk` int(11) DEFAULT NULL,
  `status_masuk` int(11) DEFAULT NULL,
  `latitude_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `absen_pulang` int(11) DEFAULT NULL,
  `status_pulang` int(11) DEFAULT NULL,
  `latitude_pulang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_pulang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `status_izin` int(11) DEFAULT NULL,
  `alasan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_izin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pulang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi_detail`
--

INSERT INTO `absensi_detail` (`id`, `kode_absensi`, `pegawai_id`, `absen_masuk`, `status_masuk`, `latitude_masuk`, `longitude_masuk`, `absen_pulang`, `status_pulang`, `latitude_pulang`, `longitude_pulang`, `izin`, `status_izin`, `alasan`, `bukti_izin`, `bukti_masuk`, `bukti_pulang`) VALUES
(1, 't9lpkN3xThw4nWtZlIRR', 1, 1693624312, 1, '-6.4056992', '106.8413392', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hjTGFmmXOrjuewP.png', NULL),
(2, '7Ava1fDN6seNHvPYgbGF', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `gambar`, `role`) VALUES
(1, 'presensi8', 'presensi8@gmail.com', 'presensi812345', 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`) VALUES
(8, 'Partimer'),
(9, 'Marketing Direktur'),
(10, 'Kepala Sekertaris'),
(11, 'Marketing staff'),
(12, 'Admission Staff'),
(13, 'Staff Event');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan_id`, `email`, `password`, `gambar`, `is_active`, `role`) VALUES
(1, '081294016619', 'vani panjaya', 'Perempuan', 8, 'vanipanjaya15@gmail.com', '081294016619', '/G4P78ngHcRC4VtRllIDfFs8DPsh4SWH5VKEOLgj0.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jam_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batas_jarak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `jam_masuk`, `jam_keluar`, `latitude`, `longitude`, `batas_jarak`) VALUES
(1, '10:00', '19:05', '-6.4057007', '106.8413368', 40);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `absensi_kode_absensi_unique` (`kode_absensi`);

--
-- Indeks untuk tabel `absensi_detail`
--
ALTER TABLE `absensi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_nip_unique` (`nip`),
  ADD UNIQUE KEY `pegawai_email_unique` (`email`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `absensi_detail`
--
ALTER TABLE `absensi_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
