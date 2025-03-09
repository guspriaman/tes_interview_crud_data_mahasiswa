-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2025 at 07:34 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahasiswa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_baru`
--

CREATE TABLE `mahasiswa_baru` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Male','Female') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa_baru`
--

INSERT INTO `mahasiswa_baru` (`id`, `nama`, `nim`, `jurusan`, `jenis_kelamin`, `created_at`) VALUES
(1, 'guspri', '100000', 'sistem informasi', 'Female', '2025-03-08 19:29:23'),
(13, 'tess', '100000624623', 'teknik informasi', 'Female', '2025-03-08 19:36:29'),
(14, 'guspri warasi', '2622423', 'sistem informasi', 'Female', '2025-03-08 19:38:22'),
(17, 'guspri', '1000005252', 'sistem informasi', 'Female', '2025-03-08 19:44:02'),
(26, 'guspri', '1000002352352', 'sistem informasi', 'Male', '2025-03-08 19:49:08'),
(44, 'guspri warasi', '10000036', 'sistem informasi', 'Male', '2025-03-08 19:53:09'),
(45, 'gssva', '52332424', 'sistem informasi', 'Female', '2025-03-08 19:58:36'),
(46, 'guspri', '100000625242', 'sistem informasi', 'Male', '2025-03-08 20:03:47'),
(47, 'teeeee', '10000062235432', 'teknik informasi', 'Male', '2025-03-08 20:10:32'),
(49, 'tesss gus', '1000005', 'teknik informasi', 'Male', '2025-03-09 19:16:42'),
(50, 'guspri', '10000062534324', 'sistem informasi', 'Female', '2025-03-09 19:20:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa_baru`
--
ALTER TABLE `mahasiswa_baru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa_baru`
--
ALTER TABLE `mahasiswa_baru`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
