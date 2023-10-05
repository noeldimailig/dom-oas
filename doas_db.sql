-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:5555
-- Generation Time: Jun 22, 2023 at 10:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_details`
--

CREATE TABLE `appointment_details` (
  `appointment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `position_id` int DEFAULT NULL,
  `school_in_id` int DEFAULT NULL,
  `level_id` int DEFAULT NULL,
  `district_id` int DEFAULT NULL,
  `func_div_id` int DEFAULT NULL,
  `usov_id` int DEFAULT NULL,
  `purpose` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_visit` date DEFAULT NULL,
  `time_slot_id` int DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district`) VALUES
(1, 'Baco'),
(2, 'Bansud'),
(3, 'Bongabong North'),
(4, 'Bongabong South'),
(5, 'Bulalacao'),
(6, 'Gloria'),
(7, 'Mansalay'),
(8, 'Naujan West'),
(9, 'Naujan East'),
(10, 'Naujan South'),
(11, 'Pinamalayan East'),
(12, 'Pinamalayan West'),
(13, 'Pola'),
(14, 'Puerto Galera'),
(15, 'Roxas'),
(16, 'San Teodoro'),
(17, 'Soccoro'),
(18, 'Victoria');

-- --------------------------------------------------------

--
-- Table structure for table `functional_division`
--

CREATE TABLE `functional_division` (
  `func_div_id` int NOT NULL,
  `functional_division` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `functional_division`
--

INSERT INTO `functional_division` (`func_div_id`, `functional_division`) VALUES
(1, 'OSDS'),
(2, 'SGOD'),
(3, 'CID');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Prefer not to Say');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `level`) VALUES
(1, 'Elementary'),
(2, 'Secondary'),
(3, 'Not Applicable'),
(6, 'Sample level updated');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position`) VALUES
(1, 'Accountant III'),
(2, 'Administrative Aide I'),
(3, 'Administrative Aide II'),
(4, 'Administrative Aide III'),
(5, 'Administrative Aide IV'),
(6, 'Administrative Aide V'),
(7, 'Administrative Aide VI'),
(8, 'Administrative Officer I'),
(9, 'Administrative Officer II'),
(10, 'Administrative Officer III'),
(11, 'Administrative Officer IV'),
(12, 'Administrative Officer V'),
(13, 'Assistant Schools Division Superintendent'),
(14, 'Attorney III'),
(15, 'Chief Education Supervisor'),
(16, 'Dentist II'),
(17, 'Education Program Specialist II'),
(18, 'Education Program Supervisor I'),
(19, 'Engineer III'),
(20, 'Guidance Counselor I'),
(21, 'Guidance Counselor II'),
(22, 'Head Teacher I'),
(23, 'Head Teacher II'),
(24, 'Head Teacher III'),
(25, 'Head Teacher IV'),
(26, 'Head Teacher V'),
(27, 'Head Teacher VI'),
(28, 'House Parent'),
(29, 'Information Technology Officer'),
(30, 'Librarian I'),
(31, 'Librian II'),
(32, 'Master Teacher I'),
(33, 'Master Teacher II'),
(34, 'Medical Officer III'),
(35, 'Nurse II'),
(36, 'Parent/Guardian'),
(37, 'Planning Officer III'),
(38, 'Principal I'),
(39, 'Principal II'),
(40, 'Principal III'),
(41, 'Principal IV'),
(42, 'Project Development Officer I'),
(43, 'Project Development Officer II'),
(44, 'Public Schools District Supervisor'),
(45, 'Registrar I'),
(46, 'Assistant Principal II'),
(47, 'Schools Division Superintendent'),
(48, 'Security Guard I'),
(49, 'Senior Education program Specialist'),
(50, 'SIC'),
(51, 'Special Science Teacher I'),
(52, 'Special Science Teacher II'),
(53, 'Special Science Teacher III'),
(54, 'SpEd Teacher I'),
(55, 'SpEd Teacher II'),
(56, 'SpEd Teacher III'),
(57, 'Student'),
(58, 'Teacher I'),
(59, 'Teacher II'),
(60, 'Teacher III'),
(61, 'TIC'),
(62, 'Teacher-Applicant');

-- --------------------------------------------------------

--
-- Table structure for table `school_id_name`
--

CREATE TABLE `school_id_name` (
  `school_in_id` int NOT NULL,
  `school_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_id_name`
--

INSERT INTO `school_id_name` (`school_in_id`, `school_id`, `school_name`) VALUES
(1, '100948', 'Acasia ES'),
(2, '110317', 'Asiko Barrio School'),
(3, '110318', 'Baras Mangyan School'),
(4, '110319', 'Bayanan ES'),
(5, '110320', 'Benito Villar MS'),
(6, '110321', 'Binaybay ES'),
(7, '110325', 'Burbuli ES'),
(8, '110326', 'Casillon ES'),
(9, '110327', 'Dulangan I ES'),
(10, '110328', 'Dulangan II ES'),
(11, '110329', 'Dulangan III ES'),
(12, '110330', 'Felix Hernandez MS'),
(13, '110331', 'Felix V. Aceveda MS'),
(14, '110332', 'Julio R. Hernandez MS'),
(15, '110333', 'Katuwiran I ES'),
(16, '110334', 'Katuwiran II ES'),
(17, '110335', 'Lantuyang ES'),
(18, '110336', 'Lumangbayan ES'),
(19, '110337', 'Water ES'),
(20, '110338', 'Malmis Mangyan School'),
(21, '110339', 'Mamalao Mangyan School'),
(22, '110340', 'Mangangan I ES'),
(23, '110341', 'Mangangan II ES'),
(24, '110342', 'Modesto Acob MS'),
(25, '110343', 'Pambisan ES'),
(26, '110344', 'Pulantubig ES'),
(27, '110345', 'Putican ES'),
(28, '110346', 'Sta Rosa II ES'),
(29, '110347', 'Eladia C. Macalalad ES (Tabontabon ES)'),
(30, '110348', 'Tabucala Mangyan School'),
(31, '110349', 'Tagumpay PS'),
(32, '110350', 'Apnagan ES'),
(33, '110351', 'Bansud CS'),
(34, '110352', 'Bato ES'),
(35, '110353', 'Catmon ES'),
(36, '110354', 'Conrazon ES'),
(37, '110355', 'Dr. Angel S. Rodriguez MES'),
(38, '110356', 'Dyangdang ES'),
(39, '110358', 'Francisco M. Morales-Malaya ES'),
(40, '110359', 'Malu ES'),
(41, '110360', 'Manacsi ES'),
(42, '110361', 'Manihala ES'),
(43, '110362', 'Pag-Asa ES'),
(44, '110363', 'Policarpio Hernandez MES'),
(45, '110364', 'Proper Bansud ES'),
(46, '110365', 'Rosacara ES'),
(47, '110366', 'Salcedo ES'),
(48, '110367', 'Sto. Niño ES'),
(49, '110368', 'Tiguisan ES'),
(50, '110369', 'Villapagasa ES'),
(51, '110370', 'Bagong Bayan CS'),
(52, '110371', 'Batangan Mangyan ES'),
(53, '110372', 'Bukal ES'),
(54, '110373', 'Carmundo ES'),
(55, '110374', 'Catalino Lopez MES (Libertad ES)'),
(56, '110375', 'Felimon M. Salcedo MS'),
(57, '110376', 'Formon ES'),
(58, '110377', 'Hagan ES'),
(59, '110378', 'Lisap ES'),
(60, '110379', 'Moises Abante MES'),
(61, '110381', 'Mapang ES'),
(62, '110382', 'Morente ES'),
(63, '110383', 'Panluan ES'),
(64, '110384', 'San Jose ES'),
(65, '110386', 'Siange ES'),
(66, '110387', 'Felisa Guevarra Salvacion MES'),
(67, '110388', 'Sta. Cruz ES'),
(68, '110389', 'Tawas ES'),
(69, '110390', 'Selda-Lazaro Memorial ES'),
(70, '110391', 'Castor F. Solabo MES'),
(71, '110392', 'Camantigue ES'),
(72, '110393', 'Cawayan ES'),
(73, '110394', 'Braulio Umali Garcia ES'),
(74, '110395', 'Iglecerio Lopez MES'),
(75, '110396', 'Kaligtasan ES'),
(76, '110397', 'Labonan ES'),
(77, '110398', 'Pascuala P. Gabia MS'),
(78, '110399', 'Magdalena  Umali Suyon MS (Bongabong South CS)'),
(79, '110400', 'Villa Gertrudes I. Enriquez MES'),
(80, '110401', 'Masaguisi ES'),
(81, '110402', 'Fidel M. Reyes MS'),
(82, '110403', 'Ogbot ES'),
(83, '110404', 'Orconuma ES'),
(84, '110405', 'Pulosahi ES'),
(85, '110406', 'Tomas Villanueva MS'),
(86, '110407', 'Sebastian Umali MS'),
(87, '110408', 'Agong ES'),
(88, '110409', 'Alimawan ES'),
(89, '110410', 'Bagong Sikat ES'),
(90, '110411', 'Balatasan ES'),
(91, '110412', 'Bangkal ES'),
(92, '110413', 'Benli ES'),
(93, '110414', 'Bulalacao CS'),
(94, '110415', 'Cabugao ES'),
(95, '110416', 'Cambunang ES'),
(96, '110417', 'Dangkalan ES'),
(97, '110430', 'Upper Yunot ES'),
(98, '110356', 'Dyangdang ES'),
(99, '110358', 'Francisco M. Morales-Malaya ES'),
(100, '110359', 'Malu ES'),
(101, '110360', 'Manacsi ES'),
(102, '110361', 'Manihala ES'),
(103, '110362', 'Pag-Asa ES'),
(104, '110363', 'Policarpio Hernandez MES'),
(105, '110364', 'Proper Bansud ES'),
(106, '110365', 'Rosacara ES'),
(107, '110366', 'Salcedo ES'),
(108, '110367', 'Sto. Niño ES'),
(109, '110368', 'Tiguisan ES'),
(110, '110369', 'Villapagasa ES'),
(111, '110370', 'Bagong Bayan CS'),
(112, '110371', 'Batangan Mangyan ES'),
(113, '110372', 'Bukal ES'),
(114, '110373', 'Carmundo ES'),
(115, '110374', 'Catalino Lopez MES (Libertad ES)'),
(116, '110375', 'Felimon M. Salcedo MS'),
(117, '110376', 'Formon ES'),
(118, '110377', 'Hagan ES'),
(119, '110378', 'Lisap ES'),
(120, '110379', 'Moises Abante MES'),
(121, '110381', 'Mapang ES'),
(122, '110382', 'Morente ES'),
(123, '110383', 'Panluan ES'),
(124, '110384', 'San Jose ES'),
(125, '110386', 'Siange ES'),
(126, '110387', 'Felisa Guevarra Salvacion MES'),
(127, '110388', 'Sta. Cruz ES'),
(128, '110389', 'Tawas ES'),
(129, '110390', 'Selda-Lazaro Memorial ES'),
(130, '110391', 'Castor F. Solabo MES'),
(131, '110392', 'Camantigue ES'),
(132, '110393', 'Cawayan ES'),
(133, '110394', 'Braulio Umali Garcia ES'),
(134, '110395', 'Iglecerio Lopez MES'),
(135, '110396', 'Kaligtasan ES'),
(136, '110397', 'Labonan ES'),
(137, '110398', 'Pascuala P. Gabia MS'),
(138, '110399', 'Magdalena  Umali Suyon MS (Bongabong South CS)'),
(139, '110400', 'Villa Gertrudes I. Enriquez MES'),
(140, '110401', 'Masaguisi ES'),
(141, '110402', 'Fidel M. Reyes MS'),
(142, '110403', 'Ogbot ES'),
(143, '110404', 'Orconuma ES'),
(144, '110405', 'Pulosahi ES'),
(145, '110406', 'Tomas Villanueva MS'),
(146, '110407', 'Sebastian Umali MS'),
(147, '110408', 'Agong ES'),
(148, '110409', 'Alimawan ES'),
(149, '110410', 'Bagong Sikat ES'),
(150, '110411', 'Balatasan ES'),
(151, '110412', 'Bangkal ES'),
(152, '110413', 'Benli ES'),
(153, '110414', 'Bulalacao CS'),
(154, '110415', 'Cabugao ES'),
(155, '110416', 'Cambunang ES'),
(156, '110417', 'Dangkalan ES'),
(157, '110418', 'Lambok ES'),
(158, '110419', 'Libtong ES'),
(159, '110420', 'Lower Yunot ES'),
(160, '110421', 'Maasin ES'),
(161, '110422', 'Maujao ES'),
(162, '110423', 'Milagrosa ES'),
(163, '110424', 'Nasucob ES'),
(164, '110425', 'Pawikan ES'),
(165, '110426', 'San Isidro ES'),
(166, '110427', 'San Juan ES'),
(167, '110428', 'San Miguel ES'),
(168, '110429', 'San Roque ES'),
(169, '110430', 'Upper Yunot ES'),
(170, '110431', 'Agos ES'),
(171, '110432', 'Agsalin ES'),
(172, '110433', 'Almavilla ES'),
(173, '110434', 'Balete ES'),
(174, '110435', 'Banus ES'),
(175, '110436', 'Banutan ES'),
(176, '110437', 'Batingan ES'),
(177, '110438', 'Bulbugan ES'),
(178, '110439', 'Buong Lupa ES'),
(179, '110440', 'Dalagan ES'),
(180, '110441', 'Don Joaquin Roque MS'),
(181, '110442', 'Gloria CS'),
(182, '110443', 'Kawit ES'),
(183, '110444', 'Langgang ES'),
(184, '110445', 'Manuel Sadiwa Sr. MES'),
(185, '110446', 'Malamig ES'),
(186, '110447', 'Malayong ES'),
(187, '110448', 'Malubay ES'),
(188, '110449', 'Malusak ES'),
(189, '110450', 'Manguyang ES'),
(190, '110451', 'Maragooc ES'),
(191, '110452', 'Mirayan ES'),
(192, '110453', 'Pakpaklawin ES'),
(193, '110454', 'Papandungin ES'),
(194, '110455', 'Tambong ES'),
(195, '110456', 'Tinalunan ES'),
(196, '110457', 'Melecio D. Cantos ES (Tubag ES)'),
(197, '110458', 'Anahaw ES'),
(198, '110459', 'Don B. Del Mundo MS'),
(199, '110460', 'Bait ES'),
(200, '110461', 'Juan Arcemo ES'),
(201, '110462', 'Leonardo U. Tugade MS'),
(202, '110463', 'Macario A. Sandoval ES'),
(203, '110464', 'Cabalwa ES'),
(204, '110465', 'Cabuyao ES'),
(205, '110466', 'Cagulong ES'),
(206, '110467', 'Felipe C. Anastacio ES'),
(207, '110468', 'Kilapnit ES'),
(208, '110469', 'Mariano M. Marciano MES (Himpaparay ES)'),
(209, '110470', 'Manaul ES'),
(210, '110471', 'Mansalay CS'),
(211, '110472', 'Panaytayan ES'),
(212, '110473', 'Quinomay ES'),
(213, '110474', 'Roma ES'),
(214, '110475', 'Salvacion ES'),
(215, '110476', 'Sinariri ES'),
(216, '110477', 'Sta. Brigida ES'),
(217, '110478', 'Sta. Maria ES'),
(218, '110479', 'Lamac ES'),
(219, '110480', 'Teresita ES'),
(220, '110481', 'Villarosa ES'),
(221, '110482', 'Wasig ES'),
(222, '110483', 'Waygan ES'),
(223, '110484', 'Antipolo ES'),
(224, '110485', 'Bancuro ES'),
(225, '110486', 'Concepcion ES'),
(226, '110487', 'Francisco Melgar MS'),
(227, '110488', 'Francisco Tria MS'),
(228, '110489', 'Julian Ylagan MS'),
(229, '110490', 'Jose L. Basa MS'),
(230, '110491', 'Kalinisan ES'),
(231, '110492', 'Leon Garong MS'),
(232, '110493', 'Mariano P. Garcia MS'),
(233, '110494', 'Mariano P. Leuterio MS'),
(234, '110495', 'Mena G. Valencia MS'),
(235, '110496', 'Macapili ES'),
(236, '110497', 'Masaging ES'),
(237, '110498', 'Montelago ES'),
(238, '110499', 'Nag-Iba I ES'),
(239, '110500', 'Nag-Iba II ES'),
(240, '110501', 'San Antonio ES'),
(241, '110502', 'Santiago ES'),
(242, '110503', 'Tigbao ES'),
(243, '110504', 'Tito B. Herrera MES'),
(244, '110505', 'Aurora CS'),
(245, '110507', 'Bagong Buhay ES'),
(246, '110508', 'Bagong Pag-Asa PS'),
(247, '110509', 'Balite Mangyan School'),
(248, '110510', 'Bucayao Grande Mangyan School'),
(249, '110511', 'Caburo Mangyan School'),
(250, '110512', 'Del Pilar ES'),
(251, '110513', 'Del Pilar ES - Annex'),
(252, '110514', 'Evangelista ES'),
(253, '110515', 'Inarawan ES'),
(254, '110516', 'Karumagit ES'),
(255, '110517', 'Mabini ES'),
(256, '110518', 'Mabini ES - Annex'),
(257, '110519', 'Mahabang Parang ES'),
(258, '110520', 'Malvar ES'),
(259, '110521', 'Masagana ES'),
(260, '110522', 'Cornelio Lintawagin MES'),
(261, '110523', 'Mulawin ES'),
(262, '110524', 'Panikian ES'),
(263, '110525', 'Saturnino E. Gomez MES'),
(264, '110526', 'San Andres ES'),
(265, '110527', 'San Carlos ES'),
(266, '110528', 'San Luis ES'),
(267, '110529', 'Sto. Niño E'),
(268, '110530', 'Tagumpay ES'),
(269, '110531', 'Tigkan ES'),
(270, '110532', 'Tipas Mangyan School'),
(271, '110533', 'Adrialuna ES'),
(272, '110534', 'Bacungan ES'),
(273, '110535', 'Porfirio G. Comia MES'),
(274, '110536', 'Manuel R. Marcos Sr. ES'),
(275, '110537', 'Buhangin ES'),
(276, '110538', 'Gamao ES'),
(277, '110539', 'Juan Luna MES'),
(278, '110540', 'Pinagsabangan I ES'),
(279, '110541', 'Laguna ES'),
(280, '110542', 'Macangas PS'),
(281, '110543', 'Eufracio Carmona ES'),
(282, '110544', 'Malinao ES'),
(283, '110545', 'Basilio Aguilon ES'),
(284, '110546', 'Petra Garis MES'),
(285, '110547', 'Piñahan ES'),
(286, '110548', 'Santiago Garong MS'),
(287, '110549', 'Sampaguita ES'),
(288, '110550', 'San Isidro ES'),
(289, '110551', 'San Nicolas ES'),
(290, '110552', 'San Pedro ES'),
(291, '110553', 'Joaquin G. Hernandez ES'),
(292, '110554', 'Don Vicente Delgado MES'),
(293, '110555', 'Banilad ES'),
(294, '110556', 'Buli ES'),
(295, '110557', 'Doña Asuncion Reyes MES'),
(296, '110558', 'Juan Morente Sr. MPS'),
(297, '110559', 'Lumambayan ES'),
(298, '110560', 'Malaya ES'),
(299, '110561', 'Natividad De Joya MS'),
(300, '110562', 'Papandayan ES'),
(301, '110563', 'Pili ES'),
(302, '110564', 'Quinabigan ES'),
(303, '110565', 'Ranzo ES'),
(304, '110566', 'Rosario ES'),
(305, '110567', 'Sta. Isabel ES'),
(306, '110568', 'Upper Bongol ES'),
(307, '110569', 'Anoling ES'),
(308, '110570', 'Bacungan ES'),
(309, '110571', 'Bangbang ES'),
(310, '110572', 'Calingag ES'),
(311, '110573', 'Inclanay ES'),
(312, '110574', 'M. Ansaldo Sr. MES'),
(313, '110575', 'Maliangcog ES'),
(314, '110576', 'Maningcol ES'),
(315, '110577', 'Marayos ES'),
(316, '110578', 'Nabuslot CS'),
(317, '110579', 'Pagalagala ES'),
(318, '110580', 'Pambisan Munti ES'),
(319, '110581', 'Panggulayan ES'),
(320, '110582', 'Sabang ES'),
(321, '110583', 'Safa ES (Minority-Sabang)'),
(322, '110584', 'Sta. Rita ES'),
(323, '110585', 'Bacawan ES'),
(324, '110586', 'Bacungan ES'),
(325, '110587', 'Bakyaan ES'),
(326, '110588', 'Biga ES'),
(327, '110590', 'Buhay Na Tubig ES'),
(328, '110591', 'Calatagan ES'),
(329, '110592', 'Calima ES'),
(330, '110593', 'Calubasanhon ES'),
(331, '110594', 'Casiligan ES'),
(332, '110595', 'Malibago ES'),
(333, '110596', 'Maluanluan ES'),
(334, '110597', 'Matulatula ES'),
(335, '110598', 'Misong ES'),
(336, '110599', 'Pahilahan ES'),
(337, '110600', 'Panikihan ES'),
(338, '110601', 'Pola CS'),
(339, '110602', 'Pula ES'),
(340, '110603', 'Puting Cacao ES'),
(341, '110604', 'Tagbakin ES'),
(342, '110605', 'Tagumpay ES'),
(343, '110606', 'Tiguihan ES'),
(344, '110607', 'Anastacio Cataquis Sabina Unson MS'),
(345, '110608', 'Ambang Mangyan School'),
(346, '110609', 'Aninuan ES'),
(347, '110610', 'Baclayan Mangyan School'),
(348, '110611', 'Balatero ES'),
(349, '110612', 'Facundo C. Lopez - Palangan Integrated School'),
(350, '110613', 'Isidoro Suzara MS'),
(351, '110614', 'Lucena A. Datinginoo MS'),
(352, '110615', 'Malago Mangyan School'),
(353, '110616', 'Minolo ES'),
(354, '110617', 'Pagturian Mangyan School'),
(355, '110618', 'Paraway Mangyan School'),
(356, '110619', 'Puerto Galera CS'),
(357, '110620', 'Sabang ES'),
(358, '110621', 'San Antonio ES'),
(359, '110622', 'San Isidro ES'),
(360, '110623', 'Sto. Nino ES'),
(361, '110624', 'Tabinay ES'),
(362, '110625', 'Talipanan Mangyan School'),
(363, '110626', 'Villaflor ES'),
(364, '110627', 'B. T. Lazaro MS'),
(365, '110628', 'Benito P. Garfin ES'),
(366, '110629', 'Catalino Dizon MS'),
(367, '110630', 'Dangay ES'),
(368, '110631', 'Happy Valley ES'),
(369, '110632', 'Libertad ES'),
(370, '110633', 'Libtong ES'),
(371, '110634', 'Little Tanauan ES'),
(372, '110635', 'Lucio Suarez Sr. MS'),
(373, '110636', 'Maraska ES'),
(374, '110637', 'P. Olarte ES'),
(375, '110638', 'Paclasan ES'),
(376, '110639', 'Raymundo Escarez MS'),
(377, '110640', 'Roxas CS'),
(378, '110641', 'San Aquilino ES'),
(379, '110642', 'San Jose ES'),
(380, '110643', 'San Juan ES'),
(381, '110644', 'San Mariano ES'),
(382, '110645', 'San Rafael ES'),
(383, '110646', 'San Vicente ES'),
(384, '110647', 'Tagaskan ES'),
(385, '110648', 'Tauga Diit ES'),
(386, '110649', 'Uyao ES'),
(387, '110650', 'Victoria ES'),
(388, '110651', 'Arigoy Mangyan School'),
(389, '110652', 'Bigaan ES'),
(390, '110655', 'Amando A. Rico ES (Calangatan ES)'),
(391, '110656', 'Calsapa ES'),
(392, '110658', 'Lumangbayan ES'),
(393, '110659', 'Paspasin ES'),
(394, '110660', 'Saclag Settlement Farm School'),
(395, '110661', 'San Rafael ES'),
(396, '110662', 'San Teodoro CS'),
(397, '110663', 'Tacligan ES'),
(398, '110664', 'Bagsok ES'),
(399, '110665', 'Batong Dalig ES'),
(400, '110666', 'Bayuin ES'),
(401, '110667', 'Calubayan ES'),
(402, '110668', 'Calucmoy ES'),
(403, '110669', 'Catiningan ES'),
(404, '110670', 'Daan ES'),
(405, '110671', 'Fortuna ES'),
(406, '110672', 'Granvida ES'),
(407, '110673', 'Happy Valley ES'),
(408, '110674', 'Lapog ES'),
(409, '110675', 'Leuteboro ES'),
(410, '110676', 'Mabuhay I ES'),
(411, '110677', 'Mabuhay II ES'),
(412, '110678', 'Malugay ES'),
(413, '110679', 'Maria Concepcion ES'),
(414, '110680', 'Matungao ES'),
(415, '110681', 'Monteverde ES'),
(416, '110682', 'Ciriaco V. Carle MES'),
(417, '110683', 'Socorro CS'),
(418, '110684', 'Subaan ES'),
(419, '110685', 'Tigao ES'),
(420, '110686', 'Alcate ES'),
(421, '110687', 'Alialy Roldan MES'),
(422, '110688', 'Antonino ES'),
(423, '110689', 'Bagong Buhay ES'),
(424, '110690', 'Gorgonio Atienza ES (Bagong Silang I ES)'),
(425, '110691', 'Bethel ES'),
(426, '110692', 'Daniel Sapaden ES'),
(427, '110693', 'Jose P. Viola Villarica MES'),
(428, '110694', 'Duongan ES'),
(429, '110695', 'Hermogenes Bautista MES'),
(430, '110696', 'Jose J. Dela Cruz Sr. MES'),
(431, '110697', 'Loyal ES'),
(432, '110698', 'Macatoc ES'),
(433, '110699', 'Simon Gayutin MES'),
(434, '110700', 'San Isidro ES'),
(435, '110701', 'Minas ES'),
(436, '110702', 'Murangan PS'),
(437, '110703', 'Ordovilla ES'),
(438, '110704', 'Pakyas ES'),
(439, '110705', 'Pamuwisan Minority School'),
(440, '110706', 'Nena Reyes Arago ES (San Cristobal ES)'),
(441, '110707', 'San Antonio ES'),
(442, '110708', 'San Narciso ES'),
(443, '110709', 'Tadyawan Minority School'),
(444, '110710', 'Victoria CS'),
(445, '110711', 'Villa Cerveza ES'),
(446, '130206', 'Mungos Mangyan ES'),
(447, '136953', 'Naswak Hatubuan Bangon ES'),
(448, '170001', 'Salay ES'),
(449, '170002', 'Malapad ES'),
(450, '170003', 'Sta. Cruz ES'),
(451, '170004', 'San Andres PS'),
(452, '170005', 'Aplaya ES'),
(453, '170006', 'Campaasan ES'),
(454, '170008', 'Dao ES'),
(455, '170009', 'Bayanan PS'),
(456, '170010', 'Suyong Mangyan School'),
(457, '170011', 'Sampaguita ES'),
(458, '170012', 'Adong Mangyan School'),
(459, '170013', 'Bucayao Grande Mangyan School - Annex'),
(460, '170014', 'Bagong Silang II ES'),
(461, '170016', 'Zhejohn ES'),
(462, '170017', 'Cacawan ES'),
(463, '170018', 'Delrazon ES'),
(464, '170019', 'Wawa ES'),
(465, '170020', 'Labo ES'),
(466, '170021', 'Camalig Mangyan School'),
(467, '170022', 'San Vicente ES'),
(468, '170023', 'Metolza ES (Annex)'),
(469, '170024', 'Tambangan ES'),
(470, '170025', 'Leonardo delos Reyes ES'),
(471, '170027', 'Lapantay Mangyan School'),
(472, '170028', 'Waring ES'),
(473, '170029', 'Sipit Saburan Mangyan School'),
(474, '170030', 'Sido Mangyan School'),
(475, '170031', 'Kisloyan Minority School'),
(476, '170032', 'Lucban PS'),
(477, '170033', 'Sigkuran Mangyan School'),
(478, '170034', 'Abintang ES'),
(479, '170035', 'Bating ES'),
(480, '170036', 'Bailan ES'),
(481, '170037', 'Umabang ES'),
(482, '170038', 'Balditan PS'),
(483, '170039', 'Akliyang ES'),
(484, '170040', 'Bulaklakan ES'),
(485, '300412', 'Don Pedro HS'),
(486, '300448', 'Bongabong Technical and Vocational HS'),
(487, '301610', 'Alcadesma NHS'),
(488, '301611', 'Apitong NHS'),
(489, '301612', 'Macatoc NHS'),
(490, '301613', 'Aurelio Arago MNHS'),
(491, '301614', 'Aurora NHS'),
(492, '301615', 'Evangelista NHS'),
(493, '301616', 'Baco NHS'),
(494, '301617', 'Balugo NHS'),
(495, '301618', 'Bansud NHS - Regional Science HS'),
(496, '301619', 'Bayuin NHS'),
(497, '301620', 'Bulalacao NHS'),
(498, '301621', 'Maujao NHS'),
(499, '301622', 'San Roque NHS'),
(500, '301623', 'Bulbugan NHS'),
(501, '301624', 'Cawayan NHS'),
(502, '301625', 'Dayhagan NHS'),
(503, '301627', 'Domingo Yu Chu NHS'),
(504, '301628', 'Araceli B. Pantilanan - Bacawan HS'),
(505, '301629', 'Matulatula HS'),
(506, '30163', 'Doroteo S. Mendoza Sr. MNHS'),
(507, '301631', 'Fe del Mundo NHS'),
(508, '301632', 'Formon NHS'),
(509, '301633', 'Kaligtasan NHS'),
(510, '301634', 'Leuteboro NHS'),
(511, '301635', 'Fortuna NHS'),
(512, '301636', 'Malamig NHS'),
(513, '301637', 'Manuel Adriano MNHS'),
(514, '301638', 'Manaul NHS'),
(515, '301639', 'Marcelo I. Cabrera Vocational HS'),
(516, '301640', 'Dangay NHS'),
(517, '301641', 'Masaguisi NHS'),
(518, '301642', 'Melgar NHS'),
(519, '301643', 'Morente NHS'),
(520, '301644', 'Nabuslot NHS'),
(521, '301645', 'Naujan Municipal HS'),
(522, '301646', 'Pambisan NHS'),
(523, '301647', 'Pili NHS'),
(524, '301648', 'Porfirio Comia MNHS'),
(525, '301649', 'Quinabigan NHS'),
(526, '301650', 'Ranzo NHS'),
(527, '301651', 'San Agustin NHS'),
(528, '301652', 'San Mariano NHS'),
(529, '301653', 'San Teodoro NHS'),
(530, '301654', 'Vicente B. Ylagan NHS'),
(531, '301655', 'Villapagasa NHS'),
(532, '304912', 'Fortunato Perez HS'),
(533, '305604', 'Elim Lisap Mangyan HS'),
(534, '305628', 'Victoria NHS'),
(535, '305781', 'Bacungan HS'),
(536, '305782', 'Gatol Mangyan HS'),
(537, '305783', 'Tacligan HS'),
(538, '305784', 'Villa Cerveza HS'),
(539, '305799', 'Baras NHS'),
(540, '305820', 'Milagrosa NHS'),
(541, '305822', 'Balatasan NHS'),
(542, '309001', 'Inarawan NHS'),
(543, '309002', 'President Diosdado Macapagal MNHS'),
(544, '309003', 'Masaguing HS'),
(545, '309004', 'Puerto Galera NHS'),
(546, '309005', 'Labasan NHS'),
(547, '309006', 'Carmundo NHS'),
(548, '309007', 'Ecological Public Secondary School'),
(549, '309008', 'Anastacio Dela Chica HS'),
(550, '309009', 'Jose D. Udasco Mangangan I NHS'),
(551, '309010', 'Laguna HS'),
(552, '309011', 'Rufino Asi NHS (Pulantubig NHS)'),
(553, '309012', 'Aurelio Arago MNHS - Alcate Annex'),
(554, '309013', 'Conrazon HS'),
(555, '309015', 'Francisco \"Kiko\" Manlises - Calingag HS'),
(556, '309016', 'Anoling HS'),
(557, '309017', 'Gerardo Fanoga, Sr. - Pambisan Munti HS'),
(558, '309018', 'Sabang HS'),
(559, '309019', 'Pag-asa NHS'),
(560, '309020', 'Apnagan HS'),
(561, '309021', 'San Vicente NHS (San Mariano NHS-San Vicente Annex)'),
(562, '309022', 'Benli NHS'),
(563, '309023', 'Guillermo Raymundo - Calima HS'),
(564, '309024', 'Bonbon HS'),
(565, '309025', 'Leandro Panganiban Sr. - Tagumpay HS'),
(566, '309026', 'Buli HS'),
(567, '309027', 'Felimon M. Salcedo Sr. MNHS'),
(568, '309028', 'Puerto Galera NHS - Dulangan Extension'),
(569, '309029', 'Puerto Galera NHS - Palangan Extension'),
(570, '309030', 'Batangan Buhid HS'),
(571, '309032', 'San Roque NHS - Bangkal Extension'),
(572, '309033', 'Cabugao NHS'),
(573, '309034', 'Maasin HS'),
(574, '309035', 'Puerto Galera NHS - San Isidro Extension'),
(575, '309036', 'Lumangbayan NHS'),
(576, '309037', 'Bethel HS'),
(577, '309038', 'Dr. Aristeo Baldos Sr. Papandayan HS'),
(578, '309161', 'Malo HS'),
(579, '309162', 'Cacawan HS'),
(580, '500637', 'Facundo C. Lopez - Palangan Integrated School');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` int NOT NULL,
  `time_slot` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `time_slot`) VALUES
(1, '08:00 AM'),
(2, '08:30 AM'),
(3, '09:00 AM'),
(4, '09:30 AM'),
(5, '10:00 AM'),
(6, '10:30 AM'),
(7, '11:00 AM'),
(8, '11:30 AM'),
(9, '12:00 PM'),
(10, '12:30 PM'),
(11, '01:00 PM'),
(12, '01:30 PM'),
(13, '02:00 PM'),
(14, '02:30 PM'),
(15, '03:00 PM'),
(16, '03:30 PM'),
(17, '04:00 PM'),
(20, '04:30 PM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender_id` int DEFAULT NULL,
  `vul_sec_id` int DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  `user_type` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `profile_status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `last_name`, `first_name`, `middle_name`, `email`, `password`, `contact_no`, `gender_id`, `vul_sec_id`, `token`, `is_verified`, `user_type`, `profile_status`) VALUES
(1, NULL, NULL, NULL, 'depedorminoas@deped.gov.ph', '$2y$04$TM5d4j3LxM9bshUpNNZ.0OYW8B8nZPYLyGT8tnWHW8SLMazN9nrLS', NULL, NULL, NULL, '9z0By5wDl8v7d6jcpqXWskPhn', 1, 'admin', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `usov`
--

CREATE TABLE `usov` (
  `usov_id` int NOT NULL,
  `usov` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usov`
--

INSERT INTO `usov` (`usov_id`, `usov`) VALUES
(1, 'SDS Office'),
(2, 'ASDS Office'),
(3, 'Administrative Office'),
(4, 'Accounting Section'),
(5, 'Budget Section'),
(6, 'Cash Section'),
(7, 'Legal Unit'),
(8, 'Human Resource Section'),
(9, 'Property and Supply Section'),
(10, 'Records Section'),
(11, 'CES-CID Office'),
(12, 'ALS Section'),
(13, 'District Instructional Supervision Section'),
(14, 'Instructional Management Section'),
(15, 'CES-SGOD Office'),
(16, 'DRRM Section'),
(17, 'EPS-SGOD Office'),
(18, 'Education Facilities Section'),
(19, 'HR Development Section'),
(20, 'Planning and Research Section'),
(21, 'SHN Section'),
(22, 'SMME Section'),
(23, 'SMNet Section'),
(24, 'Youth Formation Section'),
(25, 'COA');

-- --------------------------------------------------------

--
-- Table structure for table `vulnerable_sector`
--

CREATE TABLE `vulnerable_sector` (
  `vul_sec_id` int NOT NULL,
  `vulnerable_sector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vulnerable_sector`
--

INSERT INTO `vulnerable_sector` (`vul_sec_id`, `vulnerable_sector`) VALUES
(1, 'Senior Citizen'),
(2, 'Pregnant Women'),
(3, 'PWD'),
(4, 'Others'),
(5, 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_details`
--
ALTER TABLE `appointment_details`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`,`position_id`,`school_in_id`,`level_id`,`district_id`,`func_div_id`,`usov_id`,`time_slot_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `functional_division`
--
ALTER TABLE `functional_division`
  ADD PRIMARY KEY (`func_div_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `school_id_name`
--
ALTER TABLE `school_id_name`
  ADD PRIMARY KEY (`school_in_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gender_id` (`gender_id`,`vul_sec_id`);

--
-- Indexes for table `usov`
--
ALTER TABLE `usov`
  ADD PRIMARY KEY (`usov_id`);

--
-- Indexes for table `vulnerable_sector`
--
ALTER TABLE `vulnerable_sector`
  ADD PRIMARY KEY (`vul_sec_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_details`
--
ALTER TABLE `appointment_details`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `functional_division`
--
ALTER TABLE `functional_division`
  MODIFY `func_div_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `school_id_name`
--
ALTER TABLE `school_id_name`
  MODIFY `school_in_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `time_slot_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usov`
--
ALTER TABLE `usov`
  MODIFY `usov_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vulnerable_sector`
--
ALTER TABLE `vulnerable_sector`
  MODIFY `vul_sec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
