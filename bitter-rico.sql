CREATE DATABASE  IF NOT EXISTS `bitter-rico` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bitter-rico`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bitter-rico
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `FK_follows` (`from_id`),
  KEY `FK_follows2` (`to_id`),
  CONSTRAINT `FK_follows` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `FK_follows2` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (1,3,1),(2,1,3),(13,1,4),(14,3,4),(15,8,3),(16,8,1),(17,8,4),(18,3,8),(19,9,1),(20,1,10),(21,1,11),(22,1,12),(23,8,9),(24,8,11),(25,9,3),(26,1,9),(27,13,3);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`like_id`),
  KEY `FK_tweet_id_idx` (`tweet_id`),
  KEY `FK_user_id_idx` (`user_id`),
  CONSTRAINT `FK_tweet_id` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tweets` (
  `tweet_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_text` varchar(280) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `original_tweet_id` int(11) NOT NULL DEFAULT 0,
  `reply_to_tweet_id` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tweet_id`),
  KEY `FK_tweets` (`user_id`),
  CONSTRAINT `FK_tweets` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (14,'asf',3,0,0,'2021-05-22 13:39:29'),(15,'aa',3,0,0,'2023-10-24 13:39:59'),(16,'qrqr',3,0,0,'2023-10-24 13:41:01'),(17,'qrqrq',1,0,0,'2023-10-24 13:55:32'),(18,'af',1,0,0,'2023-10-24 14:59:29'),(19,'456789',1,0,0,'2023-10-24 15:10:30'),(20,'Hello',4,0,0,'2023-10-24 15:23:10'),(118,'We are back',3,0,0,'2023-11-09 18:18:46'),(119,'Replying testing',1,0,118,'2023-11-09 18:18:59'),(120,'Yup, it works!',3,0,119,'2023-11-09 18:19:19'),(121,'Replying testing',3,119,0,'2023-11-09 18:19:21'),(122,'Hola',1,0,121,'2023-11-14 14:00:47'),(123,'Hello',1,0,121,'2023-11-14 14:00:53'),(124,'qrqr',1,16,0,'2023-11-14 14:01:15'),(125,'Hey there',8,0,0,'2023-11-16 15:11:47'),(126,'Hey',1,0,121,'2023-11-16 19:07:44'),(127,'qrqr',9,124,0,'2023-11-16 19:10:53');
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rico','Ferrante','Rico','$2y$10$.uc.6GtS7zI1XjwHd8KGaeK5jwIHJ6Ag9osqKfVxEUukjt3XoLJyG','26 Duffie Drive','New Brunswick','E3B5A3','5062584494','fferrante01@mynbcc.ca','http://rico.ca/','Hello people','Fredericton','2023-10-24 12:21:50','1.jpg'),(3,'Nick','Test','Nick','$2y$10$kch5uvt2mJkDDQOSN5hw3ewUl/eVsnIIug8OPlI0SQ7L6q85cuva.','26 Duffie Drive','New Brunswick','e3b5a3','5064821147','nick@nbcc.ca','','Test','','2023-10-24 13:24:24',NULL),(4,'New','Rico','newRico','$2y$10$hxuOuLFBov0f5spenSpa3eCOGdFHve3KR/7oD50UwSOgA9xQQiWH2','12 Main St','New Brunswick','e3a2e2','4041231231','new@rico.com','','Hey there','','2023-10-24 15:23:01','4.png'),(8,'Rico','Three','rico3','$2y$10$JX.Vv0jqPyssUINa0rzE5uJ66sMwuk2f13bZyQDP/AFiGUjAR.QVm','26 duffie dr','New Brunswick','e3a0t5','1231231231','rico@3.com','','hey','','2023-11-16 15:11:34',NULL),(9,'Hey','Testing','testing_','$2y$10$JY5SqQ0pwY85kvQaDQagmeSp893N8WEHXJdHUvkBvE2rSaZ6SNHLK','26 duffie dr','Ontario','e3a2e1','1231231231','hey@testing.com','','Hello','','2023-11-16 19:09:47',NULL),(10,'Hello','there','qwe','$2y$10$UTdcBDpOry5oYZtKn6DMQOcN6vD/L4PnygZqku1E/6wBDDFWoFx82','26 dd','British Columbia','E3A0R8','1231231231','hey@there.com','','qwe','','2023-11-16 19:46:56',NULL),(11,'qwr','qwr','qwr','$2y$10$Uz948zmGIyVbZTp1GHgSLOVm.JkSt7YeviRmQKg//1pnN0vSyNht.','22 ss street','Saskatchewan','e3a0f0','5061234567','qwr@qwr.com','','qwe','','2023-11-16 19:51:37',NULL),(12,'Rico','Test','RicoTesting','$2y$10$oeI8N9ee3vz565eZ5Asa/en.hXCxI6AAq/TCxa/7np.CpFtdVgcgm','22 Street','Yukon','E3B 6Z9','1231231231','Rico@testingggg.com','','Testing Desc','','2023-11-16 19:55:43',NULL),(13,'Test','Ing','test_ing','$2y$10$SYCjEkmeYaZwXim2EYrHo.aNksejdabzzOFCV4002259KNmuLDWCi','22 st','Prince Edward Island','e3b 5a3','1231231231','test@ing.com','','-','','2023-11-16 20:10:07',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-16 16:12:12
