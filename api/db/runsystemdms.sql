-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.5.6-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk runsystemdms
DROP DATABASE IF EXISTS `runsystemdms`;
CREATE DATABASE IF NOT EXISTS `runsystemdms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `runsystemdms`;

-- membuang struktur untuk table runsystemdms.tblgroup
DROP TABLE IF EXISTS `tblgroup`;
CREATE TABLE IF NOT EXISTS `tblgroup` (
  `GrpCode` varchar(16) NOT NULL,
  `GrpName` varchar(80) NOT NULL DEFAULT '',
  KEY `FK_tblgroup_tbluser` (`GrpCode`),
  CONSTRAINT `FK_tblgroup_tbluser` FOREIGN KEY (`GrpCode`) REFERENCES `tbluser` (`GrpCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tblgroup: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tblgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblgroup` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tblprojectgroup
DROP TABLE IF EXISTS `tblprojectgroup`;
CREATE TABLE IF NOT EXISTS `tblprojectgroup` (
  `PGCode` varchar(16) NOT NULL,
  `PGName` varchar(100) NOT NULL,
  `ActInd` varchar(1) NOT NULL,
  `ProjectCode` varchar(16) DEFAULT NULL,
  `ProjectName` varchar(300) DEFAULT NULL,
  `CtCode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`PGCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tblprojectgroup: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tblprojectgroup` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprojectgroup` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tbluser
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
  KEY `GrpCode` (`GrpCode`),
  CONSTRAINT `tbluser_ibfk_1` FOREIGN KEY (`GrpCode`) REFERENCES `tblgroup` (`GrpCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tbluser: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbluser` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbluser` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
