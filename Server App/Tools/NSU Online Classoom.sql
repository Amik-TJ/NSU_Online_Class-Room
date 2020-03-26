CREATE TABLE `studentData` (
	`nsuId` INT(11) NOT NULL,
	`personId` INT(10) NOT NULL,
	PRIMARY KEY (`nsuId`)
);

CREATE TABLE `facultyData` (
	`facultyID` INT(12) NOT NULL,
	`facultyInitial` varchar(10) NOT NULL,
	`personId` INT(255) NOT NULL,
	PRIMARY KEY (`facultyID`)
);

CREATE TABLE `class` (
	`courseId` varchar(20) NOT NULL,
	`classId` varchar(20) NOT NULL,
	`section` INT(3) NOT NULL,
	`time` TIME NOT NULL,
	`roomNo` varchar(20) NOT NULL,
	PRIMARY KEY (`classId`)
);

CREATE TABLE `examNotice` (
	`postId` INT(20) NOT NULL,
	`examTimeDate` TIMESTAMP(6) NOT NULL,
	`syllabus` TEXT(255) NOT NULL
);

CREATE TABLE `assignmentNotice` (
	`postId` INT(20) NOT NULL,
	`postText` TEXT(255) NOT NULL,
	`file` blob NOT NULL,
	`dueDate` TIMESTAMP(6) NOT NULL
);

CREATE TABLE `person` (
	`name` varchar(30) NOT NULL,
	`email` varchar(30) NOT NULL,
	`phoneNumber` INT(11) NOT NULL,
	`password` varchar(50) NOT NULL,
	`personId` INT(10) NOT NULL UNIQUE,
	PRIMARY KEY (`personId`)
);

CREATE TABLE `enrollStudent` (
	`classId` varchar(20) NOT NULL,
	`nsuId` INT(11) NOT NULL
);

CREATE TABLE `takeClass` (
	`classId` varchar(20) NOT NULL,
	`facultyId` INT(12) NOT NULL
);

CREATE TABLE `post` (
	`postId` INT(20) NOT NULL AUTO_INCREMENT,
	`classId` varchar(20) NOT NULL,
	`createdTime` TIMESTAMP(6) NOT NULL,
	`createdBy` INT(20) NOT NULL,
	`priority` INT(10) NOT NULL,
	`material` blob NOT NULL,
	`postText` TEXT(500) NOT NULL,
	PRIMARY KEY (`postId`)
);

CREATE TABLE `comments` (
	`postId` INT(20) NOT NULL,
	`commiterId` INT(20) NOT NULL,
	`comments` TEXT(500) NOT NULL
);

ALTER TABLE `studentData` ADD CONSTRAINT `studentData_fk0` FOREIGN KEY (`personId`) REFERENCES `person`(`personId`);

ALTER TABLE `facultyData` ADD CONSTRAINT `facultyData_fk0` FOREIGN KEY (`personId`) REFERENCES `person`(`personId`);

ALTER TABLE `examNotice` ADD CONSTRAINT `examNotice_fk0` FOREIGN KEY (`postId`) REFERENCES `post`(`postId`);

ALTER TABLE `assignmentNotice` ADD CONSTRAINT `assignmentNotice_fk0` FOREIGN KEY (`postId`) REFERENCES `post`(`postId`);

ALTER TABLE `enrollStudent` ADD CONSTRAINT `enrollStudent_fk0` FOREIGN KEY (`classId`) REFERENCES `class`(`classId`);

ALTER TABLE `enrollStudent` ADD CONSTRAINT `enrollStudent_fk1` FOREIGN KEY (`nsuId`) REFERENCES `studentData`(`nsuId`);

ALTER TABLE `takeClass` ADD CONSTRAINT `takeClass_fk0` FOREIGN KEY (`classId`) REFERENCES `class`(`classId`);

ALTER TABLE `takeClass` ADD CONSTRAINT `takeClass_fk1` FOREIGN KEY (`facultyId`) REFERENCES `facultyData`(`facultyID`);

ALTER TABLE `post` ADD CONSTRAINT `post_fk0` FOREIGN KEY (`classId`) REFERENCES `class`(`classId`);

ALTER TABLE `comments` ADD CONSTRAINT `comments_fk0` FOREIGN KEY (`postId`) REFERENCES `post`(`postId`);

