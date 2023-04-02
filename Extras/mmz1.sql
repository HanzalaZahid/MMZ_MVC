-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2023 at 08:04 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mmz`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`) VALUES
(1, '(ABL) Allied Bank Limited'),
(2, '(AMBL) Apna Microfinance Bank Limited'),
(3, '(AKBL) Askari Bank Limited'),
(4, '(BAHL) Bank Al Habib Limited'),
(5, '(BAFL) Bank Alfalah Limited'),
(6, '(BOK) Bank of Khyber'),
(7, '(BIPL) BankIslami Pakistan Limited'),
(8, '(DIBPL) Dubai Islamic Bank Pakistan Limited'),
(9, '(DIBPLP) Dubai Islamic Bank Pakistan Limited Priority'),
(10, 'EasyPaisa'),
(11, '(FBL) Faysal Bank Limited'),
(12, '(FMBL) FINCA Microfinance Bank Limited'),
(13, '(FWBL) First Women Bank Limited'),
(14, '(HBL) Habib Bank Limited'),
(15, '(HMB) Habib Metropolitan Bank Limited'),
(16, 'JazzCash'),
(17, '(JSBL) JS Bank Limited'),
(18, 'Keenu NetConnect'),
(19, '(KMBL) Khushhali Microfinance Bank Limited'),
(20, '(MCB) MCB Bank Limited'),
(21, '(MBL) Meezan Bank Limited'),
(22, '(NBP) National Bank of Pakistan'),
(23, '(NIB) NIB Bank Limited'),
(24, '(PBIC) Pak Brunei Investment Company Limited'),
(25, 'SadaPay'),
(26, '(SILK) Silkbank Limited'),
(27, '(SBL) Sindh Bank Limited'),
(28, '(SBL) Soneri Bank Limited'),
(29, '(SCBPL) Standard Chartered Bank (Pakistan) Limited'),
(30, '(SMBL) Summit Bank Limited'),
(31, '(TMBL) Telenor Microfinance Bank Limited (formerly Tameer Microfinance Bank Limited)'),
(32, '(BOKI) The Bank of Khyber Islamic'),
(33, '(BOP) The Bank of Punjab'),
(34, '(FMFB) The First Microfinance Bank Limited'),
(35, '(PPCBL) The Punjab Provincial Cooperative Bank Limited'),
(36, '(PPCBLI) The Punjab Provincial Cooperative Bank Limited Islamic'),
(37, '(SPCBL) The Sindh Provincial Cooperative Bank Limited'),
(38, '(UBL) United Bank Limited'),
(39, 'Upaisa'),
(40, '(ZTBL) Zarai Taraqiati Bank Limited'),
(41, 'NAYAPAY');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `bank_account_id` int NOT NULL AUTO_INCREMENT,
  `bank_account_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bank_account_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bank_account_bank` int DEFAULT NULL,
  `vendor_id` int DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  PRIMARY KEY (`bank_account_id`),
  KEY `FK_BANK_ACCOUNTS_EMPLOYEES` (`employee_id`),
  KEY `FK_BANK_ACCOUNTS_BANKS` (`bank_account_bank`),
  KEY `FK_BANK_ACCOUNTS_VENDORS` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`bank_account_id`, `bank_account_title`, `bank_account_number`, `bank_account_bank`, `vendor_id`, `employee_id`) VALUES
(46, 'Hanzala Zahid', '09067900615003', 14, NULL, 20),
(47, 'Afzal Hardware', '5462', 38, 74, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
CREATE TABLE IF NOT EXISTS `beneficiaries` (
  `beneficiary_id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `beneficiary_type` varchar(255) NOT NULL,
  PRIMARY KEY (`beneficiary_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`beneficiary_id`, `vendor_id`, `employee_id`, `beneficiary_type`) VALUES
(1, NULL, 20, 'employee'),
(2, NULL, 21, 'employee'),
(3, 74, NULL, 'vendor'),
(4, 75, NULL, 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(28) COLLATE utf8mb4_general_ci NOT NULL,
  `city_province` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `city_province` (`city_province`),
  KEY `city_province_2` (`city_province`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `city_province`) VALUES
(2, 'Karachi', 1),
(3, 'Lahore', 2),
(4, 'Faisalabad', 2),
(5, 'Rawalpindi', 2),
(6, 'Gujranwala', 2),
(7, 'Peshawar', 3),
(8, 'Multan', 2),
(9, 'Saidu Sharif', 3),
(10, 'Hyderabad City', 1),
(11, 'Islamabad', 5),
(12, 'Quetta', 4),
(13, 'Bahawalpur', 2),
(14, 'Sargodha', 2),
(15, 'Sialkot City', 2),
(16, 'Sukkur', 1),
(17, 'Larkana', 1),
(18, 'Chiniot', 2),
(19, 'Shekhupura', 2),
(20, 'Jhang City', 2),
(21, 'Dera Ghazi Khan', 2),
(22, 'Gujrat', 2),
(23, 'Rahimyar Khan', 2),
(24, 'Kasur', 2),
(25, 'Mardan', 3),
(26, 'Mingaora', 3),
(27, 'Nawabshah', 1),
(28, 'Sahiwal', 2),
(29, 'Mirpur Khas', 1),
(30, 'Okara', 2),
(31, 'Mandi Burewala', 2),
(32, 'Jacobabad', 1),
(33, 'Saddiqabad', 2),
(34, 'Kohat', 3),
(35, 'Muridke', 2),
(36, 'Muzaffargarh', 2),
(37, 'Khanpur', 2),
(38, 'Gojra', 2),
(39, 'Mandi Bahauddin', 2),
(40, 'Abbottabad', 3),
(41, 'Turbat', 4),
(42, 'Dadu', 1),
(43, 'Bahawalnagar', 2),
(44, 'Khuzdar', 4),
(45, 'Pakpattan', 2),
(46, 'Tando Allahyar', 1),
(47, 'Ahmadpur East', 2),
(48, 'Vihari', 2),
(49, 'Jaranwala', 2),
(50, 'New Mirpur', 7),
(51, 'Kamalia', 2),
(52, 'Kot Addu', 2),
(53, 'Nowshera', 3),
(54, 'Swabi', 3),
(55, 'Khushab', 2),
(56, 'Dera Ismail Khan', 3),
(57, 'Chaman', 4),
(58, 'Charsadda', 3),
(59, 'Kandhkot', 1),
(60, 'Chishtian', 2),
(61, 'Hasilpur', 2),
(62, 'Attock Khurd', 2),
(63, 'Muzaffarabad', 7),
(64, 'Mianwali', 2),
(65, 'Jalalpur Jattan', 2),
(66, 'Bhakkar', 2),
(67, 'Zhob', 4),
(68, 'Dipalpur', 2),
(69, 'Kharian', 2),
(70, 'Mian Channun', 2),
(71, 'Bhalwal', 2),
(72, 'Jamshoro', 1),
(73, 'Pattoki', 2),
(74, 'Harunabad', 2),
(75, 'Kahror Pakka', 2),
(76, 'Toba Tek Singh', 2),
(77, 'Samundri', 2),
(78, 'Shakargarh', 2),
(79, 'Sambrial', 2),
(80, 'Shujaabad', 2),
(81, 'Hujra Shah Muqim', 2),
(82, 'Kabirwala', 2),
(83, 'Mansehra', 3),
(84, 'Lala Musa', 2),
(85, 'Chunian', 2),
(86, 'Nankana Sahib', 2),
(87, 'Bannu', 3),
(88, 'Pasrur', 2),
(89, 'Timargara', 3),
(90, 'Parachinar', 3),
(91, 'Chenab Nagar', 2),
(92, 'Gwadar', 4),
(93, 'Abdul Hakim', 2),
(94, 'Hassan Abdal', 2),
(95, 'Tank', 3),
(96, 'Hangu', 3),
(97, 'Risalpur Cantonment', 3),
(98, 'Karak', 3),
(99, 'Kundian', 2),
(100, 'Umarkot', 1),
(101, 'Chitral', 3),
(102, 'Dainyor', 6),
(103, 'Kulachi', 3),
(104, 'Kalat', 4),
(105, 'Kotli', 7),
(106, 'Gilgit', 6),
(107, 'Narowal', 2),
(108, 'Khairpur Mir’s', 1),
(109, 'Khanewal', 2),
(110, 'Jhelum', 2),
(111, 'Haripur', 3),
(112, 'Shikarpur', 1),
(113, 'Rawala Kot', 7),
(114, 'Hafizabad', 2),
(115, 'Lodhran', 2),
(116, 'Malakand', 3),
(117, 'Attock City', 2),
(118, 'Batgram', 3),
(119, 'Matiari', 1),
(120, 'Ghotki', 1),
(121, 'Naushahro Firoz', 1),
(122, 'Alpurai', 3),
(123, 'Bagh', 7),
(124, 'Daggar', 3),
(125, 'Leiah', 2),
(126, 'Tando Muhammad Khan', 1),
(127, 'Chakwal', 2),
(128, 'Badin', 1),
(129, 'Lakki', 3),
(130, 'Rajanpur', 2),
(131, 'Dera Allahyar', 4),
(132, 'Shahdad Kot', 1),
(133, 'Pishin', 4),
(134, 'Sanghar', 1),
(135, 'Upper Dir', 3),
(136, 'Thatta', 1),
(137, 'Dera Murad Jamali', 4),
(138, 'Kohlu', 4),
(139, 'Mastung', 4),
(140, 'Dasu', 3),
(141, 'Athmuqam', 7),
(142, 'Loralai', 4),
(143, 'Barkhan', 4),
(144, 'Musa Khel Bazar', 4),
(145, 'Ziarat', 4),
(146, 'Gandava', 4),
(147, 'Sibi', 4),
(148, 'Dera Bugti', 4),
(149, 'Eidgah', 6),
(150, 'Uthal', 4),
(151, 'Khuzdar', 4),
(152, 'Chilas', 6),
(153, 'Panjgur', 4),
(154, 'Gakuch', 6),
(155, 'Qila Saifullah', 4),
(156, 'Kharan', 4),
(157, 'Aliabad', 6),
(158, 'Awaran', 4),
(159, 'Dalbandin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client_city` int NOT NULL,
  `client_cell_primary` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client_cell_secondary` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_type`, `client_address`, `client_city`, `client_cell_primary`, `client_cell_secondary`) VALUES
(1, 'NDURE', 'company', 'Jail Road', 3, '', ''),
(3, 'Servis', 'company', 'Jail Road', 3, '', ''),
(4, 'Raja Rani', 'private', 'City Road', 14, '03006003632', '03432910057');

-- --------------------------------------------------------

--
-- Table structure for table `company_accounts`
--

DROP TABLE IF EXISTS `company_accounts`;
CREATE TABLE IF NOT EXISTS `company_accounts` (
  `company_account_id` int NOT NULL AUTO_INCREMENT,
  `company_account_bank` int NOT NULL,
  `company_account_title` varchar(255) NOT NULL,
  `company_account_number` varchar(255) NOT NULL,
  PRIMARY KEY (`company_account_id`),
  KEY `FK_COMPANY_ACCOUNTS_BANKS` (`company_account_bank`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_accounts`
--

INSERT INTO `company_accounts` (`company_account_id`, `company_account_bank`, `company_account_title`, `company_account_number`) VALUES
(1, 14, 'Mirza Muhammad Zahid', '53587000020755'),
(2, 14, 'Mirza Muhammad Zahid', '09067900486303'),
(3, 14, 'Hanzala Zahid', '53587000050851');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `employee_category` int NOT NULL,
  `employee_cell_primary` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `employee_cell_secondary` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `employee_city` int NOT NULL,
  `employee_about` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_account` int DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `FK_EMPLOYEES_EMPLOYEE_CATEGORIES` (`employee_category`),
  KEY `FL_EMPLOYEES_BANK_ACCOUNTS` (`bank_account`),
  KEY `EMPLOYEES_CITIES` (`employee_city`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_category`, `employee_cell_primary`, `employee_cell_secondary`, `employee_city`, `employee_about`, `bank_account`) VALUES
(20, 'Hanzala Zahid', 1, '03432910057', '03006003632', 14, 'CO', 46),
(21, 'Tayyab Zahid', 2, '03076003632', '', 14, 'Bro', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_categories`
--

DROP TABLE IF EXISTS `employee_categories`;
CREATE TABLE IF NOT EXISTS `employee_categories` (
  `employee_category_id` int NOT NULL AUTO_INCREMENT,
  `employee_category_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`employee_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_categories`
--

INSERT INTO `employee_categories` (`employee_category_id`, `employee_category_name`) VALUES
(1, 'Carpenter'),
(2, 'Electrician'),
(3, 'Civil Worker'),
(4, 'Paint Worker');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `project_client` int NOT NULL,
  `project_city` int NOT NULL,
  `project_location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `project_start_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `FK_PROJECTS_CITIES` (`project_city`),
  KEY `FK_PROJECTS_CLIENTS` (`project_client`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_client`, `project_city`, `project_location`, `project_start_date`, `project_end_date`) VALUES
(2, 'NDURE MALL ROAD 1', 1, 3, 'Mall Road', '2023-02-02', '2322-02-02'),
(3, 'Servis Haripur', 3, 111, 'Main Bazar', '2023-05-02', '2022-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(28) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `province_name`) VALUES
(1, 'Sindh'),
(2, 'Punjab'),
(3, 'Khyber Pakhtunkhwa'),
(4, 'Balouchistan'),
(5, 'Federal Terrority'),
(6, 'Gilgit Baltistan'),
(7, 'Azad Kashmir');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_categories`
--

DROP TABLE IF EXISTS `transaction_categories`;
CREATE TABLE IF NOT EXISTS `transaction_categories` (
  `transaction_category_id` int NOT NULL AUTO_INCREMENT,
  `transaction_category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`transaction_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_categories`
--

INSERT INTO `transaction_categories` (`transaction_category_id`, `transaction_category_name`) VALUES
(1, 'Purchase'),
(2, 'Transport'),
(3, 'Family Expenses'),
(4, 'Medical');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `vendor_city` int NOT NULL,
  `vendor_cell_primary` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `vendor_cell_secondary` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `vendor_about` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_account` int DEFAULT NULL,
  PRIMARY KEY (`vendor_id`),
  KEY `FK_VENDORS_CITIES` (`vendor_city`),
  KEY `FL_VENDORS_BANK_ACCOUNTS` (`bank_account`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_city`, `vendor_cell_primary`, `vendor_cell_secondary`, `vendor_about`, `bank_account`) VALUES
(74, 'Afzal Hardware', 3, '', '', '', 47),
(75, 'Alhamd Hardware', 14, '', '', '', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `FK_BANK_ACCOUNTS_BANKS` FOREIGN KEY (`bank_account_bank`) REFERENCES `banks` (`bank_id`),
  ADD CONSTRAINT `FK_BANK_ACCOUNTS_EMPLOYEES` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `FK_BANK_ACCOUNTS_VENDORS` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `FK_CITIES_PROVINCES` FOREIGN KEY (`city_province`) REFERENCES `provinces` (`province_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `EMPLOYEES_CITIES` FOREIGN KEY (`employee_city`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `FK_EMPLOYEES_EMPLOYEE_CATEGORIES` FOREIGN KEY (`employee_category`) REFERENCES `employee_categories` (`employee_category_id`),
  ADD CONSTRAINT `FL_EMPLOYEES_BANK_ACCOUNTS` FOREIGN KEY (`bank_account`) REFERENCES `bank_accounts` (`bank_account_id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `FK_PROJECTS_CITIES` FOREIGN KEY (`project_city`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `FK_PROJECTS_CLIENTS` FOREIGN KEY (`project_client`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `FK_VENDORS_CITIES` FOREIGN KEY (`vendor_city`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `FL_VENDORS_BANK_ACCOUNTS` FOREIGN KEY (`bank_account`) REFERENCES `bank_accounts` (`bank_account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;