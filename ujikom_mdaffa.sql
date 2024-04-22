-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 12:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_mdaffa`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `price`, `stock`, `image`) VALUES
(6, 'Spaghettii', 25000, 7, 'spaghetti-saus-ikan.png'),
(7, 'Kerang Balado', 45000, 10, 'balado-kerang-pedas.png'),
(8, 'Bebek Goreng', 15000, 9, 'bebek-goreng-ijo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` int(11) NOT NULL,
  `no_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_product` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `no_order`, `id_user`, `qty`, `total`, `bayar`, `kembalian`, `tanggal`, `id_product`, `customer_name`, `order_type`, `price`, `total_harga`) VALUES
(20, 6, 1, 1, 1, 25000, 5000, '2024-04-22 09:01:26', 6, 'Radif', 'Dine_In', 25000, 25000),
(21, 7, 1, 2, 1, 90000, 10000, '2024-04-22 09:02:17', 7, 'acomg', 'Dine_In', 45000, 90000),
(22, 8, 1, 2, 1, 90000, 0, '2024-04-22 09:08:21', 7, 'iki', 'To_Go', 45000, 90000),
(23, 9, 1, 1, 1, 45000, 0, '2024-04-22 09:09:29', 7, 'iki', 'Dine_In', 45000, 45000),
(24, 10, 1, 1, 1, 15000, 40000, '2024-04-22 09:28:37', 8, 'dika', 'Dine_In', 15000, 15000),
(25, 10, 1, 1, 1, 15000, 40000, '2024-04-22 09:28:37', 7, 'dika', 'Dine_In', 45000, 45000),
(26, 11, 1, 1, 1, 45000, 5000, '2024-04-22 09:59:06', 7, 'iki', 'Dine_In', 45000, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_users`, `name`, `username`, `password`) VALUES
(1, 'daffa', 'daoa', 'awd'),
(4, 'Fathi', 'jawir', 'awd'),
(5, 'Radif', 'radip', 'awd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
