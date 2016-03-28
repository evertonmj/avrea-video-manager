CREATE DATABASE  IF NOT EXISTS `videomanagerdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `videomanagerdb`;
-- MySQL dump 10.13  Distrib 5.6.24, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: videomanagerdb
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.04.1

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
-- Table structure for table `categoria_video`
--

DROP TABLE IF EXISTS `categoria_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código',
  `nome` varchar(100) NOT NULL COMMENT 'Nome',
  `descricao` varchar(500) DEFAULT NULL COMMENT 'Descrição',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_video`
--

LOCK TABLES `categoria_video` WRITE;
/*!40000 ALTER TABLE `categoria_video` DISABLE KEYS */;
INSERT INTO `categoria_video` VALUES (1,'Geral',''),(2,'Categoria 2','');
/*!40000 ALTER TABLE `categoria_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_migration`
--

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base',1404744529);
/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código',
  `username` varchar(100) NOT NULL COMMENT 'Usuário',
  `password` varchar(256) NOT NULL COMMENT 'Senha',
  `email` varchar(200) NOT NULL COMMENT 'E-Mail',
  `fullname` varchar(100) NOT NULL COMMENT 'Nome Completo',
  `created_at` datetime NOT NULL COMMENT 'Data de Criação',
  `modified_at` datetime DEFAULT NULL COMMENT 'Data de Modificação',
  `blocked` int(11) DEFAULT '0' COMMENT 'Bloqueado',
  `active` int(11) NOT NULL DEFAULT '1' COMMENT 'Ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','clinicadaobesidade@gmail.com','Admin','2014-07-07 16:39:56','2014-07-07 16:39:56',0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Código',
  `categoria_video_id` int(11) NOT NULL COMMENT 'Categoria',
  `nome` varchar(100) NOT NULL COMMENT 'Nome',
  `descricao` varchar(2000) DEFAULT NULL COMMENT 'Descrição',
  `ordem` int(11) NOT NULL COMMENT 'Ordem',
  `obrigatorio` int(11) DEFAULT '1' COMMENT 'Obrigatório?',
  `caminho` varchar(1000) DEFAULT NULL COMMENT 'Caminho para o arquivo',
  `data_criacao` datetime NOT NULL COMMENT 'Data de Criação',
  `data_modificacao` datetime DEFAULT NULL COMMENT 'Data de Modificação',
  `arquivo` longblob COMMENT 'Arquivo Físico',
  `arquivo_nome` varchar(300) DEFAULT NULL COMMENT 'Nome do Arquivo',
  `arquivo_tipo` varchar(20) DEFAULT NULL COMMENT 'Tipo do Arquivo',
  `codigo_gerado` varchar(4000) DEFAULT NULL COMMENT 'Código Gerado',
  `qtd_execucoes` bigint(20) DEFAULT '0' COMMENT 'Quantidade de Execuções',
  `ativo` int(11) NOT NULL DEFAULT '1' COMMENT 'Ativo',
  PRIMARY KEY (`id`),
  KEY `fk_video_categoria_video1_idx` (`categoria_video_id`),
  CONSTRAINT `fk_video_categoria_video1` FOREIGN KEY (`categoria_video_id`) REFERENCES `categoria_video` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,1,'Vídeo teste','',0,1,'53be8a202d2955.11649173.mp4','2014-07-08 11:18:33','2014-07-10 09:42:08','H264_test5_voice_mp4_480x360.mp4','H264_test5_voice_mp4_480x360.mp4','mp4','<link rel=\'stylesheet\' type=\'text/css\' \n	 href=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video-js.min.css\' />\n\n<script type=\'text/javascript\' \n	 src=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video.js\'></script>\n\n<video id=\'video_53be8a202d2955.11649173.mp4\' class=\'video-js vjs-default-skin\'\n	 controls preload=\'auto\' width=\'720\' height=\'480\'\n	 data-setup=\'{\"example_option\":true}\'>\n	 <source src=\"rtmp://s17z6bfw0vxwrz.cloudfront.net/cfx/st/&mp4:53be8a202d2955.11649173.mp4\"\n	 type=\'rtmp/mp4\' />\n	 <p class=\'vjs-no-js\'>Para visualizar este vídeo por favor, \n	 habilite o Javascript e considere atualizar o seu navegador. \n	 <a href=\'http://videojs.com/html5-video-support/\' target=\'_blank\'>\n	 Verifique os navegadores que oferecen suporte ao HTML 5</a></p>\n</video>\n',0,1),(2,2,'Video 2','Descroção do vídeo 2',0,1,'53bec52a9c0804.00582907.mp4','2014-07-10 13:53:09','2014-07-10 13:54:02','','H264_test5_voice_mp4_480x360.mp4','mp4','<link rel=\'stylesheet\' type=\'text/css\' \n	 href=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video-js.min.css\' />\n\n<script type=\'text/javascript\' \n	 src=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video.js\'></script>\n\n<video id=\'video_53bec52a9c0804.00582907.mp4\' class=\'video-js vjs-default-skin\'\n	 controls preload=\'auto\' width=\'720\' height=\'480\'\n	 data-setup=\'{\"example_option\":true}\'>\n	 <source src=\"rtmp://s17z6bfw0vxwrz.cloudfront.net/cfx/st/&mp4:53bec52a9c0804.00582907.mp4\"\n	 type=\'rtmp/mp4\' />\n	 <p class=\'vjs-no-js\'>Para visualizar este vídeo por favor, \n	 habilite o Javascript e considere atualizar o seu navegador. \n	 <a href=\'http://videojs.com/html5-video-support/\' target=\'_blank\'>\n	 Verifique os navegadores que oferecen suporte ao HTML 5</a></p>\n</video>\n',0,1),(3,1,'Vídeo 3','Descrição do vídeo 3',0,1,'53bec5d73363b4.03554343.mp4','2014-07-10 13:56:45','2014-07-10 13:56:55','small.mp4','small.mp4','mp4','<link rel=\'stylesheet\' type=\'text/css\' \n	 href=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video-js.min.css\' />\n\n<script type=\'text/javascript\' \n	 src=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video.js\'></script>\n\n<video id=\'video_53bec5d73363b4.03554343.mp4\' class=\'video-js vjs-default-skin\'\n	 controls preload=\'auto\' width=\'720\' height=\'480\'\n	 data-setup=\'{\"example_option\":true}\'>\n	 <source src=\"rtmp://s17z6bfw0vxwrz.cloudfront.net/cfx/st/&mp4:53bec5d73363b4.03554343.mp4\"\n	 type=\'rtmp/mp4\' />\n	 <p class=\'vjs-no-js\'>Para visualizar este vídeo por favor, \n	 habilite o Javascript e considere atualizar o seu navegador. \n	 <a href=\'http://videojs.com/html5-video-support/\' target=\'_blank\'>\n	 Verifique os navegadores que oferecen suporte ao HTML 5</a></p>\n</video>\n',0,1),(4,2,'teste','',0,1,'54189552cd28f5.48891723.mp4','2014-09-16 16:30:26','2014-09-16 16:53:54','Yuri-720-h264.mp4','Yuri-720-h264.mp4','mp4','<link rel=\'stylesheet\' type=\'text/css\' \n	 href=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video-js.min.css\' />\n\n<script type=\'text/javascript\' \n	 src=\'https://d2jdnwq9ajs5cn.cloudfront.net/video-js/video.js\'></script>\n\n<video id=\'video_54189552cd28f5.48891723.mp4\' class=\'video-js vjs-default-skin\'\n	 controls preload=\'auto\' width=\'720\' height=\'480\'\n	 data-setup=\'{ \"techOrder\": [\"flash\", \"html5\"] }\'>\n	 <source src=\"rtmp://s17z6bfw0vxwrz.cloudfront.net/cfx/st/&mp4:54189552cd28f5.48891723.mp4\"\n	 type=\'rtmp/mp4\' />\n	 <source src=\"https://d2jdnwq9ajs5cn.cloudfront.net/54189552cd28f5.48891723.mp4\"\n	 type=\"video/mp4\" />	 <p class=\'vjs-no-js\'>Para visualizar este vídeo por favor, \n	 habilite o Javascript e considere atualizar o seu navegador. \n	 <a href=\'http://videojs.com/html5-video-support/\' target=\'_blank\'>\n	 Verifique os navegadores que oferecen suporte ao HTML 5</a></p>\n</video>\n',0,1);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'videomanagerdb'
--

--
-- Dumping routines for database 'videomanagerdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-28 11:21:42
