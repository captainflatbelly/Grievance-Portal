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
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complaints` (
  `C_Id` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Mob` varchar(20) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Priority` varchar(20) DEFAULT NULL,
  `Description` text,
  `Reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `staff` varchar(200) DEFAULT 'TBD',
  `status` enum('pending','resolved') DEFAULT 'pending',
  PRIMARY KEY (`C_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES ('0acbe312a9','harsh@gmail.com','gsdgsdgsth','Administrative-Issues','hsdg','High','ghstst','2024-04-23 20:38:46','1','resolved'),('1408f0b26e','ifi2022013@iiita.ac.in','i97-647597 ','Administrative-Issues','kjhkjhdf','Medium','sdfgs','2024-04-23 08:57:13','1','resolved'),('7c43c8bec2','ash@gmail.com','jykg','Administrative-Issues','vmnvhmv','High','nvnfmhmh','2024-04-23 20:19:34','TBD','pending'),('a679474eef','ifi2022013@iiita.ac.in','gjkhfkuweh','Administrative-Issues','gwege','High','wegwegwe','2024-04-23 13:42:35','1','resolved'),('ce6c39b786','aayush@gmail.com','t463562','Faculty-related-Issues','wgtdfv','Medium','trhrtbdgswt','2024-04-25 08:19:03','2','resolved'),('d64e7e3d49','ash@gmail.com','bsbsf','Administrative-Issues','sdfbsgfb','Medium','gbsgbs','2024-04-23 20:30:12','TBD','pending');
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-25 14:08:11
