-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 05:36 AM
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
-- Table structure for table `fos_admin`
--

CREATE TABLE `fos_admin` (
  `uid` int(5) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_admin`
--

INSERT INTO `fos_admin` (`uid`, `admin_username`, `admin_pass`, `date_created`) VALUES
(1, 'admin', 'MTIz', '04-10-2020 03:13:07');

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
(5, 17, 'All', '03-11-2020 21:51:56', ''),
(6, 18, 'All', '05-11-2020 04:27:23', ''),
(7, 19, 'All', '05-11-2020 04:46:58', ''),
(8, 20, 'All', '05-11-2020 04:49:18', ''),
(9, 21, 'All', '05-11-2020 04:56:55', ''),
(10, 22, 'All', '06-11-2020 17:24:48', ''),
(11, 23, 'All', '07-11-2020 22:36:47', ''),
(12, 24, 'All', '06-12-2020 00:44:38', '');

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
(1, 'admin', 'ryan@mail.com', 'MTIz', 'Spades', '', '', '', '04-10-2020 03:13:07', 'USER'),
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
(17, 'likethis', 'mypride@mail.com', 'MzIx', 'notlikethis', '', 'true', 'assets/qrcodes/notlikethis5fa1608d6772d.png', '03-11-2020 21:51:56', 'USER'),
(18, 'name', 'mailer@mail.com', 'MTIz', 'nameless', '', 'false', '', '05-11-2020 04:27:23', 'USER'),
(19, 'welcome', 'mail3@mail.com', 'MTIz', 'welcome', '', 'false', '', '05-11-2020 04:46:58', 'USER'),
(20, 'dw', '123@mail.com', 'aGVsbG8=', 'dw', '', 'false', '', '05-11-2020 04:49:18', 'USER'),
(21, 'helo23', 'helo35@mail.com', 'MTIz', 'helo23', '', 'false', '', '05-11-2020 04:56:55', 'USER'),
(22, 'testing123', 'xxryanlaixx@gmail.com', 'MTIz', 'shit', '', 'false', '', '06-11-2020 17:24:48', 'USER'),
(23, 'localtest', 'localtest@mail.com', 'MTIz', 'localtest', '', 'true', 'assets/qrcodes/localtest5fadaf15d901b.png', '07-11-2020 22:36:47', 'USER'),
(24, 'admin_test1', 'admin_test1@mail.com', 'MTIzNA==', 'admin_test1', '', 'false', '', '06-12-2020 00:44:38', 'USER');

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
(3, 12, 'Your restaurants description goes in here. This is a default description. You are able to change thi', 'Your restaurants location goes in here. This is a default location. You are able to change this in t', 'Your restaurants contact goes in here. This is a d', '', '08-10-2020 13:52:50', ''),
(4, 13, 'dwdaw', 'dwadwa', '(213) 213-21__', 'assets/landing-bg/card-img-3.jpg', '08-10-2020 14:03:01', '08-10-2020 14:34:25'),
(5, 14, 'This is a default description. You are able to change this in the dashboard.', 'This is a default location. You are able to change this in the dashboard.', '000-0000000', '', '08-10-2020 15:07:21', ''),
(7, 17, 'This is a default description. You are able to change this in the dashboard.', 'This is a default location. You are able to change this in the dashboard.', '000-0000000', 'assets/landing-bg/card-img-3.jpg', '03-11-2020 21:51:56', ''),
(8, 18, 'nameless desc', 'home', '(222) 222-2222', 'assets/landing-bg/card-img-3.jpg', '05-11-2020 04:27:23', ''),
(9, 19, 'welcome', 'welcome', '(000) 000-0000', 'assets/landing-bg/card-img-3.jpg', '05-11-2020 04:46:58', ''),
(10, 20, 'dw', 'dw', '(222) 222-2222', 'assets/landing-bg/sadge.jpg', '05-11-2020 04:49:18', ''),
(11, 21, '', '', '', 'assets/landing-bg/smiling sun.jpg', '05-11-2020 04:56:55', ''),
(12, 22, 'test', '', '', 'assets/landing-bg/sadge.jpg', '06-11-2020 17:24:48', ''),
(13, 23, 'We at Star Burger plan to establish a business structure that is transparent and simple. Our patty is pan fried, grilled, smoked or flame broiled. Our Hamburgers are often served with cheese, lettuce, tomato, onion, pickles, and our special sauce.', '1-1-22, Ideal Avenue, Medan Kampung Relau 1, Kampung Seberang Paya, 11900 Bayan Lepas, Pulau Pinang', '(012) 478-9987', 'assets/landing-bg/promo-bg.jpg', '07-11-2020 22:36:47', '07-12-2020 11:46:23'),
(14, 24, 'admin_test1', 'penang,malaysia1', '222111', 'client/assets/landing-bg/sadge.jpg', '06-12-2020 00:44:38', '06-12-2020 02:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `fos_order`
--

CREATE TABLE `fos_order` (
  `uid` int(5) NOT NULL,
  `client_uid` int(5) NOT NULL,
  `order_cusid` int(5) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `date_edited` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_order`
--

INSERT INTO `fos_order` (`uid`, `client_uid`, `order_cusid`, `order_status`, `date_created`, `date_edited`) VALUES
(31, 23, 6254, 'PENDING', '07-12-2020 11:09:10', ''),
(32, 23, 6424, 'PENDING', '07-12-2020 11:26:12', ''),
(33, 23, 8681, 'PENDING', '07-12-2020 11:40:50', ''),
(34, 23, 2859, 'PENDING', '07-12-2020 12:30:21', '');

-- --------------------------------------------------------

--
-- Table structure for table `fos_orderitem`
--

CREATE TABLE `fos_orderitem` (
  `uid` int(5) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_quantity` varchar(50) NOT NULL,
  `prod_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fos_orderitem`
--

INSERT INTO `fos_orderitem` (`uid`, `order_number`, `prod_name`, `prod_quantity`, `prod_price`) VALUES
(54, '31', 'Char Koay Teow', '1', '9'),
(55, '31', 'Maggie goreng', '1', '10'),
(56, '31', 'Chicken Rice', '1', '16.50'),
(57, '32', 'Char Koay Teow', '2', '9'),
(58, '32', 'Chicken Rice', '1', '16.50'),
(59, '33', 'Cheeseburger', '1', '14'),
(60, '33', 'Char Koay Teow', '1', '9'),
(61, '34', 'Chicken Noodle', '1', '12'),
(62, '34', 'Char Koay Teow', '1', '9');

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
(19, 1, 'decimal', 'assets/uploads/alert.png', '', '4.36', '08-10-2020 12:01:35', NULL),
(21, 1, 'burger', 'assets/uploads/', '', 'RM16__', '08-10-2020 12:49:16', NULL),
(22, 1, 'burger special', 'assets/uploads/', '', '2.00', '08-10-2020 12:54:29', NULL),
(23, 1, 'cheese fries', 'assets/uploads/', 'yum', '5', '08-10-2020 13:07:54', NULL),
(24, 12, 'tikka massala', 'assets/uploads/', '', '4', '08-10-2020 13:57:16', NULL),
(25, 14, 'special burger', 'assets/uploads/lp-3.jpg', 'yummy', '11', '08-10-2020 15:11:19', NULL),
(34, 23, 'Cheeseburger', 'assets/uploads/cheeseburger.png', 'Mozzarella cheese with french fries on the side', '14', '07-11-2020 23:06:17', NULL),
(35, 23, 'Chicken Noodle', 'assets/uploads/chickennoodle.jpg', 'Chicken Soup ', '12', '08-11-2020 17:23:39', NULL),
(36, 23, 'Spaghetti Carbonara', 'assets/uploads/carbonara.jpg', 'Smoked beef spaghetti carbonara is classic pasta dish for people that can\'t eat pork product.', '22', '13-11-2020 04:49:38', NULL),
(37, 23, 'Chicken Chop', 'assets/uploads/cc.jpg', 'Served with brown sauce', '10', '13-11-2020 04:50:40', NULL),
(38, 23, 'Char Koay Teow', 'assets/uploads/ckt.jpg', 'Chinese lap cheong (sausage), eggs, bean sprouts, and chives in a mix of soy sauce.', '9', '13-11-2020 04:52:17', NULL),
(39, 23, 'Maggie goreng', 'assets/uploads/mg.jpg', 'chicken, and veg', '10', '07-12-2020 10:58:00', NULL),
(40, 23, 'Chicken Rice', 'assets/uploads/cr.jpg', 'soy sauce with oiled rice', '16.50', '07-12-2020 10:59:02', '07-12-2020 11:00:53');

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

--
-- Dumping data for table `fos_queue`
--

INSERT INTO `fos_queue` (`uid`, `client_uid`, `queue_number`, `queue_cus_name`, `queue_cus_contact`, `queue_cus_size`, `queue_status`, `date_created`) VALUES
(157, 23, '1', 'jp', '123', '22', 'READY', '07-12-2020 05:06:32'),
(160, 23, '2', 'rytab', '23', '2', 'WAITING', '07-12-2020 05:10:21');

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
(15, 'xxryanlaixx@gmail.com', '81a3acd2ef6b5709ce89f0f466cb555a30bac3a7c43238ed8a7bd1a5f41c191d8f7af4b6c2acd65a058a774cad7a541ee4d1'),
(16, 'xxryanlaixx@gmail.com', '4c9e8a4330e5c0405642916ade76aece0eadd15b5624589111657fc90f5fcf72714598d3b102476d62a8362086fae92bc45b');

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
(7, 23, 'will come again and good service', '4', '10-11-2020 16:22:27'),
(8, 23, 'good food nice environment', '5', '11-11-2020 17:20:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fos_admin`
--
ALTER TABLE `fos_admin`
  ADD PRIMARY KEY (`uid`);

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
-- Indexes for table `fos_orderitem`
--
ALTER TABLE `fos_orderitem`
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
-- AUTO_INCREMENT for table `fos_admin`
--
ALTER TABLE `fos_admin`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fos_cat`
--
ALTER TABLE `fos_cat`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fos_client`
--
ALTER TABLE `fos_client`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `fos_landing`
--
ALTER TABLE `fos_landing`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fos_order`
--
ALTER TABLE `fos_order`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `fos_orderitem`
--
ALTER TABLE `fos_orderitem`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `fos_prod`
--
ALTER TABLE `fos_prod`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `fos_queue`
--
ALTER TABLE `fos_queue`
  MODIFY `uid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `fos_rcvrpass`
--
ALTER TABLE `fos_rcvrpass`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fos_review`
--
ALTER TABLE `fos_review`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
