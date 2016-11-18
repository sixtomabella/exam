-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema vehicle
--

CREATE DATABASE IF NOT EXISTS vehicle;
USE vehicle;

--
-- Temporary table structure for view `vehicleview`
--
DROP TABLE IF EXISTS `vehicleview`;
DROP VIEW IF EXISTS `vehicleview`;
CREATE TABLE `vehicleview` (
  `id` int(10) unsigned,
  `vehiclename` varchar(100),
  `enginedisplacement` decimal(10,2),
  `idtype_name` int(10) unsigned,
  `type_name` varchar(45),
  `enginepower` varchar(45),
  `dateime` timestamp
);

--
-- Definition of table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` (`id`,`type_name`,`fullname`) VALUES 
 (1,'L','Liters'),
 (2,'CI','Cubic Inches'),
 (3,'CC','Cubic Centimeters');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;


--
-- Definition of table `vehicleinformation`
--

DROP TABLE IF EXISTS `vehicleinformation`;
CREATE TABLE `vehicleinformation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vehiclename` varchar(100) NOT NULL,
  `enginedisplacement` decimal(10,2) NOT NULL,
  `unit` int(10) unsigned NOT NULL,
  `enginepower` varchar(45) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deldata` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicleinformation`
--

/*!40000 ALTER TABLE `vehicleinformation` DISABLE KEYS */;
INSERT INTO `vehicleinformation` (`id`,`vehiclename`,`enginedisplacement`,`unit`,`enginepower`,`datetime`,`deldata`) VALUES 
 (2,'abc','1.20',1,'200','2016-11-18 08:54:11',0),
 (3,'abc12','3000.00',3,'2003','2016-11-16 21:55:32',0),
 (4,'bcv','4500.00',2,'4500','2016-11-18 08:18:06',0),
 (5,'tyr','1.00',1,'400','2016-11-18 08:46:27',0);
/*!40000 ALTER TABLE `vehicleinformation` ENABLE KEYS */;


--
-- Definition of view `vehicleview`
--

DROP TABLE IF EXISTS `vehicleview`;
DROP VIEW IF EXISTS `vehicleview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vehicleview` AS select `v`.`id` AS `id`,`v`.`vehiclename` AS `vehiclename`,`v`.`enginedisplacement` AS `enginedisplacement`,`u`.`id` AS `idtype_name`,`u`.`type_name` AS `type_name`,`v`.`enginepower` AS `enginepower`,`v`.`datetime` AS `dateime` from (`vehicleinformation` `v` join `units` `u`) where ((`v`.`unit` = `u`.`id`) and (`v`.`deldata` = 0));



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
