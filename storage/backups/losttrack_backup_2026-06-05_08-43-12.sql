-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: losttrack
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `lokasi_hilang` varchar(255) DEFAULT NULL,
  `tanggal_hilang` date DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Verifikasi','Dalam Pencarian','Ditemukan','Ditutup') DEFAULT 'Menunggu Verifikasi',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,1,'laptop','Elektronik','mipa t','2026-05-31','hilang didepan mipa t','1780162950_image-removebg-preview (1).png','Menunggu Verifikasi','2026-05-30 17:42:30'),(2,2,'laptop','Elektronik','mipa t','2026-05-31','hilang','','Ditutup','2026-05-30 17:44:27'),(3,2,'laptop','Elektronik','gik ','2026-06-18','ctvtv','1780460940_Diagram Tanpa Judul-Page-4.drawio.png','Ditutup','2026-06-03 04:29:00'),(4,2,'hp','Elektronik','mipa t','2026-06-03','sss','1780568393_Screenshot 2026-02-20 142120.png','Menunggu Verifikasi','2026-06-04 10:19:53'),(5,2,'dompet','Lainnya','parkiran','2026-06-03','aa','1780568830_Screenshot 2026-02-20 142514.png','Dalam Pencarian','2026-06-04 10:27:10'),(6,3,'handphone','Elektronik','mipa t','2026-06-04','pink','','Dalam Pencarian','2026-06-04 15:30:23');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_insert_report` AFTER INSERT ON `reports` FOR EACH ROW BEGIN

    INSERT INTO status_logs(
        report_id,
        status_lama,
        status_baru,
        created_at
    )
    VALUES(
        NEW.id,
        '-',
        NEW.status,
        NOW()
    );

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_update_status` AFTER UPDATE ON `reports` FOR EACH ROW BEGIN

    IF OLD.status <> NEW.status THEN

        INSERT INTO status_logs(
            report_id,
            status_lama,
            status_baru,
            created_at
        )
        VALUES(
            NEW.id,
            OLD.status,
            NEW.status,
            NOW()
        );

    END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `reports_archive`
--

DROP TABLE IF EXISTS `reports_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports_archive` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `lokasi_hilang` varchar(255) DEFAULT NULL,
  `tanggal_hilang` date DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Verifikasi','Dalam Pencarian','Ditemukan','Ditutup') DEFAULT 'Menunggu Verifikasi',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports_archive`
--

LOCK TABLES `reports_archive` WRITE;
/*!40000 ALTER TABLE `reports_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_logs`
--

DROP TABLE IF EXISTS `status_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_logs` (
  `id` int NOT NULL,
  `report_id` int DEFAULT NULL,
  `status_lama` varchar(100) DEFAULT NULL,
  `status_baru` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_logs`
--

LOCK TABLES `status_logs` WRITE;
/*!40000 ALTER TABLE `status_logs` DISABLE KEYS */;
INSERT INTO `status_logs` VALUES (1,5,'-','Menunggu Verifikasi','2026-06-04 10:27:10'),(2,5,'Menunggu Verifikasi','Ditemukan','2026-06-04 11:04:30'),(0,6,'-','Menunggu Verifikasi','2026-06-04 15:30:23'),(0,6,'Menunggu Verifikasi','Dalam Pencarian','2026-06-04 16:05:27'),(0,5,'Ditemukan','Dalam Pencarian','2026-06-04 16:05:56'),(0,6,'Dalam Pencarian','Ditemukan','2026-06-04 16:06:04'),(0,6,'Ditemukan','Menunggu Verifikasi','2026-06-04 16:06:09'),(0,6,'Menunggu Verifikasi','Dalam Pencarian','2026-06-04 16:06:14');
/*!40000 ALTER TABLE `status_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@email.com','$2y$10$u0gb9pyfhkAk3ECMreaSaO6oehoMCr9AjL4.KhzD5tQMEMmB0kBEm','admin',NULL,'2026-05-30 17:20:10'),(2,'nisa','nisa@email.com','$2y$10$Pt2EfBllejrPbN.3kbZLd.yK.WHBLKAFWnLgxMTX55MNHAyJlSDIG','user',NULL,'2026-05-30 17:43:43'),(3,'ina','ina@email.com','$2y$10$jvKXqdW9xBZ0LP2ypr916e8I8gciWq.bHbGVfGczpv9F5c4Il8heq','user',NULL,'2026-06-04 15:04:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_aduan_user`
--

DROP TABLE IF EXISTS `v_aduan_user`;
/*!50001 DROP VIEW IF EXISTS `v_aduan_user`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_aduan_user` AS SELECT 
 1 AS `id`,
 1 AS `user_id`,
 1 AS `nama_pelapor`,
 1 AS `nama_barang`,
 1 AS `kategori`,
 1 AS `lokasi_hilang`,
 1 AS `tanggal_hilang`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_semua_aduan`
--

DROP TABLE IF EXISTS `v_semua_aduan`;
/*!50001 DROP VIEW IF EXISTS `v_semua_aduan`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_semua_aduan` AS SELECT 
 1 AS `id`,
 1 AS `user_id`,
 1 AS `nama_barang`,
 1 AS `kategori`,
 1 AS `lokasi_hilang`,
 1 AS `tanggal_hilang`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_aduan_user`
--

/*!50001 DROP VIEW IF EXISTS `v_aduan_user`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_aduan_user` AS select `r`.`id` AS `id`,`r`.`user_id` AS `user_id`,`u`.`nama` AS `nama_pelapor`,`r`.`nama_barang` AS `nama_barang`,`r`.`kategori` AS `kategori`,`r`.`lokasi_hilang` AS `lokasi_hilang`,`r`.`tanggal_hilang` AS `tanggal_hilang`,`r`.`status` AS `status` from (`reports` `r` join `users` `u` on((`r`.`user_id` = `u`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_semua_aduan`
--

/*!50001 DROP VIEW IF EXISTS `v_semua_aduan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_semua_aduan` AS select `reports`.`id` AS `id`,`reports`.`user_id` AS `user_id`,`reports`.`nama_barang` AS `nama_barang`,`reports`.`kategori` AS `kategori`,`reports`.`lokasi_hilang` AS `lokasi_hilang`,`reports`.`tanggal_hilang` AS `tanggal_hilang`,`reports`.`status` AS `status` from `reports` union all select `reports_archive`.`id` AS `id`,`reports_archive`.`user_id` AS `user_id`,`reports_archive`.`nama_barang` AS `nama_barang`,`reports_archive`.`kategori` AS `kategori`,`reports_archive`.`lokasi_hilang` AS `lokasi_hilang`,`reports_archive`.`tanggal_hilang` AS `tanggal_hilang`,`reports_archive`.`status` AS `status` from `reports_archive` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-05  8:43:13
