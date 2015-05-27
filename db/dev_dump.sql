-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               5.6.17 - MySQL Community Server (GPL)
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Datenbank Struktur für wellness_oase_dev
CREATE DATABASE IF NOT EXISTS `wellness_oase_dev` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wellness_oase_dev`;


-- Exportiere Struktur von Tabelle wellness_oase_dev.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offline` tinyint(1) DEFAULT NULL,
  `layout` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.config: ~1 rows (ungefähr)
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `offline`, `layout`) VALUES
	(1, 0, 'semantic');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.employee: ~4 rows (ungefähr)
DELETE FROM `employee`;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`id`, `name`, `color`) VALUES
	(1, 'Sylke', 'lightgreen'),
	(2, 'Bea', 'sandybrown'),
	(3, 'Jana', 'lightblue'),
	(4, 'Doris', 'lightcoral');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.event
DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `paymentmethod_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `customer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day` date NOT NULL,
  `canceled` tinyint(1) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `extrainfo` longtext COLLATE utf8_unicode_ci,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FA6F25A38C03F15C` (`employee_id`),
  KEY `IDX_FA6F25A364D218E` (`location_id`),
  KEY `IDX_FA6F25A3778E3E6F` (`paymentmethod_id`),
  KEY `IDX_FA6F25A3A76ED395` (`user_id`),
  CONSTRAINT `FK_FA6F25A364D218E` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  CONSTRAINT `FK_FA6F25A3778E3E6F` FOREIGN KEY (`paymentmethod_id`) REFERENCES `paymentmethod` (`id`),
  CONSTRAINT `FK_FA6F25A38C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  CONSTRAINT `FK_FA6F25A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.event: ~18 rows (ungefähr)
DELETE FROM `event`;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `employee_id`, `location_id`, `paymentmethod_id`, `user_id`, `date_start`, `date_end`, `customer`, `info`, `price`, `day`, `canceled`, `create_date`, `extrainfo`, `telephone`) VALUES
	(1, 1, 1, 1, 6, '2015-03-04 14:00:00', '2015-03-04 15:00:00', 'Kunde', 'dies ist eine Testinfo', '200', '2015-02-23', 0, '2015-02-23 13:06:22', NULL, NULL),
	(2, 2, 4, 1, 6, '2015-03-04 18:00:00', '2015-03-04 18:30:00', 'Kunde2', NULL, '150', '2015-02-23', 0, '2015-02-23 15:46:45', NULL, NULL),
	(7, 1, 1, 1, NULL, '2015-03-04 09:00:00', '2015-03-04 09:30:00', 'test', 'ewfqw', '40', '2015-03-04', 0, '2015-03-04 10:51:06', NULL, NULL),
	(8, 3, 3, 1, NULL, '2015-03-04 09:00:00', '2015-03-04 10:00:00', 'ttest', 'gdsfs', '40', '2015-03-04', 0, '2015-03-04 11:00:20', NULL, NULL),
	(10, 1, 2, 2, NULL, '2015-03-04 08:00:00', '2015-03-04 10:00:00', 'dsf', 'dsffsa', '400', '2015-03-04', 0, '2015-03-04 11:04:29', NULL, NULL),
	(11, 1, 1, 1, NULL, '2015-03-05 08:30:00', '2015-03-05 08:30:00', 'TestKunde', 'asdasd', '40', '2015-03-05', 0, '2015-03-05 21:22:36', NULL, NULL),
	(12, NULL, 4, NULL, NULL, '2015-03-05 08:00:00', '2015-03-05 09:30:00', 'Testdsfsafs', NULL, NULL, '2015-03-05', 0, '2015-03-05 22:05:37', NULL, NULL),
	(13, NULL, 3, NULL, NULL, '2015-03-05 10:00:00', '2015-03-05 11:30:00', 'test', NULL, NULL, '2015-03-05', 0, '2015-03-08 22:15:25', NULL, NULL),
	(14, NULL, 3, NULL, NULL, '2015-03-05 11:00:00', '2015-03-05 11:30:00', 'test2', NULL, NULL, '2015-03-05', 0, '2015-03-08 22:15:48', NULL, NULL),
	(15, 1, 6, 1, NULL, '2015-03-08 10:00:00', '2015-03-08 11:30:00', 'kunath', 'massage', '30', '2015-03-08', 0, '2015-03-11 17:12:32', 'zusatz', NULL),
	(16, 2, 2, 1, NULL, '2015-03-08 14:00:00', '2015-03-08 14:30:00', 'test', 'sdfgb', '45566', '2015-03-08', 0, '2015-03-11 17:14:07', NULL, NULL),
	(17, 4, 4, 1, NULL, '2015-03-08 14:00:00', '2015-03-08 15:30:00', 'test2', 'massage', '76', '2015-03-08', 1, '2015-03-11 17:15:19', NULL, NULL),
	(18, 3, 3, 4, NULL, '2015-03-08 11:30:00', '2015-03-08 14:00:00', 'bla', 'test', '56745', '2015-03-08', 1, '2015-03-11 22:04:08', NULL, NULL),
	(19, 1, 3, 3, NULL, '2015-03-29 08:00:00', '2015-03-29 10:30:00', 'tesat', 'test', '50', '2015-03-29', 0, '2015-03-29 17:21:05', 'xy<x<yx', NULL),
	(20, NULL, 6, NULL, NULL, '2015-03-29 09:00:00', '2015-03-29 10:30:00', 'kunath', NULL, NULL, '2015-03-29', 0, '2015-03-29 18:22:12', NULL, NULL),
	(21, 3, 6, NULL, NULL, '2015-03-29 10:30:00', '2015-03-29 11:00:00', 'test2', NULL, NULL, '2015-03-29', 0, '2015-03-29 18:34:32', NULL, NULL),
	(22, 4, 6, NULL, NULL, '2015-03-29 12:00:00', '2015-03-29 13:30:00', 'tesat', NULL, NULL, '2015-03-29', 0, '2015-03-29 18:34:56', NULL, NULL),
	(23, NULL, 4, NULL, NULL, '2015-03-29 08:30:00', '2015-03-29 09:00:00', 'test', NULL, NULL, '2015-03-29', 0, '2015-03-29 20:58:20', NULL, 'yxcsadfsada');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.location
DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.location: ~8 rows (ungefähr)
DELETE FROM `location`;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`id`, `name`) VALUES
	(1, 'Ma1'),
	(2, 'Ma2'),
	(3, 'Ma3'),
	(4, 'Ma/Bad'),
	(6, 'Kosmetik'),
	(7, 'NH'),
	(8, 'Glowe1'),
	(9, 'Glowe2');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.notice
DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FA140F4A76ED395` (`user_id`),
  CONSTRAINT `FK_4FA140F4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.notice: ~2 rows (ungefähr)
DELETE FROM `notice`;
/*!40000 ALTER TABLE `notice` DISABLE KEYS */;
INSERT INTO `notice` (`id`, `user_id`, `text`, `createDate`) VALUES
	(2, NULL, 'Noch eine Testnachricht\r\nMal mit umbrüchen\r\ngucken ob die drinne sind', '2015-04-13 16:19:06');
/*!40000 ALTER TABLE `notice` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.offer
DROP TABLE IF EXISTS `offer`;
CREATE TABLE IF NOT EXISTS `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `offer_start` datetime NOT NULL,
  `offer_end` datetime NOT NULL,
  `offer_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E817A83AED5CA9E6` (`service_id`),
  CONSTRAINT `FK_E817A83AED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.offer: ~2 rows (ungefähr)
DELETE FROM `offer`;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` (`id`, `service_id`, `offer_start`, `offer_end`, `offer_price`, `create_date`) VALUES
	(4, 5, '2015-04-12 00:00:00', '2015-04-30 00:00:00', '40', '2015-04-13 03:13:54'),
	(5, 1, '2015-04-09 00:00:00', '2015-04-22 00:00:00', '20', '2015-04-13 03:41:02');
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `last_edit` datetime NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2074E575727ACA70` (`parent_id`),
  CONSTRAINT `FK_2074E575727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `pages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.pages: ~2 rows (ungefähr)
DELETE FROM `pages`;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `type`, `published`, `create_date`, `last_edit`, `parent_id`) VALUES
	(1, 'Wellness Oase - Sylke Scheduikat', 'wellness-oase-sylke-scheduikat', '<p><img src="../../../../bundles/wo/filemanager/userfiles/pp.png" alt="" width="100" height="26" />Hello, world!</p>\r\n<p>&nbsp;</p>\r\n<table style="height: 30px;" width="212">\r\n<tbody>\r\n<tr>\r\n<td>1</td>\r\n<td>2</td>\r\n<td>3</td>\r\n<td>4</td>\r\n<td>5</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div class="row">\r\n<div class="column">\r\n<div class="ui message main">\r\n<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>\r\n<a class="ui blue button">Learn more &raquo;</a></div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Buttons</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="row m-top-20">\r\n<div class="column button-control"><a class="huge ui button">Default</a> <a class="huge ui blue button">Blue</a> <a class="huge ui green button">Green</a> <a class="huge ui teal button">Teal</a> <a class="huge ui orange button">Orange</a> <a class="huge ui red button">Red</a> <a class="huge ui purple button">Purple</a></div>\r\n</div>\r\n<div class="row m-top-20">\r\n<div class="column button-control"><a class="large ui button">Default</a> <a class="large ui blue button">Blue</a> <a class="large ui green button">Green</a> <a class="large ui teal button">Teal</a> <a class="large ui orange button">Orange</a> <a class="large ui red button">Red</a> <a class="large ui purple button">Purple</a></div>\r\n</div>\r\n<div class="row m-top-20">\r\n<div class="column button-control"><a class="small ui button">Default</a> <a class="small ui blue button">Blue</a> <a class="small ui green button">Green</a> <a class="small ui teal button">Teal</a> <a class="small ui orange button">Orange</a> <a class="small ui red button">Red</a> <a class="small ui purple button">Purple</a></div>\r\n</div>\r\n<div class="row m-top-20">\r\n<div class="column button-control"><a class="mini ui button">Default</a> <a class="mini ui blue button">Blue</a> <a class="mini ui green button">Green</a> <a class="mini ui teal button">Teal</a> <a class="mini ui orange button">Orange</a> <a class="mini ui red button">Red</a> <a class="mini ui purple button">Purple</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Thumbnails</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<img class="img-thumbnail" src="//placehold.it/200x200" alt="" /></div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Dropdown menus</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="ui compact menu">\r\n<div class="ui dropdown item dropdown-showcase">Dropdown\r\n<div class="menu">\r\n<div class="item active">Action</div>\r\n<div class="item">Another action</div>\r\n<div class="item">Something else here</div>\r\n<div class="ui horizontal divider">&nbsp;</div>\r\n<div class="item">Seperated link</div>\r\n<div class="item">One more seperated link</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Navbars</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="ui menu"><a class="active item"> Green </a> <a class="red item"> Red </a> <a class="blue item"> Blue </a> <a class="orange item"> Orange </a> <a class="purple item"> Purple </a> <a class="teal item"> Teal </a></div>\r\n<div class="ui inverted menu"><a class="active item"> Green </a> <a class="red item"> Red </a> <a class="blue item"> Blue </a> <a class="orange item"> Orange </a> <a class="purple item"> Purple </a> <a class="teal item"> Teal </a></div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Alerts</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="ui green message">Well done! You successfully read this important alert message.</div>\r\n<div class="ui blue message">Heads up! This alert needs your attention, but it\'s not super important.</div>\r\n<div class="ui yellow message">Warning! Best check yo self, you\'re not looking too good.</div>\r\n<div class="ui red message">Oh snap! Change a few things up and try submitting again.</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Progress bars</h1>\r\n<div class="ui blue progress">&nbsp;</div>\r\n<div class="ui green progress">&nbsp;</div>\r\n<div class="ui blue progress">&nbsp;</div>\r\n<div class="ui red progress">&nbsp;</div>\r\n<div class="ui warning progress">&nbsp;</div>\r\n<div class="ui red progress">&nbsp;</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui headder">List groups</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="ui three column grid">\r\n<div class="column panel">\r\n<div class="ui top attached segment">\r\n<p>Cras justo odio</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<p>Dapibus ac facilisis in</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<p>Morbi leo risus</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<p>Porta ac consectetur ac</p>\r\n</div>\r\n<div class="ui bottom attached segment">\r\n<p>Vestibulum at eros</p>\r\n</div>\r\n</div>\r\n<div class="column panel">\r\n<div class="ui blue top inverted attached segment">\r\n<p>Cras justo odio</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<p>Dapibus ac facilisis in</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<p>Morbi leo risus</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<p>Porta ac consectetur ac</p>\r\n</div>\r\n<div class="ui bottom attached segment">\r\n<p>Vestibulum at eros</p>\r\n</div>\r\n</div>\r\n<div class="column panel">\r\n<div class="ui blue inverted top attached segment">\r\n<h1 class="ui medium header">List group item heading</h1>\r\n<p style="color: #fff;">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>\r\n</div>\r\n<div class="ui attached segment">\r\n<h1 class="ui medium header">List group item heading</h1>\r\n<p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>\r\n</div>\r\n<div class="ui bottom attached segment">\r\n<h1 class="ui medium header">List group item heading</h1>\r\n<p>Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Panels</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="ui three column grid">\r\n<div class="column panel">\r\n<div class="ui secondary inverted top attached segment">Panel title</div>\r\n<div class="ui bottom attached segment">Panel content</div>\r\n<div class="ui inverted top attached segment">Panel title</div>\r\n<div class="ui bottom attached segment">Panel content</div>\r\n</div>\r\n<div class="column panel">\r\n<div class="ui green inverted top attached segment">Panel title</div>\r\n<div class="ui bottom attached segment">Panel content</div>\r\n<div class="ui inverted blue top attached segment">Panel title</div>\r\n<div class="ui bottom attached segment">Panel content</div>\r\n</div>\r\n<div class="column panel">\r\n<div class="ui orange inverted top attached segment">Panel title</div>\r\n<div class="ui bottom attached segment">Panel content</div>\r\n<div class="ui inverted red top attached segment">Panel title</div>\r\n<div class="ui bottom attached segment">Panel content</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="column">\r\n<h1 class="ui header">Wells</h1>\r\n<div class="ui divider">&nbsp;</div>\r\n<div class="ui segment secondary inverted">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- build:js scripts/vendor.js -->\r\n<p>&nbsp;</p>\r\n<!-- bower:js -->\r\n<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>\r\n<script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.13.0/javascript/semantic.min.js"></script>\r\n<script src="main.js"></script>\r\n<!-- endbower -->\r\n<p>&nbsp;</p>\r\n<!-- endbuild -->', 'homepage,page', 1, '2010-01-01 00:00:00', '2010-01-01 00:00:00', NULL),
	(2, 'Angebote', 'angebote', 'Hier gibs angebote zu sehen', 'category,page', 1, '2010-01-01 00:00:00', '2010-01-01 00:00:00', NULL),
	(3, 'Massagen', 'massagen', 'Hier sieht man alle massagen', 'page', 1, '2010-01-01 00:00:00', '2010-01-01 00:00:00', 2);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.paymentmethod
DROP TABLE IF EXISTS `paymentmethod`;
CREATE TABLE IF NOT EXISTS `paymentmethod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.paymentmethod: ~2 rows (ungefähr)
DELETE FROM `paymentmethod`;
/*!40000 ALTER TABLE `paymentmethod` DISABLE KEYS */;
INSERT INTO `paymentmethod` (`id`, `name`) VALUES
	(1, 'v.o.'),
	(2, 'Karte'),
	(3, 'Rechnung'),
	(4, 'Arrangement');
/*!40000 ALTER TABLE `paymentmethod` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.role: ~4 rows (ungefähr)
DELETE FROM `role`;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `role`) VALUES
	(1, 'Administrator', 'ROLE_ADMIN'),
	(2, 'User', 'ROLE_USER'),
	(3, 'Super Admin', 'ROLE_SUPER_ADMIN'),
	(4, 'Moderator', 'ROLE_MODERATOR');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.service
DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2E20A34E12469DE2` (`category_id`),
  CONSTRAINT `FK_2E20A34E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `servicecategory` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.service: ~5 rows (ungefähr)
DELETE FROM `service`;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id`, `name`, `price`, `description`, `duration`, `category_id`) VALUES
	(1, 'Relax Rückenmassage', 26, 'Massage vom Kreuzbein bis zum Haaransatz zur Entspannung und Muskellockerung', '25', 1),
	(2, 'Rücken individuell', 30, 'Rücken individuell', '25', 1),
	(3, 'Anti Stressmassage', 29, 'Entspannende Schulter- Nacken- Kopfmassage mit sanfter Dehnung der Halswirbelsäule. Sehr zu empfehlen bei Spannungskopfschmerzen, Nervosität und zum Stressabbau', '25', 1),
	(4, 'Pärchen Kombination', 120, 'Romantikbad und Ganzkörpermassage', '200', NULL),
	(5, 'osterspecial', 55, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '60', 10);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.servicecategory
DROP TABLE IF EXISTS `servicecategory`;
CREATE TABLE IF NOT EXISTS `servicecategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.servicecategory: ~8 rows (ungefähr)
DELETE FROM `servicecategory`;
/*!40000 ALTER TABLE `servicecategory` DISABLE KEYS */;
INSERT INTO `servicecategory` (`id`, `name`) VALUES
	(1, 'Massagen'),
	(2, 'Rügener Heilkreide'),
	(3, 'Sanft entschlacken'),
	(4, 'Hot Stone Therapie'),
	(5, 'Sanddorn - Typisch Rügen'),
	(6, 'Verliebt, verlobt, verheiratet?'),
	(7, 'Kosmetik Anwendungen'),
	(8, 'Verwöhnangebote'),
	(9, 'Naturheilpraxis'),
	(10, 'Sonderangebote');
/*!40000 ALTER TABLE `servicecategory` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.users: ~0 rows (ungefähr)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `street`, `zip`, `city`, `create_date`, `last_login`, `salt`) VALUES
	(6, 'admin', '$2y$12$aaf8a1d756ad2e7121f34eJfZxcZ3aaxFRO3k1IUNZq4wOdcU2igq', 'Tom.Scheduikat@gmail.com', 'tom', 'scheduikat', 'Koppelring 30b', '18573', 'Altefähr', '2015-02-15 15:13:00', '2010-01-01 00:00:00', 'aaf8a1d756ad2e7121f34e78934ee00d'),
	(7, 'wellnessoase', '$2y$12$3f158d11733b84cba510aOTHwuV00yrSrRf7ICN2ogBUgitMIzQ6a', 'wellness-oase-ruegen@web.de', 'wellness', 'oase', 'straße', '12435', 'Juliusruh', '2015-03-08 22:19:00', '2010-01-01 00:00:00', '3f158d11733b84cba510aa44246e77d3');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.user_role: ~1 rows (ungefähr)
DELETE FROM `user_role`;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
	(6, 3),
	(7, 1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Exportiere Struktur von Tabelle wellness_oase_dev.worktime
DROP TABLE IF EXISTS `worktime`;
CREATE TABLE IF NOT EXISTS `worktime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `timerange` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `free` tinyint(1) DEFAULT NULL,
  `vacation` tinyint(1) DEFAULT NULL,
  `sick` tinyint(1) DEFAULT NULL,
  `on_demand` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A1E7B4758C03F15C` (`employee_id`),
  CONSTRAINT `FK_A1E7B4758C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportiere Daten aus Tabelle wellness_oase_dev.worktime: ~18 rows (ungefähr)
DELETE FROM `worktime`;
/*!40000 ALTER TABLE `worktime` DISABLE KEYS */;
INSERT INTO `worktime` (`id`, `employee_id`, `date`, `timerange`, `start`, `end`, `location`, `free`, `vacation`, `sick`, `on_demand`) VALUES
	(1, 2, '2015-02-24', '8-20 ', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(2, 1, '2015-02-25', '12-18', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(3, 1, '2015-02-24', '8-14', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(4, 2, '2015-02-26', '10-18', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(13, 1, '2015-03-05', '8-20', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(14, 2, '2015-03-08', '9-16', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(15, 3, '2015-03-08', '11-20', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(16, 4, '2015-03-08', '12-18', '00:00:00', '00:00:00', NULL, NULL, NULL, NULL, NULL),
	(17, 1, '2015-03-08', '08:00 - 09:00', '08:00:00', '09:00:00', NULL, NULL, NULL, NULL, NULL),
	(18, 1, '2015-04-11', '11:00 - 17:00', '11:00:00', '17:00:00', NULL, NULL, NULL, NULL, NULL),
	(19, 1, '2015-04-13', '08:00 - 11:00', '08:00:00', '11:00:00', 'Glowe', NULL, NULL, NULL, NULL),
	(20, 3, '2015-04-13', '10:00 - 12:00', '10:00:00', '12:00:00', NULL, NULL, NULL, NULL, NULL),
	(21, 1, '2015-04-15', '08:00 - 13:00', '08:00:00', '13:00:00', NULL, 0, 0, 0, 0),
	(22, 2, '2015-04-15', '11:00 - 19:00', '11:00:00', '19:00:00', 'Glowe', 0, 0, 0, 0),
	(23, 3, '2015-04-15', '08:00 - 08:00', '08:00:00', '08:00:00', NULL, 1, 0, 0, 0),
	(24, 4, '2015-04-15', '08:00 - 08:00', '08:00:00', '08:00:00', NULL, 0, 0, 1, 0),
	(25, 4, '2015-04-16', '08:00 - 08:00', '08:00:00', '08:00:00', NULL, 0, 0, 0, 1),
	(26, 2, '2015-04-16', '08:00 - 08:00', '08:00:00', '08:00:00', NULL, 0, 1, 0, 0),
	(27, 3, '2015-04-16', '08:00 - 08:00', '08:00:00', '08:00:00', NULL, 0, 0, 1, 0),
	(28, 1, '2015-04-16', '08:00 - 20:00', '08:00:00', '20:00:00', NULL, 0, 0, 0, 0);
/*!40000 ALTER TABLE `worktime` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
