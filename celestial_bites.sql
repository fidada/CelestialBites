-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 06:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `celestial_bites`
--
CREATE DATABASE IF NOT EXISTS `celestial_bites` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `celestial_bites`;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

DROP TABLE IF EXISTS `meja`;
CREATE TABLE `meja` (
  `id_meja` varchar(50) NOT NULL,
  `harga_meja` float DEFAULT NULL,
  `status` enum('tersedia','tidak tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `harga_meja`, `status`) VALUES
('A1', 35000, 'tidak tersedia'),
('A2', 35000, 'tersedia'),
('A3', 35000, 'tersedia'),
('A4', 35000, 'tersedia'),
('A5', 35000, 'tersedia'),
('B1', 25000, 'tersedia'),
('B2', 25000, 'tersedia'),
('B3', 25000, 'tersedia'),
('B4', 25000, 'tersedia'),
('C1', 25000, 'tersedia'),
('C2', 25000, 'tersedia'),
('C3', 25000, 'tersedia'),
('C4', 25000, 'tersedia'),
('C5', 25000, 'tersedia'),
('D1', 30000, 'tersedia'),
('D2', 30000, 'tersedia'),
('D3', 30000, 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori` enum('makanan','minuman') NOT NULL,
  `harga_produk` decimal(10,2) NOT NULL,
  `gambar_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `harga_produk`, `gambar_produk`) VALUES
(1, 'Cookie', 'makanan', '10000.00', 'cookie.jpg'),
(2, 'Ice Cream', 'makanan', '15000.00', 'ice_cream.jpg'),
(3, 'Nasi Kuning Lapis Emas', 'makanan', '600000.00', 'naskun.jpg'),
(5, 'Sugar Boba', 'minuman', '33000.00', 'boba.jpg'),
(6, 'burger bangor', 'makanan', '37000.00', 'burger.jpg'),
(7, 'fruitea', 'minuman', '7000.00', 'fruitea.jpg'),
(15, 'Swedish Meatballs', 'makanan', '44000.00', 'swedish_meatball.jpg'),
(16, 'Brownie Milkshake', 'minuman', '24000.00', 'brownie_milkshake.jpg'),
(17, 'Nacho', 'makanan', '24000.00', 'nacho.jpg'),
(18, 'Shrimp Tempura', 'makanan', '23000.00', '66ffea66b07a8_shrimp_tempura.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

DROP TABLE IF EXISTS `reservasi`;
CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_meja` varchar(50) DEFAULT NULL,
  `tanggal_reservasi` date NOT NULL,
  `waktu_reservasi` time NOT NULL,
  `harga_meja` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `user_id`, `id_meja`, `tanggal_reservasi`, `waktu_reservasi`, `harga_meja`) VALUES
(73, 8, 'A1', '2024-02-02', '20:20:00', 35000),
(74, 8, 'C1', '2024-02-02', '12:12:00', 35000),
(75, 8, 'D1', '2024-02-02', '12:12:00', 30000),
(76, 8, 'A5', '2024-02-02', '12:12:00', 35000),
(77, 8, 'A4', '2024-02-02', '12:12:00', 35000),
(78, 8, 'B1', '2024-10-01', '12:12:00', 25000),
(84, 8, 'C2', '2012-12-12', '12:12:00', 25000),
(87, 8, 'A4', '2024-10-11', '12:12:00', 35000),
(91, 8, 'B1', '2024-10-11', '20:58:00', 25000),
(93, 16, 'B2', '2024-10-06', '20:37:00', 25000),
(96, 8, 'A3', '2024-10-08', '07:00:00', 35000),
(97, 16, 'A1', '2024-10-10', '12:12:00', 35000);

--
-- Triggers `reservasi`
--
DROP TRIGGER IF EXISTS `after_reservasi_delete`;
DELIMITER $$
CREATE TRIGGER `after_reservasi_delete` AFTER DELETE ON `reservasi` FOR EACH ROW BEGIN
    UPDATE meja
    SET status = 'tersedia'
    WHERE id_meja = OLD.id_meja;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_reservasi_insert`;
DELIMITER $$
CREATE TRIGGER `before_reservasi_insert` BEFORE INSERT ON `reservasi` FOR EACH ROW BEGIN
    DECLARE meja_status ENUM('tersedia', 'tidak tersedia');

    -- Retrieve the status of the table being reserved
    SELECT status INTO meja_status
    FROM meja
    WHERE id_meja = NEW.id_meja;

    -- If the table status is 'tidak tersedia', signal an error
    IF meja_status = 'tidak tersedia' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Cannot make a reservation. The table is not available.';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_table_status_after_reservation`;
DELIMITER $$
CREATE TRIGGER `update_table_status_after_reservation` AFTER INSERT ON `reservasi` FOR EACH ROW BEGIN
    UPDATE meja
    SET status = 'tidak tersedia'
    WHERE id_meja = NEW.id_meja;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_reservasi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_reservasi`, `id_produk`, `jumlah_pesanan`, `subtotal`) VALUES
(21, 73, 3, 2, 1200000),
(22, 74, 3, 2, 1200000),
(23, 75, 3, 3, 1800000),
(24, 76, 6, 5, 385000),
(25, 78, 1, 2, 20000),
(26, NULL, NULL, 3, 3),
(27, 73, 1, 3, 65000),
(28, 74, 5, 3, 124000),
(29, 76, 1, 1, 45000),
(30, 76, 1, 6, 60000),
(31, 74, 1, 2, 45000),
(32, NULL, 1, 2, 45000),
(33, NULL, 2, 2, 55000),
(34, 73, 1, 2, 45000),
(35, 74, 2, 3, 45000),
(36, 73, 2, 1, 50000),
(37, 74, 1, 2, 45000),
(43, 84, 2, 1, 15000),
(45, 87, 2, 3, 45000),
(46, 91, 2, 5, 75000),
(47, 91, 1, 1, 10000),
(50, 93, 5, 2, 66000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `role` enum('customer','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `nama`, `email`, `password`, `alamat`, `no_telp`, `role`) VALUES
(8, 'bilqis', 'bilqis', 'bilqis@smk.id', '$2y$10$wvXCK9oBkLSmCWVr643EdeeDvAYENCt/5WwsxWekBk0F5EvWUYW8O', 'St. bilqis', '123', 'customer'),
(12, 'admin', 'Admin', 'admin@celestialbites.id', '$2y$10$gn.Makbak7JRUris00aoreSzk/2xCaHmxZVG.goUtt2LWoXQhAcvm', 'St. Celestial', '090909', 'admin'),
(16, 'BilqisMufida', 'Bilqis Mufida', 'bilqis@smk.123', '$2y$10$0.XJa1H7d3j/RFVhl8jC7uXThhLYqlKSTE.KA1dpPPbrSzVfyVFpK', 'Jl. Kemang', '08123', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `harga_meja` (`harga_meja`),
  ADD KEY `fk_harga_meja` (`id_meja`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `fk_reservasi_transaksi` (`id_reservasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `fk_harga_meja` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_ibfk_2` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`),
  ADD CONSTRAINT `reservasi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_reservasi_transaksi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi` (`id_reservasi`),
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi` (`id_reservasi`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
