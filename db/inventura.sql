-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 10:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventura`
--

-- --------------------------------------------------------

--
-- Table structure for table `vl_barkodovi`
--

CREATE TABLE `vl_barkodovi` (
  `id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `barkod` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_barkodovi`
--

INSERT INTO `vl_barkodovi` (`id`, `proizvod_id`, `barkod`) VALUES
(3991, 211, '1000290002110'),
(3992, 212, '1000290002127'),
(3993, 213, '1000290002134'),
(3994, 214, '1000290002141'),
(3995, 215, '1000290002158'),
(3996, 216, '1000290002165'),
(3997, 217, '1000290002172'),
(3998, 218, '1000290002189'),
(3999, 219, '1000290002196'),
(4000, 220, '1000290002202'),
(4001, 221, '1000290002219'),
(4002, 222, '1000290002226'),
(4003, 223, '1000290002233'),
(4004, 224, '1000290002240'),
(4005, 225, '1000290002257'),
(4006, 226, '1000300002260'),
(4007, 227, '1000300002277'),
(4008, 228, '1000300002284'),
(4009, 229, '1000300002291'),
(4010, 230, '1000300002307'),
(4011, 231, '1000300002314'),
(4012, 232, '1000300002321'),
(4013, 233, '1000300002338'),
(4014, 234, '1000300002345'),
(4015, 235, '1000300002352'),
(4016, 236, '1000300002369'),
(4017, 237, '1000300002376'),
(4018, 238, '1000300002383'),
(4019, 239, '1000300002390'),
(4020, 240, '1000300002406'),
(4021, 241, '1000310002410'),
(4022, 242, '1000310002427'),
(4023, 243, '1000310002434'),
(4024, 244, '1000310002441'),
(4025, 245, '1000310002458'),
(4026, 246, '1000310002465'),
(4027, 247, '1000310002472'),
(4028, 248, '1000310002489'),
(4029, 249, '1000310002496'),
(4030, 250, '1000310002502'),
(4031, 251, '1000310002519'),
(4032, 252, '1000310002526'),
(4033, 253, '1000310002533'),
(4034, 254, '1000310002540'),
(4035, 255, '1000310002557'),
(4036, 256, '1000320002561'),
(4037, 257, '1000320002578'),
(4038, 258, '1000320002585'),
(4039, 259, '1000320002592'),
(4040, 260, '1000320002608'),
(4041, 261, '1000320002615'),
(4042, 262, '1000320002622'),
(4043, 263, '1000320002639'),
(4044, 264, '1000320002646'),
(4045, 265, '1000320002653'),
(4046, 266, '1000320002660'),
(4047, 267, '1000320002677'),
(4048, 268, '1000320002684'),
(4049, 269, '1000320002691'),
(4050, 270, '1000320002707'),
(4051, 271, '1000330002711'),
(4052, 272, '1000330002728'),
(4053, 273, '1000330002735'),
(4054, 274, '1000330002742'),
(4055, 275, '1000330002759'),
(4056, 276, '1000330002766'),
(4057, 277, '1000330002773'),
(4058, 278, '1000330002780'),
(4059, 279, '1000330002797'),
(4060, 280, '1000330002803'),
(4061, 281, '1000330002810'),
(4062, 282, '1000330002827'),
(4063, 283, '1000330002834'),
(4064, 284, '1000330002841'),
(4065, 285, '1000330002858'),
(4066, 286, '1000340002862'),
(4067, 287, '1000340002879'),
(4068, 288, '1000340002886'),
(4069, 289, '1000340002893'),
(4070, 290, '1000340002909'),
(4071, 291, '1000340002916'),
(4072, 292, '1000340002923'),
(4073, 293, '1000340002930'),
(4074, 294, '1000340002947'),
(4075, 295, '1000340002954'),
(4076, 296, '1000340002961'),
(4077, 297, '1000340002978'),
(4078, 298, '1000340002985'),
(4079, 299, '1000340002992'),
(4080, 300, '1000340003005'),
(4081, 301, '1000350003019'),
(4082, 302, '1000350003026'),
(4083, 303, '1000350003033'),
(4084, 304, '1000350003040'),
(4085, 305, '1000350003057'),
(4086, 306, '1000350003064'),
(4087, 307, '1000350003071'),
(4088, 308, '1000350003088'),
(4089, 309, '1000350003095'),
(4090, 310, '1000350003101'),
(4091, 311, '1000350003118'),
(4092, 312, '1000350003125'),
(4093, 313, '1000350003132'),
(4094, 314, '1000350003149'),
(4095, 315, '1000350003156'),
(4096, 316, '1000360003160'),
(4097, 317, '1000360003177'),
(4098, 318, '1000360003184'),
(4099, 319, '1000360003191'),
(4100, 320, '1000360003207'),
(4101, 321, '1000360003214'),
(4102, 322, '1000360003221'),
(4103, 323, '1000360003238'),
(4104, 324, '1000360003245'),
(4105, 325, '1000360003252'),
(4106, 326, '1000360003269'),
(4107, 327, '1000360003276'),
(4108, 328, '1000360003283'),
(4109, 329, '1000360003290'),
(4110, 330, '1000360003306'),
(4111, 331, '1000370003310'),
(4112, 332, '1000370003327'),
(4113, 333, '1000370003334'),
(4114, 334, '1000370003341'),
(4115, 335, '1000370003358'),
(4116, 336, '1000370003365'),
(4117, 337, '1000370003372'),
(4118, 338, '1000370003389'),
(4119, 339, '1000370003396'),
(4120, 340, '1000370003402'),
(4121, 341, '1000370003419'),
(4122, 342, '1000370003426'),
(4123, 343, '1000370003433'),
(4124, 344, '1000370003440'),
(4125, 345, '1000370003457'),
(4126, 346, '1000380003461'),
(4127, 347, '1000380003478'),
(4128, 348, '1000380003485'),
(4129, 349, '1000380003492'),
(4130, 350, '1000380003508'),
(4131, 351, '1000380003515'),
(4132, 352, '1000380003522'),
(4133, 353, '1000380003539'),
(4134, 354, '1000380003546'),
(4135, 355, '1000380003553'),
(4136, 356, '1000380003560'),
(4137, 357, '1000380003577'),
(4138, 358, '1000380003584'),
(4139, 359, '1000380003591'),
(4140, 360, '1000380003607'),
(4141, 361, '1000390003611'),
(4142, 362, '1000390003628'),
(4143, 363, '1000390003635'),
(4144, 364, '1000390003642'),
(4145, 365, '1000390003659'),
(4146, 366, '1000390003666'),
(4147, 367, '1000390003673'),
(4148, 368, '1000390003680'),
(4149, 369, '1000390003697'),
(4150, 370, '1000390003703'),
(4151, 371, '1000390003710'),
(4152, 372, '1000390003727'),
(4153, 373, '1000390003734'),
(4154, 374, '1000390003741'),
(4155, 375, '1000390003758'),
(4156, 376, '1000400003761'),
(4157, 377, '1000400003778'),
(4158, 378, '1000400003785'),
(4159, 379, '1000400003792'),
(4160, 380, '1000400003808'),
(4161, 381, '1000400003815'),
(4162, 382, '1000400003822'),
(4163, 383, '1000400003839'),
(4164, 384, '1000400003846'),
(4165, 385, '1000400003853'),
(4166, 386, '1000400003860'),
(4167, 387, '1000400003877'),
(4168, 388, '1000400003884'),
(4169, 389, '1000400003891'),
(4170, 390, '1000400003907'),
(4171, 391, '1000410003911'),
(4172, 392, '1000410003928'),
(4173, 393, '1000410003935'),
(4174, 394, '1000410003942'),
(4175, 395, '1000410003959'),
(4176, 396, '1000410003966'),
(4177, 397, '1000410003973'),
(4178, 398, '1000410003980'),
(4179, 399, '1000410003997'),
(4180, 400, '1000410004000'),
(4181, 401, '1000410004017'),
(4182, 402, '1000410004024'),
(4183, 403, '1000410004031'),
(4184, 404, '1000410004048'),
(4185, 405, '1000410004055'),
(4186, 406, '1000420004069'),
(4187, 407, '1000420004076'),
(4188, 408, '1000420004083'),
(4189, 409, '1000420004090'),
(4190, 410, '1000420004106'),
(4191, 411, '1000420004113'),
(4192, 412, '1000420004120'),
(4193, 413, '1000420004137'),
(4194, 414, '1000420004144'),
(4195, 415, '1000420004151'),
(4196, 416, '1000420004168'),
(4197, 417, '1000420004175'),
(4198, 418, '1000420004182'),
(4199, 419, '1000420004199'),
(4200, 420, '1000420004205');

-- --------------------------------------------------------

--
-- Table structure for table `vl_evidencija`
--

CREATE TABLE `vl_evidencija` (
  `id` int(11) NOT NULL,
  `proizvod_id` int(11) DEFAULT NULL,
  `ucionica_id` int(11) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `vrijeme` time DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `inventura_id` int(11) NOT NULL,
  `aktivno` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_evidencija`
--

INSERT INTO `vl_evidencija` (`id`, `proizvod_id`, `ucionica_id`, `datum`, `vrijeme`, `user_id`, `inventura_id`, `aktivno`) VALUES
(145, 233, 5, '2023-12-28', '22:21:59', 1, 14, b'1'),
(146, 235, 5, '2023-12-28', '22:22:35', 2, 15, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `vl_inventura`
--

CREATE TABLE `vl_inventura` (
  `id` int(11) NOT NULL,
  `pocetak` datetime DEFAULT NULL,
  `kraj` datetime DEFAULT NULL,
  `aktivno` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_inventura`
--

INSERT INTO `vl_inventura` (`id`, `pocetak`, `kraj`, `aktivno`) VALUES
(10, '2023-12-28 21:57:47', '2023-12-28 21:58:12', b'0'),
(11, '2023-12-28 21:58:13', '2023-12-28 21:58:13', b'0'),
(12, '2023-12-28 22:03:35', '2023-12-28 22:04:18', b'0'),
(13, '2023-12-28 22:04:26', '2023-12-28 22:07:20', b'0'),
(14, '2023-12-28 22:13:00', '2023-12-28 22:22:13', b'0'),
(15, '2023-12-28 22:22:30', '2023-12-28 22:37:15', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `vl_invite_codes`
--

CREATE TABLE `vl_invite_codes` (
  `id` int(11) NOT NULL,
  `kod` varchar(8) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_invite_codes`
--

INSERT INTO `vl_invite_codes` (`id`, `kod`, `user_id`) VALUES
(2, 'e43bc500', 13),
(6, 'b92160c4', 14),
(8, '', 6),
(9, '', NULL),
(10, '', NULL),
(11, '', 24),
(12, '', 25),
(13, '', 26);

-- --------------------------------------------------------

--
-- Table structure for table `vl_mysql_errors`
--

CREATE TABLE `vl_mysql_errors` (
  `id` int(11) NOT NULL,
  `query` varchar(16) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_mysql_errors`
--

INSERT INTO `vl_mysql_errors` (`id`, `query`, `message`, `time`) VALUES
(1519, 'UPLOAD', 'row count presel', '2023-12-28 22:19:54'),
(1520, 'UPLOAD', 'kraj presel', '2023-12-28 22:21:59'),
(1521, 'UPLOAD', 'kraj presel', '2023-12-28 22:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `vl_pozvani`
--

CREATE TABLE `vl_pozvani` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_pozvani`
--

INSERT INTO `vl_pozvani` (`id`, `admin_id`, `user_id`) VALUES
(3, 6, 23);

-- --------------------------------------------------------

--
-- Table structure for table `vl_proizvodi`
--

CREATE TABLE `vl_proizvodi` (
  `id` int(11) NOT NULL,
  `tip` int(11) NOT NULL,
  `naziv` varchar(64) DEFAULT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_proizvodi`
--

INSERT INTO `vl_proizvodi` (`id`, `tip`, `naziv`, `opis`) VALUES
(211, 29, 'Herman Miller stolac', 'NEMA'),
(212, 29, 'Secretlab stolac', 'NEMA'),
(213, 29, 'Secretlab stolac', 'NEMA'),
(214, 29, 'Herman Miller stolac', 'NEMA'),
(215, 29, 'Ikea stolac', 'NEMA'),
(216, 29, 'Secretlab stolac', 'NEMA'),
(217, 29, 'DXRacer stolac', 'NEMA'),
(218, 29, 'Ikea stolac', 'NEMA'),
(219, 29, 'Steelcase stolac', 'NEMA'),
(220, 29, 'DXRacer stolac', 'NEMA'),
(221, 29, 'Ikea stolac', 'NEMA'),
(222, 29, 'Steelcase stolac', 'NEMA'),
(223, 29, 'Steelcase stolac', 'NEMA'),
(224, 29, 'Herman Miller stolac', 'NEMA'),
(225, 29, 'Steelcase stolac', 'NEMA'),
(226, 30, 'HP laptop', 'NEMA'),
(227, 30, 'Dell laptop', 'NEMA'),
(228, 30, 'Dell laptop', 'NEMA'),
(229, 30, 'Apple laptop', 'NEMA'),
(230, 30, 'HP laptop', 'NEMA'),
(231, 30, 'Dell laptop', 'NEMA'),
(232, 30, 'HP laptop', 'NEMA'),
(233, 30, 'HP laptop', 'NEMA'),
(234, 30, 'Dell laptop', 'NEMA'),
(235, 30, 'HP laptop', 'NEMA'),
(236, 30, 'HP laptop', 'NEMA'),
(237, 30, 'Apple laptop', 'NEMA'),
(238, 30, 'Lenovo laptop', 'NEMA'),
(239, 30, 'Dell laptop', 'NEMA'),
(240, 30, 'Apple laptop', 'NEMA'),
(241, 31, 'Asus monitor', 'NEMA'),
(242, 31, 'Asus monitor', 'NEMA'),
(243, 31, 'LG monitor', 'NEMA'),
(244, 31, 'Samsung monitor', 'NEMA'),
(245, 31, 'Acer monitor', 'NEMA'),
(246, 31, 'Acer monitor', 'NEMA'),
(247, 31, 'LG monitor', 'NEMA'),
(248, 31, 'Samsung monitor', 'NEMA'),
(249, 31, 'Samsung monitor', 'NEMA'),
(250, 31, 'Acer monitor', 'NEMA'),
(251, 31, 'Asus monitor', 'NEMA'),
(252, 31, 'Dell monitor', 'NEMA'),
(253, 31, 'Dell monitor', 'NEMA'),
(254, 31, 'Dell monitor', 'NEMA'),
(255, 31, 'LG monitor', 'NEMA'),
(256, 32, 'Corsair tipkovnica', 'NEMA'),
(257, 32, 'Razer tipkovnica', 'NEMA'),
(258, 32, 'Microsoft tipkovnica', 'NEMA'),
(259, 32, 'SteelSeries tipkovnica', 'NEMA'),
(260, 32, 'Logitech tipkovnica', 'NEMA'),
(261, 32, 'Corsair tipkovnica', 'NEMA'),
(262, 32, 'Razer tipkovnica', 'NEMA'),
(263, 32, 'Microsoft tipkovnica', 'NEMA'),
(264, 32, 'SteelSeries tipkovnica', 'NEMA'),
(265, 32, 'Razer tipkovnica', 'NEMA'),
(266, 32, 'Corsair tipkovnica', 'NEMA'),
(267, 32, 'Logitech tipkovnica', 'NEMA'),
(268, 32, 'Microsoft tipkovnica', 'NEMA'),
(269, 32, 'Razer tipkovnica', 'NEMA'),
(270, 32, 'SteelSeries tipkovnica', 'NEMA'),
(271, 33, 'Razer miš', 'NEMA'),
(272, 33, 'Corsair miš', 'NEMA'),
(273, 33, 'SteelSeries miš', 'NEMA'),
(274, 33, 'Razer miš', 'NEMA'),
(275, 33, 'Logitech miš', 'NEMA'),
(276, 33, 'Razer miš', 'NEMA'),
(277, 33, 'Logitech miš', 'NEMA'),
(278, 33, 'Microsoft miš', 'NEMA'),
(279, 33, 'Logitech miš', 'NEMA'),
(280, 33, 'Razer miš', 'NEMA'),
(281, 33, 'Logitech miš', 'NEMA'),
(282, 33, 'Razer miš', 'NEMA'),
(283, 33, 'Razer miš', 'NEMA'),
(284, 33, 'SteelSeries miš', 'NEMA'),
(285, 33, 'Razer miš', 'NEMA'),
(286, 34, 'Dell računalo', 'NEMA'),
(287, 34, 'HP računalo', 'NEMA'),
(288, 34, 'Asus računalo', 'NEMA'),
(289, 34, 'Dell računalo', 'NEMA'),
(290, 34, 'Lenovo računalo', 'NEMA'),
(291, 34, 'Apple računalo', 'NEMA'),
(292, 34, 'Dell računalo', 'NEMA'),
(293, 34, 'Asus računalo', 'NEMA'),
(294, 34, 'Apple računalo', 'NEMA'),
(295, 34, 'Lenovo računalo', 'NEMA'),
(296, 34, 'Lenovo računalo', 'NEMA'),
(297, 34, 'Apple računalo', 'NEMA'),
(298, 34, 'Apple računalo', 'NEMA'),
(299, 34, 'Dell računalo', 'NEMA'),
(300, 34, 'Asus računalo', 'NEMA'),
(301, 35, 'Sony projektor', 'NEMA'),
(302, 35, 'Optoma projektor', 'NEMA'),
(303, 35, 'Epson projektor', 'NEMA'),
(304, 35, 'Sony projektor', 'NEMA'),
(305, 35, 'Epson projektor', 'NEMA'),
(306, 35, 'Sony projektor', 'NEMA'),
(307, 35, 'Epson projektor', 'NEMA'),
(308, 35, 'Optoma projektor', 'NEMA'),
(309, 35, 'Sony projektor', 'NEMA'),
(310, 35, 'BenQ projektor', 'NEMA'),
(311, 35, 'Epson projektor', 'NEMA'),
(312, 35, 'Acer projektor', 'NEMA'),
(313, 35, 'Sony projektor', 'NEMA'),
(314, 35, 'Sony projektor', 'NEMA'),
(315, 35, 'Epson projektor', 'NEMA'),
(316, 36, 'Monoprice HDMI kabel', 'NEMA'),
(317, 36, 'Anker HDMI kabel', 'NEMA'),
(318, 36, 'Monoprice HDMI kabel', 'NEMA'),
(319, 36, 'UGREEN HDMI kabel', 'NEMA'),
(320, 36, 'Anker HDMI kabel', 'NEMA'),
(321, 36, 'AmazonBasics HDMI kabel', 'NEMA'),
(322, 36, 'AmazonBasics HDMI kabel', 'NEMA'),
(323, 36, 'Monoprice HDMI kabel', 'NEMA'),
(324, 36, 'AmazonBasics HDMI kabel', 'NEMA'),
(325, 36, 'Anker HDMI kabel', 'NEMA'),
(326, 36, 'Belkin HDMI kabel', 'NEMA'),
(327, 36, 'Monoprice HDMI kabel', 'NEMA'),
(328, 36, 'UGREEN HDMI kabel', 'NEMA'),
(329, 36, 'Monoprice HDMI kabel', 'NEMA'),
(330, 36, 'Belkin HDMI kabel', 'NEMA'),
(331, 37, 'Epson pisač', 'NEMA'),
(332, 37, 'Brother pisač', 'NEMA'),
(333, 37, 'Canon pisač', 'NEMA'),
(334, 37, 'Canon pisač', 'NEMA'),
(335, 37, 'HP pisač', 'NEMA'),
(336, 37, 'Epson pisač', 'NEMA'),
(337, 37, 'Epson pisač', 'NEMA'),
(338, 37, 'Epson pisač', 'NEMA'),
(339, 37, 'Samsung pisač', 'NEMA'),
(340, 37, 'Samsung pisač', 'NEMA'),
(341, 37, 'HP pisač', 'NEMA'),
(342, 37, 'Canon pisač', 'NEMA'),
(343, 37, 'Brother pisač', 'NEMA'),
(344, 37, 'Canon pisač', 'NEMA'),
(345, 37, 'Epson pisač', 'NEMA'),
(346, 38, 'Fujitsu skener', 'NEMA'),
(347, 38, 'Epson skener', 'NEMA'),
(348, 38, 'Canon skener', 'NEMA'),
(349, 38, 'HP skener', 'NEMA'),
(350, 38, 'Canon skener', 'NEMA'),
(351, 38, 'Epson skener', 'NEMA'),
(352, 38, 'Fujitsu skener', 'NEMA'),
(353, 38, 'Epson skener', 'NEMA'),
(354, 38, 'Epson skener', 'NEMA'),
(355, 38, 'Epson skener', 'NEMA'),
(356, 38, 'Brother skener', 'NEMA'),
(357, 38, 'HP skener', 'NEMA'),
(358, 38, 'Fujitsu skener', 'NEMA'),
(359, 38, 'Fujitsu skener', 'NEMA'),
(360, 38, 'Brother skener', 'NEMA'),
(361, 39, 'SteelSeries slušalice', 'NEMA'),
(362, 39, 'Audio-Technica slušalice', 'NEMA'),
(363, 39, 'SteelSeries slušalice', 'NEMA'),
(364, 39, 'Sony slušalice', 'NEMA'),
(365, 39, 'Sony slušalice', 'NEMA'),
(366, 39, 'SteelSeries slušalice', 'NEMA'),
(367, 39, 'SteelSeries slušalice', 'NEMA'),
(368, 39, 'Bose slušalice', 'NEMA'),
(369, 39, 'Sony slušalice', 'NEMA'),
(370, 39, 'SteelSeries slušalice', 'NEMA'),
(371, 39, 'Sony slušalice', 'NEMA'),
(372, 39, 'Audio-Technica slušalice', 'NEMA'),
(373, 39, 'Sennheiser slušalice', 'NEMA'),
(374, 39, 'SteelSeries slušalice', 'NEMA'),
(375, 39, 'Sony slušalice', 'NEMA'),
(376, 40, 'HyperX podloga za miš', 'NEMA'),
(377, 40, 'Logitech podloga za miš', 'NEMA'),
(378, 40, 'Razer podloga za miš', 'NEMA'),
(379, 40, 'Corsair podloga za miš', 'NEMA'),
(380, 40, 'Razer podloga za miš', 'NEMA'),
(381, 40, 'Corsair podloga za miš', 'NEMA'),
(382, 40, 'Razer podloga za miš', 'NEMA'),
(383, 40, 'HyperX podloga za miš', 'NEMA'),
(384, 40, 'SteelSeries podloga za miš', 'NEMA'),
(385, 40, 'Logitech podloga za miš', 'NEMA'),
(386, 40, 'Logitech podloga za miš', 'NEMA'),
(387, 40, 'Logitech podloga za miš', 'NEMA'),
(388, 40, 'Logitech podloga za miš', 'NEMA'),
(389, 40, 'Corsair podloga za miš', 'NEMA'),
(390, 40, 'Logitech podloga za miš', 'NEMA'),
(391, 41, 'Bush Furniture stol', 'NEMA'),
(392, 41, 'Ikea stol', 'NEMA'),
(393, 41, 'Ikea stol', 'NEMA'),
(394, 41, 'Bush Furniture stol', 'NEMA'),
(395, 41, 'Ikea stol', 'NEMA'),
(396, 41, 'Walker Edison stol', 'NEMA'),
(397, 41, 'Walker Edison stol', 'NEMA'),
(398, 41, 'Ikea stol', 'NEMA'),
(399, 41, 'Sauder stol', 'NEMA'),
(400, 41, 'Bush Furniture stol', 'NEMA'),
(401, 41, 'Bush Furniture stol', 'NEMA'),
(402, 41, 'Sauder stol', 'NEMA'),
(403, 41, 'Bush Furniture stol', 'NEMA'),
(404, 41, 'Bush Furniture stol', 'NEMA'),
(405, 41, 'Walker Edison stol', 'NEMA'),
(406, 42, 'Razer web kamera', 'NEMA'),
(407, 42, 'AverMedia web kamera', 'NEMA'),
(408, 42, 'HP web kamera', 'NEMA'),
(409, 42, 'Logitech web kamera', 'NEMA'),
(410, 42, 'Logitech web kamera', 'NEMA'),
(411, 42, 'AverMedia web kamera', 'NEMA'),
(412, 42, 'Microsoft web kamera', 'NEMA'),
(413, 42, 'AverMedia web kamera', 'NEMA'),
(414, 42, 'HP web kamera', 'NEMA'),
(415, 42, 'Razer web kamera', 'NEMA'),
(416, 42, 'Logitech web kamera', 'NEMA'),
(417, 42, 'HP web kamera', 'NEMA'),
(418, 42, 'HP web kamera', 'NEMA'),
(419, 42, 'Logitech web kamera', 'NEMA'),
(420, 42, 'Microsoft web kamera', 'NEMA');

-- --------------------------------------------------------

--
-- Table structure for table `vl_scan`
--

CREATE TABLE `vl_scan` (
  `id` int(11) NOT NULL,
  `value` varchar(32) DEFAULT NULL,
  `standard` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_scan`
--

INSERT INTO `vl_scan` (`id`, `value`, `standard`) VALUES
(46, '1000300002338', 'EAN_13'),
(47, '1000300002352', 'EAN_13');

-- --------------------------------------------------------

--
-- Table structure for table `vl_session_cookies`
--

CREATE TABLE `vl_session_cookies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_session_cookies`
--

INSERT INTO `vl_session_cookies` (`id`, `user_id`, `expiry`, `token`) VALUES
(47, 6, '2023-12-28 22:27:52', 'd1f741f83328e1ded82062db4ed291f4'),
(48, 10, '2023-08-16 12:06:03', '5e5e613f47a34f1c317382b32ad0a5eb'),
(49, 13, '2023-08-04 16:53:30', '53682bf9cb21f0c71159cc20c7d2b829'),
(50, 9, '2023-08-03 10:59:49', '1fc16ee27955cd66ea2cb93e216167e9'),
(51, 14, '2023-11-20 20:37:45', '71ee547924939be49f97455fc6496cfb'),
(52, 16, '2023-08-04 10:07:15', '986b84c022385c2aa0249650932b81b4'),
(53, 18, '2023-08-05 14:38:29', '8a5e45e7b996307a089dabfcf52f3e72'),
(54, 24, '2023-12-24 20:27:29', '9d1d6259a0ea50fe50917e25abfada1f'),
(55, 25, '2023-12-09 12:38:48', '2abcd0f67152d1c533e9744e7971c94c'),
(56, 26, '2023-12-27 08:24:59', '752afe9e33b9db2d07f44fffca476cfe'),
(57, 34, '2023-12-24 18:11:17', 'f642d1e8c37e458e2044bce0d18762c7'),
(58, 2, '2023-12-24 20:24:13', '50f1df56345dd47db2a9c8dfc147dafb');

-- --------------------------------------------------------

--
-- Table structure for table `vl_tipovi_proizvoda`
--

CREATE TABLE `vl_tipovi_proizvoda` (
  `id` int(3) NOT NULL,
  `tip` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_tipovi_proizvoda`
--

INSERT INTO `vl_tipovi_proizvoda` (`id`, `tip`) VALUES
(29, 'stolac'),
(30, 'laptop'),
(31, 'monitor'),
(32, 'tipkovnica'),
(33, 'miš'),
(34, 'računalo'),
(35, 'projektor'),
(36, 'HDMI kabel'),
(37, 'pisač'),
(38, 'skener'),
(39, 'slušalice'),
(40, 'podloga za miš'),
(41, 'stol'),
(42, 'web kamera');

-- --------------------------------------------------------

--
-- Table structure for table `vl_ucionice`
--

CREATE TABLE `vl_ucionice` (
  `id` int(11) NOT NULL,
  `oznaka` varchar(4) DEFAULT NULL,
  `opis` varchar(255) DEFAULT 'Nema opisa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_ucionice`
--

INSERT INTO `vl_ucionice` (`id`, `oznaka`, `opis`) VALUES
(1, 'P0', 'Nema opisa'),
(2, 'P1', 'Nema opisa'),
(3, 'P2', 'Nema opisa'),
(4, 'P3', 'Nema opisa'),
(5, 'P4', 'Nema opisa'),
(6, 'P5', 'Nema opisa'),
(7, 'P6', 'Nema opisa'),
(8, 'P7', 'Nema opisa'),
(10, '32', 'Informatička');

-- --------------------------------------------------------

--
-- Table structure for table `vl_users`
--

CREATE TABLE `vl_users` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(32) NOT NULL,
  `datum_registracije` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_users`
--

INSERT INTO `vl_users` (`id`, `ime`, `prezime`, `username`, `email`, `password`, `role`, `datum_registracije`) VALUES
(1, '', '', 'vito', 'vito@email.com', 'list', 'admin', '2023-12-23 14:46:36'),
(2, '', '', 'sara', 'sara@email.com', '5bd537fc3789b5482e4936968f0fde95', 'admin', '2023-12-23 14:46:36'),
(3, '', '', 'frano', 'frano@email.com', '714a9186eaf319b527d387e8fd606485', 'user', '2023-12-23 14:46:36'),
(6, 'Vito', 'List', 'vitolist', 'vito.list2005@gmail.com', '1a191e3d2dd0011568e30e898b81bab6', 'admin', '2023-12-23 14:46:36'),
(24, 'Micko', 'Mali', 'micko', 'micko', '1a191e3d2dd0011568e30e898b81bab6', 'user', '2023-12-23 14:46:36'),
(26, 'Mirko', 'Jambrošić', 'mirko', 'mirko.jambrosic@skole.hr', '13592f2caf86af30572a825229a2a8dc', 'admin', '2023-12-23 14:46:36'),
(33, 'Test', 'Test', 'test', 'testing@inventura.hr', '098f6bcd4621d373cade4e832627b4f6', 'user', '2023-12-23 14:46:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vl_barkodovi`
--
ALTER TABLE `vl_barkodovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_evidencija`
--
ALTER TABLE `vl_evidencija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_inventura`
--
ALTER TABLE `vl_inventura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_invite_codes`
--
ALTER TABLE `vl_invite_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_mysql_errors`
--
ALTER TABLE `vl_mysql_errors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_pozvani`
--
ALTER TABLE `vl_pozvani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_proizvodi`
--
ALTER TABLE `vl_proizvodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_scan`
--
ALTER TABLE `vl_scan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_session_cookies`
--
ALTER TABLE `vl_session_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_tipovi_proizvoda`
--
ALTER TABLE `vl_tipovi_proizvoda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_ucionice`
--
ALTER TABLE `vl_ucionice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vl_users`
--
ALTER TABLE `vl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vl_barkodovi`
--
ALTER TABLE `vl_barkodovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5041;

--
-- AUTO_INCREMENT for table `vl_evidencija`
--
ALTER TABLE `vl_evidencija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `vl_inventura`
--
ALTER TABLE `vl_inventura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vl_invite_codes`
--
ALTER TABLE `vl_invite_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vl_mysql_errors`
--
ALTER TABLE `vl_mysql_errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1522;

--
-- AUTO_INCREMENT for table `vl_pozvani`
--
ALTER TABLE `vl_pozvani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vl_proizvodi`
--
ALTER TABLE `vl_proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `vl_scan`
--
ALTER TABLE `vl_scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `vl_session_cookies`
--
ALTER TABLE `vl_session_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `vl_tipovi_proizvoda`
--
ALTER TABLE `vl_tipovi_proizvoda`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `vl_ucionice`
--
ALTER TABLE `vl_ucionice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vl_users`
--
ALTER TABLE `vl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
