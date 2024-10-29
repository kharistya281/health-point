-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 01:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthpoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `user_admin` varchar(20) NOT NULL,
  `ps_admin` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `user_admin`, `ps_admin`) VALUES
(1, 'admin', '38f078a81a2b033d197497af5b77f95b50bfcfb8');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_cust` int(11) NOT NULL,
  `uname_cust` varchar(25) NOT NULL,
  `nama_cust` varchar(40) NOT NULL,
  `ps_cust` varchar(190) NOT NULL,
  `email_cust` varchar(60) NOT NULL,
  `ttl_cust` date NOT NULL,
  `gender_cust` varchar(11) NOT NULL,
  `alamat_cust` text NOT NULL,
  `kota_cust` varchar(70) NOT NULL,
  `notelp_cust` varchar(13) NOT NULL,
  `id_paypal` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cust`, `uname_cust`, `nama_cust`, `ps_cust`, `email_cust`, `ttl_cust`, `gender_cust`, `alamat_cust`, `kota_cust`, `notelp_cust`, `id_paypal`) VALUES
(1, 'kharis', 'Kharisma Agustya', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'khariszahra34@gmail.com', '2001-08-22', 'perempuan', 'Jl. Gunung Anyar Jaya Safira', 'surabaya', '083215467', 8753462);

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE `guest_book` (
  `id_book` int(11) NOT NULL,
  `nama_guest` varchar(100) NOT NULL,
  `email_guest` varchar(100) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest_book`
--

INSERT INTO `guest_book` (`id_book`, `nama_guest`, `email_guest`, `pesan`) VALUES
(1, 'Lala', 'lala@gmail.com', 'Good'),
(2, 'Junpi', 'junpi@gmail.com', 'Waaah sekaliii ');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Cek kesehatan'),
(3, 'Alat pernapasan'),
(4, 'Alat kebugaran'),
(5, 'Refill atau alat pendukung');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `sub_harga` int(11) NOT NULL,
  `berat_satuan` int(11) NOT NULL,
  `subberat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_detail`, `id_order`, `id_produk`, `jumlah`, `harga_satuan`, `sub_harga`, `berat_satuan`, `subberat`) VALUES
(1, 1, 10, 1, 130000, 130000, 600, 600),
(2, 2, 4, 1, 60000, 60000, 340, 340),
(3, 2, 5, 1, 160000, 160000, 80, 80),
(4, 3, 4, 1, 60000, 60000, 340, 340);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id_status`, `nama_status`) VALUES
(1, 'Pembayaran Pending'),
(2, 'Pembayaran Dibatalkan '),
(3, 'Pembayaran Diterima'),
(4, 'Pesanan Diterima'),
(5, 'Pesanan Dikemas'),
(6, 'Pesanan Dikirim'),
(7, 'Diterima'),
(8, 'Dibatalkan'),
(9, 'Ditukar');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_order` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `pembayaran` varchar(30) NOT NULL,
  `provinsi` varchar(40) NOT NULL,
  `kabkota` varchar(40) NOT NULL,
  `tipe_kabkota` varchar(30) NOT NULL,
  `ekspedisi` varchar(20) NOT NULL,
  `layanan` varchar(20) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_order`, `id_cust`, `status`, `order_date`, `total`, `berat`, `metode_pembayaran`, `pembayaran`, `provinsi`, `kabkota`, `tipe_kabkota`, `ekspedisi`, `layanan`, `ongkir`, `estimasi`) VALUES
(1, 1, 4, '2024-10-03', 130000, 600, 'postpaid', 'cash', '', '', '', '', '', 0, ''),
(2, 1, 5, '2024-10-04', 242000, 420, 'prepaid', 'bca', 'Bali', 'Denpasar', 'Kota', 'pos', 'Pos Reguler', 22000, '3 HARI'),
(3, 1, 5, '2024-10-04', 86000, 340, 'prepaid', 'bni', 'Bali', 'Bangli', 'Kabupaten', 'jne', 'REG', 26000, '4-6');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `foto_produk` varchar(80) NOT NULL,
  `harga_produk` int(30) NOT NULL,
  `desc_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kat`, `nama_produk`, `foto_produk`, `harga_produk`, `desc_produk`, `stok_produk`, `berat_produk`) VALUES
(2, 1, 'Easy Touch GCU', '644-easy_touch_gcu.jpg', 250000, 'Adalah sebuah terobosan dalam proses diagnosis darah, karena alat ini mempermudah dan mempercepat hasil pengecekan kadar darah yang penting hanya dalam satu\r\nalat.\r\n\r\nAlat test darah ini mampu mengukur dari sample darah :\r\n1. Kadar Gula Darah\r\n2. Kadar Kolesterol\r\n3. Kadar Asam Urat\r\n\r\nDalam satu set alat test darah EasyTouch GCU ini meliputi :\r\n- 1 buah alat test darah EasyTouch\r\n- 10 buah strip pengecekan gula darah\r\n- 10 buah strip pengecekan asam urat\r\n- 2 buah strip pengecekan kolesterol\r\n- Tas alat\r\n- Lancing device\r\n- 15 Jarum lancet\r\n- 2 buah baterai AAA\r\n- Buku cara penggunaan', 12, 500),
(3, 3, 'Nebulizer Portable', '445-S100581790_1.jpeg', 128000, 'Untuk Anda yang memiliki penyakit yang berkaitan dengan pernapasan, alat terapi pernapasan dari TaffOmicron bisa menjadi solusi. Berfungsi untuk mengubah air menjadi partikel uap yang mampu membantu melegakan pernapasan. Anda juga bisa menggunakannya untuk mengubah obat cair menjadi uap sehingga bisa dihirup dan masuk ke paru-paru. Hadir dengan desain portabel lengkap dengan baterai bawaan rechargeable sehingga mudah untuk dibawa dan digunakan ke mana saja.', 31, 550),
(4, 1, 'Thermogun', '897-a014ea26-3a55-46d3-805a-87a425cc7e1b.jpg', 60000, 'Thermogun merupakan salah satu jenis termometer inframerah untuk mengukur temperatur tubuh yang umumnya diarahkan ke dahi. Memiliki bentuk seperti gagang pistol membuatnya sangat mudah untuk dioperasikan. Dilengkapi layar LCD guna menampilkan suhu yang telah diukur dengan akurat.', 43, 340),
(5, 5, 'Refill Strip Gula Darah', '419-6f3308210b1bbae788486f2ddbbed1f2.jpg_720x720q80.jpg', 160000, 'Satuan Perbotol Isi 25 Strip', 32, 80),
(6, 5, 'Refill Strip Asam Urat', '432-afab3e60-2687-404c-a162-0f2058c71b22.jpg', 110000, 'Satuan Perbotol Isi 25 Strip', 66, 80),
(10, 1, 'Tensimeter Digital', '483-tensi.jpg', 130000, 'Alat ini berfungsi untuk mengetahui detak jantung dan tekanan darah / tensimeter.\r\nDigunakan dengan cara memasang alat sphygmomanometer ini pada pergelangan tangan dan alat ini akan membaca tekanan darah secara perlahan, tunggu beberapa saat untuk mengetahui hasil akhir.\r\nHasil pengukuran akan ditampilkan dalam layar digital', 32, 600),
(11, 5, 'Refill strip kolestrol', '588-26bda7e2-5f7a-4d86-84ff-07fb2952e712.jpg', 170000, 'Satuan Perbotol Isi 10 Strip', 32, 80);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indexes for table `guest_book`
--
ALTER TABLE `guest_book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `kat` (`id_kat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guest_book`
--
ALTER TABLE `guest_book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kat`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
