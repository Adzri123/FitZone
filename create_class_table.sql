-- Create class table
CREATE TABLE IF NOT EXISTS `class` (
  `classID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `trainerID` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`classID`),
  KEY `trainerID` (`trainerID`),
  CONSTRAINT `fk_class_trainer` FOREIGN KEY (`trainerID`) REFERENCES `trainer` (`TrainerID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 