-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bookcrossing
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `bookid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `bookname` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `introduction` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `class` varchar(30) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bookid`),
  KEY `username` (`username`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (2,'user@user.com','钢铁是怎样炼成的','[苏] 尼·奥斯特洛夫斯基 ','本书的主人公保尔·柯察金饱尝了生活的苦难，炼就了革命精神和反抗性格。十月革命爆发后只有十六岁的他，就参加了红军，无论在战炮火中，还是在国民经济复时期，可察金都表现出大无畏精神，钢铁一般的意志，强烈的爱国主义和对人民的无限的无限忠诚。由于在战争中多次负伤以及劳累过度，他全身瘫痪，双目失明，被牢牢禁锢在床上，但他占胜了精神与肉体的打击，拿起笔来歌颂为建立苏维埃政权而奋斗的英雄。','预约中','小说','/bookcrossing/source/images/books/book2.jpg','2016-06-08 16:00:00'),(3,'user@user.com','三国演义','罗贯中','《三国演义》又名《三国志演义》、《三国志通俗演义》，是我国小说史上最著名最杰出的长篇章回体历史小说。 《三国演义》的作者是元末明初人罗贯中，由毛纶，毛宗岗父子批改。在其成书前，“三国故事”已经历了数百年的历史发展过程。在唐代，三国故事已广为流传，连儿童都很熟悉。随着市民文艺的发展，宋代的“说话”艺人，已有专门说三国故事的，当时称为“说三分”。元代出现的《三国志平话》，实际上是从说书人使用的本子，虽较简略粗糙，但已初肯《三国演义》的规模。罗贯中在群众传说和民间艺人创作的基础上，又依据陈寿《三国志》及裴松之注中所征引的资料（还包括《世说新语》及注中的资料），经过巨大的创作劳动，写在了规模宏伟的巨著——《三国志通俗演义》全书24卷，240回。后来经过毛纶，毛宗岗父子批改，形成我们现在所见的《三国演义》120回版','在架上','小说','/bookcrossing/source/images/books/book3.jpg','2016-06-09 13:06:48');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `bookid` int(10) NOT NULL,
  `content` varchar(500) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bookid` (`bookid`),
  KEY `username` (`username`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'user@user.com',2,'这本书很好看，很有想象力','2016-06-09 10:07:37'),(2,'user@user.com',2,'真好看啊！','2016-06-09 12:01:45'),(3,'user@user.com',2,'不错不错','2016-06-09 12:04:24'),(4,'user@user.com',2,'过年了，我把自己的书柜“整理”了一下，那乱七八糟的书啊，该保留的保留，该卖钱的卖钱。当把那些“陈芝麻，烂谷子”的小说翻出来的时候，一本封面破烂不堪的小说进入我的眼帘。那是前苏联作家尼·奥斯特洛夫斯基著的《钢铁是怎样炼成的》，我买这部小说时，只是个中学生；那时中央电视台电影频道推出了一个新节目叫《佳片有约》，头一期就播放了前苏联70年代的影片《钢铁是怎样炼成的》，影片结尾还有影评人点评。','2016-06-09 12:05:53'),(5,'user@user.com',2,'这本书究竟借给他几年了，我自己都不记得，在书橱边闲看无意间翻出来，发现已经卷了边、折了页脚，磨损而落尘，我一时气不过，便要拿回来，我对他说的是：“我要重温保尔和冬妮娅的爱情。” 也许你和我一样，从父母师长的叨念里熟知保尔的故事，能灵活得在舌尖蹦出“奥斯特洛夫斯基”这个名字，能一气呵成气壮山河得背诵出“人的生命只有一次”那段名言，却是从未完整得读过这本书。 我们离那个年代太过遥远，以至于苏联的暴风雪......','2016-06-09 12:06:06');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bookid` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `begintime` date DEFAULT NULL,
  `endtime` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookid` (`bookid`),
  KEY `username` (`username`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`bookid`),
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,2,'user@user.com','2016-05-04','2016-06-04','returned'),(2,2,'user@user.com','2016-06-09',NULL,'预约中'),(3,2,'user@user.com','2016-06-09',NULL,'预约中');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(30) NOT NULL,
  `credits` int(3) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin@admin.com','1111','西电','123456','admin',5),('user@user.com','1111','西安','1234128','user',5);
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

-- Dump completed on 2016-06-09 23:54:24
