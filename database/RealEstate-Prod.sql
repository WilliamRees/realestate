-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: RealEstate
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `Content`
--

USE mz_real_estate;

DROP TABLE IF EXISTS `Content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Content` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Data` varchar(21844) NOT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Content`
--

LOCK TABLES `Content` WRITE;
/*!40000 ALTER TABLE `Content` DISABLE KEYS */;
/*!40000 ALTER TABLE `Content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Listings`
--

DROP TABLE IF EXISTS `Listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Listings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Address` varchar(200) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `Description` varchar(21844) NOT NULL,
  `Price` decimal(15,2) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PropertyType` varchar(50) DEFAULT NULL,
  `Bedrooms` varchar(50) NOT NULL,
  `Bathrooms` int(11) NOT NULL,
  `LivingSpace` int(11) NOT NULL,
  `LandSize` int(11) DEFAULT NULL,
  `TaxYear` int(11) DEFAULT NULL,
  `Taxes` decimal(15,2) DEFAULT NULL,
  `BuildingAge` int(11) DEFAULT NULL,
  `New` bit(1) DEFAULT NULL,
  `Sold` bit(1) DEFAULT NULL,
  `Published` bit(1) DEFAULT NULL,
  `Latitude` double DEFAULT NULL,
  `Longitude` double DEFAULT NULL,
  `Featured` bit(1) DEFAULT b'0',
  `Priority` int(11) NOT NULL DEFAULT '0',
  `PublishedDate` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Listings`
--

LOCK TABLES `Listings` WRITE;
/*!40000 ALTER TABLE `Listings` DISABLE KEYS */;
INSERT INTO `Listings` VALUES (55,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:12','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(56,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:13','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(57,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:14','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(58,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:14','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(59,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:15','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(60,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:15','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(61,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:16','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(62,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:16','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(63,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:16','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(64,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:16','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(65,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:16','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(66,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:16','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(67,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:17','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(68,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:17','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(69,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:17','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(70,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:17','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(71,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:18','','',0,0,0,0,0.00,0,'','\0','',43.3,-79,'',0,NULL),(72,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:18','Detached','5',4,2621,7090,2014,4018.59,2008,'','\0','',43.3,0,'',0,NULL),(73,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:21','','4',3,134000,0,0,0.00,0,'\0','\0','',43.3,0,'\0',0,NULL),(74,'Test Address','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-16 18:34:24','','4',3,134000,0,0,0.00,0,'\0','\0','',43.3,0,'\0',0,NULL),(75,'Past Created','Brampton','Ontario','Canada','Desc',450000.00,'2015-04-11 18:34:27','','4',3,134000,0,0,0.00,0,'','\0','',43.3,0,'\0',0,NULL),(76,'687','676','34','Canada','68',678.00,'2015-04-16 19:42:03','678','6',86,876,87,687,678.00,6,'','','',43.3,876,'',0,NULL);
/*!40000 ALTER TABLE `Listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ListingImages`
--

DROP TABLE IF EXISTS `ListingImages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ListingImages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ListingId` INT NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Featured` bit(1) DEFAULT b'0',
  PRIMARY KEY (`Id`),
  KEY `ListingId` (`ListingId`),
  CONSTRAINT `ListingImages_ibfk_1` FOREIGN KEY (`ListingId`) REFERENCES `Listings` (`Id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ListingImages`
--

LOCK TABLES `ListingImages` WRITE;
/*!40000 ALTER TABLE `ListingImages` DISABLE KEYS */;
INSERT INTO `ListingImages` VALUES (35,75,'75-house2.jpeg','\0'),(36,75,'75-house.jpg','\0'),(37,75,'75-house3.jpeg','\0'),(38,75,'75-house4.jpeg','\0'),(39,75,'75-house5.jpeg','\0'),(40,74,'74-house2.jpeg','\0'),(41,74,'74-house.jpg','\0'),(42,74,'74-house3.jpeg','\0'),(43,74,'74-house5.jpeg','\0'),(44,74,'74-house4.jpeg','\0'),(45,73,'73-house2.jpeg','\0'),(46,73,'73-house.jpg','\0'),(47,73,'73-house3.jpeg','\0'),(48,73,'73-house4.jpeg','\0'),(49,73,'73-house5.jpeg','\0'),(50,72,'72-house2.jpeg','\0'),(51,72,'72-house.jpg','\0'),(52,72,'72-house3.jpeg','\0'),(53,72,'72-house4.jpeg','\0'),(54,72,'72-house5.jpeg','\0'),(55,71,'71-house2.jpeg','\0'),(56,71,'71-house.jpg','\0'),(57,71,'71-house3.jpeg','\0'),(58,71,'71-house4.jpeg','\0'),(59,71,'71-house5.jpeg','\0'),(60,70,'70-house2.jpeg','\0'),(61,70,'70-house.jpg','\0'),(62,70,'70-house3.jpeg','\0'),(63,70,'70-house4.jpeg','\0'),(64,70,'70-house5.jpeg','\0'),(65,69,'69-house2.jpeg','\0'),(66,69,'69-house.jpg','\0'),(67,69,'69-house3.jpeg','\0'),(68,69,'69-house4.jpeg','\0'),(69,69,'69-house5.jpeg','\0'),(70,68,'68-house2.jpeg','\0'),(71,68,'68-house.jpg','\0'),(72,68,'68-house4.jpeg','\0'),(73,68,'68-house3.jpeg','\0'),(74,68,'68-house5.jpeg','\0'),(75,67,'67-house2.jpeg','\0'),(76,67,'67-house.jpg','\0'),(77,67,'67-house3.jpeg','\0'),(78,67,'67-house4.jpeg','\0'),(79,67,'67-house5.jpeg','\0'),(80,66,'66-house2.jpeg','\0'),(81,66,'66-house.jpg','\0'),(82,66,'66-house3.jpeg','\0'),(83,66,'66-house4.jpeg','\0'),(84,66,'66-house5.jpeg','\0'),(85,65,'65-house2.jpeg','\0'),(86,65,'65-house.jpg','\0'),(87,65,'65-house3.jpeg','\0'),(88,65,'65-house4.jpeg','\0'),(89,65,'65-house5.jpeg','\0'),(90,64,'64-house2.jpeg','\0'),(91,64,'64-house.jpg','\0'),(92,64,'64-house3.jpeg','\0'),(93,64,'64-house4.jpeg','\0'),(94,64,'64-house5.jpeg','\0'),(95,63,'63-house2.jpeg','\0'),(96,63,'63-house.jpg','\0'),(97,63,'63-house3.jpeg','\0'),(98,63,'63-house4.jpeg','\0'),(99,63,'63-house5.jpeg','\0'),(100,62,'62-house2.jpeg','\0'),(101,62,'62-house.jpg','\0'),(102,62,'62-house3.jpeg','\0'),(103,62,'62-house4.jpeg','\0'),(104,62,'62-house5.jpeg','\0'),(105,61,'61-house2.jpeg','\0'),(106,61,'61-house.jpg','\0'),(107,61,'61-house3.jpeg','\0'),(108,61,'61-house4.jpeg','\0'),(109,61,'61-house5.jpeg','\0'),(110,60,'60-house2.jpeg','\0'),(111,60,'60-house.jpg','\0'),(112,60,'60-house3.jpeg','\0'),(113,60,'60-house4.jpeg','\0'),(114,60,'60-house5.jpeg','\0'),(115,59,'59-house2.jpeg','\0'),(116,59,'59-house.jpg','\0'),(117,59,'59-house3.jpeg','\0'),(118,59,'59-house4.jpeg','\0'),(119,59,'59-house5.jpeg','\0'),(120,58,'58-house2.jpeg','\0'),(121,58,'58-house.jpg','\0'),(122,58,'58-house3.jpeg','\0'),(123,58,'58-house4.jpeg','\0'),(124,58,'58-house5.jpeg','\0'),(125,57,'57-house2.jpeg','\0'),(126,57,'57-house.jpg','\0'),(127,57,'57-house4.jpeg','\0'),(128,57,'57-house3.jpeg','\0'),(129,57,'57-house5.jpeg','\0'),(130,56,'56-house2.jpeg','\0'),(131,56,'56-house.jpg','\0'),(132,56,'56-house3.jpeg','\0'),(133,56,'56-house4.jpeg','\0'),(134,56,'56-house5.jpeg','\0'),(135,55,'55-house2.jpeg','\0'),(136,55,'55-house.jpg','\0'),(137,55,'55-house3.jpeg','\0'),(138,55,'55-house4.jpeg','\0'),(139,55,'55-house5.jpeg','\0'),(140,76,'76-house2.jpeg','\0'),(141,76,'76-house.jpg','\0'),(142,76,'76-house3.jpeg','\0'),(143,76,'76-house4.jpeg','\0'),(144,76,'76-house5.jpeg','\0'),(145,76,'76-featured1.jpg',''),(146,71,'71-featured2.jpg',''),(147,72,'72-featured3.jpg','');
/*!40000 ALTER TABLE `ListingImages` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `LoginAttempts`
--

DROP TABLE IF EXISTS `LoginAttempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LoginAttempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LoginAttempts`
--

LOCK TABLES `LoginAttempts` WRITE;
/*!40000 ALTER TABLE `LoginAttempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `LoginAttempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Mustafa Zia','mustafazia@gmail.com','fcab4a8819c6c8fc487486e70152c828343f4b1007a06c4be3c49e25d0db23afd09aa2a553daec75e3457785c27882db3de37e8b872c3983fa5b1c92f4bb45d0','d910fbed704f1586d2791a9938e161556d67e68b9b9603cd1d44d4529361968a47aa28cd681d9fb2b643b82c2a48fdb5839f23f0b9b7607eb369b4eb40430cf8');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-18  7:09:48
