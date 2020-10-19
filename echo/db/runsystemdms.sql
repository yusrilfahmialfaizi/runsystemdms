-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for runsystemdms
DROP DATABASE IF EXISTS `runsystemdms`;
CREATE DATABASE IF NOT EXISTS `runsystemdms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `runsystemdms`;

-- Dumping structure for table runsystemdms.tblgroup
DROP TABLE IF EXISTS `tblgroup`;
CREATE TABLE IF NOT EXISTS `tblgroup` (
  `GrpCode` varchar(16) NOT NULL,
  `GrpName` varchar(80) NOT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`GrpCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table runsystemdms.tblgroup: ~16 rows (approximately)
/*!40000 ALTER TABLE `tblgroup` DISABLE KEYS */;
REPLACE INTO `tblgroup` (`GrpCode`, `GrpName`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('11', 'Teknik Informatika', 'Admin', '202003231117', NULL, NULL),
	('12', 'Reka Medik', 'Admin', '202003231117', NULL, NULL),
	('13', 'gizi klinik', 'Admin', '202003231117', NULL, NULL),
	('14', 'Peternakan', 'Admin', '202003231117', NULL, NULL),
	('15', 'Bahasa', 'Admin', '202003231117', NULL, NULL),
	('16', 'Manajemen', 'Admin', '202003231117', NULL, NULL),
	('17', 'Akuntansi', 'Admin', '202003231117', NULL, NULL),
	('18', 'Perkebunan', 'Admin', '202003231117', NULL, NULL),
	('19', 'Benih', 'Admin', '202003231117', NULL, NULL),
	('20', 'Perhotelan', 'Admin', '202003231117', NULL, NULL),
	('21', 'Hukum', 'Admin', '202003231117', NULL, NULL),
	('22', 'Ekonomi', 'Admin', '202003231117', NULL, NULL),
	('23', 'Sejarah', 'Admin', '202003231117', NULL, NULL),
	('24', 'Kedokteran', 'Admin', '202003231117', NULL, NULL),
	('25', 'Teknik', 'Admin', '202003231117', NULL, NULL),
	('26', 'Framasi', 'Admin', '202003231117', NULL, NULL);
/*!40000 ALTER TABLE `tblgroup` ENABLE KEYS */;

-- Dumping structure for table runsystemdms.tblgroupmenu
DROP TABLE IF EXISTS `tblgroupmenu`;
CREATE TABLE IF NOT EXISTS `tblgroupmenu` (
  `MenuCode` varchar(16) NOT NULL,
  `GrpCode` varchar(16) NOT NULL,
  `AccessInd` varchar(5) NOT NULL DEFAULT 'NNNNN',
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`GrpCode`,`MenuCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table runsystemdms.tblgroupmenu: ~16 rows (approximately)
/*!40000 ALTER TABLE `tblgroupmenu` DISABLE KEYS */;
REPLACE INTO `tblgroupmenu` (`MenuCode`, `GrpCode`, `AccessInd`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('01', '11', 'YYNYY', 'system', '202003231117', NULL, NULL),
	('01', '12', 'YYNYY', 'system', '202003231117', NULL, NULL),
	('01', '13', 'YYNYY', 'system', '202003231117', NULL, NULL),
	('01', '14', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '15', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '16', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '17', 'YYNYY', 'system', '202003231117', NULL, NULL),
	('01', '18', 'YYNYY', 'system', '202003231117', NULL, NULL),
	('01', '19', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '20', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '21', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '22', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '23', 'YYNYY', 'mei', '202003231117', NULL, NULL),
	('01', '24', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '25', 'YYNYY', 'ayu', '202003231117', NULL, NULL),
	('01', '26', 'YYNYY', 'system', '202003231117', NULL, NULL);
/*!40000 ALTER TABLE `tblgroupmenu` ENABLE KEYS */;

-- Dumping structure for table runsystemdms.tblmenu
DROP TABLE IF EXISTS `tblmenu`;
CREATE TABLE IF NOT EXISTS `tblmenu` (
  `MenuCode` varchar(16) NOT NULL,
  `MenuDesc` varchar(80) NOT NULL,
  `Parent` varchar(16) DEFAULT NULL,
  `Param` varchar(80) DEFAULT NULL,
  `Icon` varchar(80) DEFAULT NULL,
  `StdInd` varchar(1) NOT NULL DEFAULT 'Y',
  `SpcInd` varchar(1) NOT NULL DEFAULT 'N',
  `Visible` varchar(1) NOT NULL DEFAULT 'Y',
  `MenuCat` varchar(1) NOT NULL DEFAULT 'D',
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`MenuCode`),
  KEY `Parent` (`Parent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table runsystemdms.tblmenu: ~10 rows (approximately)
/*!40000 ALTER TABLE `tblmenu` DISABLE KEYS */;
REPLACE INTO `tblmenu` (`MenuCode`, `MenuDesc`, `Parent`, `Param`, `Icon`, `StdInd`, `SpcInd`, `Visible`, `MenuCat`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('01', 'Module', NULL, NULL, NULL, 'Y', 'N', 'Y', 'D', 'Yusril', '15-10-2020', NULL, NULL),
	('101', 'General', '01', '', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10101', 'Document Approval', '0101', 'FrmDocApproval', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10102', 'Country', '0101', 'FrmCountry', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10103', 'Province', '0101', 'FrmProvince', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10104', 'City', '0101', 'FrmCity', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10105', 'Sub District', '0101', 'FrmSubDistrict', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10106', 'Village', '0101', 'FrmVillage', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10107', 'Activity', '0101', 'FrmActivity', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL),
	('10108', 'Transport Type', '0101', 'FrmTransportType', 'MenuApplication', 'Y', 'N', 'Y', 'D', 'TKG', '202003231117', NULL, NULL);
/*!40000 ALTER TABLE `tblmenu` ENABLE KEYS */;

-- Dumping structure for table runsystemdms.tblprojectgroup
DROP TABLE IF EXISTS `tblprojectgroup`;
CREATE TABLE IF NOT EXISTS `tblprojectgroup` (
  `PGCode` varchar(16) NOT NULL,
  `PGName` varchar(100) NOT NULL,
  `ActInd` varchar(1) NOT NULL DEFAULT 'Y',
  `ProjectCode` varchar(16) DEFAULT NULL,
  `ProjectName` varchar(300) DEFAULT NULL,
  `CtCode` varchar(15) DEFAULT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`PGCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table runsystemdms.tblprojectgroup: ~2 rows (approximately)
/*!40000 ALTER TABLE `tblprojectgroup` DISABLE KEYS */;
REPLACE INTO `tblprojectgroup` (`PGCode`, `PGName`, `ActInd`, `ProjectCode`, `ProjectName`, `CtCode`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('A000001', 'Backend', 'Y', 'PC00001', 'Api', 'A', 'Admin', '202003231117', NULL, NULL),
	('A000002', 'Frontend', 'y', 'PC00002', 'DB', 'B', 'Admin', '202003231117', NULL, NULL);
/*!40000 ALTER TABLE `tblprojectgroup` ENABLE KEYS */;

-- Dumping structure for table runsystemdms.tbluser
DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `Usercode` varchar(16) NOT NULL,
  `Username` varchar(80) NOT NULL,
  `GrpCode` varchar(16) NOT NULL,
  `Pwd` varchar(255) NOT NULL,
  `EXPDt` varchar(8) DEFAULT NULL,
  `NotifyInd` varchar(1) NOT NULL DEFAULT 'N',
  `HasQiscusAccount` tinyint(1) DEFAULT NULL,
  `AvatarImage` varchar(100) DEFAULT NULL,
  `deviceid` varchar(300) DEFAULT NULL,
  `Createby` varchar(30) NOT NULL,
  `Createat` varchar(16) NOT NULL,
  `LastupBy` varchar(16) DEFAULT NULL,
  `LastupDt` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`Usercode`),
  KEY `FK_tbluser_tblgroup` (`GrpCode`),
  KEY `Username` (`Username`),
  KEY `HasQiscusAccount` (`HasQiscusAccount`),
  KEY `AvatarImage` (`AvatarImage`),
  KEY `deviceid` (`deviceid`),
  CONSTRAINT `FK_tbluser_tblgroup` FOREIGN KEY (`GrpCode`) REFERENCES `tblgroup` (`GrpCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table runsystemdms.tbluser: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbluser` DISABLE KEYS */;
REPLACE INTO `tbluser` (`Usercode`, `Username`, `GrpCode`, `Pwd`, `EXPDt`, `NotifyInd`, `HasQiscusAccount`, `AvatarImage`, `deviceid`, `Createby`, `Createat`, `LastupBy`, `LastupDt`) VALUES
	('E41170827', 'Munir', '11', 'munir', NULL, 'N', NULL, NULL, NULL, 'munir', '15-10-2020', NULL, NULL),
	('E41171015', 'Yusril', '11', 'yusril', NULL, 'N', NULL, NULL, NULL, 'yusril', '15-10-2020', NULL, NULL),
	('E41172092', 'Rofan', '11', 'ropan', NULL, 'N', NULL, NULL, NULL, 'ropan', '15-10-2020', NULL, NULL);
/*!40000 ALTER TABLE `tbluser` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
