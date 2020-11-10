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

-- membuang struktur untuk table runsystemdms.tbldocumentdtl
DROP TABLE IF EXISTS `tbldocumentdtl`;
CREATE TABLE IF NOT EXISTS `tbldocumentdtl` (
  `Docno` varchar(50) NOT NULL,
  `MenuCode` varchar(16) NOT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Status` varchar(1) NOT NULL DEFAULT 'O',
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`Docno`,`MenuCode`),
  KEY `Docno` (`Docno`),
  KEY `MenuCode` (`MenuCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tbldocumentdtl: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbldocumentdtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldocumentdtl` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tbldocumenthdr
DROP TABLE IF EXISTS `tbldocumenthdr`;
CREATE TABLE IF NOT EXISTS `tbldocumenthdr` (
  `Docno` varchar(50) NOT NULL,
  `ModulCode` varchar(16) NOT NULL,
  `ActiveInd` varchar(1) NOT NULL DEFAULT 'N',
  `Status` varchar(1) NOT NULL DEFAULT 'O',
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`Docno`,`ModulCode`),
  KEY `Docno` (`Docno`),
  KEY `ModulCode` (`ModulCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tbldocumenthdr: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tbldocumenthdr` DISABLE KEYS */;
REPLACE INTO `tbldocumenthdr` (`Docno`, `ModulCode`, `ActiveInd`, `Status`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('0001/GSS/INVESTAI/FICO/11/2020', 'FICO', 'N', 'O', 'ICA', '202011101309', NULL, NULL),
	('0001/GSS/INVESTAI/HRM/11/2020', 'HRM', 'N', 'O', 'ICA', '202011101309', NULL, NULL),
	('0002/GSS/INVESTAI/FICO/11/2020', 'FICO', 'N', 'O', 'ICA', '202011101312', NULL, NULL),
	('0002/GSS/INVESTAI/HRM/11/2020', 'HRM', 'N', 'O', 'ICA', '202011101312', NULL, NULL),
	('0003/GSS/INVESTAI/FICO/11/2020', 'FICO', 'Y', 'O', 'ICA', '202011102013', NULL, NULL),
	('0003/GSS/INVESTAI/HRM/11/2020', 'HRM', 'Y', 'O', 'ICA', '202011102014', NULL, NULL);
/*!40000 ALTER TABLE `tbldocumenthdr` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tblgroup
DROP TABLE IF EXISTS `tblgroup`;
CREATE TABLE IF NOT EXISTS `tblgroup` (
  `GrpCode` varchar(16) NOT NULL,
  `GrpName` varchar(80) NOT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`GrpCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel runsystemdms.tblgroup: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tblgroup` DISABLE KEYS */;
REPLACE INTO `tblgroup` (`GrpCode`, `GrpName`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('Adm', 'Admin', 'ICA', '202011061103', NULL, NULL),
	('SysAdm', 'System', 'ICA', '202011061104', NULL, NULL);
/*!40000 ALTER TABLE `tblgroup` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tblgroupmenu
DROP TABLE IF EXISTS `tblgroupmenu`;
CREATE TABLE IF NOT EXISTS `tblgroupmenu` (
  `MenuCode` varchar(16) NOT NULL,
  `GrpCode` varchar(16) NOT NULL,
  `AccessInd` varchar(5) NOT NULL DEFAULT 'NNNNN' COMMENT '1=Insert, 2=Edit, 3=Delete, 4=Print, 5=Spreadsheet',
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`MenuCode`,`GrpCode`),
  KEY `MenuCode` (`MenuCode`),
  KEY `GrpCode` (`GrpCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel runsystemdms.tblgroupmenu: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tblgroupmenu` DISABLE KEYS */;
REPLACE INTO `tblgroupmenu` (`MenuCode`, `GrpCode`, `AccessInd`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('010101', 'SysAdm', 'YYNYY', 'ICA', '202011061106', NULL, NULL);
/*!40000 ALTER TABLE `tblgroupmenu` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tblmodul
DROP TABLE IF EXISTS `tblmodul`;
CREATE TABLE IF NOT EXISTS `tblmodul` (
  `ModulCode` varchar(16) NOT NULL,
  `ModulName` varchar(200) NOT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`ModulCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tblmodul: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `tblmodul` DISABLE KEYS */;
REPLACE INTO `tblmodul` (`ModulCode`, `ModulName`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('FICO', 'Financial and Cost Management', 'Ica', '202006110956', NULL, NULL),
	('HRM', 'Human Resource Management', 'Ica', '202006110954', NULL, NULL);
/*!40000 ALTER TABLE `tblmodul` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tblmodulmenu
DROP TABLE IF EXISTS `tblmodulmenu`;
CREATE TABLE IF NOT EXISTS `tblmodulmenu` (
  `MenuCode` varchar(16) NOT NULL,
  `ModulCode` varchar(16) NOT NULL,
  `MenuDesc` varchar(80) NOT NULL,
  `Parent` varchar(16) DEFAULT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`MenuCode`,`ModulCode`),
  KEY `Parent` (`Parent`),
  KEY `ModulCode` (`ModulCode`),
  KEY `MenuCode` (`MenuCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Membuang data untuk tabel runsystemdms.tblmodulmenu: ~34 rows (lebih kurang)
/*!40000 ALTER TABLE `tblmodulmenu` DISABLE KEYS */;
REPLACE INTO `tblmodulmenu` (`MenuCode`, `ModulCode`, `MenuDesc`, `Parent`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('0101', 'FICO', 'Accounting Management', '', 'ICA', '202006111041', NULL, NULL),
	('010101', 'FICO', 'Enterprise Accounting', '0101', 'ICA', '202006111041', NULL, NULL),
	('01010101', 'FICO', 'Account Category', '010101', 'ICA', '202006111041', NULL, NULL),
	('01010102', 'FICO', 'Chart of Account', '010101', 'ICA', '202006111041', NULL, NULL),
	('01010104', 'FICO', 'Business Entity', '020101', 'ICA', '202006111041', NULL, NULL),
	('01010105', 'FICO', 'Yearly Closing and Opening Balance', '010101', 'ICA', '202006111041', NULL, NULL),
	('010102', 'FICO', 'Asset Management', '0101', 'ICA', '202006111041', NULL, NULL),
	('01010201', 'FICO', 'Master Asset', '010102', 'ICA', '202006111041', NULL, NULL),
	('01010204', 'FICO', 'Depreciation of Business Assets', '010102', 'ICA', '202006111041', NULL, NULL),
	('010103', 'FICO', 'Cost Control', '0101', 'ICA', '202006111041', NULL, NULL),
	('01010301', 'FICO', 'Cost Center', '010103', 'ICA', '202006111041', NULL, NULL),
	('01010302', 'FICO', 'Cost Category', '010103', 'ICA', '202006111041', NULL, NULL),
	('01010303', 'FICO', 'Updating Item\'s Cost Category', '010103', 'ICA', '202006111041', NULL, NULL),
	('01010304', 'FICO', 'Generate Cost Center And Cost Category Data', '010103', 'ICA', '202006111041', NULL, NULL),
	('01010305', 'FICO', 'Updating Cost Category And DO/Return (Dept) Journal', '010103', 'ICA', '202006111041', NULL, NULL),
	('0102', 'FICO', 'Finance Management', '', 'ICA', '202006111041', NULL, NULL),
	('010201', 'FICO', 'Currency', '0102', 'ICA', '202006111041', NULL, NULL),
	('010202', 'FICO', 'Currency Rate', '0102', 'ICA', '202006111041', NULL, NULL),
	('010203', 'FICO', 'Term of Payment', '0102', 'ICA', '202006111041', NULL, NULL),
	('010204', 'FICO', 'Tax', '0102', 'ICA', '202006111041', NULL, NULL),
	('012010205', 'FICO', 'Accumulation Asset Depreciation Journal', '010102', 'ICA', '202006111041', NULL, NULL),
	('0201', 'HRM', 'Organizational Development', '', 'ICA', '202006111041', NULL, NULL),
	('020101', 'HRM', 'Organizational Structure', '0201', 'ICA', '202006111041', NULL, NULL),
	('02010101', 'HRM', 'Division', '020101', 'ICA', '202006111041', NULL, NULL),
	('02010102', 'HRM', 'Profit Center', '020101', 'ICA', '202006111041', NULL, NULL),
	('02010103', 'HRM', 'Site/Unit', '020101', 'ICA', '202006111041', NULL, NULL),
	('02010104', 'HRM', 'Department', '020101', 'ICA', '202006111041', NULL, NULL),
	('02010105', 'HRM', 'Section', '020101', 'ICA', '202006111041', NULL, NULL),
	('020105', 'HRM', 'Mutation, Promotion & Demotion', '0201', 'ICA', '202006111041', NULL, NULL),
	('02010503', 'HRM', 'Payroll Process Setting', '020105', 'ICA', '202006111041', NULL, NULL),
	('0202', 'HRM', 'Recruitment', '', 'ICA', '202006111041', NULL, NULL),
	('020201', 'HRM', 'Employee Request', '0202', 'ICA', '202006111041', NULL, NULL),
	('020202', 'HRM', 'Personal Information', '0202', 'ICA', '202006111041', NULL, NULL),
	('020205', 'FICO', 'Closing Balance In Cash/Bank Account', '0102', 'ICA', '202006111041', NULL, NULL);
/*!40000 ALTER TABLE `tblmodulmenu` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tblprojectgroup
DROP TABLE IF EXISTS `tblprojectgroup`;
CREATE TABLE IF NOT EXISTS `tblprojectgroup` (
  `PGCode` varchar(16) NOT NULL,
  `PGName` varchar(100) NOT NULL,
  `ActInd` varchar(1) NOT NULL DEFAULT 'Y',
  `ProjectCode` varchar(16) DEFAULT NULL,
  `ProjectName` varchar(600) DEFAULT NULL,
  `CtCode` varchar(15) DEFAULT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`PGCode`),
  KEY `ActInd` (`ActInd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tblprojectgroup: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tblprojectgroup` DISABLE KEYS */;
REPLACE INTO `tblprojectgroup` (`PGCode`, `PGName`, `ActInd`, `ProjectCode`, `ProjectName`, `CtCode`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('INVIMS001', 'INVESTASI', 'Y', 'INVIMS001', 'INVESTASI', NULL, 'ICA', '202011061108', '', '');
/*!40000 ALTER TABLE `tblprojectgroup` ENABLE KEYS */;

-- membuang struktur untuk table runsystemdms.tbluser
DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `UserCode` varchar(16) NOT NULL,
  `UserName` varchar(80) NOT NULL,
  `GrpCode` varchar(16) NOT NULL,
  `Pwd` varchar(255) NOT NULL,
  `ExpDt` varchar(8) DEFAULT NULL,
  `NotifyInd` varchar(1) NOT NULL DEFAULT 'N',
  `HasQiscusAccount` tinyint(1) DEFAULT NULL,
  `AvatarImage` varchar(100) DEFAULT NULL,
  `deviceid` varchar(300) DEFAULT NULL,
  `CreateBy` varchar(16) NOT NULL,
  `CreateDt` varchar(12) NOT NULL,
  `LastUpBy` varchar(16) DEFAULT NULL,
  `LastUpDt` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`UserCode`),
  KEY `UserName` (`UserName`),
  KEY `GrpCode` (`GrpCode`),
  KEY `HasQiscusAccount` (`HasQiscusAccount`),
  KEY `deviceid` (`deviceid`),
  KEY `AvatarImage` (`AvatarImage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel runsystemdms.tbluser: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `tbluser` DISABLE KEYS */;
REPLACE INTO `tbluser` (`UserCode`, `UserName`, `GrpCode`, `Pwd`, `ExpDt`, `NotifyInd`, `HasQiscusAccount`, `AvatarImage`, `deviceid`, `CreateBy`, `CreateDt`, `LastUpBy`, `LastUpDt`) VALUES
	('ICA', 'Rissa Raenida', 'SysAdm', '1234', NULL, 'N', NULL, NULL, NULL, 'ICA', '202006111105', NULL, NULL);
/*!40000 ALTER TABLE `tbluser` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
