-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Agu 2018 pada 10.10
-- Versi server: 5.6.39-cll-lve
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harnic`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `childcategory`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `childcategory` (
`kategori_id` int(11)
,`parent_id` bigint(11)
,`Category` varchar(100)
,`SubCategory` varchar(100)
,`SubSubCategory` varchar(100)
,`kategori_gambar` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambarhdr`
--

CREATE TABLE `gambarhdr` (
  `gambarslide` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gambarhdr`
--

INSERT INTO `gambarhdr` (`gambarslide`) VALUES
('harnic_kitchen-2.jpg'),
('harnic_health-2.jpg'),
('harnic_beauty-3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `imgproduk`
--

CREATE TABLE `imgproduk` (
  `kodegambar` int(11) NOT NULL,
  `produk` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tipegambar` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `imgproduk`
--

INSERT INTO `imgproduk` (`kodegambar`, `produk`, `gambar`, `keterangan`, `tipegambar`) VALUES
(107, 4, '7010.jpg', '', '1'),
(2, 4, '7010+1.jpg', 'img1', '1'),
(3, 5, '7008.jpg', 'img1', '1'),
(4, 6, '7009.jpg', 'img1', '1'),
(5, 7, '7003.jpg', 'img1', '1'),
(103, 11, '7002-55.jpg', '', '1'),
(7, 9, '7001-2.jpg', 'img1', '1'),
(8, 3, '7010-1.jpg', 'img2', '1'),
(9, 4, '7010+2.jpg', 'img2', '1'),
(10, 5, '7008-1.jpg', 'img2', '1'),
(11, 6, '7009-1.jpg', 'img2', '1'),
(12, 7, '7003-1.jpg', 'img2', '1'),
(13, 8, '7001-11.jpg', 'img2', '1'),
(104, 11, '7002-11.jpg', '', '1'),
(15, 3, '7010-2.jpg', 'img3', '1'),
(16, 4, '7010+3.jpg', 'img3', '1'),
(17, 5, '7008-2.jpg', 'img3', '1'),
(18, 6, '7009-2.jpg', 'img3', '1'),
(19, 7, '7003-2.jpg', 'img3', '1'),
(20, 8, '7001-12.jpg', 'img3', '1'),
(106, 11, '7002-44.jpg', '', '1'),
(110, 47, 'X-E-583_(7)_å‰¯æœ¬.jpg', '', '1'),
(23, 11, '7002-3.jpg', 'HL-7002', '1'),
(108, 4, '7010-1.jpg', '', '1'),
(109, 4, '7010-2.jpg', '', '1'),
(120, 18, '713-P.jpg', '', '1'),
(28, 16, 'IMG_1560.JPG', 'HL-711', '1'),
(124, 21, '20171004_160305_(1).jpg', '', '1'),
(30, 18, '713-H.jpg', 'HL-713', '1'),
(32, 20, 'HL_717_PURPLE.jpg', 'HL-717', '1'),
(33, 21, '20171004_160716.jpg', 'HL-720', '1'),
(127, 29, 'HCL_008_BLACK_RED.jpg', '', '1'),
(35, 23, '20180310_085814.jpg', 'HL-833', '1'),
(36, 24, '4.jpg', 'HC-800', '1'),
(37, 25, 'D-070K.jpg', 'D-070K', '1'),
(113, 31, '3512-P.jpg', '', '1'),
(39, 27, 'HCL_001_GOLD.jpg', 'HCL-001', '1'),
(129, 48, '175.JPG', '', '1'),
(128, 48, '', '', '1'),
(119, 16, 'IMG_1556.JPG', '', '1'),
(43, 31, '3512-H.jpg', 'HL-3512', '1'),
(118, 16, 'IMG_1553.JPG', '', '1'),
(45, 33, '3536-G.jpg', 'HL-3536', '1'),
(117, 33, '3536-U.jpg', '', '1'),
(47, 15, 'IMG_1556.JPG', 'HL-711', '1'),
(48, 16, 'IMG_1562.JPG', 'HL-711', '1'),
(122, 20, '', '', '1'),
(50, 18, '713-H2.jpg', 'HL-713', '1'),
(51, 19, 'IMG_1865.JPG', 'HL-717', '1'),
(52, 20, '717-U2.jpg', 'HL-717', '1'),
(53, 21, '20171004_161041.jpg', 'HL-720', '1'),
(54, 22, 'IMG_1851.jpg', 'HL-720', '1'),
(55, 24, '1.jpg', 'HC-800', '1'),
(56, 26, '20171011_152427.jpg', 'HCL-001', '1'),
(57, 27, '20171011_162049.jpg', 'HCL-001', '1'),
(58, 30, '3512-P2.jpg', 'HL-3512', '1'),
(59, 31, '3512-H4.jpg', 'HL-3512', '1'),
(60, 32, '3512-U2.jpg', 'HL-3512', '1'),
(61, 15, 'IMG_1550.JPG', 'HL-711', '1'),
(121, 18, '713-P2.jpg', '', '1'),
(63, 17, '713-P2.jpg', 'HL-713', '1'),
(64, 18, '713-P3.jpg', ' HL-713', '1'),
(65, 19, 'IMG_1867.JPG', 'HL-717', '1'),
(66, 20, '717-U.jpg', 'HL-717', '1'),
(67, 21, '20171004_161223.jpg', 'HL-720', '1'),
(68, 22, '20171004_162025.jpg', 'HL-720', '1'),
(69, 24, '0.jpg', 'HC-800', '1'),
(70, 35, '6206-1.jpg', '6206-1.jpg', '1'),
(71, 36, '6208-1.jpg', '6208-1.jpg', '1'),
(72, 37, '6316-1.jpg', '6316-1.jpg', '1'),
(73, 38, 'HSM020.jpg', 'HSM020.jpg', '1'),
(74, 39, '3211-M.jpg', '3211-M.jpg', '1'),
(75, 40, '3650-2.jpg', '3650-2.jpg', '1'),
(76, 41, '4350.jpg', '4350.jpg', '1'),
(77, 42, '3450.jpg', '3450.jpg', '1'),
(78, 43, 'voyager.jpg', 'voyager.jpg', '1'),
(79, 44, 'D-067K.jpg', 'D-067K.jpg', '1'),
(80, 35, '6206-2.jpg', '6206-2.jpg', '1'),
(81, 36, '6208-2.jpg', '6208-2.jpg', '1'),
(82, 37, '6316-2.jpg', '6316-2.jpg', '1'),
(83, 38, 'HSM020-1.jpg', 'HSM020-1.jpg', '1'),
(84, 39, '3211-B.jpg', '3211-B.jpg', '1'),
(85, 40, '3650-1.jpg', '3650-1.jpg', '1'),
(86, 41, '4350-1.jpg', '4350-1.jpg', '1'),
(87, 42, '3450-1.jpg', '3450-1.jpg', '1'),
(88, 43, 'voyager-1.jpg', 'voyager-1.jpg', '1'),
(89, 35, '6206-3.jpg', '6206-3.jpg', '1'),
(90, 36, '6208-3.jpg', '6208-3.jpg', '1'),
(91, 39, '3211-M2.jpg', '3211-M2.jpg', '1'),
(92, 43, 'voyager-2.jpg', 'voyager-2.jpg', '1'),
(93, 45, 'X-E-582_(7)_å‰¯æœ¬.jpg', '', '1'),
(94, 45, 'E_1000x1000_(8)_å‰¯æœ¬.jpg', '', '1'),
(95, 46, 'X-E-581_(7)_å‰¯æœ¬.jpg', '', '1'),
(96, 46, 'E-581P._jpg_(2)_å‰¯æœ¬.jpg', '', '1'),
(105, 11, '7002-22.jpg', '', '1'),
(101, 9, '7001-13.jpg', '', '1'),
(111, 27, 'HCL_001_SILVER.jpg', '', '1'),
(112, 27, '20171011_152427.jpg', '', '1'),
(114, 31, '3512-P2.jpg', '', '1'),
(115, 31, '3512-U.jpg', '', '1'),
(116, 31, '3512-U2.jpg', '', '1'),
(125, 21, 'IMG_1851.jpg', '', '1'),
(130, 49, '1210.jpg', '', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mstkategori`
--

CREATE TABLE `mstkategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(100) NOT NULL,
  `kategori_gambar` varchar(255) DEFAULT NULL,
  `kategori_parent` int(11) NOT NULL,
  `kategori_banner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mstkategori`
--

INSERT INTO `mstkategori` (`kategori_id`, `kategori_nama`, `kategori_gambar`, `kategori_parent`, `kategori_banner`) VALUES
(1, 'Home', 'home.png', 0, 'home.png'),
(2, 'Kitchen', 'kitchen.png', 0, 'kitchen.png'),
(3, 'Health', 'health.png', 0, 'health.png'),
(4, 'Beauty', 'beauty.png', 0, 'beauty.png'),
(5, 'Ladies', 'women-small.jpg', 4, 'women-banner.jpg'),
(6, 'Men', 'men-small.jpg', 4, 'men-banner.jpg'),
(7, 'Doorbell', 'doorbell.jpg', 1, NULL),
(8, 'Aerosol', NULL, 1, NULL),
(9, 'Kettle', 'kettle.jpg', 2, NULL),
(10, 'Kitchen Scale', 'kitchenscale.jpg', 2, NULL),
(11, 'Sandwich', 'sandwitch.jpg', 2, NULL),
(12, 'Toaster', NULL, 2, NULL),
(13, 'Body Scale', 'bodyscale.jpg', 3, NULL),
(14, 'Mechanical Scale', 'mechascale.jpg', 13, NULL),
(15, 'Digital Personal Scale', 'digital-scale.png', 13, NULL),
(16, 'Pocket Scale', 'pocketscale.jpg', 3, NULL),
(17, 'Hairstraightener', 'catok.jpg', 5, NULL),
(18, 'Hair Dryer', 'hairdryer.jpg', 5, NULL),
(19, 'Callus Remover', 'callusremover.jpeg', 3, NULL),
(20, 'Hair Curler', 'curler.jpg', 5, NULL),
(21, 'Beauty Set', 'beautyset.jpg', 5, NULL),
(22, 'Others', 'women-small.jpg', 5, NULL),
(23, 'Hair Clipper', 'hairclip.jpg', 6, NULL),
(24, 'Shaver', NULL, 6, NULL),
(25, 'Mechanical', NULL, 10, NULL),
(26, 'Digital', 'kitchendigitalscale.jpg', 10, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mstproduk`
--

CREATE TABLE `mstproduk` (
  `produk` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `kodeproduk` varchar(15) NOT NULL,
  `namaproduk` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar1` varchar(100) NOT NULL,
  `gambar2` varchar(100) NOT NULL,
  `gambar3` varchar(100) NOT NULL,
  `gambarbesar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mstproduk`
--

INSERT INTO `mstproduk` (`produk`, `kategori`, `kodeproduk`, `namaproduk`, `deskripsi`, `harga`, `gambar1`, `gambar2`, `gambar3`, `gambarbesar`) VALUES
(4, 15, 'HL-7010', 'Digital Body Scale HL-7010', 'o Weight Load up to 180 Kg / 396,832 lb\r\no Used Battery 2*AAA \r\no Baby+ (Measure for Infant Mode)\r\no Using Tempered Glass \r\no 2 Color (Black, Grey)', 209900, '7010+1.jpg', '7010+2.jpg', '7010+3.jpg', '7010+1.jpg'),
(5, 15, 'HL-7008', 'Digital Body Scale HL-7008 [Stainless]', 'o Weight Load up to 180 kg / 396,832 lb\r\no Used Battery 2*AAA\r\no Designed with Stainless Steel Plate', 209900, '7008.jpg', '7008-1.jpg', '7008-2.jpg', '7008.jpg'),
(6, 15, 'HL-7009', 'Digital Body Scale HL-7009 [Mosaic]', 'o Weight Load up to 150 kg / 330,693 lb\r\no Used Battery Round 3V (CR 2032)\r\no Designed with Mosaic Colorfull\r\no Using Tempered Glass', 199900, '7009.jpg', '7009-1.jpg', '7009-2.jpg', '7009.jpg'),
(7, 15, 'HL-7003', 'Digital Body Scale HL-7003 [Batik]', 'o Weight Load up to 150 kg / 330,693 lb \r\no Used Battery Round 3V (CR 2032) \r\no New Design Batik form\r\no Using Tempered Glass', 199900, '7003.jpg', '7003-1.jpg', '7003-2.jpg', '7003.jpg'),
(9, 15, 'HL-7001', 'Digital Body Scale HL - 7001', 'o Weight Load up to 150 kg / 330,693 lb\r\no Used Battery Round 3V (CR 2032)\r\no Using Tempered Glass\r\no 2 Color (Blue, Pink)', 199900, '7001-2.jpg', '7001-1.jpg', '7001.jpg', '7001-2.jpg'),
(11, 15, 'HL-7002', 'Digital Body Scale HL - 7002', 'o Weight Load up to 150 kg / 330,693 lb\r\no Used Battery Round 3V (CR 2032)\r\no Using Tempered Glass\r\no 5 Different Theme (Black, Green, Silver, Rainbow, Pink)', 199900, '7002-3.jpg', '', '', ''),
(16, 17, 'HL - 711', 'Hair Straightener HL - 711 ', 'o Light Indicator\r\no 30W ~ 220V\r\no On / Off Switch\r\no Multifunction (Curly, Blow, Straight)\r\no 2 Color (Gold, Pink)', 139900, 'IMG_1560.JPG', 'IMG_1562.JPG', 'IMG_1558.jpg', ''),
(18, 17, 'HL-713', 'Hair Straightener HL - 713', 'o Ceramic Plate\r\no Temperatur Control (100-200 cc)\r\no ON / OFF Switch\r\no Light Indicator\r\no 40W ~ 220V\r\no Multifunction (Curly, Blow, Straight)\r\no 2 Color (Pink, Green)', 199900, '713-H.jpg', '713-H2.jpg', '713-H3.jpg', ''),
(20, 17, 'HL-717', 'Hair Straightener HL-717 ', 'o Ceramic Plate\r\no 40W ~ 220V\r\no Temperature Digital (100-200 cc)\r\no ON / OFF Switch\r\no Switch Lock\r\no 2 Color (Pink, Purple)', 199900, 'HL_717_PURPLE.jpg', '717-U2.jpg', '717-U.jpg', ''),
(21, 17, 'HL-720', 'Hair Straightener HL-720 ', 'o Ceramic Plate\r\no 40W ~ 220V\r\no Temperature (100-220 cc)\r\no ON / OFF Switch\r\no Light Indicator\r\no 2 Color (Pink, Purple)', 179900, '20171004_160716.jpg', '20171004_161041.jpg', '20171004_161223.jpg', ''),
(23, 19, 'HL-833', 'Callus Remover', 'o Use Battery 2*AAA\r\no Hard Stone\r\n', 99900, '20180310_085814.jpg', '', '', ''),
(24, 20, 'HC-800', 'Automatic Hair Curling', 'o Light Indicator \r\no 25W ~ 220V\r\no Switch Lock\r\no On / Off Switch\r\no PTC Heat System', 499900, '4.jpg', '1.jpg', '0.jpg', ''),
(25, 7, 'D-070K', 'Doorbell Wireless', 'o Kinetic System\r\no Frequency Range *150m\r\no Night Light Mode\r\no AC input/output', 159900, 'D-070K.jpg', '', '', ''),
(27, 23, 'HCL-001', 'Hair Clipper HCL-001', 'o Carbon Steel Clipper\r\no 9W ~ 220V\r\no On / Off Switch\r\no handle size mm\r\no 2 Color (Gold, Silver)', 179900, 'HCL_001_GOLD.jpg', '20171011_162049.jpg', '', ''),
(29, 23, 'HCL-008', 'Magnetic Hair Clipper HCL-008 ', 'o Carbon Steel Clipper\r\no 9W ~ 220V\r\no On / Off Switch\r\no handle size mm\r\no 2 Color (Red, Blue)', 139900, 'HCL_008_BLACK_RED.jpg', '', '', ''),
(31, 18, 'HL-3512', 'Hair Dryer HL-3512', 'o Duo Speed (Normal/Fast)\r\no 450W ~ 220/240V\r\no Foldable Hairdryer\r\no 3 Color (Pink, Green, Purle)', 119900, '3512-H.jpg', '3512-H4.jpg', '', ''),
(33, 18, 'HL-3536', 'Hair Dryer HL-3536', 'o Duo Speed (Normal/Fast)\r\no Fan Mode\r\no 450W ~ 220/240V\r\no Foldable Hairdryer\r\no 2 Color (Black, White)', 129900, '3536-G.jpg', '', '', ''),
(35, 9, 'HL-6206', 'ELECTRONIC KETTLE ', 'o Capacity 1L\r\no 600W ~ 220/240V\r\no Light Indicator \r\no On / Off Switch', 0, '6206-1.jpg', '', '', ''),
(36, 9, 'HL-6208', 'ELECTRONIC KETTLE ', 'o Capacity 1,2L\r\no 600W ~ 220/240V\r\no Light Indicator \r\no On / Off Switch\r\no 2 Color (Red, Green)', 0, '6208-1.jpg', '', '', ''),
(37, 9, 'HL-6316', 'ELECTRONIC KETTLE ', 'o Capacity 0,8L\r\no 600W ~ 220/240V\r\no Light Indicator\r\no On / Off Switch\r\no 2 Color (Grey, White)', 0, '6316-1.jpg', '', '', ''),
(38, 11, 'HSM-020', 'SANDWICH MAKER', 'o Light Indicator\r\no 600W ~ 220/240V\r\no Teflon material', 0, 'HSM020.jpg', '', '', ''),
(39, 26, 'HL-3211', 'KITCHEN SCALE', 'o Use Battery 2*AAA\r\no Stainless Steel Plate\r\no Max. 5.0Kg / 5000gr\r\no On / Off Button\r\no 2 Color (Red, Black)', 0, '3211-M.jpg', '', '', ''),
(40, 26, 'HL-3650', 'KITCHEN SCALE', 'o Use Battery 1*3V (CR 2032)\r\no Max. 5.0Kg / 5000gr\r\no On / Off Button\r\no Gram / Mililiters Mode', 0, '3650-2.jpg', '', '', ''),
(41, 26, 'HL-4350', 'KITCHEN SCALE', 'o Use Battery 2*AAA\r\no Max. 5.0Kg / 5000gr\r\no On / Off Button\r\no Gram / Mililiters Mode', 0, '4350.jpg', '', '', ''),
(42, 26, 'HL-3450', 'KITCHEN SCALE', 'o Use Battery 2*AAA\r\no Max. 5.0Kg / 5000gr\r\no On / Off Button\r\no Gram / Mililiters Mode', 0, '3450.jpg', '', '', ''),
(43, 21, 'VOYAGER', 'BEAUTY SET', 'o 10W ~ 220V for Straightener\r\no 1000W ~ 220V for Hairdryer\r\no Duo Speed (Normal, Fast)', 199900, 'voyager.jpg', '', '', ''),
(44, 7, 'D-067K', 'DOORBELL WIRELESS', 'o Use Battery 2*AAA for Bell\r\no Use Battery 1*A23 for Remote\r\no Frequency Range 100m\r\no 32 tone polyphonic', 0, 'D-067K.jpg', '', '', ''),
(45, 7, 'D-067K2', 'Doorbell Wireless', 'o Frequency Range 100m\r\no DC Input/Output\r\no 32 tone polyphonic\r\no Use Battery 2*AAA for Bell\r\no Use Battery 1*A23 for Remote\r\no 2 Waterproof Remote\r\no alowed connect to 6 remote in 1 Bell', 1, '', '', '', ''),
(46, 7, 'D-068K', 'Doorbell Wireless', 'o Frequency Range 100m\r\no AC Input/Output\r\no 32 tone polyphonic\r\no Waterproof Remote\r\no Use Battery 1*A23 for Remote', 0, '', '', '', ''),
(47, 7, 'D-068K2', 'Doorbell Wireless', 'o Frequency Range 100m \r\no AC Input/Output \r\no 32 tone polyphonic \r\no 2 Waterproof Remote \r\no Use Battery 1*A23 for Remote\r\no allowed connect to 6 Remote in 1 Bell', 0, '', '', '', ''),
(48, 20, 'HL-701', 'Hair Curling HL-701', 'o Diameter 19mm\r\no 25W ~ 220V\r\no On / Off Switch\r\no Light Indicator\r\no Include Comb Brush', 0, '', '', '', ''),
(49, 18, 'HL-1210', 'Hair Dryer HL-1210', 'o Duo Speed (Normal, Fast)\r\no Duo Temperature (Normal, Hot)\r\no Cool Button\r\no 1500W ~ 220/240V', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `mstproduk2`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `mstproduk` (
`produk` int(11)
,`kategori` int(11)
,`kodeproduk` varchar(15)
,`namaproduk` varchar(100)
,`deskripsi` text
,`harga` int(11)
,`gambar1` varchar(100)
,`gambar2` varchar(100)
,`gambar3` varchar(100)
,`gambarbesar` varchar(100)
,`kategori_nama` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `userpassword` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userid`, `username`, `userpassword`) VALUES
(1, 'admin', 'adm1n');

-- --------------------------------------------------------

--
-- Struktur untuk view `childcategory`
--
DROP TABLE IF EXISTS `childcategory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`harnic`@`43.247.15.171` SQL SECURITY DEFINER VIEW `childcategory`  AS  select `a`.`kategori_id` AS `kategori_id`,ifnull(`c`.`kategori_id`,`b`.`kategori_id`) AS `parent_id`,ifnull(`c`.`kategori_nama`,`b`.`kategori_nama`) AS `Category`,(case when isnull(`c`.`kategori_nama`) then `a`.`kategori_nama` else `b`.`kategori_nama` end) AS `SubCategory`,(case when isnull(`c`.`kategori_nama`) then '' else `a`.`kategori_nama` end) AS `SubSubCategory`,ifnull(`a`.`kategori_gambar`,NULL) AS `kategori_gambar` from ((`mstkategori` `a` left join `mstkategori` `b` on((`a`.`kategori_parent` = `b`.`kategori_id`))) left join `mstkategori` `c` on((`b`.`kategori_parent` = `c`.`kategori_id`))) where (not(`a`.`kategori_id` in (select `mstkategori`.`kategori_parent` from `mstkategori`))) order by ifnull(`c`.`kategori_nama`,`b`.`kategori_nama`),(case when isnull(`c`.`kategori_nama`) then `a`.`kategori_nama` else `b`.`kategori_nama` end),(case when isnull(`c`.`kategori_nama`) then '' else `a`.`kategori_nama` end) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `mstproduk2`
--
DROP TABLE IF EXISTS `mstproduk2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`harnic`@`43.247.15.171` SQL SECURITY DEFINER VIEW `mstproduk2`  AS  select `p`.`produk` AS `produk`,`p`.`kategori` AS `kategori`,`p`.`kodeproduk` AS `kodeproduk`,`p`.`namaproduk` AS `namaproduk`,`p`.`deskripsi` AS `deskripsi`,`p`.`harga` AS `harga`,`p`.`gambar1` AS `gambar1`,`p`.`gambar2` AS `gambar2`,`p`.`gambar3` AS `gambar3`,`p`.`gambarbesar` AS `gambarbesar`,`k`.`kategori_nama` AS `kategori_nama` from (`mstproduk` `p` left join `mstkategori` `k` on((`p`.`kategori` = `k`.`kategori_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `imgproduk`
--
ALTER TABLE `imgproduk`
  ADD PRIMARY KEY (`kodegambar`),
  ADD KEY `produk` (`produk`,`tipegambar`) USING BTREE;

--
-- Indeks untuk tabel `mstkategori`
--
ALTER TABLE `mstkategori`
  ADD PRIMARY KEY (`kategori_id`),
  ADD UNIQUE KEY `kategorix` (`kategori_nama`);

--
-- Indeks untuk tabel `mstproduk`
--
ALTER TABLE `mstproduk`
  ADD PRIMARY KEY (`produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `imgproduk`
--
ALTER TABLE `imgproduk`
  MODIFY `kodegambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT untuk tabel `mstkategori`
--
ALTER TABLE `mstkategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `mstproduk`
--
ALTER TABLE `mstproduk`
  MODIFY `produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
