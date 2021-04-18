-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: fauna
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

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
-- Table structure for table `animal`
--

DROP TABLE IF EXISTS `animal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animal` (
  `id_animal` int NOT NULL AUTO_INCREMENT,
  `nome_animal` varchar(50) NOT NULL,
  `id_usuario` int NOT NULL DEFAULT '0',
  `raca` int NOT NULL DEFAULT '0',
  `sexo_animal` int NOT NULL DEFAULT '0',
  `foto_animal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `id_usuario_retricao` (`id_usuario`),
  KEY `sexo_restricao` (`sexo_animal`),
  KEY `raca_restricao` (`raca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal`
--

LOCK TABLES `animal` WRITE;
/*!40000 ALTER TABLE `animal` DISABLE KEYS */;
/*!40000 ALTER TABLE `animal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'feed'),(2,'adoção'),(3,'desaparecimento');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_postagem` int NOT NULL,
  `texto` varchar(500) NOT NULL DEFAULT '',
  `dh_comentario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  KEY `restricao_usuario_comentario` (`id_usuario`),
  KEY `restricao_postagem` (`id_postagem`),
  CONSTRAINT `restricao_postagem` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`id_postagem`),
  CONSTRAINT `restricao_usuario_comentario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curtida`
--

DROP TABLE IF EXISTS `curtida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curtida` (
  `id_curtida` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_postagem` int DEFAULT NULL,
  `id_comentario` int DEFAULT NULL,
  PRIMARY KEY (`id_curtida`),
  KEY `restricao_usuario_curtida` (`id_usuario`),
  KEY `restricao_postagem_curtida` (`id_postagem`),
  KEY `restricao_id_comentario` (`id_comentario`),
  CONSTRAINT `restricao_id_comentario` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id_comentario`),
  CONSTRAINT `restricao_postagem_curtida` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`id_postagem`),
  CONSTRAINT `restricao_usuario_curtida` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curtida`
--

LOCK TABLES `curtida` WRITE;
/*!40000 ALTER TABLE `curtida` DISABLE KEYS */;
/*!40000 ALTER TABLE `curtida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_usuario`
--

DROP TABLE IF EXISTS `nivel_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivel_usuario` (
  `id_nivel_usuario` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(10) NOT NULL,
  PRIMARY KEY (`id_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_usuario`
--

LOCK TABLES `nivel_usuario` WRITE;
/*!40000 ALTER TABLE `nivel_usuario` DISABLE KEYS */;
INSERT INTO `nivel_usuario` VALUES (1,'admin'),(2,'usuario');
/*!40000 ALTER TABLE `nivel_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postagem`
--

DROP TABLE IF EXISTS `postagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postagem` (
  `id_postagem` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_animal` int NOT NULL,
  `id_categoria` int NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `dh_postagem` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `midia` varchar(100) NOT NULL,
  PRIMARY KEY (`id_postagem`),
  KEY `restricao_usuario` (`id_usuario`),
  KEY `restricao_animal` (`id_animal`),
  KEY `restricao_categoria` (`id_categoria`),
  CONSTRAINT `restricao_animal` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`),
  CONSTRAINT `restricao_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `restricao_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postagem`
--

LOCK TABLES `postagem` WRITE;
/*!40000 ALTER TABLE `postagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `postagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguir`
--

DROP TABLE IF EXISTS `seguir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seguir` (
  `id_seguido` int NOT NULL,
  `id_seguidor` int NOT NULL,
  KEY `restricao_id_usuario_seguido` (`id_seguido`),
  KEY `restricao_id_usuario_seguidor` (`id_seguidor`),
  CONSTRAINT `restricao_id_usuario_seguido` FOREIGN KEY (`id_seguido`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `restricao_id_usuario_seguidor` FOREIGN KEY (`id_seguidor`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguir`
--

LOCK TABLES `seguir` WRITE;
/*!40000 ALTER TABLE `seguir` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sexo`
--

DROP TABLE IF EXISTS `sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sexo` (
  `id_sexo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(15) NOT NULL,
  PRIMARY KEY (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sexo`
--

LOCK TABLES `sexo` WRITE;
/*!40000 ALTER TABLE `sexo` DISABLE KEYS */;
INSERT INTO `sexo` VALUES (1,'masculino'),(2,'feminino'),(3,'outro');
/*!40000 ALTER TABLE `sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'cachorros'),(2,'gatos'),(3,'peixes'),(4,'aves'),(5,'roedores'),(6,'coelhos'),(7,'tartarugas'),(8,'bovinos'),(9,'capríneos'),(10,'equídeos'),(11,'suínos'),(12,'cobras'),(13,'lagartos'),(14,'insetos/aracnídeos'),(15,'outros');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo_usuario` int NOT NULL,
  `data_nascimento` date NOT NULL,
  `foto_usuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nivel_usuario` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `restricao_nivel_usuario` (`nivel_usuario`),
  KEY `restricao_sexo` (`sexo_usuario`),
  CONSTRAINT `restricao_nivel_usuario` FOREIGN KEY (`nivel_usuario`) REFERENCES `nivel_usuario` (`id_nivel_usuario`),
  CONSTRAINT `restricao_sexo` FOREIGN KEY (`sexo_usuario`) REFERENCES `sexo` (`id_sexo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'teste','teste@teste.com','teste','ewfggrrgrgr',2,'2020-04-17',NULL,1),(2,'Rodrigo','rodrigooh.dl@gmail.com','123456','11982939132',1,'1998-03-26',NULL,1),(3,'Rodrigo','rodrigo@gmail.com','123456','11982939132',1,'1998-03-26',NULL,1),(4,'testeuser','testando@teste.com','123456','124851254',1,'1999-02-18',NULL,1),(5,'testeuser2','testando1@teste.com','123456','124851254',1,'1999-02-18',NULL,1),(6,'rodri','rodrig@gmail.com','123456','1215445',1,'2002-03-22',NULL,1),(7,'rer','tdfdeste@teste.com','123456','156125315',2,'2016-11-30',NULL,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-18 20:41:10
