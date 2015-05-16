-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2015 at 01:51 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(2, 'Admin'),
(6, 'Executive'),
(3, 'Hotel'),
(4, 'Manager'),
(1, 'Super Admin'),
(5, 'Trainee'),
(7, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_hotel`
--

CREATE TABLE IF NOT EXISTS `hotel_hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `initialbalance` double NOT NULL,
  `location` varchar(255) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_hotel`
--

INSERT INTO `hotel_hotel` (`id`, `name`, `initialbalance`, `location`, `user`) VALUES
(5, 'Elysium Resort (Alibaug)', 3000, 'Alibaug', 1),
(6, 'Indus Valley(Lonavala)', 0, 'Lonavala', 1),
(7, 'Icchapurti Sai Residency (Shirdi)', 0, 'Shirdi', 1),
(8, 'Horseland Hotel and Mountain SPA (Matheran)', 0, 'Matheran', 1),
(9, 'Hotel Saikripa Imperial (Daman)', 0, 'Daman', 1),
(10, 'Mohili Meadows Resorts (Karjat)', 0, 'Karjat', 1),
(11, 'Yash Club & Resort (Bhandardara)', 0, 'Bhandardara', 1),
(12, 'Hotel Jawahar (Ulhasnagar)', 0, 'Ulhasnagar', 1),
(13, 'Midway Park Resort (Shahpur)', 0, 'Shahpur', 1),
(14, 'Dadra Resort (Dadra )', 0, 'Dadra', 1),
(15, 'Sargam Water Park (Kaman)', 0, 'Kaman', 1),
(16, 'Flamingo Resort (Manali)', 0, 'Manali', 1),
(17, 'Retreat Anjuna (Goa)', 0, 'Goa', 1),
(18, 'Hotel Mount View (Kodaikanal)', 0, 'Kodaikanal', 1),
(19, 'Golden Heights Enclave (Darjeeling)', 0, 'Darjeeling', 1),
(20, 'Elysium Resort (Alibaug)1', 0, 'Alibaug', 1),
(21, 'Kalyani Village Resort (Vajreshwari)', 2800, 'Vajreshwari', 1),
(22, 'Ashwin Hotel (Igatpuri)', 5500, 'Igatpuri', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_log`
--

CREATE TABLE IF NOT EXISTS `hotel_log` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_log`
--

INSERT INTO `hotel_log` (`id`, `admin`, `user`, `text`) VALUES
(1, 4, 1, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_order`
--

CREATE TABLE IF NOT EXISTS `hotel_order` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `hotel` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `userrate` varchar(255) NOT NULL,
  `hotelrate` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `rooms` int(11) NOT NULL,
  `amount` float NOT NULL,
  `profit` float NOT NULL,
  `checkintime` varchar(255) NOT NULL,
  `checkouttime` varchar(255) NOT NULL,
  `foodpackage` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_order`
--

INSERT INTO `hotel_order` (`id`, `user`, `admin`, `hotel`, `days`, `userrate`, `hotelrate`, `status`, `price`, `timestamp`, `checkin`, `checkout`, `adult`, `children`, `rooms`, `amount`, `profit`, `checkintime`, `checkouttime`, `foodpackage`) VALUES
(1, 1, 1, 1, '30 days', '22', '11', 1, '400', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(2, 14, 1, 1, '30 days', '22', '11', 1, '400', '2015-04-29 04:46:35', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(3, 1, 1, 2, '30 days', '22', '11', 1, '400', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(4, 1, 1, 3, '20 days', '10000', '11000', 2, '2000000', '2015-04-25 10:41:27', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(5, 14, 1, 1, '20 days', '40000', '30000', 2, '50000', '2015-04-27 07:16:43', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, '', '', ''),
(6, 16, 1, 1, '2', '800', '700', 2, '3200', '2015-05-01 06:43:54', '2015-03-02', '2015-03-04', 2, 0, 1, 2800, 400, '', '', ''),
(7, 1, 1, 5, '3', '3000', '2000', 1, '9000', '2015-05-09 05:42:19', '2015-05-01', '2015-05-10', 3, 0, 1, 6000, 3000, '12 PM', '10 AM', 'lunch'),
(8, 20, 1, 22, '2', '800', '700', 2, '3200', '2015-05-11 08:20:51', '2015-05-13', '2015-05-15', 2, 0, 1, 2700, 500, '12 PM', '10 AM', 'Breakfast And Lunch'),
(9, 19, 1, 22, '2', '800', '700', 0, '3200', '2015-05-11 08:29:03', '2015-05-16', '2015-05-17', 2, 0, 1, 2800, 400, '0', '0', '0'),
(10, 20, 1, 21, '2', '800', '700', 0, '3200', '2015-05-11 09:27:41', '2015-05-16', '2015-05-17', 2, 0, 1, 2800, 400, '0', '0', '0'),
(11, 19, 1, 5, '2', '800', '700', 0, '3200', '2015-05-11 10:54:42', '2015-05-14', '2015-05-16', 2, 0, 1, 2800, 400, '0', '0', '0'),
(12, 14, 1, 5, '2', '800', '700', 2, '3200', '2015-05-11 11:06:13', '2015-05-15', '2015-05-17', 2, 0, 1, 2800, 400, '12 PM', '10 PM', 'lunch');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_transaction`
--

CREATE TABLE IF NOT EXISTS `hotel_transaction` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `hotel` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `paymentmethod` varchar(255) NOT NULL,
  `bankname` varchar(255) DEFAULT NULL,
  `branchname` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chequedate` date DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_transaction`
--

INSERT INTO `hotel_transaction` (`id`, `user`, `hotel`, `amount`, `status`, `paymentmethod`, `bankname`, `branchname`, `chequeno`, `chequedate`, `timestamp`) VALUES
(1, 1, 1, '20000', 2, 'Cheque', 'SBI', 'Thane', '9098', '2015-05-23', '0000-00-00 00:00:00'),
(2, 4, 5, '5000', 2, 'Cheque', 'HDFC', 'KURLA', '1056', '2015-05-21', '0000-00-00 00:00:00'),
(3, 1, 5, '20000', 2, 'Cash', '', '', '', '0000-00-00', '0000-00-00 00:00:00'),
(4, 1, 5, '500', 2, 'Cash', '', '', '', '0000-00-00', '0000-00-00 00:00:00'),
(5, 1, 5, '2100', 2, 'Cash', '', '', '', '0000-00-00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(5, 'Managers', '', '', 'site/viewmanagerbyadmin', 1, 0, 1, 2, 'icon-user'),
(6, 'Hotel', '', '', 'site/viewhotel', 1, 0, 1, 3, 'icon-user'),
(7, 'Orders', '', '', 'site/vieworder', 1, 0, 1, 4, 'icon-user'),
(8, 'Transaction', '', '', 'site/viewtransaction', 1, 0, 1, 5, 'icon-user'),
(9, 'Log', '', '', 'site/viewlog', 1, 0, 1, 6, 'icon-user'),
(10, 'Edit Profile', '', '', 'site/edithoteluserbyhotel', 1, 0, 1, 8, 'icon-user'),
(11, 'Dashboard', '', '', 'site/hoteldashboard', 1, 0, 1, 7, 'icon-user'),
(12, 'Hotel Orders', '', '', 'site/viewhotelorderbyhotel', 1, 0, 1, 10, 'icon-user'),
(13, 'Hotel Transactions', '', '', 'site/viewtransactionbyhotel', 1, 0, 1, 11, 'icon-user'),
(14, 'Dashboard', '', '', 'site/managerdashboard', 1, 0, 1, 12, 'icon-dashboard'),
(15, 'Trainee', '', '', 'site/viewtraineebymanager', 1, 0, 1, 13, 'icon-dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 4),
(15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Confirm'),
(3, 'Cancel'),
(4, 'Refund Applied'),
(5, 'Refunded');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` int(11) NOT NULL,
  `json` text NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `profession` varchar(255) NOT NULL,
  `vouchernumber` varchar(255) NOT NULL,
  `validtill` date NOT NULL,
  `executive` int(11) NOT NULL,
  `manager` int(11) NOT NULL,
  `hotel` int(11) NOT NULL,
  `trainee` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `age`, `gender`, `address`, `contact`, `mobile`, `dob`, `profession`, `vouchernumber`, `validtill`, `executive`, `manager`, `hotel`, `trainee`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', 0, '', '', 0, '', '', '', '0000-00-00', '', 'mh1234', '0000-00-00', 0, 0, 0, 0),
(4, 'pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, 'pratik', '1', 1, '', '', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 0, 0, 0, 0),
(5, 'wohlig123', 'wohlig123', 'wohlig1@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 0, 0, 0, 0),
(6, 'wohlig1', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, '', '', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 0, 0, 0, 0),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 1, '2014-10-17 06:22:29', 1, NULL, '', '', 0, '', '', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 0, 0, 0, 0),
(9, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@email.com', 4, '2014-12-03 11:06:19', 1, '', '', '123', 1, 'demojson', '23', 1, 'Karjat India', '765757657657', '767678678787', '1991-12-12', 'Web Developer', '123456787', '2015-04-26', 0, 0, 0, 0),
(13, 'MMMMM', 'a208e5837519309129fa466b0c68396b', 'aaa3@email.com', 5, '2014-12-04 06:55:42', 2, NULL, '', '1', 2, 'userjson', '22', 1, 'asaxas', '8768768', '878787', '2015-04-25', 'jbsahxjashb', 'v6776uyg76t', '2015-04-25', 0, 9, 0, 0),
(14, 'avinashghare', 'a208e5837519309129fa466b0c68396b', 'avinash66@wohlig.com', 5, '2015-04-25 12:19:20', 2, '', '', '', 1, 'json', '23', 1, 'karjat', '867687', '87687', '1109-12-20', 'ausankjsa', 'ksajnajks', '2015-04-11', 0, 9, 0, 0),
(15, 'Mahesh', '7cb323203b1306810d65271d8e9228ef', 'mahesh@wohlig.com', 6, '2015-04-27 09:53:53', 2, '', '', '', 1, 'json', '24', 1, 'Shahad Kalyan', '9876757467', '987987989', '2015-04-17', 'BCS', '1234', '2015-04-30', 1, 9, 0, 0),
(16, 'Sapana', '02b732785a9444ee5ea6990f8a48ef65', 'sapana@wohlig.com', 4, '2015-04-28 09:05:41', 1, '', '', '', 1, 'json', '24', 1, 'karjat raigad', '9029888888', '89898', '2015-04-19', 'Web Designer', '1234567', '2015-04-16', 0, 0, 0, 0),
(17, 'Pooja', '4bcc674371a91bf32377cd878d754527', 'pooja@wohlig.com', 4, '2015-04-28 09:12:31', 2, '', '', '', 1, 'json', '22', 0, 'Ghatkopar', '98798987987', '876767y8768', '2015-04-07', 'Web Designer,Web Developer And Integration As Well...', '876887687', '2015-04-30', 0, 0, 0, 0),
(18, '9', '7cb323203b1306810d65271d8e9228ef', 'mahesh99@wohlig.com', 4, '2015-04-28 09:28:05', 2, '', '', '', 1, 'jjjj', '24', 1, 'Shahad Kalyan', '98798798', '989879879', '2015-04-25', 'Web Designer', '87876576', '2015-04-19', 0, 0, 0, 0),
(19, 'Ganesh', '277a094bea5311135bd7abd73d28a01d', 'ganesh@gmail.com', 6, '2015-05-09 06:47:22', 2, '', '', '', 1, 'ijnijni', '32', 1, 'Vangani', '98998989898', '87687687888', '2015-05-13', 'ganesh buildings', 'mh1000', '2015-05-31', 14, 9, 0, 0),
(20, 'Hotel1', 'a63526467438df9566c508027d9cb06b', 'elysium@wohlig.com', 3, '2015-05-09 07:09:31', 1, '', '', '', 1, 'jabsxjas', '12', 1, 'Panchgani', '8987876565', '9898777777', '2015-05-15', 'Restaurant', 'mh1001', '2015-05-16', 14, 9, 5, 0),
(21, 'Vighnesh', 'c8568a42e7f150dc81613ee8c059906a', 'v@gmail.com', 7, '2015-05-16 08:06:11', 1, '', '', '', 1, '', '22', 1, 'Dombivli', '8776767788', '6765765765', '0000-00-00', 'BSc IT', 'mh1221', '0000-00-00', 15, 0, 0, 0),
(22, 'manager', '0795151defba7a4b5dfa89170de46277', 'manager@wohlig.com', 4, '2015-05-16 08:12:32', 1, '', '', '', 1, '', '43', 1, 'Kalyan Shahad', '8787878', '98798798', '0000-00-00', 'jabshj', 'mm1', '0000-00-00', 0, 0, 0, 0),
(23, 'trainee', '63f4a689dca289ec493b58fea1ce57b0', 'trainee@wohlig.com', 5, '2015-05-16 08:14:08', 1, '', '', '', 1, '', '42', 1, 'Kalyan Shahad', '8776767788', '6765765765', '0000-00-00', 'jabshj', 'mm2', '0000-00-00', 0, 22, 0, 0),
(24, 'executive', '05e8cc14fca017a28ed0eaabd2e5a13e', 'executive@wohlig.com', 6, '2015-05-16 08:15:41', 1, '', '', '', 1, '', '41', 1, 'Dombivli', '8776767788', '6765765765', '0000-00-00', 'jabshj', 'mm3', '0000-00-00', 0, 22, 0, 23),
(25, 'user', '6ad14ba9986e3615423dfca256d04e3f', 'user@wohlig.com', 7, '2015-05-16 08:17:08', 1, '', '', '', 1, '', '40', 1, 'Dombivli', '8776767788', '6765765765', '0000-00-00', 'jabshj', 'mm4', '2014-12-12', 24, 22, 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `hotel_hotel`
--
ALTER TABLE `hotel_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_log`
--
ALTER TABLE `hotel_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_order`
--
ALTER TABLE `hotel_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_transaction`
--
ALTER TABLE `hotel_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuaccess`
--
ALTER TABLE `menuaccess`
  ADD UNIQUE KEY `menu` (`menu`,`access`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hotel_hotel`
--
ALTER TABLE `hotel_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `hotel_log`
--
ALTER TABLE `hotel_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hotel_order`
--
ALTER TABLE `hotel_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `hotel_transaction`
--
ALTER TABLE `hotel_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
