-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.20


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema ssproject
--

CREATE DATABASE IF NOT EXISTS ssproject;
USE ssproject;

--
-- Definition of table `rec_file`
--

DROP TABLE IF EXISTS `rec_file`;
CREATE TABLE `rec_file` (
  `f_no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_rec` int(10) unsigned NOT NULL,
  `f_seed` varchar(11) NOT NULL,
  `f_type` varchar(45) NOT NULL,
  `f_file` mediumblob NOT NULL,
  `f_size` int(10) unsigned NOT NULL,
  `f_date` int(10) unsigned NOT NULL,
  `f_hash` varchar(33) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  PRIMARY KEY (`f_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rec_file`
--

/*!40000 ALTER TABLE `rec_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `rec_file` ENABLE KEYS */;


--
-- Definition of table `user_rec`
--

DROP TABLE IF EXISTS `user_rec`;
CREATE TABLE `user_rec` (
  `r_no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `r_user` varchar(100) NOT NULL,
  `r_file` varchar(2) NOT NULL,
  `r_date` int(10) unsigned NOT NULL,
  `r_seed` varchar(11) NOT NULL,
  `r_name` varchar(255) NOT NULL,
  `r_down` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`r_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rec`
--

/*!40000 ALTER TABLE `user_rec` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_rec` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
