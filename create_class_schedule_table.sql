-- Create class_schedule table
CREATE TABLE IF NOT EXISTS `class_schedule` (
  `scheduleID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trainerID` int(11) unsigned NOT NULL,
  `classID` int(11) unsigned NOT NULL,
  `schedule_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'scheduled',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`scheduleID`),
  KEY `trainerID` (`trainerID`),
  KEY `classID` (`classID`),
  CONSTRAINT `fk_schedule_trainer` FOREIGN KEY (`trainerID`) REFERENCES `trainer` (`TrainerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_schedule_class` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 