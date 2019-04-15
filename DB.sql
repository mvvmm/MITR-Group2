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
	`start` DATE,
	`end` DATE,
	PRIMARY KEY (`pid`)
);
CREATE TABLE IF NOT EXISTS `relations`(
	`uid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	`date` DATE,
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
CREATE TABLE IF NOT EXISTS `timesheet`(
	`uid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	`starttime` DATETIME,
	`endtime` DATETIME,
	FOREIGN KEY (uid) REFERENCES users (uid),
	FOREIGN KEY (pid) REFERENCES projects (pid)
);