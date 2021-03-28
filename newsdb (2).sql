-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2021 at 04:40 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int(20) NOT NULL AUTO_INCREMENT,
  `img_path` varchar(50) NOT NULL,
  UNIQUE KEY `img_id` (`img_id`),
  UNIQUE KEY `img_path` (`img_path`),
  KEY `img_id_2` (`img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `img_path`) VALUES
(1, '../uploads/5cbbcbfcc6939.png'),
(2, '../uploads/5cbbc86b64383.png'),
(3, '../uploads/5ce068b5c0ab8.jpg'),
(4, '../uploads/5ce0bd14e869f.jpg'),
(5, '../uploads/5ce067429aeba.jpg'),
(6, '../uploads/5cbbc9090da36.jpg'),
(7, '../uploads/5cbbc947dc5ab.png'),
(8, '../uploads/5cbbc94c3e7bf.png'),
(9, '../uploads/5cbbc971aa7c8.jpg'),
(10, '../uploads/5cbbc97a3d65b.jpg'),
(11, '../uploads/5cbbc97eef64a.jpg'),
(12, '../uploads/5cbbc9b0926c7.jpg'),
(13, '../uploads/5cbbc9b46b14a.jpg'),
(14, '../uploads/5cbbcbeb18632.png'),
(15, '../uploads/5cbbcbf46847f.png'),
(16, '../uploads/5cbbc82741eb5.jpg'),
(17, '../uploads/5cbbc854a57d0.png'),
(18, '../uploads/5cbbc71f31a90.jpg'),
(19, '../uploads/5cba759ecc6de.jpg'),
(20, '../uploads/5cbbc7442f415.jpg'),
(21, '../uploads/5cba75a7b773c.jpg'),
(22, '../uploads/5cba75ad37fca.jpg'),
(23, '../uploads/5cba75b718e90.jpg'),
(24, '../uploads/5cbbc7553fd7f.jpg'),
(25, '../uploads/5cbbc7c0eb1db.jpg'),
(114, '../uploads/5cbbc7fcf05db.jpg'),
(115, '../uploads/5cbbc80ebd373.jpg'),
(116, '../uploads/5cbbc81a766d5.jpg'),
(110, '../uploads/5cbbc72f22dd5.jpg'),
(94, '../uploads/5cbbc5cb229ae.jpg'),
(95, '../uploads/5cbbc5ceea676.jpg'),
(96, '../uploads/5cbbc5d9cdc14.jpg'),
(97, '../uploads/5cbbc5dd8e10b.jpg'),
(98, '../uploads/5cbbc5e30a8a6.jpg'),
(99, '../uploads/5cbbc5efafa57.jpg'),
(100, '../uploads/5cbbc5f7e438f.jpg'),
(101, '../uploads/5cbbc61a52b6e.png'),
(102, '../uploads/5cbbc61fca1fe.png'),
(103, '../uploads/5cbbc630e2d86.png'),
(104, '../uploads/5cbbc63b6cf84.jpg'),
(105, '../uploads/5cbbc66cb3f1c.jpg'),
(106, '../uploads/5cbbc6a3b728f.jpg'),
(107, '../uploads/5cbbc6ceb1e19.jpg'),
(108, '../uploads/5cbbc6e24c8fd.jpg'),
(135, '../uploads/5cbbcc0602e3c.png'),
(136, '../uploads/5cbbcc0fbe134.png'),
(137, '../uploads/5cbbcc2c778a6.jpg'),
(138, '../uploads/5cbbcc32f2862.jpg'),
(139, '../uploads/5cbbcc3f0712b.jpg'),
(140, '../uploads/5cbbcc5a14d90.jpg'),
(141, '../uploads/5cbbcc8c1cdf7.jpg'),
(142, '../uploads/5cbbcc90b884a.jpg'),
(143, '../uploads/5cbbcc945b379.jpg'),
(144, '../uploads/5cbbcc98f1533.jpg'),
(145, '../uploads/5cbbcc9d76df4.jpg'),
(146, '../uploads/5cbbcca62f642.jpg'),
(148, '../uploads/5cbbccad2004c.jpg'),
(185, '../uploads/5cd2c774a7733.jpg'),
(150, '../uploads/5cbbccb54fc1a.jpg'),
(151, '../uploads/5cbbcccea5401.jpg'),
(154, '../uploads/5cbbcd566d9aa.png'),
(183, '../uploads/5cd2c48c2deb1.jpg'),
(186, '../uploads/5ce0ae2240962.jpg'),
(187, '../uploads/5ce0c004843b7.jpg'),
(188, '../uploads/5ce0cd41c712c.jpg'),
(189, 'uploads/5ce0ce3e80442.jpg'),
(190, 'uploads/5ce0d7fc410c2.jpg'),
(191, '../uploads/5ce0d902d573e.jpg'),
(192, 'uploads/5ce0d96ac9cba.jpg'),
(193, 'uploads5ce0d9ba6882b.jpg'),
(194, 'uploads/../5ce0dac194282.jpg'),
(195, '../uploads/5ce207987fec6.jpg'),
(196, '../uploads/5ce0dc88442ce.jpg'),
(197, '../uploads/5ce0dca2f1f45.jpg'),
(198, '../uploads/5ce207a98bf86.png'),
(199, '../uploads/5ce0dd4376cca.jpg'),
(200, '../uploads/5ce0dd4e142d0.jpg'),
(201, '../uploads/5ce0dd6561e53.jpg'),
(202, '../uploads/5cff5c4c76e1c.jpg'),
(203, '../uploads/5ce4bb195c1d1.png'),
(204, '../uploads/5ce208f42bfc8.jpg'),
(205, '../uploads/5ce30a9949b04.jpg'),
(206, '../uploads/5ce30abfb22f3.jpg'),
(207, '../uploads/5ce4bd166001f.jpg'),
(208, '../uploads/5ce4bd5631fbc.jpg'),
(209, '../uploads/5ce4d3cf31ea4.jpg'),
(210, '../uploads/5ce4d3f4388e6.jpg'),
(211, '../uploads/5d0002fad753b.jpg'),
(212, '../uploads/5cf5b493b6d8f.jpg'),
(213, '../uploads/5cf5b03e75e2e.jpg'),
(214, '../.uploads/5cf5b0526f640.jpg'),
(215, '../uploads/5cf5b0ff1a4b5.jpg'),
(216, '../uploads/5cf5b12af073d.jpg'),
(217, '../uploads/5cf5b17d0e936.jpg'),
(218, '../uploads/5cf5b2140db58.png'),
(219, '../uploads/5cf5b2647b133.jpg'),
(220, '../uploads/5cf5b29ba302a.jpg'),
(221, '../uploads/5cff5c32d85aa.png'),
(222, '../uploads/5cf5b32e33eed.jpg'),
(223, '../uploads/5cf5b35e64257.jpg'),
(224, '../uploads/5cf5b37942210.jpg'),
(225, '../uploads/5cf5b399d3146.jpg'),
(226, '../uploads/5cf5b3b1cb93e.jpg'),
(227, '../uploads/5db07e48a9528.jpg'),
(228, '../uploads/5db07e9d06c39.jpg'),
(229, '../uploads/5dc6c14400f09.png'),
(230, '../uploads/5dc6c19139bf4.png'),
(231, '../uploads/5dcee2d7988d5.jpg'),
(232, '../uploads/5dcee678c2db4.jpg'),
(233, '../uploads/5e20701e0088c.jpg'),
(234, '../uploads/5e4d7b91bfeac.jpg'),
(235, '../uploads/5e8603761f79e.png'),
(236, '../uploads/5e86039e8acfd.png'),
(237, '../uploads/5e8603b9d9cbc.png'),
(238, '../uploads/5e8603ee9925e.png'),
(239, '../uploads/5e86041082908.png'),
(240, '../uploads/5e860415b92af.png'),
(241, '../uploads/5e86041793bb5.png'),
(242, '../uploads/5e86045bddee2.png'),
(243, '../uploads/5e86045d096b2.png'),
(244, '../uploads/5e86045e2383e.png'),
(245, '../uploads/5e86045f32929.png'),
(246, '../uploads/5e860910a6959.png'),
(247, '../uploads/5e860926a9ea5.png'),
(248, '../uploads/5e86093bad293.png'),
(249, '../uploads/5e860964735cd.png'),
(250, '../uploads/5e8609b17a114.png'),
(251, '../uploads/5e860c01407fe.png'),
(252, '../uploads/5e860cc9b84d9.png'),
(253, '../uploads/5e860ccbd35c6.png'),
(254, '../uploads/5e860ccee0837.png'),
(255, '../uploads/5e860cd1ce2e5.png'),
(256, '../uploads/5e860cf5aef3d.png'),
(257, '../uploads/5f008d05570fa.png');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `news_headline` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `news_report` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `img_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type_day` varchar(50) NOT NULL,
  `type_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`news_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `post_id`, `news_headline`, `news_report`, `img_id`, `user_id`, `type_day`, `type_date`) VALUES
(1, 1, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. ', 'this is news article report 		    		    		    		    		    		    		    		    		    		    		    		    		    		    ', 1, 1, '', '14-10-2018 08:45:03'),
(25, 4, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. ', 'nleknkejllllllllllll		        		    ', 197, 1, '', '14-10-2018 08:45:03'),
(26, 3, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. ', '		  vkqBHL.KHNQQQQQQQQQQQQ      		    		    ', 198, 1, '', '14-10-2018 08:45:03'),
(37, 4, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   	', '		        		    		    ', 210, 2, '', '14-10-2018 08:45:03'),
(28, 3, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. 		   	', 'QQQQQQQQQQQQQQQQQQQDFIL		        		    		    		    ', 200, 1, '', '14-10-2018 08:45:03'),
(57, 2, '		         welcom		   			   			   	', 'hdjdo9edjudj		    		    		    ', NULL, 1, '', '14-10-2018 08:45:03'),
(13, 3, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. ', '		        fd2222qwhnojopw2h1ihihheish21ihishih2wdi2ids\r\ndgu222222222222222222222\r\ndo2u1111111111111dgbui\r\n		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    ', NULL, 1, '', '14-10-2018 08:45:03'),
(39, 1, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   		\r\n', '		        		    		    		    		    		    ', NULL, 2, '', '14-10-2018 08:45:03'),
(24, 4, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. ', 'kwwwwwwwwwww		        		    		    ', 195, 1, '', '14-10-2018 08:45:03'),
(31, 2, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   	', 'kl;wf		        		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    		    ', 203, 2, '', '14-10-2018 08:45:03'),
(36, 2, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   	', '		        		    		    ', 209, 2, '', '14-10-2018 08:45:03'),
(38, 2, 'Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   			   	', '		        		    		    		    		    rfibhihohfnolhndoc		    ', 211, 2, '', '14-10-2018 08:45:03'),
(34, 2, '		      Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.    		   	', '		        		    ', 207, 1, '', '14-10-2018 08:45:03'),
(35, 3, '		         Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum. ', '		        ', 208, 1, '', '14-10-2018 08:45:03'),
(56, 1, 'jnn;;;;;;;;;;;;;;;		         ', 'hnbswebdsbcf		        ', NULL, 113, '', '14-10-2018 08:45:03'),
(41, 1, 'hinbiknknkn		         		   			   			   			   	', 'nknlnmlmnl		        		    		    		    		    ', 212, 113, '', '14-10-2018 08:45:03'),
(42, 1, 'veugbik		         		   			   	', 'hniknh		        		    		    ', 213, 113, '', '14-10-2018 08:45:03'),
(50, 2, '		         DDD		   	', 'dffffggf		        		    ', 221, 113, '', '14-10-2018 08:45:03'),
(55, 2, 'hnihniknik		         		   	', 'nknkinolk		        		    ', 226, 113, '', '14-10-2018 \r\n 08:45:03'),
(58, 1, ' hello i am in kalilinux now', '   ', 228, 1, 'Wednesday', '19-10-23  04:10'),
(59, 6, ' تتتتت', '   ', 230, 114, 'Saturday', '19-11-09 01:11'),
(60, 6, ' رللتنن', '   ', NULL, 114, 'Saturday', '19-11-09 02:11'),
(61, 6, 'hi', '   ', NULL, 1, 'Saturday', '19-11-09 02:11'),
(62, 6, ' أهلا يا عبد الرحمن', '   مرحبامرحبا', 231, 1, 'Friday', '19-11-15 05:11'),
(63, 6, ' الببياتا		   	', '   		    ', 232, 116, 'Friday', '19-11-15 05:11'),
(64, 6, ' hello', ' لبياتاررلالبسلا		    ', 233, 117, 'Thursday', '20-01-16 02:01'),
(65, 6, ' yhoyoylk', '   ', 234, 1, 'Wednesday', '20-02-19 06:02'),
(66, 6, ' hoihooi', '   hihohoho', 235, 1, 'Thursday', '20-04-02 03:04'),
(67, 6, ' hoihooi', '   hihohoho', 236, 1, 'Thursday', '20-04-02 03:04'),
(68, 6, ' sohnsol', '   hsihbohs', 237, 1, 'Thursday', '20-04-02 03:04'),
(69, 6, ' sohnsol', '   hsihbohs', 238, 1, 'Thursday', '20-04-02 03:04'),
(70, 6, ' sohnsol', '   hsihbohs', 239, 1, 'Thursday', '20-04-02 03:04'),
(71, 6, ' sohnsol', '   hsihbohs', 240, 1, 'Thursday', '20-04-02 03:04'),
(72, 6, ' sohnsol', '   hsihbohs', 241, 1, 'Thursday', '20-04-02 03:04'),
(73, 6, ' sohnsol', '   hsihbohs', 242, 1, 'Thursday', '20-04-02 03:04'),
(74, 6, ' sohnsol', '   hsihbohs', 243, 1, 'Thursday', '20-04-02 03:04'),
(75, 6, ' sohnsol', '   hsihbohs', 244, 1, 'Thursday', '20-04-02 03:04'),
(76, 6, ' sohnsol', '   hsihbohs', 245, 1, 'Thursday', '20-04-02 03:04'),
(77, 6, ' sohnsol', '   hsihbohs', 246, 1, 'Thursday', '20-04-02 03:04'),
(78, 6, ' sohnsol', '   hsihbohs', 247, 1, 'Thursday', '20-04-02 03:04'),
(79, 6, ' sohnsol', '   hsihbohs', 248, 1, 'Thursday', '20-04-02 03:04'),
(80, 6, ' sohnsol', '   hsihbohs', 249, 1, 'Thursday', '20-04-02 03:04'),
(81, 6, ' ddddddddddd', '   ', 250, 1, 'Thursday', '20-04-02 03:04'),
(82, 6, ' aaaaaaaaaa', '   ', 251, 1, 'Thursday', '20-04-02 04:04'),
(83, 6, ' aaaaaaaaaa', '   ', 252, 1, 'Thursday', '20-04-02 04:04'),
(84, 6, ' aaaaaaaaaa', '   ', 253, 1, 'Thursday', '20-04-02 04:04'),
(85, 6, ' aaaaaaaaaa', '   ', 254, 1, 'Thursday', '20-04-02 04:04'),
(86, 6, 'حسام اليعري اليعري	   	', '   		    		    ', 255, 1, 'Thursday', '20-04-02 04:04'),
(87, 6, 'لا اله الا الله	allauh good', '   		    		    		    ', 256, 1, 'Thursday', '20-04-02 04:04'),
(88, 1, ' سبحان الله', '   ', 257, 1, 'Saturday', '20-07-04 02:07');

-- --------------------------------------------------------

--
-- Table structure for table `postes`
--

DROP TABLE IF EXISTS `postes`;
CREATE TABLE IF NOT EXISTS `postes` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(50) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postes`
--

INSERT INTO `postes` (`post_id`, `post_name`) VALUES
(1, 'local'),
(2, 'sport'),
(3, 'education'),
(4, 'economic'),
(6, 'social');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` text NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `photo` text,
  `gender` varchar(6) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `count_subscribers` int(11) NOT NULL DEFAULT '0',
  `phonenumber` varchar(20) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `id_2` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `surname`, `email`, `photo`, `gender`, `status`, `count_subscribers`, `phonenumber`) VALUES
(97, 'ayoub homadi', '6512bd43d9caa6e02c990b0a82652dca', 'alyaari', 'hossam@GMAIL.COM', '', 'male', 0, 0, ''),
(95, 'ayoub', 'c4ca4238a0b923820dcc509a6f75849b', 'homady', 'ayub@GMAIL.COM', 'user/photo/5ce0d68489524.jpg', 'male', 0, 0, ''),
(98, 'dguu', '6512bd43d9caa6e02c990b0a82652dca', 'dgik', 'hossam.9.bh@gmail.com', 'user/photo/5ce30a706f059.jpg', 'male', 0, 0, ''),
(2, 'mohmed', '6c14da109e294d1e8155be8aa4b1ce8e', 'ali', 'mohmad@gmail.com', '', 'male', 0, 98, ''),
(92, 'ali', 'df5990d13480fba4d93fb9b369d90bc5', 'saleh', 'hossam@GMAIL.COM', '', 'male', 0, 0, ''),
(1, 'hossam ali', '46fef5f7199a7c0831206b65c602bf3b', 'alyaari', 'hossam.9.bh@gmail.com', 'user/photo/5dcee62623c3f.jpg', 'male', 1, 100, ''),
(99, 'hshjs', 'b59c67bf196a4758191e42f76670ceba', 'sihisk', 'HJJHK@GMAIL.COM', '', 'male', 0, 0, ''),
(100, 'dhjjd', '6a966714f9aa241d7d6262b6782e5190', 'dbksljsj', 'HJJHK@GMAIL.COM', '', 'male', 0, 0, ''),
(101, 'sjbgikas', '267d84e374cc26102ed25b3c8244f6b8', 'kbskznknsk', 'HJJHK@GMAIL.COM', '', 'male', 0, 0, ''),
(102, 'jqhkha', '267d84e374cc26102ed25b3c8244f6b8', 'bwdbk', 'HJJHK@GMAIL.COM', '', 'male', 0, 0, ''),
(103, 'HOSSAMali', '63a19cfe4a72c49cfaef1ee16881f5f1', 'ALYAARI', 'hossam.9.bh@gmail.com', '', 'male', 0, 0, ''),
(104, 'saleh', '81dc9bdb52d04dc20036dbd8313ed055', 'HOSSAM', 'mohmad@gmail.com', '', 'male', 0, 0, ''),
(105, 'slima', '4de4eddcde09f8d4faed279022dd376a', 'SALEH', 'hossam.bh@gmail.com', '', 'male', 0, 0, ''),
(106, 'ggfifui', '63a19cfe4a72c49cfaef1ee16881f5f1', 'blblhbli', 'hossam@gmail.com', '', 'male', 0, 0, ''),
(107, 'hhhhh', '63a19cfe4a72c49cfaef1ee16881f5f1', 'hhhhh', 'saleha@gmail.com', '', 'male', 0, 0, ''),
(108, 'ALIt', '59f3b1c4af36c5866866a5e95c2034a1', 'ALYAARI', 'hossam.8.bh@gmail.com', '', 'male', 0, 0, ''),
(109, 'ahh', '282e1bdeaea65ee1ab075d9b23ba60b8', 'ffagh', 'hos.bh@gmail.com', '', 'male', 0, 0, ''),
(110, 'جير', '25f9e794323b453885f5181f1b624d0b', 'saleh', 'hos.bh@gmail.com', '', 'male', 0, 0, ''),
(114, 'Ø§Ø­Ù…Ø¯ Ø¹Ù„ÙŠ Ø§Ù„ÙŠØ¹Ø±ÙŠ', 'b59c67bf196a4758191e42f76670ceba', 'Ø§Ù„ÙŠØ¹Ø±ÙŠ', '', NULL, 'male', 0, 99, '772982855'),
(115, 'Ø¹Ø¨Ø¯Ø§Ù„Ø±Ø­Ù…Ù†', '3e91eb4a36873a081cf034889749a320', 'Ø§Ù„ÙŠØ¹Ø±ÙŠ', '', NULL, 'male', 0, 0, '776175701'),
(116, 'Ø¹Ø¨Ø¯Ù‡', '47bce5c74f589f4867dbd57e9ca9f808', 'Ø§Ù„ÙŠØ¹Ø±ÙŠ', '', 'user/photo/5dcee643f28c1.jpg', 'male', 0, 0, '776175701'),
(118, 'Ø´Ø§ÙƒØ±', 'b59c67bf196a4758191e42f76670ceba', 'Ø§Ù„ÙŠØ¹Ø±ÙŠ', '', NULL, 'male', 0, 0, '7739002'),
(119, 'Ø³Ø§Ù…Ø­ ', 'b59c67bf196a4758191e42f76670ceba', 'Ø§Ù„ÙŠØ¹Ø±ÙŠ', '', NULL, 'male', 0, 0, '223222'),
(120, 'ØµÙ‚Ø±Ø±', 'b59c67bf196a4758191e42f76670ceba', 'Ø§Ù„ÙŠØ¹Ø±ÙŠ', '', NULL, 'male', 0, 0, '880890'),
(121, 'hamid', 'b59c67bf196a4758191e42f76670ceba', 'yaaari', '', NULL, 'male', 0, 0, '7739002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user` ADD FULLTEXT KEY `password` (`password`);
ALTER TABLE `user` ADD FULLTEXT KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
