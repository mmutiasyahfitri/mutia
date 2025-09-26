-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2025 pada 08.47
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_muteg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pemesanan`
--

CREATE TABLE `riwayat_pemesanan` (
  `id_riwayat` int(11) NOT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `alamat_pemesan` text,
  `isi_pesanan` text,
  `total` int(11) DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat_pemesanan`
--

INSERT INTO `riwayat_pemesanan` (`id_riwayat`, `nama_pemesan`, `alamat_pemesan`, `isi_pesanan`, `total`, `tanggal_pesan`) VALUES
(1, 'gita', 'kampung kantil', 'Produk: Cappuccino\nJumlah: 1\nHarga: Rp.22.000', 22000, '2025-09-25 13:42:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(120) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(120) NOT NULL,
  `jenis` enum('minuman') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga`, `gambar`, `jenis`) VALUES
(1, 'Tubruk', 'Kopi tradisional Indonesia dengan rasa khas dan aroma kuat.', 28000, 'uploads/tubruk.jpeg', 'minuman'),
(2, 'Expreso', 'Kopi hitam pekat dengan rasa kuat, cocok untuk penikmat kopi sejati', 35000, 'uploads/kopi.jpg', 'minuman'),
(3, 'Cappuccino', 'Perpaduan espresso, susu, dan foam yang lembut di lidah.', 22000, 'uploads/capucino.jpg', 'minuman'),
(4, 'Latte', 'Kopi susu dengan rasa creamy, cocok untuk semua kalangan.', 25000, 'uploads/latte.avif', ''),
(5, 'Americano', 'Espresso yang dicampur air panas, rasa ringan dan segar.', 20000, 'uploads/americano.jpg', 'minuman'),
(6, 'Mocha', 'Kopi dengan campuran coklat dan susu, manis dan nikmat.', 30000, 'uploads/mocha.jpg', 'minuman'),
(7, 'Affogato ', 'Espresso disiram di atas es krim vanilla, manis dan creamy.\r\n', 28000, 'uploads/Affogato.jpeg', 'minuman'),
(8, 'Macchiato', 'espresso dengan sedikit busa susu di atasnya.\r\n', 22000, 'uploads/Macchiato.jpg', 'minuman'),
(9, 'Piccolo', 'mini latte dengan perbandingan espresso lebih kuat', 25000, 'uploads/Piccolo.jpeg', 'minuman'),
(10, 'Flat White', 'mirip latte tapi tekstur susu lebih halus dan tipis.\r\n', 28000, 'uploads/Flat White.jpeg', 'minuman'),
(11, 'Cortado', 'ampuran espresso dan susu dengan perbandingan 1:1.', 25000, 'uploads/Cortado.jpg', 'minuman'),
(12, 'Ristretto', 'espresso tapi dengan takaran air lebih sedikit, rasa lebih pekat.\r\n', 20000, 'uploads/Ristretto.jpeg', 'minuman'),
(13, 'Lungo', 'kebalikan ristretto, espresso dengan ekstraksi lebih lama, rasa lebih ringan.\r\n', 22000, 'uploads/Lungo.jpg', 'minuman'),
(15, 'Nitro Coffee', 'cold brew diberi nitrogen sehingga teksturnya creamy dan berbusa.\r\n', 32000, 'uploads/Nitro Coffee.jpeg', 'minuman'),
(17, 'Turkish Coffee', 'kopi halus direbus bersama air dan gula di dalam cezve.\r\n', 38000, 'uploads/Turkish Coffee.jpeg', 'minuman'),
(18, 'Kopi Susu Gula Aren', 'kopi hitam dengan susu segar dan gula aren.\r\n', 18000, 'uploads/Kopi Susu Gula Aren.jpeg', 'minuman'),
(19, 'Frappe Coffee', 'kopi instan, gula, dan susu dikocok hingga berbusa, khas Yunani.\r\n', 32000, 'uploads/Frappe Coffee.jpeg', 'minuman'),
(20, 'Mazagran', 'opi dingin khas Portugal dengan tambahan lemon', 25000, 'uploads/Mazagran.jpeg', 'minuman'),
(21, 'Cofe Bombon', 'espresso dengan susu kental manis (umumnya disajikan berlapis).\r\n', 20000, 'uploads/Cofe Bombon.jpeg', 'minuman'),
(22, 'Kopi Tarik', 'kopi dan susu kental manis ditarik-tarik untuk menghasilkan buih, khas Malaysia.\r\n', 18000, 'uploads/Kopi Tarik.jpeg', 'minuman'),
(23, 'Cold Brew', 'kopi di seduh dingin dengan air suhu ruang.', 30000, 'uploads/Cold Brew.jpeg', 'minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_riwayat`
--

CREATE TABLE `tb_riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `alamat_pemesan` varchar(100) NOT NULL,
  `detail_pemesan` text NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `batas_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `role_id`) VALUES
(1, 'mutia', 'mutiasyahfitrim@gmail.com', '123', 2),
(123, 'panjol', 'panjol@gmail.com', '1234', 0),
(124, 'mutia', 'hui@gmail.com', '123', 2),
(125, 'wahyu', 'wayy@gmail.com', '123', 2),
(126, 'abi', 'abi@gmail.com', '123', 2),
(127, 'hiu', 'hiu@gmail.com', '123', 2),
(128, 'Yura', 'yura@gmail.com', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD CONSTRAINT `tb_transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id`),
  ADD CONSTRAINT `tb_transaksi_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
