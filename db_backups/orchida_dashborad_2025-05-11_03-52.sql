-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 172.16.2.19    Database: orchida_dashborad
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidates` (
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `course_number` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`student_id`,`course_number`,`section_id`),
  KEY `course_number` (`course_number`,`section_id`),
  CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  CONSTRAINT `candidates_ibfk_2` FOREIGN KEY (`course_number`, `section_id`) REFERENCES `course_sections` (`course_number`, `section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates`
--

LOCK TABLES `candidates` WRITE;
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_sections`
--

DROP TABLE IF EXISTS `course_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_sections` (
  `course_number` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `room_number` varchar(50) DEFAULT NULL,
  `instructor_name` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'نشطة',
  PRIMARY KEY (`course_number`,`section_id`),
  CONSTRAINT `course_sections_ibfk_1` FOREIGN KEY (`course_number`) REFERENCES `courses` (`course_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_sections`
--

LOCK TABLES `course_sections` WRITE;
/*!40000 ALTER TABLE `course_sections` DISABLE KEYS */;
INSERT INTO `course_sections` VALUES (102,3,'2025-05-04','101','كرم أبو عمشة','مفتوحة');
/*!40000 ALTER TABLE `course_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `course_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`course_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (101,'إدارة الشبكات والميكروتيك',50,'تأهل الدورة المتدربين للتمكن من:\r\n1. إدارة الشبكات العامة والخاصة\r\n2. برمجة الميكروتيك','attachments/6Txf1l4d8qygw8y4DPpObQ9w1fCeUNdiWhwYZVBe.docx'),(102,'فني الإلكترونيات والطاقة الشمسية',50,'دورة مدمجة بين الطاقة الشمسية',NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'ديمة','deema','123456',1,'2025-05-01 14:22:31','2025-05-05 12:47:18'),(2,'أحمد','ahmad','123456',2,'2025-05-01 14:22:31','2025-05-10 13:20:46'),(3,'أبو فراس','abofiras','123456',0,'2025-05-01 14:22:31','2025-05-10 13:20:21'),(4,'عبود','abood','123456',3,'2025-05-05 10:31:27','2025-05-10 13:20:53'),(5,'نور','noor','123456',3,'2025-05-05 10:31:27','2025-05-10 13:20:57'),(6,'فرح','farah','123456',3,'2025-05-05 10:31:27','2025-05-10 13:20:59');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `network_users`
--

DROP TABLE IF EXISTS `network_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `network_users` (
  `username` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `attachment` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(150) DEFAULT NULL,
  `assigned_at` datetime DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `network_users`
--

LOCK TABLES `network_users` WRITE;
/*!40000 ALTER TABLE `network_users` DISABLE KEYS */;
INSERT INTO `network_users` VALUES ('20',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('21',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('22',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('23',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('24',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('25',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('26',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('27',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('28',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('29',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('30',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('31',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('32',0,NULL,NULL,'2025-05-08 14:52:46','2025-05-08 21:52:46'),('33',0,NULL,NULL,'2025-05-08 14:52:47','2025-05-08 21:52:47'),('34',0,NULL,NULL,'2025-05-08 14:52:47','2025-05-08 21:52:47'),('35',0,NULL,NULL,'2025-05-08 14:52:47','2025-05-08 21:52:47'),('41',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('42',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('43',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('44',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('45',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('46',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('47',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('48',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('49',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('50',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('51',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('52',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('53',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('54',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('55',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('56',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('57',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('58',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('59',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('60',0,NULL,NULL,'2025-05-08 14:55:18','2025-05-08 21:55:18'),('71',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('72',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('73',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('74',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('75',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('76',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('77',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('78',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('79',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('80',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('81',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('82',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('83',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('84',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('85',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('86',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('87',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('88',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('89',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('90',0,NULL,NULL,'2025-05-08 14:57:31','2025-05-08 21:57:31'),('972566510502',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972566808004',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972567716686',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972567776077',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972567786820',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972567902828',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972568163334',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972569915974',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972592145891',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972592246119',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972592361106',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972592843551',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972592887369',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972594770332',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595188871',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595251039',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595429195',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595659956',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595812220',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595830797',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972595979742',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972597060583',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972597185658',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972597223224',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972597533513',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972597722004',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972598066622',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972598312446',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972598883888',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972598919300',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599168887',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599232241',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599315754',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599315830',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599442535',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599453288',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38'),('972599743759',0,NULL,NULL,'2025-05-08 15:12:38','2025-05-08 22:12:38');
/*!40000 ALTER TABLE `network_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `course_number` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'جديد',
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (123456789,'إبراهيم مازن جهيز','123456789',102,3,'مدفوع','350 بنكي ديمة'),(561234567,'يوسف','561234567',101,101,'لايرد','ث123'),(562398741,'محمود','562398741',101,101,'مدفوع','300 بنكي'),(566813980,'عبد الرحمن دبابش','566813980',102,3,'مدفوع','350 كاش لكرم'),(567051233,'عبد الله محمود الغصين','567051233',102,3,'مدفوع','700بنكي ديمة'),(567284720,'خالد جهير','567284720',102,3,'مدفوع','350 بنكي ديمة'),(567754997,'عاهد نبيل داود عسليه','567754997',102,3,'مدفوع','700 بنكي ديمة'),(567778715,'عرفة جمال عوض الله','567778715',102,3,'مدفوع','700 بنكي لكرم/ ومحسوب على أوركيدة'),(568919992,'المعتصم بالله محمود الغصين','568919992',102,3,'مدفوع','700 بنكي ديمة'),(592165119,'خالد بلال عبد كريم','592165119',102,3,'لايرد',NULL),(592706061,'محمد عاهد العجلة','592706061',102,3,'مدفوع','250 كاش لكرم'),(593071414,'احمد','593071414',101,101,'إلغاء','يب'),(594040446,'محمد أبو مراد','594040446',102,3,'جديد',NULL),(594321579,'عمر','594321579',101,101,'جديد',NULL),(595105051,'بيان عنان الرواغ','595105051',102,3,'جديد',NULL),(595152722,'نور نعيم محمد أبو مطر','595152722',102,3,'جديد',NULL),(597134695,'عبود محمد حسن رحمي','0597134695',101,101,'جديد',NULL),(597665965,'محمود سلمي','597665965',102,3,'جديد',NULL),(598143179,'عدي أبو حطب','598143179',102,3,'جديد',NULL),(598681839,'عبد الكريم فريز أحمد الصفطاوي','598681839',102,3,'جديد',NULL),(598855410,'تامر رحمي','598855410',102,3,'جديد',NULL),(598983733,'جمال اسليم','598983733',102,3,'جديد',NULL),(599248361,'عبد الله ثائر منصور عابد','599248361',102,3,'جديد',NULL),(599306908,'محمد','599306908',101,101,'جديد',NULL),(599900313,'محمد عبد الرحمن بدوي','599900313',102,3,'جديد',NULL),(599999917,'احمد سعيد','599999917',102,3,'جديد',NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainer_courses`
--

DROP TABLE IF EXISTS `trainer_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainer_courses` (
  `trainer_id` int(11) NOT NULL,
  `course_number` int(11) NOT NULL,
  PRIMARY KEY (`trainer_id`,`course_number`),
  KEY `course_number` (`course_number`),
  CONSTRAINT `trainer_courses_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`),
  CONSTRAINT `trainer_courses_ibfk_2` FOREIGN KEY (`course_number`) REFERENCES `courses` (`course_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainer_courses`
--

LOCK TABLES `trainer_courses` WRITE;
/*!40000 ALTER TABLE `trainer_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainer_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainers`
--

LOCK TABLES `trainers` WRITE;
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-11  3:52:01
