-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: family
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.8-MariaDB

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
-- Table structure for table `family`
--

DROP TABLE IF EXISTS `family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idnew_table_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family`
--

LOCK TABLES `family` WRITE;
/*!40000 ALTER TABLE `family` DISABLE KEYS */;
INSERT INTO `family` VALUES (1,'Daniels',NULL,NULL),(2,'fam1','2016-03-20 19:11:16','2016-03-20 19:11:16'),(3,'fam2','2016-03-20 19:15:24','2016-03-20 19:15:24'),(4,'fam3','2016-03-20 19:15:55','2016-03-20 19:15:55'),(5,'fam4',NULL,NULL),(6,'fam5',NULL,NULL),(7,'fam6',NULL,NULL),(8,'fam7',NULL,NULL);
/*!40000 ALTER TABLE `family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `parent_1` int(11) DEFAULT NULL,
  `parent_2` int(11) DEFAULT NULL,
  `family_id` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'Jack',0,0,'1',NULL,NULL),(2,'Mary',0,0,'1',NULL,NULL),(3,'Bob',0,0,'2',NULL,NULL),(4,'Liza',0,0,'2',NULL,NULL),(5,'Frank',0,0,'3',NULL,NULL),(6,'Афоний',0,0,'4',NULL,NULL),(7,'Айгуль',0,0,'3',NULL,NULL),(8,'Станислав',0,0,'5',NULL,NULL),(9,'Богдан',0,0,'6',NULL,NULL),(10,'Борислав',0,0,'7',NULL,NULL),(11,'Богдана',0,0,'4',NULL,NULL),(12,'Елена',0,0,'5',NULL,NULL),(13,'Эдуард',0,0,'8',NULL,NULL),(14,'Ильгизар',1,2,'1',NULL,NULL),(15,'Веселина',0,0,'6',NULL,NULL),(16,'Зинаида',0,0,'7',NULL,NULL),(17,'Парамон',1,2,'1',NULL,NULL),(18,'Анастасий',5,7,'3',NULL,NULL),(19,'Грация',0,0,'8',NULL,NULL),(20,'Сабина',3,4,'2',NULL,NULL),(21,'Всеволод',6,11,'4',NULL,NULL),(22,'Феодора',6,11,'4',NULL,NULL),(23,'Виктория',9,15,'6',NULL,NULL),(24,'Одетта',13,19,'8',NULL,NULL),(25,'Алёна',18,22,'3',NULL,NULL),(26,'Габриела',32,24,'7',NULL,NULL),(27,'Агафья',34,26,'5',NULL,NULL),(28,'Аксинья',32,24,'7',NULL,NULL),(29,'Аделаида',31,23,'5',NULL,NULL),(30,'Евдокия',18,22,'3',NULL,NULL),(31,'Адам',8,12,'5',NULL,NULL),(32,'Архип',10,16,'7',NULL,NULL),(33,'Генрих',14,20,'1',NULL,NULL),(34,'Денис',31,23,'5',NULL,NULL),(35,'Трифон',33,25,'1',NULL,NULL);
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-23  0:13:40
