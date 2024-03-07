# ************************************************************
# Sequel Ace SQL dump
# Version 20062
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: hellotext.online (MySQL 8.0.35-0ubuntu0.22.04.1)
# Database: fabricare
# Generation Time: 2024-03-07 14:34:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table api_user_login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_user_login`;

CREATE TABLE `api_user_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bearer_token` varchar(100) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table tbl_banners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_banners`;

CREATE TABLE `tbl_banners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `banner_sub_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `banner_img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `action_link` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime(4) NOT NULL,
  `updated_on` datetime(4) NOT NULL,
  `created_by` int NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_banners` WRITE;
/*!40000 ALTER TABLE `tbl_banners` DISABLE KEYS */;

INSERT INTO `tbl_banners` (`id`, `banner_title`, `banner_sub_title`, `banner_img`, `action_link`, `created_on`, `updated_on`, `created_by`, `status`)
VALUES
	(1,'Professional Laundry Services near you','Some representative placeholder content for the second slide.','uploads/banners/2024-03-02-07-29-1935a9d0oe1f.jpg','test32','2024-03-01 08:43:45.0000','2024-03-02 07:29:34.0000',1,'Active'),
	(2,'We Collect Clean Laundry Dry Cleaning','Some representative placeholder content for the third slide.','uploads/banners/2024-03-02-07-30-04bl3dgo0c5s.jpg','sdvsv','2024-03-02 07:30:28.0000','0000-00-00 00:00:00.0000',1,'Active'),
	(3,'Quality Laundry Every Thread','Some representative placeholder content for the first slide.','uploads/banners/2024-03-02-07-30-49uw7xf60n93.jpg','Some representative placeholder content for the first slide.','2024-03-02 07:30:51.0000','0000-00-00 00:00:00.0000',1,'Active');

/*!40000 ALTER TABLE `tbl_banners` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_cart`;

CREATE TABLE `tbl_cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_cart` WRITE;
/*!40000 ALTER TABLE `tbl_cart` DISABLE KEYS */;

INSERT INTO `tbl_cart` (`id`, `session_id`, `user_id`, `product_id`, `service_id`, `quantity`, `price`, `created_on`)
VALUES
	(14,NULL,9,1,1,1,12.00,'2024-03-06 08:19:39'),
	(15,NULL,9,2,2,1,12.00,'2024-03-06 08:19:39'),
	(16,NULL,9,4,2,1,40.00,'2024-03-06 08:19:41');

/*!40000 ALTER TABLE `tbl_cart` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_categories`;

CREATE TABLE `tbl_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_icon` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Active',
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;

INSERT INTO `tbl_categories` (`id`, `category`, `category_icon`, `parent_id`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`)
VALUES
	(1,'Clothes','uploads/categories/2024-03-02-11-28-501zb2w5x78e.png',0,'Active',9,'2024-03-02 23:28:54',NULL,NULL),
	(2,'Household','uploads/categories/2024-03-02-11-30-11luyh23vgzq.png',0,'Active',9,'2024-03-02 23:30:25',NULL,NULL),
	(3,'Curtains','uploads/categories/2024-03-02-11-39-42d67qbwovn1.png',0,'Active',9,'2024-03-02 23:39:44',NULL,NULL),
	(4,'Shoes','uploads/categories/2024-03-02-11-40-0417qj0vh4o8.png',0,'Active',9,'2024-03-02 23:40:07',NULL,'2024-03-02 23:41:15'),
	(5,'Apparals','',1,'Active',1,'2024-03-03 10:39:52',NULL,'2024-03-04 07:45:32'),
	(6,'Lenins','',1,'Active',1,'2024-03-04 07:48:10',NULL,NULL),
	(7,'Ethnic Wear','',1,'Active',1,'2024-03-04 07:48:33',NULL,NULL),
	(8,'Wool / Silk','',1,'Active',1,'2024-03-04 07:48:46',NULL,NULL),
	(9,'Test 123','uploads/categories/2024-03-05-07-04-04i4yudkle9j.jpg',0,'Active',1,'2024-03-05 07:04:07',NULL,NULL),
	(10,'Test sub cat','uploads/categories/2024-03-05-07-04-220p6qlmf4sz.png',9,'Active',1,'2024-03-05 07:04:24',NULL,NULL);

/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_cms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_cms`;

CREATE TABLE `tbl_cms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `desc_type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(15000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_on` datetime(3) NOT NULL,
  `updated_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_cms` WRITE;
/*!40000 ALTER TABLE `tbl_cms` DISABLE KEYS */;

INSERT INTO `tbl_cms` (`id`, `desc_type`, `description`, `updated_on`, `updated_by`, `status`)
VALUES
	(1,'privacy_policy','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n</ul>\r\n','2024-03-04 03:07:07.000','1',''),
	(2,'terms_conditions','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n</ul>\r\n','2024-03-04 03:00:51.000','1',''),
	(3,'cancellation_policy','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n</ul>\r\n','2024-03-04 03:07:16.000','1',''),
	(4,'refund_policy','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<ul>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsumLqrdw&nbsp;Lorem ipsum dolor sit amet, consectetur</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit</li>\r\n	<li>&nbsp;Lorem ipsum dolor sit amet</li>\r\n	<li>&nbsp;Lorem ipsum</li>\r\n	<li>&nbsp;Lorem ipsum dolor</li>\r\n</ul>\r\n','2024-03-04 03:07:12.000','1','');

/*!40000 ALTER TABLE `tbl_cms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_contact_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_contact_details`;

CREATE TABLE `tbl_contact_details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `contact_email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_phno` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_contact_details` WRITE;
/*!40000 ALTER TABLE `tbl_contact_details` DISABLE KEYS */;

INSERT INTO `tbl_contact_details` (`id`, `contact_email`, `contact_phno`, `address`, `updated_on`)
VALUES
	(1,'info@fabricare.com','+91 99638 12121','Hyderabad, Telangana - 500082',NULL);

/*!40000 ALTER TABLE `tbl_contact_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_emailtemplates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_emailtemplates`;

CREATE TABLE `tbl_emailtemplates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `template_type` enum('Customer','Others','Order') NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `template_subject` varchar(255) NOT NULL,
  `template_otheremails` varchar(255) NOT NULL,
  `template_body` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_emailtemplates` WRITE;
/*!40000 ALTER TABLE `tbl_emailtemplates` DISABLE KEYS */;

INSERT INTO `tbl_emailtemplates` (`id`, `template_type`, `template_name`, `template_subject`, `template_otheremails`, `template_body`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`)
VALUES
	(1,'Customer','Registration','Account Verification - Fabricare','','<p>Dear <strong>##NAME##,</strong></p>\n<p>Welcome to <a href=\"##SITEURL##\">##SITENAME##</a>. Thank you for registering with us.</p>\n<p>To log in, please click <a href=\"##SITEURL##\">here</a> and type the username and password given above.<br />We request you to make note of this information for future reference<br /><br />Please click <a href=\"##ACTIVATIONLINK##\">here</a> to activate your ##SITENAME## Account.<br />Warm Regards, <br /><strong><a href=\"##SITEURL##\">##SITENAME##</a> Team</strong></p>\n','Active',0,NULL,0,NULL),
	(2,'Customer','Forgot Password','OTP for Reset Password - Fabricare','','<h2 class=\"heading_black\"><strong>Dear&nbsp;##NAME##&nbsp;</strong>,</h2>\r\n<p><strong>You recently requested a password reset for your account at&nbsp;<strong><a href=\"##SITEURL##\" target=\"_blank\">##SITENAME##</a></strong>.</strong></p>\r\n<p>Please click below&nbsp;to access the Password Reset page, and use the following one-time access code to reset your password:</p>\r\n<p>One-Time Access Code:&nbsp;<strong>##OTP##</strong></p>\r\n<p>Url :&nbsp;<strong>##RESETURL##<a href=\"##SITEURL##\" target=\"_blank\"><br /></a></strong></p>\r\n<p>If the above link is not clickable, please copy and paste the following into your browser\'s address bar:&nbsp;<strong>##RESETURL##</strong></p>\r\n<p>If you didn&rsquo;t make this change or if you believe an unauthorized person has accessed your account, go to&nbsp;<strong>##LOGINURL##</strong>&nbsp;to reset your password immediately<br /><br /><br /></p>\r\n<p>Regards,</p>\r\n<p><strong><a href=\"##SITEURL##\" target=\"_blank\">##SITENAME##</a>&nbsp;</strong></p>\r\n<p><strong>Team</strong></p>\r\n<p>&nbsp;</p>','Active',0,NULL,0,NULL);

/*!40000 ALTER TABLE `tbl_emailtemplates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_enquiries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_enquiries`;

CREATE TABLE `tbl_enquiries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phno` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_enquiries` WRITE;
/*!40000 ALTER TABLE `tbl_enquiries` DISABLE KEYS */;

INSERT INTO `tbl_enquiries` (`id`, `name`, `email_id`, `phno`, `message`, `created_on`)
VALUES
	(1,'Akhil Kumar','akhil.srikakolapu@gmail.com','9885800328','s ewweojworowwve','2024-03-02 21:22:33');

/*!40000 ALTER TABLE `tbl_enquiries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_product_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_product_services`;

CREATE TABLE `tbl_product_services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_product_services` WRITE;
/*!40000 ALTER TABLE `tbl_product_services` DISABLE KEYS */;

INSERT INTO `tbl_product_services` (`id`, `product_id`, `service_id`, `price`)
VALUES
	(5,2,2,12.00),
	(6,2,1,10.00),
	(7,2,3,15.00),
	(8,2,6,30.00),
	(9,3,1,20.00),
	(10,3,3,20.00),
	(11,3,6,35.00),
	(12,4,2,40.00),
	(13,4,1,20.00),
	(14,4,3,20.00),
	(15,4,6,35.00),
	(16,1,1,12.00),
	(17,1,2,24.00),
	(18,1,3,15.00),
	(19,1,6,40.00),
	(20,5,1,100.00),
	(21,5,2,150.00),
	(22,5,3,90.00),
	(23,5,6,200.00);

/*!40000 ALTER TABLE `tbl_product_services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_products`;

CREATE TABLE `tbl_products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_general_ci DEFAULT 'Active',
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_products` WRITE;
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;

INSERT INTO `tbl_products` (`id`, `product_name`, `category_id`, `image`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`)
VALUES
	(1,'Shirt',5,'uploads/products/2024-03-04-06-48-36oec8uwlg1z.png','Active',1,'2024-03-04 06:49:03',1,'2024-03-05 06:57:16'),
	(2,'T Shirt',5,'uploads/products/2024-03-04-06-56-14d03vj271h6.png','Active',1,'2024-03-04 06:56:40',1,'2024-03-04 07:15:28'),
	(3,'Jeans Pant',5,'uploads/products/2024-03-04-07-45-43thv0g6cqmj.png','Active',1,'2024-03-04 07:45:59',NULL,NULL),
	(4,'Jackets',5,'uploads/products/2024-03-04-07-46-09wx0kizfajr.png','Active',1,'2024-03-04 07:46:38',NULL,NULL),
	(5,'Pattu Saree',5,'uploads/products/2024-03-05-07-07-296zs38xwnpl.jpg','Active',1,'2024-03-05 07:07:54',NULL,NULL);

/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_promocodes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_promocodes`;

CREATE TABLE `tbl_promocodes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `promocode` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `promocode_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min_cart_value` decimal(25,2) DEFAULT NULL,
  `discount_value` int NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_on` datetime(6) DEFAULT NULL,
  `updated_on` datetime(6) DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_promocodes` WRITE;
/*!40000 ALTER TABLE `tbl_promocodes` DISABLE KEYS */;

INSERT INTO `tbl_promocodes` (`id`, `promocode`, `promocode_type`, `min_cart_value`, `discount_value`, `from_date`, `to_date`, `description`, `created_on`, `updated_on`, `created_by`, `status`)
VALUES
	(1,'asdas4sasas','Flat',NULL,0,'2024-02-27','2024-02-27',NULL,'2024-02-27 02:31:33.000000',NULL,'1','Active'),
	(2,'d3434','Percentage',NULL,0,'2024-03-07','2024-02-22',NULL,'2024-02-27 02:36:59.000000','2024-02-27 02:40:48.000000','1','Active'),
	(3,'HAJ2209','Flat',499.00,90,'2024-03-01','2024-03-01','skuhi suh isuihish ihshi ish ','2024-03-01 06:07:52.000000','2024-03-02 08:13:07.000000','1','Active');

/*!40000 ALTER TABLE `tbl_promocodes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_services`;

CREATE TABLE `tbl_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `web_image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `web_banner` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `app_image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_on` datetime(6) DEFAULT NULL,
  `updated_on` datetime(6) DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_services` WRITE;
/*!40000 ALTER TABLE `tbl_services` DISABLE KEYS */;

INSERT INTO `tbl_services` (`id`, `service_name`, `web_image`, `web_banner`, `app_image`, `description`, `status`, `created_on`, `updated_on`, `created_by`)
VALUES
	(1,'Iron Only','uploads/services/2024-03-02-10-39-534micokld5n.svg','uploads/services/2024-03-02-10-39-555nyuwmrb18.jpg','uploads/services/2024-03-02-10-39-581v3l5ohxaj.svg','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','Active','2024-02-26 03:00:21.000000','2024-03-02 22:46:39.000000','1'),
	(2,'Dry Cleaning','uploads/services/2024-03-02-10-39-182akrng7yqu.svg','uploads/services/2024-03-02-10-39-20hs7mbnw0vp.jpg','uploads/services/2024-03-02-10-39-24nguyoj69ms.svg','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','Active','2024-02-26 00:39:17.000000','2024-03-02 22:39:26.000000','1'),
	(3,'Wash Only','uploads/services/2024-03-02-10-38-52z9qfh2jdvc.svg','uploads/services/2024-03-02-10-38-5418pzryhaqo.jpg','uploads/services/2024-03-02-10-38-58laqk52o1gv.svg','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','Active','2024-02-26 03:04:34.000000','2024-03-02 22:39:05.000000','1'),
	(6,'Wash & Iron','uploads/services/2024-03-02-10-38-10wpzqtua3bg.svg','uploads/services/2024-03-02-10-37-3658hx9suw3l.jpg','uploads/services/2024-03-02-10-38-07164mi52fg8.svg','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,','Active','2024-02-26 23:27:19.000000','2024-03-02 22:38:40.000000','1');

/*!40000 ALTER TABLE `tbl_services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user_sessions`;

CREATE TABLE `tbl_user_sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(200) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_user_sessions` WRITE;
/*!40000 ALTER TABLE `tbl_user_sessions` DISABLE KEYS */;

INSERT INTO `tbl_user_sessions` (`id`, `user_id`, `token`, `created_on`, `updated_on`)
VALUES
	(1,1,'an86r4wolq','2023-11-27 22:15:06','2024-03-05 07:02:58'),
	(2,3,'8b7f9wvc4a','2024-01-03 21:29:06','2024-02-14 10:23:34');

/*!40000 ALTER TABLE `tbl_user_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `phno` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` enum('Admin','User') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `device_token` varchar(200) DEFAULT NULL,
  `email_verified` enum('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'No',
  `last_logged_on` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `password_reset_token` varchar(100) DEFAULT NULL,
  `password_reset_created` datetime DEFAULT NULL,
  `email_verified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;

INSERT INTO `tbl_users` (`id`, `first_name`, `last_name`, `username`, `email_id`, `phno`, `password`, `user_type`, `status`, `device_token`, `email_verified`, `last_logged_on`, `created_on`, `password_reset_token`, `password_reset_created`, `email_verified_on`)
VALUES
	(1,'Akhil','Kumar','admin@fabricare.com','admin@fabricare.com','9885800328','c23fb1a3c1c53a1f7f8633771e4a2cd6','Admin','Active',NULL,NULL,'2024-03-05 07:02:58','2023-11-27 23:41:19',NULL,NULL,NULL),
	(9,'Akhil',NULL,'akhil.srikakolapu@gmail.com','','9384902080','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','User','Active',NULL,'Yes',NULL,'2024-03-02 20:55:25',NULL,NULL,'2024-03-02 21:01:56'),
	(10,'vamshi krishna',NULL,'webartise@gmail.com','','9885800328','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','User','Active',NULL,'Yes',NULL,'2024-03-05 07:12:24',NULL,NULL,'2024-03-05 07:13:00');

/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_zipcodes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_zipcodes`;

CREATE TABLE `tbl_zipcodes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zipcode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_charge` decimal(50,2) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_on` datetime(6) DEFAULT NULL,
  `updated_on` datetime(6) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `tbl_zipcodes` WRITE;
/*!40000 ALTER TABLE `tbl_zipcodes` DISABLE KEYS */;

INSERT INTO `tbl_zipcodes` (`id`, `area_name`, `zipcode`, `service_charge`, `status`, `created_on`, `updated_on`, `created_by`)
VALUES
	(1,'ameerpet12','500161',30.00,'Active','2024-02-26 23:30:06.000000','2024-02-26 23:36:30.000000',1),
	(2,'madhapur','500080',0.00,'Inactive','2024-02-27 02:27:05.000000','2024-03-05 07:05:58.000000',1);

/*!40000 ALTER TABLE `tbl_zipcodes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
