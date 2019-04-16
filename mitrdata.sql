CREATE DATABASE IF NOT EXISTS `janrenovation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `janrenovation`;

CREATE TABLE IF NOT EXISTS `users`(
	`uid` int(11) NOT NULL AUTO_INCREMENT,
	`firstname` varchar(15) NOT NULL,
	`lastname` varchar(15) NOT NULL,
	`privilege` varchar(15) NOT NULL,
	`phone` varchar(10),
	`email` varchar(50) NOT NULL,
	`password` varchar(255) NOT NULL,
	`approved` tinyint(1),
	UNIQUE (`email`),
	PRIMARY KEY (`uid`)
);
CREATE TABLE IF NOT EXISTS `projects`(
	`pid` int(11) NOT NULL AUTO_INCREMENT,
	`address` varchar(15) NOT NULL,
	`borough` varchar(15) NOT NULL,
	`start` DATETIME,
	`end` DATETIME,
	PRIMARY KEY (`pid`)
);
CREATE TABLE IF NOT EXISTS `relations`(
	`uid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	`date` DATETIME,
	FOREIGN KEY (uid) REFERENCES users (uid),
	FOREIGN KEY (pid) REFERENCES projects (pid)
);
CREATE TABLE IF NOT EXISTS `timesheet`(
	`uid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	`starttime` DATETIME,
	`endtime` DATETIME,
	
	FOREIGN KEY (uid) REFERENCES users (uid),
	FOREIGN KEY (pid) REFERENCES projects (pid)
);
CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionID` varchar(1000) NOT NULL,
  `uid` int NOT NULL,
  `expiration` DATETIME,
  PRIMARY KEY (`sessionID`(191)),
	FOREIGN KEY (uid) REFERENCES users (uid)
);
INSERT INTO `users` VALUES
(1,'Bob','Marley','worker','1234567890','bob@marley.com','123','0'),
(2,'Joe','Smo','worker','1234567890','joe@smo.com','321','0'),
(3,'Jaryl','Ng','owner','1234567890','jaryl@ng.com','987','0'),
(4,'John','Doe','admin','1234567890','john@doe.com','423','0'),
(5,'Moe','Yas','admin','1234567890','moe@yas.com','324','0');
INSERT INTO `projects` VALUES
(1,'123 2nd street','Manhattan','2019-1-19','2018-1-20','1'),
(2,'244 Vermont St.','Bronx','2019-04-19','2019-05-03','1'),
(3,'520 Ketch Harbour Drive  ','Brooklyn','2019-05-22','2019-06-03','1'),
(4,'7472 Hill Court','Queens','2019-04-20','2019-05-20','1'),
(5,'987 Court Court','Staten Island','2019-08-19','2019-10-03','1');

INSERT INTO `relations` VALUES

(1,3,'2019-04-19'),
(1,2,'2019-1-19'),
(1,5,'2019-08-19'),
(1,4,'2019-05-22'),
(1,1,'2019-05-23'),
(1,1,'2019-05-20');
(2,2,'2019-04-19');

INSERT INTO `timesheet` VALUES
(1,2,'2019-1-19 12:00','2019-1-19 13:00'),
(2,2,'2019-04-19 12:00','2019-04-19 13:00'),
(2,3,'2019-05-22 12:00','2019-05-22 13:00'),
(2,4,'2019-05-20 12:00','2019-05-20 13:00'),
(1,5,'2019-08-19 12:00','2019-08-19 13:00');