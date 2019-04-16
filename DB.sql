CREATE DATABASE IF NOT EXISTS `janrenovation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `janrenovation`;

CREATE TABLE `projects` (
  `pid` int(11) NOT NULL,
  `address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borough` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `relations` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `sessionID` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` int(11) NOT NULL,
  `expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `timesheet` (
  `tsid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privilege` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `projects`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `address` (`address`);

ALTER TABLE `relations`
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionID`(191)),
  ADD KEY `uid` (`uid`);

ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`tsid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `projects`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `timesheet`
  MODIFY `tsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `relations`
  ADD CONSTRAINT `relations_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `relations_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `projects` (`pid`);

ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

ALTER TABLE `timesheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `timesheet_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `projects` (`pid`);
COMMIT;
