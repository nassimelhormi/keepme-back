# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.5-10.2.14-MariaDB)
# Base de données: keepme
# Temps de génération: 2018-11-16 08:57:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table children
# ------------------------------------------------------------

DROP TABLE IF EXISTS `children`;

CREATE TABLE `children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `birthdate` datetime NOT NULL,
  `description` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_children_user1_idx` (`user_id`),
  CONSTRAINT `fk_children_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `children` WRITE;
/*!40000 ALTER TABLE `children` DISABLE KEYS */;

INSERT INTO `children` (`id`, `firstname`, `birthdate`, `description`, `user_id`)
VALUES
	(1,'lilou','1996-03-06 00:00:00','Apportez des couches !',1),
	(2,'Louis','2000-01-01 00:00:00','Enfant pertubé mentalement',1);

/*!40000 ALTER TABLE `children` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `uptated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`post_id`,`user_id`),
  KEY `fk_comment_post1_idx` (`post_id`),
  KEY `fk_comment_user1_idx` (`user_id`),
  CONSTRAINT `fk_comment_post1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Affichage de la table nurse
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nurse`;

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birthdate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_valid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_nurse_user1_idx` (`user_id`),
  CONSTRAINT `fk_nurse_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `nurse` WRITE;
/*!40000 ALTER TABLE `nurse` DISABLE KEYS */;

INSERT INTO `nurse` (`id`, `birthdate`, `user_id`, `is_valid`)
VALUES
	(1,'1996-03-06 00:00:00',10,1),
	(2,'2000-01-01 00:00:00',2,0),
	(2,'1996-03-06 00:00:00',10,0),
	(99,'1996-03-06 00:00:00',10,0),
	(100,'1996-03-06 00:00:00',10,0);

/*!40000 ALTER TABLE `nurse` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table post
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `nb_children` int(11) NOT NULL,
  `hourly_rate` double NOT NULL,
  `note` varchar(45) DEFAULT NULL,
  `nurse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_post_user_idx` (`user_id`),
  KEY `nurse_id` (`nurse_id`),
  CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`nurse_id`) REFERENCES `nurse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;

INSERT INTO `post` (`id`, `description`, `user_id`, `longitude`, `latitude`, `title`, `date_start`, `date_end`, `nb_children`, `hourly_rate`, `note`, `nurse_id`)
VALUES
	(1,'bonjour c\'est la description',1,2.3,2.5,'bonjour c\'est le titre','2000-01-01 00:00:00','2000-01-01 00:00:00',2,2,NULL,NULL),
	(2,'ladescription frero',2,2.2,4.55555,'le titre frero','2000-01-01 00:00:00','2000-01-01 00:00:00',2,9,NULL,NULL),
	(3,'ma desc',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,9,NULL,NULL),
	(4,'ma desc',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,9,NULL,NULL),
	(5,'ma desc',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,9,NULL,NULL),
	(6,'ma desc',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,9,NULL,NULL),
	(7,'ma desc',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,9,NULL,NULL),
	(8,'ma description',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,9,NULL,NULL),
	(9,'ma description',1,2.542867,48.960226,'Mon titre',NULL,NULL,1,5,NULL,NULL),
	(10,'sdffsdfdsd',1,2.542867,48.960226,'dfds',NULL,NULL,10,10,NULL,NULL),
	(11,'Hé ouais biloute!',10,2.2,4.55555,'leu tifeutrefeu','2000-01-01 00:00:00','2000-01-01 00:00:00',2,9,NULL,1);

/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `longitude`, `latitude`)
VALUES
	(1,'ayad_y@etna-alternance.net','ayad_y','Yanis','AYAD',2.5333,48.9667),
	(2,'elhorm_n@etna-alternance.net','elhorm_n','Nassim','EL HORMI',2.5333,48.9667),
	(9,'dezeeu_@etna-alternance.net','dezeeu_l','Louis','DEZEEU',2.5333,48.9667),
	(10,'benito_a@etna-alternance.net','fc4a3b2c13b26a6be6cc7a4a1545c6d8ed9510ae','Anthony','BENITO',2.5333,48.9667);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
