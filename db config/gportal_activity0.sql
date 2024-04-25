-- MySQL dump 10.13  Distrib 8.0.34, for macos13 (arm64)
--
-- Host: localhost    Database: gportal
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity` (
  `feedback` text,
  `ftime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `C_Id` varchar(10) DEFAULT NULL,
  `activity_number` int NOT NULL,
  `activity_id` varchar(10) NOT NULL,
  `feedback_from` varchar(10) DEFAULT NULL,
  KEY `C_Id` (`C_Id`),
  KEY `fk_feedback_from` (`feedback_from`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`C_Id`) REFERENCES `complaints` (`C_Id`),
  CONSTRAINT `fk_feedback_from` FOREIGN KEY (`feedback_from`) REFERENCES `staff` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES ('mnbjh','2024-04-25 09:57:58','a679474eef',0,'ec67cce4ad',NULL),('ukbkhb','2024-04-25 09:58:52','a679474eef',2,'f3a59c70df',NULL),('kgjfjhgfkhgvkjhu','2024-04-25 10:00:08','a679474eef',3,'658958ca3f',NULL),('mbkhbkbkhg','2024-04-25 10:00:18','a679474eef',4,'d10e2dbe79',NULL),('dyhsthws','2024-04-25 10:02:28','a679474eef',5,'d1556fef4b',NULL),('fgbsgbw','2024-04-25 10:03:50','a679474eef',6,'23b17255f3',NULL),('khbkhb','2024-04-25 10:27:48','0acbe312a9',1,'28672a2bb7',NULL),('gfwerergw','2024-04-25 10:28:20','a679474eef',7,'ce23c7fec2',NULL),('hnetgb','2024-04-25 10:28:35','1408f0b26e',1,'2ee9d0c215',NULL),('sdrhsrtgat','2024-04-25 10:43:09','4fc8943a41',1,'4fbf35d6b5','e2f1e39fbc');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-25 18:02:08
