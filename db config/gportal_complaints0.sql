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
  `Mob` varchar(20) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Priority` varchar(20) DEFAULT NULL,
  `Description` text,
  `Reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `staff` varchar(200) DEFAULT 'TBD',
  `status` enum('pending','resolved') DEFAULT 'pending',
  `u_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`C_Id`),
  KEY `fk_complaints_users` (`u_id`),
  CONSTRAINT `fk_complaints_users` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
INSERT INTO `complaints` VALUES ('0acbe312a9','gsdgsdgsth','Administrative-Issues','hsdg','High','ghstst','2024-04-23 20:38:46','1','resolved','e101e2ae31'),('1408f0b26e','i97-647597 ','Administrative-Issues','kjhkjhdf','Medium','sdfgs','2024-04-23 08:57:13','1','resolved','e101e2ae31'),('1ebcad29f0','5ys5','Faculty-related-Issues','s5ys5','High','s5us56','2024-04-25 12:24:24','TBD','pending','e101e2ae31'),('4fc8943a41','tttd','Academic-Issues','sth','Medium','sjs','2024-04-25 09:35:49','e2f1e39fbc','pending','e101e2ae31'),('7c43c8bec2','jykg','Administrative-Issues','vmnvhmv','High','nvnfmhmh','2024-04-23 20:19:34','TBD','pending','e101e2ae31'),('7cbe6c4a65','','Academic-Issues','','Low','xrhst','2024-04-25 11:00:54','TBD','pending','e101e2ae31'),('9ef1efa060','ffgb','Faculty-related-Issues','gdbfgb','Low','sdbsgf','2024-04-25 10:30:42','TBD','pending','e101e2ae31'),('a679474eef','gjkhfkuweh','Administrative-Issues','gwege','High','wegwegwe','2024-04-23 13:42:35','1','resolved','e101e2ae31'),('ce6c39b786','t463562','Faculty-related-Issues','wgtdfv','Medium','trhrtbdgswt','2024-04-25 08:19:03','2','resolved','e101e2ae31'),('d64e7e3d49','bsbsf','Administrative-Issues','sdfbsgfb','Medium','gbsgbs','2024-04-23 20:30:12','TBD','pending','e101e2ae31'),('d970aa8a74','wfgwtg','Administrative-Issues','bbrgbrtr','Medium','gbertb3wrtb','2024-04-25 11:19:44','TBD','pending','e101e2ae31');
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

-- Dump completed on 2024-04-25 18:02:08
