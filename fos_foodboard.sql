-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 09:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fos_foodboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `fos_cat`
--

CREATE TABLE `fos_cat` (
  `uid` int(5) NOT NULL,
  `client_uid` int(5) NOT NULL,
  `cat_title` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `date_edited` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_cat`
--

INSERT INTO `fos_cat` (`uid`, `client_uid`, `cat_title`, `date_created`, `date_edited`) VALUES
(1, 15, 'All', '12-10-2020 23:40:38', ''),
(4, 15, 'Main', '31-10-2020 04:27:39', '31-10-2020 04:27:41'),
(5, 17, 'All', '03-11-2020 21:51:56', ''),
(6, 18, 'All', '05-11-2020 04:27:23', ''),
(7, 19, 'All', '05-11-2020 04:46:58', ''),
(8, 20, 'All', '05-11-2020 04:49:18', ''),
(9, 21, 'All', '05-11-2020 04:56:55', ''),
(10, 22, 'All', '06-11-2020 17:24:48', ''),
(11, 23, 'All', '07-11-2020 22:36:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `fos_client`
--

CREATE TABLE `fos_client` (
  `uid` int(5) NOT NULL,
  `client_username` varchar(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_pass` varchar(50) NOT NULL,
  `client_res_name` varchar(50) NOT NULL,
  `client_status` varchar(50) NOT NULL,
  `client_qr` varchar(50) NOT NULL,
  `client_qr_image` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_client`
--

INSERT INTO `fos_client` (`uid`, `client_username`, `client_email`, `client_pass`, `client_res_name`, `client_status`, `client_qr`, `client_qr_image`, `date_created`, `created_by`) VALUES
(1, 'ryan', 'ryan@mail.com', 'MTIz', 'Spades', '', '', '', '04-10-2020 03:13:07', 'USER'),
(2, 'ryan2', 'd@mail.com', 'MTIzNDU=', 'Spades2', '', '', '', '04-10-2020 04:10:10', 'USER'),
(3, 'ryan17', 'mail@mail.com', 'b2tva29r', 'Lai Cafe', '', '', '', '04-10-2020 18:27:11', 'USER'),
(4, 'test', 'test@mail.com', 'dGVzdA==', 'New Thing', '', '', '', '08-10-2020 13:35:11', 'USER'),
(5, 'test123', 'test123@mail.com', 'dGVzdDEyMw==', 'McD', '', '', '', '08-10-2020 13:36:46', 'USER'),
(6, 'bbg', 'bbg@mail.com', 'YmJn', 'Burger Bagus', '', '', '', '08-10-2020 13:38:21', 'USER'),
(7, 'pelita', 'pelita@mail.com', 'MTIz', 'Pelita', '', '', '', '08-10-2020 13:41:07', 'USER'),
(8, 'helo', 'helo@mail.com', 'MTIz', 'Sampah', '', '', '', '08-10-2020 13:42:38', 'USER'),
(9, 'helo1', 'helo1@mail.com', 'MTIz', 'Sampah2', '', '', '', '08-10-2020 13:43:09', 'USER'),
(10, 'ryan3', 'ryan3@mail.com', 'MTIz', 'Sampah13', '', '', '', '08-10-2020 13:46:06', 'USER'),
(11, 'test1234', 'test1234@mail.com', 'MTIz', 'New Restaurant', '', '', '', '08-10-2020 13:48:19', 'USER'),
(12, 'kapitan', 'kapitan@mail.com', 'MTIz', 'Kapitan', '', '', '', '08-10-2020 13:52:50', 'USER'),
(13, 'testtest', 'test24@mail.com', 'MTIz', 'testrun', '', '', '', '08-10-2020 14:03:01', 'USER'),
(14, 'ryanlai', 'ryanlai@mail.com', 'MTIz', 'Burger Place', '', 'true', 'assets/qrcodes/Burger Place5f9b1005a6c6e.png', '08-10-2020 15:07:21', 'USER'),
(15, 'testlocal', 'test232@mail.com', 'MTIz', 'local', '', 'true', 'assets/qrcodes/local5f9b0d31bbb22.png', '12-10-2020 23:40:38', 'USER'),
(17, 'likethis', 'mypride@mail.com', 'MzIx', 'notlikethis', '', 'true', 'assets/qrcodes/notlikethis5fa1608d6772d.png', '03-11-2020 21:51:56', 'USER'),
(18, 'name', 'mailer@mail.com', 'MTIz', 'nameless', '', 'false', '', '05-11-2020 04:27:23', 'USER'),
(19, 'welcome', 'mail3@mail.com', 'MTIz', 'welcome', '', 'false', '', '05-11-2020 04:46:58', 'USER'),
(20, 'dw', '123@mail.com', 'aGVsbG8=', 'dw', '', 'false', '', '05-11-2020 04:49:18', 'USER'),
(21, 'helo23', 'helo35@mail.com', 'MTIz', 'helo23', '', 'false', '', '05-11-2020 04:56:55', 'USER'),
(22, 'testing123', 'xxryanlaixx@gmail.com', 'MTIz', 'shit', '', 'false', '', '06-11-2020 17:24:48', 'USER'),
(23, 'localtest', 'localtest@mail.com', 'MTIz', 'localtest', '', 'false', '', '07-11-2020 22:36:47', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `fos_landing`
--

CREATE TABLE `fos_landing` (
  `uid` int(5) NOT NULL,
  `client_uid` int(5) NOT NULL,
  `landing_desc` varchar(300) NOT NULL,
  `landing_location` varchar(100) NOT NULL,
  `landing_contact` varchar(50) NOT NULL,
  `landing_image` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `date_edited` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_landing`
--

INSERT INTO `fos_landing` (`uid`, `client_uid`, `landing_desc`, `landing_location`, `landing_contact`, `landing_image`, `date_created`, `date_edited`) VALUES
(1, 0, 'Your restaurants description goes in here. This is a default description. You are able to change thi', 'Your restaurants location goes in here. This is a default location. You are able to change this in t', 'Your restaurants contact goes in here. This is a d', '', '08-10-2020 13:46:06', ''),
(2, 0, 'Your restaurants description goes in here. This is a default description. You are able to change thi', 'Your restaurants location goes in here. This is a default location. You are able to change this in t', 'Your restaurants contact goes in here. This is a d', '', '08-10-2020 13:48:19', ''),
(3, 12, 'Your restaurants description goes in here. This is a default description. You are able to change thi', 'Your restaurants location goes in here. This is a default location. You are able to change this in t', 'Your restaurants contact goes in here. This is a d', '', '08-10-2020 13:52:50', ''),
(4, 13, 'dwdaw', 'dwadwa', '(213) 213-21__', 'assets/landing-bg/card-img-3.jpg', '08-10-2020 14:03:01', '08-10-2020 14:34:25'),
(5, 14, 'This is a default description. You are able to change this in the dashboard.', 'This is a default location. You are able to change this in the dashboard.', '000-0000000', '', '08-10-2020 15:07:21', ''),
(6, 15, 'good home cook food', 'home', '(016) 415-7901', 'assets/landing-bg/smiling sun.jpg', '12-10-2020 23:40:38', '31-10-2020 04:30:43'),
(7, 17, 'This is a default description. You are able to change this in the dashboard.', 'This is a default location. You are able to change this in the dashboard.', '000-0000000', 'assets/landing-bg/card-img-3.jpg', '03-11-2020 21:51:56', ''),
(8, 18, 'nameless desc', 'home', '(222) 222-2222', 'assets/landing-bg/card-img-3.jpg', '05-11-2020 04:27:23', ''),
(9, 19, 'welcome', 'welcome', '(000) 000-0000', 'assets/landing-bg/card-img-3.jpg', '05-11-2020 04:46:58', ''),
(10, 20, 'dw', 'dw', '(222) 222-2222', 'assets/landing-bg/sadge.jpg', '05-11-2020 04:49:18', ''),
(11, 21, '', '', '', 'assets/landing-bg/smiling sun.jpg', '05-11-2020 04:56:55', ''),
(12, 22, 'test', '', '', 'assets/landing-bg/sadge.jpg', '06-11-2020 17:24:48', ''),
(13, 23, 'The patty is pan fried, grilled, smoked or flame broiled. Hamburgers are often served with cheese,\r\n                lettuce, tomato, onion, pickles, b', '1-1-22, Ideal Avenue, Medan Kampung Relau 1, Kampung Seberang Paya, 11900 Bayan Lepas, Pulau Pinang', '(012) 478-9987', 'assets/landing-bg/promo-bg.jpg', '07-11-2020 22:36:47', '07-11-2020 22:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `fos_order`
--

CREATE TABLE `fos_order` (
  `uid` int(5) NOT NULL,
  `client_uid` int(5) NOT NULL,
  `order_number` int(5) NOT NULL,
  `order_cusid` int(5) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `date_edited` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fos_prod`
--

CREATE TABLE `fos_prod` (
  `uid` int(5) NOT NULL,
  `client_uid` int(5) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_image` varchar(100) NOT NULL,
  `prod_desc` varchar(100) NOT NULL,
  `prod_price` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `date_edited` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_prod`
--

INSERT INTO `fos_prod` (`uid`, `client_uid`, `prod_name`, `prod_image`, `prod_desc`, `prod_price`, `date_created`, `date_edited`) VALUES
(2, 1, 'tau eu bak', '', 'good shit', '5', '08-10-2020 10:47:40', NULL),
(3, 1, 'food', 'assets/uploads/', 'yum', '5', '08-10-2020 11:09:17', NULL),
(4, 1, 'noodle', 'assets/uploads/', 'springy noodle', '5', '08-10-2020 11:11:31', NULL),
(5, 1, 'noodle', 'assets/uploads/', '', '5', '08-10-2020 11:14:44', NULL),
(6, 1, 'noodle', 'assets/uploads/', '', '5', '08-10-2020 11:14:45', NULL),
(7, 1, 'noodle', 'assets/uploads/', '', '5', '08-10-2020 11:14:45', NULL),
(8, 1, 'dwadw', 'assets/uploads/', 'dwadwa', '12', '08-10-2020 11:15:48', NULL),
(9, 1, 'dwadw', 'assets/uploads/', 'dwadwa', '12', '08-10-2020 11:16:49', NULL),
(10, 1, 'chicken', 'assets/uploads/', 'fried ', '5', '08-10-2020 11:21:03', NULL),
(11, 1, 'chicken', 'assets/uploads/', 'fried ', '5', '08-10-2020 11:22:42', NULL),
(12, 1, 'fried chicken', 'assets/uploads/lp-3.jpg', 'tasty ', '6', '08-10-2020 11:23:04', NULL),
(13, 1, 'fried chicken', 'assets/uploads/', '', '6', '08-10-2020 11:24:42', NULL),
(14, 1, 'vege', 'assets/uploads/lp-1.jpg', 'veg', '6', '08-10-2020 11:26:25', NULL),
(15, 1, 'big image', 'assets/uploads/', '', '5', '08-10-2020 11:28:15', NULL),
(16, 1, 'big image ', 'assets/uploads/GAMEFOUND.png', '', '4', '08-10-2020 11:29:15', NULL),
(17, 1, 'big image', 'assets/uploads/dog.jpg', '', '2', '08-10-2020 11:29:39', NULL),
(18, 3, 'capsican', 'assets/uploads/lp-2.jpg', 'spices', '6', '08-10-2020 11:35:41', NULL),
(19, 1, 'decimal', 'assets/uploads/alert.png', '', '4.36', '08-10-2020 12:01:35', NULL),
(20, 3, 'noodle', 'assets/uploads/', '', '2', '08-10-2020 12:08:08', NULL),
(21, 1, 'burger', 'assets/uploads/', '', 'RM16__', '08-10-2020 12:49:16', NULL),
(22, 1, 'burger special', 'assets/uploads/', '', '2.00', '08-10-2020 12:54:29', NULL),
(23, 1, 'cheese fries', 'assets/uploads/', 'yum', '5', '08-10-2020 13:07:54', NULL),
(24, 12, 'tikka massala', 'assets/uploads/', '', '4', '08-10-2020 13:57:16', NULL),
(25, 14, 'special burger', 'assets/uploads/lp-3.jpg', 'yummy', '11', '08-10-2020 15:11:19', NULL),
(33, 15, 'noodle', 'assets/uploads/smiling sun.jpg', 'chicken soup', '10', '02-11-2020 01:23:12', NULL),
(34, 23, 'Cheeseburger', 'assets/images/eco-product-img-1.png', 'Mozzarella cheese with french fries on the side', '14', '07-11-2020 23:06:17', NULL),
(35, 23, 'Chicken Noodle', 'assets/images/eco-product-img-1.png', 'Chicken Soup ', '12', '08-11-2020 17:23:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fos_queue`
--

CREATE TABLE `fos_queue` (
  `uid` int(5) NOT NULL,
  `client_uid` int(5) NOT NULL,
  `queue_number` varchar(50) NOT NULL,
  `queue_cus_name` varchar(50) NOT NULL,
  `queue_cus_contact` varchar(50) NOT NULL,
  `queue_cus_size` varchar(50) NOT NULL,
  `queue_status` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fos_rcvrpass`
--

CREATE TABLE `fos_rcvrpass` (
  `uid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_rcvrpass`
--

INSERT INTO `fos_rcvrpass` (`uid`, `email`, `token`) VALUES
(4, 'xxryanlaixx@gmail.com', '57bd2718c3d21258db1cf3876752f0ea21f1b0726a8a20c3b1'),
(5, '123@mail.com', '426f2870dec467bac7a99d327e17b8ef61c0aaf26adc11a6fb'),
(6, '123@mail.com', '8b2dd1fcad6417fefa2e9a33e643fa8c414a2cf7cbf01826ba'),
(7, '123@mail.com', '929cc69113910fc3585a4265e590152fad6feadef65fd43008'),
(8, 'xxryanlaixx@gmail.com', '01d5571dc4394912ff221f697bfa65cd43f5d7cf48f6e2c3c8'),
(9, 'xxryanlaixx@gmail.com', 'bdc114a154a7e19179fdb662b87008c1ae1f1c4f494f654dcc'),
(10, 'xxryanlaixx@gmail.com', '5ebd1557d20fc2fae8754fd66e0ff2e3ccf06b81147c0b397e'),
(11, 'xxryanlaixx@gmail.com', '0449036d84ee80209ff26a0a967e69a30f7e352d261fd520fb'),
(12, 'xxryanlaixx@gmail.com', '732bb2071df11a4b85032345259c53a00456d0e5e9282a1d26'),
(13, 'xxryanlaixx@gmail.com', 'f036664cd836e259160aea25cac931ea9dc845229fbf4af1bac89d5031b6b15169457ddc135807a8cc471b6334faa359bdd7'),
(14, 'xxryanlaixx@gmail.com', '33481e8253004a7ced63ccbcce951ea244aed5d138fb40ba38fc7b2b2e9072b23aebd7e422be1bdf20351e6182b4c10dab14'),
(15, 'xxryanlaixx@gmail.com', '81a3acd2ef6b5709ce89f0f466cb555a30bac3a7c43238ed8a7bd1a5f41c191d8f7af4b6c2acd65a058a774cad7a541ee4d1');

-- --------------------------------------------------------

--
-- Table structure for table `fos_review`
--

CREATE TABLE `fos_review` (
  `uid` int(10) NOT NULL,
  `client_uid` int(10) NOT NULL,
  `review_content` varchar(150) NOT NULL,
  `review_stars` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_review`
--

INSERT INTO `fos_review` (`uid`, `client_uid`, `review_content`, `review_stars`, `date_created`) VALUES
(1, 19, 'food is good', '1', '07-11-2020 16:58:26'),
(2, 19, 'dwd', '3', '07-11-2020 17:00:29'),
(3, 19, 'dfwa', '5', '07-11-2020 17:27:24'),
(4, 19, 'y', '4', '07-11-2020 17:59:42'),
(5, 12, 'good\r\n', '1', '07-11-2020 18:17:57'),
(6, 23, 'lousy service', '1', '10-11-2020 05:48:20'),
(7, 23, 'helo', '2', '10-11-2020 16:22:27'),
(8, 23, 'good food nice environment', '5', '11-11-2020 17:20:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fos_cat`
--
ALTER TABLE `fos_cat`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `fos_client`
--
ALTER TABLE `fos_client`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `fos_landing`
--
ALTER TABLE `fos_landing`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `fos_order`
--
ALTER TABLE `fos_order`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `fos_prod`
--
ALTER TABLE `fos_prod`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `fos_queue`
--
ALTER TABLE `fos_queue`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `fos_rcvrpass`
--
ALTER TABLE `fos_rcvrpass`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `fos_review`
--
ALTER TABLE `fos_review`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fos_cat`
--
ALTER TABLE `fos_cat`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fos_client`
--
ALTER TABLE `fos_client`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `fos_landing`
--
ALTER TABLE `fos_landing`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fos_order`
--
ALTER TABLE `fos_order`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fos_prod`
--
ALTER TABLE `fos_prod`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `fos_queue`
--
ALTER TABLE `fos_queue`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `fos_rcvrpass`
--
ALTER TABLE `fos_rcvrpass`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fos_review`
--
ALTER TABLE `fos_review`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
