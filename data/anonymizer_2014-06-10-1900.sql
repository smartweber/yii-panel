-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: anonymizer
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

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
-- Table structure for table `blocked_urls`
--

DROP TABLE IF EXISTS `blocked_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocked_urls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked_urls`
--

LOCK TABLES `blocked_urls` WRITE;
/*!40000 ALTER TABLE `blocked_urls` DISABLE KEYS */;
INSERT INTO `blocked_urls` VALUES (1,'news.mail.ru'),(2,'sport.mail.ru'),(3,'http://yandex.ru'),(4,'http://some.com');
/*!40000 ALTER TABLE `blocked_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocked_urls_for_users`
--

DROP TABLE IF EXISTS `blocked_urls_for_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocked_urls_for_users` (
  `userID` int(11) unsigned NOT NULL,
  `blockedUrlID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userID`,`blockedUrlID`),
  KEY `blockedUrlID` (`blockedUrlID`),
  CONSTRAINT `blocked_urls_for_users_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  CONSTRAINT `blocked_urls_for_users_ibfk_2` FOREIGN KEY (`blockedUrlID`) REFERENCES `blocked_urls` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked_urls_for_users`
--

LOCK TABLES `blocked_urls_for_users` WRITE;
/*!40000 ALTER TABLE `blocked_urls_for_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocked_urls_for_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocked_urls_for_webaccounts`
--

DROP TABLE IF EXISTS `blocked_urls_for_webaccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocked_urls_for_webaccounts` (
  `webaccountID` int(11) unsigned NOT NULL,
  `blockedUrlID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`webaccountID`,`blockedUrlID`),
  KEY `blocked_urls_for_webaccounts_ibfk_2` (`blockedUrlID`),
  CONSTRAINT `blocked_urls_for_webaccounts_ibfk_1` FOREIGN KEY (`webaccountID`) REFERENCES `webaccounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blocked_urls_for_webaccounts_ibfk_2` FOREIGN KEY (`blockedUrlID`) REFERENCES `blocked_urls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked_urls_for_webaccounts`
--

LOCK TABLES `blocked_urls_for_webaccounts` WRITE;
/*!40000 ALTER TABLE `blocked_urls_for_webaccounts` DISABLE KEYS */;
INSERT INTO `blocked_urls_for_webaccounts` VALUES (2,1),(3,1),(3,2),(7,2);
/*!40000 ALTER TABLE `blocked_urls_for_webaccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `message` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,NULL,'hehe','2014-06-07 20:49:19'),(2,NULL,'Wrong protocol attempt detected from /127.0.0.1:53814','2014-06-07 21:54:50'),(3,NULL,'Exception happened: ','2014-06-09 09:16:27'),(4,NULL,'Not SSL attempted to connect: not an SSL/TLS record: 6466730d0a, from /127.0.0.1:48284','2014-06-09 09:19:26'),(5,NULL,'Exception happened: not an SSL/TLS record: 6466730d0a from /127.0.0.1:48284','2014-06-09 09:19:26'),(6,NULL,'Exception happened: not an SSL/TLS record: 400801123ca21f04616c6578aa1f2830324530334331413445313243463544323033364244453935453934313141364346354643303344b21f07456e676c697368 from /5.105.40.241:59607','2014-06-09 09:21:24'),(7,NULL,'User logged in from /5.105.40.241:59639','2014-06-09 09:51:07'),(8,NULL,'User logged in from /5.105.40.241:59732','2014-06-09 10:03:54'),(9,NULL,'User logged in from /5.105.40.241:59735','2014-06-09 10:04:05'),(10,NULL,'User logged in from /5.105.40.241:59738','2014-06-09 10:04:23'),(11,NULL,'User logged in from /5.105.40.241:59761','2014-06-09 10:11:09'),(12,NULL,'User logged in from /5.105.40.241:59850','2014-06-10 14:54:39'),(13,NULL,'Exception happened: execute command denied to user \'proxy_client\'@\'%\' for routine \'anonymizer.getWebAccountsForUser\'','2014-06-10 14:54:39'),(14,NULL,'User logged in from /5.105.40.241:59856','2014-06-10 14:55:18'),(15,NULL,'User logged in from /5.105.40.241:32854','2014-06-10 16:23:44'),(16,NULL,'User logged in from /5.105.40.241:32984','2014-06-10 16:24:34'),(17,NULL,'User logged in from /5.105.40.241:33043','2014-06-10 16:26:37'),(18,NULL,'User logged in from /5.105.40.241:33045','2014-06-10 16:26:44'),(19,NULL,'User \'admin\' logged in from /5.105.40.241:33066','2014-06-10 16:29:46'),(20,NULL,'User \'alex\' logged in from /5.105.40.241:33073','2014-06-10 16:30:46'),(21,NULL,'User \'alex\' logged in from /5.105.40.241:33087','2014-06-10 16:31:14'),(22,NULL,'User \'tesha\' logged in from /65.190.3.39:49212','2014-06-10 17:28:31'),(23,NULL,'User \'tesha\' logged in from /65.190.3.39:49381','2014-06-10 17:30:53'),(24,NULL,'User \'tesha\' logged in from /65.190.3.39:49548','2014-06-10 17:35:52'),(25,NULL,'User \'alex\' logged in from /5.105.40.241:33640','2014-06-10 17:38:20');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proxies`
--

DROP TABLE IF EXISTS `proxies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proxies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(300) NOT NULL,
  `port` int(11) unsigned NOT NULL DEFAULT '80',
  `username` varchar(110) NOT NULL DEFAULT '',
  `password` varchar(110) NOT NULL DEFAULT '',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proxies`
--

LOCK TABLES `proxies` WRITE;
/*!40000 ALTER TABLE `proxies` DISABLE KEYS */;
INSERT INTO `proxies` VALUES (1,'23.244.106.63',31731,'Listmonetize','U5A7EmYra',1),(2,'23.247.128.218',6948,'Listmonetize','U5A7EmYra',1),(3,'localhost',80,'1','2',1);
/*!40000 ALTER TABLE `proxies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proxies_for_users`
--

DROP TABLE IF EXISTS `proxies_for_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proxies_for_users` (
  `userID` int(11) unsigned NOT NULL,
  `proxyID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userID`,`proxyID`),
  KEY `proxies_for_users_ibfk_2` (`proxyID`),
  CONSTRAINT `proxies_for_users_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `proxies_for_users_ibfk_2` FOREIGN KEY (`proxyID`) REFERENCES `proxies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proxies_for_users`
--

LOCK TABLES `proxies_for_users` WRITE;
/*!40000 ALTER TABLE `proxies_for_users` DISABLE KEYS */;
INSERT INTO `proxies_for_users` VALUES (1,1),(8,1),(1,2),(8,2);
/*!40000 ALTER TABLE `proxies_for_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scripts`
--

DROP TABLE IF EXISTS `scripts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scripts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `source` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scripts`
--

LOCK TABLES `scripts` WRITE;
/*!40000 ALTER TABLE `scripts` DISABLE KEYS */;
INSERT INTO `scripts` VALUES (1,'Gogvo','(function () { \r\n document.getElementsByName(\'login\')[0].value = \'{USERID}\';\r\n  document.getElementsByName(\'password\')[0].value = \'{PASSWORD}\'\r\n  document.getElementbyId(\'account\').submit();\r\n})();'),(2,'AWeber','document.getElementById(\'AccountUsername\').value=\'{USERID}\'; document.getElementById(\'AccountPassword\').value=\'{PASSWORD}\'; document.getElementById(\'SubmitLogin\').click();');
/*!40000 ALTER TABLE `scripts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `salt` varchar(10) DEFAULT NULL,
  `max_guid_length` int(11) DEFAULT NULL,
  `sha_type` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('SUDY38nuds',50,NULL,0);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) DEFAULT NULL,
  `guid` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `isAdmin` tinyint(1) DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'alex','12333123123','02e03c1a4e12cf5d2036bde95e9411a6cf5fc03d','alexzkhr@gmail.com',1,1),(2,'dmitriy','','a822fdfdc4c5a71b03f571c219c8d53d55ed94ce','dimko.goncharov@gmail.com',1,1),(6,'test1','','6cbcceb12195d9a5bb1e5ca9fb0df824d1506af2','',0,1),(7,'admin','','c02ffa4e135c90c709fde413c21f2549025eaf66','',1,1),(8,'tesha','','d7dc657a5686a55db48900cd753e5813cfffd3aa','tesha@bizlaunchequity.com',1,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_users_insert` BEFORE INSERT ON `users` FOR EACH ROW begin
  declare l_guid varchar(50);
  call createGUID(new.login, new.password, l_guid);
  set new.password = '';
  set new.guid = l_guid;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `webaccounts`
--

DROP TABLE IF EXISTS `webaccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webaccounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'No Title',
  `defaultProxyID` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `scriptID` int(11) NOT NULL,
  `username` varchar(110) NOT NULL,
  `password` varchar(110) NOT NULL,
  `value1` int(11) DEFAULT NULL,
  `value2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webaccounts`
--

LOCK TABLES `webaccounts` WRITE;
/*!40000 ALTER TABLE `webaccounts` DISABLE KEYS */;
INSERT INTO `webaccounts` VALUES (2,'AWeber1',2,'https://www.aweber.com/login.htm',2,'test','test',NULL,NULL),(3,'Mailru',2,'http://mail.ru',2,'test','test',NULL,NULL),(7,'No Title1',1,'http://google.com',2,'nouser','noname',NULL,NULL),(8,'Aweber',1,'https://www.aweber.com/login.htm',2,'toniyoung','Ty1219781532',NULL,NULL);
/*!40000 ALTER TABLE `webaccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webaccounts_for_users`
--

DROP TABLE IF EXISTS `webaccounts_for_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webaccounts_for_users` (
  `userID` int(11) unsigned NOT NULL,
  `webaccountID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`userID`,`webaccountID`),
  KEY `webaccounts_for_users_ibfk_2` (`webaccountID`),
  CONSTRAINT `webaccounts_for_users_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `webaccounts_for_users_ibfk_2` FOREIGN KEY (`webaccountID`) REFERENCES `webaccounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webaccounts_for_users`
--

LOCK TABLES `webaccounts_for_users` WRITE;
/*!40000 ALTER TABLE `webaccounts_for_users` DISABLE KEYS */;
INSERT INTO `webaccounts_for_users` VALUES (1,3),(6,3),(8,8);
/*!40000 ALTER TABLE `webaccounts_for_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-10 19:00:56
