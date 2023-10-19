-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: db_lms
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `borrower`
--

DROP TABLE IF EXISTS `borrower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `borrower` (
  `borrower_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `tax_id` varchar(20) NOT NULL,
  `id_doc` varchar(255) DEFAULT NULL,
  `signature_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrower`
--

LOCK TABLES `borrower` WRITE;
/*!40000 ALTER TABLE `borrower` DISABLE KEYS */;
/*!40000 ALTER TABLE `borrower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) DEFAULT NULL,
  `ltype_id` int DEFAULT NULL,
  `borrower_id` int DEFAULT NULL,
  `purpose` text,
  `amount` double DEFAULT NULL,
  `lplan_id` int DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '0=request, 1=confirmed, 2=released, 3=completed, 4=denied',
  `date_released` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `loan_form` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `totalAmount` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_plan`
--

DROP TABLE IF EXISTS `loan_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan_plan` (
  `lplan_id` int NOT NULL AUTO_INCREMENT,
  `lplan_month` int NOT NULL,
  `lplan_interest` float NOT NULL,
  `lplan_penalty` int NOT NULL,
  PRIMARY KEY (`lplan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_plan`
--

LOCK TABLES `loan_plan` WRITE;
/*!40000 ALTER TABLE `loan_plan` DISABLE KEYS */;
INSERT INTO `loan_plan` VALUES (2,27,35,5);
/*!40000 ALTER TABLE `loan_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_schedule`
--

DROP TABLE IF EXISTS `loan_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan_schedule` (
  `loan_sched_id` int NOT NULL AUTO_INCREMENT,
  `loan_id` int NOT NULL,
  `due_date` date NOT NULL,
  PRIMARY KEY (`loan_sched_id`)
) ENGINE=InnoDB AUTO_INCREMENT=595 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_schedule`
--

LOCK TABLES `loan_schedule` WRITE;
/*!40000 ALTER TABLE `loan_schedule` DISABLE KEYS */;
INSERT INTO `loan_schedule` VALUES (352,35,'2023-10-19'),(353,35,'2023-10-20'),(354,35,'2023-10-21'),(355,35,'2023-10-22'),(356,35,'2023-10-23'),(357,35,'2023-10-24'),(358,35,'2023-10-25'),(359,35,'2023-10-26'),(360,35,'2023-10-27'),(361,35,'2023-10-28'),(362,35,'2023-10-29'),(363,35,'2023-10-30'),(364,35,'2023-10-31'),(365,35,'2023-11-01'),(366,35,'2023-11-02'),(367,35,'2023-11-03'),(368,35,'2023-11-04'),(369,35,'2023-11-05'),(370,35,'2023-11-06'),(371,35,'2023-11-07'),(372,35,'2023-11-08'),(373,35,'2023-11-09'),(374,35,'2023-11-10'),(375,35,'2023-11-11'),(376,35,'2023-11-12'),(377,35,'2023-11-13'),(378,35,'2023-11-14'),(379,36,'2023-10-19'),(380,36,'2023-10-20'),(381,36,'2023-10-21'),(382,36,'2023-10-22'),(383,36,'2023-10-23'),(384,36,'2023-10-24'),(385,36,'2023-10-25'),(386,36,'2023-10-26'),(387,36,'2023-10-27'),(388,36,'2023-10-28'),(389,36,'2023-10-29'),(390,36,'2023-10-30'),(391,36,'2023-10-31'),(392,36,'2023-11-01'),(393,36,'2023-11-02'),(394,36,'2023-11-03'),(395,36,'2023-11-04'),(396,36,'2023-11-05'),(397,36,'2023-11-06'),(398,36,'2023-11-07'),(399,36,'2023-11-08'),(400,36,'2023-11-09'),(401,36,'2023-11-10'),(402,36,'2023-11-11'),(403,36,'2023-11-12'),(404,36,'2023-11-13'),(405,36,'2023-11-14'),(406,40,'2023-10-20'),(407,40,'2023-10-21'),(408,40,'2023-10-22'),(409,40,'2023-10-23'),(410,40,'2023-10-24'),(411,40,'2023-10-25'),(412,40,'2023-10-26'),(413,40,'2023-10-27'),(414,40,'2023-10-28'),(415,40,'2023-10-29'),(416,40,'2023-10-30'),(417,40,'2023-10-31'),(418,40,'2023-11-01'),(419,40,'2023-11-02'),(420,40,'2023-11-03'),(421,40,'2023-11-04'),(422,40,'2023-11-05'),(423,40,'2023-11-06'),(424,40,'2023-11-07'),(425,40,'2023-11-08'),(426,40,'2023-11-09'),(427,40,'2023-11-10'),(428,40,'2023-11-11'),(429,40,'2023-11-12'),(430,40,'2023-11-13'),(431,40,'2023-11-14'),(432,40,'2023-11-15'),(433,41,'2023-10-20'),(434,41,'2023-10-21'),(435,41,'2023-10-22'),(436,41,'2023-10-23'),(437,41,'2023-10-24'),(438,41,'2023-10-25'),(439,41,'2023-10-26'),(440,41,'2023-10-27'),(441,41,'2023-10-28'),(442,41,'2023-10-29'),(443,41,'2023-10-30'),(444,41,'2023-10-31'),(445,41,'2023-11-01'),(446,41,'2023-11-02'),(447,41,'2023-11-03'),(448,41,'2023-11-04'),(449,41,'2023-11-05'),(450,41,'2023-11-06'),(451,41,'2023-11-07'),(452,41,'2023-11-08'),(453,41,'2023-11-09'),(454,41,'2023-11-10'),(455,41,'2023-11-11'),(456,41,'2023-11-12'),(457,41,'2023-11-13'),(458,41,'2023-11-14'),(459,41,'2023-11-15'),(460,42,'2023-10-20'),(461,42,'2023-10-21'),(462,42,'2023-10-22'),(463,42,'2023-10-23'),(464,42,'2023-10-24'),(465,42,'2023-10-25'),(466,42,'2023-10-26'),(467,42,'2023-10-27'),(468,42,'2023-10-28'),(469,42,'2023-10-29'),(470,42,'2023-10-30'),(471,42,'2023-10-31'),(472,42,'2023-11-01'),(473,42,'2023-11-02'),(474,42,'2023-11-03'),(475,42,'2023-11-04'),(476,42,'2023-11-05'),(477,42,'2023-11-06'),(478,42,'2023-11-07'),(479,42,'2023-11-08'),(480,42,'2023-11-09'),(481,42,'2023-11-10'),(482,42,'2023-11-11'),(483,42,'2023-11-12'),(484,42,'2023-11-13'),(485,42,'2023-11-14'),(486,42,'2023-11-15'),(487,43,'2023-10-20'),(488,43,'2023-10-21'),(489,43,'2023-10-22'),(490,43,'2023-10-23'),(491,43,'2023-10-24'),(492,43,'2023-10-25'),(493,43,'2023-10-26'),(494,43,'2023-10-27'),(495,43,'2023-10-28'),(496,43,'2023-10-29'),(497,43,'2023-10-30'),(498,43,'2023-10-31'),(499,43,'2023-11-01'),(500,43,'2023-11-02'),(501,43,'2023-11-03'),(502,43,'2023-11-04'),(503,43,'2023-11-05'),(504,43,'2023-11-06'),(505,43,'2023-11-07'),(506,43,'2023-11-08'),(507,43,'2023-11-09'),(508,43,'2023-11-10'),(509,43,'2023-11-11'),(510,43,'2023-11-12'),(511,43,'2023-11-13'),(512,43,'2023-11-14'),(513,43,'2023-11-15'),(514,1,'2023-10-20'),(515,1,'2023-10-21'),(516,1,'2023-10-22'),(517,1,'2023-10-23'),(518,1,'2023-10-24'),(519,1,'2023-10-25'),(520,1,'2023-10-26'),(521,1,'2023-10-27'),(522,1,'2023-10-28'),(523,1,'2023-10-29'),(524,1,'2023-10-30'),(525,1,'2023-10-31'),(526,1,'2023-11-01'),(527,1,'2023-11-02'),(528,1,'2023-11-03'),(529,1,'2023-11-04'),(530,1,'2023-11-05'),(531,1,'2023-11-06'),(532,1,'2023-11-07'),(533,1,'2023-11-08'),(534,1,'2023-11-09'),(535,1,'2023-11-10'),(536,1,'2023-11-11'),(537,1,'2023-11-12'),(538,1,'2023-11-13'),(539,1,'2023-11-14'),(540,1,'2023-11-15'),(541,2,'2023-10-20'),(542,2,'2023-10-21'),(543,2,'2023-10-22'),(544,2,'2023-10-23'),(545,2,'2023-10-24'),(546,2,'2023-10-25'),(547,2,'2023-10-26'),(548,2,'2023-10-27'),(549,2,'2023-10-28'),(550,2,'2023-10-29'),(551,2,'2023-10-30'),(552,2,'2023-10-31'),(553,2,'2023-11-01'),(554,2,'2023-11-02'),(555,2,'2023-11-03'),(556,2,'2023-11-04'),(557,2,'2023-11-05'),(558,2,'2023-11-06'),(559,2,'2023-11-07'),(560,2,'2023-11-08'),(561,2,'2023-11-09'),(562,2,'2023-11-10'),(563,2,'2023-11-11'),(564,2,'2023-11-12'),(565,2,'2023-11-13'),(566,2,'2023-11-14'),(567,2,'2023-11-15'),(568,3,'2023-10-20'),(569,3,'2023-10-21'),(570,3,'2023-10-22'),(571,3,'2023-10-23'),(572,3,'2023-10-24'),(573,3,'2023-10-25'),(574,3,'2023-10-26'),(575,3,'2023-10-27'),(576,3,'2023-10-28'),(577,3,'2023-10-29'),(578,3,'2023-10-30'),(579,3,'2023-10-31'),(580,3,'2023-11-01'),(581,3,'2023-11-02'),(582,3,'2023-11-03'),(583,3,'2023-11-04'),(584,3,'2023-11-05'),(585,3,'2023-11-06'),(586,3,'2023-11-07'),(587,3,'2023-11-08'),(588,3,'2023-11-09'),(589,3,'2023-11-10'),(590,3,'2023-11-11'),(591,3,'2023-11-12'),(592,3,'2023-11-13'),(593,3,'2023-11-14'),(594,3,'2023-11-15');
/*!40000 ALTER TABLE `loan_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_type`
--

DROP TABLE IF EXISTS `loan_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan_type` (
  `ltype_id` int NOT NULL AUTO_INCREMENT,
  `ltype_name` text NOT NULL,
  `ltype_desc` text NOT NULL,
  PRIMARY KEY (`ltype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_type`
--

LOCK TABLES `loan_type` WRITE;
/*!40000 ALTER TABLE `loan_type` DISABLE KEYS */;
INSERT INTO `loan_type` VALUES (1,'house lon','house lon');
/*!40000 ALTER TABLE `loan_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `loan_id` int NOT NULL,
  `payee` text NOT NULL,
  `pay_amount` float NOT NULL,
  `penalty` float NOT NULL,
  `overdue` tinyint(1) NOT NULL COMMENT '0=no, 1=yes',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin','admin','Administrator','');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-19 17:20:25
