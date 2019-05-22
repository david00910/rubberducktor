-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Ápr 22. 20:22
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `rubberducktor`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `address`
--

CREATE TABLE `address` (
  `addressID` int(8) NOT NULL,
  `street` varchar(40) CHARACTER SET latin1 NOT NULL,
  `postalCode` varchar(8) CHARACTER SET latin1 NOT NULL,
  `country` varchar(40) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `firstName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lastName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 NOT NULL,
  `gender` int(1) NOT NULL,
  `isAdmin` int(1) NOT NULL,
  `avatar_url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `addressID` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `customer`
--

INSERT INTO `customer` (`customerID`, `firstName`, `lastName`, `email`, `password`, `gender`, `isAdmin`, `avatar_url`, `addressID`) VALUES
(1, 'Dávid', 'Antal', 'david.antal211@gmail.com', '$2y$15$.athI3CEEpWE8peo2LHOsub8fIj6H7A5bCC6Aa484bS2AtRb.qC.a', 0, 1, NULL, NULL),
(5, 'Baby', 'Notadmin', 'test@test.test', '$2y$15$PDNnemsZp9ecNkzeekGHa.Q8kkSZc./5I0yIAfutAxQD7g/0Un6Iq', 0, 0, NULL, NULL),
(6, 'Painful', 'Slap', 'slappy@gmail.com', '$2y$15$QLKhHRawkY4rDc4wbJneS.xHWqbNEDuifAmPdd4DrUg08pyTeW8/W', 0, 0, NULL, NULL),
(7, 'Becky', 'Bish', 'beckybish@gmail.com', '$2y$15$T46MdatCIpgaoxC3hhZr8uO0yxNOmU5eZTw4hk/91XV25gyQ3vKee', 0, 0, NULL, NULL),
(8, 'Fat', 'Mama', 'fatmama@gmail.com', '$2y$15$62UneZJ3vrl1owDmXsf7juW/y/QQl/S15rAbfdZ/.VYlQ5skDyCue', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `order`
--

CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `shippingAddress` int(8) NOT NULL,
  `billingAddress` int(8) NOT NULL,
  `createdAt` date NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `orderPrice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orderline`
--

CREATE TABLE `orderline` (
  `OrderLineID` int(3) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `itemID` int(8) DEFAULT NULL,
  `OrderQuantity` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `postalcode`
--

CREATE TABLE `postalcode` (
  `code` varchar(8) CHARACTER SET latin1 NOT NULL,
  `city` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `product`
--

CREATE TABLE `product` (
  `itemID` int(8) NOT NULL,
  `itemName` varchar(40) CHARACTER SET latin1 NOT NULL,
  `itemIssueDate` date NOT NULL,
  `itemDescription` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `itemPrice` int(20) DEFAULT NULL,
  `itemOriginalPrice` int(25) NOT NULL,
  `itemSize` varchar(25) CHARACTER SET latin1 NOT NULL,
  `itemInStock` int(1) DEFAULT NULL,
  `itemImg_url` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- A tábla adatainak kiíratása `product`
--

INSERT INTO `product` (`itemID`, `itemName`, `itemIssueDate`, `itemDescription`, `itemPrice`, `itemOriginalPrice`, `itemSize`, `itemInStock`, `itemImg_url`) VALUES
(1, 'Savanna baboon', '2018-05-19', 'Intrcoronry thromb infus', 1571, 1900, 'L', 0, '../includes/images/duck1.png'),
(2, 'Constrictor, eastern boa', '2018-08-29', 'Thoracic operation NEC', 1034, 1300, '3XL', 0, '../includes/images/duck2.png'),
(3, 'Monitor, two-banded', '2018-07-27', 'Rep cystocel w grft/pros', 197, 399, 'XL', 1, '../includes/images/duck1.png'),
(4, 'Black-collared barbet', '2019-03-17', 'Remov ren dialysis shunt', NULL, 1798, 'XS', 0, '../includes/images/duck2.png'),
(5, 'Squirrel, nelson ground', '2018-08-25', 'Lung laceration closure', NULL, 450, '3XL', 1, '../includes/images/duck1.png'),
(6, 'Cockatoo, slender-billed', '2018-03-31', 'Bone mineral density', 1269, 1400, 'S', 1, '../includes/images/duck2.png'),
(62, 'herebere12', '2019-04-21', 'fghjk', 0, 3132, '1', NULL, '../includes/images/b661a97eea0ad3249c125b2aeec217d2.jpg'),
(63, 'herebere12', '2019-04-21', 'fghjk', 0, 3132, '1', NULL, '../includes/images/51709373_1947391368692940_8327081017231802368_n.jpg');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressID`),
  ADD KEY `postalCode` (`postalCode`);

--
-- A tábla indexei `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `addressID` (`addressID`);

--
-- A tábla indexei `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `shippingAddress` (`shippingAddress`),
  ADD KEY `billingAddress` (`billingAddress`);

--
-- A tábla indexei `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`OrderLineID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `itemID` (`itemID`);

--
-- A tábla indexei `postalcode`
--
ALTER TABLE `postalcode`
  ADD PRIMARY KEY (`code`);

--
-- A tábla indexei `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`itemID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `address`
--
ALTER TABLE `address`
  MODIFY `addressID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `orderline`
--
ALTER TABLE `orderline`
  MODIFY `OrderLineID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `product`
--
ALTER TABLE `product`
  MODIFY `itemID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`postalCode`) REFERENCES `postalcode` (`code`);

--
-- Megkötések a táblához `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`addressID`) REFERENCES `address` (`addressID`);

--
-- Megkötések a táblához `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`shippingAddress`) REFERENCES `address` (`addressID`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`billingAddress`) REFERENCES `address` (`addressID`);

--
-- Megkötések a táblához `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `product` (`itemID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
