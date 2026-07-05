-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2024 at 04:11 AM
-- Server version: 10.6.16-MariaDB-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zepackin_hubtechitsolutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `address` varchar(400) NOT NULL,
  `added_by` int(5) NOT NULL,
  `update_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user_id`, `name`, `email`, `password`, `ip_address`, `phone`, `image`, `privilege_id`, `address`, `added_by`, `update_by`, `status`, `created`, `updated`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$OrcPQnE3uzWSH/QmgeuvfumHPw6PkZVrefaIdyYeHqpCgIayuJisG', '::1', '9162925142', 'dp_1676868972.jpg', 1, 'delhi', 1, 1, 1, '2021-09-06 10:23:19', '2023-03-02 23:16:19'),
(15, 'test123', 'test@yopmail.com', '$2y$10$fqYWNLFqBT3yt7nCO4xsROQuDPi1Evl74/zTRkNkzlh2k4qVYQ4JG', '::1', '2356897485', 'u_1672132507.jpg', 3, 'delhi', 1, 1, 1, '2022-12-27 09:15:07', '2023-03-05 11:10:42'),
(16, 'test175', 'test175@yopmail.com', '$2y$10$n6uyNrkfB9SHBImdRrCsR.x5sgHFkCCwQtQLODH65CqOasEOrFLBO', '::1', '7865432343', 'u_1672145257.jpg', 3, 'delhi', 1, 1, 1, '2022-12-27 12:47:37', '2023-02-15 10:54:14'),
(17, 'abc', 'abc@yopmail.com', '$2y$10$TbeSFZ0.q5ZSJpfkgnHDiOfsJE0rn29o9L9DiV0PWuYy9SfGwagKi', '::1', '9162925142', 'u_1676480019.jpg', 3, 'ara', 1, 1, 1, '2023-02-14 17:07:38', '2023-02-15 10:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `main_title` varchar(100) DEFAULT NULL,
  `sub_title` varchar(150) NOT NULL,
  `page` int(11) DEFAULT NULL,
  `url` varchar(150) NOT NULL,
  `brochure` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `main_title`, `sub_title`, `page`, `url`, `brochure`, `status`, `created_at`, `update_at`) VALUES
(1, 'Learn Together Grow Faster', 'Learn Together Grow Faster', 1, '', 'ban_1683176007.webp', 1, '2021-07-22 22:51:10', '2023-05-03 23:53:27'),
(2, 'test2', 'sub test2', 1, '', 'ban_1678509791.jpg', 0, '2021-07-22 23:00:40', '2023-05-03 23:49:10'),
(4, 'test4', 'subtest4', 3, '', 'ban_1678509743.jpg', 1, '2021-07-22 23:22:03', '2023-03-10 22:42:23'),
(5, 'contact us', 'test 2', 3, '', 'ban_1678509622.jpg', 1, '2023-03-10 22:40:22', NULL),
(6, 'Batch', 'New Batch', 1, '', 'ban_1682731772.jpg', 0, '2023-04-28 20:29:32', '2023-05-03 23:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blg_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_details` text NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_url` varchar(255) NOT NULL,
  `related_blogs` varchar(255) NOT NULL,
  `blog_added_by` varchar(255) NOT NULL,
  `blog_cat_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `blog_status` enum('0','1') NOT NULL,
  `added_at` datetime NOT NULL,
  `modefied_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blg_id`, `blog_title`, `blog_details`, `blog_image`, `blog_url`, `related_blogs`, `blog_added_by`, `blog_cat_id`, `post_date`, `meta_title`, `meta_description`, `meta_keyword`, `blog_status`, `added_at`, `modefied_at`) VALUES
(1, 'The Most Inspiring Interior Design Of 201688', 'We went down the lane, by the body of the man in black, sodden now from the overnight hail,', 'b_1626281172.jpg', 'the-most-inspiring-interior-design-of-201688', '', 'Admin', 0, '2021-03-23', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', '1', '2021-07-14 23:10:52', '2021-03-23 17:07:18'),
(2, 'daffodills', 'daffodils daffodils daffodils daffodils', '', 'daffodils ', 'the very much design', 'Admin', 0, '2021-03-23', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', 'The Most Inspiring Interior Design Of 201685', '0', '2023-03-10 22:44:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE `tbl_cms` (
  `id` int(11) NOT NULL,
  `page` varchar(150) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_head` varchar(255) NOT NULL,
  `cms_banner` varchar(150) NOT NULL,
  `description1` text NOT NULL,
  `description2` text NOT NULL,
  `description3` text NOT NULL,
  `description4` text NOT NULL,
  `description5` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`id`, `page`, `banner_title`, `banner_head`, `cms_banner`, `description1`, `description2`, `description3`, `description4`, `description5`, `status`, `added_at`, `updated_at`) VALUES
(2, 'test2', 'test', 'test', 'ban_1678030362.jpg', 'sdfsdfsdf', '', '', '', '', '0', '2023-03-05 09:32:42', '2023-03-05 11:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_us`
--

CREATE TABLE `tbl_contact_us` (
  `id` int(11) NOT NULL,
  `course_id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `added_at` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-New,2-Admit,3-Cancel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact_us`
--

INSERT INTO `tbl_contact_us` (`id`, `course_id`, `name`, `email`, `phone`, `message`, `ipaddress`, `added_at`, `status`) VALUES
(1, 0, 'test304', 'test304@yopmail.com', '9162925142', 'hi this is testing mail', '::1', '2023-04-30 10:36:32', 1),
(2, 0, 'test4', 'test4@yopmail.com', '7878878782', 'hiu test', '::1', '2023-04-30 11:20:37', 1),
(3, 0, 'test304', 'test304@yopmail.com', '9162925142', 'hi this is test', '223.228.252.195', '2023-04-30 11:42:09', 1),
(4, 0, 'test304', 'test304@yopmail.com', '9162925142', 'sdfsdf sdf sdf sdf ', '223.228.252.195', '2023-04-30 11:44:17', 1),
(5, 0, 'raj', 'pitara220@gmail.com', '9162925142', 'sfs sdfsdf sdf ', '223.228.252.195', '2023-04-30 11:52:01', 3),
(6, 4, 'md raj guddu', 'raj@yopmail.com', '9162925142', 'dev testing', '223.228.232.25', '2023-05-02 11:51:46', 1),
(7, 0, 'Neil P', 'pat@aneesho.com', '8102440753', 'Just wanted to ask if you would be interested in getting external help with graphic design? We do all design work like banners, advertisements, photo edits, logos, flyers, etc. for a fixed monthly fee. \r\n\r\nWe don\'t charge for each task. What kind of work do you need on a regular basis? Let me know and I\'ll share my portfolio with you. \r\n', '49.37.10.166', '2023-09-08 02:04:03', 1),
(8, 2, 'ANKIT KUMAR', 'ANKITK50294@GMAIL.COM', '7562841317', 'I WANT TO TAKE AN ADMISSION IN YOUR CLESSES', '152.58.187.217', '2023-11-02 00:10:08', 1),
(9, 2, 'ANKIT KUMAR', 'ANKITK50294@GMAIL.COM', '7562841317', 'I WANT TO TAKE AN ADMISSION IN YOUR CLESSES', '152.58.187.217', '2023-11-02 00:10:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `countries_id` int(11) NOT NULL,
  `countries_name` varchar(64) NOT NULL DEFAULT '',
  `countries_iso_code` varchar(2) NOT NULL,
  `countries_isd_code` varchar(7) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`countries_id`, `countries_name`, `countries_iso_code`, `countries_isd_code`, `status`) VALUES
(1, 'Afghanistan', 'AF', '93', 1),
(2, 'Albania', 'AL', '355', 1),
(3, 'Algeria', 'DZ', '213', 1),
(4, 'American Samoa', 'AS', '1-684', 1),
(5, 'Andorra', 'AD', '376', 1),
(6, 'Angola', 'AO', '244', 1),
(7, 'Anguilla', 'AI', '1-264', 1),
(8, 'Antarctica', 'AQ', '672', 1),
(9, 'Antigua and Barbuda', 'AG', '1-268', 1),
(10, 'Argentina', 'AR', '54', 1),
(11, 'Armenia', 'AM', '374', 1),
(12, 'Aruba', 'AW', '297', 1),
(13, 'Australia', 'AU', '61', 1),
(14, 'Austria', 'AT', '43', 1),
(15, 'Azerbaijan', 'AZ', '994', 1),
(16, 'Bahamas', 'BS', '1-242', 1),
(17, 'Bahrain', 'BH', '973', 1),
(18, 'Bangladesh', 'BD', '880', 1),
(19, 'Barbados', 'BB', '1-246', 1),
(20, 'Belarus', 'BY', '375', 1),
(21, 'Belgium', 'BE', '32', 1),
(22, 'Belize', 'BZ', '501', 1),
(23, 'Benin', 'BJ', '229', 1),
(24, 'Bermuda', 'BM', '1-441', 1),
(25, 'Bhutan', 'BT', '975', 1),
(26, 'Bolivia', 'BO', '591', 1),
(27, 'Bosnia and Herzegowina', 'BA', '387', 1),
(28, 'Botswana', 'BW', '267', 1),
(29, 'Bouvet Island', 'BV', '47', 1),
(30, 'Brazil', 'BR', '55', 1),
(31, 'British Indian Ocean Territory', 'IO', '246', 1),
(32, 'Brunei Darussalam', 'BN', '673', 1),
(33, 'Bulgaria', 'BG', '359', 1),
(34, 'Burkina Faso', 'BF', '226', 1),
(35, 'Burundi', 'BI', '257', 1),
(36, 'Cambodia', 'KH', '855', 1),
(37, 'Cameroon', 'CM', '237', 1),
(38, 'Canada', 'CA', '1', 1),
(39, 'Cape Verde', 'CV', '238', 1),
(40, 'Cayman Islands', 'KY', '1-345', 1),
(41, 'Central African Republic', 'CF', '236', 1),
(42, 'Chad', 'TD', '235', 1),
(43, 'Chile', 'CL', '56', 1),
(44, 'China', 'CN', '86', 1),
(45, 'Christmas Island', 'CX', '61', 1),
(46, 'Cocos (Keeling) Islands', 'CC', '61', 1),
(47, 'Colombia', 'CO', '57', 1),
(48, 'Comoros', 'KM', '269', 1),
(49, 'Congo Democratic Republic of', 'CG', '242', 1),
(50, 'Cook Islands', 'CK', '682', 1),
(51, 'Costa Rica', 'CR', '506', 1),
(52, 'Cote D\'Ivoire', 'CI', '225', 1),
(53, 'Croatia', 'HR', '385', 1),
(54, 'Cuba', 'CU', '53', 1),
(55, 'Cyprus', 'CY', '357', 1),
(56, 'Czech Republic', 'CZ', '420', 1),
(57, 'Denmark', 'DK', '45', 1),
(58, 'Djibouti', 'DJ', '253', 1),
(59, 'Dominica', 'DM', '1-767', 1),
(60, 'Dominican Republic', 'DO', '1-809', 1),
(61, 'Timor-Leste', 'TL', '670', 1),
(62, 'Ecuador', 'EC', '593', 1),
(63, 'Egypt', 'EG', '20', 1),
(64, 'El Salvador', 'SV', '503', 1),
(65, 'Equatorial Guinea', 'GQ', '240', 1),
(66, 'Eritrea', 'ER', '291', 1),
(67, 'Estonia', 'EE', '372', 1),
(68, 'Ethiopia', 'ET', '251', 1),
(69, 'Falkland Islands (Malvinas)', 'FK', '500', 1),
(70, 'Faroe Islands', 'FO', '298', 1),
(71, 'Fiji', 'FJ', '679', 1),
(72, 'Finland', 'FI', '358', 1),
(73, 'France', 'FR', '33', 1),
(75, 'French Guiana', 'GF', '594', 1),
(76, 'French Polynesia', 'PF', '689', 1),
(77, 'French Southern Territories', 'TF', NULL, 1),
(78, 'Gabon', 'GA', '241', 1),
(79, 'Gambia', 'GM', '220', 1),
(80, 'Georgia', 'GE', '995', 1),
(81, 'Germany', 'DE', '49', 1),
(82, 'Ghana', 'GH', '233', 1),
(83, 'Gibraltar', 'GI', '350', 1),
(84, 'Greece', 'GR', '30', 1),
(85, 'Greenland', 'GL', '299', 1),
(86, 'Grenada', 'GD', '1-473', 1),
(87, 'Guadeloupe', 'GP', '590', 1),
(88, 'Guam', 'GU', '1-671', 1),
(89, 'Guatemala', 'GT', '502', 1),
(90, 'Guinea', 'GN', '224', 1),
(91, 'Guinea-bissau', 'GW', '245', 1),
(92, 'Guyana', 'GY', '592', 1),
(93, 'Haiti', 'HT', '509', 1),
(94, 'Heard Island and McDonald Islands', 'HM', '011', 1),
(95, 'Honduras', 'HN', '504', 1),
(96, 'Hong Kong', 'HK', '852', 1),
(97, 'Hungary', 'HU', '36', 1),
(98, 'Iceland', 'IS', '354', 1),
(99, 'India', 'IN', '91', 1),
(100, 'Indonesia', 'ID', '62', 1),
(101, 'Iran (Islamic Republic of)', 'IR', '98', 1),
(102, 'Iraq', 'IQ', '964', 1),
(103, 'Ireland', 'IE', '353', 1),
(104, 'Israel', 'IL', '972', 1),
(105, 'Italy', 'IT', '39', 1),
(106, 'Jamaica', 'JM', '1-876', 1),
(107, 'Japan', 'JP', '81', 1),
(108, 'Jordan', 'JO', '962', 1),
(109, 'Kazakhstan', 'KZ', '7', 1),
(110, 'Kenya', 'KE', '254', 1),
(111, 'Kiribati', 'KI', '686', 1),
(112, 'Korea, Democratic People\'s Republic of', 'KP', '850', 1),
(113, 'South Korea', 'KR', '82', 1),
(114, 'Kuwait', 'KW', '965', 1),
(115, 'Kyrgyzstan', 'KG', '996', 1),
(116, 'Lao People\'s Democratic Republic', 'LA', '856', 1),
(117, 'Latvia', 'LV', '371', 1),
(118, 'Lebanon', 'LB', '961', 1),
(119, 'Lesotho', 'LS', '266', 1),
(120, 'Liberia', 'LR', '231', 1),
(121, 'Libya', 'LY', '218', 1),
(122, 'Liechtenstein', 'LI', '423', 1),
(123, 'Lithuania', 'LT', '370', 1),
(124, 'Luxembourg', 'LU', '352', 1),
(125, 'Macao', 'MO', '853', 1),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', '389', 1),
(127, 'Madagascar', 'MG', '261', 1),
(128, 'Malawi', 'MW', '265', 1),
(129, 'Malaysia', 'MY', '60', 1),
(130, 'Maldives', 'MV', '960', 1),
(131, 'Mali', 'ML', '223', 1),
(132, 'Malta', 'MT', '356', 1),
(133, 'Marshall Islands', 'MH', '692', 1),
(134, 'Martinique', 'MQ', '596', 1),
(135, 'Mauritania', 'MR', '222', 1),
(136, 'Mauritius', 'MU', '230', 1),
(137, 'Mayotte', 'YT', '262', 1),
(138, 'Mexico', 'MX', '52', 1),
(139, 'Micronesia, Federated States of', 'FM', '691', 1),
(140, 'Moldova', 'MD', '373', 1),
(141, 'Monaco', 'MC', '377', 1),
(142, 'Mongolia', 'MN', '976', 1),
(143, 'Montserrat', 'MS', '1-664', 1),
(144, 'Morocco', 'MA', '212', 1),
(145, 'Mozambique', 'MZ', '258', 1),
(146, 'Myanmar', 'MM', '95', 1),
(147, 'Namibia', 'NA', '264', 1),
(148, 'Nauru', 'NR', '674', 1),
(149, 'Nepal', 'NP', '977', 1),
(150, 'Netherlands', 'NL', '31', 1),
(151, 'Netherlands Antilles', 'AN', '599', 1),
(152, 'New Caledonia', 'NC', '687	', 1),
(153, 'New Zealand', 'NZ', '64', 1),
(154, 'Nicaragua', 'NI', '505', 1),
(155, 'Niger', 'NE', '227', 1),
(156, 'Nigeria', 'NG', '234', 1),
(157, 'Niue', 'NU', '683', 1),
(158, 'Norfolk Island', 'NF', '672', 1),
(159, 'Northern Mariana Islands', 'MP', '1-670', 1),
(160, 'Norway', 'NO', '47', 1),
(161, 'Oman', 'OM', '968', 1),
(162, 'Pakistan', 'PK', '92', 1),
(163, 'Palau', 'PW', '680', 1),
(164, 'Panama', 'PA', '507', 1),
(165, 'Papua New Guinea', 'PG', '675', 1),
(166, 'Paraguay', 'PY', '595', 1),
(167, 'Peru', 'PE', '51', 1),
(168, 'Philippines', 'PH', '63', 1),
(169, 'Pitcairn', 'PN', '64', 1),
(170, 'Poland', 'PL', '48', 1),
(171, 'Portugal', 'PT', '351', 1),
(172, 'Puerto Rico', 'PR', '1-787', 1),
(173, 'Qatar', 'QA', '974', 1),
(174, 'Reunion', 'RE', '262', 1),
(175, 'Romania', 'RO', '40', 1),
(176, 'Russian Federation', 'RU', '7', 1),
(177, 'Rwanda', 'RW', '250', 1),
(178, 'Saint Kitts and Nevis', 'KN', '1-869', 1),
(179, 'Saint Lucia', 'LC', '1-758', 1),
(180, 'Saint Vincent and the Grenadines', 'VC', '1-784', 1),
(181, 'Samoa', 'WS', '685', 1),
(182, 'San Marino', 'SM', '378', 1),
(183, 'Sao Tome and Principe', 'ST', '239', 1),
(184, 'Saudi Arabia', 'SA', '966', 1),
(185, 'Senegal', 'SN', '221', 1),
(186, 'Seychelles', 'SC', '248', 1),
(187, 'Sierra Leone', 'SL', '232', 1),
(188, 'Singapore', 'SG', '65', 1),
(189, 'Slovakia (Slovak Republic)', 'SK', '421', 1),
(190, 'Slovenia', 'SI', '386', 1),
(191, 'Solomon Islands', 'SB', '677', 1),
(192, 'Somalia', 'SO', '252', 1),
(193, 'South Africa', 'ZA', '27', 1),
(194, 'South Georgia and the South Sandwich Islands', 'GS', '500', 1),
(195, 'Spain', 'ES', '34', 1),
(196, 'Sri Lanka', 'LK', '94', 1),
(197, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', '290', 1),
(198, 'St. Pierre and Miquelon', 'PM', '508', 1),
(199, 'Sudan', 'SD', '249', 1),
(200, 'Suriname', 'SR', '597', 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', '47', 1),
(202, 'Swaziland', 'SZ', '268', 1),
(203, 'Sweden', 'SE', '46', 1),
(204, 'Switzerland', 'CH', '41', 1),
(205, 'Syrian Arab Republic', 'SY', '963', 1),
(206, 'Taiwan', 'TW', '886', 1),
(207, 'Tajikistan', 'TJ', '992', 1),
(208, 'Tanzania, United Republic of', 'TZ', '255', 1),
(209, 'Thailand', 'TH', '66', 1),
(210, 'Togo', 'TG', '228', 1),
(211, 'Tokelau', 'TK', '690', 1),
(212, 'Tonga', 'TO', '676', 1),
(213, 'Trinidad and Tobago', 'TT', '1-868', 1),
(214, 'Tunisia', 'TN', '216', 1),
(215, 'Turkey', 'TR', '90', 1),
(216, 'Turkmenistan', 'TM', '993', 1),
(217, 'Turks and Caicos Islands', 'TC', '1-649', 1),
(218, 'Tuvalu', 'TV', '688', 1),
(219, 'Uganda', 'UG', '256', 1),
(220, 'Ukraine', 'UA', '380', 1),
(221, 'United Arab Emirates', 'AE', '971', 1),
(222, 'United Kingdom', 'GB', '44', 1),
(223, 'United States', 'US', '1', 1),
(224, 'United States Minor Outlying Islands', 'UM', '246', 1),
(225, 'Uruguay', 'UY', '598', 1),
(226, 'Uzbekistan', 'UZ', '998', 1),
(227, 'Vanuatu', 'VU', '678', 1),
(228, 'Vatican City State (Holy See)', 'VA', '379', 1),
(229, 'Venezuela', 'VE', '58', 1),
(230, 'Vietnam', 'VN', '84', 1),
(231, 'Virgin Islands (British)', 'VG', '1-284', 1),
(232, 'Virgin Islands (U.S.)', 'VI', '1-340', 1),
(233, 'Wallis and Futuna Islands', 'WF', '681', 1),
(234, 'Western Sahara', 'EH', '212', 1),
(235, 'Yemen', 'YE', '967', 1),
(236, 'Serbia', 'RS', '381', 1),
(238, 'Zambia', 'ZM', '260', 1),
(239, 'Zimbabwe', 'ZW', '263', 1),
(240, 'Aaland Islands', 'AX', '358', 1),
(241, 'Palestine', 'PS', '970', 1),
(242, 'Montenegro', 'ME', '382', 1),
(243, 'Guernsey', 'GG', '44-1481', 1),
(244, 'Isle of Man', 'IM', '44-1624', 1),
(245, 'Jersey', 'JE', '44-1534', 1),
(247, 'Curaçao', 'CW', '599', 1),
(248, 'Ivory Coast', 'CI', '225', 1),
(249, 'Kosovo', 'XK', '383', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

CREATE TABLE `tbl_courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `course_full_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ccat_id` int(11) NOT NULL COMMENT 'course_category_id',
  `image` varchar(150) NOT NULL,
  `youtube_vlink` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `syllabus` text NOT NULL COMMENT 'json data',
  `what_learn` text NOT NULL COMMENT 'json data',
  `requirements` text NOT NULL COMMENT 'json data',
  `course_fee` varchar(70) NOT NULL,
  `adm_fee` varchar(70) NOT NULL,
  `ins_fee` varchar(70) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `ins_id` int(11) NOT NULL COMMENT 'instructor Id',
  `enrolled` varchar(255) NOT NULL,
  `lesson` varchar(150) NOT NULL,
  `course_level` enum('B','A','I') NOT NULL COMMENT 'B-Beginner, A-Advanced, I-Intermidiate',
  `language` varchar(255) NOT NULL,
  `is_cert` varchar(50) NOT NULL,
  `is_popular` enum('0','1') NOT NULL COMMENT '0-No, 1- Yes',
  `status` int(11) NOT NULL COMMENT '0-pending, 1-publish',
  `added_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `update_by` int(11) NOT NULL,
  `complete_tab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`course_id`, `course_name`, `course_full_name`, `url`, `ccat_id`, `image`, `youtube_vlink`, `short_description`, `description`, `syllabus`, `what_learn`, `requirements`, `course_fee`, `adm_fee`, `ins_fee`, `duration`, `ins_id`, `enrolled`, `lesson`, `course_level`, `language`, `is_cert`, `is_popular`, `status`, `added_at`, `update_at`, `added_by`, `update_by`, `complete_tab`) VALUES
(1, 'DCA', 'Diploma in computer application', 'diploma-in-computer-application', 1, 'c_1682594639.jpg', '', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.', '<span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</span>\r\n\r\n<div><br />\r\n	\r\n	 \r\n\r\n	\r\n	<div><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\"><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</span></span></div> </div> ', '[{\"module_name\":\"Module - 1: Information Technology\",\"syllabus\":\"Fundamentals,\\r\\nNetworking,\\r\\nInternet,\\r\\nMultimedia,\\r\\nHTML,\\r\\nHardware maintenance\"},{\"module_name\":\"Module-2: Operating System\",\"syllabus\":\"MS-Dos,\\r\\nMS-Windows 7\\/8\"},{\"module_name\":\"Module-3: Official Package (2010\\/2013)\",\"syllabus\":\"MS-Word 2010,\\r\\nMS-Excel 2010,\\r\\nMS-PowerPoint 2010,\\r\\nMS-Access 2010,\\r\\nPagemaker with card designing,\\r\\nProject\\r\\n\"}]', '[\"Diploma in computer application\",\"Diploma in computer application\",\"Diploma in computer application\",\"Diploma in computer application\"]', '[\"No prior knowledge of computer is required as everything will be covered in this course.\",\"No prior knowledge of computer is required as everything will be covered in this course.\",\"No prior knowledge of computer is required as everything will be covered in this course.\",\"No prior knowledge of computer is required as everything will be covered in this course.\"]', '4100', '2000', '600', '6 Months', 2, '160', '14', 'B', 'HE', 'Yes', '1', 1, '2023-04-08 13:57:00', '2023-04-27 21:27:39', 0, 0, 5),
(2, 'DIFA', 'Diploma in financial accounting', 'diploma-in-financial-accounting', 1, 'c_1682594785.jpg', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<strong style=\"margin: 0px; padding: 0px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">Lorem Ipsum</strong><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span> ', '[{\"module_name\":\"Semester - 1 : Information Technology\",\"syllabus\":\"Fundamentals,\\r\\nMS-DOS,\\r\\nMS-Windows 7\\/8,\\r\\nNetworking,\\r\\nInternet,\\r\\nMultimedia,\\r\\nHTML,\\r\\nHardware maintenance\"},{\"module_name\":\"Semester -2: Official Package (2010\\/2013)\",\"syllabus\":\"MS-Word 2010,\\r\\nMS-Excel 2010,\\r\\nMS-PowerPoint 2010,\\r\\nMS-Access 2010\"},{\"module_name\":\"Semester - 3: Accounting Package (Tally ERP\\/Prime)\",\"syllabus\":\"Accounting Information,\\r\\nAccount Only,\\r\\nAccountancy with inventry,\\r\\nProject\"}]', '[\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\",\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\",\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\",\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\"]', '[\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"Contrary to popular belief, Lorem Ipsum is not simply random text.\"]', '4800', '2500', '800', '6 Months', 2, '120', '16', 'B', 'HE', 'Yes', '1', 1, '2023-04-08 14:19:08', '2023-04-27 21:37:01', 0, 0, 2),
(4, 'DTP', 'Desktop Publishing', 'desktop-publishing', 1, 'c_1682649544.jpg', 'https://www.youtube.com/watch?v=PICj5tr9hcc', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<strong open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span> ', '[{\"module_name\":\"Module - 1\",\"syllabus\":\"Computer Fundamental\"},{\"module_name\":\"Module - 2\",\"syllabus\":\"MS-Windows 7\\/8\"},{\"module_name\":\"Module - 3\",\"syllabus\":\"Adobe PageMaker,\\r\\nCorel Draw,\\r\\nAdobe Photoshop\"},{\"module_name\":\"Extra Features\",\"syllabus\":\"Printing,\\r\\nScanning,\\r\\nInstallation of software,\\r\\nInstallation of Fonts,\\r\\nInstallation of Picture, Clipart Gallary etc,\\r\\nDigital Studio Work\"}]', '[\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\",\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\",\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\",\"Lorem Ipsum is simply dummy text of the printing and typesetting industry.\"]', '[\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"Contrary to popular belief, Lorem Ipsum is not simply random text.\",\"Contrary to popular belief, Lorem Ipsum is not simply random text.\"]', '3500', '2000', '1000', '4 Months', 1, '95', '11', 'B', 'HE', 'Yes', '1', 1, '2023-04-27 21:39:04', '2023-04-27 22:09:03', 0, 0, 1),
(5, 'CIFA', 'Certificate in Financial Accounting', 'certificate-in-financial-accounting', 5, 'c_1682957618.jpg', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<strong style=\"margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);\">Lorem Ipsum</strong><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);\">&nbsp;is simply dummy text of the printing and typesetting industry.&nbsp;</span><strong style=\"margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);\">Lorem Ipsum</strong><span style=\"font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255);\">&nbsp;is simply dummy text of the printing and typesetting industry.&nbsp;</span>', '', '', '', '', '', '', '', 0, '', '', 'B', '', '', '0', 0, '2023-05-01 11:13:38', '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_category`
--

CREATE TABLE `tbl_course_category` (
  `ccat_id` int(11) NOT NULL,
  `course_category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `added_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course_category`
--

INSERT INTO `tbl_course_category` (`ccat_id`, `course_category_name`, `status`, `added_at`) VALUES
(1, 'Foundation Course', '1', '2023-04-04 22:42:29'),
(2, 'Advance Diploma ', '1', '2023-04-04 22:42:29'),
(3, 'Computer Programming', '1', '2023-04-04 22:43:35'),
(5, 'Financial Accounting', '1', '2023-05-01 10:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqcategory`
--

CREATE TABLE `tbl_faqcategory` (
  `faqcat_id` int(11) NOT NULL,
  `faqcat_name` varchar(255) NOT NULL,
  `faqcat_status` enum('0','1') NOT NULL COMMENT '0-Inactive 1-Active',
  `faqcat_added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `faqcat_updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faqcategory`
--

INSERT INTO `tbl_faqcategory` (`faqcat_id`, `faqcat_name`, `faqcat_status`, `faqcat_added_on`, `faqcat_updated_on`) VALUES
(1, 'test', '1', '2021-09-13 16:41:22', '2021-09-13 22:11:22'),
(3, 'test2', '1', '2021-09-13 16:41:32', '2021-09-13 22:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `faq_id` int(5) NOT NULL,
  `faq_title` varchar(255) NOT NULL,
  `faq_description` text NOT NULL,
  `faq_position` int(5) NOT NULL,
  `faq_for` int(11) NOT NULL,
  `faq_status` enum('0','1') NOT NULL,
  `added_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`faq_id`, `faq_title`, `faq_description`, `faq_position`, `faq_for`, `faq_status`, `added_at`, `modified_at`) VALUES
(3, 'test3 name', 'this is test3 test', 3, 1, '1', '2021-03-24 13:23:30', '2021-07-16 23:17:30'),
(5, 'test', 'test des', 0, 0, '1', '2023-03-09 22:14:52', '2023-03-09 22:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_happy_client`
--

CREATE TABLE `tbl_happy_client` (
  `cl_id` int(5) NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_happy_client`
--

INSERT INTO `tbl_happy_client` (`cl_id`, `client_name`, `logo`, `status`, `added_at`) VALUES
(1, 'a', 'h_1626713649.jpg', '1', '2021-07-19 16:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instructor`
--

CREATE TABLE `tbl_instructor` (
  `ins_id` int(11) NOT NULL,
  `ins_name` varchar(255) NOT NULL,
  `ins_image` varchar(255) NOT NULL,
  `post` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `facebook_link` varchar(150) NOT NULL,
  `twitor_link` varchar(150) NOT NULL,
  `linkedin_link` varchar(150) NOT NULL,
  `youtube_link` varchar(150) NOT NULL,
  `status` int(5) NOT NULL,
  `added_at` date NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_instructor`
--

INSERT INTO `tbl_instructor` (`ins_id`, `ins_name`, `ins_image`, `post`, `details`, `facebook_link`, `twitor_link`, `linkedin_link`, `youtube_link`, `status`, `added_at`, `update_at`) VALUES
(1, 'Mr Santosh Kumar', 'dp_ins_1685070300.jpg', 'Founder & CEO', '<strong style=\"margin: 0px; padding: 0px; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">Lorem Ipsum</strong><span open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span>    ', '', '', '', '', 1, '2023-04-24', '2023-05-25'),
(2, 'Mr Abhishek ', 'dp_ins_1685069984.jpg', 'Founder & CEO', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  ', '', '', '', '', 1, '2023-04-24', '2023-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_list`
--

CREATE TABLE `tbl_menu_list` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_menu_list`
--

INSERT INTO `tbl_menu_list` (`menu_id`, `menu_name`, `function`, `status`) VALUES
(1, 'users', 'Add,Edit,View,Delete', 1),
(2, 'Users Groups', 'Add,Edit,Delete', 1),
(6, 'Setting', 'Update', 1),
(7, 'CMS', 'Add, Edit, Delete', 1),
(8, 'Blogs', 'Add,Edit,Delete', 1),
(9, 'Faq', 'Add,Edit,Delete', 1),
(10, 'Testimonial', 'Add,Edit,Delete', 1),
(11, 'Banner', 'Add,Edit,Delete', 1),
(12, 'Course Category', 'Add,Edit', 1),
(13, 'Courses', 'Add,Edit,View,Delete', 1),
(14, 'Instructor', 'Add,Edit,View,Delete', 1),
(15, 'Contact Us List', 'Add,Edit,View,Delete', 1),
(16, 'Course Enrollment List', 'Add,Edit,View,Delete', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `id` int(5) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`id`, `email`) VALUES
(4, 'rajgudduara18@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0-Inactive 1-Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `page_name`, `status`, `added_on`, `updated_on`) VALUES
(1, 'home ', '1', '2021-07-22 16:51:33', '2021-07-22 12:20:22'),
(3, 'contact us', '1', '2021-07-22 17:51:01', '0000-00-00 00:00:00'),
(4, 'about us', '1', '2021-07-22 17:51:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_privilege`
--

CREATE TABLE `tbl_privilege` (
  `id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `crud_ids` varchar(150) NOT NULL,
  `added_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_privilege`
--

INSERT INTO `tbl_privilege` (`id`, `privilege_id`, `menu_id`, `crud_ids`, `added_at`) VALUES
(61, 1, 2, '1,2,3,4', '2022-12-16'),
(163, 3, 1, '1,4', '2022-12-30'),
(166, 6, 1, '1,2,3,4', '2023-02-19'),
(360, 1, 1, '1,2,3,4,5', '2023-05-02'),
(361, 1, 6, '1,2', '2023-05-02'),
(362, 1, 7, '1,2,3,4', '2023-05-02'),
(363, 1, 8, '1,2,3,4', '2023-05-02'),
(364, 1, 9, '1,2,3,4', '2023-05-02'),
(365, 1, 10, '1,2,3,4', '2023-05-02'),
(366, 1, 11, '1,2,3,4', '2023-05-02'),
(367, 1, 12, '1,2,3', '2023-05-02'),
(368, 1, 13, '1,2,3,4,5', '2023-05-02'),
(369, 1, 14, '1,2,3,4,5', '2023-05-02'),
(370, 1, 15, '1,2,3,4,5', '2023-05-02'),
(371, 1, 16, '1,2,3,4,5', '2023-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_privilege`
--

CREATE TABLE `tbl_role_privilege` (
  `privilege_id` int(21) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role_privilege`
--

INSERT INTO `tbl_role_privilege` (`privilege_id`, `post_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2022-12-15', '2023-05-02'),
(3, 'Sub-Admin', 1, '2022-12-15', '2022-12-30'),
(6, 'Employee', 1, '2023-02-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `getintuch_email` varchar(100) DEFAULT NULL,
  `bookfreeconsultation_email` varchar(100) DEFAULT NULL,
  `careeraplynow_email` varchar(100) DEFAULT NULL,
  `news_subscribtion_email` varchar(100) DEFAULT NULL,
  `blog_subscribtion_email` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `facebook_link` varchar(200) DEFAULT NULL,
  `twitter_link` varchar(200) DEFAULT NULL,
  `google_link` varchar(200) DEFAULT NULL,
  `linkedin_link` varchar(200) DEFAULT NULL,
  `youtube_link` varchar(200) DEFAULT NULL,
  `instagram_link` varchar(200) DEFAULT NULL,
  `pinterest_link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `address`, `phone`, `email`, `getintuch_email`, `bookfreeconsultation_email`, `careeraplynow_email`, `news_subscribtion_email`, `blog_subscribtion_email`, `name`, `website`, `facebook_link`, `twitter_link`, `google_link`, `linkedin_link`, `youtube_link`, `instagram_link`, `pinterest_link`) VALUES
(1, 'H.O: Maharaja Hata Katira Road Ara', '9334297522,      8271389825,     06182-232058', 'info.hubtechs@gmail.com', '', '', '', '', '', 'Admin', 'www.hubtechitsolutions.com', 'https://www.facebook.com/profile.php?id=100064317510659&mibextid=ZbWKwL', 'https://twitter.com/', '', 'https://www.linkedin.com/in/hubtech-solutions-02405b4b', 'http://youtube.com/', 'https://instagram.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_termcondition`
--

CREATE TABLE `tbl_termcondition` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1-Active, 0-Inactive',
  `added_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_termcondition`
--

INSERT INTO `tbl_termcondition` (`id`, `title`, `url`, `description`, `status`, `added_at`, `updated_at`) VALUES
(1, 'privacy policy', 'privacy-policy', 'about us', '0', '0000-00-00 00:00:00', '2021-07-20 21:15:04'),
(4, 'term condition 2', 'term-condition-2', 'term condition', '0', '2021-07-20 22:23:16', '2021-07-20 22:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonial`
--

CREATE TABLE `tbl_testimonial` (
  `id` int(5) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `post` varchar(150) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0 inactive, 1 active',
  `added_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_testimonial`
--

INSERT INTO `tbl_testimonial` (`id`, `name`, `description`, `post`, `logo`, `status`, `added_at`, `update_at`) VALUES
(16, 'salman khan', 'Abdul Rashid Salim Salman Khan ;( 27 December 1965) is an Indian film actor, producer, occasional singer and television personality who works in Hindi films. In a film career spanning over thirty years, Khan has received numerous awards, including two National Film Awards as a film producer, and two Filmfare Awards for acting. He is cited in the media as one of the most commercially successful actors of Indian cinema. ', 'Actor', 't_1678467910.jpg', '1', '2023-03-10 11:05:10', NULL),
(17, 'salman khan', 'Abdul Rashid Salim Salman Khan ;( 27 December 1965) is an Indian film actor, producer, occasional singer and television personality who works in Hindi films. In a film career spanning over thirty years, Khan has received numerous awards, including two National Film Awards as a film producer, and two Filmfare Awards for acting. He is cited in the media as one of the most commercially successful actors of Indian cinema. ', 'Actor', 't_1678468055.jpg', '0', '2023-03-10 11:07:02', '2023-03-10 11:07:42'),
(18, 'test', 'test', 'test', 't_1678468087.jpg', '0', '2023-03-10 11:08:07', NULL),
(19, 'ADCA', 'BANNER', 'OPEN', 't_1685070971.jpg', '1', '2023-05-25 22:16:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `address` varchar(400) NOT NULL,
  `added_by` int(5) NOT NULL,
  `update_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_temp`
--

CREATE TABLE `tbl_users_temp` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `country` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(400) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users_temp`
--

INSERT INTO `tbl_users_temp` (`user_id`, `fname`, `mname`, `lname`, `country`, `dob`, `gender`, `email`, `password`, `ip_address`, `phone`, `image`, `address`, `status`, `created`, `updated`) VALUES
(1, 'md', 'raj', 'guddu', 99, '1986-01-02', 'male', 'raj@yopmail.com', '123456', '::1', '9162925142', 'u_1672925916.jpg', 'delhi', 0, '2023-01-05 02:08:36', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blg_id`);

--
-- Indexes for table `tbl_cms`
--
ALTER TABLE `tbl_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_course_category`
--
ALTER TABLE `tbl_course_category`
  ADD PRIMARY KEY (`ccat_id`);

--
-- Indexes for table `tbl_faqcategory`
--
ALTER TABLE `tbl_faqcategory`
  ADD PRIMARY KEY (`faqcat_id`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_happy_client`
--
ALTER TABLE `tbl_happy_client`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `tbl_menu_list`
--
ALTER TABLE `tbl_menu_list`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role_privilege`
--
ALTER TABLE `tbl_role_privilege`
  ADD PRIMARY KEY (`privilege_id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_termcondition`
--
ALTER TABLE `tbl_termcondition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_users_temp`
--
ALTER TABLE `tbl_users_temp`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_cms`
--
ALTER TABLE `tbl_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `tbl_courses`
--
ALTER TABLE `tbl_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_course_category`
--
ALTER TABLE `tbl_course_category`
  MODIFY `ccat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_faqcategory`
--
ALTER TABLE `tbl_faqcategory`
  MODIFY `faqcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `faq_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_happy_client`
--
ALTER TABLE `tbl_happy_client`
  MODIFY `cl_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_menu_list`
--
ALTER TABLE `tbl_menu_list`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

--
-- AUTO_INCREMENT for table `tbl_role_privilege`
--
ALTER TABLE `tbl_role_privilege`
  MODIFY `privilege_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_termcondition`
--
ALTER TABLE `tbl_termcondition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_testimonial`
--
ALTER TABLE `tbl_testimonial`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users_temp`
--
ALTER TABLE `tbl_users_temp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
