-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 21, 2022 at 11:10 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advertising`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisings`
--

DROP TABLE IF EXISTS `advertisings`;
CREATE TABLE IF NOT EXISTS `advertisings` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_source` int(11) NOT NULL,
  `ad_publishdate` int(11) NOT NULL,
  `ad_salary` varchar(32) NOT NULL,
  `ad_minsalary` varchar(32) NOT NULL,
  `ad_maxsalary` varchar(32) NOT NULL,
  `ad_category` varchar(32) NOT NULL,
  `ad_title` varchar(32) NOT NULL,
  `ad_startworkhour` varchar(32) NOT NULL,
  `ad_finishworkhour` varchar(32) NOT NULL,
  `ad_phone` varchar(32) NOT NULL,
  `ad_collection` varchar(32) NOT NULL,
  `ad_details` text NOT NULL,
  `ad_province` int(11) NOT NULL,
  `ad_city` int(11) NOT NULL,
  `ad_address` varchar(128) NOT NULL,
  `ad_labels` text NOT NULL,
  `ad_insertdate` int(11) NOT NULL,
  PRIMARY KEY (`ad_id`),
  KEY `adx_source` (`ad_source`),
  KEY `adx_province` (`ad_province`),
  KEY `adx_city` (`ad_city`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `advertising_report`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `advertising_report`;
CREATE TABLE IF NOT EXISTS `advertising_report` (
`ad_id` int(11)
,`ad_title` varchar(32)
,`ad_publishdate` int(11)
,`ad_category` varchar(32)
,`p_name` varchar(32)
,`ct_name` varchar(32)
);

-- --------------------------------------------------------

--
-- Table structure for table `advertising_sources`
--

DROP TABLE IF EXISTS `advertising_sources`;
CREATE TABLE IF NOT EXISTS `advertising_sources` (
  `as_id` int(11) NOT NULL AUTO_INCREMENT,
  `as_name` varchar(32) NOT NULL,
  PRIMARY KEY (`as_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `advertising_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `advertising_view`;
CREATE TABLE IF NOT EXISTS `advertising_view` (
`ad_id` int(11)
,`as_name` varchar(32)
,`ad_publishdate` int(11)
,`ad_salary` varchar(32)
,`ad_minsalary` varchar(32)
,`ad_maxsalary` varchar(32)
,`ad_category` varchar(32)
,`ad_title` varchar(32)
,`ad_startworkhour` varchar(32)
,`ad_finishworkhour` varchar(32)
,`ad_phone` varchar(32)
,`ad_collection` varchar(32)
,`ad_details` text
,`ad_address` varchar(128)
,`ad_labels` text
,`ad_insertdate` int(11)
,`p_name` varchar(32)
,`ct_name` varchar(32)
);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `ct_id` int(11) NOT NULL AUTO_INCREMENT,
  `ct_name` varchar(32) NOT NULL,
  `ct_province` int(11) NOT NULL,
  PRIMARY KEY (`ct_id`),
  KEY `ct_province` (`ct_province`)
) ENGINE=InnoDB AUTO_INCREMENT=557 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`ct_id`, `ct_name`, `ct_province`) VALUES
(1, 'تهران', 1),
(2, 'دماوند', 1),
(3, 'شهر ری', 1),
(4, 'شهریار', 1),
(5, 'اسلامشهر', 1),
(6, 'ملارد', 1),
(7, 'پاکدشت', 1),
(8, 'فیروزکوه', 1),
(9, 'شمیرانات', 1),
(10, 'پیشوا', 1),
(11, 'پردیس', 1),
(12, 'قرچک', 1),
(13, 'ورامین', 1),
(14, 'رباط کریم', 1),
(15, 'شهر قدس', 1),
(16, 'بهارستان', 1),
(17, 'رودهن', 1),
(18, 'بومهن', 1),
(19, 'جاجرود', 1),
(20, 'بوستان', 1),
(21, 'اندیشه', 1),
(22, 'گلستان', 1),
(23, 'واوان', 1),
(24, 'پرند', 1),
(25, 'پاکدشت', 1),
(26, 'ابریشم', 2),
(27, 'اصفهان', 2),
(28, 'ایمان شهر', 2),
(29, 'پیربکران', 2),
(30, 'تیران', 2),
(31, 'چادگان', 2),
(32, 'چم گردان', 2),
(33, 'حبیب آباد', 2),
(34, 'خمینی شهر', 2),
(35, 'خوانسار', 2),
(36, 'خوراسگان', 2),
(37, 'داران', 2),
(38, 'درچه پیاز', 2),
(39, 'دستگرد', 2),
(40, 'دهق', 2),
(41, 'دیزیچه', 2),
(42, 'زاینده رود', 2),
(43, 'زرین شهر', 2),
(44, 'زیبا شهر', 2),
(45, 'سده دلنجان', 2),
(46, 'شاهین شهر', 2),
(47, 'شهرضا', 2),
(48, 'طالخونچه', 2),
(49, 'فریدون شهر', 2),
(50, 'فلاورجان', 2),
(51, 'فولادشهر', 2),
(52, 'قهدریجان', 2),
(53, 'کاشان', 2),
(54, 'کوشک', 2),
(55, 'کوهپایه', 2),
(56, 'گز', 2),
(57, 'گلپایگان', 2),
(58, 'گوگد', 2),
(59, 'مبارکه', 2),
(60, 'نجف آباد', 2),
(61, 'نجف شهر', 2),
(62, 'آران بیدگل', 2),
(63, 'سمیرم', 2),
(64, 'برخوار', 2),
(65, 'نطنز', 2),
(66, 'اردستان', 2),
(67, 'لنجان', 2),
(68, 'فریدن', 2),
(69, 'نائین', 2),
(70, 'آبش احمد', 3),
(71, 'اسکو', 3),
(72, 'ایلخچی', 3),
(73, 'بستان آباد', 3),
(74, 'تبریز', 3),
(75, 'سراب', 3),
(76, 'سهند', 3),
(77, 'شبستر', 3),
(78, 'مراغه', 3),
(79, 'مرند', 3),
(80, 'ملکان', 3),
(81, 'جلفا', 3),
(82, 'بناب', 3),
(83, 'هادی شهر', 3),
(84, 'اهر', 3),
(85, 'آذرشهر', 3),
(86, 'عجب شیر', 3),
(87, 'میانه', 3),
(88, 'هریس', 3),
(89, 'هشترود', 3),
(90, 'کلیبر', 3),
(91, 'ارسنجان', 4),
(92, 'استهبان', 4),
(93, 'اقلید', 4),
(94, 'اوز', 4),
(95, 'آباده', 4),
(96, 'باب انار', 4),
(97, 'بالاده', 4),
(98, 'بیضا', 4),
(99, 'جنب شهر', 4),
(100, 'جهرم', 4),
(101, 'خشت', 4),
(102, 'خنج', 4),
(103, 'داراب', 4),
(104, 'داریان', 4),
(105, 'رامجرد', 4),
(106, 'سروستان', 4),
(107, 'سعادت شهر', 4),
(108, 'سوریان', 4),
(109, 'ممسنی', 4),
(110, 'رستم', 4),
(111, 'مهر', 4),
(112, 'خرم بید', 4),
(113, 'خرم بید', 4),
(114, 'پاسارگاد', 4),
(115, 'زرین دشت', 4),
(116, 'نورآباد', 4),
(117, 'لارستان', 4),
(118, 'نودان', 4),
(119, 'مصیری', 4),
(120, 'مشکان', 4),
(121, 'مرودشت', 4),
(122, 'لطیفی', 4),
(123, 'لامرد', 4),
(124, 'فیروزآباد', 4),
(125, 'کازرون', 4),
(126, 'شیراز', 4),
(127, 'قائمیه', 4),
(128, 'فسا', 4),
(129, 'سپیدان', 4),
(130, 'کامفیروز', 4),
(131, 'نی ریز', 4),
(132, 'لار', 4),
(133, 'قیر', 4),
(134, 'گراش', 4),
(135, 'کوار', 4),
(136, 'بوانات', 4),
(137, 'ارومیه', 5),
(138, 'اشنویه', 5),
(139, 'بوکان', 5),
(140, 'پیرانشهر', 5),
(141, 'تکاب', 5),
(142, 'خوی', 5),
(143, 'سردشت', 5),
(144, 'سلماس', 5),
(145, 'سیه چشمه', 5),
(146, 'شاهین دژ', 5),
(147, 'شوط', 5),
(148, 'قوشچی', 5),
(149, 'ماکو', 5),
(150, 'محمد یار', 5),
(151, 'مهاباد', 5),
(152, 'میاندوآب', 5),
(153, 'نقده', 5),
(154, 'هادی شهر', 5),
(155, 'سالم', 6),
(156, 'ملش', 6),
(157, 'آستارا', 6),
(158, 'آستانه اشرفیه', 6),
(159, 'برهسر', 6),
(160, 'بندر انزلی', 6),
(161, 'طوالش', 6),
(162, 'چابکسر', 6),
(163, 'چوبر', 6),
(164, 'حویق', 6),
(165, 'خمام', 6),
(166, 'رحیم آباد', 6),
(167, 'رستم آباد', 6),
(168, 'رشت', 6),
(169, 'رضوان شهر', 6),
(170, 'رودبار', 6),
(171, 'رودسر', 6),
(172, 'سلگر', 6),
(173, 'سیاهگل', 6),
(174, 'شفت', 6),
(175, 'شلمان', 6),
(176, 'صومعه سرا', 6),
(177, 'فومن', 6),
(178, 'کلاچای', 6),
(179, 'کوچصفهان', 6),
(180, 'کومله', 6),
(181, 'کیاشهر', 6),
(182, 'گالیکش', 6),
(183, 'لاهیجان', 6),
(184, 'لشت نشا', 6),
(185, 'لنگرود', 6),
(186, 'لوشان', 6),
(187, 'لیسار', 6),
(188, 'ماسال', 6),
(189, 'هشتپر', 6),
(190, 'تالش', 6),
(191, 'امیر کلا', 7),
(192, 'آلاشت', 7),
(193, 'آمل', 7),
(194, 'بابل', 7),
(195, 'بابلسر', 7),
(196, 'بهشهر', 7),
(197, 'پل سفید', 7),
(198, 'تنکابن', 7),
(199, 'جویبار', 7),
(200, 'چالوس', 7),
(201, 'چمستان', 7),
(202, 'خلیل شهر', 7),
(203, 'رامسر', 7),
(204, 'رستمکلا', 7),
(205, 'زیرآب', 7),
(206, 'ساری', 7),
(207, 'سرخ رود', 7),
(208, 'سلمان شهر', 7),
(209, 'سورک', 7),
(210, 'شیرگاه', 7),
(211, 'عباس آباد', 7),
(212, 'شیرود', 7),
(213, 'نوشهر', 7),
(214, 'فریدون کنار', 7),
(215, 'قائم شهر', 7),
(216, 'کلاردشت', 7),
(217, 'گلوگاه', 7),
(218, 'نکا', 7),
(219, 'محمود آباد', 7),
(220, 'مرزن آباد', 7),
(221, 'نشتارود', 7),
(222, 'نور', 7),
(223, 'اردبیل', 8),
(224, 'خلخال', 8),
(225, 'کلور', 8),
(226, 'پارس آباد', 8),
(227, 'بیله سوار', 8),
(228, 'مشکین شهر', 8),
(229, 'نمین', 8),
(230, 'نامعلوم در پو', 8),
(231, 'اشتهارد', 9),
(232, 'ساوج بلاغ', 9),
(233, 'صفا دشت', 9),
(234, 'کرج', 9),
(235, 'کمال شهر', 9),
(236, 'ماهدشت', 9),
(237, 'محمدشهر', 9),
(238, 'مشکین دشت', 9),
(239, 'هشتگرد', 9),
(240, 'نظرآباد', 9),
(241, 'فردیس', 9),
(242, 'فردیس', 9),
(243, 'آبدانان', 10),
(244, 'ارکواز', 10),
(245, 'آسمان آباد', 10),
(246, 'ایلام', 10),
(247, 'ایوان', 10),
(248, 'بدره', 10),
(249, 'توحید', 10),
(250, 'چوار', 10),
(251, 'دره شهر', 10),
(252, 'دهلران', 10),
(253, 'سرابله', 10),
(254, 'لومر', 10),
(255, 'مهران', 10),
(256, 'مورموری', 10),
(257, 'شیروان', 10),
(258, 'ملکشاهی', 10),
(259, 'آب پخش', 11),
(260, 'اهرم', 11),
(261, 'برازجان', 11),
(262, 'بندر بوشهر', 11),
(263, 'بندر دیلم', 11),
(264, 'بندر گناوه', 11),
(265, 'خارک', 11),
(266, 'دالکی', 11),
(267, 'سعدآباد', 11),
(268, 'شبانکاره', 11),
(269, 'وحدتیه', 11),
(270, 'وحیدیه', 11),
(271, 'جم', 11),
(272, 'دشتستان', 11),
(273, 'کنگان', 11),
(274, 'دشتی', 11),
(275, 'اردل', 12),
(276, 'آلونی', 12),
(277, 'باباحیدر', 12),
(278, 'بروجن', 12),
(279, 'بن', 12),
(280, 'سامان', 12),
(281, 'سورشجان', 12),
(282, 'شهرکرد', 12),
(283, 'طاقانک', 12),
(284, '4ان', 12),
(285, 'فرخ شهر', 12),
(286, 'کیان', 12),
(287, 'لردگان', 12),
(288, 'هفشجان', 12),
(289, 'آرین شهر', 13),
(290, 'اسدیه', 13),
(291, 'بشرویه', 13),
(292, 'بیرجند', 13),
(293, 'خوسف', 13),
(294, 'سربیشه', 13),
(295, 'فردوس', 13),
(296, 'قائن', 13),
(297, 'قهستان', 13),
(298, 'نهبندان', 13),
(299, 'نیمبلوک', 13),
(300, 'طبس', 13),
(301, 'سرایان', 13),
(302, 'درمیان', 13),
(303, 'بردسکن', 14),
(304, 'تایباد', 14),
(305, 'تربت جام', 14),
(306, 'تربت حیدریه', 14),
(307, 'چناران', 14),
(308, 'خرو', 14),
(309, 'خلیل آباد', 14),
(310, 'درگز', 14),
(311, 'دولت آباد', 14),
(312, 'ریوش', 14),
(313, 'سبزوار', 14),
(314, 'صالح آباد', 14),
(315, 'طرقبه', 14),
(316, 'عشق آباد', 14),
(317, 'فریمان', 14),
(318, 'فیروزه', 14),
(319, 'قوچان', 14),
(320, 'کاشمر', 14),
(321, 'مشهد', 14),
(322, 'نصرآباد', 14),
(323, 'نیشابور', 14),
(324, 'گناباد', 14),
(325, 'کلات', 14),
(326, 'مه و لات', 14),
(327, 'جغتای', 14),
(328, 'رشتخوار', 14),
(329, 'سرخس', 14),
(330, 'خواف', 14),
(331, 'بجستان', 14),
(332, 'جوین', 14),
(333, 'تخت جلگه', 14),
(334, 'اسفراین', 15),
(335, 'آشخانه', 15),
(336, 'بجنورد', 15),
(337, 'راز', 15),
(338, 'شیروان', 15),
(339, 'فاروج', 15),
(340, 'جاجرم', 15),
(341, 'مانه و سملقان', 15),
(342, 'اروند کنار', 16),
(343, 'اندیمشک', 16),
(344, 'اهواز', 16),
(345, 'ایذه', 16),
(346, 'آبادان', 16),
(347, 'باغ ملک', 16),
(348, 'بندر امام خمینی', 16),
(349, 'بندر ماهشهر', 16),
(350, 'بهبهان', 16),
(351, 'حسینیه', 16),
(352, 'خرمشهر', 16),
(353, 'دزآب', 16),
(354, 'دزفول', 16),
(355, 'رامهرمز', 16),
(356, 'دهدز', 16),
(357, 'شوش', 16),
(358, 'شوشتر', 16),
(359, 'صفی آباد', 16),
(360, 'قلعه خواجه', 16),
(361, 'گتوند', 16),
(362, 'لالی', 16),
(363, 'مسجد سلیمان', 16),
(364, 'اندیکا', 16),
(365, 'رامشیر', 16),
(366, 'هفتگل', 16),
(367, 'دشت آزادگان', 16),
(368, 'شادگان', 16),
(369, 'امیدیه', 16),
(370, 'هویزه', 16),
(371, 'آغاجاری', 16),
(372, 'ابهر', 17),
(373, 'زنجان', 17),
(374, 'خدابنده', 17),
(375, 'ماه نشان', 17),
(376, 'خرمدهر', 17),
(377, 'دامغان', 18),
(378, 'درجزین', 18),
(379, 'سرخه', 18),
(380, 'سمنان', 18),
(381, 'شاهرود', 18),
(382, 'گرمسار', 18),
(383, 'مهدی شهر', 18),
(384, 'میامی', 18),
(385, 'آرادان', 18),
(386, 'ایرانشهر', 19),
(387, 'بزمان', 19),
(388, 'بمپور', 19),
(389, 'بنجار', 19),
(390, 'چابهار', 19),
(391, 'خاش', 19),
(392, 'دوست محمد', 19),
(393, 'زابل', 19),
(394, 'زاهدان', 19),
(395, 'سراوان', 19),
(396, 'سرایان', 19),
(397, 'کنارک', 19),
(398, 'محمد آباد', 19),
(399, 'میرجاوه', 19),
(400, 'نیک شهر', 19),
(401, 'زهک', 19),
(402, 'اقبالیه', 20),
(403, 'الوند', 20),
(404, 'آبیک', 20),
(405, 'بویین زهرا', 20),
(406, 'بیدستان', 20),
(407, 'تاکستان', 20),
(408, 'خرمدشت', 20),
(409, 'دانسفهان', 20),
(410, 'قزوین', 20),
(411, 'محمدیه', 20),
(412, 'البرز', 20),
(413, 'قم', 21),
(414, 'قروه', 22),
(415, 'دهگلان', 22),
(416, 'بانه', 22),
(417, 'سنندج', 22),
(418, 'بیجار', 22),
(419, 'دیواندره', 22),
(420, 'رابر', 22),
(421, 'سقز', 22),
(422, 'سوران', 22),
(423, 'قصر شیرین', 22),
(424, 'کامیاران', 22),
(425, 'مریوان', 22),
(426, 'اختیار آباد', 23),
(427, 'ارزونیه', 23),
(428, 'بافت', 23),
(429, 'بم', 23),
(430, 'جیرفت', 23),
(431, 'راور', 23),
(432, 'رفسنجان', 23),
(433, 'زیدآباد', 23),
(434, 'سیرجان', 23),
(435, 'شهر بابک', 23),
(436, 'عنبرآباد', 23),
(437, 'فهرج', 23),
(438, 'قلعه گنج', 23),
(439, 'کرمان', 23),
(440, 'کهنوج', 23),
(441, 'گلباف', 23),
(442, 'گلزار', 23),
(443, 'منوجان', 23),
(444, 'نرماشیر', 23),
(445, 'نظام شهر', 23),
(446, 'زرند', 23),
(447, 'انار', 23),
(448, 'بردسیر', 23),
(449, 'کوهبنان', 23),
(450, 'اسلام آباد غرب', 24),
(451, 'بیستون', 24),
(452, 'پاوه', 24),
(453, 'تازه آباد', 24),
(454, 'جوانرود', 24),
(455, 'روانسر', 24),
(456, 'سر پل ذهاب', 24),
(457, 'سنقر', 24),
(458, 'صحنه', 24),
(459, 'کرند غرب', 24),
(460, 'کرمانشاه', 24),
(461, 'گیلان غرب', 24),
(462, 'میان راهان', 24),
(463, 'هرسین', 24),
(464, 'کنگاور', 24),
(465, 'قصر شیرین', 24),
(466, 'ثلاث بابا جانی', 24),
(467, 'دالاهو', 24),
(468, 'چرام', 25),
(469, 'دهدشت', 25),
(470, 'دوگنبدان', 25),
(471, 'سی سخت', 25),
(472, 'قلعه رئیسی', 25),
(473, 'لنده', 25),
(474, 'لیکک', 25),
(475, 'یاسوج', 25),
(476, 'دنا', 25),
(477, 'باشت', 25),
(478, 'بهمنی', 25),
(479, 'گچساران', 25),
(480, 'آزادشهر', 26),
(481, 'آق قلا', 26),
(482, 'بندر ترکمن', 26),
(483, 'بندر گز', 26),
(484, 'خان ببین', 26),
(485, 'رامیان', 26),
(486, 'سرخنکلاته', 26),
(487, 'علی آباد', 26),
(488, 'فاضل آباد', 26),
(489, 'کردکوی', 26),
(490, 'کلاله', 26),
(491, 'گرگان', 26),
(492, 'گنبد کاووس', 26),
(493, 'مینودشت', 26),
(494, 'نگین شهر', 26),
(495, 'ازنا', 27),
(496, 'الشتر', 27),
(497, 'الیگودرز', 27),
(498, 'بروجرد', 27),
(499, 'پل دختر', 27),
(500, 'چقابل', 27),
(501, 'خرم آباد', 27),
(502, 'دورود', 27),
(503, 'زاغه', 27),
(504, 'سپیددشت', 27),
(505, 'کوهدشت', 27),
(506, 'معمولان', 27),
(507, 'دلفان', 27),
(508, 'اراک', 28),
(509, 'آستانه', 28),
(510, 'آشتیان', 28),
(511, 'تفرش', 28),
(512, 'خمین', 28),
(513, 'دلیجان', 28),
(514, 'ساوه', 28),
(515, 'شازند', 28),
(516, 'غرق آباد', 28),
(517, 'کمیجان', 28),
(518, 'مامونیه', 28),
(519, 'محلات', 28),
(520, 'افخم', 28),
(521, 'زرندیه', 28),
(522, 'بندر خمیر', 29),
(523, 'بندر عباس', 29),
(524, 'پارسیان', 29),
(525, 'جاسک', 29),
(526, 'حاجی آباد', 29),
(527, 'دهبارز', 29),
(528, 'بستک', 29),
(529, 'سیریک', 29),
(530, 'قشم', 29),
(531, 'میناب', 29),
(532, 'رودان', 29),
(533, 'بندرلنگه', 29),
(534, 'اسدآباد', 30),
(535, 'بهار', 30),
(536, 'تویسرکان', 30),
(537, 'رزن', 30),
(538, 'کبودرآهنگ', 30),
(539, 'کنگاور', 30),
(540, 'لالجین', 30),
(541, 'ملایر', 30),
(542, 'نهاوند', 30),
(543, 'همدان', 30),
(544, 'اردکان', 31),
(545, 'بافق', 31),
(546, 'زراچ', 31),
(547, 'یزد', 31),
(548, 'تفت', 31),
(549, 'بهاباد', 31),
(550, 'میبد', 31),
(551, 'مهریز', 31),
(552, 'صدوق', 31),
(553, 'خاتم', 31),
(554, 'ابرکوه', 31),
(555, 'دهاقان', 2),
(556, 'هرند', 2);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(32) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`p_id`, `p_name`) VALUES
(1, 'تهران'),
(2, 'اصفهان'),
(3, 'آذربایجان شرقی'),
(4, 'فارس'),
(5, 'آذربایجان غربی'),
(6, 'گیلان'),
(7, 'مازندران'),
(8, 'اردبیل'),
(9, 'البرز'),
(10, 'ایلام'),
(11, 'بوشهر'),
(12, 'چهار محال بختیاری'),
(13, 'خراسان جنوبی'),
(14, 'خراسان رضوی'),
(15, 'خراسان شمالی'),
(16, 'خوزستان'),
(17, 'زنجان'),
(18, 'سمنان'),
(19, 'سیستان و بلوچستان'),
(20, 'قزوین'),
(21, 'قم'),
(22, 'کردستان'),
(23, 'کرمان'),
(24, 'کرمانشاه'),
(25, 'کهکیلویه بویراحمد'),
(26, 'گلستان'),
(27, 'لرستان'),
(28, 'مرکزی'),
(29, 'هرمزگان'),
(30, 'همدان'),
(31, 'یزد');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_firstname` varchar(32) NOT NULL,
  `u_lastname` varchar(32) NOT NULL,
  `u_username` varchar(32) NOT NULL,
  `u_password` varchar(128) NOT NULL,
  `u_date` int(11) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_firstname`, `u_lastname`, `u_username`, `u_password`, `u_date`) VALUES
(1, 'امین', 'رفیعی', 'aminrfe', 'YW1pbjg3MTI=', 1661078067);

-- --------------------------------------------------------

--
-- Structure for view `advertising_report`
--
DROP TABLE IF EXISTS `advertising_report`;

DROP VIEW IF EXISTS `advertising_report`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `advertising_report`  AS SELECT `advertisings`.`ad_id` AS `ad_id`, `advertisings`.`ad_title` AS `ad_title`, `advertisings`.`ad_publishdate` AS `ad_publishdate`, `advertisings`.`ad_category` AS `ad_category`, `provinces`.`p_name` AS `p_name`, `cities`.`ct_name` AS `ct_name` FROM ((`advertisings` join `provinces` on((`advertisings`.`ad_province` = `provinces`.`p_id`))) join `cities` on((`advertisings`.`ad_city` = `cities`.`ct_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `advertising_view`
--
DROP TABLE IF EXISTS `advertising_view`;

DROP VIEW IF EXISTS `advertising_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `advertising_view`  AS SELECT `advertisings`.`ad_id` AS `ad_id`, `advertising_sources`.`as_name` AS `as_name`, `advertisings`.`ad_publishdate` AS `ad_publishdate`, `advertisings`.`ad_salary` AS `ad_salary`, `advertisings`.`ad_minsalary` AS `ad_minsalary`, `advertisings`.`ad_maxsalary` AS `ad_maxsalary`, `advertisings`.`ad_category` AS `ad_category`, `advertisings`.`ad_title` AS `ad_title`, `advertisings`.`ad_startworkhour` AS `ad_startworkhour`, `advertisings`.`ad_finishworkhour` AS `ad_finishworkhour`, `advertisings`.`ad_phone` AS `ad_phone`, `advertisings`.`ad_collection` AS `ad_collection`, `advertisings`.`ad_details` AS `ad_details`, `advertisings`.`ad_address` AS `ad_address`, `advertisings`.`ad_labels` AS `ad_labels`, `advertisings`.`ad_insertdate` AS `ad_insertdate`, `provinces`.`p_name` AS `p_name`, `cities`.`ct_name` AS `ct_name` FROM (((`advertisings` join `provinces` on((`advertisings`.`ad_province` = `provinces`.`p_id`))) join `cities` on((`advertisings`.`ad_city` = `cities`.`ct_id`))) join `advertising_sources` on((`advertisings`.`ad_source` = `advertising_sources`.`as_id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisings`
--
ALTER TABLE `advertisings`
  ADD CONSTRAINT `advertisings_ibfk_1` FOREIGN KEY (`ad_source`) REFERENCES `advertising_sources` (`as_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisings_ibfk_2` FOREIGN KEY (`ad_province`) REFERENCES `provinces` (`p_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`ct_province`) REFERENCES `provinces` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;