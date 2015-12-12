CREATE DATABASE  IF NOT EXISTS `red` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `red`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: red
-- ------------------------------------------------------
-- Server version	5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `emgtypes`
--

DROP TABLE IF EXISTS `emgtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emgtypes` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emgtypes`
--

LOCK TABLES `emgtypes` WRITE;
/*!40000 ALTER TABLE `emgtypes` DISABLE KEYS */;
INSERT INTO `emgtypes` VALUES (1,'Fire'),(2,'Flood'),(3,'Rescue');
/*!40000 ALTER TABLE `emgtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redalert`
--

DROP TABLE IF EXISTS `redalert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redalert` (
  `idredalert` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(245) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `alert_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idredalert`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redalert`
--

LOCK TABLES `redalert` WRITE;
/*!40000 ALTER TABLE `redalert` DISABLE KEYS */;
INSERT INTO `redalert` VALUES (1,'tel:94771122336','Fire',6.9167,79.8333,'2015-12-11 06:16:29');
/*!40000 ALTER TABLE `redalert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redsessions`
--

DROP TABLE IF EXISTS `redsessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redsessions` (
  `sessionsid` varchar(100) NOT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `pg` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `others` varchar(50) DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  PRIMARY KEY (`sessionsid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Handle the sessions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redsessions`
--

LOCK TABLES `redsessions` WRITE;
/*!40000 ALTER TABLE `redsessions` DISABLE KEYS */;
INSERT INTO `redsessions` VALUES ('123','tel:94771122336','main','0','2015-12-11 06:16:29','',79.8333,6.9167);
/*!40000 ALTER TABLE `redsessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-11 12:00:35
