# ************************************************************
# Sequel Ace SQL dump
# Version 20062
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: hellotext.online (MySQL 8.0.35-0ubuntu0.22.04.1)
# Database: fabricare
# Generation Time: 2024-03-10 09:33:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_addresses`;

CREATE TABLE `tbl_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `address_title` varchar(50) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_addresses` WRITE;
/*!40000 ALTER TABLE `tbl_addresses` DISABLE KEYS */;

INSERT INTO `tbl_addresses` (`id`, `user_id`, `address_title`, `address1`, `address2`, `name`, `phone_number`, `email_address`, `pincode`, `created_on`)
VALUES
	(2,9,'My Room','Sri lakshmi heavens mens pg,Beside Vikram hospital, Madhapur','Madhapur','Akhil Kumar','9885800328','akhil.srikakolapu@gmail.com','1','2024-03-07 10:36:45');

/*!40000 ALTER TABLE `tbl_addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_order_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_order_items`;

CREATE TABLE `tbl_order_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_order_items` WRITE;
/*!40000 ALTER TABLE `tbl_order_items` DISABLE KEYS */;

INSERT INTO `tbl_order_items` (`id`, `order_id`, `product_id`, `service_id`, `quantity`, `price`, `created_on`)
VALUES
	(1,2,1,1,10,12.00,NULL),
	(2,2,2,2,1,12.00,NULL),
	(3,2,3,1,1,20.00,NULL),
	(4,3,4,2,1,40.00,NULL),
	(5,3,1,1,4,12.00,NULL),
	(6,3,2,2,1,12.00,NULL),
	(7,3,3,1,1,20.00,NULL);

/*!40000 ALTER TABLE `tbl_order_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_orders`;

CREATE TABLE `tbl_orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `sub_total` decimal(20,2) DEFAULT NULL,
  `service_charge` decimal(20,2) DEFAULT NULL,
  `discount` decimal(20,2) DEFAULT NULL,
  `grand_total` decimal(20,2) DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `payment_status` enum('Pending','Paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `is_coupon_applied` enum('Yes','No') CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL DEFAULT 'No',
  `coupon_id` int DEFAULT NULL,
  `status` enum('Pending','Picked','Completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `payment_response` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_orders` WRITE;
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;

INSERT INTO `tbl_orders` (`id`, `reference_number`, `user_id`, `sub_total`, `service_charge`, `discount`, `grand_total`, `pickup_date`, `address_id`, `payment_status`, `is_coupon_applied`, `coupon_id`, `status`, `payment_response`, `created_on`)
VALUES
	(2,'20240309-3641',9,152.00,30.00,0.00,182.00,'2024-03-11 22:00:46',2,'Pending','No',NULL,'Pending',NULL,'2024-03-09 00:46:57'),
	(3,'20240309-6358',9,120.00,30.00,0.00,150.00,'2024-03-14 20:31:10',2,'Pending','No',NULL,'Pending',NULL,'2024-03-09 06:58:26');

/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
