-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221219.e5e070c814
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2023 pada 06.35
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id_kamar` varchar(255) NOT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `harga_kamar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `tipe_kamar`, `harga_kamar`) VALUES
('K001', 'Standard', '500.000'),
('K002', 'Superior', '1.000.000'),
('K003', 'Deluxe', '2.000.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_telp`, `alamat`) VALUES
('PL001', 'Bambang', '0845721398', 'Jakarta Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` varchar(255) NOT NULL,
  `id_pemesanan` varchar(255) NOT NULL,
  `id_kamar` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `total_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pemesanan`, `id_kamar`, `metode_pembayaran`, `total_pembayaran`) VALUES
('PB001', 'PS001', 'K001', 'Tunai', '1,000,000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` varchar(255) NOT NULL,
  `id_pelanggan` varchar(255) NOT NULL,
  `id_kamar` varchar(255) NOT NULL,
  `jumlah_kamar` int(11) DEFAULT NULL,
  `lama_menginap` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `id_pelanggan`, `id_kamar`, `jumlah_kamar`, `lama_menginap`) VALUES
('PS001', 'PL001', 'K001', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `FK_PEMESANAN` (`id_pemesanan`);

--
-- Indeks untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `FK_PELANGGAN` (`id_pelanggan`),
  ADD KEY `FK_KAMAR` (`id_kamar`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `FK_PEMESANAN` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`);

--
-- Ketidakleluasaan untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `FK_KAMAR` FOREIGN KEY (`id_kamar`) REFERENCES `tb_kamar` (`id_kamar`),
  ADD CONSTRAINT `FK_PELANGGAN` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
