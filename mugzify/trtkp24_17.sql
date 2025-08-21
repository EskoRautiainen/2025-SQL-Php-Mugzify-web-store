-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2025 at 11:28 AM
-- Server version: 8.0.41-0ubuntu0.20.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trtkp24_17`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `AdminID` int NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`AdminID`, `Email`, `Password`) VALUES
(1, 'admin1@testi.com', '$2y$10$FJvXo2E4CiQ0lyH/GLnC7eCSEVWyB0u68cFhpCIDs05Hppe9/94PC'),
(2, 'admin2@testi.com', '$2y$10$1YLBvzpJZ9kYIZWVeXBVqeurp5hHlC1rrENIH6CyMc8/AuE7xpqm6'),
(3, 'admin3@testi.com', '$2y$10$OJA.Is6euOYRs1d8ACGi7ugsdvzLNJQYo7OdMmpCBS0hnVWb3HDfa');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `customerID` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customerID`, `email`, `password`) VALUES
(1, 'asiakas1@asiakas.fi', '$2y$10$B4uD/rLMO0OKrD.OrRd.IumLobGfLh8c7np8kg8yJS0y/MRAt7wJu'),
(2, 'asiakas2@asiakas.fi', '$2y$10$9XH8w6EVizl4AFHLKiODRO1//H8jg56oWLb3XnGmxcA11oEyZU5OW'),
(3, 'asiakas3@asiakas.fi', '$2y$10$Uxuc.PnIikpuZVtmKltj9OAkS3patkoU75OHQH/T6gLoOwsMlVzWm'),
(4, 'asiakas4@asiakas.fi', '$2y$10$PFYscx2ArdO6g.NSkqmn3O/MIoOX/qBYXp4j5nQBOVcaW7qBSBDye'),
(5, 'asiakas5@asiakas.fi', '$2y$10$FsRrEFR7Sa7B.jKR85tDhu6hRxR/dBPmMcD1xaB3UcGYi1ox6WDE6');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int NOT NULL,
  `PurchaseDATE` date NOT NULL,
  `PurchaseTIME` time NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `PostalCode` int NOT NULL,
  `City` varchar(200) NOT NULL,
  `PictureID` varchar(200) NOT NULL,
  `Customer_customerID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderID`, `PurchaseDATE`, `PurchaseTIME`, `Name`, `Address`, `PostalCode`, `City`, `PictureID`, `Customer_customerID`) VALUES
(1, '2025-02-20', '10:40:35', 'Ossi', 'Ossikuja', 111111, 'Oulu', 'No image selected', NULL),
(2, '2025-02-20', '10:40:45', 'Kalle', 'Kallekatu', 111122, 'Lahti', 'No image selected', NULL),
(3, '2025-02-20', '10:41:14', 'Aku', 'Ankankuja', 111133, 'Ankkalinna', 'No image selected', NULL),
(4, '2025-02-20', '10:41:37', 'Hessu', 'Kivilevontie', 111144, 'Tampere', 'No image selected', NULL),
(5, '2025-02-20', '10:47:32', 'Roope', 'Rahasäiliömäki 1', 111133, 'Ankkalinna', 'Untitled Diagram.drawio (2).png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `Orders_OrderID` int NOT NULL,
  `Customer_customerID` int NOT NULL,
  `rating` int NOT NULL,
  `review` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`Orders_OrderID`, `Customer_customerID`, `rating`, `review`, `image`) VALUES
(1, 1, 5, 'Hieno muki', ''),
(2, 2, 5, 'Erinomaista laatua', ''),
(3, 3, 1, 'En tykännyt', ''),
(4, 4, 5, 'Hyvä lahja', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `AdminID_UNIQUE` (`AdminID`),
  ADD UNIQUE KEY `Email_UNIQUE` (`Email`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `customerID_UNIQUE` (`customerID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD UNIQUE KEY `OrderID_UNIQUE` (`OrderID`),
  ADD KEY `fk_Orders_Customer_idx` (`Customer_customerID`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`Orders_OrderID`),
  ADD KEY `fk_Reviews_Orders1_idx` (`Orders_OrderID`),
  ADD KEY `fk_Reviews_Customer1_idx` (`Customer_customerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `AdminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `Orders_OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `fk_Orders_Customer` FOREIGN KEY (`Customer_customerID`) REFERENCES `Customer` (`customerID`);

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `fk_Reviews_Customer1` FOREIGN KEY (`Customer_customerID`) REFERENCES `Customer` (`customerID`),
  ADD CONSTRAINT `fk_Reviews_Orders1` FOREIGN KEY (`Orders_OrderID`) REFERENCES `Orders` (`OrderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
