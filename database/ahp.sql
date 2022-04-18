-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Mar 2022 pada 13.22
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(256) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `kelas`, `nama_lengkap`, `nis`, `tmp_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`) VALUES
(2, 'Kelas Satu', 'Audy Ruslan', '123213123', 'Lemo', '2022-12-31', 'Laki-laki', 'Tondo'),
(3, 'Kelas Satu', 'Aldair', '123', 'Palu', '2022-12-31', 'Laki-laki', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama_kriteria`, `bobot_kriteria`) VALUES
(2, 'Sikap', 0.24337955606914125),
(3, 'Akademi', 0.6056983966488525),
(4, 'Abensi', 0.11698926284366075),
(5, 'EKstrakulikuler', 0.0339327844383455);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `jum_nilai` double NOT NULL,
  `ket_nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_awal`
--

CREATE TABLE `nilai_awal` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` double NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `periode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_awal`
--

INSERT INTO `nilai_awal` (`id`, `id_alternatif`, `nilai`, `keterangan`, `periode`) VALUES
(21, 2, 88, 'A', '2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_awal_detail`
--

CREATE TABLE `nilai_awal_detail` (
  `id_nilai_awal_detail` int(11) NOT NULL,
  `id_nilai_awal` int(11) NOT NULL,
  `id_kriteria` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_awal_detail`
--

INSERT INTO `nilai_awal_detail` (`id_nilai_awal_detail`, `id_nilai_awal`, `id_kriteria`, `nilai`) VALUES
(1, 21, '2', 88),
(2, 21, '3', 88),
(3, 21, '4', 88),
(4, 21, '5', 88);

-- --------------------------------------------------------

--
-- Struktur dari tabel `preferensi`
--

CREATE TABLE `preferensi` (
  `id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `keterangan_nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `preferensi`
--

INSERT INTO `preferensi` (`id`, `nilai`, `keterangan_nilai`) VALUES
(3, 9, 'Satu elemen lebih mutlak penting dari pada elemen lainnya'),
(4, 7, 'Satu elemen jelas lebih mutlak penting dari pada elemen lainnya '),
(5, 5, 'Elemen yang satu lebih penting dari pada elemen lainnya'),
(6, 3, 'Elemen yang satu sedikit lebih penting dari pada elemen lainnya'),
(7, 1, 'Kedua elemen sama pentingnya'),
(8, 0, ''),
(9, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jabatan` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `img_dir` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `nama_lengkap`, `jabatan`, `role_id`, `img_dir`, `password`) VALUES
(3, 'audy', 'Audy Ruslan', 'Kepala Sekolah', 1, 'image/1646763634.png', '$2y$10$duJrc/32dvHczAl8h8jR6uIK5ygluKwZfIUktNPdmsWFxEYOBR4/C'),
(4, 'fadli', 'Fadli Nur Zaman', 'Kepala Sekolah', 1, 'image/1646764694.png', '$2y$10$.JzL1ZYpyTouSAcks8xEq.bQwSZ8UvwmI9odBD3AGeXURvHc3xY7q');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `nilai_awal`
--
ALTER TABLE `nilai_awal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_awal_detail`
--
ALTER TABLE `nilai_awal_detail`
  ADD PRIMARY KEY (`id_nilai_awal_detail`);

--
-- Indeks untuk tabel `preferensi`
--
ALTER TABLE `preferensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_awal`
--
ALTER TABLE `nilai_awal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `nilai_awal_detail`
--
ALTER TABLE `nilai_awal_detail`
  MODIFY `id_nilai_awal_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `preferensi`
--
ALTER TABLE `preferensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
