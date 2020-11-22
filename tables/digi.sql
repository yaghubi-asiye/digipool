-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2020 at 08:45 AM
-- Server version: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sorg.ir`
--

-- --------------------------------------------------------

--
-- Table structure for table `sorg_cities`
--

CREATE TABLE `sorg_cities` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sorg_notification`
--

CREATE TABLE `sorg_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL DEFAULT 'بدون عنوان',
  `message` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `sms` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1 = active',
  `head_fix` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1 = active',
  `head_close` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1 = active',
  `notification` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1 = active',
  `email` int(1) NOT NULL DEFAULT 0,
  `category` int(1) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `color` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sorg_settings`
--

CREATE TABLE `sorg_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `value` varchar(150) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `sorg_settings`
--

INSERT INTO `sorg_settings` (`id`, `name`, `value`) VALUES
(1, 'daily_buy_register', '1000000'),
(2, 'IP_Access', ''),
(3, 'IP_Iran', 'off'),
(4, 'stock_perfectmoney_api', 'on'),
(5, 'stock_perfectmoney', '2000$'),
(6, 'bitcoin_apikey_gateio', '787B33B7-03F6-48C7-89DD-F6413614B320'),
(7, 'bitcoin_seckey_gateio', 'b0823a3debb68240ebd5a3953697587a1f33b438450cd241812369504070a58c'),
(8, 'perfectmoney_api_xpayserv', 'on'),
(9, 'perfectmoney_price_buy', '17300'),
(10, 'perfectmoney_price_sell', '16600'),
(11, 'perfectmoney_price_percent_buy', '800'),
(12, 'perfectmoney_price_percent_sell', '-100'),
(13, 'perfectmoney_Payer_Account', 'U25506389'),
(14, 'perfectmoney_Password', 'PKHD66!'),
(15, 'perfectmoney_AccountID', '2930539'),
(16, 'perfectmoney_api_xpayserv', 'on'),
(17, 'admin_cardbank', 'غیره فعال');

-- --------------------------------------------------------

--
-- Table structure for table `sorg_users`
--

CREATE TABLE `sorg_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `family` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_persian_ci DEFAULT NULL,
  `code_meli` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `card_meli_img` varchar(150) COLLATE utf8_persian_ci DEFAULT NULL,
  `card_meli_confirm` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1=confirm',
  `shenasname_img` varchar(150) COLLATE utf8_persian_ci DEFAULT NULL,
  `shenasname_confirm` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1=confirm',
  `id_province` int(11) DEFAULT NULL,
  `id_city` int(11) DEFAULT NULL,
  `code_posti` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_persian_ci DEFAULT NULL,
  `address_confirm` int(1) NOT NULL DEFAULT 0,
  `daily_buy` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `remember_token` varchar(500) COLLATE utf8_persian_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `access` int(1) NOT NULL DEFAULT 3 COMMENT 'if 0=block & if 3=pending & 1=access & 2=failed,profile',
  `access_reason` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `wallet` int(11) NOT NULL DEFAULT 0,
  `password` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `google2fa` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'if strLen > 0 = active',
  `sms2fa` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1=active',
  `invitationID` int(11) DEFAULT NULL,
  `firebase_token` varchar(350) COLLATE utf8_persian_ci DEFAULT NULL,
  `telegram_id` int(11) DEFAULT NULL,
  `register_via` enum('Telegram','Android','Website','') COLLATE utf8_persian_ci NOT NULL DEFAULT 'Website',
  `device` varchar(300) COLLATE utf8_persian_ci DEFAULT NULL,
  `card_meli_reason` varchar(300) COLLATE utf8_persian_ci DEFAULT NULL,
  `shenasname_reason` varchar(300) COLLATE utf8_persian_ci DEFAULT NULL,
  `address_reason` varchar(300) COLLATE utf8_persian_ci DEFAULT NULL,
  `register_ip` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `noteAdmin` varchar(300) COLLATE utf8_persian_ci DEFAULT NULL,
  `data` longtext COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `sorg_users`
--

INSERT INTO `sorg_users` (`id`, `name`, `family`, `mobile`, `email`, `phone`, `code_meli`, `card_meli_img`, `card_meli_confirm`, `shenasname_img`, `shenasname_confirm`, `id_province`, `id_city`, `code_posti`, `address`, `address_confirm`, `daily_buy`, `remember_token`, `created_at`, `updated_at`, `access`, `access_reason`, `wallet`, `password`, `google2fa`, `sms2fa`, `invitationID`, `firebase_token`, `telegram_id`, `register_via`, `device`, `card_meli_reason`, `shenasname_reason`, `address_reason`, `register_ip`, `noteAdmin`, `data`) VALUES
(4, 'اسیه', 'یعقوب', '09919860356', 'd@gmail.com', NULL, '09228944', NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, '1000000', NULL, '2020-11-09 09:50:18', '2020-11-09 09:50:18', 1, NULL, 0, '$2y$10$GuigG7dhfg0RGWeuuGGhUOuHqzjqlhGf9l.AK1Twtqf.PMO8k2Rme', '0', 1, NULL, NULL, NULL, 'Website', NULL, NULL, NULL, NULL, '127.0.0.1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sorg_users_cardbank`
--

CREATE TABLE `sorg_users_cardbank` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `account_owner` varchar(100) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام دارنده حساب',
  `bank_name` varchar(50) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام بانک',
  `card_number` varchar(16) COLLATE utf8_persian_ci NOT NULL COMMENT 'شماره کارت',
  `account_number` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'شماره حساب',
  `shaba` varchar(30) COLLATE utf8_persian_ci NOT NULL COMMENT 'شبا',
  `card_image` varchar(150) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'تصویر',
  `confirm` int(1) NOT NULL DEFAULT 0 COMMENT 'if 1=confirm and if 3=failed and 0=pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `sorg_users_cardbank`
--

INSERT INTO `sorg_users_cardbank` (`id`, `id_user`, `account_owner`, `bank_name`, `card_number`, `account_number`, `shaba`, `card_image`, `confirm`, `created_at`, `updated_at`) VALUES
(1, 4, '', 'بانک کشاورزی', '6037701508952112', '536102049', '110160000000000536102049', 'uploads/Users/2020/11/797/CardBank/$2y$10$9WN7w.IJnc5k0ULVNehu8.JR663u59LN6C.Dx5m.SMver7J9p4m.png', 1, '2020-11-18 16:00:39', '2020-11-18 16:00:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sorg_cities`
--
ALTER TABLE `sorg_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sorg_notification`
--
ALTER TABLE `sorg_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sorg_settings`
--
ALTER TABLE `sorg_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sorg_users`
--
ALTER TABLE `sorg_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`id_city`),
  ADD KEY `id_province` (`id_province`),
  ADD KEY `invitationID` (`invitationID`);

--
-- Indexes for table `sorg_users_cardbank`
--
ALTER TABLE `sorg_users_cardbank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sorg_cities`
--
ALTER TABLE `sorg_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sorg_notification`
--
ALTER TABLE `sorg_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sorg_settings`
--
ALTER TABLE `sorg_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sorg_users`
--
ALTER TABLE `sorg_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sorg_users_cardbank`
--
ALTER TABLE `sorg_users_cardbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sorg_notification`
--
ALTER TABLE `sorg_notification`
  ADD CONSTRAINT `sorg_notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `sorg_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sorg_users`
--
ALTER TABLE `sorg_users`
  ADD CONSTRAINT `sorg_users_ibfk_1` FOREIGN KEY (`id_city`) REFERENCES `sorg_cities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sorg_users_ibfk_2` FOREIGN KEY (`id_province`) REFERENCES `sorg_provinces` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sorg_users_ibfk_3` FOREIGN KEY (`invitationID`) REFERENCES `sorg_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sorg_users_cardbank`
--
ALTER TABLE `sorg_users_cardbank`
  ADD CONSTRAINT `sorg_users_cardbank_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `sorg_users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
