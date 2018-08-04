-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2011 at 08:38 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `akuntansi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_backup`
--

CREATE TABLE IF NOT EXISTS `history_backup` (
  `id_backup` int(15) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(50) NOT NULL,
  `tanggal_backup` varchar(20) NOT NULL,
  PRIMARY KEY (`id_backup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `history_backup`
--

INSERT INTO `history_backup` (`id_backup`, `nama_file`, `tanggal_backup`) VALUES
(39, 'Wed15Dec2010_backup_data_1292387890.sql', '2010-12-15 11:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `history_tutup_buku`
--

CREATE TABLE IF NOT EXISTS `history_tutup_buku` (
  `id_backup` int(15) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(50) NOT NULL,
  `tanggal_backup` varchar(20) NOT NULL,
  PRIMARY KEY (`id_backup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `history_tutup_buku`
--

INSERT INTO `history_tutup_buku` (`id_backup`, `nama_file`, `tanggal_backup`) VALUES
(35, 'Wed29Dec2010_tutup_buku_1293557507.sql', '2010-12-29 00:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_keluar`
--

CREATE TABLE IF NOT EXISTS `jurnal_keluar` (
  `nomor_jurnal` int(15) NOT NULL,
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_selesai` varchar(20) NOT NULL,
  PRIMARY KEY (`nomor_jurnal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_keluar`
--


-- --------------------------------------------------------

--
-- Table structure for table `jurnal_masuk`
--

CREATE TABLE IF NOT EXISTS `jurnal_masuk` (
  `nomor_jurnal` int(15) NOT NULL,
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_selesai` varchar(20) NOT NULL,
  PRIMARY KEY (`nomor_jurnal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_masuk`
--


-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE IF NOT EXISTS `jurnal_umum` (
  `nomor_jurnal` int(15) NOT NULL,
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_selesai` varchar(20) NOT NULL,
  PRIMARY KEY (`nomor_jurnal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_umum`
--


-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin`
--

CREATE TABLE IF NOT EXISTS `tabel_admin` (
  `id_admin` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tabel_admin`
--

INSERT INTO `tabel_admin` (`id_admin`, `nama`, `username`, `password`, `tanggal`) VALUES
(1, 'Agus Sumarna', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2011-03-11 08:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_master`
--

CREATE TABLE IF NOT EXISTS `tabel_master` (
  `kode_rekening` varchar(10) NOT NULL DEFAULT '',
  `nama_rekening` varchar(100) NOT NULL,
  `tanggal_awal` varchar(12) NOT NULL,
  `awal_debet` int(15) NOT NULL,
  `awal_kredit` int(15) NOT NULL,
  `mut_debet` int(15) NOT NULL,
  `mut_kredit` int(15) NOT NULL,
  `sisa_debet` int(15) NOT NULL,
  `sisa_kredit` int(15) NOT NULL,
  `rl_debet` int(15) NOT NULL,
  `rl_kredit` int(15) NOT NULL,
  `nrc_debet` int(15) NOT NULL,
  `nrc_kredit` int(15) NOT NULL,
  `posisi` varchar(15) NOT NULL,
  `normal` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_rekening`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_master`
--

INSERT INTO `tabel_master` (`kode_rekening`, `nama_rekening`, `tanggal_awal`, `awal_debet`, `awal_kredit`, `mut_debet`, `mut_kredit`, `sisa_debet`, `sisa_kredit`, `rl_debet`, `rl_kredit`, `nrc_debet`, `nrc_kredit`, `posisi`, `normal`) VALUES
('111.01', 'Kas Unit Umum', '', 0, 8600000, 0, 0, 0, 0, 0, 0, 0, 8600000, 'neraca', 'debet'),
('112.01', 'Kas Di Bank', '', 20000000, 0, 0, 0, 0, 0, 0, 0, 20000000, 0, 'neraca', 'debet'),
('113.01', 'Piutang Anggota', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'debet'),
('114.01', 'Piutang Pengurus', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'debet'),
('133.01', 'Mesin Ketik', '', 5100000, 0, 0, 0, 0, 0, 0, 0, 5100000, 0, 'neraca', 'debet'),
('133.02', 'Komputer', '', 44000000, 0, 0, 0, 0, 0, 0, 0, 44000000, 0, 'neraca', 'debet'),
('133.03', 'Mesin Foto Copy', '', 32500000, 0, 0, 0, 0, 0, 0, 0, 32500000, 0, 'neraca', 'debet'),
('133.04', 'Handphone', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'debet'),
('134.01', 'Kendaraan Roda Empat', '', 75000000, 0, 0, 0, 0, 0, 0, 0, 75000000, 0, 'neraca', 'debet'),
('135.01', 'Perlengkapan Toko', '', 5000000, 0, 0, 0, 0, 0, 0, 0, 5000000, 0, 'neraca', 'debet'),
('135.02', 'Perabot/Inventaris', '', 5000000, 0, 0, 0, 0, 0, 0, 0, 5000000, 0, 'neraca', 'debet'),
('211.01', 'Hutang Barang Toko', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('212.01', 'Simpanan Manasuka', '', 0, 97600000, 0, 0, 0, 0, 0, 0, 0, 97600000, 'neraca', 'kredit'),
('212.02', 'Simpanan Khusus', '', 0, 400000, 0, 0, 0, 0, 0, 0, 0, 400000, 'neraca', 'kredit'),
('213.01', 'Dana Anggota', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('213.02', 'Dana Pengurus', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('311.01', 'Simpanan Anggota Pokok', '', 0, 10000000, 0, 0, 0, 0, 0, 0, 0, 10000000, 'neraca', 'kredit'),
('311.02', 'Simpanan Anggota Wajib', '', 0, 10000000, 0, 0, 0, 0, 0, 0, 0, 10000000, 'neraca', 'kredit'),
('313.01', 'Modal Donasi', '', 0, 60000000, 0, 0, 0, 0, 0, 0, 0, 60000000, 'neraca', 'kredit'),
('313.05', 'SHU Tahun Lalu Belum Dibagi', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('314.01', 'SHU Tahun Berjalan(Umum)', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'neraca', 'kredit'),
('411.01', 'Penjualan Barang Toko', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('411.02', 'Pendapatan Jasa', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('412.01', 'Pendapatan Simpan Pinjam', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'kredit'),
('413.01', 'Pendapatan Jasa Lain-lain', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'kredit'),
('511.01', 'Biaya Pembelian Barang', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.01', 'Biaya Administrasi', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.02', 'Biaya Gaji Karyawan', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.03', 'Biaya Keuangan (Bank)', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.04', 'Biaya Organisasi', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_neraca`
--

CREATE TABLE IF NOT EXISTS `tabel_neraca` (
  `kode_rekening` varchar(10) NOT NULL DEFAULT '',
  `nama_rekening` varchar(100) NOT NULL,
  `tanggal_awal` varchar(12) NOT NULL,
  `awal_debet` int(15) NOT NULL,
  `awal_kredit` int(15) NOT NULL,
  `mut_debet` int(15) NOT NULL,
  `mut_kredit` int(15) NOT NULL,
  `sisa_debet` int(15) NOT NULL,
  `sisa_kredit` int(15) NOT NULL,
  `rl_debet` int(15) NOT NULL,
  `rl_kredit` int(15) NOT NULL,
  `nrc_debet` int(15) NOT NULL,
  `nrc_kredit` int(15) NOT NULL,
  `posisi` varchar(15) NOT NULL,
  `normal` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_rekening`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_neraca`
--

INSERT INTO `tabel_neraca` (`kode_rekening`, `nama_rekening`, `tanggal_awal`, `awal_debet`, `awal_kredit`, `mut_debet`, `mut_kredit`, `sisa_debet`, `sisa_kredit`, `rl_debet`, `rl_kredit`, `nrc_debet`, `nrc_kredit`, `posisi`, `normal`) VALUES
('0', '<b>AKTIVA LANCAR</b>', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('1', 'Kas', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('2', 'Bank', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('3', 'Piutang Anggota', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('4', 'Piutang Bukan Anggota', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('5', 'Pendapatan yang masih harus diterima', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('6', 'Persediaan Barang Toko', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('7', 'break', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('8', '<b>TOTAL AKTIVA LANCAR</b>', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('9', 'break', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('10', '<b>PENYERTAAN PKPRI</b>', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('11', 'Penyertaan PKPRI', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('12', 'break', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('13', '<b>AKTIVA TETAP</b>', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('14', 'Mesin-mesin', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('15', 'Kendaraan', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('16', 'Perlengkapan Toko', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('17', 'Perabot', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('18', 'Penyusutan Mesin', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('19', 'Penyusutan Kendaraan', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('20', 'Penyusutan Perlengkapan Toko', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('21', 'Penyusutan Perabot', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('22', 'Total Aktiva Tetap', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('23', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('24', '<b>AKTIVA LAINNYA<b>', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('25', 'Piutang Sementara', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('26', 'break', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('27', '<b>JUMLAH AKTIVA</b>', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_profil`
--

CREATE TABLE IF NOT EXISTS `tabel_profil` (
  `nama_perusahaan` varchar(30) NOT NULL,
  `gedung` varchar(30) NOT NULL,
  `jalan` varchar(30) NOT NULL,
  `kelurahan` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `propinsi` varchar(15) NOT NULL,
  `negara` varchar(15) NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `fax` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `website` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_profil`
--

INSERT INTO `tabel_profil` (`nama_perusahaan`, `gedung`, `jalan`, `kelurahan`, `kecamatan`, `propinsi`, `negara`, `telpon`, `fax`, `email`, `website`) VALUES
('Koperasi Bersama', 'Menara Sarbini', 'Jl. Salak VII', 'Abadijaya', 'Sukmajaya', 'Jabar', 'Indonesia', '0217703964', '0217703964', 'sumarna_agus@yahoo.c', 'http://ri32.wordpres');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_rugi_laba`
--

CREATE TABLE IF NOT EXISTS `tabel_rugi_laba` (
  `kode_rekening` varchar(10) NOT NULL DEFAULT '',
  `nama_rekening` varchar(100) NOT NULL,
  `tanggal_awal` varchar(12) NOT NULL,
  `awal_debet` int(15) NOT NULL,
  `awal_kredit` int(15) NOT NULL,
  `mut_debet` int(15) NOT NULL,
  `mut_kredit` int(15) NOT NULL,
  `sisa_debet` int(15) NOT NULL,
  `sisa_kredit` int(15) NOT NULL,
  `rl_debet` int(15) NOT NULL,
  `rl_kredit` int(15) NOT NULL,
  `nrc_debet` int(15) NOT NULL,
  `nrc_kredit` int(15) NOT NULL,
  `posisi` varchar(15) NOT NULL,
  `normal` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_rekening`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_rugi_laba`
--

INSERT INTO `tabel_rugi_laba` (`kode_rekening`, `nama_rekening`, `tanggal_awal`, `awal_debet`, `awal_kredit`, `mut_debet`, `mut_kredit`, `sisa_debet`, `sisa_kredit`, `rl_debet`, `rl_kredit`, `nrc_debet`, `nrc_kredit`, `posisi`, `normal`) VALUES
('I.', 'SUMBER PENGHASILAN', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('411.01', 'Penjualan Barang Toko', '02/12/2010', 0, 0, 0, 10000000, 0, 10000000, 0, 10000000, 0, 0, 'rugi-laba', 'debet'),
('411.02', 'Pendapatan Jasa', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('412.01', 'Pendapatan Simpan Pinjam', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'kredit'),
('413.01', 'Pendapatan Jasa Lain-lain', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'kredit'),
('II.', 'BIAYA UMUM DAN ADMINISTRASI', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('B', 'BIAYA ADMINISTRASI', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('522.01', 'Biaya Administrasi', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.02', 'Biaya Gaji Karyawan', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.03', 'Biaya Keuangan (Bank)', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('522.04', 'Biaya Organisasi', '02/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'rugi-laba', 'debet'),
('III', 'JUMLAH PENDAPATAN', '', 0, 0, 0, 0, 0, 0, 0, 10000000, 0, 0, '', ''),
('IV', 'JUMLAH BIAYA', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', ''),
('V', 'Sisa Hasil Usaha Tahun Berjalan', '', 0, 0, 0, 0, 0, 0, 10000000, 0, 0, 0, '', ''),
('VI', 'Total Balance', '', 0, 0, 0, 0, 0, 0, 10000000, 10000000, 0, 0, '', ''),
('VII', 'TANGGAL PERIODE', '18/12/2010', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi`
--

CREATE TABLE IF NOT EXISTS `tabel_transaksi` (
  `id_transaksi` int(15) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(15) NOT NULL,
  `kode_rekening` varchar(10) NOT NULL,
  `tanggal_transaksi` varchar(12) NOT NULL,
  `jenis_transaksi` varchar(15) NOT NULL,
  `keterangan_transaksi` text NOT NULL,
  `debet` int(15) NOT NULL,
  `kredit` int(15) NOT NULL,
  `tanggal_posting` varchar(12) NOT NULL,
  `keterangan_posting` varchar(10) NOT NULL,
  `id_admin` int(4) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `tabel_transaksi`
--

