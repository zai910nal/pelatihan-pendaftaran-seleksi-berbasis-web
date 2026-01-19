-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2026 pada 06.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelatihan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `nama_berkas` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status_berkas` enum('valid','tidak_valid') DEFAULT 'tidak_valid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `id_pendaftaran`, `nama_berkas`, `file_path`, `status_berkas`) VALUES
(3, 8, 'CV', 'uploads/berkas/0e38124d04fe12cac828682e5af534d3.pdf', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_seleksi`
--

CREATE TABLE `jadwal_seleksi` (
  `id_jadwal` int(11) NOT NULL,
  `id_pendaftaran` int(11) DEFAULT NULL,
  `tanggal_seleksi` date NOT NULL,
  `jam_seleksi` time DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `status_hadir` enum('belum','sudah') NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_seleksi`
--

INSERT INTO `jadwal_seleksi` (`id_jadwal`, `id_pendaftaran`, `tanggal_seleksi`, `jam_seleksi`, `lokasi`, `status_hadir`) VALUES
(1, 8, '2026-12-02', NULL, 'Zoom', 'belum'),
(3, 8, '2026-02-10', NULL, 'Lapangan', 'belum'),
(5, 11, '2025-12-12', '12:00:00', 'Lapangan', 'belum'),
(7, 13, '2026-02-01', '22:25:00', 'Lab 1 ', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `isi_notifikasi` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_peserta`, `isi_notifikasi`, `tanggal`) VALUES
(5, 6, 'Selamat! Anda LULUS seleksi. Silakan cek menu Jadwal Seleksi untuk info lokasi & waktu.', '2026-01-18'),
(6, 6, 'Selamat! Anda LULUS seleksi. Silakan cek menu Jadwal Seleksi untuk info lokasi & waktu.', '2026-01-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id_pelatihan` int(11) NOT NULL,
  `nama_pelatihan` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelatihan`
--

INSERT INTO `pelatihan` (`id_pelatihan`, `nama_pelatihan`, `deskripsi`, `kuota`) VALUES
(1, 'Pelatihan Web Developer', NULL, 0),
(2, 'Pelatihan Data Analyst', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_pelatihan` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `status_verifikasi` enum('menunggu','diterima','ditolak') DEFAULT 'menunggu',
  `status_seleksi` enum('menunggu','lulus','tidak lulus') NOT NULL DEFAULT 'menunggu',
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `persentase_lulus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_peserta`, `id_pelatihan`, `tanggal_daftar`, `status_verifikasi`, `status_seleksi`, `nama_lengkap`, `email`, `no_hp`, `alamat`, `berkas`, `persentase_lulus`) VALUES
(8, 5, 1, '2026-01-18', 'ditolak', 'menunggu', 'peserta1', 'zainalarifin0128@gmail.com', '085648327270', 'Kerajaan Majapahit', '1dc5ad421e492e8c5559d4b80365f347.pdf', 0),
(9, 5, 1, '2026-01-18', 'ditolak', 'menunggu', 'zlow', 'zanaf2801@gmail.com', '08564832729', 'Kerajaan Pemberkatan', 'e0168b1e67adc027005e53ffe409c9cf.jpg', 0),
(10, 5, 1, '2026-01-18', 'diterima', 'menunggu', 'zlow', 'zanaf2801@gmail.com', '08564832729', 'Kerajaan Pemberkatan', 'e0168b1e67adc027005e53ffe409c9cf.jpg', 70),
(11, 5, 1, '2026-01-18', 'diterima', 'menunggu', 'Angger', 'Angungperrum@gmail.com', '08534194', 'Kehidupan', '8c40528293fd70c95212deede63c9351.jpg', 70),
(13, 6, 1, '2026-01-18', 'diterima', 'lulus', 'zainal as', 'zanaf2801@gmail.com', '05992872712', 'Kerajaan lyonforest', 'f5665f39d20c381d808a1e153c5b0f08.jpg', 70);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_user`, `nama_lengkap`, `email`, `no_hp`, `alamat`) VALUES
(5, 9, 'Peserta 1', 'peserta@gmail.com', '08123456789', 'Alamat'),
(6, 10, 'Zainal', 'za522077@gmail.com', '0887619279', 'Kendal'),
(7, 11, 'YOGI', 'za522077@gmail.com', '0989782', 'Klaten');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seleksi`
--

CREATE TABLE `seleksi` (
  `id_seleksi` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `hasil` enum('lulus','tidak_lulus') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','panitia','peserta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(6, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(9, 'peserta1', 'e10adc3949ba59abbe56e057f20f883e', 'peserta'),
(10, 'zainal', '81dc9bdb52d04dc20036dbd8313ed055', 'peserta'),
(11, 'Budi', '43c10ff41a7b9426502ac9414ee61e4c', 'peserta');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`),
  ADD KEY `fk_berkas_pendaftaran` (`id_pendaftaran`);

--
-- Indeks untuk tabel `jadwal_seleksi`
--
ALTER TABLE `jadwal_seleksi`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_js_pendaftaran` (`id_pendaftaran`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `fk_notifikasi_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id_pelatihan`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `fk_pendaftaran_peserta` (`id_peserta`),
  ADD KEY `fk_pendaftaran_pelatihan` (`id_pelatihan`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `fk_peserta_user` (`id_user`);

--
-- Indeks untuk tabel `seleksi`
--
ALTER TABLE `seleksi`
  ADD PRIMARY KEY (`id_seleksi`),
  ADD KEY `fk_seleksi_pendaftaran` (`id_pendaftaran`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal_seleksi`
--
ALTER TABLE `jadwal_seleksi`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id_pelatihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `seleksi`
--
ALTER TABLE `seleksi`
  MODIFY `id_seleksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `fk_berkas_pendaftaran` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_seleksi`
--
ALTER TABLE `jadwal_seleksi`
  ADD CONSTRAINT `fk_js_pendaftaran` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `fk_notifikasi_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `fk_pendaftaran_pelatihan` FOREIGN KEY (`id_pelatihan`) REFERENCES `pelatihan` (`id_pelatihan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pendaftaran_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `fk_peserta_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `seleksi`
--
ALTER TABLE `seleksi`
  ADD CONSTRAINT `fk_seleksi_pendaftaran` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
