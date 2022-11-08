-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2022 at 10:50 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan_mangment`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `contact_email`, `contact_phone`, `address`, `descriptions`, `created_at`, `updated_at`) VALUES
(1, 'Main', NULL, NULL, NULL, NULL, '2022-03-24 19:02:06', '2022-03-24 19:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `company_soa_reports`
--

CREATE TABLE `company_soa_reports` (
  `id` int NOT NULL,
  `statement_id` varchar(200) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `company_id` int NOT NULL DEFAULT '0',
  `date` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_soa_reports`
--

INSERT INTO `company_soa_reports` (`id`, `statement_id`, `report`, `company_id`, `date`, `created_at`, `updated_at`) VALUES
(18, '22-1661802143', '630d169fa5840.pdf', 0, '2022-08-30', '2022-08-30 08:42:23', '2022-08-30 08:42:23'),
(19, '22-0019', '6329c0207f08d.pdf', 12, '2022-09-20', '2022-09-21 02:29:04', '2022-09-21 02:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(10,6) NOT NULL,
  `base_currency` tinyint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `exchange_rate`, `base_currency`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '1.000000', 1, 1, NULL, '2022-03-19 23:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `database_backups`
--

CREATE TABLE `database_backups` (
  `id` bigint UNSIGNED NOT NULL,
  `file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_methods`
--

CREATE TABLE `deposit_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_requests`
--

CREATE TABLE `deposit_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `method_id` bigint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `transaction_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_templates`
--

CREATE TABLE `email_sms_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint NOT NULL DEFAULT '1',
  `sms_status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_sms_templates`
--

INSERT INTO `email_sms_templates` (`id`, `name`, `slug`, `subject`, `email_body`, `sms_body`, `shortcode`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'Deposit Money', 'DEPOSIT_MONEY', 'Deposit Money', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your account has been credited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(2, 'Deposit Request Approved', 'DEPOSIT_REQUEST_APPROVED', 'Deposit Request Approved', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your deposit request has been approved. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your deposit request has been approved. Your account has been credited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{depositMethod}}', 0, 0, NULL, NULL),
(3, 'FDR Request Approved', 'FDR_REQUEST_APPROVED', 'FDR Request Approved', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your FDR request of {{amount}} has been approved on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your FDR request of {{amount}} has been approved on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(4, 'Loan Request Approved', 'LOAN_REQUEST_APPROVED', 'Loan Request Approved', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your loan request has been approved. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your loan request has been approved. Your account has been credited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(5, 'Transfer Request Approved', 'TRANSFER_REQUEST_APPROVED', 'Transfer Request Approved', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(6, 'Wire Transfer Request Approved', 'WIRE_TRANSFER_REQUEST_APPROVED', 'Wire Transfer Request Approved', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your wire transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your wire transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(7, 'Withdraw Request Approved', 'WITHDRAW_REQUEST_APPROVED', 'Withdraw Request Approved', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your withdraw request has been approved. Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your withdraw request has been approved. Your account has been debited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(8, 'FDR Matured', 'FDR_MATURED', 'FDR Matured', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your FDR is already matured. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your FDR is already matured. Your account has been credited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(9, 'Payment Request', 'PAYMENT_REQUEST', 'You have Received New Payment Request', '<div>Dear Sir,</div>\r\n<div>Your have received new payment request of {{amount}} on {{dateTime}}.</div>\r\n<div>&nbsp;</div>\r\n<div>{{payNow}}</div>', 'Dear Sir, Your have received new payment request of {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{payNow}}', 0, 0, NULL, NULL),
(10, 'Payment Completed', 'PAYMENT_COMPLETED', 'Payment Completed', '<div>Dear Sir,</div>\r\n<div>Good news, You have received a payment of {{amount}} on {{dateTime}} from {{paidBy}}</div>', 'Dear Sir, Good news, You have received a payment of {{amount}} on {{dateTime}} from {{paidBy}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{paidBy}}', 0, 0, NULL, NULL),
(11, 'Deposit Request Rejected', 'DEPOSIT_REQUEST_REJECTED', 'Deposit Request Rejected', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your deposit request of {{amount}} has been rejected.</div>\r\n<div>&nbsp;</div>\r\n<div>Amount:&nbsp;{{amount}}</div>\r\n<div>Deposit Method: {{depositMethod}}</div>\r\n</div>', 'Dear Sir, Your deposit request of {{amount}} has been rejected.', '{{name}} {{email}} {{phone}} {{amount}} {{depositMethod}}', 0, 0, NULL, NULL),
(12, 'FDR Request Rejected', 'FDR_REQUEST_REJECTED', 'FDR Request Rejected', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your FDR request has been rejected. Your FDR amount {{amount}} has returned back to your account.</div>\r\n</div>', 'Dear Sir, Your FDR request has been rejected. Your FDR amount {{amount}} has returned back to your account.', '{{name}} {{email}} {{phone}} {{amount}}', 0, 0, NULL, NULL),
(13, 'Loan Request Rejected', 'LOAN_REQUEST_REJECTED', 'Loan Request Rejected', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your loan request of {{amount}} has been rejected on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your loan request of {{amount}} has been rejected on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}', 0, 0, NULL, NULL),
(14, 'Transfer Request Rejected', 'TRANSFER_REQUEST_REJECTED', 'Transfer Request Rejected', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.</div>\r\n</div>', 'Dear Sir, Your transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.', '{{name}} {{email}} {{phone}} {{amount}}', 0, 0, NULL, NULL),
(15, 'Wire Transfer Rejected', 'WIRE_TRANSFER_REJECTED', 'Wire Transfer Rejected', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your wire transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.</div>\r\n</div>', 'Dear Sir, Your wire transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.', '{{name}} {{email}} {{phone}} {{amount}}', 0, 0, NULL, NULL),
(16, 'Withdraw Request Rejected', 'WITHDRAW_REQUEST_REJECTED', 'Withdraw Request Rejected', '<div>\r\n<div>Dear Sir, Your withdraw request has been rejected. Your transferred amount {{amount}} has returned back to your account.</div>\r\n</div>', 'Dear Sir, Your withdraw request has been rejected. Your transferred amount {{amount}} has returned back to your account.', '{{name}} {{email}} {{phone}} {{amount}}', 0, 0, NULL, NULL),
(17, 'Withdraw Money', 'WITHDRAW_MONEY', 'Withdraw Money', '<div>\r\n<div>Dear Sir,</div>\r\n<div>Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>', 'Dear Sir, Your account has been debited by {{amount}} on {{dateTime}}', '{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{withdrawMethod}}', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `order` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2021-08-31 15:06:18', '2021-08-31 15:06:18'),
(2, 1, NULL, '2021-08-31 15:09:26', '2021-08-31 15:09:26'),
(3, 1, NULL, '2021-08-31 15:09:39', '2021-08-31 15:09:39'),
(4, 1, NULL, '2021-09-05 20:47:59', '2021-09-05 20:47:59'),
(5, 1, NULL, '2021-09-05 20:58:05', '2021-09-05 20:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `faq_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `locale`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'English', 'How to open an account?', 'Account opening is very easy. Just need to click Sign Up and enter some initial details for opening account. After that you need to verify your email address and that\'s ready to go.', '2021-08-31 15:07:50', '2021-09-05 20:37:10'),
(2, 2, 'English', 'How to deposit money?', 'You can deposit money via online payment gateway such as PayPal, Stripe, Razorpay, Paystack, Flutterwave as well as BlockChain for bitcoin. You can also deposit money by coming to our office physically.', '2021-08-31 15:09:26', '2021-09-05 20:38:39'),
(3, 3, 'English', 'How to withdraw money from my account?', 'We have different types of withdraw method. You can withdraw money to your bank account as well as your mobile banking account.', '2021-08-31 15:09:39', '2021-09-05 20:47:11'),
(7, 4, 'English', 'How to Apply for Loan?', 'You can apply loan based on your collateral.', '2021-09-05 20:47:59', '2021-09-05 20:47:59'),
(8, 5, 'English', 'How to Apply for Fixed Deposit?', 'If you have available balance in your account then you can apply for fixed deposit.', '2021-09-05 20:58:05', '2021-09-05 20:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `fdrs`
--

CREATE TABLE `fdrs` (
  `id` bigint UNSIGNED NOT NULL,
  `fdr_plan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint UNSIGNED NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `return_amount` decimal(10,2) NOT NULL,
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `approved_date` date DEFAULT NULL,
  `mature_date` date DEFAULT NULL,
  `transaction_id` bigint DEFAULT NULL,
  `approved_user_id` bigint DEFAULT NULL,
  `created_user_id` bigint DEFAULT NULL,
  `updated_user_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fdr_plans`
--

CREATE TABLE `fdr_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `duration` int NOT NULL,
  `duration_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fdr_plans`
--

INSERT INTO `fdr_plans` (`id`, `name`, `minimum_amount`, `maximum_amount`, `interest_rate`, `duration`, `duration_type`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '10.00', '500.00', '8.00', 12, 'month', 0, NULL, '2021-08-09 19:34:14', '2022-03-19 23:25:37'),
(2, 'Standard', '100.00', '1000.00', '10.00', 24, 'month', 0, NULL, '2021-09-05 18:39:11', '2022-03-19 23:25:30'),
(3, 'Professional', '500.00', '20000.00', '15.00', 36, 'month', 0, NULL, '2021-09-05 18:40:06', '2022-03-19 23:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `gift_cards`
--

CREATE TABLE `gift_cards` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `user_id` bigint DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_product_id` bigint UNSIGNED NOT NULL,
  `borrower_id` bigint UNSIGNED NOT NULL,
  `first_payment_date` date NOT NULL,
  `release_date` date DEFAULT NULL,
  `currency_id` bigint NOT NULL,
  `applied_amount` decimal(10,2) NOT NULL,
  `total_payable` decimal(10,2) DEFAULT NULL,
  `total_paid` decimal(10,2) DEFAULT NULL,
  `late_payment_penalties` decimal(10,2) NOT NULL,
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `approved_date` date DEFAULT NULL,
  `approved_user_id` bigint DEFAULT NULL,
  `created_user_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `loan_purpose_id` bigint UNSIGNED NOT NULL,
  `endoresment_required` tinyint DEFAULT '0',
  `endoresmented` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loan_id`, `loan_product_id`, `borrower_id`, `first_payment_date`, `release_date`, `currency_id`, `applied_amount`, `total_payable`, `total_paid`, `late_payment_penalties`, `attachment`, `description`, `remarks`, `status`, `approved_date`, `approved_user_id`, `created_user_id`, `branch_id`, `created_at`, `updated_at`, `loan_purpose_id`, `endoresment_required`, `endoresmented`) VALUES
(15, '1012', 6, 6, '2022-08-14', '2022-08-14', 1, '20000.00', '21800.00', '3733.33', '3.00', '', NULL, NULL, 1, '2022-08-15', 1, 1, NULL, '2022-08-14 06:04:06', '2022-08-16 02:57:45', 1, NULL, 0),
(17, '1014', 10, 6, '2022-08-15', '2022-08-15', 1, '1300000.00', '2002000.00', '55627.78', '3.00', '', NULL, NULL, 1, '2022-08-15', 1, 1, NULL, '2022-08-16 02:18:17', '2022-08-22 03:59:01', 8, 1, 0),
(18, '1015', 12, 6, '2022-09-15', '2022-08-15', 1, '30000.00', '35400.00', '3000.00', '3.00', '', NULL, NULL, 1, '2022-08-15', 1, 1, NULL, '2022-08-16 04:23:18', '2022-08-22 04:00:04', 1, NULL, 0),
(19, '1016', 12, 13, '2022-05-15', '2022-04-15', 1, '20000.00', '23600.00', NULL, '3.00', '', NULL, 'FOR RELEASING', 1, '2022-09-06', 1, 1, NULL, '2022-09-06 21:31:02', '2022-09-06 21:31:10', 2, NULL, 0),
(20, '1017', 12, 15, '2022-05-15', '2022-04-15', 1, '100000.00', '118000.00', NULL, '3.00', '', NULL, NULL, 0, NULL, NULL, 1, NULL, '2022-09-06 22:01:46', '2022-09-06 22:01:46', 4, NULL, 0),
(22, '1019', 12, 16, '2022-05-01', '2022-04-01', 1, '20000.00', '23600.00', NULL, '3.00', '', NULL, NULL, 1, '2022-09-06', 1, 1, NULL, '2022-09-06 22:36:51', '2022-09-06 22:36:58', 4, NULL, 0),
(23, '1020', 12, 6, '2022-10-19', '2022-09-19', 1, '40000.00', '47200.00', NULL, '3.00', '', NULL, 'FOR RELEASING', 1, '2022-09-19', 1, 1, NULL, '2022-09-20 04:29:05', '2022-09-20 04:29:20', 1, NULL, 0),
(24, '1021', 11, 6, '2022-10-19', '2022-09-19', 1, '10000.00', '10750.00', NULL, '3.00', '', NULL, NULL, 1, '2022-09-19', 1, 1, NULL, '2022-09-20 04:45:32', '2022-09-20 04:45:49', 2, NULL, 0),
(25, '1022', 12, 6, '2022-10-21', '2022-09-21', 1, '100000.00', '118000.00', NULL, '3.00', '', NULL, 'SUBJECT FOR REVIEW.', 0, NULL, NULL, 1, NULL, '2022-09-21 22:52:17', '2022-09-21 22:52:18', 1, 1, 0),
(26, '1023', 16, 6, '2022-10-26', '2022-10-26', 1, '500000.00', '1100000.00', NULL, '5.00', '', 'jldsfv sdv sdvsd v', 'sdvn df,sd  dflj sdv', 1, '2022-10-26', 1, 1, NULL, '2022-10-26 15:34:41', '2022-10-26 15:34:48', 1, NULL, 0),
(27, '1024', 16, 13, '2022-10-26', '2022-10-26', 1, '500000.00', '650000.00', NULL, '5.00', '', 'kj nmjb kjj k,m', NULL, 1, '2022-10-26', 1, 1, NULL, '2022-10-26 15:40:32', '2022-10-26 15:40:35', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_collaterals`
--

CREATE TABLE `loan_collaterals` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `collateral_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_price` decimal(10,2) NOT NULL,
  `attachments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint NOT NULL,
  `loan_repayment_id` int DEFAULT NULL,
  `paid_at` date NOT NULL,
  `late_penalties` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint NOT NULL,
  `transaction_id` bigint NOT NULL,
  `repayment_id` bigint NOT NULL,
  `reciept` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_payments`
--

INSERT INTO `loan_payments` (`id`, `loan_id`, `loan_repayment_id`, `paid_at`, `late_penalties`, `interest`, `amount_to_pay`, `remarks`, `user_id`, `transaction_id`, `repayment_id`, `reciept`, `status`, `created_at`, `updated_at`) VALUES
(16, 15, 169, '2022-08-15', '600.00', '300.00', '3733.33', 'payment for the month August', 6, 35, 169, '1660571865Screen Shot 2022-08-15 at 13.03.28.png', 0, '2022-08-16 02:57:45', '2022-08-16 02:57:45'),
(17, 17, 175, '2022-08-21', '39000.00', '19500.00', '55627.78', NULL, 6, 37, 175, '1661093941image for zoom.jpg', 0, '2022-08-22 03:59:01', '2022-08-22 03:59:01'),
(18, 18, 211, '2022-08-21', '0.00', '450.00', '3000.00', NULL, 6, 38, 211, '1661094004image for zoom 2.jpg', 1, '2022-08-22 04:00:04', '2022-08-26 02:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `loan_products`
--

CREATE TABLE `loan_products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `interest_rate` decimal(10,2) NOT NULL,
  `interest_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` int NOT NULL,
  `term_period` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `visibility` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `down_payment` int NOT NULL,
  `penalties` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_products`
--

INSERT INTO `loan_products` (`id`, `name`, `minimum_amount`, `maximum_amount`, `description`, `interest_rate`, `interest_type`, `term`, `term_period`, `status`, `visibility`, `created_at`, `updated_at`, `down_payment`, `penalties`) VALUES
(6, 'CM6', '50000.00', '2000000.00', NULL, '1.50', 'fixed_rate', 6, '+1 month', 1, 'Public', '2022-08-14 05:37:48', '2022-08-16 04:19:14', 0, 3),
(7, 'CM12', '50000.00', '2000000.00', NULL, '1.50', 'fixed_rate', 12, '+1 month', 1, 'Public', '2022-08-14 05:38:43', '2022-08-16 04:18:43', 0, 3),
(8, 'CM18', '50000.00', '2000000.00', NULL, '1.50', 'fixed_rate', 18, '+1 month', 1, 'Public', '2022-08-14 05:40:16', '2022-08-16 04:18:27', 0, 3),
(9, 'CM24', '50000.00', '1000000.00', NULL, '1.50', 'fixed_rate', 24, '+1 month', 1, 'Public', '2022-08-14 05:41:06', '2022-08-16 04:18:08', 0, 3),
(10, 'CM36', '50000.00', '2000000.00', NULL, '1.50', 'fixed_rate', 36, '+1 month', 1, 'Public', '2022-08-14 05:42:07', '2022-08-16 02:16:43', 0, 3),
(11, 'MPL6', '10000.00', '100000.00', NULL, '1.25', 'fixed_rate', 6, '+1 month', 1, 'Public', '2022-08-14 05:44:23', '2022-08-16 01:59:45', 0, 3),
(12, 'MPL12', '10000.00', '100000.00', NULL, '1.50', 'fixed_rate', 12, '+1 month', 1, 'Public', '2022-08-14 05:45:16', '2022-08-16 02:00:02', 0, 3),
(13, 'MPL18', '10000.00', '100000.00', NULL, '1.75', 'fixed_rate', 18, '+1 month', 1, 'Public', '2022-08-14 05:46:20', '2022-08-16 02:00:21', 0, 3),
(14, 'MPL24', '10000.00', '100000.00', NULL, '2.00', 'fixed_rate', 24, '+1 month', 1, 'Public', '2022-08-14 05:47:15', '2022-08-16 02:00:35', 0, 3),
(15, 'MPL36', '10000.00', '100000.00', NULL, '2.25', 'fixed_rate', 36, '+1 month', 1, 'Public', '2022-08-14 05:48:13', '2022-08-16 02:00:47', 0, 3),
(16, 'sample loan', '100.00', '5000.00', NULL, '5.00', 'diminishing_rate', 6, '+1 month', 1, 'Public', '2022-10-26 15:33:54', '2022-10-26 15:36:53', 200, 5);

-- --------------------------------------------------------

--
-- Table structure for table `loan_product_transaction_fees`
--

CREATE TABLE `loan_product_transaction_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_product_id` bigint UNSIGNED NOT NULL,
  `transaction_fee_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_product_transaction_fees`
--

INSERT INTO `loan_product_transaction_fees` (`id`, `loan_product_id`, `transaction_fee_id`, `created_at`, `updated_at`) VALUES
(11, 2, 7, NULL, NULL),
(12, 2, 6, NULL, NULL),
(15, 4, 9, NULL, NULL),
(16, 4, 7, NULL, NULL),
(20, 3, 8, NULL, NULL),
(21, 3, 7, NULL, NULL),
(24, 1, 7, NULL, NULL),
(25, 1, 6, NULL, NULL),
(66, 11, 7, NULL, NULL),
(67, 11, 6, NULL, NULL),
(70, 13, 7, NULL, NULL),
(71, 13, 6, NULL, NULL),
(72, 14, 7, NULL, NULL),
(73, 14, 6, NULL, NULL),
(74, 15, 7, NULL, NULL),
(75, 15, 6, NULL, NULL),
(110, 10, 10, NULL, NULL),
(111, 9, 7, NULL, NULL),
(112, 9, 6, NULL, NULL),
(113, 8, 7, NULL, NULL),
(114, 8, 6, NULL, NULL),
(115, 7, 7, NULL, NULL),
(116, 7, 6, NULL, NULL),
(117, 6, 7, NULL, NULL),
(118, 6, 6, NULL, NULL),
(121, 12, 7, NULL, NULL),
(122, 12, 6, NULL, NULL),
(129, 16, 8, NULL, NULL),
(130, 16, 7, NULL, NULL),
(131, 16, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_purposes`
--

CREATE TABLE `loan_purposes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_purposes`
--

INSERT INTO `loan_purposes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Personal Use', '2022-04-17 20:37:28', '2022-04-17 20:37:28'),
(2, 'Emergency Expenses', '2022-04-17 20:38:13', '2022-04-17 20:42:18'),
(3, 'Home Improvement', '2022-04-17 20:39:18', '2022-04-17 20:39:18'),
(4, 'Debt Consolidation', '2022-04-17 20:39:38', '2022-04-17 20:39:38'),
(5, 'Education Expenses', '2022-04-17 20:40:17', '2022-04-17 20:42:58'),
(6, 'Appliance Purchase', '2022-04-17 20:43:13', '2022-04-17 20:43:13'),
(7, 'Vacation Expenses', '2022-04-17 20:43:35', '2022-04-17 20:43:35'),
(8, 'Vehicle Purchase', '2022-04-17 20:43:50', '2022-04-17 20:43:50'),
(9, 'Business Expansion', '2022-06-15 19:32:47', '2022-06-15 19:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE `loan_repayments` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint NOT NULL,
  `repayment_date` date NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `principal_amount` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_repayments`
--

INSERT INTO `loan_repayments` (`id`, `loan_id`, `repayment_date`, `amount_to_pay`, `penalty`, `principal_amount`, `interest`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(169, 15, '2022-08-14', '3733.33', '600.00', '3333.33', '300.00', '18066.67', 2, '2022-08-15 20:05:21', '2022-08-16 02:57:45'),
(170, 15, '2022-09-14', '3733.33', '600.00', '3333.33', '300.00', '14333.33', 1, '2022-08-15 20:05:21', '2022-09-20 04:21:46'),
(171, 15, '2022-10-14', '3733.33', '600.00', '3333.33', '300.00', '10600.00', 0, '2022-08-15 20:05:21', '2022-08-15 20:05:21'),
(172, 15, '2022-11-14', '3733.33', '600.00', '3333.33', '300.00', '6866.67', 0, '2022-08-15 20:05:21', '2022-08-15 20:05:21'),
(173, 15, '2022-12-14', '3733.33', '600.00', '3333.33', '300.00', '3133.33', 0, '2022-08-15 20:05:21', '2022-08-15 20:05:21'),
(174, 15, '2023-01-14', '3733.33', '600.00', '3333.33', '300.00', '-600.00', 0, '2022-08-15 20:05:21', '2022-08-15 20:05:21'),
(175, 17, '2022-08-15', '55627.78', '39000.00', '36111.11', '19500.00', '1946372.22', 2, '2022-08-16 02:19:30', '2022-08-22 03:59:01'),
(176, 17, '2022-09-15', '55627.78', '39000.00', '36111.11', '19500.00', '1890744.44', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(177, 17, '2022-10-15', '55627.78', '39000.00', '36111.11', '19500.00', '1835116.67', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(178, 17, '2022-11-15', '55627.78', '39000.00', '36111.11', '19500.00', '1779488.89', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(179, 17, '2022-12-15', '55627.78', '39000.00', '36111.11', '19500.00', '1723861.11', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(180, 17, '2023-01-15', '55627.78', '39000.00', '36111.11', '19500.00', '1668233.33', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(181, 17, '2023-02-15', '55627.78', '39000.00', '36111.11', '19500.00', '1612605.56', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(182, 17, '2023-03-15', '55627.78', '39000.00', '36111.11', '19500.00', '1556977.78', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(183, 17, '2023-04-15', '55627.78', '39000.00', '36111.11', '19500.00', '1501350.00', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(184, 17, '2023-05-15', '55627.78', '39000.00', '36111.11', '19500.00', '1445722.22', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(185, 17, '2023-06-15', '55627.78', '39000.00', '36111.11', '19500.00', '1390094.44', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(186, 17, '2023-07-15', '55627.78', '39000.00', '36111.11', '19500.00', '1334466.67', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(187, 17, '2023-08-15', '55627.78', '39000.00', '36111.11', '19500.00', '1278838.89', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(188, 17, '2023-09-15', '55627.78', '39000.00', '36111.11', '19500.00', '1223211.11', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(189, 17, '2023-10-15', '55627.78', '39000.00', '36111.11', '19500.00', '1167583.33', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(190, 17, '2023-11-15', '55627.78', '39000.00', '36111.11', '19500.00', '1111955.56', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(191, 17, '2023-12-15', '55627.78', '39000.00', '36111.11', '19500.00', '1056327.78', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(192, 17, '2024-01-15', '55627.78', '39000.00', '36111.11', '19500.00', '1000700.00', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(193, 17, '2024-02-15', '55627.78', '39000.00', '36111.11', '19500.00', '945072.22', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(194, 17, '2024-03-15', '55627.78', '39000.00', '36111.11', '19500.00', '889444.44', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(195, 17, '2024-04-15', '55627.78', '39000.00', '36111.11', '19500.00', '833816.67', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(196, 17, '2024-05-15', '55627.78', '39000.00', '36111.11', '19500.00', '778188.89', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(197, 17, '2024-06-15', '55627.78', '39000.00', '36111.11', '19500.00', '722561.11', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(198, 17, '2024-07-15', '55627.78', '39000.00', '36111.11', '19500.00', '666933.33', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(199, 17, '2024-08-15', '55627.78', '39000.00', '36111.11', '19500.00', '611305.56', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(200, 17, '2024-09-15', '55627.78', '39000.00', '36111.11', '19500.00', '555677.78', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(201, 17, '2024-10-15', '55627.78', '39000.00', '36111.11', '19500.00', '500050.00', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(202, 17, '2024-11-15', '55627.78', '39000.00', '36111.11', '19500.00', '444422.22', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(203, 17, '2024-12-15', '55627.78', '39000.00', '36111.11', '19500.00', '388794.44', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(204, 17, '2025-01-15', '55627.78', '39000.00', '36111.11', '19500.00', '333166.67', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(205, 17, '2025-02-15', '55627.78', '39000.00', '36111.11', '19500.00', '277538.89', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(206, 17, '2025-03-15', '55627.78', '39000.00', '36111.11', '19500.00', '221911.11', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(207, 17, '2025-04-15', '55627.78', '39000.00', '36111.11', '19500.00', '166283.33', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(208, 17, '2025-05-15', '55627.78', '39000.00', '36111.11', '19500.00', '110655.56', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(209, 17, '2025-06-15', '55627.78', '39000.00', '36111.11', '19500.00', '55027.78', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(210, 17, '2025-07-15', '55627.78', '39000.00', '36111.11', '19500.00', '-600.00', 0, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(211, 18, '2022-09-15', '3000.00', '900.00', '2500.00', '450.00', '32400.00', 1, '2022-08-16 04:23:43', '2022-08-26 02:29:36'),
(212, 18, '2022-10-15', '3000.00', '900.00', '2500.00', '450.00', '29400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(213, 18, '2022-11-15', '3000.00', '900.00', '2500.00', '450.00', '26400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(214, 18, '2022-12-15', '3000.00', '900.00', '2500.00', '450.00', '23400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(215, 18, '2023-01-15', '3000.00', '900.00', '2500.00', '450.00', '20400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(216, 18, '2023-02-15', '3000.00', '900.00', '2500.00', '450.00', '17400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(217, 18, '2023-03-15', '3000.00', '900.00', '2500.00', '450.00', '14400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(218, 18, '2023-04-15', '3000.00', '900.00', '2500.00', '450.00', '11400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(219, 18, '2023-05-15', '3000.00', '900.00', '2500.00', '450.00', '8400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(220, 18, '2023-06-15', '3000.00', '900.00', '2500.00', '450.00', '5400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(221, 18, '2023-07-15', '3000.00', '900.00', '2500.00', '450.00', '2400.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(222, 18, '2023-08-15', '3000.00', '900.00', '2500.00', '450.00', '-600.00', 0, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(223, 19, '2022-05-15', '2016.67', '600.00', '1666.67', '300.00', '21583.33', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(224, 19, '2022-06-15', '2016.67', '600.00', '1666.67', '300.00', '19566.67', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(225, 19, '2022-07-15', '2016.67', '600.00', '1666.67', '300.00', '17550.00', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(226, 19, '2022-08-15', '2016.67', '600.00', '1666.67', '300.00', '15533.33', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(227, 19, '2022-09-15', '2016.67', '600.00', '1666.67', '300.00', '13516.67', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(228, 19, '2022-10-15', '2016.67', '600.00', '1666.67', '300.00', '11500.00', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(229, 19, '2022-11-15', '2016.67', '600.00', '1666.67', '300.00', '9483.33', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(230, 19, '2022-12-15', '2016.67', '600.00', '1666.67', '300.00', '7466.67', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(231, 19, '2023-01-15', '2016.67', '600.00', '1666.67', '300.00', '5450.00', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(232, 19, '2023-02-15', '2016.67', '600.00', '1666.67', '300.00', '3433.33', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(233, 19, '2023-03-15', '2016.67', '600.00', '1666.67', '300.00', '1416.67', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(234, 19, '2023-04-15', '2016.67', '600.00', '1666.67', '300.00', '-600.00', 0, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(241, 22, '2022-05-01', '2016.67', '600.00', '1666.67', '300.00', '21583.33', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(242, 22, '2022-06-01', '2016.67', '600.00', '1666.67', '300.00', '19566.67', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(243, 22, '2022-07-01', '2016.67', '600.00', '1666.67', '300.00', '17550.00', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(244, 22, '2022-08-01', '2016.67', '600.00', '1666.67', '300.00', '15533.33', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(245, 22, '2022-09-01', '2016.67', '600.00', '1666.67', '300.00', '13516.67', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(246, 22, '2022-10-01', '2016.67', '600.00', '1666.67', '300.00', '11500.00', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(247, 22, '2022-11-01', '2016.67', '600.00', '1666.67', '300.00', '9483.33', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(248, 22, '2022-12-01', '2016.67', '600.00', '1666.67', '300.00', '7466.67', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(249, 22, '2023-01-01', '2016.67', '600.00', '1666.67', '300.00', '5450.00', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(250, 22, '2023-02-01', '2016.67', '600.00', '1666.67', '300.00', '3433.33', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(251, 22, '2023-03-01', '2016.67', '600.00', '1666.67', '300.00', '1416.67', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(252, 22, '2023-04-01', '2016.67', '600.00', '1666.67', '300.00', '-600.00', 0, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(253, 23, '2022-10-19', '3933.33', '1200.00', '3333.33', '600.00', '43266.67', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(254, 23, '2022-11-19', '3933.33', '1200.00', '3333.33', '600.00', '39333.33', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(255, 23, '2022-12-19', '3933.33', '1200.00', '3333.33', '600.00', '35400.00', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(256, 23, '2023-01-19', '3933.33', '1200.00', '3333.33', '600.00', '31466.67', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(257, 23, '2023-02-19', '3933.33', '1200.00', '3333.33', '600.00', '27533.33', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(258, 23, '2023-03-19', '3933.33', '1200.00', '3333.33', '600.00', '23600.00', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(259, 23, '2023-04-19', '3933.33', '1200.00', '3333.33', '600.00', '19666.67', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(260, 23, '2023-05-19', '3933.33', '1200.00', '3333.33', '600.00', '15733.33', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(261, 23, '2023-06-19', '3933.33', '1200.00', '3333.33', '600.00', '11800.00', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(262, 23, '2023-07-19', '3933.33', '1200.00', '3333.33', '600.00', '7866.67', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(263, 23, '2023-08-19', '3933.33', '1200.00', '3333.33', '600.00', '3933.33', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(264, 23, '2023-09-19', '3933.33', '1200.00', '3333.33', '600.00', '0.00', 0, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(265, 24, '2022-10-19', '1841.67', '300.00', '1666.67', '125.00', '8908.33', 0, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(266, 24, '2022-11-19', '1841.67', '300.00', '1666.67', '125.00', '7066.67', 0, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(267, 24, '2022-12-19', '1841.67', '300.00', '1666.67', '125.00', '5225.00', 0, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(268, 24, '2023-01-19', '1841.67', '300.00', '1666.67', '125.00', '3383.33', 0, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(269, 24, '2023-02-19', '1841.67', '300.00', '1666.67', '125.00', '1541.67', 0, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(270, 24, '2023-03-19', '1841.67', '300.00', '1666.67', '125.00', '-300.00', 0, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(271, 26, '2022-10-26', '91666.67', '25000.00', '41666.67', '50000.00', '458333.33', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(272, 26, '2022-11-26', '87500.00', '25000.00', '41666.67', '45833.33', '416666.67', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(273, 26, '2022-12-26', '83333.33', '25000.00', '41666.67', '41666.67', '375000.00', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(274, 26, '2023-01-26', '79166.67', '25000.00', '41666.67', '37500.00', '333333.33', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(275, 26, '2023-02-26', '75000.00', '25000.00', '41666.67', '33333.33', '291666.67', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(276, 26, '2023-03-26', '70833.33', '25000.00', '41666.67', '29166.67', '250000.00', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(277, 26, '2023-04-26', '66666.67', '25000.00', '41666.67', '25000.00', '208333.33', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(278, 26, '2023-05-26', '62500.00', '25000.00', '41666.67', '20833.33', '166666.67', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(279, 26, '2023-06-26', '58333.33', '25000.00', '41666.67', '16666.67', '125000.00', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(280, 26, '2023-07-26', '54166.67', '25000.00', '41666.67', '12500.00', '83333.33', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(281, 26, '2023-08-26', '50000.00', '25000.00', '41666.67', '8333.33', '41666.67', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(282, 26, '2023-09-26', '45833.33', '25000.00', '41666.67', '4166.67', '0.00', 0, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(283, 27, '2022-10-26', '108333.33', '25000.00', '83333.33', '25000.00', '416666.67', 0, '2022-10-26 15:40:35', '2022-10-26 15:40:35'),
(284, 27, '2022-11-26', '104166.67', '25000.00', '83333.33', '20833.33', '333333.33', 0, '2022-10-26 15:40:35', '2022-10-26 15:40:35'),
(285, 27, '2022-12-26', '100000.00', '25000.00', '83333.33', '16666.67', '250000.00', 0, '2022-10-26 15:40:35', '2022-10-26 15:40:35'),
(286, 27, '2023-01-26', '95833.33', '25000.00', '83333.33', '12500.00', '166666.67', 0, '2022-10-26 15:40:35', '2022-10-26 15:40:35'),
(287, 27, '2023-02-26', '91666.67', '25000.00', '83333.33', '8333.33', '83333.33', 0, '2022-10-26 15:40:35', '2022-10-26 15:40:35'),
(288, 27, '2023-03-26', '87500.00', '25000.00', '83333.33', '4166.67', '0.00', 0, '2022-10-26 15:40:35', '2022-10-26 15:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_11_12_152015_create_email_templates_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_09_01_080940_create_settings_table', 1),
(6, '2020_07_02_145857_create_database_backups_table', 1),
(7, '2020_07_06_142817_create_roles_table', 1),
(8, '2020_07_06_143240_create_permissions_table', 1),
(9, '2021_03_22_071324_create_setting_translations', 1),
(10, '2021_07_02_145504_create_pages_table', 1),
(11, '2021_07_02_145952_create_page_translations_table', 1),
(12, '2021_08_06_104648_create_branches_table', 1),
(13, '2021_08_07_100944_create_other_banks_table', 1),
(14, '2021_08_07_111236_create_currency_table', 1),
(15, '2021_08_08_132702_create_payment_gateways_table', 1),
(16, '2021_08_08_152535_create_deposit_methods_table', 1),
(17, '2021_08_08_164152_create_withdraw_methods_table', 1),
(18, '2021_08_09_064023_create_transactions_table', 1),
(19, '2021_08_09_132854_create_fdr_plans_table', 1),
(20, '2021_08_10_075622_create_gift_cards_table', 1),
(21, '2021_08_10_095536_create_fdrs_table', 1),
(22, '2021_08_10_102503_create_support_tickets_table', 1),
(23, '2021_08_10_102527_create_support_ticket_messages_table', 1),
(24, '2021_08_20_092846_create_payment_requests_table', 1),
(25, '2021_08_20_150101_create_deposit_requests_table', 1),
(26, '2021_08_20_160124_create_withdraw_requests_table', 1),
(27, '2021_08_23_160216_create_notifications_table', 1),
(28, '2021_08_31_070908_create_services_table', 1),
(29, '2021_08_31_071002_create_service_translations_table', 1),
(30, '2021_08_31_075115_create_news_table', 1),
(31, '2021_08_31_075125_create_news_translations_table', 1),
(32, '2021_08_31_094252_create_faqs_table', 1),
(33, '2021_08_31_094301_create_faq_translations_table', 1),
(34, '2021_08_31_101309_create_testimonials_table', 1),
(35, '2021_08_31_101319_create_testimonial_translations_table', 1),
(36, '2021_08_31_201125_create_navigations_table', 1),
(37, '2021_08_31_201126_create_navigation_items_table', 1),
(38, '2021_08_31_201127_create_navigation_item_translations_table', 1),
(39, '2021_09_04_142110_create_teams_table', 1),
(40, '2021_10_04_082019_create_loan_products_table', 1),
(41, '2021_10_06_070947_create_loans_table', 1),
(42, '2021_10_06_071153_create_loan_collaterals_table', 1),
(43, '2021_10_09_110842_add_2fa_columns_to_users_table', 1),
(44, '2021_10_12_071843_add_allow_withdrawal_to_users_table', 1),
(45, '2021_10_12_104151_create_loan_repayments_table', 1),
(46, '2021_10_14_065743_create_loan_payments_table', 1),
(47, '2021_10_22_070458_create_email_sms_templates_table', 1),
(48, '2022_02_01_071417_add_account_number_to_users_table', 1),
(49, '2022_02_10_053301_add_document_verified_at_to_users_table', 1),
(50, '2022_02_10_063611_create_user_documents_table', 1),
(51, '2022_03_26_122558_create_loan_purposes_table', 2),
(52, '2022_03_30_194122_add_column_to_users_table', 2),
(53, '2022_04_07_205237_add_columns_to_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Primary Menu', 1, '2021-08-31 16:11:31', '2021-08-31 16:11:31'),
(2, 'Quick Explore', 1, '2021-08-31 23:11:36', '2021-08-31 23:11:36'),
(3, 'Pages', 1, '2021-08-31 23:11:43', '2021-09-04 21:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `navigation_items`
--

CREATE TABLE `navigation_items` (
  `id` bigint UNSIGNED NOT NULL,
  `navigation_id` bigint UNSIGNED NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint UNSIGNED DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `position` int UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `css_class` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigation_items`
--

INSERT INTO `navigation_items` (`id`, `navigation_id`, `type`, `page_id`, `url`, `icon`, `target`, `parent_id`, `position`, `status`, `css_class`, `css_id`, `created_at`, `updated_at`) VALUES
(6, 1, 'dynamic_url', NULL, '/', NULL, '_self', NULL, 1, 1, NULL, NULL, '2021-08-31 22:17:46', '2021-08-31 22:28:52'),
(7, 1, 'dynamic_url', NULL, '/about', NULL, '_self', NULL, 2, 1, NULL, NULL, '2021-08-31 22:17:58', '2021-08-31 22:28:52'),
(8, 1, 'dynamic_url', NULL, '/services', NULL, '_self', NULL, 3, 1, NULL, NULL, '2021-08-31 22:18:44', '2021-08-31 22:28:52'),
(10, 1, 'dynamic_url', NULL, 'faq', NULL, '_self', NULL, 4, 1, NULL, NULL, '2021-08-31 22:19:27', '2021-09-04 21:20:28'),
(11, 1, 'dynamic_url', NULL, '/contact', NULL, '_self', NULL, 5, 1, NULL, NULL, '2021-08-31 22:19:43', '2021-09-04 21:20:28'),
(15, 2, 'dynamic_url', NULL, '/contact', NULL, '_self', NULL, 1, 1, NULL, NULL, '2021-08-31 23:12:42', '2021-09-04 21:22:17'),
(20, 2, 'dynamic_url', NULL, '/about', NULL, '_self', NULL, 2, 1, NULL, NULL, '2021-09-04 21:21:32', '2021-09-04 21:22:17'),
(21, 2, 'dynamic_url', NULL, '/services', NULL, '_self', NULL, 3, 1, NULL, NULL, '2021-09-04 21:22:06', '2021-09-04 21:22:17'),
(22, 3, 'page', 2, NULL, NULL, '_self', NULL, 2, 1, NULL, NULL, '2021-09-04 21:22:58', '2021-09-04 21:23:26'),
(23, 3, 'page', 1, NULL, NULL, '_self', NULL, 1, 1, NULL, NULL, '2021-09-04 21:23:10', '2021-09-04 21:23:26'),
(24, 3, 'dynamic_url', NULL, '/faq', NULL, '_self', NULL, 3, 1, NULL, NULL, '2021-09-04 21:23:20', '2021-09-04 21:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `navigation_item_translations`
--

CREATE TABLE `navigation_item_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `navigation_item_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigation_item_translations`
--

INSERT INTO `navigation_item_translations` (`id`, `navigation_item_id`, `locale`, `name`, `created_at`, `updated_at`) VALUES
(6, 6, 'English', 'Home', '2021-08-31 22:17:46', '2021-08-31 22:17:46'),
(7, 7, 'English', 'About', '2021-08-31 22:17:58', '2021-08-31 22:17:58'),
(8, 8, 'English', 'Services', '2021-08-31 22:18:44', '2021-08-31 22:18:44'),
(10, 10, 'English', 'FAQ', '2021-08-31 22:19:27', '2021-08-31 22:19:27'),
(11, 11, 'English', 'Contact', '2021-08-31 22:19:43', '2021-08-31 22:19:43'),
(15, 15, 'English', 'Contact', '2021-08-31 23:12:42', '2021-09-04 21:22:15'),
(26, 20, 'English', 'About', '2021-09-04 21:21:32', '2021-09-04 21:21:32'),
(27, 21, 'English', 'Services', '2021-09-04 21:22:06', '2021-09-04 21:22:06'),
(28, 22, 'English', 'Terms & Condition', '2021-09-04 21:22:58', '2021-09-04 21:22:58'),
(29, 23, 'English', 'Privacy Policy', '2021-09-04 21:23:10', '2021-09-04 21:23:10'),
(30, 24, 'English', 'FAQ', '2021-09-04 21:23:20', '2021-09-04 21:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_user_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_translations`
--

CREATE TABLE `news_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `news_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('04025753-c738-41ad-a255-09c07701ca49', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-06-16 00:44:46', '2022-06-16 00:44:46'),
('1794b090-97ea-4dca-a3f9-12eae09c1a07', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-05-24 00:30\"}', NULL, '2022-05-24 05:30:12', '2022-05-24 05:30:12'),
('190d5c93-495c-41d3-8617-d149db085c1f', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 11, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b18,130,000.00 on 2022-06-15 20:01\"}', NULL, '2022-06-16 01:01:04', '2022-06-16 01:01:04'),
('1cc5c3a9-0c77-4bd6-a791-00a19a04d7b8', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 9, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b12,000.00 on 2022-06-21 00:31\"}', NULL, '2022-06-21 05:31:42', '2022-06-21 05:31:42'),
('23e2f1e4-6cbb-4a72-9631-276c52e7d799', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-06-21 00:19\"}', NULL, '2022-06-21 05:19:53', '2022-06-21 05:19:53'),
('271deec3-07ce-4fae-be8f-20660e20023a', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-06-21 05:19:34', '2022-06-21 05:19:34'),
('28fe01db-a362-43b2-a22c-70d66310586a', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 8, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-06-21 00:26\"}', NULL, '2022-06-21 05:26:44', '2022-06-21 05:26:44'),
('298f9a96-4803-4dc6-a21a-80c47d5eebeb', 'App\\Notifications\\RejectLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request of \\u20b11,300,000.00 has been rejected on 2022-08-15 21:17\"}', NULL, '2022-08-16 02:17:11', '2022-08-16 02:17:11'),
('34fcdc8b-2fb4-4dd7-91fe-3284d37ca2a8', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 7, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-05-24 19:37\"}', NULL, '2022-05-25 00:37:48', '2022-05-25 00:37:48'),
('3737c037-2f38-4c95-9d20-5730c7f814d7', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 11, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b18,130,000.00 on 2022-06-15 19:45\"}', NULL, '2022-06-16 00:45:18', '2022-06-16 00:45:18'),
('38435617-979e-45dd-a757-badfa65184e5', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-06-21 05:26:38', '2022-06-21 05:26:38'),
('3c0849b2-1cbb-46b7-af68-f0f90943b8bd', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b150,000.00 on 2022-07-28 21:42\"}', NULL, '2022-07-29 02:42:30', '2022-07-29 02:42:30'),
('40f86532-2ef0-4202-a305-6bfb008913b1', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-08-16 02:18:17', '2022-08-16 02:18:17'),
('5bb87bd1-09d3-4294-b4d3-1267d72e0386', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 10, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b1100,000.00 on 2022-05-31 00:07\"}', NULL, '2022-05-31 05:07:09', '2022-05-31 05:07:09'),
('5d01c949-2e79-4848-a142-b2e88b4f8a32', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-06-16 00:53:29', '2022-06-16 00:53:29'),
('62f8215f-a536-4cb4-9c01-4615ae51cbdf', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 2, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b15,000.00 on 2022-04-27 06:00\"}', NULL, '2022-04-27 11:00:56', '2022-04-27 11:00:56'),
('64defd6e-0e6e-482d-b790-4a5bfb043478', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-09-19 23:45\"}', NULL, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
('6db5fb8e-2379-4917-8f34-2a3900ab3033', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-06-21 05:31:27', '2022-06-21 05:31:27'),
('74ec27da-1397-4fe5-8aea-873175be2b18', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-06-20 20:19\"}', NULL, '2022-06-21 01:19:03', '2022-06-21 01:19:03'),
('839c9458-61f0-47f5-b308-d69238ab784a', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 9, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-06-21 00:33\"}', NULL, '2022-06-21 05:33:21', '2022-06-21 05:33:21'),
('84737a7e-ba36-44fb-b5fb-01d4c4489226', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b1500,000.00 on 2022-10-26 20:34\"}', NULL, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
('872d751c-e127-4339-86bb-a04a016e73d4', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b140,000.00 on 2022-09-19 23:29\"}', NULL, '2022-09-20 04:29:21', '2022-09-20 04:29:21'),
('9bd9a4ac-46ac-4f43-8d4e-07415770e643', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 17, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b17,500.00 on 2022-09-06 17:34\"}', NULL, '2022-09-06 22:34:03', '2022-09-06 22:34:03'),
('a06ab2ff-d518-4c7f-8876-3d9289bd7efc', 'App\\Notifications\\WithdrawMoney', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your account has been debited by \\u20b11,000.00 on 2022-08-12 20:49\"}', NULL, '2022-08-13 01:49:26', '2022-08-13 01:49:26'),
('a4e5c86e-0be7-4a1e-8c3e-350f9bf36e7b', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 9, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-05-25 00:14\"}', NULL, '2022-05-25 05:14:25', '2022-05-25 05:14:25'),
('b2127c86-0ac2-4890-baba-1fc130a37298', 'App\\Notifications\\DepositMoney', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your account has been credited by \\u20b11,000.00 on 2022-08-12 20:46\"}', NULL, '2022-08-13 01:46:46', '2022-08-13 01:46:46'),
('b8adc240-cb56-4264-9dae-529827697a65', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 16, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-09-06 17:36\"}', NULL, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
('c4376ea8-5237-4212-82b8-05af22a6ccb3', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 3, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b14,000.00 on 2022-04-27 06:08\"}', NULL, '2022-04-27 11:08:05', '2022-04-27 11:08:05'),
('c6e03b05-9f58-4998-9eea-fc7480c473ec', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 4, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-04-22 17:52\"}', NULL, '2022-04-22 22:52:10', '2022-04-22 22:52:10'),
('d44a1607-42a4-443c-8fb2-be965fb84ac0', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 8, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-05-24 23:52\"}', NULL, '2022-05-25 04:52:53', '2022-05-25 04:52:53'),
('d5634b70-5036-44f9-8999-2b9b29a5dd6d', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 4, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-04-18 09:41\"}', NULL, '2022-04-18 14:41:35', '2022-04-18 14:41:35'),
('d63e3144-bbaf-4464-a48c-052825353639', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 13, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b1500,000.00 on 2022-10-26 20:40\"}', NULL, '2022-10-26 15:40:35', '2022-10-26 15:40:35'),
('d777925b-4c76-46f3-bac4-5cc68cbe6153', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-09-21 22:52:17', '2022-09-21 22:52:17'),
('dde47b17-858d-4a7f-9a37-6675170e026b', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b130,000.00 on 2022-08-15 23:23\"}', NULL, '2022-08-16 04:23:45', '2022-08-16 04:23:45'),
('e34f10d4-66c9-4f99-bd28-1276a1cece63', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 3, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b110,000.00 on 2022-04-19 00:12\"}', NULL, '2022-04-19 05:12:34', '2022-04-19 05:12:34'),
('e4673d72-d22f-469d-afda-17330ba10efc', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 11, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b18,130,000.00 on 2022-06-15 17:32\"}', NULL, '2022-06-15 22:32:16', '2022-06-15 22:32:16'),
('e94cca64-684a-4cd3-bc0d-e5ae0f5984f1', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 13, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-09-06 16:31\"}', NULL, '2022-09-06 21:31:11', '2022-09-06 21:31:11'),
('f3e8ba09-f95b-46fc-bcbb-0b5f5a4b5a27', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b11,300,000.00 on 2022-08-15 21:19\"}', NULL, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
('f5a96172-33b3-4cee-b53c-295c6eaf19d4', 'App\\Notifications\\ApprovedLoanRequest', 'App\\Models\\User', 6, '{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20b120,000.00 on 2022-08-15 15:05\"}', NULL, '2022-08-15 20:05:22', '2022-08-15 20:05:22'),
('fcb882d6-aa2f-464b-aee7-bed0efad661c', 'App\\Notifications\\RequireEndorsementLetter', 'App\\Models\\User', 5, '{\"message\":\"New Loan require Endorsement Letter.\"}', NULL, '2022-06-21 05:33:15', '2022-06-21 05:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `other_banks`
--

CREATE TABLE `other_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_currency` bigint NOT NULL,
  `minimum_transfer_amount` decimal(10,2) NOT NULL,
  `maximum_transfer_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'privacy-policy', 1, '2021-08-31 15:42:32', '2021-08-31 15:42:32'),
(2, 'terms-condition', 1, '2021-08-31 15:44:42', '2021-08-31 15:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `page_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 'English', 'Privacy Policy', '<h1>Privacy Policy for Livo Bank</h1>\r\n<p>At LivoBank, accessible from https://livo-bank.trickycode.xyz, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by LivoBank and how we use it.</p>\r\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>\r\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in LivoBank. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href=\"https://www.termsfeed.com/privacy-policy-generator/\">TermsFeed Privacy Policy Generator</a>.</p>\r\n<h2>Consent</h2>\r\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>\r\n<h2>Information we collect</h2>\r\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>\r\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>\r\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>\r\n<h2>How we use your information</h2>\r\n<p>We use the information we collect in various ways, including to:</p>\r\n<ul>\r\n<li>Provide, operate, and maintain our website</li>\r\n<li>Improve, personalize, and expand our website</li>\r\n<li>Understand and analyze how you use our website</li>\r\n<li>Develop new products, services, features, and functionality</li>\r\n<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>\r\n<li>Send you emails</li>\r\n<li>Find and prevent fraud</li>\r\n</ul>\r\n<h2>Log Files</h2>\r\n<p>LivoBank follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.</p>\r\n<h2>Advertising Partners Privacy Policies</h2>\r\n<p>You may consult this list to find the Privacy Policy for each of the advertising partners of LivoBank.</p>\r\n<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on LivoBank, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>\r\n<p>Note that LivoBank has no access to or control over these cookies that are used by third-party advertisers.</p>\r\n<h2>Third Party Privacy Policies</h2>\r\n<p>LivoBank\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>\r\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites.</p>\r\n<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>\r\n<p>Under the CCPA, among other rights, California consumers have the right to:</p>\r\n<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>\r\n<p>Request that a business delete any personal data about the consumer that a business has collected.</p>\r\n<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.</p>\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n<h2>GDPR Data Protection Rights</h2>\r\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>\r\n<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>\r\n<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>\r\n<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>\r\n<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>\r\n<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>\r\n<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n<h2>Children\'s Information</h2>\r\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>\r\n<p>LivoBank does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>', '2021-08-31 15:42:32', '2021-09-05 19:27:37'),
(2, 2, 'English', 'Terms & Condition', '<h2><strong>Terms and Conditions</strong></h2>\r\n<p>Welcome to LivoBank!</p>\r\n<p>These terms and conditions outline the rules and regulations for the use of Livo Bank\'s Website, located at https://livo-bank.trickycode.xyz.</p>\r\n<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use LivoBank if you do not agree to take all of the terms and conditions stated on this page.</p>\r\n<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company’s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>\r\n<h3><strong>Cookies</strong></h3>\r\n<p>We employ the use of cookies. By accessing LivoBank, you agreed to use cookies in agreement with the Livo Bank\'s Privacy Policy.</p>\r\n<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>\r\n<h3><strong>License</strong></h3>\r\n<p>Unless otherwise stated, Livo Bank and/or its licensors own the intellectual property rights for all material on LivoBank. All intellectual property rights are reserved. You may access this from LivoBank for your own personal use subjected to restrictions set in these terms and conditions.</p>\r\n<p>You must not:</p>\r\n<ul>\r\n<li>Republish material from LivoBank</li>\r\n<li>Sell, rent or sub-license material from LivoBank</li>\r\n<li>Reproduce, duplicate or copy material from LivoBank</li>\r\n<li>Redistribute content from LivoBank</li>\r\n</ul>\r\n<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href=\"https://www.termsandconditionsgenerator.com\">Terms And Conditions Generator</a>.</p>\r\n<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Livo Bank does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Livo Bank,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Livo Bank shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>\r\n<p>Livo Bank reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>\r\n<p>You warrant and represent that:</p>\r\n<ul>\r\n<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>\r\n<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>\r\n<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>\r\n<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>\r\n</ul>\r\n<p>You hereby grant Livo Bank a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>\r\n<h3><strong>Hyperlinking to our Content</strong></h3>\r\n<p>The following organizations may link to our Website without prior written approval:</p>\r\n<ul>\r\n<li>Government agencies;</li>\r\n<li>Search engines;</li>\r\n<li>News organizations;</li>\r\n<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>\r\n<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>\r\n</ul>\r\n<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>\r\n<p>We may consider and approve other link requests from the following types of organizations:</p>\r\n<ul>\r\n<li>commonly-known consumer and/or business information sources;</li>\r\n<li>dot.com community sites;</li>\r\n<li>associations or other groups representing charities;</li>\r\n<li>online directory distributors;</li>\r\n<li>internet portals;</li>\r\n<li>accounting, law and consulting firms; and</li>\r\n<li>educational institutions and trade associations.</li>\r\n</ul>\r\n<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Livo Bank; and (d) the link is in the context of general resource information.</p>\r\n<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>\r\n<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Livo Bank. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>\r\n<p>Approved organizations may hyperlink to our Website as follows:</p>\r\n<ul>\r\n<li>By use of our corporate name; or</li>\r\n<li>By use of the uniform resource locator being linked to; or</li>\r\n<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>\r\n</ul>\r\n<p>No use of Livo Bank\'s logo or other artwork will be allowed for linking absent a trademark license agreement.</p>\r\n<h3><strong>iFrames</strong></h3>\r\n<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>\r\n<h3><strong>Content Liability</strong></h3>\r\n<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>\r\n<h3><strong>Your Privacy</strong></h3>\r\n<p>Please read Privacy Policy</p>\r\n<h3><strong>Reservation of Rights</strong></h3>\r\n<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>\r\n<h3><strong>Removal of links from our website</strong></h3>\r\n<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>\r\n<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>\r\n<h3><strong>Disclaimer</strong></h3>\r\n<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>\r\n<ul>\r\n<li>limit or exclude our or your liability for death or personal injury;</li>\r\n<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>\r\n<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>\r\n<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>\r\n</ul>\r\n<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>\r\n<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>', '2021-08-31 15:44:42', '2021-09-05 19:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `currency` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `exchange_rate` decimal(10,6) DEFAULT NULL,
  `fixed_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `charge_in_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `minimum_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maximum_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `slug`, `image`, `status`, `parameters`, `currency`, `supported_currencies`, `extra`, `exchange_rate`, `fixed_charge`, `charge_in_percentage`, `minimum_amount`, `maximum_amount`, `created_at`, `updated_at`) VALUES
(1, 'PayPal', 'PayPal', 'paypal.png', 0, '{\"client_id\":\"\",\"client_secret\":\"\",\"environment\":\"sandbox\"}', NULL, '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL),
(2, 'Stripe', 'Stripe', 'stripe.png', 0, '{\"secret_key\":\"\",\"publishable_key\":\"\"}', NULL, '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL),
(3, 'Razorpay', 'Razorpay', 'razorpay.png', 0, '{\"razorpay_key_id\":\"\",\"razorpay_key_secret\":\"\"}', NULL, '{\"INR\":\"INR\"}', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL),
(4, 'Paystack', 'Paystack', 'paystack.png', 0, '{\"paystack_public_key\":\"\",\"paystack_secret_key\":\"\"}', NULL, '{\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL),
(5, 'BlockChain', 'BlockChain', 'blockchain.png', 0, '{\"blockchain_api_key\":\"\",\"blockchain_xpub\":\"\"}', NULL, '{\"BTC\":\"BTC\"}', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL),
(6, 'Flutterwave', 'Flutterwave', 'flutterwave.png', 0, '{\"public_key\":\"\",\"secret_key\":\"\",\"encryption_key\":\"\",\"environment\":\"sandbox\"}', NULL, '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `currency_id` bigint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sender_id` bigint NOT NULL,
  `receiver_id` bigint NOT NULL,
  `transaction_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint NOT NULL,
  `permission` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `created_at`, `updated_at`) VALUES
(36, 2, 'dashboard.active_users_widget', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(37, 2, 'dashboard.pending_kyc_widget', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(38, 2, 'dashboard.pending_tickets_widget', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(39, 2, 'dashboard.loan_requests_widget', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(40, 2, 'dashboard.fdr_requests_widget', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(41, 2, 'dashboard.recent_transaction_widget', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(42, 2, 'users.send_email', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(43, 2, 'users.send_sms', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(44, 2, 'users.documents', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(45, 2, 'users.view_documents', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(46, 2, 'users.documents.varify', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(47, 2, 'users.documents.unvarify', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(48, 2, 'users.index', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(49, 2, 'users.create', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(50, 2, 'users.show', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(51, 2, 'transactions.index', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(52, 2, 'loan_products.index', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(53, 2, 'loan_products.show', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(54, 2, 'loans.admin_calculator', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(55, 2, 'loans.calculate', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(56, 2, 'loans.loan_payment_status', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(57, 2, 'loans.index', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(58, 2, 'loans.create', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(59, 2, 'loans.show', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(60, 2, 'loans.edit', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(61, 2, 'loan_collaterals.index', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(62, 2, 'loan_collaterals.create', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(63, 2, 'loan_collaterals.show', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(64, 2, 'loan_collaterals.edit', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(65, 2, 'support_tickets.assign_staff', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(66, 2, 'support_tickets.mark_as_closed', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(67, 2, 'support_tickets.reply', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(68, 2, 'support_tickets.index', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(69, 2, 'support_tickets.create', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(70, 2, 'support_tickets.show', '2022-10-10 07:23:11', '2022-10-10 07:23:11'),
(71, 2, 'reports.loan_report', '2022-10-10 07:23:11', '2022-10-10 07:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', NULL, '2022-05-24 04:57:12', '2022-05-24 04:57:12'),
(2, 'LOAN OFFICER', NULL, '2022-09-22 00:39:18', '2022-09-22 00:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `created_at`, `updated_at`) VALUES
(2, '<i class=\"icofont-paper-plane\"></i>', '2021-08-31 12:34:38', '2021-09-05 20:33:22'),
(3, '<i class=\"icofont-money\"></i>', '2021-08-31 12:35:33', '2021-09-05 16:29:47'),
(4, '<i class=\"icofont-exchange\"></i>', '2021-08-31 12:38:26', '2021-09-05 16:30:04'),
(5, '<i class=\"icofont-bank-alt\"></i>', '2021-08-31 12:38:44', '2021-09-05 16:30:19'),
(6, '<i class=\"icofont-file-text\"></i>', '2021-08-31 12:39:01', '2021-09-05 16:30:32'),
(7, '<i class=\"icofont-pay\"></i>', '2021-08-31 12:39:19', '2021-09-05 16:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_translations`
--

INSERT INTO `service_translations` (`id`, `service_id`, `locale`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 2, 'English', 'Money Transfer', 'Paragraph of text beneath the heading to explain the heading.', '2021-08-31 12:34:38', '2021-08-31 12:34:38'),
(2, 3, 'English', 'Multi Currency', 'Paragraph of text beneath the heading to explain the heading.', '2021-08-31 12:35:33', '2021-09-05 16:34:07'),
(3, 4, 'English', 'Exchange Currency', 'Paragraph of text beneath the heading to explain the heading.', '2021-08-31 12:38:26', '2021-08-31 12:38:26'),
(4, 5, 'English', 'Fixed Deposit', 'Paragraph of text beneath the heading to explain the heading.', '2021-08-31 12:38:44', '2021-08-31 12:38:44'),
(5, 6, 'English', 'Apply Loan', 'Paragraph of text beneath the heading to explain the heading.', '2021-08-31 12:39:01', '2021-08-31 12:39:01'),
(6, 7, 'English', 'Payment Request', 'Paragraph of text beneath the heading to explain the heading.', '2021-08-31 12:39:19', '2021-08-31 12:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'mail_type', 'smtp', NULL, NULL),
(2, 'backend_direction', 'ltr', NULL, '2022-04-17 16:16:37'),
(3, 'language', 'English', NULL, '2022-09-06 23:04:21'),
(4, 'email_verification', 'disabled', NULL, '2022-04-17 16:16:37'),
(5, 'allow_singup', 'yes', NULL, '2022-04-17 16:16:37'),
(6, 'company_name', 'FINCO', '2022-03-19 15:07:16', '2022-09-06 23:04:21'),
(7, 'site_title', 'FIN', '2022-03-19 15:07:16', '2022-09-06 23:04:21'),
(8, 'phone', '09399939201', '2022-03-19 15:07:16', '2022-09-06 23:04:21'),
(9, 'email', 'finco@mail.intellitaxtrust.com', '2022-03-19 15:07:16', '2022-09-06 23:04:21'),
(10, 'timezone', 'Asia/Manila', '2022-03-19 15:07:16', '2022-09-06 23:04:21'),
(38, 'main_heading', 'Quisque non tellus orci ac auctor augue mauris augue', '2021-08-31 20:38:10', '2022-03-19 23:29:37'),
(39, 'sub_heading', 'Venenatis tellus in metus vulputate eu scelerisque', '2021-08-31 20:39:15', '2022-03-19 23:29:37'),
(40, 'about_us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2021-08-31 20:39:15', '2021-08-31 20:57:30'),
(41, 'copyright', 'Copyright © 2022 <a href=\"#\" target=\"_blank\">FIN</a>  -  All Rights Reserved.', '2021-08-31 20:39:15', '2022-03-19 23:16:44'),
(46, 'meta_keywords', '', '2021-08-31 20:39:15', '2021-08-31 20:39:15'),
(47, 'meta_content', '', '2021-08-31 20:39:15', '2021-08-31 20:39:15'),
(48, 'our_mission', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.</p>', '2021-08-31 20:54:44', '2021-08-31 20:54:44'),
(49, 'footer_about_us', 'Velit euismod in pellentesque massa placerat duis. Egestas pretium aenean pharetra magna. Mi sit amet mauris commodo quis imperdiet massa. Duis at tellus at urna condimentum.', '2021-08-31 20:58:14', '2022-03-19 23:28:32'),
(51, 'primary_menu', '1', '2021-08-31 22:30:14', '2021-08-31 22:30:14'),
(52, 'footer_menu_1', '2', '2021-08-31 22:30:14', '2021-08-31 23:13:31'),
(53, 'footer_menu_1_title', 'Quick Explore', '2021-09-01 11:50:56', '2021-09-01 11:50:56'),
(54, 'footer_menu_2_title', 'Pages', '2021-09-01 11:50:56', '2021-09-05 16:24:45'),
(55, 'footer_menu_2', '3', '2021-09-01 11:50:56', '2021-09-01 11:50:56'),
(56, 'home_about_us_heading', 'About Us', '2021-09-05 15:52:18', '2021-09-05 15:54:38'),
(57, 'home_about_us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2021-09-05 15:52:18', '2021-09-05 15:52:18'),
(58, 'home_service_content', 'Sed risus ultricies tristique nulla aliquet enim tortor at auctor. Et molestie ac feugiat sed lectus vestibulum.', '2021-09-05 15:52:18', '2022-03-19 23:29:37'),
(59, 'home_fixed_deposit_heading', 'Possimus sint', '2021-09-05 15:52:18', '2022-03-19 23:27:11'),
(60, 'home_fixed_deposit_content', 'Volutpat est velit egestas dui id.', '2021-09-05 15:52:18', '2022-03-19 23:29:37'),
(61, 'home_loan_heading', 'Loan Packages', '2021-09-05 15:52:18', '2021-09-05 16:19:41'),
(62, 'home_loan_content', 'Cursus in hac habitasse platea dictumst quisque sagittis.', '2021-09-05 15:52:18', '2022-03-19 23:29:37'),
(63, 'home_testimonial_heading', 'We served over 500+ Customers', '2021-09-05 15:52:18', '2021-09-05 16:19:41'),
(64, 'home_testimonial_content', 'Id velit ut tortor pretium viverra. Turpis massa tincidunt dui ut ornare lectus sit.', '2021-09-05 15:52:18', '2022-03-19 23:29:37'),
(65, 'home_partner_heading', 'Partners who support us', '2021-09-05 15:52:18', '2021-09-05 16:19:41'),
(66, 'home_partner_content', 'Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.', '2021-09-05 15:52:18', '2021-09-05 16:19:41'),
(67, 'home_about_us_content', 'Dignissim diam quis enim lobortis scelerisque. Facilisis sed odio morbi quis commodo odio aenean sed.', '2021-09-05 15:54:15', '2022-03-19 23:29:37'),
(68, 'home_service_heading', 'Our Services', '2021-09-05 15:54:38', '2021-09-05 16:12:10'),
(69, 'total_customer', '500', '2021-09-05 16:06:39', '2021-09-05 16:08:10'),
(70, 'total_branch', '5', '2021-09-05 16:06:39', '2021-09-05 16:11:53'),
(71, 'total_transactions', '1', '2021-09-05 16:06:39', '2021-09-05 16:11:53'),
(72, 'total_countries', '200', '2021-09-05 16:06:39', '2021-09-05 16:11:53'),
(73, 'about_page_title', ' Who We Are', '2021-09-05 20:07:18', '2021-09-05 20:07:18'),
(74, 'our_team_title', 'Meet Our Team', '2021-09-05 20:07:18', '2021-09-05 20:07:18'),
(75, 'our_team_sub_title', 'Faucibus turpis in eu mi bibendum neque egestas congue. Nulla at volutpat diam ut venenatis. ', '2021-09-05 20:07:18', '2022-03-19 23:28:09'),
(76, 'about_us_content', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n<p>Vel facilisis volutpat est velit egestas dui id ornare. Euismod in pellentesque massa placerat. Mauris pellentesque pulvinar pellentesque habitant morbi. Pharetra sit amet aliquam id diam maecenas. Integer feugiat scelerisque varius morbi enim nunc faucibus. Sem et tortor consequat id porta nibh venenatis cras. Pharetra vel turpis nunc eget lorem dolor. Suspendisse ultrices gravida dictum fusce ut placerat.</p>', '2021-09-05 20:08:15', '2022-03-19 23:28:09'),
(77, 'APP_VERSION', '1.3.1', '2022-03-19 23:07:16', '2022-03-19 23:07:16'),
(78, 'website_enable', 'yes', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(79, 'currency_position', 'left', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(80, 'date_format', 'Y-m-d', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(81, 'time_format', '24', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(82, 'mobile_verification', 'disabled', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(83, 'enable_2fa', 'no', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(84, 'enable_kyc', 'no', '2022-03-19 23:07:52', '2022-04-17 16:16:37'),
(85, 'logo', 'logo.png', '2022-03-19 23:09:29', '2022-03-19 23:10:52'),
(86, 'favicon', 'file_1647684643.png', '2022-03-19 23:09:30', '2022-03-19 23:10:43'),
(87, 'facebook_link', '#', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(88, 'twitter_link', '#', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(89, 'linkedin_link', '#', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(90, 'loan_id', '1000', '2022-04-18 09:39:09', '2022-09-06 23:04:21'),
(91, 'address', '', '2022-04-18 09:39:09', '2022-09-06 23:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

CREATE TABLE `setting_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `setting_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_translations`
--

INSERT INTO `setting_translations` (`id`, `setting_id`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 53, 'English', 'Quick Explore', '2022-03-19 23:16:44', '2022-03-19 23:16:44'),
(2, 52, 'English', '2', '2022-03-19 23:16:44', '2022-03-19 23:16:44'),
(3, 54, 'English', 'Pages', '2022-03-19 23:16:44', '2022-03-19 23:16:44'),
(4, 55, 'English', '3', '2022-03-19 23:16:44', '2022-03-19 23:16:44'),
(5, 49, 'English', 'Velit euismod in pellentesque massa placerat duis. Egestas pretium aenean pharetra magna. Mi sit amet mauris commodo quis imperdiet massa. Duis at tellus at urna condimentum.', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(6, 87, 'English', '#', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(7, 88, 'English', '#', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(8, 89, 'English', '#', '2022-03-19 23:16:44', '2022-03-19 23:28:32'),
(9, 41, 'English', 'Copyright © 2022 <a href=\"#\" target=\"_blank\">FIN</a>  -  All Rights Reserved.', '2022-03-19 23:16:44', '2022-03-19 23:16:44'),
(10, 38, 'English', 'Quisque non tellus orci ac auctor augue mauris augue', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(11, 39, 'English', 'Venenatis tellus in metus vulputate eu scelerisque', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(12, 51, 'English', '1', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(13, 69, 'English', '500', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(14, 70, 'English', '5', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(15, 71, 'English', '1', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(16, 72, 'English', '200', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(17, 56, 'English', 'About Us', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(18, 67, 'English', 'Dignissim diam quis enim lobortis scelerisque. Facilisis sed odio morbi quis commodo odio aenean sed.', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(19, 68, 'English', 'Our Services', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(20, 58, 'English', 'Sed risus ultricies tristique nulla aliquet enim tortor at auctor. Et molestie ac feugiat sed lectus vestibulum.', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(21, 59, 'English', 'Possimus sint', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(22, 60, 'English', 'Volutpat est velit egestas dui id.', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(23, 61, 'English', 'Loan Packages', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(24, 62, 'English', 'Cursus in hac habitasse platea dictumst quisque sagittis.', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(25, 63, 'English', 'We served over 500+ Customers', '2022-03-19 23:27:11', '2022-03-19 23:27:11'),
(26, 64, 'English', 'Id velit ut tortor pretium viverra. Turpis massa tincidunt dui ut ornare lectus sit.', '2022-03-19 23:27:11', '2022-03-19 23:29:37'),
(27, 73, 'English', ' Who We Are', '2022-03-19 23:28:09', '2022-03-19 23:28:09'),
(28, 74, 'English', 'Meet Our Team', '2022-03-19 23:28:09', '2022-03-19 23:28:09'),
(29, 75, 'English', 'Faucibus turpis in eu mi bibendum neque egestas congue. Nulla at volutpat diam ut venenatis. ', '2022-03-19 23:28:09', '2022-03-19 23:28:09'),
(30, 76, 'English', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n<p>Vel facilisis volutpat est velit egestas dui id ornare. Euismod in pellentesque massa placerat. Mauris pellentesque pulvinar pellentesque habitant morbi. Pharetra sit amet aliquam id diam maecenas. Integer feugiat scelerisque varius morbi enim nunc faucibus. Sem et tortor consequat id porta nibh venenatis cras. Pharetra vel turpis nunc eget lorem dolor. Suspendisse ultrices gravida dictum fusce ut placerat.</p>', '2022-03-19 23:28:09', '2022-03-19 23:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `priority` tinyint NOT NULL DEFAULT '0',
  `created_user_id` bigint NOT NULL,
  `operator_id` bigint DEFAULT NULL,
  `closed_user_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `subject`, `status`, `priority`, `created_user_id`, `operator_id`, `closed_user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'I can not see my transaction', 1, 0, 4, 1, NULL, '2022-04-17 20:50:10', '2022-05-24 04:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_messages`
--

CREATE TABLE `support_ticket_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` bigint NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint NOT NULL,
  `attachment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_ticket_messages`
--

INSERT INTO `support_ticket_messages` (`id`, `support_ticket_id`, `message`, `sender_id`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 1, 'Transaction not seen on records.', 4, NULL, '2022-04-17 20:50:10', '2022-04-17 20:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_translations`
--

CREATE TABLE `testimonial_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `testimonial_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `currency_id` bigint NOT NULL DEFAULT '1',
  `amount` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dr_cr` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `loan_id` bigint DEFAULT NULL,
  `ref_id` bigint DEFAULT NULL,
  `parent_id` bigint DEFAULT NULL,
  `other_bank_id` bigint DEFAULT NULL,
  `gateway_id` bigint DEFAULT NULL,
  `created_user_id` bigint DEFAULT NULL,
  `updated_user_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `transaction_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `currency_id`, `amount`, `fee`, `dr_cr`, `type`, `method`, `status`, `note`, `loan_id`, `ref_id`, `parent_id`, `other_bank_id`, `gateway_id`, `created_user_id`, `updated_user_id`, `branch_id`, `transaction_details`, `created_at`, `updated_at`) VALUES
(29, 6, 1, '1000.00', '0.00', 'cr', 'Deposit', 'Manual', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-13 01:46:44', '2022-08-13 01:46:44'),
(30, 6, 1, '1000.00', '0.00', 'dr', 'Withdraw', 'Manual', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-13 01:49:26', '2022-08-13 01:49:26'),
(33, 6, 1, '20000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 15, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-15 20:05:21', '2022-08-15 20:05:21'),
(34, 6, 1, '1300000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 17, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-16 02:19:30', '2022-08-16 02:19:30'),
(35, 6, 1, '4333.33', '0.00', 'dr', 'Loan_Repayment', 'Online', 2, 'Loan Repayment', 15, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, '2022-08-16 02:57:45', '2022-08-16 02:57:45'),
(36, 6, 1, '30000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 18, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-08-16 04:23:43', '2022-08-16 04:23:43'),
(37, 6, 1, '94627.78', '0.00', 'dr', 'Loan_Repayment', 'Online', 2, 'Loan Repayment', 17, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, '2022-08-22 03:59:01', '2022-08-22 03:59:01'),
(38, 6, 1, '3000.00', '0.00', 'dr', 'Loan_Repayment', 'Online', 2, 'Loan Repayment', 18, NULL, NULL, NULL, NULL, 6, NULL, 1, NULL, '2022-08-22 04:00:04', '2022-08-22 04:00:04'),
(39, 13, 1, '20000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 19, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-06 21:31:10', '2022-09-06 21:31:10'),
(41, 16, 1, '20000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 22, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-06 22:36:58', '2022-09-06 22:36:58'),
(42, 6, 1, '40000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 23, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-20 04:29:20', '2022-09-20 04:29:20'),
(43, 6, 1, '10000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 24, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-09-20 04:45:49', '2022-09-20 04:45:49'),
(44, 6, 1, '500000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 26, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-10-26 15:34:48', '2022-10-26 15:34:48'),
(45, 13, 1, '500000.00', '0.00', 'cr', 'Loan', 'Manual', 2, 'Loan Approved', 27, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-10-26 15:40:35', '2022-10-26 15:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_fees`
--

CREATE TABLE `transaction_fees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `amount_from` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_to` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_fees`
--

INSERT INTO `transaction_fees` (`id`, `name`, `type`, `amount`, `amount_from`, `amount_to`, `created_at`, `updated_at`) VALUES
(6, 'Notarial Fee', 'fixed', 300, NULL, NULL, '2022-04-22 22:45:10', '2022-07-03 02:59:01'),
(7, 'Other Fees', 'fixed', 300, '1000', '20000', '2022-04-22 22:49:04', '2022-09-22 00:33:50'),
(8, 'Processing Fee', 'percentage', 2, '30001', '100000', '2022-09-20 04:25:54', '2022-09-22 01:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint DEFAULT NULL,
  `branch_id` bigint DEFAULT NULL,
  `status` int NOT NULL,
  `profile_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `sms_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `two_factor_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_expires_at` datetime DEFAULT NULL,
  `otp` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `allow_withdrawal` tinyint NOT NULL DEFAULT '1',
  `document_verified_at` timestamp NULL DEFAULT NULL,
  `document_submitted_at` timestamp NULL DEFAULT NULL,
  `company_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Male',
  `home_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_info` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` enum('single','married','widowed','seperated') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_employer_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_employer_address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_employer_position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_employer_since` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_length_service` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sbu_department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_employer_phone` int NOT NULL,
  `previous_employer_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_employer_address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_employer_position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_employer_since` date NOT NULL,
  `previous_employer_phone` int NOT NULL,
  `spouse_present_employer_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_present_employer_address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_present_employer_position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_present_employer_since` date NOT NULL,
  `spouse_present_employer_phone` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_previous_employer_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_preious_employer_address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_previous_employer_position` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_previous_employer_since` date NOT NULL,
  `spouse_previous_employer_phone` varchar(110) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `own_salary` int NOT NULL,
  `spouse_salary` int NOT NULL,
  `other_income` int NOT NULL,
  `total_income` int NOT NULL,
  `fixed_obligations` int NOT NULL,
  `other_living_expense` int NOT NULL,
  `net_monthly_income` int NOT NULL,
  `refference_first_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refference_last_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refference_company_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refference_position` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refference_address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refference_mobile` int NOT NULL,
  `verified` int NOT NULL DEFAULT '0',
  `company_id` bigint UNSIGNED DEFAULT NULL,
  `company_e_signature` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `account_number`, `user_type`, `role_id`, `branch_id`, `status`, `profile_picture`, `email_verified_at`, `sms_verified_at`, `password`, `provider`, `provider_id`, `country_code`, `remember_token`, `created_at`, `updated_at`, `two_factor_code`, `two_factor_expires_at`, `otp`, `otp_expires_at`, `allow_withdrawal`, `document_verified_at`, `document_submitted_at`, `company_code`, `company_name`, `company_address`, `first_name`, `middle_name`, `last_name`, `dob`, `age`, `gender`, `home_address`, `barangay`, `city`, `spouse_first_name`, `spouse_middle_name`, `spouse_last_name`, `company_phone`, `company_email`, `contact_info`, `user_name`, `marital_status`, `present_employer_name`, `present_employer_address`, `present_employer_position`, `present_employer_since`, `present_length_service`, `sbu_department`, `present_employer_phone`, `previous_employer_name`, `previous_employer_address`, `previous_employer_position`, `previous_employer_since`, `previous_employer_phone`, `spouse_present_employer_name`, `spouse_present_employer_address`, `spouse_present_employer_position`, `spouse_present_employer_since`, `spouse_present_employer_phone`, `spouse_previous_employer_name`, `spouse_preious_employer_address`, `spouse_previous_employer_position`, `spouse_previous_employer_since`, `spouse_previous_employer_phone`, `own_salary`, `spouse_salary`, `other_income`, `total_income`, `fixed_obligations`, `other_living_expense`, `net_monthly_income`, `refference_first_name`, `refference_last_name`, `refference_company_name`, `refference_position`, `refference_address`, `refference_mobile`, `verified`, `company_id`, `company_e_signature`) VALUES
(1, 'FIN', 'admin@admin.com', NULL, NULL, 'admin', NULL, NULL, 1, 'default.png', '2022-03-19 15:06:39', NULL, '$2y$10$yUZMPvz7m1fRW5m2NEctPe3IyTcUYKGoUvRGFlwrMJNjrnBg5dx96', NULL, NULL, NULL, 'ZbTJnGlv68rF7XgjtKzlGDyt8WENR2S5eKCvruzMBA0jVBzQmFO8n52aTuTr', '2022-03-19 15:06:39', '2022-03-19 15:06:39', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'finco', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'single', '', '', '', '0000-00-00', NULL, NULL, 0, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '0', '', '', '', '0000-00-00', '0', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, NULL, NULL),
(6, '', 'eldrian_cybermax_80@yahoo.com', '9424625912', '123132', 'customer', NULL, 1, 1, '', '2022-05-24 04:44:05', NULL, '$2y$10$6Np102lXc18NroWHH0IdzOy7dnhtZrO3pv4Ev9i4Kvp2dDNx14nk6', NULL, NULL, '63', NULL, '2022-05-24 04:43:04', '2022-05-24 04:44:42', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'GEORGE', 'ASILO', 'DANIELS', NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'single', '', '', '', '0000-00-00', NULL, NULL, 0, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '0', '', '', '', '0000-00-00', '0', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 5, NULL),
(12, '', 'melanie.camacho@pueblodepanay.com', '09959634915', NULL, 'company', NULL, NULL, 1, '', '2022-09-06 21:07:11', '2022-09-06 21:07:11', '$2y$10$Jpi1Ew9ap3y3FylqPayTneOM5zk7Xm6GPqYXjoNsn02GC82hIdu22', NULL, NULL, '63', NULL, '2022-09-06 21:14:34', '2022-09-06 21:14:34', NULL, NULL, NULL, NULL, 1, NULL, NULL, 'G3642', 'Pueblo de Panay Inc.', 'Punta dulog commercial Complex, St. Joseph Avenue, pueblo de Panay, Lawa-an, Roxas City Capiz', 'Melanie', 'Dele', 'Camacho', NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, '09399939201', 'hr@pueblodepanay.com', '09959634915', '', 'single', '', '', '', '', NULL, NULL, 0, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, NULL, NULL),
(13, '', 'jen.faulve@gmail.com', '09216785432', NULL, 'customer', NULL, NULL, 1, '', NULL, NULL, '$2y$10$qKYGSckHfPb4Hd0dSa39cuA2JAMTAtMd5Ma/tl7BhFwSXenDsVmbS', NULL, NULL, '63', NULL, '2022-09-06 21:24:20', '2022-09-06 21:24:20', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'JENNIFER', NULL, 'FAULVE', '1990-03-02', NULL, 'Male', NULL, NULL, NULL, 'none', '', 'none', NULL, NULL, NULL, '', 'single', 'BCBI', '', 'ACCOUNTING', '2014', '8', 'BCBI/ACCTG.', 2147483647, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, NULL, NULL),
(14, '', 'juliuscortel@gmail.com', '09293456798', NULL, 'customer', NULL, NULL, 1, '', '2022-09-06 21:37:49', '2022-09-06 21:37:49', '$2y$10$zjQ6w/mtcPVAUQDCVtXbQ.UV23d7UDRibK2l59SkkSuIV8P80HuUe', NULL, NULL, '63', NULL, '2022-09-06 21:43:21', '2022-09-06 21:43:21', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'JULIUS', NULL, 'CORTEL', '1995-10-31', NULL, 'Male', NULL, NULL, NULL, 'none', '', 'none', NULL, NULL, NULL, '', 'single', 'BCBI', '', 'ACCOUNTING', '2017', '5', 'BCBI/ACCTG', 2147483647, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 12, NULL),
(15, '', 'hurchielarlante@gmail.com', '09434625913', NULL, 'customer', NULL, NULL, 1, '', NULL, NULL, '$2y$10$veKS9tQxZU2ddM4.VmrG9ODPxcmO..4ZP6mq2SjGmgk90UPwSDnhC', NULL, NULL, '63', NULL, '2022-09-06 21:57:38', '2022-09-06 21:57:38', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'HURCHIEL', NULL, 'ARLANTE', '1987-12-31', NULL, 'Male', NULL, NULL, NULL, 'none', '', 'none', NULL, NULL, NULL, '', 'single', 'SHARED SERVICES', '', 'HEAD', '2013', '8 YEARS', 'SHARED SERVICES', 2147483647, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 12, NULL),
(16, '', 'larishmaedangan@gmail.com', '09345672345', NULL, 'customer', NULL, NULL, 1, '', NULL, NULL, '$2y$10$d.8OD7zw3RE6wVINWFJ4FO3P7L223jPGLjNP0zP9g6pVVEby6g87u', NULL, NULL, '63', NULL, '2022-09-06 22:18:37', '2022-09-06 22:18:37', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'LARISH-MAE', NULL, 'DANGAN', NULL, NULL, 'Male', NULL, NULL, NULL, 'none', '', 'none', NULL, NULL, NULL, '', 'single', 'PDPI', '', 'BOOKKEEPER', '2020', '3', 'PDPI/TAXATION', 2147483647, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 12, NULL),
(17, '', 'mayflordeguzman@gmail.com', '09886662323', NULL, 'customer', NULL, NULL, 1, '', NULL, NULL, '$2y$10$fVHjYBi.hG6Ko1xSZVEANOFJK3T4s9.YMlff3FuRvHpjhGwL8h9dO', NULL, NULL, '63', NULL, '2022-09-06 22:25:18', '2022-09-06 22:25:18', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'MAYFLOR', NULL, 'DE GUZMAN', NULL, NULL, 'Male', NULL, NULL, NULL, 'none', '', 'none', NULL, NULL, NULL, '', 'single', 'PDPI', '', 'HOV ASSISTANT', '2019', '3 YEARS', 'ACCOUNTING/HOV ASSISTANT', 2147483647, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 12, NULL),
(18, '', 'sample@gmail.com', NULL, NULL, 'user', 2, NULL, 1, '1664991792ta-1-1.png', '2022-10-05 20:43:12', NULL, '$2y$10$rm01cNRRzCLEvHvyRSapKe5250PJmlK4cwaLBlRM8wGxQ9zbcc/GK', NULL, NULL, NULL, NULL, '2022-10-05 20:43:12', '2022-10-05 20:43:12', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '', NULL, 'sample', 'middle', 'name', NULL, NULL, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'single', '', '', '', '', NULL, NULL, 0, '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `document_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `method_id` bigint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `transaction_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_soa_reports`
--
ALTER TABLE `company_soa_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `database_backups`
--
ALTER TABLE `database_backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_methods`
--
ALTER TABLE `deposit_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_requests`
--
ALTER TABLE `deposit_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_translations_faq_id_locale_unique` (`faq_id`,`locale`);

--
-- Indexes for table `fdrs`
--
ALTER TABLE `fdrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fdr_plans`
--
ALTER TABLE `fdr_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_cards`
--
ALTER TABLE `gift_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_loan_purpose_id_foreign` (`loan_purpose_id`);

--
-- Indexes for table `loan_collaterals`
--
ALTER TABLE `loan_collaterals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_products`
--
ALTER TABLE `loan_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_product_transaction_fees`
--
ALTER TABLE `loan_product_transaction_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_purposes`
--
ALTER TABLE `loan_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation_items`
--
ALTER TABLE `navigation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `navigation_items_parent_id_foreign` (`parent_id`),
  ADD KEY `navigation_items_page_id_foreign` (`page_id`),
  ADD KEY `navigation_items_navigation_id_index` (`navigation_id`);

--
-- Indexes for table `navigation_item_translations`
--
ALTER TABLE `navigation_item_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `navigation_item_translations_navigation_item_id_locale_unique` (`navigation_item_id`,`locale`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_translations`
--
ALTER TABLE `news_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_translations_news_id_locale_unique` (`news_id`,`locale`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `other_banks`
--
ALTER TABLE `other_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `testimonial_translations_testimonial_id_locale_unique` (`testimonial_id`,`locale`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_fees`
--
ALTER TABLE `transaction_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_soa_reports`
--
ALTER TABLE `company_soa_reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `database_backups`
--
ALTER TABLE `database_backups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_methods`
--
ALTER TABLE `deposit_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_requests`
--
ALTER TABLE `deposit_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_sms_templates`
--
ALTER TABLE `email_sms_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fdrs`
--
ALTER TABLE `fdrs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fdr_plans`
--
ALTER TABLE `fdr_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gift_cards`
--
ALTER TABLE `gift_cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `loan_collaterals`
--
ALTER TABLE `loan_collaterals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `loan_products`
--
ALTER TABLE `loan_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `loan_product_transaction_fees`
--
ALTER TABLE `loan_product_transaction_fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `loan_purposes`
--
ALTER TABLE `loan_purposes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `navigation_items`
--
ALTER TABLE `navigation_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `navigation_item_translations`
--
ALTER TABLE `navigation_item_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_translations`
--
ALTER TABLE `news_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_banks`
--
ALTER TABLE `other_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `setting_translations`
--
ALTER TABLE `setting_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `transaction_fees`
--
ALTER TABLE `transaction_fees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD CONSTRAINT `faq_translations_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faqs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_loan_purpose_id_foreign` FOREIGN KEY (`loan_purpose_id`) REFERENCES `loan_purposes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `navigation_items`
--
ALTER TABLE `navigation_items`
  ADD CONSTRAINT `navigation_items_navigation_id_foreign` FOREIGN KEY (`navigation_id`) REFERENCES `navigations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `navigation_items_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `navigation_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `navigation_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `navigation_item_translations`
--
ALTER TABLE `navigation_item_translations`
  ADD CONSTRAINT `navigation_item_translations_navigation_item_id_foreign` FOREIGN KEY (`navigation_item_id`) REFERENCES `navigation_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_translations`
--
ALTER TABLE `news_translations`
  ADD CONSTRAINT `news_translations_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD CONSTRAINT `service_translations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting_translations`
--
ALTER TABLE `setting_translations`
  ADD CONSTRAINT `setting_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `testimonial_translations`
--
ALTER TABLE `testimonial_translations`
  ADD CONSTRAINT `testimonial_translations_testimonial_id_foreign` FOREIGN KEY (`testimonial_id`) REFERENCES `testimonials` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
