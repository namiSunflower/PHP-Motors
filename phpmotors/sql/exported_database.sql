-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2022 at 12:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Bean', 'Soup', 'beansoup@mail.com', '$2y$10$WkZHJkzdn.RD5jFkUnKwS.j2aGbiRkxrMQTeX5fT7Sc4RG27pdKo.', '2', NULL),
(2, 'String', 'Cheese', 'stringcheese@mail.com', '$2y$10$UpAIsqyNlxJDB0MCYhG7aeqpGaOtMqF6WdWzjPfGsASAQazP4nHLm', '1', NULL),
(3, 'Admin', 'User', 'admin@cse340.net', '$2y$10$xEAu5vlkawioABJm2mCkruAttXhbIXCCbRtg7TNW6cOQXLFp.y2TC', '3', NULL),
(5, 'Almond', 'Breeze', 'almond@mail.com', '$2y$10$Cj4qy1fX7Gr0tJZKRL2O2OHFXsaIoj.MvYVxdlrfn/BoY4B2fUpoa', '1', NULL),
(6, 'Ellie', 'Elles', 'ellie@mail.com', '$2y$10$0LNF2SOD41zuXnxcbT6/xOWtUg7zZk7SxvWZJD96vztAWXDcKO4Pm', '1', NULL),
(7, 'strawberry', 'c', 'straw@mail.com', '$2y$10$TccIZj9IIAsxd4pruDEIqOUXf6rRNUTwsxDo7JO0bpZilG2Hwx4em', '1', NULL),
(8, 'nlknkl', 'nklnlk', 'njknkj@email.com', '$2y$10$tvzt0cmlLi8EFukoTIuW.e/0e9eMZQeKIIffF4fGjPVuh3yIiKUfq', '1', NULL),
(9, 'anjdnaskld', 'danjdnasld', 'bug@mail.com', '$2y$10$KKoOKeovBxXtv4HsgjwcoOpGyFkxUIEMDZF3ejPDAO8OYrWYqvHgW', '1', NULL),
(10, 'dasndanslkd', 'dasnldnaskld', 'pop@mail.com', '$2y$10$7XNU3DKYJhVxLso15GXTfOULDUzleGIuIk.IKgwRT42Uu/RHmNCiC', '1', NULL),
(11, 'asndlaks', 'dnaldknsa', 'anlkdnas@a.com', '$2y$10$gnm3dsLHZz.hE7hoZLchRef0F63w.a4wVXKl5zSHuvarLn7aIxH8K', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(19, 1, 'jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '2022-03-17 21:25:38', 1),
(20, 1, 'jeep-wrangler-tn.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '2022-03-17 21:25:38', 1),
(21, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2022-03-17 21:25:57', 1),
(22, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2022-03-17 21:25:57', 1),
(23, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2022-03-17 21:26:11', 1),
(24, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2022-03-17 21:26:11', 1),
(25, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2022-03-17 21:26:29', 1),
(26, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2022-03-17 21:26:29', 1),
(27, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2022-03-17 21:27:33', 1),
(28, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2022-03-17 21:27:33', 1),
(29, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2022-03-17 21:27:50', 1),
(30, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2022-03-17 21:27:50', 1),
(31, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2022-03-17 21:28:04', 1),
(32, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2022-03-17 21:28:04', 1),
(33, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2022-03-17 21:28:17', 1),
(34, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2022-03-17 21:28:17', 1),
(35, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2022-03-17 21:29:00', 1),
(36, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2022-03-17 21:29:00', 1),
(37, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2022-03-17 21:29:18', 1),
(38, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2022-03-17 21:29:18', 1),
(39, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2022-03-17 21:29:31', 1),
(40, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2022-03-17 21:29:31', 1),
(41, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2022-03-17 21:29:46', 1),
(42, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2022-03-17 21:29:46', 1),
(43, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2022-03-17 21:29:57', 1),
(44, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2022-03-17 21:29:57', 1),
(45, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2022-03-17 21:30:13', 1),
(46, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2022-03-17 21:30:13', 1),
(47, 15, 'dog-car.jpg', '/phpmotors/images/vehicles/dog-car.jpg', '2022-03-17 21:30:38', 1),
(48, 15, 'dog-car-tn.jpg', '/phpmotors/images/vehicles/dog-car-tn.jpg', '2022-03-17 21:30:38', 1),
(49, 21, 'cm.jpg', '/phpmotors/images/vehicles/cm.jpg', '2022-03-17 21:31:06', 1),
(50, 21, 'cm-tn.jpg', '/phpmotors/images/vehicles/cm-tn.jpg', '2022-03-17 21:31:06', 1),
(53, 37, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2022-03-17 21:41:45', 1),
(54, 37, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2022-03-17 21:41:45', 1),
(57, 3, 'black-lambo.jpg', '/phpmotors/images/vehicles/black-lambo.jpg', '2022-03-17 22:07:18', 0),
(58, 3, 'black-lambo-tn.jpg', '/phpmotors/images/vehicles/black-lambo-tn.jpg', '2022-03-17 22:07:18', 0),
(59, 21, 'cookie-ford.jpg', '/phpmotors/images/vehicles/cookie-ford.jpg', '2022-03-17 22:07:39', 0),
(60, 21, 'cookie-ford-tn.jpg', '/phpmotors/images/vehicles/cookie-ford-tn.jpg', '2022-03-17 22:07:39', 0),
(67, 1, 'electric-wrangler.jpg', '/phpmotors/images/vehicles/electric-wrangler.jpg', '2022-03-18 19:51:56', 0),
(68, 1, 'electric-wrangler-tn.jpg', '/phpmotors/images/vehicles/electric-wrangler-tn.jpg', '2022-03-18 19:51:56', 0),
(69, 21, 'sunset-1807524_1280.jpg', '/phpmotors/images/vehicles/sunset-1807524_1280.jpg', '2022-03-18 19:54:21', 0),
(70, 21, 'sunset-1807524_1280-tn.jpg', '/phpmotors/images/vehicles/sunset-1807524_1280-tn.jpg', '2022-03-18 19:54:21', 0),
(71, 21, '20220124_195249.jpg', '/phpmotors/images/vehicles/20220124_195249.jpg', '2022-03-18 19:56:49', 0),
(72, 21, '20220124_195249-tn.jpg', '/phpmotors/images/vehicles/20220124_195249-tn.jpg', '2022-03-18 19:56:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep ', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/jeep-wrangler.jpg', '/phpmotors/images/vehicles/jeep-wrangler-tn.jpg', '28045.00', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '30000.00', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/ms.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '100.00', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/bat.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '65000.00', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mm.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000.00', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000.00', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/fbi.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '20000.00', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/dog-car.jpg', '/phpmotors/images/vehicles/dog-car-tn.jpg', '35000.00', 1, 'Brown', 2),
(21, 'Cookie', 'Monster', 'C is for cookie, that\'s good enough for me, yeah\r\nC is for cookie, that\'s good enough for me, ay\r\nC is for cookie, that\'s good enough for me, oh\r\nCookie, cookie, cookie starts with C', '/phpmotors/images/vehicles/cm.jpg', '/phpmotors/images/vehicles/cm-tn.jpg', '20000000.00', 100, 'blue', 4),
(37, 'DMC', 'Delorean', 'The DMC DeLorean is a rear-engine two-passenger sports car manufactured and marketed by John DeLorean&#039;s DeLorean Motor Company (DMC) for the American market from 1981 until 1983&mdash;ultimately the only car brought to market by the fledgling company.', 'a', 'a', '35000.00', 6500, 'grey', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(17, 'Nice plane!', '2022-03-31 00:03:03', 13, 1),
(19, 'gob', '2022-03-31 00:07:50', 8, 1),
(24, 'bellyache', '2022-03-31 01:53:02', 2, 1),
(27, 'hamburger', '2022-03-31 01:47:38', 2, 1),
(28, 'niceez!', '2022-03-31 02:11:28', 3, 1),
(33, 'Not worth the money!!!', '2022-03-31 05:44:33', 3, 1),
(34, 'Picked it up last Saturday, and it was the best thing ever!', '2022-03-31 05:52:41', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
