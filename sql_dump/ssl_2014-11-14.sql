# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.34)
# Database: ssl
# Generation Time: 2014-11-15 04:05:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table fruits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fruits`;

CREATE TABLE `fruits` (
  `fruit_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fruit_name` varchar(50) DEFAULT NULL,
  `fruit_color` varchar(50) DEFAULT '',
  `fruit_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fruit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `fruits` WRITE;
/*!40000 ALTER TABLE `fruits` DISABLE KEYS */;

INSERT INTO `fruits` (`fruit_id`, `fruit_name`, `fruit_color`, `fruit_img`)
VALUES
	(2,'Apple','Red','http://images6.fanpop.com/image/photos/34500000/Juicy-Red-Apple-colors-34562925-693-693.jpg'),
	(3,'Apple','Green','https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQYZiFIRmmIoM_xsuMtj9d4F4gXmyJyZFBvReujASlsmOIYaGnl'),
	(4,'Banana','Yellow','http://img3.wikia.nocookie.net/__cb20130527193204/dragonball/images/3/32/Banana-1-.jpg'),
	(6,'Strawberry','Red','http://www.pop-a-harrys.com/images/categories/Strawberry.jpg'),
	(8,'Kiwi','Brown','http://froyoworld.com/wp-content/uploads/2014/01/kiwi.jpg');

/*!40000 ALTER TABLE `fruits` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
