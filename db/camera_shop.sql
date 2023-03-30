--
-- Database: `camera_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmuc`
--

DROP TABLE IF EXISTS `tbl_danhmuc`;
CREATE TABLE IF NOT EXISTS `tbl_danhmuc` (
  `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT,
  `ten_danhmuc` varchar(100) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `category_status` int(11) NOT NULL,
  `category_detail` text NOT NULL,
  `category_created_time` int(11) NOT NULL,
  `category_last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id_danhmuc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc`(`id_danhmuc`, `ten_danhmuc`, `id_danhmuc`, `category_status`, `category_detail`, `category_created_time`, `category_last_updated`) VALUES
('', 'Camera Yoosee', '1', '1', '', 1678438681, 1678438681),
('', 'Camera Ezviz', '2', '1', '', 1678438681, 1678438681),
('', 'Camera Imou', '3', '1', '', 1678438681, 1678438681),
('', 'Camera Hikvision', '4', '1', '', 1678438681, 1678438681),
('', 'Camera Vantech', '5', '1', '', 1678438681, 1678438681),
('', 'Camera Kbvision', '6', '1', '', 1678438681, 1678438681),
('', 'Camera Dahua', '7', '1', '', 1678438681, 1678438681),
('', 'Camera Srihome', '8', '1', '', 1678438681, 1678438681),
('', 'Camera KBONE', '9', '1', '', 1678438681, 1678438681)

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

DROP TABLE IF EXISTS `tbl_sanpham`;
CREATE TABLE IF NOT EXISTS `tbl_sanpham` (
  `id_sanpham` int(11) NOT NULL AUTO_INCREMENT,
  `tensanpham` varchar(250) NOT NULL,
  `giasp` varchar(50) NOT NULL,
  `soluong` int(11) NOT NULL,
  `hinhanh` varchar(150) NOT NULL,
  `giamgia` int(11) NOT NULL,
  `giadagiam` int(11) NOT NULL,
  `daban` int(11) NOT NULL,
  `average_rating` double NOT NULL,
  `trangthaisp` int(11) NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  PRIMARY KEY (`id_sanpham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham`(`id_sanpham`, `tensanpham`, `masp`, `giasp`, `soluong`, `hinhanh`, `giamgia`, `daban`, `trangthaisp`, `tomtat`, `noidung`, `id_danhmuc`, `created_time`, `last_updated`) VALUES
('', 'Camera Yoosee', '1', '1', '', 1678438681, 1678438681),
('', 'Camera Ezviz', '2', '1', '', 1678438681, 1678438681),
('', 'Camera Imou', '3', '1', '', 1678438681, 1678438681),
('', 'Camera Hikvision', '4', '1', '', 1678438681, 1678438681),
('', 'Camera Vantech', '5', '1', '', 1678438681, 1678438681),
('', 'Camera Kbvision', '6', '1', '', 1678438681, 1678438681),
('', 'Camera Dahua', '7', '1', '', 1678438681, 1678438681),
('', 'Camera Srihome', '8', '1', '', 1678438681, 1678438681),
('', 'Camera KBONE', '9', '1', '', 1678438681, 1678438681)