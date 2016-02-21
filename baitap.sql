-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2015 at 07:19 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baitap`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `nextID`(`lastid` VARCHAR(10), `prefix` VARCHAR(10), `size` INT) RETURNS varchar(10) CHARSET utf8
    DETERMINISTIC
BEGIN
	DECLARE num_nextid int;
	DECLARE num_table varchar(10);
	DECLARE nextid varchar(10);

	IF(lastid = '') THEN
            SET nextid = CONCAT(prefix,REPEAT('0',size -LENGTH(prefix)));
	ELSE
	
	SET lastid = LTRIM(RTRIM(lastid));
	
	SET num_nextid = replace(lastid,prefix,'') + 1;

	SET size = size - LENGTH(prefix);

	SET nextid = CONCAT(prefix,REPEAT (0,size - LENGTH(prefix)));

	SET nextid = CONCAT(prefix,RIGHT( CONCAT(REPEAT(0, size),num_nextid), size));
	END IF;

	RETURN (nextid);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(200) DEFAULT NULL,
  `user_group` int(11) NOT NULL DEFAULT '3',
  `created` date DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`ID`, `email`, `fullname`, `password`, `salt`, `user_group`, `created`, `last_login`) VALUES
(1, 'ducngocvnk57@gmail.com', 'Nguyễn Đức Ngọc', 'b7653e875a0103bb831a8c3cb103b5c7', 'QuCorrfnQ^eR&7vV8YxRP14z94hth*MyZWFgCHZmUSz1#uMA4@*(4uteO2ov*@Jb&2UchzFRDU^O0EE*mqSvi*33nQg9%ylo^TmBkpg271s%j)!bZJ7Ze1)76fkQD9si@5Co6G#YrFTx6ggmupeEvIQg$IggQMdTNow8FsxX', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`ID`, `Name`) VALUES
(1, 'D9-101'),
(2, 'D9-102'),
(3, 'D9-103'),
(4, 'D9-104'),
(5, 'D9-105');

-- --------------------------------------------------------

--
-- Table structure for table `class_course`
--

CREATE TABLE IF NOT EXISTS `class_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` varchar(6) NOT NULL DEFAULT '',
  `courseid` varchar(11) NOT NULL,
  `max` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL DEFAULT '0',
  `semester` varchar(5) NOT NULL,
  `stage` int(1) DEFAULT NULL,
  `timetable` varchar(200) DEFAULT NULL,
  `comment` text,
  `lecturerid` varchar(10) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `userid_created` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`classid`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `class_course`
--

INSERT INTO `class_course` (`id`, `classid`, `courseid`, `max`, `number`, `semester`, `stage`, `timetable`, `comment`, `lecturerid`, `content`, `created`, `userid_created`, `updated`) VALUES
(23, '860000', 'IT6789', 40, 0, '20151', 2, '[{"day":"3","session":"0","start":"1","total":"4","area":"D9-101"}]', '<p>dd</p>', '000001', '<h4>Lập trình Web lớp Việt Nhật K57</h4>\r\n<p>Bài tập lớn:</p>\r\n<ul>\r\n<li>Mỗi nhóm 5 SV. Một sinh viên làm nhóm trưởng</li>\r\n<li>Đề tài: chọn một đề tài trong <a href="https://drive.google.com/file/d/0B6HCn9f_dk0Vb0h5UmFPaTlrdm8/edit?usp=sharing" target="_blank">danh sách đề tài bài tập lớn</a>.</li>\r\n<li>Đăng ký nhóm và tên đề tài <a href="https://docs.google.com/spreadsheets/d/1XHTtDl_MGXkuL_az2NRhg-syNSodD9-bFbOs3_eI4Lk/edit?usp=sharing" target="_blank">tại đây</a>.</li>\r\n<li>Kiểm tra tiến độ vào tuần 9</li>\r\n<li>Bảo vệ vào tuần 15</li>\r\n</ul>\r\n<div>Nộp bài tập lớn: Mỗi nhóm chuẩn bị một file nén (zip, rar, 7z...), đặt tên là <strong>[WP][VN20151][Nhóm X]Tên đề tài</strong> (ví dụ <em>[WP][VN20151][Nhóm 3]Website giới thiệu sách.zip</em>) bao gồm</div>\r\n<div>\r\n<ul>\r\n<li>Toàn bộ mã nguồn trang web</li>\r\n<li>File dữ liệu và/hoặc file export của cơ sở dữ liệu</li>\r\n<li>Hướng dẫn thiết lập framework / thư viện (nếu có)</li>\r\n<li><span>File mềm (*.doc, *.docx, *.pdf) bản báo cáo</span></li>\r\n</ul>\r\n</div>\r\n<div>rồi gửi vào thư mục Google Drive [ <a href="https://drive.google.com/folderview?id=0B6HCn9f_dk0VbE1ZTElUVWFHODA&amp;usp=sharing" target="_blank">WP-VN 20151</a> ]</div>\r\n<div> </div>\r\n<div>Thời hạn: Trước 23:59 ngày 02/12/2015</div>', '2015-11-14 20:20:36', NULL, '2015-11-26 22:06:46'),
(28, '860001', 'IT1234', 4, 0, '20152', 3, '[{"day":"2","session":"1","start":"1","total":"4","area":"D9-101"},{"day":"3","session":"1","start":"1","total":"4","area":"D9-104"}]', '', '000001', NULL, '2015-11-14 22:01:51', NULL, '2015-11-30 21:54:54'),
(29, '860002', 'IT6789', 60, 2, '20152', 1, '[{"day":"3","session":"0","start":"1","total":"2","area":"D9-101"}]', '', '001602', '<h4>Lập trình Web lớp Việt Nhật K57</h4>\r\n<p>Bài tập lớn:</p>\r\n<ul>\r\n<li>Mỗi nhóm 5 SV. Một sinh viên làm nhóm trưởng</li>\r\n<li>Đề tài: chọn một đề tài trong <a href="https://drive.google.com/file/d/0B6HCn9f_dk0Vb0h5UmFPaTlrdm8/edit?usp=sharing" target="_blank">danh sách đề tài bài tập lớn</a>.</li>\r\n<li>Đăng ký nhóm và tên đề tài <a href="https://docs.google.com/spreadsheets/d/1XHTtDl_MGXkuL_az2NRhg-syNSodD9-bFbOs3_eI4Lk/edit?usp=sharing" target="_blank">tại đây</a>.</li>\r\n<li>Kiểm tra tiến độ vào tuần 9</li>\r\n<li>Bảo vệ vào tuần 15</li>\r\n</ul>\r\n<div>Nộp bài tập lớn: Mỗi nhóm chuẩn bị một file nén (zip, rar, 7z...), đặt tên là <strong>[WP][VN20151][Nhóm X]Tên đề tài</strong> (ví dụ <em>[WP][VN20151][Nhóm 3]Website giới thiệu sách.zip</em>) bao gồm</div>\r\n<div>\r\n<ul>\r\n<li>Toàn bộ mã nguồn trang web</li>\r\n<li>File dữ liệu và/hoặc file export của cơ sở dữ liệu</li>\r\n<li>Hướng dẫn thiết lập framework / thư viện (nếu có)</li>\r\n<li><span>File mềm (*.doc, *.docx, *.pdf) bản báo cáo</span></li>\r\n</ul>\r\n</div>\r\n<div>rồi gửi vào thư mục Google Drive [ <a href="https://drive.google.com/folderview?id=0B6HCn9f_dk0VbE1ZTElUVWFHODA&amp;usp=sharing" target="_blank">WP-VN 20151</a> ]</div>\r\n<div> </div>\r\n<div>Thời hạn: Trước 23:59 ngày 02/12/2015</div>', '2015-11-28 10:23:55', NULL, '2015-12-01 16:35:57'),
(30, '860003', 'IT3454', 40, 0, '20152', 1, '[{"day":"2","session":"0","start":"1","total":"2","area":"D9-102"}]', '', '001048', NULL, '2015-11-28 10:24:08', NULL, '2015-11-30 23:09:33'),
(31, '860004', 'SSH110', 30, 1, '20152', 1, '[{"day":"2","session":"0","start":"3","total":"2","area":"D9-101"}]', '', '001100', NULL, '2015-11-28 17:44:30', NULL, '2015-12-01 17:54:27'),
(33, '860005', 'IT1234', 20, 0, '20152', 1, '[{"day":"2","session":"0","start":"1","total":"2","area":"D9-102"},{"day":"3","session":"0","start":"1","total":"2","area":"D9-101"}]', '', '000001', NULL, '2015-11-30 22:52:16', NULL, '2015-11-30 23:09:15'),
(34, '860006', 'SSH110', 30, 1, '20152', 2, '[{"day":"4","session":"0","start":"3","total":"4","area":"D9-101"}]', '', NULL, NULL, '2015-12-01 20:47:12', NULL, NULL);

--
-- Triggers `class_course`
--
DROP TRIGGER IF EXISTS `autoid`;
DELIMITER //
CREATE TRIGGER `autoid` BEFORE INSERT ON `class_course`
 FOR EACH ROW BEGIN
	DECLARE maxID VARCHAR(10);
	DECLARE number INT;
	SET number = (select count(*) FROM baitap.class_course);

	IF number < 1 THEN
		SET NEW.classid = '860000';
	ELSE
		SET maxID = (select classid FROM baitap.class_course order by classid desc limit 1);
		SET NEW.classid = nextID(maxID,'',6);
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `class_group`
--

CREATE TABLE IF NOT EXISTS `class_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `classID` varchar(8) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`,`classID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `class_group`
--

INSERT INTO `class_group` (`ID`, `classID`, `Name`) VALUES
(1, 'VNCK57', 'Việt Nhật C K57');

-- --------------------------------------------------------

--
-- Table structure for table `class_register`
--

CREATE TABLE IF NOT EXISTS `class_register` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(11) NOT NULL DEFAULT '',
  `classid` varchar(11) NOT NULL DEFAULT '',
  `semester` varchar(11) NOT NULL DEFAULT '',
  `created` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `class_register`
--

INSERT INTO `class_register` (`ID`, `sid`, `classid`, `semester`, `created`) VALUES
(143, '20121908', '860006', '20152', '2015-12-02'),
(145, '20121908', '860002', '20152', '2015-12-02'),
(146, '20120002', '860004', '20152', '2015-12-02'),
(147, '20120002', '860002', '20152', '2015-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` varchar(6) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Unit` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `Requirement` text,
  `Description` longtext,
  `created` datetime NOT NULL,
  `user_created` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`,`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `CourseID`, `Name`, `Unit`, `DepartmentID`, `Requirement`, `Description`, `created`, `user_created`, `updated`) VALUES
(13, 'IT1234', 'Lập trình mạng nâng cao', 3, 1, '["IT6789"]', '<p>dfgtfhykhjjhgfdfew</p>', '2015-11-05 09:53:01', NULL, '2015-11-25 21:20:42'),
(14, 'IT3454', 'Lý thuyết thông tin', 4, 1, '["IT6789"]', '', '2015-11-05 09:56:52', NULL, '2015-11-25 21:23:53'),
(16, 'IT3244', 'Cấu trúc dữ liệu', 3, 1, '["IT1234","IT6789"]', '', '2015-11-05 10:00:12', NULL, NULL),
(17, 'IT2312', 'Lý thuyết thông tin', 3, 1, '["IT1234","IT6789"]', '<p>âsdsa</p>', '2015-11-05 10:01:14', NULL, NULL),
(19, 'MI1234', 'Toán 4', 4, 1, '["MI6789","IT1234"]', '', '2015-11-05 10:33:37', NULL, NULL),
(20, 'IT6789', 'Lập trình web', 5, 1, 'false', '<p>33446464</p>', '2015-11-14 22:42:24', NULL, '2015-11-25 22:54:27'),
(22, 'SSH110', 'Nguyên lý Mac-Lenin', 2, 2, NULL, '<p>Hay</p>', '2015-11-25 21:25:55', NULL, '2015-11-25 21:31:32'),
(23, 'IT3421', 'Lập trình web nâng cao', 4, 1, '["IT6789"]', '', '2015-11-26 00:23:30', NULL, '2015-11-26 00:35:16'),
(24, 'IT5675', 'Lập trình cấu trúc', 2, 1, '["IT1234"]', '', '2015-11-27 13:33:53', NULL, '2015-11-27 13:35:27'),
(25, 'IT2214', 'Nhập môn công nghệ thông tin', 3, 1, NULL, 'Nhập môn', '2015-12-08 00:00:00', NULL, NULL),
(26, 'IT3321', 'Phát triển phần mềm theo chuẩn ITSS', 2, 1, NULL, NULL, '2015-12-24 03:15:29', NULL, NULL),
(27, 'MI3312', 'Toán 1', 3, 1, NULL, NULL, '2015-12-16 08:20:28', NULL, NULL),
(28, 'MI3313', 'Toán 2', 4, 1, '["MI3212"]', NULL, '2015-12-29 08:21:15', NULL, NULL),
(29, 'MI3214', 'Toán 3', 4, 1, '["MI3212","MI3213"]', NULL, '2015-12-20 00:00:00', NULL, NULL),
(30, 'HO3212', 'Hóa Đại Cương', 4, 1, NULL, NULL, '2015-12-28 08:22:22', NULL, NULL),
(31, 'JP2211', 'Tiếng nhật 1', 5, 1, NULL, NULL, '2015-12-21 00:00:00', NULL, NULL),
(32, 'JP2212', 'Tiếng Nhật 2', 5, 1, NULL, NULL, '2015-12-21 09:27:48', NULL, NULL),
(33, 'JP2213', 'Tiếng Nhật 3', 4, 1, NULL, NULL, '2015-12-28 13:14:25', NULL, NULL),
(34, 'VL2134', 'Vật Lý Đại Cương 1', 5, 3, NULL, NULL, '2015-12-15 00:00:00', NULL, NULL),
(35, 'VL2135', 'Vật lý đại cương 2', 4, 3, '["VL2134"]', NULL, '2015-12-18 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_register`
--

CREATE TABLE IF NOT EXISTS `course_register` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(11) NOT NULL DEFAULT '',
  `cid` varchar(11) NOT NULL DEFAULT '',
  `semester` varchar(11) NOT NULL DEFAULT '',
  `created` date DEFAULT NULL,
  PRIMARY KEY (`ID`,`sid`,`cid`,`semester`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `course_register`
--

INSERT INTO `course_register` (`ID`, `sid`, `cid`, `semester`, `created`) VALUES
(20, '20121908', 'IT6789', '20152', '2015-12-01'),
(21, '20121908', 'SSH110', '20152', '2015-12-01'),
(22, '20121908', 'VL2134', '20152', '2015-12-02'),
(23, '20121908', 'IT2214', '20152', '2015-12-02'),
(24, '20121908', 'IT3321', '20152', '2015-12-02'),
(25, '20120002', 'IT6789', '20152', '2015-12-02'),
(26, '20120002', 'SSH110', '20152', '2015-12-02'),
(27, '20120002', 'IT2214', '20152', '2015-12-02'),
(28, '20120002', 'HO3212', '20152', '2015-12-02'),
(29, '20120002', 'IT1234', '20152', '2015-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `dbo_khoa`
--

CREATE TABLE IF NOT EXISTS `dbo_khoa` (
  `MaKhoa` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `TenKhoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NgayTL` date DEFAULT NULL,
  PRIMARY KEY (`MaKhoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dbo_khoa`
--

INSERT INTO `dbo_khoa` (`MaKhoa`, `TenKhoa`, `NgayTL`) VALUES
('AQUA', 'Khoa Thủy Sản', '1979-01-01'),
('BIOTECH', 'Viện NC & Phát Triển Công Nghệ Sinh Học', '1960-01-01'),
('CAAB', 'Khoa Nông Nghiệp & Sinh Học Ứng Dụng', '1996-01-01'),
('CENRES', 'Khoa Môi Trường & Tài Nguyên Thiên Nhiên', '2008-01-21'),
('CIT', 'Khoa Công Nghệ Thông Tin & Truyền Thông', '1994-12-03'),
('CNS', 'Khoa Khoa Học Tự Nhiên', '1996-01-01'),
('CRD', 'Khoa Phát Triển Nông Thôn', '2011-06-28'),
('DEC', 'Trung Tâm Giáo Dục Quốc Phòng', '1975-01-01'),
('DPE', 'Bộ Môn Giáo Dục Thể Chất', '1976-01-01'),
('DRAGON', 'Viện Nghiên Cứu & Biến Đổi Khí Hậu', '2008-11-21'),
('GS', 'Khoa Sau Đại Học', '2012-01-01'),
('MDI', 'Viện NCPT Đồng Bằng Sông Cửu Long', '2005-03-24'),
('SE', 'Khoa Sư Phạm', '1996-01-01'),
('SEBA', 'Khoa Kinh Tế & Quản Trị Kinh Doanh', '1979-07-01'),
('SL', 'Khoa Luật', '2000-02-01'),
('SPS', 'Khoa Khoa Học Chính Trị', '1975-10-01'),
('SPU', 'Khoa Dự Bị Dân Tộc', '2007-10-26'),
('SSS', 'Khoa Khoa Học Xã Hội & Nhân Văn', '2009-09-17'),
('TECH', 'Khoa Công Nghệ', '1999-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DID` varchar(8) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`,`DID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`ID`, `DID`, `Name`) VALUES
(1, 'CNTT', 'Công nghệ thông tin'),
(2, 'SHH', 'Lý luận chính trị'),
(3, 'PHYSIC', 'Viện vật lý kỹ thuật');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `department_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` tinyint(1) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8_unicode_ci,
  `password` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_group` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `MaKhoa` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`id`, `department_id`, `firstname`, `lastname`, `birthday`, `sex`, `email`, `address`, `password`, `salt`, `updated`, `user_group`) VALUES
('000001', 'CNS', 'Nguyễn Xuân', 'Tranh', '1962-01-01', 1, 'nxtranh@ctu.edu.vn', 'Hà Nội', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000002', 'CNS', 'Nguyễn Quang', 'Hòa', '1960-01-01', 1, 'nqhoa@ctu.edu.vn  ', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000003', 'CNS', 'Hồ Hữu', 'Lộc', '1964-01-01', 1, 'hhloc@ctu.edu.vn', 'Hà Nội', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000004', 'CNS', 'Trần Ngọc', 'Liên', '1963-01-01', 0, 'tnlien@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000005', 'CNS', 'Lê Phương', 'Quân', '1967-01-01', 1, 'lpquan@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000006', 'CNS', 'Nguyễn Hữu', 'Khánh', '1960-01-01', 1, 'nhkhanh@ctu.edu.vn ', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000007', 'CNS', 'Võ Văn', 'Tài', '1972-01-01', 1, 'vvtai@ctu.edu.vn ', 'Vĩnh Long', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000008', 'CNS', 'Dương Thị', 'Tuyền', '1969-01-01', 0, 'dttuyen@ctu.edu.vn  ', 'Vĩnh Long', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000009', 'CNS', 'Lê Thị Kiều', 'Oanh', '1968-01-01', 0, 'ltkoanh@ctu.edu.vn  ', 'Tiền Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000010', 'CNS', 'Dương Hiếu', 'Đẩu', '1965-01-01', 1, 'dhdau@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000016', 'CNS', 'Lê Thanh', 'Phước', '1968-01-01', 1, 'ltphuoc@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('000019', 'CNS', 'Bùi Thị Bửu', 'Huê', '1968-01-01', 0, 'btbhue@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001039', 'CNS', 'Bùi Quốc', 'Chính', '1970-01-01', 1, 'bqchinh@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001042', 'CNS', 'Vũ Duy', 'Linh', '1971-01-01', 1, 'vdlinh@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001043', 'CNS', 'Nguyễn Minh', 'Trung', '1971-01-01', 1, 'trungnguyen@ctu.edu.vn  ', 'An Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001044', 'CNS', 'Nguyễn Nhị Gia', 'Vinh', '1972-01-01', 1, 'nngvinh@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001048', 'CNS', 'Nguyễn Hữu', 'Hòa', '1968-01-01', 1, 'nhhoa@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001100', 'CNS', 'Ngô Thanh', 'Phong', '1964-01-01', 1, 'ngophong@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001108', 'CNS', 'Nguyễn Thành', 'Tiên', '1964-01-01', 1, 'nttien@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001110', 'CNS', 'Đặng Hoàng', 'Tâm', '1970-01-01', 1, 'dhtam@ctu.edu.vn  ', 'Tiền Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001111', 'CNS', 'Trần', 'Văn Lý', '1973-01-01', 1, 'tvly@ctu.edu.vn  ', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001112', 'CNS', 'Nguyễn Đức', 'Khoa', '1973-01-01', 1, 'duckhoa@ctu.edu.vn', 'Bạc Liêu', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001113', 'CNS', 'Đỗ Thanh Liên', 'Ngân', '1972-01-01', 0, 'dtlngan@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001169', 'CNS', 'Hoàng Minh', 'Trí', '1968-01-01', 1, 'hmtri@ctu.edu.vn', 'Tiền Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001170', 'CNS', 'Nguyễn Thị Thùy', 'Linh', '1968-01-01', 0, 'nttlinh@ctu.edu.vn', 'Sóc Trăng', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001322', 'CNS', 'Lê Thị', 'Diễm', '1972-01-01', 0, 'ltdiem@ctu.edu.vn', 'Vĩnh Long', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001518', 'CNS', 'Lê Thanh', 'Tùng', '1973-01-01', 1, 'lttung@ctu.edu.vn  ', 'Bạc Liêu', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001602', 'CNS', 'Huỳnh Phụng', 'Toàn', '1974-01-01', 1, 'hptoan@ctu.edu.vn', 'Tiền Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001603', 'CNS', 'Hồ Văn', 'Tú', '1972-01-01', 1, 'hvtu@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001845', 'CNS', 'Đinh Ngọc', 'Quý', '1982-01-01', 1, 'dnquy@ctu.edu.vn ', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('001846', 'CNS', 'Lê Thị Mỹ', 'Xuân', '1980-01-01', 0, 'ltmxuan@ctu.edu.vn ', 'Vĩnh Long', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002084', 'CNS', 'Lâm Hoàng', 'Chương', '1983-01-01', 1, 'lhchuong@ctu.edu.vn', 'Vĩnh Long', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002085', 'CNS', 'Phạm Bích', 'Như', '1982-01-01', 0, 'pbnhu@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002171', 'CNS', 'Lê Hoài', 'Nhân', '1985-01-01', 1, 'lhnhan@ctu.edu.vn  ', 'Tiền Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002172', 'CNS', 'Trần Phước', 'Lộc', '1985-01-01', 1, 'tploc@ctu.edu.vn', 'Đồng Tháp', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002215', 'CNS', 'Nguyễn Thị Hồng', 'Dân', '1985-01-01', 0, 'nthdan@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002301', 'CNS', 'Lê Minh', 'Lý', '1985-01-01', 0, 'leminhly@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002302', 'CNS', 'Võ Hải', 'Đăng', '1985-01-01', 1, 'vhdang@ctu.edu.vn', 'Sóc Trăng', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002303', 'CNS', 'Nguyễn Tử', 'Thịnh', '1983-01-01', 1, 'ntthinh@ctu.edu.vn', 'Cà Mau', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002395', 'CNS', 'Đặng Mỹ', 'Hạnh', '1988-01-01', 0, 'dmhanh@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002454', 'CNS', 'Phạm Tr. Hồng', 'Ngân', '1986-01-01', 1, 'pthngan@ctu.edu.vn', 'Cần Thơ', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2),
('002455', 'CNS', 'Lê Văn', 'Quan', '1989-01-01', 1, 'lvquan@ctu.edu.vn', 'Kiên Giang', '64bfae7ae810da07b077b50365959650', 'adsadhiaugiu', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `timehp` varchar(100) NOT NULL,
  `timelh` varchar(100) NOT NULL,
  `description` text,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`, `start`, `end`, `timehp`, `timelh`, `description`, `updated`) VALUES
(1, '20142', '2014-08-10', '2015-02-01', '{"start":"2014-12-01","end":"2014-12-01"}', '{"start":"2014-12-01","end":"2015-01-16"}', NULL, '2015-11-29 21:44:25'),
(2, '20151', '2015-08-10', '2015-12-28', '{"start":"2015-11-02","end":"2015-11-04"}', '{"start":"2015-07-01","end":"2015-07-10"}', NULL, '2015-12-01 14:40:37'),
(4, '20152', '2016-01-11', '2016-06-06', '{"start":"2015-11-09","end":"2015-11-12"}', '{"start":"2015-12-01","end":"2015-12-03"}', NULL, '2015-12-01 21:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SID` varchar(8) NOT NULL COMMENT 'năm nhập học+STT trong khóa',
  `FirstName` varchar(40) DEFAULT NULL,
  `LastName` varchar(60) DEFAULT NULL,
  `Addres` varchar(100) DEFAULT NULL,
  `PIN` varchar(200) NOT NULL COMMENT 'Mặc định mã hóa name+SID',
  `Birthday` date DEFAULT NULL,
  `ClassID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `AcademyHistory` longtext,
  `salt` varchar(200) DEFAULT NULL,
  `user_group` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SID`),
  KEY `class_idx` (`ClassID`),
  KEY `department_idx` (`DepartmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `SID`, `FirstName`, `LastName`, `Addres`, `PIN`, `Birthday`, `ClassID`, `DepartmentID`, `AcademyHistory`, `salt`, `user_group`) VALUES
(1, '20121908', 'Lê Duy ', 'Khánh', 'Thành phố Hà Tĩnh', '64bfae7ae810da07b077b50365959650', '1994-01-19', 1, NULL, '["IT6789","IT1236"]', 'adsadhiaugiu', 1),
(2, '20120002', 'Lê Như', 'Lai', 'Hưng Yên', '64bfae7ae810da07b077b50365959650', '1994-04-13', 1, NULL, '["IT6789","IT1236"]', 'adsadhiaugiu', 1),
(3, '20101908', 'Đặng Văn', 'Anh', 'Đà Nẵng', '64bfae7ae810da07b077b50365959650', '1994-04-13', 1, NULL, NULL, 'adsadhiaugiu', 1),
(4, '20141994', 'Lê Như', 'Linh', 'Hà Tây', '64bfae7ae810da07b077b50365959650', '1994-07-19', 1, NULL, NULL, 'adsadhiaugiu', 1),
(5, '20131994', 'Đặng Văn', 'Hoàn', 'Tây Nguyên', '64bfae7ae810da07b077b50365959650', '1995-08-08', 1, NULL, NULL, 'adsadhiaugiu', 1),
(6, '20141111', 'Cao Thái ', 'Sơn', 'Lai Châu', '64bfae7ae810da07b077b50365959650', '1996-11-16', 1, NULL, NULL, 'adsadhiaugiu', 1),
(7, '20121234', 'Trần Khởi ', 'My', 'Cao Bằng', '64bfae7ae810da07b077b50365959650', '1994-10-05', 1, NULL, NULL, 'adsadhiaugiu', 1),
(8, '20116969', 'Đàm Vĩnh', 'Hưng', 'Bà Rịa Vũng Tàu', '64bfae7ae810da07b077b50365959650', '1969-09-06', 1, NULL, NULL, 'adsadhiaugiu', 1),
(9, '20122121', 'Trần Mỹ', 'Linh', 'Hà Nội', '64bfae7ae810da07b077b50365959650', '1990-06-09', 1, NULL, NULL, 'adsadhiaugiu', 1),
(10, '20111998', 'Lê Công ', 'Vinh', 'Nghệ An', '64bfae7ae810da07b077b50365959650', '1980-11-23', 1, NULL, NULL, 'adsadhiaugiu', 1),
(11, '20120001', 'Nguyễn', 'Ngọc Anh', 'Đô Lương Nghệ An', '64bfae7ae810da07b077b50365959650', '1994-12-01', 1, NULL, NULL, 'adsadhiaugiu', 1),
(12, '20111908', 'Đặng Mạnh', 'Chuẩn', 'TP Hưng Yên, Hưng Yên', '64bfae7ae810da07b077b50365959650', '1993-04-13', 1, NULL, NULL, 'adsadhiaugiu', 1),
(13, '20131902', 'Nguyễn Ngọc', 'Sơn', 'Hưng Yên', '64bfae7ae810da07b077b50365959650', '1994-08-08', 1, NULL, NULL, 'adsadhiaugiu', 1),
(14, '20125412', 'Lê Ngọc', 'Lai', 'Hưng Yên', '64bfae7ae810da07b077b50365959650', '1994-12-07', 1, NULL, NULL, 'adsadhiaugiu', 1),
(15, '20141994', 'Trần Mỹ', 'Anh', 'Hà Đông', '64bfae7ae810da07b077b50365959650', '1994-06-13', 1, NULL, NULL, 'adsadhiaugiu', 1),
(16, '20121546', 'Nguyễn Hữu', 'Dương', 'Thái Nguyên', '64bfae7ae810da07b077b50365959650', '1994-07-12', 1, NULL, NULL, 'adsadhiaugiu', 1),
(17, '20148765', 'Lê Duy', 'Quân', 'Hà Nam', '64bfae7ae810da07b077b50365959650', '1994-04-13', 1, NULL, NULL, 'adsadhiaugiu', 1),
(18, '20113489', 'Nguyễn Hữu', 'Mạnh', 'Hà Tây', '64bfae7ae810da07b077b50365959650', '1993-08-13', 1, NULL, NULL, 'adsadhiaugiu', 1),
(19, '20136457', 'Nguyễn Quốc ', 'Trường', 'Lào Cai', '64bfae7ae810da07b077b50365959650', '1993-12-28', 1, NULL, NULL, 'adsadhiaugiu', 1),
(20, '20102163', 'Lê Ngọc ', 'Linh', 'Hà Nội', '64bfae7ae810da07b077b50365959650', '1994-12-09', 1, NULL, NULL, 'adsadhiaugiu', 1),
(21, '20124548', 'Lê Ngọc', 'Khánh', 'Bắc Cạn', '64bfae7ae810da07b077b50365959650', '1993-12-21', 1, NULL, NULL, 'adsadhiaugiu', 1),
(23, '20131458', 'Nguyễn Huy', 'Tuấn', 'Hà Nội', '64bfae7ae810da07b077b50365959650', '1995-08-10', 1, NULL, NULL, 'adsadhiaugiu', 1),
(24, '20124784', 'Lê Công', 'Lương', 'Hà Tĩnh', '64bfae7ae810da07b077b50365959650', '1995-08-11', 1, NULL, NULL, 'adsadhiaugiu', 1),
(25, '2010', 'Nguyễn Phi', 'Hiệp', 'Hà Tĩnh ', '64bfae7ae810da07b077b50365959650', '1993-08-15', 1, NULL, NULL, 'adsadhiaugiu', 1),
(26, '20138789', 'Nguyễn Hữu', 'Nam', 'Hà Tây', '64bfae7ae810da07b077b50365959650', '1994-04-15', 1, NULL, NULL, 'adsadhiaugiu', 1),
(27, '20134796', 'Dương Thế', 'Anh', 'Thanh Hóa', '64bfae7ae810da07b077b50365959650', '1995-04-25', 1, NULL, NULL, 'adsadhiaugiu', 1),
(28, '20138741', 'Nguyễn Hữu ', 'Ngọc ', 'Nghệ An', '64bfae7ae810da07b077b50365959650', '1994-05-13', 1, NULL, NULL, 'adsadhiaugiu', 1),
(29, '20145793', 'Lê Quốc ', 'Lương', 'Bắc Ninh', '64bfae7ae810da07b077b50365959650', '1990-12-14', 1, NULL, NULL, 'adsadhiaugiu', 1),
(30, '20125478', 'Lê Văn ', 'Đa', 'Hải Dương', '64bfae7ae810da07b077b50365959650', '1994-04-22', 1, NULL, NULL, 'adsadhiaugiu', 1),
(31, '20147896', 'Dương Trọng', 'Linh', 'Hải Dương', '64bfae7ae810da07b077b50365959650', '1994-06-02', 1, NULL, NULL, 'adsadhiaugiu', 1),
(32, '20136547', 'Đào Danh', 'Quốc', 'Cà Mau', '64bfae7ae810da07b077b50365959650', '1993-12-21', 1, NULL, NULL, 'adsadhiaugiu', 1),
(33, '20148888', 'Lương Sơn', 'Bá', 'Quảng Đông', '64bfae7ae810da07b077b50365959650', '1943-08-14', 1, NULL, NULL, 'adsadhiaugiu', 1),
(34, '20143221', 'Đào Quốc ', 'Trọng', 'Lai Châu', '64bfae7ae810da07b077b50365959650', '1994-04-07', 1, NULL, NULL, 'adsadhiaugiu', 1),
(35, '20134445', 'Trần Mạnh', 'Tiến', 'Thanh Hóa', '64bfae7ae810da07b077b50365959650', '1995-07-21', 1, NULL, NULL, 'adsadhiaugiu', 1),
(36, '20136644', 'Trương Đăng', ' Mạnh', 'Mỹ Tho', '64bfae7ae810da07b077b50365959650', '1991-12-06', 1, NULL, NULL, 'adsadhiaugiu', 1),
(37, '20135546', 'Cao Thanh ', 'Lâm', 'Hà Nội', '64bfae7ae810da07b077b50365959650', '1969-07-08', 1, NULL, NULL, 'adsadhiaugiu', 1),
(38, '2013', 'Lê Tuấn', 'Dũng', 'Sapa', '64bfae7ae810da07b077b50365959650', '1994-12-23', 1, NULL, NULL, 'adsadhiaugiu', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `class` FOREIGN KEY (`ClassID`) REFERENCES `class_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `department` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
