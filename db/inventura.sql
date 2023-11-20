-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 05:28 PM
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
-- Table structure for table `barkodovi`
--

CREATE TABLE `barkodovi` (
  `id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `barkod` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barkodovi`
--

INSERT INTO `barkodovi` (`id`, `proizvod_id`, `barkod`) VALUES
(1, 211, '0000290002111'),
(2, 212, '0000290002128'),
(3, 213, '0000290002135'),
(4, 214, '0000290002142'),
(5, 215, '0000290002159'),
(6, 216, '0000290002166'),
(7, 217, '0000290002173'),
(8, 218, '0000290002180'),
(9, 219, '0000290002197'),
(10, 220, '0000290002203'),
(11, 221, '0000290002210'),
(12, 222, '0000290002227'),
(13, 223, '0000290002234'),
(14, 224, '0000290002241'),
(15, 225, '0000290002258'),
(16, 226, '0000300002261'),
(17, 227, '0000300002278'),
(18, 228, '0000300002285'),
(19, 229, '0000300002292'),
(20, 230, '0000300002308'),
(21, 231, '0000300002315'),
(22, 232, '0000300002322'),
(23, 233, '0000300002339'),
(24, 234, '0000300002346'),
(25, 235, '0000300002353'),
(26, 236, '0000300002360'),
(27, 237, '0000300002377'),
(28, 238, '0000300002384'),
(29, 239, '0000300002391'),
(30, 240, '0000300002407'),
(31, 241, '0000310002411'),
(32, 242, '0000310002428'),
(33, 243, '0000310002435'),
(34, 244, '0000310002442'),
(35, 245, '0000310002459'),
(36, 246, '0000310002466'),
(37, 247, '0000310002473'),
(38, 248, '0000310002480'),
(39, 249, '0000310002497'),
(40, 250, '0000310002503'),
(41, 251, '0000310002510'),
(42, 252, '0000310002527'),
(43, 253, '0000310002534'),
(44, 254, '0000310002541'),
(45, 255, '0000310002558'),
(46, 256, '0000320002562'),
(47, 257, '0000320002579'),
(48, 258, '0000320002586'),
(49, 259, '0000320002593'),
(50, 260, '0000320002609'),
(51, 261, '0000320002616'),
(52, 262, '0000320002623'),
(53, 263, '0000320002630'),
(54, 264, '0000320002647'),
(55, 265, '0000320002654'),
(56, 266, '0000320002661'),
(57, 267, '0000320002678'),
(58, 268, '0000320002685'),
(59, 269, '0000320002692'),
(60, 270, '0000320002708'),
(61, 271, '0000330002712'),
(62, 272, '0000330002729'),
(63, 273, '0000330002736'),
(64, 274, '0000330002743'),
(65, 275, '0000330002750'),
(66, 276, '0000330002767'),
(67, 277, '0000330002774'),
(68, 278, '0000330002781'),
(69, 279, '0000330002798'),
(70, 280, '0000330002804'),
(71, 281, '0000330002811'),
(72, 282, '0000330002828'),
(73, 283, '0000330002835'),
(74, 284, '0000330002842'),
(75, 285, '0000330002859'),
(76, 286, '0000340002863'),
(77, 287, '0000340002870'),
(78, 288, '0000340002887'),
(79, 289, '0000340002894'),
(80, 290, '0000340002900'),
(81, 291, '0000340002917'),
(82, 292, '0000340002924'),
(83, 293, '0000340002931'),
(84, 294, '0000340002948'),
(85, 295, '0000340002955'),
(86, 296, '0000340002962'),
(87, 297, '0000340002979'),
(88, 298, '0000340002986'),
(89, 299, '0000340002993'),
(90, 300, '0000340003006'),
(91, 301, '0000350003010'),
(92, 302, '0000350003027'),
(93, 303, '0000350003034'),
(94, 304, '0000350003041'),
(95, 305, '0000350003058'),
(96, 306, '0000350003065'),
(97, 307, '0000350003072'),
(98, 308, '0000350003089'),
(99, 309, '0000350003096'),
(100, 310, '0000350003102'),
(101, 311, '0000350003119'),
(102, 312, '0000350003126'),
(103, 313, '0000350003133'),
(104, 314, '0000350003140'),
(105, 315, '0000350003157'),
(106, 316, '0000360003161'),
(107, 317, '0000360003178'),
(108, 318, '0000360003185'),
(109, 319, '0000360003192'),
(110, 320, '0000360003208'),
(111, 321, '0000360003215'),
(112, 322, '0000360003222'),
(113, 323, '0000360003239'),
(114, 324, '0000360003246'),
(115, 325, '0000360003253'),
(116, 326, '0000360003260'),
(117, 327, '0000360003277'),
(118, 328, '0000360003284'),
(119, 329, '0000360003291'),
(120, 330, '0000360003307'),
(121, 331, '0000370003311'),
(122, 332, '0000370003328'),
(123, 333, '0000370003335'),
(124, 334, '0000370003342'),
(125, 335, '0000370003359'),
(126, 336, '0000370003366'),
(127, 337, '0000370003373'),
(128, 338, '0000370003380'),
(129, 339, '0000370003397'),
(130, 340, '0000370003403'),
(131, 341, '0000370003410'),
(132, 342, '0000370003427'),
(133, 343, '0000370003434'),
(134, 344, '0000370003441'),
(135, 345, '0000370003458'),
(136, 346, '0000380003462'),
(137, 347, '0000380003479'),
(138, 348, '0000380003486'),
(139, 349, '0000380003493'),
(140, 350, '0000380003509'),
(141, 351, '0000380003516'),
(142, 352, '0000380003523'),
(143, 353, '0000380003530'),
(144, 354, '0000380003547'),
(145, 355, '0000380003554'),
(146, 356, '0000380003561'),
(147, 357, '0000380003578'),
(148, 358, '0000380003585'),
(149, 359, '0000380003592'),
(150, 360, '0000380003608'),
(151, 361, '0000390003612'),
(152, 362, '0000390003629'),
(153, 363, '0000390003636'),
(154, 364, '0000390003643'),
(155, 365, '0000390003650'),
(156, 366, '0000390003667'),
(157, 367, '0000390003674'),
(158, 368, '0000390003681'),
(159, 369, '0000390003698'),
(160, 370, '0000390003704'),
(161, 371, '0000390003711'),
(162, 372, '0000390003728'),
(163, 373, '0000390003735'),
(164, 374, '0000390003742'),
(165, 375, '0000390003759'),
(166, 376, '0000400003762'),
(167, 377, '0000400003779'),
(168, 378, '0000400003786'),
(169, 379, '0000400003793'),
(170, 380, '0000400003809'),
(171, 381, '0000400003816'),
(172, 382, '0000400003823'),
(173, 383, '0000400003830'),
(174, 384, '0000400003847'),
(175, 385, '0000400003854'),
(176, 386, '0000400003861'),
(177, 387, '0000400003878'),
(178, 388, '0000400003885'),
(179, 389, '0000400003892'),
(180, 390, '0000400003908'),
(181, 391, '0000410003912'),
(182, 392, '0000410003929'),
(183, 393, '0000410003936'),
(184, 394, '0000410003943'),
(185, 395, '0000410003950'),
(186, 396, '0000410003967'),
(187, 397, '0000410003974'),
(188, 398, '0000410003981'),
(189, 399, '0000410003998'),
(190, 400, '0000410004001'),
(191, 401, '0000410004018'),
(192, 402, '0000410004025'),
(193, 403, '0000410004032'),
(194, 404, '0000410004049'),
(195, 405, '0000410004056'),
(196, 406, '0000420004060'),
(197, 407, '0000420004077'),
(198, 408, '0000420004084'),
(199, 409, '0000420004091'),
(200, 410, '0000420004107'),
(201, 411, '0000420004114'),
(202, 412, '0000420004121'),
(203, 413, '0000420004138'),
(204, 414, '0000420004145'),
(205, 415, '0000420004152'),
(206, 416, '0000420004169'),
(207, 417, '0000420004176'),
(208, 418, '0000420004183'),
(209, 419, '0000420004190'),
(210, 420, '0000420004206');

-- --------------------------------------------------------

--
-- Table structure for table `evidencija`
--

CREATE TABLE `evidencija` (
  `id` int(11) NOT NULL,
  `proizvod_id` int(11) DEFAULT NULL,
  `ucionica_id` int(11) DEFAULT NULL,
  `datum` date DEFAULT current_timestamp(),
  `vrijeme` time NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidencija`
--

INSERT INTO `evidencija` (`id`, `proizvod_id`, `ucionica_id`, `datum`, `vrijeme`, `user_id`) VALUES
(102, 52, 13, '2020-03-29', '18:31:00', 784);

-- --------------------------------------------------------

--
-- Table structure for table `invite_codes`
--

CREATE TABLE `invite_codes` (
  `id` int(11) NOT NULL,
  `kod` varchar(8) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invite_codes`
--

INSERT INTO `invite_codes` (`id`, `kod`, `user_id`) VALUES
(2, 'e43bc500', 13),
(6, 'b92160c4', 14),
(8, '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mysql_errors`
--

CREATE TABLE `mysql_errors` (
  `id` int(11) NOT NULL,
  `query` varchar(16) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mysql_errors`
--

INSERT INTO `mysql_errors` (`id`, `query`, `message`, `time`) VALUES
(1035, 'COOKIE', 'admin/ucionice', '2023-11-18 17:21:05'),
(1036, 'COOKIE', 'admin/ucionice', '2023-11-18 17:21:34'),
(1037, 'COOKIE', 'admin/js/jquery/jquery-3.7.1.min.js', '2023-11-18 17:21:34'),
(1038, 'COOKIE', 'admin/js/delete_items.js', '2023-11-18 17:21:34'),
(1039, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1040, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1041, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1042, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1043, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1044, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1045, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1046, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1047, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1048, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1049, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1050, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1051, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1052, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1053, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1054, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1055, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1056, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1057, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1058, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1059, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1060, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1061, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1062, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1063, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1064, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1065, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1066, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1067, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1068, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1069, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1070, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1071, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1072, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1073, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1074, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1075, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1076, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1077, 'COOKIE', 'admin/js/404.html', '2023-11-18 17:21:35'),
(1078, 'COOKIE', 'admin/js/jquery/404.html', '2023-11-18 17:21:35'),
(1079, 'COOKIE', 'admin/admin', '2023-11-18 17:21:40'),
(1080, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1081, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1082, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1083, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1084, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1085, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1086, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1087, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1088, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1089, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1090, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1091, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1092, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1093, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1094, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1095, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:40'),
(1096, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:41'),
(1097, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:41'),
(1098, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:41'),
(1099, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1100, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1101, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1102, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1103, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1104, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1105, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1106, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1107, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1108, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1109, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1110, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1111, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1112, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1113, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1114, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1115, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1116, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1117, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1118, 'COOKIE', 'admin/404.html', '2023-11-18 17:21:42'),
(1119, 'COOKIE', 'admin', '2023-11-18 17:21:42'),
(1120, 'COOKIE', 'admin', '2023-11-18 17:21:48'),
(1121, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1122, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1123, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1124, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1125, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1126, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1127, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1128, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1129, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1130, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1131, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1132, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1133, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1134, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1135, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1136, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1137, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1138, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1139, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1140, 'COOKIE', 'index.php', '2023-11-19 10:40:38'),
(1141, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1142, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1143, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1144, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1145, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1146, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1147, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1148, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1149, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1150, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1151, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1152, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1153, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1154, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1155, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1156, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1157, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1158, 'COOKIE', 'index.php', '2023-11-19 10:40:39'),
(1159, 'COOKIE', 'index.php', '2023-11-19 10:40:40'),
(1160, 'COOKIE', 'index.php', '2023-11-19 10:40:40'),
(1161, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1162, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1163, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1164, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1165, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1166, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1167, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1168, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1169, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1170, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1171, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1172, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1173, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1174, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1175, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1176, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1177, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1178, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1179, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1180, 'COOKIE', 'index.php', '2023-11-19 10:40:45'),
(1181, 'COOKIE', 'admina', '2023-11-19 10:43:39'),
(1182, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1183, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1184, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1185, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1186, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1187, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1188, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1189, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1190, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1191, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1192, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1193, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1194, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1195, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1196, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1197, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1198, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1199, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1200, 'COOKIE', '404.html', '2023-11-19 10:43:39'),
(1201, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1202, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1203, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1204, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1205, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1206, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1207, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1208, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1209, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1210, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1211, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1212, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1213, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1214, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1215, 'COOKIE', '404.html', '2023-11-19 10:43:40'),
(1216, 'COOKIE', '404.html', '2023-11-19 10:43:41'),
(1217, 'COOKIE', '404.html', '2023-11-19 10:43:41'),
(1218, 'COOKIE', '404.html', '2023-11-19 10:43:41'),
(1219, 'COOKIE', '404.html', '2023-11-19 10:43:41'),
(1220, 'COOKIE', '404.html', '2023-11-19 10:43:41'),
(1221, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1222, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1223, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1224, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1225, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1226, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1227, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1228, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1229, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1230, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1231, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1232, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1233, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1234, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1235, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1236, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1237, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1238, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1239, 'COOKIE', '404.html', '2023-11-19 10:43:46'),
(1240, 'COOKIE', '404.html', '2023-11-19 10:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `pozvani`
--

CREATE TABLE `pozvani` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pozvani`
--

INSERT INTO `pozvani` (`id`, `admin_id`, `user_id`) VALUES
(3, 6, 23);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `tip` int(11) NOT NULL,
  `naziv` varchar(64) DEFAULT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `tip`, `naziv`, `opis`) VALUES
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
-- Table structure for table `session_cookies`
--

CREATE TABLE `session_cookies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_cookies`
--

INSERT INTO `session_cookies` (`id`, `user_id`, `expiry`, `token`) VALUES
(47, 6, '2023-11-19 23:38:56', 'e774c6511d165df1bccfed82780e998c'),
(48, 10, '2023-08-16 12:06:03', '5e5e613f47a34f1c317382b32ad0a5eb'),
(49, 13, '2023-08-04 16:53:30', '53682bf9cb21f0c71159cc20c7d2b829'),
(50, 9, '2023-08-03 10:59:49', '1fc16ee27955cd66ea2cb93e216167e9'),
(51, 14, '2023-08-05 14:37:45', '71ee547924939be49f97455fc6496cfb'),
(52, 16, '2023-08-04 10:07:15', '986b84c022385c2aa0249650932b81b4'),
(53, 18, '2023-08-05 14:38:29', '8a5e45e7b996307a089dabfcf52f3e72');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`) VALUES
('45554'),
('9789530216785');

-- --------------------------------------------------------

--
-- Table structure for table `tipovi_proizvoda`
--

CREATE TABLE `tipovi_proizvoda` (
  `id` int(3) NOT NULL,
  `tip` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipovi_proizvoda`
--

INSERT INTO `tipovi_proizvoda` (`id`, `tip`) VALUES
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
-- Table structure for table `ucionice`
--

CREATE TABLE `ucionice` (
  `id` int(11) NOT NULL,
  `oznaka` varchar(4) DEFAULT NULL,
  `opis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ucionice`
--

INSERT INTO `ucionice` (`id`, `oznaka`, `opis`) VALUES
(1, 'p0', NULL),
(2, 'p1', NULL),
(3, 'p2', NULL),
(4, 'p3', NULL),
(5, 'p4', NULL),
(6, 'p5', NULL),
(7, 'p6', NULL),
(8, 'p7', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `username`, `email`, `password`, `role`) VALUES
(1, '', '', 'vito', 'vito@email.com', 'list', 'admin'),
(6, '', '', 'vitolist', 'vito.list2005@gmail.com', '1a191e3d2dd0011568e30e898b81bab6', 'admin'),
(9, '', '', 'vito.list', 'vito.list@skole.hr', '1a191e3d2dd0011568e30e898b81bab6', 'user'),
(10, '', '', 'frano', 'frano@email.com', '714a9186eaf319b527d387e8fd606485', 'user'),
(13, '', '', 'dd', 'dragan@email.com', '1aabac6d068eef6a7bad3fdf50a05cc8', 'admin'),
(14, '', '', 'sara', 'sara@email.com', '5bd537fc3789b5482e4936968f0fde95', 'admin'),
(16, '', '', 'proba', 'proba@email.com', 'c0a8e1e5e307cc5b33819b387b5f01fd', 'user'),
(18, '', '', 'bokvito', 'vitolist@gmail.com', '5a80ff6d0387490f339b197273725a8a', 'admin'),
(23, '', '', 'testing', 'testing', 'ae2b1fca515949e5d54fb22b8ed95575', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barkodovi`
--
ALTER TABLE `barkodovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evidencija`
--
ALTER TABLE `evidencija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invite_codes`
--
ALTER TABLE `invite_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mysql_errors`
--
ALTER TABLE `mysql_errors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pozvani`
--
ALTER TABLE `pozvani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_cookies`
--
ALTER TABLE `session_cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipovi_proizvoda`
--
ALTER TABLE `tipovi_proizvoda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ucionice`
--
ALTER TABLE `ucionice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barkodovi`
--
ALTER TABLE `barkodovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `evidencija`
--
ALTER TABLE `evidencija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `invite_codes`
--
ALTER TABLE `invite_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mysql_errors`
--
ALTER TABLE `mysql_errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1241;

--
-- AUTO_INCREMENT for table `pozvani`
--
ALTER TABLE `pozvani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `session_cookies`
--
ALTER TABLE `session_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tipovi_proizvoda`
--
ALTER TABLE `tipovi_proizvoda`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ucionice`
--
ALTER TABLE `ucionice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
