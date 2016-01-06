-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2013 at 07:27 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `absenkampusdb`
--
CREATE DATABASE IF NOT EXISTS `absenkampusdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `absenkampusdb`;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `limit_absen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`limit_absen`) VALUES
('10');

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_dosen`
--

CREATE TABLE IF NOT EXISTS `data_absen_dosen` (
  `id_data` int(10) NOT NULL AUTO_INCREMENT,
  `id_jadwal` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_mhs`
--

CREATE TABLE IF NOT EXISTS `data_absen_mhs` (
  `id_data` int(10) NOT NULL AUTO_INCREMENT,
  `id_jadwal` varchar(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nid` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `photo` varchar(80) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nid`, `nama`, `umur`, `photo`) VALUES
('0123', 'Faty GN', '32', '0123.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kuliah`
--

CREATE TABLE IF NOT EXISTS `jadwal_kuliah` (
  `id_jadwal` int(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwal`, `tanggal`, `jam_mulai`, `kode_jurusan`, `kode_kelas`, `nid`, `semester`, `kode_mata_kuliah`) VALUES
(3, '2013-08-13', '23:57:00', '1', '1', '0123', '3', '1'),
(4, '2013-11-06', '01:18:00', '1', '1', '0123', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `kode_jurusan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(40) NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
(1, 'Komputer Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kode_kelas` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
(1, 'MI1A');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `photo` varchar(80) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `umur`, `kode_jurusan`, `photo`) VALUES
('123', 'Mariati', '23', '1', '123.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `kode_mata_kuliah` int(10) NOT NULL AUTO_INCREMENT,
  `nama_mata_kuliah` varchar(60) NOT NULL,
  PRIMARY KEY (`kode_mata_kuliah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mata_kuliah`, `nama_mata_kuliah`) VALUES
(1, 'Sistem Basis Data');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `login_hash` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`username`, `password`, `login_hash`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
('ak', '17540aef7b8470cc3ea8b2b9046af3b6', 'akademik');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
