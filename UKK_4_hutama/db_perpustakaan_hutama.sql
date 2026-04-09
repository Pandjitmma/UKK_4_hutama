-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Apr 2026 pada 02.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(255) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `kategori` varchar(20) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `stok`, `kategori`, `sinopsis`) VALUES
(1, NULL, 'lexy', 'pt indo agus', 32, 'adalah', ''),
(2, 'agusss', 'atgus', 'pt', 90, '', ''),
(3, 'www', 'wwww', 'www', 1, 'Sains', 'ww'),
(4, 'www', 'wwww', 'www', 1, 'Sains', 'ww'),
(5, 'www', 'wwww', 'www', 1, 'Sains', ''),
(6, 'www', 'wwww', 'www', 1, 'Sains', ''),
(7, 'putra', 'tama', 'pt ', 14, 'Fiksi', 'seorang putra sedang ee'),
(8, 'jjiji', 'jij', 'www', 3, 'Sains', ''),
(10, 'hhfhfhf', 'hfhfhfhfhhfhhf', 'gfgfgfg67', 7777, 'Sains', ''),
(11, 'hhfhfhf', 'hfhfhfhfhhfhhf', 'gfgfgfg67', 7777, 'Sains', ''),
(12, 'hhfhfhf', 'hfhfhfhfhhfhhf', 'gfgfgfg67', 7777, 'Sains', ''),
(13, 'hhfhfhf', 'hfhfhfhfhhfhhf', 'gfgfgfg67', 7777, 'Sains', ''),
(15, 'www', 'hhhhjj', 'iiii', 33, 'Sains', ''),
(16, 'aku niga', 'outra', 'iaoipo', 88, 'Sains', ''),
(18, NULL, 'zz', 'pt na', 89, '', ''),
(19, NULL, 'jiji', 'pt na', 89, '', ''),
(20, NULL, 'jijifffffff', 'pt na', 89, '', ''),
(21, NULL, 'klkl', 'pt na', 89, '', ''),
(22, 'ghhg', 'klkl', 'pt na', 89, '', ''),
(23, 'gugur bunga', 'klkl', 'pt na', 89, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_transaksi` enum('tunggu','di pinjam','dikembalikan','di tolak') DEFAULT 'tunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status_transaksi`) VALUES
(39, 18, 1, '2026-04-02', NULL, 'di tolak'),
(40, 18, 2, '2026-04-02', '2026-04-02', 'dikembalikan'),
(41, 18, 2, '2026-04-02', NULL, 'di tolak'),
(42, 1, 1, '2026-04-02', '2026-04-07', 'dikembalikan'),
(43, 18, 2, '2026-04-06', '2026-04-07', 'dikembalikan'),
(44, 18, 6, '2026-04-07', '2026-04-07', 'dikembalikan'),
(45, 1, 23, '2026-04-08', '2026-04-08', 'dikembalikan'),
(46, 18, 1, '2026-04-08', '2026-04-08', 'dikembalikan'),
(47, 18, 7, '2026-04-08', NULL, 'di pinjam'),
(48, 18, 23, '2026-04-08', '2026-04-08', 'dikembalikan'),
(49, 18, 2, '2026-04-09', NULL, 'tunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL,
  `status_anggota` enum('true','false') DEFAULT 'false',
  `tanggal_gabung` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status_anggota`, `tanggal_gabung`) VALUES
(1, 'tama', 'nij', '', 'admin', 'true', '2026-04-07 12:20:10'),
(2, 'tamapan', 'm pandji', '', 'admin', 'true', '2026-04-07 12:20:10'),
(3, 'harlan', 'vok', '', 'siswa', 'true', '2026-04-07 12:20:10'),
(10, 'hihih', 'ujyyy', '', 'siswa', 'true', '2026-04-07 12:20:10'),
(17, 'hutama', 'tama17', 'tamatama', 'siswa', 'false', '2026-04-07 12:20:10'),
(18, 'gua', 'guga', 'guga123', 'siswa', 'false', '2026-04-07 12:20:10'),
(19, 'darioh', 'gosr', 'yas', 'siswa', 'false', '2026-04-07 12:20:10'),
(22, 'kkkk', 'gugi', '12', 'siswa', 'false', '2026-04-07 12:20:10'),
(23, 'fffuuf', 'opi', 'guga123', 'siswa', 'false', '2026-04-07 12:20:10'),
(24, 'hutus', 'kolot', 'guga123', 'siswa', 'false', '2026-04-07 12:20:10'),
(25, 'asep', 'pp', 'guga123', 'siswa', 'false', '2026-04-07 12:20:10'),
(26, 'mochammad pandji hutama', 'mochammad pandji hutama', '2323', 'siswa', 'false', '2026-04-08 08:44:23'),
(29, 'mochammad pandji hutama', 'mochammad pandji ', '2323', 'siswa', 'false', '2026-04-08 08:45:01'),
(31, 'mata', 'tama1', '2323', 'siswa', 'false', '2026-04-08 08:48:38'),
(32, 'rehk', 'pioi', 'hujan', 'siswa', 'false', '2026-04-08 08:51:04'),
(33, 'hutama', 'pandji', '2323', 'siswa', 'false', '2026-04-08 08:52:40'),
(35, 'hutama', 'pandji1', '2323', 'siswa', 'false', '2026-04-08 08:53:11'),
(36, 'huatamapandji', 'pandji7', '2323', 'siswa', 'false', '2026-04-08 08:53:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
