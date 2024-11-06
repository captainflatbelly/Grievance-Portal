CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `u_id` varchar(10) NOT NULL,
  PRIMARY KEY (`u_id`),
);

CREATE TABLE `staff` (
  `staff_id` varchar(10) NOT NULL,
  `staffname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `joining_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_id`)
);

CREATE TABLE `likes` (
  `u_id` varchar(10) NOT NULL,
  `C_Id` varchar(10) NOT NULL,
  `like` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`u_id`,`C_Id`),
  KEY `C_Id` (`C_Id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`C_Id`) REFERENCES `complaints` (`C_Id`)
);

CREATE TABLE `complaints` (
  `C_Id` varchar(10) NOT NULL,
  `Mob` varchar(20) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Priority` varchar(20) DEFAULT NULL,
  `Description` text,
  `Reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `staff` varchar(200) DEFAULT 'TBD',
  `status` enum('pending','resolved') DEFAULT 'pending',
  `u_id` varchar(10) DEFAULT NULL,
  `title` text,
  `type` enum('suggestion','complaint') DEFAULT NULL,
  `upvotes` int DEFAULT (0),
  PRIMARY KEY (`C_Id`),
  KEY `fk_complaints_users` (`u_id`),
  CONSTRAINT `fk_complaints_users` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`)
);

CREATE TABLE `activity` (
  `feedback` text,
  `ftime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `C_Id` varchar(10) DEFAULT NULL,
  `activity_number` int NOT NULL,
  `activity_id` varchar(10) NOT NULL,
  `feedback_from` varchar(10) DEFAULT NULL,
  KEY `C_Id` (`C_Id`),
  KEY `fk_feedback_from` (`feedback_from`),
  CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`C_Id`) REFERENCES `complaints` (`C_Id`),
  CONSTRAINT `fk_feedback_from` FOREIGN KEY (`feedback_from`) REFERENCES `staff` (`staff_id`)
);

