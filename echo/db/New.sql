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
CREATE DATABASE IF NOT EXISTS `runsystemdms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `runsystemdms`;

-- Dumping structure for table runsystemdms.tblgroup
CREATE TABLE IF NOT EXISTS `tblgroup` (
  `GrpCode` varchar(16) NOT NULL,
  `GrpName` varchar(80) NOT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`GrpCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table runsystemdms.tblgroupmenu
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

-- Data exporting was unselected.

-- Dumping structure for table runsystemdms.tblmenu
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

-- Data exporting was unselected.

-- Dumping structure for table runsystemdms.tblprojectgroup
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

-- Data exporting was unselected.

-- Dumping structure for table runsystemdms.tbluser
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

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
