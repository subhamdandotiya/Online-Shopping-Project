-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2024 at 09:27 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SB_FIT`
--

-- --------------------------------------------------------

--
-- Table structure for table `CART`
--

CREATE TABLE `CART` (
  `cartId` int NOT NULL,
  `userId` int NOT NULL,
  `cartVersion` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `CART`
--

INSERT INTO `CART` (`cartId`, `userId`, `cartVersion`) VALUES
(4, 17, 1),
(5, 18, 3),
(55, 4, 1),
(56, 5, 3),
(57, 6, 1),
(58, 7, 1),
(59, 8, 2),
(60, 9, 3),
(61, 10, 1),
(62, 11, 2),
(63, 12, 1),
(64, 13, 3),
(65, 14, 2),
(66, 15, 1),
(67, 16, 1),
(68, 17, 3),
(69, 18, 1),
(70, 19, 2),
(72, 21, 1),
(76, 4, 3),
(77, 5, 2),
(78, 6, 3),
(79, 7, 2),
(80, 8, 3),
(81, 9, 1),
(94, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `CART_ITEMS`
--

CREATE TABLE `CART_ITEMS` (
  `cartItemId` int NOT NULL,
  `cartId` int NOT NULL,
  `productId` int NOT NULL,
  `quantity` int NOT NULL,
  `cartVersion` int NOT NULL DEFAULT '1',
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `CART_ITEMS`
--

INSERT INTO `CART_ITEMS` (`cartItemId`, `cartId`, `productId`, `quantity`, `cartVersion`, `userId`) VALUES
(140, 4, 24, 3, 1, 3),
(141, 5, 25, 1, 3, 4),
(145, 55, 29, 2, 1, 8),
(146, 56, 30, 3, 1, 9),
(147, 57, 31, 1, 1, 10),
(148, 58, 32, 2, 2, 11),
(149, 59, 33, 1, 1, 12),
(150, 60, 34, 3, 3, 13),
(151, 61, 35, 2, 1, 14),
(152, 62, 36, 1, 1, 15),
(153, 63, 37, 1, 1, 16),
(154, 64, 38, 3, 3, 17),
(155, 65, 39, 1, 1, 18),
(156, 66, 40, 2, 2, 19),
(158, 68, 42, 1, 1, 21),
(159, 69, 43, 2, 2, 2),
(160, 70, 22, 3, 3, 3),
(162, 72, 24, 3, 3, 5),
(166, 76, 28, 3, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `orderId` int NOT NULL,
  `userId` int NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `orderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ORDERS`
--

INSERT INTO `ORDERS` (`orderId`, `userId`, `totalAmount`, `orderDate`, `paymentId`) VALUES
(1, 2, 120.00, '2024-11-30 07:20:16', 0),
(2, 3, 198.00, '2024-11-30 07:42:22', 0),
(3, 17, 47.00, '2024-11-30 21:41:26', 0),
(4, 17, 79.00, '2024-11-30 21:42:10', 0),
(5, 18, 24.00, '2024-11-30 22:07:34', 0),
(6, 18, 58.00, '2024-11-30 22:12:00', 0),
(7, 1, 8.00, '2024-12-01 00:33:26', 0),
(8, 1, 138.00, '2024-12-01 00:33:41', 0),
(9, 2, 375.00, '2024-12-01 00:36:17', 0),
(10, 3, 130.00, '2024-12-01 00:40:44', 0),
(11, 3, 35.00, '2024-12-01 00:46:10', 0),
(12, 3, 29.00, '2024-12-01 01:13:36', 0),
(13, 3, 25.00, '2024-12-01 02:24:00', 6),
(14, 3, 24.00, '2024-12-01 02:27:14', 7),
(15, 3, 33.00, '2024-12-01 02:27:38', 8),
(16, 3, 89.00, '2024-12-01 02:31:51', 9),
(17, 3, 25.00, '2024-12-01 02:35:40', 10),
(18, 3, 15.00, '2024-12-01 02:38:06', 11),
(19, 3, 25.00, '2024-12-01 02:39:55', 12),
(20, 3, 130.00, '2024-12-01 02:49:40', 13),
(21, 3, 120.00, '2024-12-01 02:50:29', 14),
(22, 3, 33.00, '2024-12-01 02:53:39', 15),
(23, 3, 39.00, '2024-12-01 02:58:53', 16),
(24, 3, 159.00, '2024-12-01 03:04:12', 17),
(25, 3, 169.00, '2024-12-01 03:13:07', 18),
(26, 3, 113.00, '2024-12-01 03:29:49', 19),
(27, 3, 39.00, '2024-12-01 03:30:09', 20),
(28, 3, 24.00, '2024-12-01 03:30:29', 21),
(29, 1, 33.00, '2024-12-01 04:23:25', 22),
(30, 1, 120.00, '2024-12-01 04:23:41', 23),
(31, 1, 120.00, '2024-12-01 04:30:32', 24),
(32, 2, 130.00, '2024-12-01 04:31:42', 25),
(33, 23, 200.00, '2024-12-01 04:35:53', 26),
(34, 1, 130.00, '2024-12-01 05:09:17', 27),
(35, 1, 49.00, '2024-12-01 20:46:11', 28);

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_ITEMS`
--

CREATE TABLE `ORDER_ITEMS` (
  `orderItemId` int NOT NULL,
  `orderId` int NOT NULL,
  `productId` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ORDER_ITEMS`
--

INSERT INTO `ORDER_ITEMS` (`orderItemId`, `orderId`, `productId`, `quantity`, `price`) VALUES
(11, 7, 26, 1, 8.00),
(12, 8, 31, 1, 49.00),
(13, 8, 29, 1, 89.00),
(14, 9, 41, 1, 25.00),
(15, 9, 40, 1, 350.00),
(16, 10, 22, 1, 130.00),
(17, 11, 28, 1, 35.00),
(18, 12, 43, 1, 29.00),
(19, 13, 41, 1, 25.00),
(20, 14, 33, 1, 24.00),
(21, 15, 39, 1, 33.00),
(22, 16, 37, 1, 89.00),
(23, 17, 42, 1, 25.00),
(24, 18, 38, 1, 15.00),
(25, 19, 42, 1, 25.00),
(26, 20, 22, 1, 130.00),
(27, 21, 23, 1, 120.00),
(28, 22, 39, 1, 33.00),
(29, 23, 27, 1, 39.00),
(30, 24, 23, 1, 120.00),
(31, 24, 27, 1, 39.00),
(32, 24, 27, 1, 39.00),
(33, 24, 27, -1, 39.00),
(37, 25, 22, 1, 130.00),
(38, 25, 24, 1, 39.00),
(40, 26, 28, 1, 35.00),
(41, 26, 27, 2, 39.00),
(43, 27, 24, 1, 39.00),
(44, 28, 33, 1, 24.00),
(45, 29, 39, 1, 33.00),
(46, 30, 23, 1, 120.00),
(47, 31, 23, 1, 120.00),
(48, 32, 22, 1, 130.00),
(49, 33, 23, 1, 120.00),
(50, 33, 34, 1, 80.00),
(52, 34, 22, 1, 130.00),
(53, 35, 31, 1, 49.00);

-- --------------------------------------------------------

--
-- Table structure for table `PAYMENTS`
--

CREATE TABLE `PAYMENTS` (
  `paymentId` int NOT NULL,
  `userId` int NOT NULL,
  `creditCardHash` varchar(255) NOT NULL,
  `cvvHash` varchar(255) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `paymentDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `PAYMENTS`
--

INSERT INTO `PAYMENTS` (`paymentId`, `userId`, `creditCardHash`, `cvvHash`, `totalAmount`, `paymentDate`) VALUES
(1, 3, '$2y$10$3utxT0eY9qypgPdK1krQEOkP5J0IVDnX4XEPK5q3k0UgWBYg4E2Eq', '$2y$10$O62l3Z6lebdinkIKvV5uceQ/goOD5ibj8gdCckfe7AFV.B4Ov9WWy', 300.00, '2024-12-01 02:15:48'),
(2, 3, '$2y$10$VRiNz7k4iDDOAHxwwQQ.aOJXz0Ek9c8rJ0uk4tIq3WqWy3awuzJxq', '$2y$10$aUswEaIVwaqyK5.Utdyak.UbtIgbIDmA7.v6zT.cGNO9l3XuXog0e', 130.00, '2024-12-01 02:16:36'),
(3, 3, '$2y$10$hbAAHUOLLdpjiZ3lxsxqjejh7wD785F.YmoSv16.ZbNQb6oI2W7WS', '$2y$10$BLwGAcz/m.eCPf9K4A.q.enL0BTpwmJ.asWyAXXOPjt2JlgoY8/qS', 35.00, '2024-12-01 02:17:31'),
(6, 3, '$2y$10$x3z/i1fEuEl3rPtG4xFMOuE0lqKiLZvHrF2cHn80RTVarmZkcUXfm', '$2y$10$kKsY2j5YzxmL7MV.35ugmee5BZQqs8QIqpQxtnPSkdj2TPNmQjRQ2', 25.00, '2024-12-01 02:24:00'),
(7, 3, '$2y$10$n9N78EFq9VZS1bFpiNQZQOvgw5HTwc1HKiJhz4cuSkKVGY2cmnsrG', '$2y$10$BoePj/NXYR.sKraIw/J2c.Tu83A0jr4xZGxTO7OppPmQCYpdxPxrW', 24.00, '2024-12-01 02:27:14'),
(8, 3, '$2y$10$f0XSJKjjnXBaFuedx0mlm.u1L9yDzXhUYU9X.d1ICHTRk0wj.lfSm', '$2y$10$RWr/VuYd9qpxDNdCwK5AvO55/.K6FQzs7zAbAJQcphv8oH4FvGiMi', 33.00, '2024-12-01 02:27:38'),
(9, 3, '$2y$10$3WJyI08BpBGrImPnL9RYnuYQT1bVhMZXBCua9eAPlHRUvYnNHac8C', '$2y$10$fNyKJO3qTjfuKrGKDbHcx.5pKdLZjt6BcQn6TjYRGQTlm2uc8iqjO', 89.00, '2024-12-01 02:31:51'),
(10, 3, '$2y$10$Emnz3nY28TS22KJB/CmHYOKPfc.Pn.Em1OdrmwWqr.09iqm26W4x6', '$2y$10$lGBsHzwXsWc4uoW.71JeeODsxqUInpmOdOJkZk5XtHniiE/Zg1vsa', 25.00, '2024-12-01 02:35:40'),
(11, 3, '$2y$10$vM1QsSYF7mMwj63jFh2ti.atmeTsb3QWgvse0.4fpPlcLE1ZXuQl2', '$2y$10$ltUVkMhxEYWvFuj6fS..Q.vgN5lP3m6GBvUQHw2HGVWvZb.wYrKyK', 15.00, '2024-12-01 02:38:06'),
(12, 3, '$2y$10$XkamYA161RF19TTCZ4jtVOWU4NQ8yQW5r445fZ3bhgkkOhKw8IlbO', '$2y$10$sbco0hneSNDVMkKwlojjBudg8wEgUsz3Y4OjfD9.wI7rXaMw8Qz5i', 25.00, '2024-12-01 02:39:55'),
(13, 3, '$2y$10$lsUIt2rIl2Y8CM6JZL67OuVmSLo2AjazS1QlR3S25MZ7P0nVVUFoq', '$2y$10$3qsfdftRoDKRUrTj3FM22eg0aoBYvXv660fi0KttXvk0nqoGfkFi.', 130.00, '2024-12-01 02:49:40'),
(14, 3, '$2y$10$9IqoFC7VuEpWDCrz5XoRvudR1Xf9nCh68SiJ8uVQPjD4Hm3v1oObq', '$2y$10$Xn57wE/q8MgpzpprCBy.5e2JB0b9xm9j/XmG2SzyAURrfXz/dF7ge', 120.00, '2024-12-01 02:50:29'),
(15, 3, '$2y$10$OExNfKRmNuC2M6fnexeVwO6iVl727X2qVV8.tdO4F1KotJxgJnqve', '$2y$10$K7gE63xhbBMXd5yQo51Vmukj6Z/.Rb2cNxZBivDpezDA4VVabQ0i6', 33.00, '2024-12-01 02:53:39'),
(16, 3, '$2y$10$VjASYp6m0GIcWqZsKcdCE.rQTtFNGsXrFiajR9RR0IrD2gVU5mzJe', '$2y$10$d1sh8y1njb8/KonJLS8A9.V70cuIbdPoqTfKc6StKv9OQt10p.i8K', 39.00, '2024-12-01 02:58:53'),
(17, 3, '$2y$10$dtH1/Bw3KwZ0QzXuekhNkufU1/9wsVH1oQD.r3OYK4R/u09.nLwWi', '$2y$10$1DqJY6y7O26mtwL.iVXJ.O0rFkyzs3qtLSVizJn5mGg8Dx5XR3ZQm', 159.00, '2024-12-01 03:04:12'),
(18, 3, '$2y$10$xXqJIpCsfWtWAv1E.y24dOBDWYQSQCRJtcmTfrFO2RgU5p.CMAys6', '$2y$10$OQEStq5NmnRPV/Mswt2ZyeQfkpRBXkPW49NB141bCULoERMEbV26e', 169.00, '2024-12-01 03:13:07'),
(19, 3, '$2y$10$5JVTr.6Y97gy.MQF8wikfuBJAChmKNl7jtgIYsc7Hzjomr3SYL0Ku', '$2y$10$FVCreabki/5LpwNZE6QdJ.f.RftGLQMXFkMUXEZ3xVOABWh9.2sXm', 113.00, '2024-12-01 03:29:49'),
(20, 3, '$2y$10$VzuAf2brYwz3BRpq4EQou.i.Mj6XKXuc2liuEKkv1a6pKN7xkqKFC', '$2y$10$U2p7VMIcPfSkf.exw64eeenCz60DS.i2TfF021ttd150TT5W2h3uW', 39.00, '2024-12-01 03:30:09'),
(21, 3, '$2y$10$93/pUV.ZMa3kRAezu5UpL.jCDkBQiA4IB98.yn2i627F0sCUKkCUW', '$2y$10$WoUN60pUKsTHFKS.JiWUmOWlr5GdYbjIpVyTMaDA0Fjp70vfn2veC', 24.00, '2024-12-01 03:30:29'),
(22, 1, '$2y$10$afLeMmTAXj8zQppUxsodRupcXmUd2wHZaz86P3fwsYPgHvFUuAEFq', '$2y$10$m8NXcJbl4/ty6RePrfn14OOSOD753DpfSLqkqfooRTGJp.P9MKsP.', 33.00, '2024-12-01 04:23:25'),
(23, 1, '$2y$10$u70.sW.4zTv26uCzbgBWmezUtWgsq3og9Moi4S5f36awT26khXuCK', '$2y$10$7wYCnY/VkSG690s6bT7CAufR6Fhw/bwa3SqXrJxOY1fbH8iGDLJY6', 120.00, '2024-12-01 04:23:41'),
(24, 1, '$2y$10$u5y1PDD6zxsZ/7ix2h53NuD44sAsMNV9AofiyKyOXAQdVTSpioRLC', '$2y$10$vGdwM7x8ST6.9hMmJwmWn.JZkIVXx1IyW7tyzqcJ9JQBYig1knxbi', 120.00, '2024-12-01 04:30:32'),
(25, 2, '$2y$10$0IuUO8rYH3oPeTaYp4Ca/.1DrGwQ.Z9g4W3iIgqeVRpwlpz30.kYm', '$2y$10$UriwBjVn9z0gh90/25E3.uPMpncgJZADd0DGvOOwl/jy7e4oQxyyi', 130.00, '2024-12-01 04:31:42'),
(26, 23, '$2y$10$Y8F2LN901vtqu4apsMxXT.3zyy2NDEnmlt0C0WuglzqLmpLxnaO.C', '$2y$10$2XesCHXA1.JEgdJuaxGDkOOCgEq1R2v6Vsl.D82/W6vPneD3JOHhW', 200.00, '2024-12-01 04:35:53'),
(27, 1, '$2y$10$fUaSDshE8lgfm1lVnwOA..DUIcBu5RoWCvYzrutsE8Y9Po3DYtmm.', '$2y$10$UX2FXDtL5EtGeQCcY75hB.AEDXyELX.02cP5FnL/mL0JRlhhwvBWC', 130.00, '2024-12-01 05:09:17'),
(28, 1, '$2y$10$jVxSz40uI8cqfg6bwEIiquiw7WbnEYD9FP7zzCJPtwagcH7m48ONe', '$2y$10$ZMhWcFZF9SZfaUU/0Zu.hOQhw/IjxKCEm1bgwFE86PK.KIqAnSOpG', 49.00, '2024-12-01 20:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE `PRODUCTS` (
  `productId` int NOT NULL,
  `productName` varchar(200) NOT NULL,
  `productDescription` text,
  `productImage` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `inventory` int DEFAULT '0',
  `isFeatured` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`productId`, `productName`, `productDescription`, `productImage`, `price`, `inventory`, `isFeatured`) VALUES
(22, 'Jersey', 'Great Football Jersey to support your team!', 'images/jersey.jpeg', 130.00, 100, 1),
(23, 'Running Shoes', 'Great running shoes for short or long runs', 'images/runshoes.jpeg', 120.00, 12, 1),
(24, 'Trucker Hat', 'Breathable and great hat for all occasions', 'images/trucker.jpeg', 39.00, 12, 1),
(25, 'Jeans', 'Breathable and flexible jeans for all occasions', 'images/jeans.jpeg', 79.00, 7, 0),
(26, 'Socks', 'Flexible socks for running or leisure', 'images/socks.jpeg', 8.00, 15, 0),
(27, 'Leisure Shirt', 'Great shirt to lounge in', 'images/shirt.jpeg', 39.00, 25, 0),
(28, 'Swim Trunks', 'Long lasting swim trunks that won\'t fade after swimming in salt or chlorine water', 'images/trunks.jpeg', 35.00, 18, 0),
(29, 'Hoodie', 'Comfortable and breathable hoodie for all chilly conditions', 'images/hoodie.jpeg', 89.00, 9, 0),
(30, 'Rain Jaacket', 'Water resistant jacket thats great for rain or snow', 'images/rainjacket.jpeg', 180.00, 14, 0),
(31, 'Sweat Pants', 'Comfy sweat pants that is great for slow and cozy days', 'images/sweatpants.jpeg', 49.00, 4, 0),
(32, 'Hiking Shoes', 'Excellent shoes for the trails. Fast drying and durable', 'images/hikingshoes.jpeg', 140.00, 38, 0),
(33, 'Gloves', 'Thin gloves that make it easy to do all tasks but breathable and thin', 'images/gloves.jpeg', 24.00, 6, 0),
(34, 'Long Sleeve Shirt', 'Durable shirt to last in all conditions', 'images/longsleeve.jpeg', 80.00, 3, 0),
(35, 'Dress Shoes', 'Excellent leather and shoes for work or other meetings', 'images/dressshoes.jpeg', 50.00, 5, 0),
(36, 'Vest', 'Vest to add extra layer of warmth or to make a fashionable statement', 'images/vest.jpeg', 220.00, 11, 0),
(37, 'Gym Shorts', 'Flexible and durable shorts for the gym or just a cozy set to wear', 'images/gymshorts.jpeg', 89.00, 58, 0),
(38, 'Poncho', 'Stay dry in wet weather with this easy to pack poncho', 'images/poncho.jpeg', 15.00, 7, 0),
(39, 'Necklace', 'Sleek necklace that goes well with any outfit', 'images/necklace.png', 33.00, 8, 0),
(40, 'High Heels', 'Dressy and sleek heels that will help make a statement', 'images/highheels.jpeg', 350.00, 16, 0),
(41, 'Blue Shirt', 'Blue shirt that goes well with anything', 'images/blueshirt.jpeg', 25.00, 22, 0),
(42, 'Red Shirt', 'Great shirt that goes well with any outfit', 'images/redshirt.jpeg', 25.00, 15, 0),
(43, 'Orange Beanie', 'Great Beanie for hunting or casual wear', 'images/orangebeanie.jpeg', 29.00, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `REVIEWS_PRODUCT`
--

CREATE TABLE `REVIEWS_PRODUCT` (
  `reviewId` int NOT NULL,
  `userId` int NOT NULL,
  `productId` int NOT NULL,
  `reviewText` text NOT NULL,
  `rating` int DEFAULT NULL,
  `reviewDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `REVIEWS_PRODUCT`
--

INSERT INTO `REVIEWS_PRODUCT` (`reviewId`, `userId`, `productId`, `reviewText`, `rating`, `reviewDate`) VALUES
(5, 2, 40, 'Just got them and feel amazing!', 5, '2024-12-01 00:36:50'),
(6, 3, 25, 'I\'ve bought a lot of jeans! these are my fav', 5, '2024-12-01 02:41:17'),
(7, 3, 24, 'Favorite Hat!', 5, '2024-12-01 03:30:58'),
(8, 1, 26, 'Super soft!!!!', 4, '2024-12-01 04:28:27'),
(9, 1, 26, 'Some of my favs!!!', 4, '2024-12-01 04:29:59'),
(10, 2, 32, 'Wish I could have more!', 5, '2024-12-01 04:32:58'),
(11, 23, 23, 'comfy!', 4, '2024-12-01 04:36:14'),
(12, 23, 33, 'great!', 4, '2024-12-01 04:36:34'),
(13, 23, 30, 'keeps me dry', 3, '2024-12-01 04:36:46'),
(14, 23, 40, 'not great', 2, '2024-12-01 04:36:59'),
(15, 23, 41, 'love the blue', 4, '2024-12-01 04:37:10'),
(16, 23, 42, 'not a fan', 2, '2024-12-01 04:37:23'),
(17, 23, 31, 'my new favorite item!!', 5, '2024-12-01 04:37:38'),
(18, 23, 39, 'love the shine!', 5, '2024-12-01 04:37:48'),
(19, 23, 29, 'Got it for a friend and they won\'t stop wearing it!', 5, '2024-12-01 04:38:05'),
(20, 23, 26, 'got to get me another pair', 4, '2024-12-01 04:38:18'),
(21, 23, 43, 'love the bright color', 4, '2024-12-01 04:39:01'),
(22, 23, 25, 'a little tight on me', 3, '2024-12-01 04:39:12'),
(23, 23, 22, 'need to get some more for my buddies!', 5, '2024-12-01 04:39:25'),
(24, 23, 28, 'Loved them on my vacation!', 5, '2024-12-01 04:39:47'),
(25, 23, 35, 'super classy and comfy', 4, '2024-12-01 04:39:58'),
(26, 23, 36, 'Keeps me super warm', 4, '2024-12-01 04:40:27'),
(27, 1, 22, 'love it!', 5, '2024-12-01 20:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `REVIEWS_SITE`
--

CREATE TABLE `REVIEWS_SITE` (
  `reviewId` int NOT NULL,
  `userId` int NOT NULL,
  `reviewText` text NOT NULL,
  `rating` int DEFAULT NULL,
  `reviewDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `REVIEWS_SITE`
--

INSERT INTO `REVIEWS_SITE` (`reviewId`, `userId`, `reviewText`, `rating`, `reviewDate`) VALUES
(4, 1, 'Love the site! easy to use. Recommend!', 5, '2024-12-01 00:32:37'),
(5, 2, 'One of my favorite websites!', 5, '2024-12-01 00:37:04'),
(6, 3, 'Love the website! easy to use', 5, '2024-12-01 02:41:29'),
(7, 3, 'Love the site keep it up!', 5, '2024-12-01 03:31:08'),
(8, 1, 'Awesome site!', 4, '2024-12-01 04:28:41'),
(9, 2, 'Good site', 3, '2024-12-01 04:33:06'),
(10, 23, 'easy navigation!', 5, '2024-12-01 04:40:39'),
(11, 23, 'not my favorite', 3, '2024-12-01 04:40:47'),
(12, 23, 'love the ease of use', 4, '2024-12-01 04:40:59'),
(13, 23, 'wish to see more products', 4, '2024-12-01 04:41:10'),
(14, 23, 'wish i could upload a profile image', 5, '2024-12-01 04:41:30'),
(15, 23, 'told my friends this is my favorite site!', 4, '2024-12-01 04:41:57'),
(16, 23, 'could use some improvement', 4, '2024-12-01 04:42:56'),
(17, 23, 'buddy referred me and really enjoyed my experience', 5, '2024-12-01 04:43:10'),
(18, 23, 'should add some fishing products', 4, '2024-12-01 04:43:22'),
(19, 23, 'Branch out more into categories of clothings', 4, '2024-12-01 04:43:34'),
(20, 23, 'Site seems kinda sluggish sometimes', 3, '2024-12-01 04:43:48'),
(21, 23, 'every page loads super fast!', 4, '2024-12-01 04:44:26'),
(22, 23, 'i love the look for everything', 5, '2024-12-01 04:44:36'),
(23, 23, 'should create an app that works with the website. overall enjoy the site', 5, '2024-12-01 04:45:02'),
(24, 23, 'I want more of these kinda sites!', 4, '2024-12-01 04:45:20'),
(26, 1, 'its great', 5, '2024-12-01 20:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `userId` int NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `shippingAddress` text,
  `role` enum('user','admin') DEFAULT 'user',
  `lastLogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`userId`, `firstName`, `lastName`, `userName`, `email`, `passwordHash`, `shippingAddress`, `role`, `lastLogin`) VALUES
(1, 'b', 'smith', 'bsmith', 'bsmith@example.com', '$2y$10$PiAsRsY3Vqv2ZzjnYFwIM.83fxCidlrSuWCroS/MEeIFzqSwuWbTy', '123 First Place', 'admin', '2024-12-01 21:09:45'),
(2, 'p', 'jones', 'pjones', 'pjones@example.com', '$2y$10$azp/WT7ISOrZWcH/7wk0Qul9tgU0ZlrcoxwfZCqqOpKjZmIWvcriK', '456 Second Street', 'user', '2024-12-01 21:09:58'),
(3, 'Josh', 'Beards', 'jbeard', 'jbeard@example.com', '$2y$10$cBXggFlxlE8ekqqTusMFHuosPT6lucgO4unn8nM/bQijL1OwFA9/m', '101 Home Street', 'user', '2024-12-01 01:30:24'),
(4, 'Donovan', 'Edwards', 'dedwards', 'dedwards@example.com', '$2y$10$tvWcOXbSVfVRKDdpRvMwYuV/RqyOqdXL6JQEx04ylWfWy0CPO9Y7S', '4 Ann Arbor Street', 'user', NULL),
(5, 'Kaleel', 'Mullingss', 'kmullings', 'kmullings@example.com', '$2y$10$/Ei2RwZfgvJzGYY8sagjJO0FyBoh0YiTbVNL1yBjpydlGWir1uOFm', '23 Champs Drive', 'user', NULL),
(6, 'Bryce', 'Underwood', 'bunderwood', 'bunderwood@example.com', '$2y$10$KWnv.vd5jVmDqDe5GNrMH.QalNhi2Sts62/LlbCeyRSohBweNcPBK', '1 Champions Circle', 'user', NULL),
(7, 'Lebron', 'James', 'ljames', 'ljames@example.com', '$2y$10$v2.Suvrs4OfftoUsZpgr6Os.OJwLhqXGOXrxNMkPCHOsCEoM82XJa', '123 Lakers ave', 'user', NULL),
(8, 'Michael', 'Jordan', 'mjordan', 'mjordan@example.com', '$2y$10$OhtjUH1RS5MfgQSoIaav.el33uqvPjTpelvQAIY.1aGineONSnX.C', '456 Chicago Street', 'user', NULL),
(9, 'Dave', 'Portnoy', 'dportnoy', 'dportnoy@example.com', '$2y$10$q0u8vV6ebGDNXSr8TponROf649.IaCavctRpklQlegh7A7hKlZggC', '789 Miami Lane', 'user', NULL),
(10, 'Chong', 'Oh', 'coh', 'coh@example.com', '$2y$10$PPIewMn5xQRr3Vg6IuMruO4zsd/hqfhTDMQXFByQ4XVtTlDFHvf6a', '345 David Eccles Street', 'user', NULL),
(11, 'Joe', 'Biden', 'jbiden', 'jbiden@example.com', '$2y$10$RdSyCjKlKm0KqUv8HejVw.J499D.jjw76.rFBp8ToaCCzfyb.hh2m', '111 White House Lane', 'user', NULL),
(12, 'Donald', 'Trump', 'dtrump', 'dtrump@example.com', '$2y$10$cYMcByuLXJDi6avuHdxPHuB3aLYMfrkXo5pnzcYQlZAR2MlK.yYeK', '456 Florida Court', 'user', NULL),
(13, 'Jeff', 'Bezos', 'jbezos', 'jbezos@example.com', '$2y$10$O6zG3E38aSx9z8J9BmY9vOyFlq8ATGEfE3zq0XTrO0e6RFhczR.Q.', '889 Amazon Circle', 'user', NULL),
(14, 'Elon', 'Musk', 'emusk', 'emusk@example.com', '$2y$10$fNcnlVwrEPylFDgItIe8auBcgebRL.gax.NnN4SAhU.mCQOR2aNmm', '101 Space Port', 'user', NULL),
(15, 'Steve', 'Jobs', 'sjobs', 'sjobs@example.com', '$2y$10$LjkNHR2eCT9JtKCofCMxr.DJX6TNnxtaFa3pb7mYcUXmiUS0s95Da', '100 Apple Lane', 'user', NULL),
(16, 'Bill', 'Gates', 'bgates', 'bgates@example.com', '$2y$10$XFEJ8iHnzzdtTPXs5QiXHOW0h38UrJft6uWKXWaeUlijFppazohW2', '200 Micro Street', 'user', NULL),
(17, 'Lionel', 'Messi', 'lmessi', 'lmessi@example.com', '$2y$10$ZvUyVBZLGY90f97eHRFj3eODKDq6fx6sToLwX/vRhrh9QidLp.1p6', '789 Barca Street', 'user', '2024-11-30 21:41:04'),
(18, 'Cristiano', 'Ronaldo', 'cronaldo', 'cronaldo@example.com', '$2y$10$JI3hhQ9benaYBwvqlsjssuu4UUC5i4HeWN0qLuGaNEqakvuOZC5XC', '567 Madrid Place', 'user', '2024-11-30 22:05:02'),
(19, 'Joe', 'Shmoe', 'jshmoe', 'jshmoe@example.com', '$2y$10$P9xkQhZjbvIMA7hcYyaeXuIErtyGghwTYCir1AUpxzdhvHaDg8ysy', '898 Random Court', 'user', NULL),
(21, 'Tom', 'Brady', 'tbrady', 'tbrady@example.com', '$2y$10$63hGAWcbfKotFk4foH3W5OQoWXm7ZWKEZN0NoB1o/I8RDuPob.bB.', '777 Patriots Drive', 'user', NULL),
(23, 'New', 'Guy', 'nguy', 'nguy@example.com', '$2y$10$KF9/9a0Y/K53ObtMS/MDbeuKJrsnTz1gt5JMel7iZRX/v/MDSoqXK', '9886 Best Street', 'user', '2024-12-01 04:35:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CART`
--
ALTER TABLE `CART`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `fk_user_cart` (`userId`);

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `PAYMENTS`
--
ALTER TABLE `PAYMENTS`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `REVIEWS_PRODUCT`
--
ALTER TABLE `REVIEWS_PRODUCT`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `REVIEWS_SITE`
--
ALTER TABLE `REVIEWS_SITE`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CART`
--
ALTER TABLE `CART`
  MODIFY `cartId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  MODIFY `cartItemId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `orderId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  MODIFY `orderItemId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `PAYMENTS`
--
ALTER TABLE `PAYMENTS`
  MODIFY `paymentId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  MODIFY `productId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `REVIEWS_PRODUCT`
--
ALTER TABLE `REVIEWS_PRODUCT`
  MODIFY `reviewId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `REVIEWS_SITE`
--
ALTER TABLE `REVIEWS_SITE`
  MODIFY `reviewId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CART`
--
ALTER TABLE `CART`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USERS` (`userId`);

--
-- Constraints for table `CART_ITEMS`
--
ALTER TABLE `CART_ITEMS`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `CART` (`cartId`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `PRODUCTS` (`productId`),
  ADD CONSTRAINT `fk_user_cart` FOREIGN KEY (`userId`) REFERENCES `USERS` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USERS` (`userId`);

--
-- Constraints for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `ORDERS` (`orderId`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `PRODUCTS` (`productId`);

--
-- Constraints for table `PAYMENTS`
--
ALTER TABLE `PAYMENTS`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USERS` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `REVIEWS_PRODUCT`
--
ALTER TABLE `REVIEWS_PRODUCT`
  ADD CONSTRAINT `reviews_product_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USERS` (`userId`),
  ADD CONSTRAINT `reviews_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `PRODUCTS` (`productId`);

--
-- Constraints for table `REVIEWS_SITE`
--
ALTER TABLE `REVIEWS_SITE`
  ADD CONSTRAINT `reviews_site_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USERS` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
