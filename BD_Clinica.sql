CREATE DATABASE  IF NOT EXISTS `clinica_psicologica` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `clinica_psicologica`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: clinica_psicologica
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `evaluaciones`
--

DROP TABLE IF EXISTS `evaluaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluaciones` (
  `id_evaluacion` int NOT NULL AUTO_INCREMENT,
  `rut` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `id_tipo_atencion` int DEFAULT NULL,
  `derivacion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comentarios` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_profesion` int DEFAULT NULL,
  `nombre` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_evaluacion`),
  KEY `FK_evaluaciones_To_paciente` (`rut`),
  KEY `FK_evaluaciones_To_atencion` (`id_tipo_atencion`),
  KEY `FK_evaluaciones_To_profesion` (`id_profesion`),
  CONSTRAINT `FK_evaluaciones_To_atencion` FOREIGN KEY (`id_tipo_atencion`) REFERENCES `tipo_atencion` (`id_atencion`),
  CONSTRAINT `FK_evaluaciones_To_profesion` FOREIGN KEY (`id_profesion`) REFERENCES `tipo_profesion` (`id_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluaciones`
--

LOCK TABLES `evaluaciones` WRITE;
/*!40000 ALTER TABLE `evaluaciones` DISABLE KEYS */;
INSERT INTO `evaluaciones` VALUES (38,'22.044.120-2',1,'De clinica a hospital','','2026-04-30','marcelosandoval@unap.cl',1,'Javier','Ortis'),(39,'9.199.580-8',1,'De clinica a hospital','','2026-04-22','marcelosandoval@unap.cl',1,'José ','González'),(40,'9.199.580-8',2,'De clinica a casa','','2026-04-22','marcelosandoval@unap.cl',2,'Patricio','González');
/*!40000 ALTER TABLE `evaluaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituciones`
--

DROP TABLE IF EXISTS `instituciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instituciones` (
  `Id_instituciones` int NOT NULL,
  `Institucion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_derivacion` int NOT NULL,
  PRIMARY KEY (`Id_instituciones`),
  KEY `FK_instituciones_To_derivacion` (`id_derivacion`),
  CONSTRAINT `FK_instituciones_To_derivacion` FOREIGN KEY (`id_derivacion`) REFERENCES `tipo_derivacion` (`id_derivacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituciones`
--

LOCK TABLES `instituciones` WRITE;
/*!40000 ALTER TABLE `instituciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `instituciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrationhistory`
--

DROP TABLE IF EXISTS `migrationhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrationhistory` (
  `MigrationId` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `ContextKey` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `Model` longblob NOT NULL,
  `ProductVersion` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`MigrationId`,`ContextKey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrationhistory`
--

LOCK TABLES `migrationhistory` WRITE;
/*!40000 ALTER TABLE `migrationhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrationhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `rut` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `celular` int DEFAULT NULL,
  `id_rango_etareo` int NOT NULL,
  `comentarios` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `id_estado` int NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  UNIQUE KEY `rut` (`rut`),
  KEY `FK_pacientes_To_rango` (`id_rango_etareo`),
  KEY `FK_pacientes_To_estado` (`id_estado`),
  CONSTRAINT `FK_pacientes_To_estado` FOREIGN KEY (`id_estado`) REFERENCES `tipo_estado` (`id_estado`),
  CONSTRAINT `FK_pacientes_To_rango` FOREIGN KEY (`id_rango_etareo`) REFERENCES `tipo_rango_etareo` (`id_rango_etareo`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (12,'15.293.388-6','Cristina Genésis ','Pérez González','cristina@gmail.com',987654321,2,'Ingresado correctamente','2026-03-18',1,'hrubio'),(16,'25.183.310-9','Eduardo Alonso','Rojas Sepúlveda','eduardo@gmail.com',987654321,3,'usuario ingresado','2026-03-23',4,'hrubio'),(19,'22.044.120-2','Patricio ','González','eduardo@gmail.com',940313834,2,'','2006-02-08',1,'admin@unap.cl'),(39,'9.199.580-8','José','González','',922589604,2,'','2026-04-22',1,'admin@unap.cl'),(41,'5.970.575-k','Andrea','Muñoz','',988775544,1,'','2026-04-23',1,'admin@unap.cl'),(42,'14580289-k','alejandra','urrea','',954659585,2,'','2026-04-20',2,'admin@unap.cl'),(43,'14.227.791-3','Patricio','González','',958642185,1,'','2026-04-17',1,'admin@unap.cl'),(48,'6.746.250-5','Miguel','Ortis','',958963214,1,'','2026-04-26',1,'admin@unap.cl'),(49,'13.155.232-7','Alejandra','Bravo','',982742330,2,'','2026-04-30',2,'admin@unap.cl'),(51,'17.913.126-9','Marcelo','Sandoval','',958452330,2,'','2026-04-20',1,'marcelosandoval@unap.cl');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sesiones` (
  `id_sesion` int NOT NULL AUTO_INCREMENT,
  `rut` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `numero_sesion` int NOT NULL,
  `fecha_sesion` date NOT NULL,
  `comentarios` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asiste` varchar(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_sesion`),
  KEY `FK_sesiones_To_paciente` (`rut`),
  CONSTRAINT `FK_sesiones_To_paciente` FOREIGN KEY (`rut`) REFERENCES `pacientes` (`rut`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesiones`
--

LOCK TABLES `sesiones` WRITE;
/*!40000 ALTER TABLE `sesiones` DISABLE KEYS */;
INSERT INTO `sesiones` VALUES (23,'9.199.580-8',1,'2026-04-17','','admin@unap.cl','1'),(24,'9.199.580-8',2,'2026-04-17','','admin@unap.cl','1'),(25,'9.199.580-8',3,'2026-04-17','','admin@unap.cl','Sí'),(27,'22.044.120-2',1,'2026-04-27','','admin@unap.cl','1'),(28,'22.044.120-2',2,'2026-04-17','','admin@unap.cl','Sí'),(29,'22.044.120-2',3,'2026-04-17','','admin@unap.cl','Sí'),(30,'9.199.580-8',4,'2026-04-17','','admin@unap.cl','Sí'),(31,'22.044.120-2',4,'2026-04-17','','admin@unap.cl','Sí'),(32,'9.199.580-8',5,'2026-04-17','','admin@unap.cl','Sí'),(33,'9.199.580-8',6,'2026-04-30','','admin@unap.cl','Sí'),(34,'9.199.580-8',7,'2026-04-27','','admin@unap.cl','Sí'),(35,'9.199.580-8',8,'2026-04-27','','admin@unap.cl','Sí'),(42,'13.155.232-7',1,'2026-04-27','','admin@unap.cl','Sí'),(43,'13.155.232-7',2,'2026-05-04','','admin@unap.cl','1'),(44,'13.155.232-7',3,'2026-04-20','','admin@unap.cl','Sí'),(45,'9.199.580-8',9,'2026-04-20','','admin@unap.cl','1'),(46,'9.199.580-8',10,'2026-04-23','','marcelosandoval@unap.cl','Sí');
/*!40000 ALTER TABLE `sesiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_atencion`
--

DROP TABLE IF EXISTS `tipo_atencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_atencion` (
  `id_atencion` int NOT NULL AUTO_INCREMENT,
  `nombre_tipo_atencion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_atencion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_atencion`
--

LOCK TABLES `tipo_atencion` WRITE;
/*!40000 ALTER TABLE `tipo_atencion` DISABLE KEYS */;
INSERT INTO `tipo_atencion` VALUES (1,'Terapia individual'),(2,'Acompañamiento terapéutico');
/*!40000 ALTER TABLE `tipo_atencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_derivacion`
--

DROP TABLE IF EXISTS `tipo_derivacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_derivacion` (
  `id_derivacion` int NOT NULL AUTO_INCREMENT,
  `nombre_institucion_derivacion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_derivacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_derivacion`
--

LOCK TABLES `tipo_derivacion` WRITE;
/*!40000 ALTER TABLE `tipo_derivacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_derivacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_estado`
--

DROP TABLE IF EXISTS `tipo_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_estado` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `tipo_estado` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_estado`
--

LOCK TABLES `tipo_estado` WRITE;
/*!40000 ALTER TABLE `tipo_estado` DISABLE KEYS */;
INSERT INTO `tipo_estado` VALUES (1,'En curso'),(2,'Derivado'),(3,'Deserción'),(4,'Alta Terapéutica'),(5,'Alta por deserción'),(6,'Alta administrativa');
/*!40000 ALTER TABLE `tipo_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_profesion`
--

DROP TABLE IF EXISTS `tipo_profesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_profesion` (
  `id_profesion` int NOT NULL AUTO_INCREMENT,
  `Profesion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_profesion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_profesion`
--

LOCK TABLES `tipo_profesion` WRITE;
/*!40000 ALTER TABLE `tipo_profesion` DISABLE KEYS */;
INSERT INTO `tipo_profesion` VALUES (1,'Pre-Práctica'),(2,'Práctica');
/*!40000 ALTER TABLE `tipo_profesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_rango_etareo`
--

DROP TABLE IF EXISTS `tipo_rango_etareo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_rango_etareo` (
  `id_rango_etareo` int NOT NULL AUTO_INCREMENT,
  `nombre_rango_etareo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_rango_etareo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_rango_etareo`
--

LOCK TABLES `tipo_rango_etareo` WRITE;
/*!40000 ALTER TABLE `tipo_rango_etareo` DISABLE KEYS */;
INSERT INTO `tipo_rango_etareo` VALUES (1,'niño'),(2,'adulto'),(3,'adolecente');
/*!40000 ALTER TABLE `tipo_rango_etareo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertokencaches`
--

DROP TABLE IF EXISTS `usertokencaches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usertokencaches` (
  `UserTokenCacheId` int NOT NULL AUTO_INCREMENT,
  `webUserUniqueId` text COLLATE utf8mb4_general_ci,
  `cacheBits` longblob,
  `LastWrite` datetime NOT NULL,
  PRIMARY KEY (`UserTokenCacheId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertokencaches`
--

LOCK TABLES `usertokencaches` WRITE;
/*!40000 ALTER TABLE `usertokencaches` DISABLE KEYS */;
/*!40000 ALTER TABLE `usertokencaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_logueo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'usuario',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (10,'admin@unap.cl','$2y$10$ZPjA0QUHggoXtP5dTHufleVaDJ1gH.hgiYFLRhocqZJUlJzVaaFHO','2026-04-15 13:02:44','Javier González','admin'),(21,'patricio.gonzalez1733@gmail.com','$2y$10$XOiKy6tfxLtIE09bWBbENel1A3p/UuQLi5bUq/t2Cxot512IigHCW','2026-04-16 16:44:04','Patricio','usuario'),(23,'caespinozar@unap.cl','$2y$10$StfyUBfq7MKhN0TEbkbAiuYWkFpkp0SNtHboO.XMkAIbID3Q4cugu','2026-04-16 19:44:32','Carolina Espinoza','usuario'),(24,'patjav91@gmail.com','$2y$10$YhP9dc6eQqySvB90Bq2cZ.Ke53jpbFWfhHPZtfLIkz6yfMFoGueY6','2026-04-17 15:45:09','Javier Bravo','usuario'),(25,'alejandra.bravo1733@gmail.com','$2y$10$WxPK4yLnCYTxOhRrP1xIyeGFekuQve406eU/0XXJwJOXbniZRsAOm','2026-04-18 01:01:24','Alejandra Bravo','usuario'),(27,'marcelosandoval@unap.cl','$2y$10$dVGFeMDb.hmGayRwmSjxZ.xQLZ/LRsMl0EMV7ItyCwIILFVIqAreO','2026-04-20 15:43:08','Marcelo Sandoval','usuario');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_paciente`
--

DROP TABLE IF EXISTS `vista_paciente`;
/*!50001 DROP VIEW IF EXISTS `vista_paciente`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_paciente` AS SELECT 
 1 AS `rut`,
 1 AS `nombre_completo`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vista_paciente`
--

/*!50001 DROP VIEW IF EXISTS `vista_paciente`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_paciente` AS select `pacientes`.`rut` AS `rut`,concat(`pacientes`.`apellidos`,' ',`pacientes`.`nombres`) AS `nombre_completo` from `pacientes` */;
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

-- Dump completed on 2026-04-20 14:31:47
