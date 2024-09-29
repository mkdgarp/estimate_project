-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 02:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estimate_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_subworkloads`
--

CREATE TABLE `list_subworkloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `subworkload_id` bigint(20) UNSIGNED NOT NULL,
  `factor` decimal(8,2) NOT NULL DEFAULT 1.00,
  `create_by` varchar(255) NOT NULL DEFAULT 'SYSTEM',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_child` int(11) NOT NULL DEFAULT 0,
  `is_unique` int(11) NOT NULL DEFAULT 0,
  `is_leader` int(11) NOT NULL DEFAULT 0,
  `is_country` int(11) NOT NULL DEFAULT 0,
  `list_subworkloads_child_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_subworkloads`
--

INSERT INTO `list_subworkloads` (`id`, `name`, `description`, `subworkload_id`, `factor`, `create_by`, `sort_order`, `is_child`, `is_unique`, `is_leader`, `is_country`, `list_subworkloads_child_id`, `created_at`, `updated_at`) VALUES
(1, '๑. ระดับปริญญาตรี /ปวส./ปวช./อนุปริญญา (หลักสูตรภาษาไทย)', NULL, 1, 0.00, 'SYSTEM', 10, 1, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(2, '๒. ระดับปริญญาตรี /ปวส./ปวช./อนุปริญญา (หลักสูตรนานาชาติ (English Program))', NULL, 1, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(3, '๓. ระดับบัณฑิตศึกษา (หลักสูตรภาษาไทย)', NULL, 1, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(4, '๔. ระดับบัณฑิตศึกษา (หลักสูตรนานาชาติ)', NULL, 1, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(5, '๕. โครงการพิเศษทางบูรณาการของมหาวิทยาลัยทุกระดับ', NULL, 1, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(6, 'ภาระงานสอนปฏิบัติ ทุกระดับ/ทุกประเภท', NULL, 2, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(10, 'นิเทศและประเมินผลการฝึกงาน/สหกิจศึกษา/การฝึกสอน (ต่อครั้ง) (นับได้ไม่เกิน 4 ครั้ง)', NULL, 3, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(11, 'ผู้ประสานงาน (ผู้รับผิดชอบรายวิชา)', NULL, 3, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(12, 'ปวช. (นับได้ไม่เกิน 3 เรื่อง)', NULL, 4, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(13, 'ปวส. (นับได้ไม่เกิน 3 เรื่อง)', NULL, 4, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(14, 'ปริญญาตรี (นับได้ไม่เกิน 5 เรื่อง)', NULL, 4, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(15, 'ปริญญาโท (ให้เป็นไปตามหลักเกณฑ์มาตรฐานบัณฑิตศึกษา)', NULL, 4, 8.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(16, 'ปริญญาเอก (ให้เป็นไปตามหลักเกณฑ์มาตรฐานบัณฑิตศึกษา)', NULL, 4, 12.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(17, 'การทัศนศึกษา/ศึกษาดูงานที่ปรากฏในคำอธิบายรายวิชา ชั่วโมง/โครงการ (คิดไม่เกิน ๓ โครงการ)', NULL, 5, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(18, '๑. สัดส่วนผลงานคิดได้ร้อยละ ๑๐๐ (ได้รับผลการประเมินการสอน)', NULL, 6, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(19, '๒. สัดส่วนผลงานคิดได้ร้อยละ ๗๕ (ขอรับการประเมินการสอน)', NULL, 6, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(20, '๓. สัดส่วนผลงานคิดได้ร้อยละ ๕๐ (มีรายชื่อบทความ/หนังสืออ่านประกอบ/แผนภูมิ/ ภาพเคลื่อนไหว/กรณีศึกษาและการอ้างอิงที่มา)', NULL, 6, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(21, '๔. สัดส่วนผลงานคิดได้ร้อยละ ๒๕ (มีแผนการสอน หัวข้อบรรยาย (มีรายละเอียดพอสมควร) ตาม คําอธิบายรายวิชา)', NULL, 6, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(22, '๑. สัดส่วนผลงานใหม่คิดได้ร้อยละ ๑๐๐ ของผลงาน (เผยแพร่ตามเกณฑ์ ก.พ.อ.)', NULL, 7, 16.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(23, '๒. สัดส่วนผลงานใหม่คิดได้ร้อยละ ๗๕ ของผลงาน (ขอรับการประเมินคุณภาพผลงาน (Peer Review) (ภายใน คณะหรือสํานักพิมพ์)', NULL, 7, 12.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(24, '๓. สัดส่วนผลงานใหม่คิดได้ร้อยละ ๕๐ ของผลงาน (มีสารบัญ เนื้อเรื่อง การวิเคราะห์ การสรุป การอ้างอิง บรรณานุกรม ดัชนีค้นคําอย่างน้อย ๕ บท หรือ ๘๐ หน้า)', NULL, 7, 8.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(25, '๔. สัดส่วนผลงานใหม่คิดได้ร้อยละ ๒๕ ของผลงาน (มีสารบัญ เนื้อเรื่อง การวิเคราะห์ การสรุป การอ้างอิง บรรณานุกรมอย่างน้อย ๒ บท)', NULL, 7, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(26, '๑. จัดทำข้อเสนอโครงการวิจัยโครงการเดี่ยว (ต่อเรื่อง)', NULL, 8, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(27, '๒. จัดทำข้อเสนอโครงการวิจัยชุด โครงการหลัก (ต่อเรื่อง)', NULL, 8, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(28, '๓. จัดทำข้อเสนอโครงการวิจัยชุด โครงการย่อย (ต่อเรื่อง)', NULL, 8, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(29, '๑.๑  ไม่ใช้งบประมาณ โดยผ่านความเห็นชอบจาก การวิจัย คณะ/วิทยาลัย', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(30, '๑.๒ ไม่ถึง ๑๐๐,๐๐๐ บาท', NULL, 9, 6.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(31, '๑.๓ ๑๐๐,๐๐๐ - ๕๐๐,๐๐๐ บาท', NULL, 9, 7.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(32, '๑.๔ ๕๐๐,๐๐๐ - ๑,๐๐๐,๐๐๐ บาท', NULL, 9, 8.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(33, '๑.๕ ๑,๐๐๐,๐๐๐ - ๓,๐๐๐,๐๐๐ บาท', NULL, 9, 10.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(34, '๑.๖  มากกว่า ๓,๐๐๐,๐๐๐ บาท', NULL, 9, 12.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(35, '๑.  ไม่ใช้งบประมาณ โดยผ่านความเห็นชอบจาก การวิจัย คณะ/วิทยาลัย', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(36, '๒. ไม่ถึง ๑๐๐,๐๐๐ บาท', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(37, '๓. ๑๐๐,๐๐๐ - ๕๐๐,๐๐๐ บาท', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(38, '๔. ๕๐๐,๐๐๐ - ๑,๐๐๐,๐๐๐ บาท', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(39, '๕. ๑,๐๐๐,๐๐๐ - ๓,๐๐๐,๐๐๐ บาท', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(40, '๖.  มากกว่า ๓,๐๐๐,๐๐๐ บาท', NULL, 9, 3.00, 'SYSTEM', 0, 0, 1, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(53, '๑. ไม่เกิน ๓ โครงการ', NULL, 11, 8.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(54, '๒. ๔ - ๖ โครงการย่อย', NULL, 11, 12.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(55, '๓. ๗ โครงการย่อยขึ้นไป', NULL, 11, 16.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(59, '๑. โครงการวิจัยร่วมที่ดำเนินงานกับหน่วยงานภายนอกระดับชาติ', NULL, 12, 8.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(60, '๒. โครงการวิจัยร่วมที่ดำเนินงานกับหน่วยงานระดับนานาชาติ', NULL, 12, 16.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(63, '๑. การเผยแพร่ผลงานสู่สารณะในลักษณะไดลักษณะหนึ่ง หนึ่ง หรือผ่าน สื่ออิเล็กทรอนิกส์ Online', NULL, 13, 2.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(64, '๒. ส่งรายงานการวิจัยฉบับสมบูรณ์ ฉบับบทความ', NULL, 13, 2.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(65, '๓. ส่งรายงานการวิจัยฉบับสมบูรณ์ เต็มรูปแบบ มีการเผยแพร่ตาม\nเกณฑ์ ก.พ.อ.', NULL, 13, 4.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(66, '๔. ส่งรายงานการวิจัยฉบับสมบูรณ์ เต็มรูปแบบ มี ISBN', NULL, 13, 6.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(67, '๕. ตีพิมพ์ในวารสารทางวิชาการระดับชาติ ไม่อยู่ในฐานข้อมูล Tกai\nJournal Citation Index (TCI)', NULL, 13, 2.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(68, '๖. ตีพิมพ์ในวารสารทางวิชาการะดับชาติ อยู่ในฐานข้อมูล Thai\nJournal Citation Index (TCI)', NULL, 13, 8.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(69, '๗. ตีพิมพ์ผลงานวิชาการะดับนานาชาติที่ไม่อยู่ในฐานข้อมูลที่เป็น\nที่ยอมรับในระดับนานาชาติ', NULL, 13, 4.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(70, '๘. ตีพิมพ์ผลงานวิชาการะดับนานาชาติในฐานข้อมูลที่เป็นที่เป็นที่\nยอมรับในระดับนานาชาติ เช่น Scopus, ISI', NULL, 13, 16.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(71, '๙. นำเสนอผลงานในที่ประชุมวิชาการะดับชาติที่มีรายงานการประชุม\n(Proceedings) เป็นไปตามเกณฑ์ ก.พ.อ.', NULL, 13, 4.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(72, '๑๐. นำเสนอผลงานในที่ประชุมวิชาการะดับนานาชาติที่ที่มีรายงานการ\nประชุม (Proceedings) เป็นไปตามเกณฑ์ ก.พ.อ.', NULL, 13, 6.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(73, '๑๑. ผลงานวิจัย หรือสิ่งประดิษธุ์ได้รับจดอนุสิทธิบัตร', NULL, 13, 14.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(74, '๑๒. ผลงานวิจัย หรือสิ่งประดิษฐ์ได้รับจดสิทธิบัตร', NULL, 13, 16.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(75, '๑๓. ผลงานวิจัย หรือสิ่งประดิษฐ์ได้รับจดสิทธิบัตร และนำไปใช้\nประโยชน์เชิงพาณิชย์', NULL, 13, 20.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(76, '๑๔. ผลงานวิจัย หรือสิ่งประดิษฐ์ที่ได้นำไปใช้ประโยชน์ต่อชุมชน\n(เงื่อนไข ผู้ใช้มีหนังสือรับมอบและหนังสือรับรองผลการใช้งาน จำนวน\nไม่น้อยกว่า ๕ ราย)', NULL, 13, 10.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(77, '๑๕. ได้รับรางวัลผลงานวิจัย/สิ่งประดิษฐ์ระดับชาติ', NULL, 13, 10.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(78, '๑๖. ได้รับรางวัลผลงานวิจัย/สิ่งประดิษฐ์ระดับนานาชาติ', NULL, 13, 16.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(79, '๑๗. ได้รับรางวัลผลงานวิจัย/สิ่งประติษฐ์ ดีเด่นระดับชาติ', NULL, 13, 20.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(80, '๑๘. ได้รับรางวัลผลงานวิจัย/สิ่งประดิษฐ์ ดีเด่นระดับนานาชาติ', NULL, 13, 24.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(81, '๑๙. งานสร้างสรรค์ที่มีการเผยแพร่สู่สาธารณะในลักษณะใด\nลักษณะหนึ่ง หรือผ่านสื่ออิเล็กทรอนิกส์ Online', NULL, 13, 6.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(82, '๒๐. งานสร้างสรรค์ที่ได้รับการเผยแพรในระดับสถาบัน', NULL, 13, 8.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(83, '๒๑. งานสร้างสรรค์ที่ได้รับการเผยแพรในระดับชาติ', NULL, 13, 6.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(84, '๒๒. งานสร้างสรรค์ที่ได้รับการเผยแพรในระดับความร่วมมือ\nระหว่างประเทศ', NULL, 13, 8.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(107, '๑. เป็นอาจารย์พิเศษที่ไม่มีค่าตอบแทน', NULL, 14, 5.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(108, '๒. เป็นอาจารย์พิเศษที่มีค่าตอบแทน', NULL, 14, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(109, '๓. เป็นวิทยากรบรรยายพิเศษ หน่วยงานภายใน', NULL, 14, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(110, '๕. เป็นวิทยากรบรรยายพิเศษ หรือกรรมการ อื่น ๆ ของหน่วยงานภายนอก ระดับท้องถิ่น (ตำบล อำเภอ จังหวัด)', NULL, 14, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(111, '๖. เป็นวิทยากรบรรยายพิเศษ หรือกรรมการ อื่น ๆ ของหน่วยงานภายนอก ระดับภูมิภาค', NULL, 14, 6.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(112, '๗. เป็นวิทยากรบรรยายพิเศษ หรือกรรมการ อื่น ๆ ของหน่วยงานภายนอก ระดับชาติ', NULL, 14, 9.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(113, '๗. เป็นวิทยากรบรรยายพิเศษ หรือกรรมการ อื่น ๆ ของหน่วยงานภายนอก ระดับนานาชาติ', NULL, 14, 12.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(114, 'การจัดประชุม สัมมนาฝึกอบรมและจัดนิทรรศการ ๑ วัน', NULL, 15, 9.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(115, 'การจัดประชุม สัมมนาฝึกอบรมและจัดนิทรรศการ ๒ วัน', NULL, 15, 18.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(116, 'การจัดประชุม สัมมนาฝึกอบรมและจัดนิทรรศการ ตั้งแต่ ๓ วัน ขึ้นไป', NULL, 15, 27.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(117, '๑. การเข้าร่วมประชุม สัมมนาฝึกอบรม และนิทรรศการ ๓-๓ วัน', NULL, 16, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(118, '๒. การเข้าร่วมประชุม สัมมนาฝึกอบรมและนิทรรศการ ๔-๗ วัน', NULL, 16, 1.50, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(119, '๓. การเข้าร่วมประชุม สัมมนาฝึกอบรมและนิทรรศการ ๗ วันขึ้นไป', NULL, 16, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(120, '๑. ประธานที่ปรึกษาโครงการวิจัย/วิทยานิพนธ์ ที่ไม่มีค่าตอบแทน (ต่อเรื่อง)', NULL, 17, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(121, '๒. กรรมการที่ปรึกษาโครงการวิจัย/วิทยานิพนธ์ ที่ไม่มีค่าตอบแทน (ต่อง)', NULL, 17, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(122, '๓. ประธานที่ปรึกษาโครงการวิจัย/เมธีวิจัย ที่มีค่าตอบแทน (ต่อโครงการ)', NULL, 17, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(123, '๔. กรรมการที่ปรึกษาโครงการวิจัย/เมธีวิจัย ที่มีค่าตอบแทน (ต่อโครงการ)', NULL, 17, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(124, '๕. ที่ปรึกษาผลงานทางวิชาการ ประเภทวิชาชีพเฉพาะหรือเชี่ยวชาญเฉพาะ คศ.๓,\nคศ.๔, ผศ., รศ.และ ศ. (ต่อคน)', NULL, 17, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(125, '๖. กรรมการพิจารณาผลงานทางวิชาการประเภทวิชาชีพเอพาะหรือเชี่ยวชาญ\nเฉพาะ คศ.๓, คศ.๔, ผศ., รศ.และ ศ. (ต่อคน)', NULL, 17, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(126, '๗. พิจารณาบทความทางวิชาการ (Peer Review) หรืออ่านตำรา/หนังสือ ภายใน\nและนอกมหาวิทยาลัยภาคภาษาไทย (ต่อเรื่อง)', NULL, 17, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(127, '๘. พิจารณาบทความทางวิชาการ (Peer Review) หรืออ่านตำรา/หนังสือ ภายใน\nและนอกมหาวิทยาลัยภาคภาษาต่างประเทศ (ต่อเรื่อง)', NULL, 17, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(128, '๙. พิจารณารายงานการวิจัยฉบับสมบูรณ์ (ต่อเรื่อง)', NULL, 17, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(129, '๑๐. พิจารณาข้อเสนอโครงการวิจัย (ต่อเรื่อง)', NULL, 17, 0.50, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(130, '๑๑. เป็นกองบรรณาธิการวารสารทางวิชาการ', NULL, 17, 0.50, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(131, '๑๒. เป็นบรรณาธิการวารสารทางวิชาการ', NULL, 17, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(132, '๑๓. แปลเอกสารทางวิชาการเป็นภาษาต่างประเทศ (ต่อบทคัดย่อ)', NULL, 17, 0.20, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(133, '๑๔. แปลเอกสารทางวิชาการเป็นภาษาต่างประเทศ (ต่อบทความ)', NULL, 17, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(134, '๑๕. ที่ปรึกษาหน่วยงานภาครัฐภายนอกมหาวิทยาลัย', NULL, 17, 4.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(135, '๑๖. คณะกรรมการดำเนินงานของหน่วยงานภาครัฐภายใน/ภายนอกมหาวิทยาลัย', NULL, 17, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(136, '๑๗. เป็นคณะกรรมการกลั่นกรองผลงานวิชาการเบื้องต้น (ต่อเรื่องต่อคน)', NULL, 17, 0.50, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(137, '๑๘. บริการทางวิชาการให้คำปรึกษา วิเคราะห์ ตรวจสอบงานแก่ชุมชน ฯลฯ (ต่อเรื่อง,ต่อคน)', NULL, 17, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(138, '๑๙. กรรมการประเมินผลการสอนเพื่อขอตำแหน่งทางวิชาการ', NULL, 17, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(139, '๑. รายได้ไม่ถึง ๑๐,๐๐๐ บาท', NULL, 18, 6.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(140, '๒. รายได้ ๑๐,๐๐๐ บาทขึ้นไปแต่ไม่ถึง ๕๐,๐๐๐ บาท', NULL, 18, 10.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(141, '๓. รายได้ ๕๐,๐๐๐ บาทขึ้นไปแต่ไม่ถึง ๑๐๐,๐๐๐ บาท', NULL, 18, 12.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(142, '๔. รายได้ ๑๐๐,๐๐๐ บาทขึ้นไปแต่ไม่ถึง ๕๐๐,๐๐๐ บาท', NULL, 18, 14.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(143, '๕. รายได้ ๕๐๐,๐๐๐ บาทขึ้นไปแต่ไม่ถึง ๑,๐๐๐,๐๐๐ บาท', NULL, 18, 16.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(144, '๖. รายได้ ๑,๐๐๐,๐๐๐ บาทขึ้นไปแต่ไม่ถึง ๓,๐๐๐,๐๐๐ บาท', NULL, 18, 20.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(145, '๗. รายได้ตั้งแต่ ๓,๐๐๐,๐๐๐ บาทขึ้นไป', NULL, 18, 24.00, 'SYSTEM', 0, 0, 1, 1, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(153, '๑. โครงการที่ใช้เวลา ๑ วัน', NULL, 19, 14.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(154, '๒. โครงการที่ใช้เวลา ๒ วัน', NULL, 19, 28.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(155, '๓. โครงการที่ใช้เวลา ๓ วัน', NULL, 19, 42.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(156, '๔. โครงการที่ใช้เวลา มากกว่า ๓ วัน', NULL, 19, 14.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(157, 'เข้าร่วมโครงการต่อ ๑ ครั้ง', NULL, 20, 0.50, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(158, '๑. อาจารย์ที่ปรึกษาชั้นเรียนต่อกลุ่ม', NULL, 21, 2.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(159, '๒. อาจารย์ที่ปรึกษาชมรมกิจกรรมฯ ต่อ ๑ ชมรม', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(160, '๓. อาจารย์แนะแนวต่อคำสั่ง', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(161, '๔. อาจารย์ผู้ฝึกสอนนักกีฬาต่อคำสั่งระดับเขตพื้นที่\nหรือเทียบเท่า', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(162, '๕. อาจารย์พัฒนาวินัยนักศึกษาต่อภาคการศึกษา', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(163, '๖. คณะกรรมการจัดการเรียนการสอนสหกิจศึกษา', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(164, '๗. กรรมการจัดตารางสอน/ตารางสอบ', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(165, '๘. อาจารย์ผู้ปฏิบัติหน้าที่กรรมการสหกิจศึกษา', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(166, '๙. อาจารย์ที่ปรึกษา/อาจารย์ผู้สอน/อาจารย์ผู้ควบคุมกิจกรรม\nพิเศษที่นักศึกษาเข้าร่วมการแข่งขันไม่น้อยกว่าระดับมหาวิทยาลัย', NULL, 21, 3.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(167, '๑๐. หัวหน้างานฟาร์ม', NULL, 21, 6.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(168, '๑๑. อื่น ๆ ที่มีลักษณะงานเทียบเท่า', NULL, 21, 1.00, 'SYSTEM', 0, 0, 0, 0, 0, NULL, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(169, 'วิชา555555555 นักศึกษา ๓๐ - ๖๐ คน', NULL, 1, 3.00, '3', 10, 0, 0, 0, 0, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(263, '0001_01_01_000000_create_users_table', 1),
(264, '0001_01_01_000001_create_cache_table', 1),
(265, '0001_01_01_000002_create_jobs_table', 1),
(266, '2024_07_27_105528_add_role_to_users_table', 1),
(267, '2024_07_28_181107_add_other_detail_to_users_table', 1),
(268, '2024_07_29_055430_create_workload_db', 1),
(269, '2024_07_29_055431_create_subworkload_db', 1),
(270, '2024_07_29_060240_add_factor_and_order_sort_to_workload_db', 1),
(271, '2024_07_29_060243_create_score_db', 1),
(272, '2024_09_21_123736_create_type_of_subworkload', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subworkload_id` bigint(20) UNSIGNED NOT NULL,
  `score` decimal(8,2) NOT NULL DEFAULT 0.00,
  `file_path` varchar(255) DEFAULT NULL,
  `ref_child_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `subworkload_id`, `score`, `file_path`, `ref_child_id`, `created_at`, `updated_at`) VALUES
(1, 3, 169, 50.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(2, 3, 2, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(3, 3, 3, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(4, 3, 4, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(5, 3, 5, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(6, 3, 6, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(7, 3, 10, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(8, 3, 11, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(9, 3, 12, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(10, 3, 13, 0.00, 'uploads/3/CCUJ8BkZPLLWlr1cLGtpPB9Y06yO2V4gsQuJKkRB.png', NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(11, 3, 14, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(12, 3, 15, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(13, 3, 16, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24'),
(14, 3, 17, 0.00, NULL, NULL, '2024-09-23 14:20:24', '2024-09-23 14:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('z0cXRrEy08z8TiueIuUFhL90zoKtq1vTHzpOoAIr', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib1E1M2Q2TEN6a05DQ1BzNUpGbWlNeURYT00xRE54aGxNanRQQ2NhTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93b3JrbG9hZHMvMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1727612867);

-- --------------------------------------------------------

--
-- Table structure for table `subworkloads`
--

CREATE TABLE `subworkloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `workload_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subworkloads`
--

INSERT INTO `subworkloads` (`id`, `name`, `description`, `workload_id`, `created_at`, `updated_at`) VALUES
(1, '๑.๑ ภาระงานสอนทฤษฎีเฉพาะภาคปกติ', NULL, 1, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(2, '๑.๒ ภาระงานสอนปฏิบัติฉพาะภาคปกติ', NULL, 1, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(3, '๑.๓ การดูแลนักศึกษารายวิชาฝึกงาน สหกิจศึกษา ฝึกประสบการณ์วิชาชีพครู โครงการ และวิชาอื่นที่ไม่ปรากฏเวลาในตารางสอน', NULL, 1, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(4, '๑.๔ ภาระงานการเป็นที่ปรึกษาปัญหา พิเศษวิชาโครงการ/โครงงาน (เพื่อสำเร็จ การศึกษา)/วิทยานิพนธ์ การศึกษาเฉพาะ เรื่อง สารนิพนธ์/การค้นคว้าอิสระ/ปริญญา นิพนธ์ ศิลปนิพนธ์ ', NULL, 1, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(5, '๑.๕ การจัดการเรียนการสอนโดยวิธีการอื่นๆ', NULL, 1, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(6, '๒.๑ เกณฑ์ภาระงานสําหรับการพัฒนาผลงานทางวิชาการเอกสารประกอบการสอน/ เอกสารคําสอน', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(7, '๒.๒ เกณฑ์ภาระงานสำหรับการเขียนหนังสือ ตำรา และงานแปล', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(8, '๒.๓ เกณฑ์การคิดภาระงานสำหรับการจัดทำข้อเสนอโครงการวิจัย', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(9, '๒.๔ เกณฑ์การคิดภาระงานวิจัยโครงการเดี่ยว และโครงการย่อยในโครงการชุดวิจัย', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(11, '๒.๕ เกณฑ์การคิดภาระงานวิจัยของชุดโครงการวิจัย', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(12, '๒.๖ เกณฑ์การคิดภาระงานสำหรับโครงการวิจัยร่วมที่ดำเนินการกับหน่วยงานภายนอก (โดยไม่ได้รับงบประมาณผ่านมหาวิทยาลัยและมีหนังสือราชการหน่วยงานภายนอกโดยผ่านหน่วยงานต้นสังกัดหรือมหาวิทยาลัย)', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(13, '๒.๗ เกณฑ์การคิดภาระงานเผยแพร่ผลงานวิจัย ผลงานทางวิชาการ หรืองานสร้างสรรค์', NULL, 2, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(14, '๓.๑ เกณฑ์ภาระงานสำหรับการเป็นอาจารย์พิเศษ/วิทยากรของหน่วยงานภายนอก/ภายใน หรือกรรมการอื่น ๆ', NULL, 3, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(15, '๓.๒ เกณฑ์การคิดภาระงานการจัดประชุม สัมมนาฝึกอบรมและจัดนิทรรศการ', NULL, 3, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(16, '๓.๓ การสัมมนา การประชุมวิชาการ', NULL, 3, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(17, '๓.๔ เกณฑ์การคิดภาระงานที่ปรึกษาโครงการจับวิทยานิพนธ์/เมธีวิจัย/ผู้เชี่ยวขาญ', NULL, 3, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(18, '๓.๕ เกณฑ์การคิดภาระงานสำหรับงานที่มีรายได้เข้ามหาวิทยาลัย', NULL, 3, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(19, '๔.๑ เกณฑ์การคิดภารศึกษางานการจัดโครงการทำนุบำนุบำรุงศิลปะ วัฒนธรรม', NULL, 4, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(20, '๔.๒ เกณฑ์การคิดภาระงานการเข้าร่วมโครงการทำนุบำรุงศิลปะวัฒนะวัฒนธรรม', NULL, 4, '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(21, '๕.๑ เกณฑ์การคิดภาระงานในลักษณะกิจกรรมที่เกี่ยวกับการเรียนการสอน งานบริการ วิชาการ/กิจกรรมนักศึกษา', NULL, 5, '2024-09-23 12:25:52', '2024-09-23 12:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_subworkload`
--

CREATE TABLE `type_of_subworkload` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `rank` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `supervisor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `rank`, `position`, `department`, `salary`, `supervisor`) VALUES
(1, 'Admin', 'admin@mail.com', '2024-09-23 12:25:52', '$2y$12$nFuOipoRQvaTfJayQY7AuO5ju9ktAoGFXhZ6YHjaVz8XiSfhVhbZq', '8WJMgkNVaDqS7HohOHeqRXYx24H5xDg4SQ1H6GsYddh2hKewWTiS1BEnwJjO', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'admin', '0', NULL, NULL, NULL, NULL),
(2, 'Staff', 'staff@mail.com', '2024-09-23 12:25:52', '$2y$12$DFqSEtNxMrynQptZcMl3F.wHCaT89vPI9rKNmA9uj8SLW15cFxyNm', 'dgvATDIEw6', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '1', NULL, NULL, NULL, NULL),
(3, 'นายทดสอบ ระบบ 1', 'professor1@mail.com', '2024-09-23 12:25:52', '$2y$12$asO4M/wneVFRCtX8MuQKH.Yf/UEpszcRGDzTsaLJTnDQCWtUPdj8G', 'cZlbE4r8hG', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '2', NULL, NULL, NULL, NULL),
(4, 'นายเทส ระบบ 2', 'professor2@mail.com', '2024-09-23 12:25:52', '$2y$12$6I2K2FFJLgswVvnTRDnQ3OIaYlhbiLDePStco2hWsrV0NpPq4lDBK', '6AvDNPj160', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '2', NULL, NULL, NULL, NULL),
(5, 'รองคณบดี', 'test_member1@mail.com', '2024-09-23 12:25:52', '$2y$12$WXdzDs0v3He/j57aM/RR5.FxtWE8HU0ZiNw/lhBDiMBaDB76tnSb6', 'eHi8l30OyiufeR7TcGNT7ARdjzPUeU8yCwzuWjqpcXjfCZePphNouyBdOh8u', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '6', NULL, NULL, NULL, NULL),
(6, 'ผู้ช่วยคณบดี', 'test_member2@mail.com', '2024-09-23 12:25:52', '$2y$12$11oDZvnBPLu0bY2DoM3huevqeZQr/ZrHyxJabxYHoz/CdmYYNgmoy', 'sRzGnsMSRy', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '5', NULL, NULL, NULL, NULL),
(7, 'หัวหน้าสาขา', 'test_member3@mail.com', '2024-09-23 12:25:52', '$2y$12$woGcrAxWmfOi8ZmzeJ3JV.vSUjSyYDfw8pMZtTmxr5/Dez1xmUboG', 'WAg2Gxp5VO', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '4', NULL, NULL, NULL, NULL),
(8, 'หัวหน้าหลักสูตร', 'test_member4@mail.com', '2024-09-23 12:25:52', '$2y$12$xRTd0tkgW1Ab7VQ6bhDAIuIqJ8ye.ndjniURfV0diXeUv.BsVCkRm', 'hKc4cxcI5J', '2024-09-23 12:25:52', '2024-09-23 12:25:52', 'user', '3', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workloads`
--

CREATE TABLE `workloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workloads`
--

INSERT INTO `workloads` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'ภาระงานสอน', '', '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(2, 'ภาระงานวิจัยและงานวิชาการอื่นที่ปรากฏเป็นผลงานวิชาการตามหลักเกณฑ์ที่ ก.พ.อ กำหนด', '', '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(3, 'ภาระงานบริการทางวิชาการ', '', '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(4, 'ภาระงานทำนุบำรุงศิลปวัฒนธรรม', '', '2024-09-23 12:25:52', '2024-09-23 12:25:52'),
(5, 'ภาระงานอื่นๆ ที่สอดคล้องกับพันธกิจของคณะและมหาวิทยาลัย', '', '2024-09-23 12:25:52', '2024-09-23 12:25:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_subworkloads`
--
ALTER TABLE `list_subworkloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scores_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subworkloads`
--
ALTER TABLE `subworkloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_subworkload`
--
ALTER TABLE `type_of_subworkload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workloads`
--
ALTER TABLE `workloads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_subworkloads`
--
ALTER TABLE `list_subworkloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subworkloads`
--
ALTER TABLE `subworkloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `type_of_subworkload`
--
ALTER TABLE `type_of_subworkload`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `workloads`
--
ALTER TABLE `workloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
