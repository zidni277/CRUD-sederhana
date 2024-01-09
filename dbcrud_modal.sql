-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 04:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcrud_modal`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `createmahasiswa` ()   BEGIN
 INSERT INTO mahasiswa(id_mahasiswa, nim, nama, alamat, prodi) VALUES (id_mahasiswa, nim, nama, alamat, prodi);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `createorganisasi` ()   BEGIN
INSERT INTO organisasi(kd_organisasi, nama_organisasi, jabatan) VALUES (kd_organisasi, nama_organisasi, jabatan);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `totaldata` () RETURNS INT(11)  BEGIN
DECLARE total INT;
SELECT COUNT(*) INTO total FROM mahasiswa;
RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_mahasiswa`
-- (See below for the actual view)
--
CREATE TABLE `data_mahasiswa` (
`nim` varchar(15)
,`nama` varchar(150)
,`alamat` varchar(150)
,`prodi` varchar(25)
,`nama_organisasi` varchar(30)
,`jabatan` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `kd_organisasi` char(5) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `kd_organisasi`, `keterangan`, `id_mahasiswa`) VALUES
(6, '01bk', 'INSERT', 55),
(7, '02sk', 'INSERT', 56);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `prodi` varchar(25) NOT NULL,
  `kd_organisasi` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `alamat`, `prodi`, `kd_organisasi`) VALUES
(55, '32602200091', 'Manar Nuha Afifah', 'Banyumas', 'S1 Teknik Informatika', '01bk'),
(56, '32602200091', 'Moh Zidni Ilman Nafia', 'Brebes', 'S1 Teknik Informatika', '02sk');

--
-- Triggers `mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `tambah_mahasiswa` AFTER INSERT ON `mahasiswa` FOR EACH ROW BEGIN
INSERT INTO laporan(id_mahasiswa, kd_organisasi, keterangan) VALUES(NEW.id_mahasiswa, NEW.kd_organisasi, "INSERT");
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `kd_organisasi` char(5) NOT NULL,
  `nama_organisasi` varchar(30) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`kd_organisasi`, `nama_organisasi`, `jabatan`, `keterangan`) VALUES
('01bk', 'bem', 'ketua', NULL),
('02sk', 'sema', 'katua', NULL);

-- --------------------------------------------------------

--
-- Structure for view `data_mahasiswa`
--
DROP TABLE IF EXISTS `data_mahasiswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_mahasiswa`  AS SELECT `mahasiswa`.`nim` AS `nim`, `mahasiswa`.`nama` AS `nama`, `mahasiswa`.`alamat` AS `alamat`, `mahasiswa`.`prodi` AS `prodi`, `organisasi`.`nama_organisasi` AS `nama_organisasi`, `organisasi`.`jabatan` AS `jabatan` FROM (`mahasiswa` join `organisasi` on(`mahasiswa`.`kd_organisasi` = `organisasi`.`kd_organisasi`)) WHERE `mahasiswa`.`kd_organisasi` = `organisasi`.`kd_organisasi` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `FK_mahasiswa_organisasi` (`kd_organisasi`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`kd_organisasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `FK_mahasiswa_organisasi` FOREIGN KEY (`kd_organisasi`) REFERENCES `organisasi` (`kd_organisasi`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
