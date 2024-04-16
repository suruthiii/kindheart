-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 12:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kindheart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`) VALUES
(9, 'Admin 2'),
(11, 'Admin 3'),
(12, 'Admin 5'),
(14, 'Admin 1'),
(15, 'Admin 6'),
(16, 'Admin 7'),
(18, 'Admin 8'),
(19, 'Admin 9');

-- --------------------------------------------------------

--
-- Table structure for table `benefaction`
--

CREATE TABLE `benefaction` (
  `benefactionID` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `itemName` varchar(255) DEFAULT NULL,
  `itemCategory` varchar(255) DEFAULT NULL,
  `itemQuantity` int(11) DEFAULT NULL,
  `receivedQuantity` int(11) NOT NULL DEFAULT 0,
  `itemPhoto1` varchar(255) DEFAULT NULL,
  `itemPhoto2` varchar(255) DEFAULT NULL,
  `itemPhoto3` varchar(255) DEFAULT NULL,
  `itemPhoto4` varchar(255) DEFAULT NULL,
  `donorID` int(11) DEFAULT NULL,
  `postedDate` datetime DEFAULT NULL,
  `availabilityStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `benefaction`
--

INSERT INTO `benefaction` (`benefactionID`, `description`, `itemName`, `itemCategory`, `itemQuantity`, `receivedQuantity`, `itemPhoto1`, `itemPhoto2`, `itemPhoto3`, `itemPhoto4`, `donorID`, `postedDate`, `availabilityStatus`) VALUES
(6, 'kojsef', 'joef', 'sefe', 4, 0, 'cart.png', NULL, NULL, NULL, 20, '2024-04-01 13:44:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `postType` varchar(255) NOT NULL,
  `adminID` int(11) DEFAULT NULL,
  `time` datetime NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `regNumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `companyName`, `regNumber`) VALUES
(5, 'Daraz', '1223132123');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaintID` int(11) NOT NULL,
  `complaineeID` int(11) NOT NULL,
  `complainerID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `handlingStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaintID`, `complaineeID`, `complainerID`, `adminID`, `description`, `handlingStatus`) VALUES
(1, 5, 3, 0, 'ergegeergegrer', 0),
(2, 4, 20, 11, 'weferferfergfer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donationID` int(11) NOT NULL,
  `necessityType` varchar(255) DEFAULT NULL,
  `necessityID` int(11) DEFAULT NULL,
  `donorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donee`
--

CREATE TABLE `donee` (
  `doneeID` int(11) NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL,
  `doneeType` varchar(255) DEFAULT NULL,
  `branchName` varchar(255) DEFAULT NULL,
  `bankName` varchar(255) DEFAULT NULL,
  `accNumber` int(11) DEFAULT NULL,
  `accountHoldersName` varchar(255) DEFAULT NULL,
  `letterImage` text DEFAULT 'default-image.jpg',
  `address` text DEFAULT NULL,
  `adminID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donee`
--

INSERT INTO `donee` (`doneeID`, `phoneNumber`, `doneeType`, `branchName`, `bankName`, `accNumber`, `accountHoldersName`, `letterImage`, `address`, `adminID`) VALUES
(3, 123456789, 'student', 'Galle', 'HNB', 2147487, 'Ray Holt', 'default-image.jpg', 'QQ Road', 0),
(4, 123456788, 'organization', 'Bali', 'HNB', 765656, 'Mary Rose', 'default-image.jpg', 'Q Road', 0),
(17, 123456778, 'organization', 'Rio', 'HNB', 7656597, 'Edward Clark', 'default-image.jpg', 'X Road', 12),
(22, 1234456711, 'student', 'Wales', 'Seylan', 2147482, 'May Parker', 'default-image.jpg', 'OP Road', 11);

-- --------------------------------------------------------

--
-- Table structure for table `donee_benefaction`
--

CREATE TABLE `donee_benefaction` (
  `benefactionID` int(11) NOT NULL,
  `doneeID` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `requestedQuantity` double DEFAULT NULL,
  `receivedQuantity` int(11) DEFAULT 0,
  `verificationStatus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donee_benefaction`
--

INSERT INTO `donee_benefaction` (`benefactionID`, `doneeID`, `reason`, `requestedQuantity`, `receivedQuantity`, `verificationStatus`) VALUES
(6, 3, 'jolljljdsfsd', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donorID` int(11) NOT NULL,
  `donorType` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phoneNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`donorID`, `donorType`, `address`, `phoneNumber`) VALUES
(5, 'company', 'QQQQ Road', 1234456789),
(20, 'individual', 'WW Road', 1234656789),
(21, 'individual', 'HHH Road', 1234456788);

-- --------------------------------------------------------

--
-- Table structure for table `fund`
--

CREATE TABLE `fund` (
  `fundID` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `projectID` int(11) DEFAULT NULL,
  `donorID` int(11) DEFAULT NULL,
  `paymentSlip` text DEFAULT NULL,
  `verificationStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gooddonation`
--

CREATE TABLE `gooddonation` (
  `goodDonationID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `individual`
--

CREATE TABLE `individual` (
  `individualID` int(11) NOT NULL,
  `nicNo` varchar(255) DEFAULT NULL,
  `fName` varchar(255) DEFAULT NULL,
  `lName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `individual`
--

INSERT INTO `individual` (`individualID`, `nicNo`, `fName`, `lName`, `gender`) VALUES
(20, '231231231', 'Henry ', 'Clark', 'Male'),
(21, '1231312313', 'Zack', 'Martin', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `milestone`
--

CREATE TABLE `milestone` (
  `milestoneID` int(11) NOT NULL,
  `milestoneName` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `img1` text DEFAULT NULL,
  `img2` text DEFAULT NULL,
  `img3` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monetarydonation`
--

CREATE TABLE `monetarydonation` (
  `monetaryDonationID` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `paymentSlip` text DEFAULT NULL,
  `verificationStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `monetaryNecessityID` int(11) NOT NULL,
  `requestedAmount` double DEFAULT NULL,
  `receivedAmount` double DEFAULT 0,
  `monetaryNecessityType` varchar(255) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`monetaryNecessityID`, `requestedAmount`, `receivedAmount`, `monetaryNecessityType`, `startDate`, `endDate`, `frequency`) VALUES
(3, 50, 0, 'onetime', NULL, NULL, NULL),
(4, 34342, 0, 'onetime', NULL, NULL, NULL),
(5, 45646464, 0, 'onetime', NULL, NULL, NULL),
(6, 34533, 0, 'recurring', '2024-04-07 00:00:00', '2024-04-08 00:00:00', NULL),
(7, 45334, 0, 'onetime', NULL, NULL, NULL),
(8, 49405, 0, 'recurring', '2024-04-07 00:00:00', '2024-04-08 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `necessity`
--

CREATE TABLE `necessity` (
  `necessityID` int(11) NOT NULL,
  `necessityName` varchar(255) DEFAULT NULL,
  `necessityType` varchar(255) DEFAULT NULL,
  `fulfillmentStatus` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `doneeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `necessity`
--

INSERT INTO `necessity` (`necessityID`, `necessityName`, `necessityType`, `fulfillmentStatus`, `description`, `doneeID`) VALUES
(3, 'Class Fees', 'Monetary Funding', 0, 'Thgwihfwefwef', 4),
(4, 'Blahhhh', 'Monetary Funding', 0, 'jdojwjwijd', 4),
(5, 'lmflme', 'Monetary Funding', 1, 'fk;;er', 4),
(6, 'RRRRRR', 'Monetary Funding', 3, 'pkkksdocs', 4),
(7, 'new', 'Monetary Funding', 1, 'wewkwo', 4),
(8, 'ioowiw', 'Monetary Funding', 3, 'lefelf', 4),
(9, 'jojijo57676', 'Physical Goods', 0, 'jhkjijuygg', 4),
(10, 'kmrlhrt', 'Physical Goods', 0, 'thoktht', 4),
(11, 'peprker', 'Physical Goods', 1, '.lkyhtyhmthy', 4),
(14, 'ygiui', 'Physical Goods', 1, 'ihuij', 4);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `orgID` int(11) NOT NULL,
  `orgNumber` varchar(255) DEFAULT NULL,
  `orgName` varchar(255) DEFAULT NULL,
  `orgType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`orgID`, `orgNumber`, `orgName`, `orgType`) VALUES
(4, '4354354', 'ABC College', 'School'),
(17, '4354374', 'UCSC', 'University');

-- --------------------------------------------------------

--
-- Table structure for table `physicalgood`
--

CREATE TABLE `physicalgood` (
  `goodNecessityID` int(11) NOT NULL,
  `itemCategory` varchar(255) DEFAULT NULL,
  `requestedQuantity` int(11) DEFAULT NULL,
  `receivedQuantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `physicalgood`
--

INSERT INTO `physicalgood` (`goodNecessityID`, `itemCategory`, `requestedQuantity`, `receivedQuantity`) VALUES
(9, NULL, 8787687, 0),
(10, NULL, 345345, 0),
(11, NULL, 56065, 0),
(14, NULL, 665, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `receivedAmount` double DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `orgID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectID`, `title`, `budget`, `receivedAmount`, `status`, `description`, `orgID`) VALUES
(1, 'kodfef', 7675765, 0, 0, 'kjeowiewe', 4),
(2, 'kmlklk', 2309, 0, 1, 'lkregkergegr', 4),
(3, 'k;okefef', 42232, 0, 3, 'oiktkrtirt', 17);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `scholarshipID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `totalNoOfStudents` int(11) DEFAULT NULL,
  `selectedNoOfStudents` int(11) DEFAULT 0,
  `donorID` int(11) DEFAULT NULL,
  `postedDate` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `availabilityStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`scholarshipID`, `title`, `amount`, `startDate`, `duration`, `description`, `totalNoOfStudents`, `selectedNoOfStudents`, `donorID`, `postedDate`, `deadline`, `availabilityStatus`) VALUES
(1, 'rgergerg', 242342, NULL, 6, 'tmhklthr', 5, 0, 20, '2024-04-02 00:00:00', '2024-04-18 01:37:58', 0),
(2, 'k;lkwsdwd', 23886, NULL, 7, 'yh6h66y', 8, 0, 5, '2024-03-02 10:40:26', '2024-04-19 01:38:09', 1),
(3, 'klmlkm', 234242, NULL, 9, 'lkerefer', 1, 0, 21, '2024-04-01 10:41:19', '2024-04-21 01:38:16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_request`
--

CREATE TABLE `scholarship_request` (
  `scholarshipID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `fName` varchar(255) DEFAULT NULL,
  `lName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `nicNumber` text DEFAULT 'Not Applicable',
  `institutionName` varchar(255) DEFAULT NULL,
  `studentType` varchar(255) DEFAULT NULL,
  `caregiverName` varchar(255) DEFAULT NULL,
  `caregiverType` varchar(255) DEFAULT NULL,
  `caregiverRelationship` varchar(255) DEFAULT NULL,
  `caregiverOccupation` varchar(255) DEFAULT NULL,
  `nicFrontImage` text DEFAULT 'default-image.jpg',
  `nicBackImage` text DEFAULT 'default-image.jpg',
  `gsCertificateImage` text DEFAULT 'default-image.jpg',
  `receivingScholarships` text DEFAULT 'None',
  `studyingYear` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `fName`, `lName`, `gender`, `dateOfBirth`, `nicNumber`, `institutionName`, `studentType`, `caregiverName`, `caregiverType`, `caregiverRelationship`, `caregiverOccupation`, `nicFrontImage`, `nicBackImage`, `gsCertificateImage`, `receivingScholarships`, `studyingYear`) VALUES
(3, 'Marie', 'Holt', 'Female', '2010-04-02', 'Not Applicable', 'ABC Vidyalaya', 'School Student', 'Ray Holt', 'Parent', 'Father', 'Farmer', 'default-image.jpg', 'default-image.jpg', 'default-image.jpg', 'None', '8'),
(22, 'Carrie', 'Parker', 'Female', '2012-11-16', 'Not Applicable', 'Stanford College', 'School Student', 'May Parker', 'Guardian', 'Aunt', 'Clerk', 'default-image.jpg', 'default-image.jpg', 'default-image.jpg', 'None', '7');

-- --------------------------------------------------------

--
-- Table structure for table `student_scholarship`
--

CREATE TABLE `student_scholarship` (
  `scholarshipID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `updatedMonth` varchar(255) DEFAULT NULL,
  `paymentSlip` text DEFAULT NULL,
  `slipCount` int(11) DEFAULT 0,
  `verificationStatus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `successstory`
--

CREATE TABLE `successstory` (
  `storyID` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `doneeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `successstory`
--

INSERT INTO `successstory` (`storyID`, `image`, `title`, `description`, `doneeID`) VALUES
(22, 'IMG-65df3e11e5ee04.21230510.jpg', 'MMMM', 'hefhefhefhkefheff', 3),
(24, 'IMG-66128ea140e6e0.15655853.jpg', 'kwoefwf', 'wfwefwew', 3),
(25, 'IMG-66128f1bd8f3e8.68772432.jpg', 'erferer', 'reertertreter', 3),
(26, 'IMG-6612c04d7a2051.25807524.jpg', 'dferferferfer', 'rfergerfkfrkee', 3),
(27, 'IMG-6612c84b8c8258.56851920.png', 'kolkk', 'ojdfseje', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `userType` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `banCount` int(11) DEFAULT NULL,
  `bannedTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `email`, `password`, `userType`, `status`, `banCount`, `bannedTime`) VALUES
(2, 'superadmin1', 'superadmin1@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'superAdmin', 1, 0, NULL),
(3, 'student1', 'student1@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'student', 1, 2, '2024-04-11 08:52:36'),
(4, 'organization1', 'organization1@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'organization', 1, 1, '2024-04-11 08:57:25'),
(5, 'donor1', 'donor1@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'donor', 1, 1, '2024-04-11 09:02:14'),
(9, 'admin2', 'admin2@gmail.com', '$2y$10$o4n7048/Z1EKrJM8JFV5.uf5wrJAHeQISFY/SmrxVLdmUm6Y4OC7u', 'admin', 5, 1, '2024-02-18 16:28:29'),
(11, 'admin3', 'admin3@gmail.com', '$2y$10$RV9gckoGFbw6P.7cV6e8J.mhsSzEXdOUzPv8LG/etOi5EzpNiHbfa', 'admin', 1, 0, NULL),
(12, 'admin5', 'admin4@gmail.com', '$2y$10$gxhm5jCDRGylUfIP3WAMtObytbsfvE/iEi561f6b837c8ejSse97e', 'admin', 1, 0, NULL),
(14, 'admin1', 'admin1@gmail.com', '$2y$10$NDBA83fT7NDrSyc70TaYN.Qiefllz6lm8RuIUr9MU.PvOZeN/Oa5a', 'admin', 5, 3, '2024-02-24 09:02:26'),
(15, 'admin6', 'admin6@gmail.com', '$2y$10$2vWorTuABajS.RKATPunpuY3sXgTaNO.fbMFT2Flqo4PemTRI08Mu', 'admin', 5, 1, '2024-02-18 16:54:39'),
(16, 'admin7', 'admin7@gmail.com', '$2y$10$BoowoWIjlEh4o0kN8o.xzeFxGcoFGOExuqbXXYsF9UrruPIusdSYi', 'admin', 5, 1, '2024-02-27 11:44:01'),
(17, 'organization2', 'organization2@gmail.com', '$2y$10$BoowoWIjlEh4o0kN8o.xzeFxGcoFGOExuqbXXYsF9UrruPIusdSYi', 'organization', 0, 0, NULL),
(18, 'admin8', 'admin8@gmail.com', '$2y$10$ER9YLntmDHA6H9aE3gcN1.l1J8A0/S2eISS7lLwX2K2sb736fwL72', 'admin', 1, 0, NULL),
(19, 'admin9', 'admin9@gmail.com', '$2y$10$QbXgQdHVHtf7GOHPTYkMC.HzpBD.PeCuJI1SucRK56QSWO4MmEIki', 'admin', 5, 1, '2024-02-27 11:59:46'),
(20, 'donor2', 'donor2@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'donor', 1, 1, '2024-04-11 09:05:47'),
(21, 'donor3', 'donor3@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'donor', 1, 1, '2024-04-06 10:04:27'),
(22, 'student2', 'student2@gmail.com', '$2y$10$fTkuk.U0aZhVpCbrgT6MOey3niJTNXYX08iYAvfaOhVfcDufo.oou', 'student', 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `benefaction`
--
ALTER TABLE `benefaction`
  ADD PRIMARY KEY (`benefactionID`),
  ADD KEY `benefaction_ibfk_1` (`donorID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `Admin_Update_Deletion` (`adminID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaintID`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donationID`),
  ADD KEY `donation_ibfk_1` (`necessityID`),
  ADD KEY `donation_ibfk_2` (`donorID`);

--
-- Indexes for table `donee`
--
ALTER TABLE `donee`
  ADD PRIMARY KEY (`doneeID`);

--
-- Indexes for table `donee_benefaction`
--
ALTER TABLE `donee_benefaction`
  ADD PRIMARY KEY (`benefactionID`,`doneeID`),
  ADD KEY `donee_benefaction_ibfk_1` (`doneeID`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donorID`);

--
-- Indexes for table `fund`
--
ALTER TABLE `fund`
  ADD PRIMARY KEY (`fundID`),
  ADD KEY `fund_ibfk_2` (`donorID`),
  ADD KEY `fund_ibfk_1` (`projectID`);

--
-- Indexes for table `gooddonation`
--
ALTER TABLE `gooddonation`
  ADD PRIMARY KEY (`goodDonationID`);

--
-- Indexes for table `individual`
--
ALTER TABLE `individual`
  ADD PRIMARY KEY (`individualID`);

--
-- Indexes for table `milestone`
--
ALTER TABLE `milestone`
  ADD PRIMARY KEY (`milestoneID`) USING BTREE,
  ADD KEY `projectID_fk` (`projectID`);

--
-- Indexes for table `monetarydonation`
--
ALTER TABLE `monetarydonation`
  ADD PRIMARY KEY (`monetaryDonationID`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`monetaryNecessityID`);

--
-- Indexes for table `necessity`
--
ALTER TABLE `necessity`
  ADD PRIMARY KEY (`necessityID`),
  ADD KEY `necessity_ibfk_1` (`doneeID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`orgID`);

--
-- Indexes for table `physicalgood`
--
ALTER TABLE `physicalgood`
  ADD PRIMARY KEY (`goodNecessityID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `project_ibfk_1` (`orgID`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`scholarshipID`),
  ADD KEY `scholarship_ibfk_1` (`donorID`);

--
-- Indexes for table `scholarship_request`
--
ALTER TABLE `scholarship_request`
  ADD PRIMARY KEY (`scholarshipID`,`studentID`),
  ADD KEY `scholarship_request_studentID_fk` (`studentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `student_scholarship`
--
ALTER TABLE `student_scholarship`
  ADD PRIMARY KEY (`scholarshipID`,`studentID`),
  ADD KEY `student_scholarship_ibfk_1` (`studentID`);

--
-- Indexes for table `successstory`
--
ALTER TABLE `successstory`
  ADD PRIMARY KEY (`storyID`),
  ADD KEY `successstory_ibfk_1` (`doneeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benefaction`
--
ALTER TABLE `benefaction`
  MODIFY `benefactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fund`
--
ALTER TABLE `fund`
  MODIFY `fundID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `milestone`
--
ALTER TABLE `milestone`
  MODIFY `milestoneID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `necessity`
--
ALTER TABLE `necessity`
  MODIFY `necessityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `scholarshipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `successstory`
--
ALTER TABLE `successstory`
  MODIFY `storyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `benefaction`
--
ALTER TABLE `benefaction`
  ADD CONSTRAINT `benefaction_ibfk_1` FOREIGN KEY (`donorID`) REFERENCES `donor` (`donorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`companyID`) REFERENCES `donor` (`donorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`necessityID`) REFERENCES `necessity` (`necessityID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`donorID`) REFERENCES `donor` (`donorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donee`
--
ALTER TABLE `donee`
  ADD CONSTRAINT `doneeID` FOREIGN KEY (`doneeID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donee_benefaction`
--
ALTER TABLE `donee_benefaction`
  ADD CONSTRAINT `donee_benefaction_ibfk_1` FOREIGN KEY (`doneeID`) REFERENCES `donee` (`doneeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donee_benefaction_ibfk_2` FOREIGN KEY (`benefactionID`) REFERENCES `benefaction` (`benefactionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donorID` FOREIGN KEY (`donorID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fund`
--
ALTER TABLE `fund`
  ADD CONSTRAINT `fund_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `project` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fund_ibfk_2` FOREIGN KEY (`donorID`) REFERENCES `donor` (`donorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `individual`
--
ALTER TABLE `individual`
  ADD CONSTRAINT `individual_ibfk_1` FOREIGN KEY (`individualID`) REFERENCES `donor` (`donorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `milestone`
--
ALTER TABLE `milestone`
  ADD CONSTRAINT `projectID_fk` FOREIGN KEY (`projectID`) REFERENCES `project` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `money`
--
ALTER TABLE `money`
  ADD CONSTRAINT `money_ibfk_1` FOREIGN KEY (`monetaryNecessityID`) REFERENCES `necessity` (`necessityID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `necessity`
--
ALTER TABLE `necessity`
  ADD CONSTRAINT `necessity_ibfk_1` FOREIGN KEY (`doneeID`) REFERENCES `donee` (`doneeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`orgID`) REFERENCES `donee` (`doneeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `physicalgood`
--
ALTER TABLE `physicalgood`
  ADD CONSTRAINT `physicalgood_ibfk_1` FOREIGN KEY (`goodNecessityID`) REFERENCES `necessity` (`necessityID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`orgID`) REFERENCES `organization` (`orgID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD CONSTRAINT `scholarship_ibfk_1` FOREIGN KEY (`donorID`) REFERENCES `donor` (`donorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship_request`
--
ALTER TABLE `scholarship_request`
  ADD CONSTRAINT `scholarship_request_scholarshipID_fk` FOREIGN KEY (`scholarshipID`) REFERENCES `scholarship` (`scholarshipID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scholarship_request_studentID_fk` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `donee` (`doneeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_scholarship`
--
ALTER TABLE `student_scholarship`
  ADD CONSTRAINT `student_scholarship_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_ibfk_2` FOREIGN KEY (`scholarshipID`) REFERENCES `scholarship` (`scholarshipID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `successstory`
--
ALTER TABLE `successstory`
  ADD CONSTRAINT `successstory_ibfk_1` FOREIGN KEY (`doneeID`) REFERENCES `donee` (`doneeID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
