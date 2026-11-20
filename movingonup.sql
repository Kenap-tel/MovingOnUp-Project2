-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2026 at 05:26 PM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movingonup`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientmovinginfo`
--

CREATE TABLE `clientmovinginfo` (
  `MovingID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `NewStreetNumber` varchar(10) NOT NULL,
  `NewStreetName` varchar(100) NOT NULL,
  `NewCity` varchar(50) NOT NULL,
  `NewState` varchar(50) NOT NULL,
  `NewZipCode` varchar(10) NOT NULL,
  `MovingDate` date NOT NULL,
  `TotalWeight` decimal(10,2) NOT NULL,
  `MilesForMove` decimal(10,2) NOT NULL,
  `TotalCost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientmovinginfo`
--

INSERT INTO `clientmovinginfo` (`MovingID`, `ClientID`, `NewStreetNumber`, `NewStreetName`, `NewCity`, `NewState`, `NewZipCode`, `MovingDate`, `TotalWeight`, `MilesForMove`, `TotalCost`) VALUES
(1, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 2500.00, 15.00, 1200.00),
(5001, 1001, '220', 'Lake Avenue', 'Newark', 'NJ', '07104', '2027-01-15', 2500.00, 12.50, 450.00),
(5002, 1002, '340', 'Garden Road', 'Jersey City', 'NJ', '07306', '2027-02-10', 3000.00, 15.00, 550.00),
(5003, 1003, '415', 'Broad Street', 'Edison', 'NJ', '08817', '2027-03-05', 1800.00, 22.00, 400.00),
(5004, 1004, '520', 'Pine Street', 'Hoboken', 'NJ', '07030', '2027-03-20', 2200.00, 8.50, 375.00),
(5005, 1005, '650', 'Main Avenue', 'Elizabeth', 'NJ', '07201', '2027-04-12', 3500.00, 18.00, 650.00),
(5006, 1006, '725', 'River Road', 'Bayonne', 'NJ', '07002', '2027-05-08', 2800.00, 10.00, 425.00),
(5007, 1007, '810', 'Oak Lane', 'Clifton', 'NJ', '07011', '2027-06-15', 2000.00, 20.00, 500.00),
(5008, 1008, '930', 'Washington Street', 'Fort Lee', 'NJ', '07024', '2027-07-10', 3200.00, 25.00, 700.00),
(5009, 1009, '105', 'Maple Avenue', 'Kearny', 'NJ', '07032', '2027-08-05', 1500.00, 7.00, 300.00),
(5010, 1010, '115', 'Hill Road', 'Union City', 'NJ', '07087', '2027-09-12', 2700.00, 14.00, 475.00),
(5011, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-12', 2500.00, 15.00, 1200.00),
(5012, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-12', 2500.00, 15.00, 1200.00),
(5013, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-12', 2500.00, 15.00, 1200.00),
(5014, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 2500.00, 15.00, 1200.00),
(5015, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 2500.00, 15.00, 1200.00),
(5016, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 2500.00, 15.00, 1200.00),
(5017, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 2500.00, 15.00, 1200.00),
(5018, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 2500.00, 15.00, 1200.00),
(5019, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-11-28', 2500.00, 15.00, 1200.00),
(5020, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-11-28', 2500.00, 15.00, 1200.00),
(5021, 1001, '125', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-11-26', 2500.00, 15.00, 1200.00),
(5022, 1001, '250', 'Oak Street', 'Jersey City', 'New Jersey', '07302', '2026-11-26', 2500.00, 15.00, 1200.00),
(5023, 1001, '25', 'Main Street', 'Jersey City', 'New Jersey', '07302', '2026-12-15', 1500.00, 25.00, 750.00);

-- --------------------------------------------------------

--
-- Table structure for table `clientpersonalinfo`
--

CREATE TABLE `clientpersonalinfo` (
  `ClientID` int(11) NOT NULL,
  `StreetNumber` varchar(10) NOT NULL,
  `StreetName` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(10) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientpersonalinfo`
--

INSERT INTO `clientpersonalinfo` (`ClientID`, `StreetNumber`, `StreetName`, `City`, `State`, `ZipCode`, `PhoneNumber`) VALUES
(1001, '125', 'Oak Street', 'Jersey City', 'NJ', '07302', '2015551001'),
(1002, '240', 'Park Avenue', 'Newark', 'NJ', '07102', '2015551002'),
(1003, '315', 'Maple Road', 'Hoboken', 'NJ', '07030', '2015551003'),
(1004, '420', 'Main Street', 'Edison', 'NJ', '08817', '2015551004'),
(1005, '550', 'Washington Street', 'Bayonne', 'NJ', '07002', '2015551005'),
(1006, '625', 'Broad Street', 'Elizabeth', 'NJ', '07201', '2015551006'),
(1007, '710', 'Pine Avenue', 'Union City', 'NJ', '07087', '2015551007'),
(1008, '830', 'Garden Street', 'Clifton', 'NJ', '07011', '2015551008'),
(1009, '945', 'River Road', 'Fort Lee', 'NJ', '07024', '2015551009'),
(1010, '105', 'Hill Street', 'Kearny', 'NJ', '07032', '2015551010');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientID`, `FirstName`, `LastName`) VALUES
(1001, 'Aarav', 'Patel'),
(1002, 'Priya', 'Shah'),
(1003, 'Rohan', 'Mehta'),
(1004, 'Anaya', 'Desai'),
(1005, 'Rahul', 'Joshi'),
(1006, 'Mia', 'Garcia'),
(1007, 'Noah', 'Wilson'),
(1008, 'Isabella', 'Brown'),
(1009, 'Ethan', 'Miller'),
(1010, 'Sofia', 'Davis');

-- --------------------------------------------------------

--
-- Table structure for table `movingrepresentatives`
--

CREATE TABLE `movingrepresentatives` (
  `RepID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `RepPassword` varchar(255) NOT NULL,
  `RepNumber` varchar(20) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movingrepresentatives`
--

INSERT INTO `movingrepresentatives` (`RepID`, `FirstName`, `LastName`, `RepPassword`, `RepNumber`, `PhoneNumber`, `Email`) VALUES
(1, 'John', 'Smith', 'John@1234', 'REP1001', '2015550101', 'john.smith@example.com'),
(2, 'Emma', 'Johnson', 'Emma@2345', 'REP1002', '2015550102', 'emma.johnson@example.com'),
(3, 'Michael', 'Brown', 'Mike@3456', 'REP1003', '2015550103', 'michael.brown@example.com'),
(4, 'Sophia', 'Davis', 'Sophia@4567', 'REP1004', '2015550104', 'sophia.davis@example.com'),
(5, 'Daniel', 'Wilson', 'Daniel@5678', 'REP1005', '2015550105', 'daniel.wilson@example.com'),
(6, 'Olivia', 'Martinez', 'Olivia@6789', 'REP1006', '2015550106', 'olivia.martinez@example.com'),
(7, 'James', 'Anderson', 'James@7890', 'REP1007', '2015550107', 'james.anderson@example.com'),
(8, 'Ava', 'Thomas', 'Ava@8901', 'REP1008', '2015550108', 'ava.thomas@example.com'),
(9, 'William', 'Taylor', 'William@9012', 'REP1009', '2015550109', 'william.taylor@example.com'),
(10, 'Isabella', 'Moore', 'Isabella@0123', 'REP1010', '2015550110', 'isabella.moore@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `representativeclients`
--

CREATE TABLE `representativeclients` (
  `RepID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `representativeclients`
--

INSERT INTO `representativeclients` (`RepID`, `ClientID`) VALUES
(1, 1001),
(2, 1001),
(2, 1002),
(3, 1002),
(3, 1003),
(4, 1003),
(4, 1004),
(5, 1004),
(5, 1005),
(6, 1005),
(6, 1006),
(7, 1007),
(8, 1008),
(9, 1009),
(10, 1010);

-- --------------------------------------------------------

--
-- Table structure for table `representatives`
--

CREATE TABLE `representatives` (
  `RepID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `RepPassword` varchar(255) NOT NULL,
  `RepIDNumber` varchar(20) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `representatives`
--

INSERT INTO `representatives` (`RepID`, `FirstName`, `LastName`, `RepPassword`, `RepIDNumber`, `PhoneNumber`, `EmailAddress`) VALUES
(1, 'Aarav', 'Patel', 'Move@1234', 'REP1001', '2015552001', 'aarav.patel@example.com'),
(2, 'Priya', 'Shah', 'Move@2345', 'REP1002', '2015552002', 'priya.shah@example.com'),
(3, 'Rohan', 'Mehta', 'Move@3456', 'REP1003', '2015552003', 'rohan.mehta@example.com'),
(4, 'Anaya', 'Desai', 'Move@4567', 'REP1004', '2015552004', 'anaya.desai@example.com'),
(5, 'Rahul', 'Joshi', 'Move@5678', 'REP1005', '2015552005', 'rahul.joshi@example.com'),
(6, 'Mia', 'Garcia', 'Move@6789', 'REP1006', '2015552006', 'mia.garcia@example.com'),
(7, 'Noah', 'Wilson', 'Move@7890', 'REP1007', '2015552007', 'noah.wilson@example.com'),
(8, 'Isabella', 'Brown', 'Move@8901', 'REP1008', '2015552008', 'isabella.brown@example.com'),
(9, 'Ethan', 'Miller', 'Move@9012', 'REP1009', '2015552009', 'ethan.miller@example.com'),
(10, 'Sofia', 'Davis', 'Move@0123', 'REP1010', '2015552010', 'sofia.davis@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `specialinstructions`
--

CREATE TABLE `specialinstructions` (
  `MovingID` int(11) NOT NULL,
  `Instructions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialinstructions`
--

INSERT INTO `specialinstructions` (`MovingID`, `Instructions`) VALUES
(5001, 'Pack kitchen items separately and label fragile boxes.'),
(5002, 'Keep all furniture together and label each room.'),
(5003, 'Handle electronic items with extra care.'),
(5004, 'Pack glass items separately using protective materials.'),
(5005, 'Move heavy furniture carefully and protect the floors.'),
(5006, 'Keep important documents in a separate labeled box.'),
(5007, 'Pack bedroom items together and label all boxes.'),
(5008, 'Handle mirrors and artwork carefully.'),
(5009, 'Keep kitchen appliances together during the move.'),
(5010, 'Label all boxes clearly by room for easy unpacking.'),
(5011, 'Everything should be perfect.'),
(5012, 'Everything should be perfect.'),
(5013, 'Everything should be perfect.'),
(5014, 'Everything should be perfect'),
(5015, 'Everything should be perfect'),
(5016, ',,,'),
(5017, ',,,'),
(5018, ',,,'),
(5019, '...'),
(5020, '...'),
(5021, 'nj'),
(5022, 'Handle furniture carefully'),
(5023, 'Handle furniture carefully');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientmovinginfo`
--
ALTER TABLE `clientmovinginfo`
  ADD PRIMARY KEY (`MovingID`),
  ADD KEY `fk_moving_client` (`ClientID`);

--
-- Indexes for table `clientpersonalinfo`
--
ALTER TABLE `clientpersonalinfo`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `movingrepresentatives`
--
ALTER TABLE `movingrepresentatives`
  ADD PRIMARY KEY (`RepID`),
  ADD UNIQUE KEY `RepNumber` (`RepNumber`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `representativeclients`
--
ALTER TABLE `representativeclients`
  ADD PRIMARY KEY (`RepID`,`ClientID`);

--
-- Indexes for table `representatives`
--
ALTER TABLE `representatives`
  ADD PRIMARY KEY (`RepID`),
  ADD UNIQUE KEY `RepIDNumber` (`RepIDNumber`),
  ADD UNIQUE KEY `EmailAddress` (`EmailAddress`);

--
-- Indexes for table `specialinstructions`
--
ALTER TABLE `specialinstructions`
  ADD PRIMARY KEY (`MovingID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientmovinginfo`
--
ALTER TABLE `clientmovinginfo`
  MODIFY `MovingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5024;

--
-- AUTO_INCREMENT for table `movingrepresentatives`
--
ALTER TABLE `movingrepresentatives`
  MODIFY `RepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `representatives`
--
ALTER TABLE `representatives`
  MODIFY `RepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientmovinginfo`
--
ALTER TABLE `clientmovinginfo`
  ADD CONSTRAINT `clientmovinginfo_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`),
  ADD CONSTRAINT `fk_moving_client` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`) ON UPDATE CASCADE;

--
-- Constraints for table `clientpersonalinfo`
--
ALTER TABLE `clientpersonalinfo`
  ADD CONSTRAINT `clientpersonalinfo_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `representativeclients`
--
ALTER TABLE `representativeclients`
  ADD CONSTRAINT `representativeclients_ibfk_1` FOREIGN KEY (`RepID`) REFERENCES `movingrepresentatives` (`RepID`),
  ADD CONSTRAINT `representativeclients_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `specialinstructions`
--
ALTER TABLE `specialinstructions`
  ADD CONSTRAINT `fk_special_moving` FOREIGN KEY (`MovingID`) REFERENCES `clientmovinginfo` (`MovingID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
