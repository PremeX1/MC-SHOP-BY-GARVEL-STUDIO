-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mc_db
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authme`
--

DROP TABLE IF EXISTS `authme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authme` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `ip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `lastlogin` bigint(20) DEFAULT NULL,
  `x` double NOT NULL DEFAULT 0,
  `y` double NOT NULL DEFAULT 0,
  `z` double NOT NULL DEFAULT 0,
  `world` varchar(255) NOT NULL DEFAULT 'world',
  `regdate` bigint(20) NOT NULL DEFAULT 0,
  `regip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `yaw` float DEFAULT NULL,
  `pitch` float DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `isLogged` smallint(6) NOT NULL DEFAULT 0,
  `hasSession` smallint(6) NOT NULL DEFAULT 0,
  `totp` varchar(32) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authme`
--

LOCK TABLES `authme` WRITE;
/*!40000 ALTER TABLE `authme` DISABLE KEYS */;
INSERT INTO `authme` VALUES (1,'teamgame','TeamGame','$SHA$242258aacdd11467$f9bd93f943a0a6a399f4b47e772d2e49b51961031acb661b9feface892bacb90',NULL,NULL,0,0,0,'world',1649090652549,NULL,NULL,NULL,NULL,0,0,NULL,509);
/*!40000 ALTER TABLE `authme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `info` text NOT NULL DEFAULT 'สินค้านี้ไม่มีข้อมูล',
  `cmd` text NOT NULL,
  `server_id` int(11) NOT NULL,
  `img_path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Item Server #1',100,'สินค้านี้ไม่มีข้อมูล','say hello',1,'public/mc.png'),(2,'Item Server #2',50,'สินค้านี้ไม่มีข้อมูล','say Hello World 2',2,'public/diamond.png'),(3,'Diamond SV1',1000,'สินค้านี้ไม่มีข้อมูล','say Hello World',1,'public/mc.png'),(4,'Test #1',500,'สินค้านี้ไม่มีข้อมูล','say player Hello World',1,'public/mc.png'),(5,'Test SV2',600,'สินค้านี้ไม่มีข้อมูล','say player hello world',2,'public/diamond.png');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server`
--

DROP TABLE IF EXISTS `server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rcon_name` text NOT NULL,
  `rcon_host` text NOT NULL,
  `rcon_port` int(11) NOT NULL,
  `rcon_pass` text NOT NULL,
  `rcon_img_path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server`
--

LOCK TABLES `server` WRITE;
/*!40000 ALTER TABLE `server` DISABLE KEYS */;
INSERT INTO `server` VALUES (1,'Survival #1','127.0.0.1',25575,'123456','/public/mc.png'),(2,'Bedrock #1','127.0.0.1',25585,'123456','public/diamond.png');
/*!40000 ALTER TABLE `server` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-08 15:06:39
