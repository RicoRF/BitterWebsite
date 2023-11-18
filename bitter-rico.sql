-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bitter-rico
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.25-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (1,3,1),(2,1,3),(3,4,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (14,'asf',3,0,0,'2021-05-22 13:39:29'),(15,'aa',3,0,0,'2023-10-24 13:39:59'),(16,'qrqr',3,0,0,'2023-10-24 13:41:01'),(17,'qrqrq',1,0,0,'2023-10-24 13:55:32'),(18,'af',1,0,0,'2023-10-24 14:59:29'),(19,'456789',1,0,0,'2023-10-24 15:10:30'),(20,'Hello',4,0,0,'2023-10-24 15:23:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rico','Ferrante','Rico','$2y$10$.uc.6GtS7zI1XjwHd8KGaeK5jwIHJ6Ag9osqKfVxEUukjt3XoLJyG','26 Duffie Drive','New Brunswick','E3B5A3','5062584494','fferrante01@mynbcc.ca','http://rico.ca/','Hello people','Fredericton','2023-10-24 12:21:50','1.png'),(3,'Nick','Test','Nick','$2y$10$kch5uvt2mJkDDQOSN5hw3ewUl/eVsnIIug8OPlI0SQ7L6q85cuva.','26 Duffie Drive','New Brunswick','e3b5a3','5064821147','nick@nbcc.ca','','Test','','2023-10-24 13:24:24',NULL),(4,'New','Rico','newRico','$2y$10$hxuOuLFBov0f5spenSpa3eCOGdFHve3KR/7oD50UwSOgA9xQQiWH2','12 Main St','New Brunswick','e3a2e2','4041231231','new@rico.com','','Hey there','','2023-10-24 15:23:01','4.png');
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

-- Dump completed on 2023-10-24 12:45:44
