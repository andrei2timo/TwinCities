-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: twincitiesdb
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

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
-- Table structure for table `catagories`
--

DROP TABLE IF EXISTS `catagories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catagories` (
  `catagory_id` int(3) NOT NULL AUTO_INCREMENT,
  `interest_catagory` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `place_id` int(3) NOT NULL,
  `interest_icon` varchar(96) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`catagory_id`),
  KEY `catagories` (`place_id`),
  CONSTRAINT `catagories` FOREIGN KEY (`place_id`) REFERENCES `place_interest` (`place_interest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catagories`
--

LOCK TABLES `catagories` WRITE;
/*!40000 ALTER TABLE `catagories` DISABLE KEYS */;
INSERT INTO `catagories` VALUES (1,'Sight',1,'map_icons/sight.png'),(2,'Cave',2,'map_icons/cave.png'),(3,'Museum',3,'map_icons/historical_museum.png'),(4,'Museum',4,'map_icons/historical_museum.png'),(5,'Beach',5,'map_icons/beach.png'),(6,'Train',6,'map_icons/train.png'),(7,'University',7,'map_icons/university.png'),(8,'Four Star hotel',8,'map_icons/hotel_4stars.png'),(9,'Theatre',9,'map_icons/theatre.png'),(10,'Zoo',10,'map_icons/zoo.png'),(11,'Market',11,'map_icons/market.png'),(12,'Museum',12,'map_icons/historical_museum.png'),(13,'Museum',13,'map_icons/historical_museum.png'),(14,'Statue',14,'map_icons/statue.png'),(15,'Statue',15,'map_icons/statue.png'),(16,'Sight',16,'map_icons/sight.png'),(17,'Cathedral',17,'map_icons/cathedral.png'),(18,'Cathedral',18,'map_icons/cathedral.png'),(19,'Art gallery',19,'map_icons/art_gallery.png'),(20,'Statue',20,'map_icons/statue.png');
/*!40000 ALTER TABLE `catagories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `name` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(24) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text NOT NULL,
  `population` int(12) DEFAULT NULL,
  `woeid` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`woeid`)
) ENGINE=InnoDB AUTO_INCREMENT=656973 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES ('Torbay','uk','50.4523','-3.5568','A picturesque seaside town full of tourist attractions',136051,3991,'Pound Sterling'),('Hamelin','de','52.105121','9.371729','A town best known for the Grimm Brothers\'s Pied Piper of hamelin',57342,656972,'Euro');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `photo_id` int(8) NOT NULL AUTO_INCREMENT,
  `place_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_photo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `city_id` (`city_id`),
  KEY `place_id` (`place_id`),
  CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`woeid`),
  CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place_interest` (`place_interest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'Babbacombe Model Village','../TwinCities/images/Tmodelvillage-large.jpg',3991,1),(2,'Kents Cavern','../TwinCities/images/Tkent-large.jpeg',3991,2),(3,'Torre Abbey Museum','../TwinCities/images/TtoreeAbbey-large.jpg',3991,3),(4,'Cockington Court','../TwinCities/images/Tcockington-largejpg.jpg',3991,4),(5,'Oddicombe Beach','../TwinCities/images/Toddicombe-large.jpg',3991,5),(6,'Babbacombe Cliff Railway','../TwinCities/images/Tbabbcombe-large.jpg',3991,6),(7,'South Devon University','../TwinCities/images/Tuni-large.jpg',3991,7),(8,'The Imperial Hotel','../TwinCities/images/Timperial-large.jpeg',3991,8),(9,'Princess Theatre','../TwinCities/images/ttheartre-large.jpg',3991,9),(10,'Paignton Zoo','../TwinCities/images/Tzoo-large.jpg',3991,10),(11,'Hamelin Old Town','../TwinCities/images/HOldTown.png',656972,11),(12,'Museum Hameln','../TwinCities/images/Hmuseum1.png',656972,12),(13,'Hochzeitshaus Hameln','../TwinCities/images/Hhochzeitshaus1.png',656972,13),(14,'Pied Piper Statue','../TwinCities/images/HpiedPiper.png',656972,14),(15,'Rattenfanger Figuren- und Glockenspiel','../TwinCities/images/HRattenfanger.png',656972,15),(16,' Hameln Marketing und Tourismus GmbH','../TwinCities/images/HMarket.png',656972,16),(17,'St. Bonifatius','../TwinCities/images/HChurch1.png',656972,17),(18,'Marktkirche Sankt Nicolai','../TwinCities/images/HMarktkirsche.png',656972,18),(19,'Schauglasblaserei im Pulverturm','../TwinCities/images/Hglass.png',656972,19),(20,'Rattenfanger-Brunnen','../TwinCities/images/Hstatue.png',656972,20);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place_interest`
--

DROP TABLE IF EXISTS `place_interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place_interest` (
  `place_interest_id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(48) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double DEFAULT NULL,
  `short_description` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `full_description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_woeid` int(12) DEFAULT NULL,
  PRIMARY KEY (`place_interest_id`),
  KEY `city_woeid` (`city_woeid`),
  CONSTRAINT `place_interest_ibfk_1` FOREIGN KEY (`city_woeid`) REFERENCES `city` (`woeid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place_interest`
--

LOCK TABLES `place_interest` WRITE;
/*!40000 ALTER TABLE `place_interest` DISABLE KEYS */;
INSERT INTO `place_interest` VALUES (1,'Babbacombe Model Village',50.482466,-3.520361,'A 57-year-old model village','A 57 year old miniature village with over 400 individual models, with architecture ranging from Medieval to Victorian. This miniature marvel is encased by Babbacombe\'s award winning gardens, spanning 4.5 acres. ',3991),(2,'Kents Cavern',50.46786,-3.504109,'A prehistoric cave system.','A labyrinth once occupied first by Neanderthals and some of the very first British populace. The caves are part of the English Riviera UNESCO Global Geopark and is known as one of Britain\'s oldest known prehistoric sites. Within the cave system, visitors can view prehistoric fossils and cave formations.',3991),(3,'Torre Abbey Museum',50.4627101,-3.5411543,'A 450 acre country park.','Torbay\'s most historic building dating back to 1196, encased within garden and parkland spanning across 18 acres. The historic building also hosts a multi-award wining art collection with over 600 works of art from the 18th century to the present day.',3991),(4,'Cockington Court',50.463301,-3.559394,'Centuries-old country estate.','A quaint 450 acre country park with scenic garden landscapes, parkland and woodland. Within the vast countryside landscape resides a historic country manor house governed by the Torbay Coast and Countryside Trust.',3991),(5,'Oddicombe Beach',50.478308,-3.513335,'A popular beach on the english riviera.','A stunning beach part of the English Riviera UNESCO Global Geopark, that offers fun for all the family. The beach not only offers great views, but also offers watersports, beach shops and a cafe.',3991),(6,'Babbacombe Cliff Railway',50.480489,-3.517774,'A cliff lift to Oddicombe beach.','A 720 foot long cliff railway that links babbacombe Downs to oddicombe beach. The cliff railway is run by a community interest company, and gives rides to nearly 100,000 people per year.',3991),(7,'South Devon University',50.414646,-3.587847,'A TEF gold rated university.','A TEF gold rated university that offers a wide range of programmes of study, varying from the sciences to art. The university also has relations with the University of Plymouth, in partnership they provide higher education programmes.',3991),(8,'The Imperial Hotel',50.457237,-3.521495,'A 19th century Victorian hotel and restaurant.','A 19th century Victorian hotel and restaurant overlooking Torquay and and the stunning south Devon coastline. The imperial hotel also offers a wide variety of activities, spanning from a spa to outdoor tennis courts.',3991),(9,'Princess Theatre',50.461342,-3.530137,'A 1,500 seat theatre.','South Devon\'s largest theatre with 1,500 seats, that have hosted artists like the Beatles and comedians like Dawn French. The theatre also hosts operas, musicals, pantomimes; concerts and comedy shows. ',3991),(10,'Paignton Zoo',50.428819,-3.584027,'A zoo with over 2000 animals.','A zoo apart of the South West Environmental Parks and is owned by the Wild Planet Trust . The zoo offers over 2000 animals spread over 80 acres. The zoo also offers a wide variety of activities other than observing the animals, such as a jungle themed railway, a nature trail and play areas.',3991),(11,'Hamelin Old Town',52.10387380692055,9.356402610399527,'A fairytale esque street with a connection to the Pied Piper.','A fairy tale esque street with a connection to the Pied Piper of Hamelin, a story written by the Brothers Grimm. The old town is bustling with street cafes, restaurants and beer gardens. One of its most famous summer attractions is the re-enactment on the Pied Piper of Hamelin.',656972),(12,'Museum Hameln',52.10464517975422,9.358433263980148,'A museum showcasing the history of the Pied Piper.','A museum with over 1300 artefacts showcasing the history and culture of Hamelin and the Weser Uplands, but with the Pied Piper of Hamelin as its focal point.',656972),(13,'Hochzeitshaus Hameln',52.10466254938741,9.357097699562301,'A historic building with a famous clock.','A historical house that features a unique clockwork that at the hours of 1.05pm, 3.35pm, and 5.35pm, shows the tale of the Pied Piper of Hamelin.',656972),(14,'Pied Piper Statue',52.10460794942375,9.35947459956232,'A statue of the infamous Pied Piper.','There are many different Pied Piper statues all across the city of Hamelin, but this one is one of the most noteworthy because it can be found next to the Town Hall.',656972),(15,'Rattenfanger Figuren- und Glockenspiel',52.10055874283853,9.391925600000002,'A clockwork of the Pied Piper.','This is a clockwork representation of the tale of the Pied Piper of Hamelin and is part of the Pied Piper of Hamelin tour Rattenfanger Figuren- und Glockenspiel.',656972),(16,'Hameln Marketing und Tourismus GmbH',52.10473401895087,9.361982969625386,'The start of the Pied Piper of Hamelin Tour.','The Hamelin information centre which offers a range of tours, with the most noteworthy being the Pied Piper of Hamelin tour. The information centre is also host to the Hamelin gift shop, and there are regular viewing of an award wining film about the Pied Piper\'s journey.',656972),(17,'St. Bonifatius',52.10171225067989,9.354196938940069,'A 13th Century Gothic Church.','A 13th century gothic church dedicated to a German apostle. The church\'s most notable features are the stain glass windows and the bell tower that can be seen in the city centre of Hamelin.',656972),(18,'Marktkirche Sankt Nicolai',52.10500478820929,9.356951811954065,'A church that lies in the centre of hamelin.','A church that lies in the centre of Hamelin. At different points during the year, the church hosts music concerts. The church also offers climbing tours to the top of the bell tower, which offers stunning views of Hamelin.',656972),(19,'Schauglasblaserei im Pulverturm',52.10671493803937,9.3565059272967,'A glass blowing museum.','A glass museum and workshop, where visitors can go on guided tours of glass works of art. Visitors can also participate in glass blowing workshops, where visitors can learn and create glass works of art. ',656972),(20,'Rattenfanger-Brunnen',52.10630539010728,9.360988383118439,'A statue of the Pied Piper of Hamelin.','A Pied Piper statue in the middle of a fountain within the market square.',656972);
/*!40000 ALTER TABLE `place_interest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweet`
--

DROP TABLE IF EXISTS `tweet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweet` (
  `tweet_id` int(8) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tweet_text` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `screen_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city_woeid` int(12) DEFAULT NULL,
  PRIMARY KEY (`tweet_id`),
  UNIQUE KEY `tweet_text` (`tweet_text`) USING HASH,
  KEY `city_woeid` (`city_woeid`),
  CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`city_woeid`) REFERENCES `city` (`woeid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweet`
--

LOCK TABLES `tweet` WRITE;
/*!40000 ALTER TABLE `tweet` DISABLE KEYS */;
INSERT INTO `tweet` VALUES (1,'Mar 21 00:12 AM','@Barnacules Nope mines on, I presume by default..','Alan Lloyd Photography','Alan_Torbay',3991),(2,'Mar 20 23:46 PM','Just looking at paint on @LoveWilko website.. Nearly everything is out of stock..\r\n\r\nAmazing, you would think they wo https://t.co/fmI3ScTowY','Alan Lloyd Photography','Alan_Torbay',3991),(3,'Mar 20 23:38 PM','Just posted a photo @ Torbay https://t.co/k3e4PqayQX','DJ Mandz ?????????????????????','DJMandz21',3991),(4,'Mar 20 23:37 PM','Let me capture your special day.\r\n\r\nWedding photography across Devon and beyond. \r\n\r\nOnly 100 deposit to secure your 2 https://t.co/RQbwtltIJB','SHOT BY ROB','shotbyrob',3991),(5,'Mar 20 23:36 PM','Just posted a photo @ Torbay https://t.co/Rr3CVZywkH','DJ Mandz ?????????????????????','DJMandz21',3991),(6,'Mar 20 23:36 PM','Just posted a photo @ Torbay https://t.co/yyjzyg1sP6','DJ Mandz ?????????????????????','DJMandz21',3991),(7,'Mar 20 23:04 PM','RT @celebrity_pony: The best therapy is being at peace with nature #therapy #beautiful #kindness #love @thismorning @BBCSpotlight @shetland','Belinda Bawden','Belinda_Bawden',3991),(8,'Mar 20 22:57 PM','RT @torbaynl: Register for our FREE Virtual Art Class with Brush Strokes with Lesley, March 28, 2-3:30PM. You\'ll need canvas/paper, a flat','Brenda Cobb','Brendac37Cobb',3991),(9,'Mar 20 22:46 PM','Helicopter overhead, following the coastline, going back and forth.\n Never a good sign. ????\n#Babbacombe\n#Torbay','peter brown','peterrichardbro',3991),(10,'Mar 20 22:30 PM','SAVE THE DATE! SATURDAY 31st JULY 2021\r\n\r\nCelebrate freedom and help raise funds for Torbay Hospital League of Friend https://t.co/KKnDG9f6f6','The Unmasked Ball','theunmaskedball',3991),(11,'Mar 21 00:03 AM','RT @casadarei2: O Prefeito de Sorocaba tem q tratar as viitimas da Covid.\r\nE nao tratar vermes,piolhos e sarna.\r\nMuito menos lupus!\r\nOutro insa','Edvaldo','Edvaldo71383333',656972),(12,'Mar 21 00:01 AM','RT @FuturEconomy: ???? We\'re proud to be launching this new Series on Canada\'s #biomanufacturing and #bioengineering innovation ecosystem with','TheFutureEconomy.ca','FuturEconomy',656972),(13,'Mar 20 23:58 PM','Pierre: What did we just do\r\nHamelin: What did you do?\r\nPierre: We won the fucking race! Yes! Oh My God Yess! Wooooo https://t.co/bx7N6MVkIl','⇞MN⇟ #Oleout','Muokiiii',656972),(14,'Mar 20 23:45 PM','@GerardFrancs @MartaB_C @XavierFina Tu grado de comprension lo tienes a nivel cero. Yo no me comparo al activista f https://t.co/AtaVgNslrS','Angel Perez','aoset15',656972),(15,'Mar 20 23:41 PM','RT @Lesleygsmith3: @terryhowson @knightmaker1979 @nacpherson @ianbhood @wmcgregor1 It goes on and on and on - a conglomeration of mediocre,','??????????????????????????????','toddy19',656972),(16,'Mar 20 23:23 PM','@terryhowson @knightmaker1979 @nacpherson @ianbhood @wmcgregor1 It goes on and on and on - a conglomeration of medi https://t.co/qFdgUMMbg8','OOR LESLEY Cybernat????','Lesleygsmith3',656972),(17,'Mar 20 23:20 PM','RT @eliesaaabs: Marcus Baker https://t.co/xvlJFJyV5w','riana','riana_hamelin',656972),(18,'Mar 20 23:19 PM','@hame_hamelin gemelas????♥️','cris ◕ ‿ ◕','crisvlzg',656972);
/*!40000 ALTER TABLE `tweet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-23 17:40:45
