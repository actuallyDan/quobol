-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2016 at 01:13 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quobolTest`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `blog_date` date DEFAULT NULL,
  `blog_content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `channel_id` int(11) NOT NULL,
  `channel_name` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channelUsers`
--

CREATE TABLE IF NOT EXISTS `channelUsers` (
  `channel_id` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(8) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `channel_messages`
--

CREATE TABLE IF NOT EXISTS `channel_messages` (
  `message_id` int(11) NOT NULL,
  `message` text,
  `channel_id` int(11) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quirk` smallint(6) DEFAULT NULL,
  `user_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `time_stamp`, `quirk`, `user_id`) VALUES
(14, '2016-02-23 01:29:55', 0, '13e50325'),
(15, '2016-02-23 01:40:42', 0, '13e50325'),
(20, '2016-02-23 02:17:17', 0, '13e50325'),
(23, '2016-02-23 02:21:26', 0, '13e50325'),
(25, '2016-02-23 02:23:00', 0, '13e50325'),
(26, '2016-02-23 02:23:29', 0, '13e50325'),
(27, '2016-02-23 18:41:55', 2, '13e50325'),
(28, '2016-02-23 02:34:33', 0, '13e50325'),
(29, '2016-02-23 18:41:58', 4, '13e50325'),
(30, '2016-02-23 02:39:08', 0, '13e50325'),
(31, '2016-02-23 02:41:26', 0, '13e50325'),
(32, '2016-02-23 02:42:07', 0, '13e50325'),
(33, '2016-02-23 02:42:32', 0, '13e50325'),
(34, '2016-02-23 02:42:42', 0, '13e50325'),
(35, '2016-02-23 02:48:36', 0, '13e50325'),
(36, '2016-02-23 03:38:08', 0, '13e50325'),
(37, '2016-02-24 03:12:53', 0, '8193eb48'),
(39, '2016-02-25 00:28:06', 0, '8193eb48'),
(40, '2016-02-25 19:36:58', 0, '13e50325'),
(41, '2016-02-25 22:20:25', 0, '3a3d864e');

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

CREATE TABLE IF NOT EXISTS `event_info` (
  `title` varchar(75) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `e_date` varchar(10) DEFAULT NULL,
  `e_time` varchar(11) DEFAULT NULL,
  `image_url` text,
  `event_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_info`
--

INSERT INTO `event_info` (`title`, `description`, `latitude`, `longitude`, `e_date`, `e_time`, `image_url`, `event_id`) VALUES
('ksdflkvmsdflvkmsdlfkvsdflkvsdflvkdsflvkdsflvksd fvlsdkfmvldskfv dsflkvdsfkl', ' dsfv dsfv sdfv sdfv sdfv dsfv dsfv dsf bsd fb', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 15),
('SHITPOAST', 'kjdsfkjvnkjn', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 20),
('please dont give eme redirect porbs yo', 'no u', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 23),
('Please work nao', 'kjnsdfv', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 25),
('Please work nao', 'kjnsdfv', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 26),
('perls', 'sdfv', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 27),
('perl hypertext processor', 'kjnsdfkjnsdfkjvn', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 28),
('PEH ACHE PEH', 'is awful', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 29),
('PEH ACHE PEH', 'is awful', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 30),
('DONT EVER LOOK BACK', 'kjnsdfkjvsdf', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 32),
('ON THE WINDS CLOSING IN', 'sdfv', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 33),
('THE ONLY ATTACK', '', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 34),
('FOR THE <something> ON THE <something>', 'kjnsdkfjnvsdkfjnv', '39.99772840', '-76.35629940', '0000-00-00', '7 PM', 'img/stock7.jpeg', 35),
('The Plains in Spain', 'Yo', '40.41677540', '-3.70379020', '20 Februar', '7 PM', 'img/stock7.jpeg', 36),
('Event In Red Lion', 'This should be invisible in Millersville because of math and reasons', '39.87416400', '-76.59531500', '27 Februar', '7 PM', 'img/stock7.jpeg', 37),
('This is the most recent quip', 'why is it at the bottom?', '39.99769210', '-76.35630110', '27 Februar', '7 PM', 'img/stock7.jpeg', 39),
('I can''t do any work until Brian fixes his fucking databses', 'So mad \r\n\r\nwow                                     Many frsutrates\r\n\r\nVery upset', '39.99769210', '-76.35630110', '27 Februar', 'Any Time ', 'img/stock7.jpeg', 40),
('Brians event', 'kjndfkvjndfkvjn', '40.01753710', '-76.31913750', '27 Februar', '7 PM', 'img/stock7.jpeg', 41);

-- --------------------------------------------------------

--
-- Table structure for table `event_messages`
--

CREATE TABLE IF NOT EXISTS `event_messages` (
  `message_id` int(11) NOT NULL,
  `message` text,
  `event_id` int(11) DEFAULT NULL,
  `user_id` varchar(8) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_messages`
--

INSERT INTO `event_messages` (`message_id`, `message`, `event_id`, `user_id`, `time_stamp`) VALUES
(16, 'jnkjndfvkj', 41, '3a3d864e', '2016-02-26 00:01:33'),
(17, 'dfvdfjnv', 41, '3a3d864e', '2016-02-26 00:01:41'),
(18, 'kjnjkndfkjnvs', 41, '3a3d864e', '2016-02-26 01:08:39'),
(19, 'Message', 41, '3a3d864e', '2016-02-26 01:08:42'),
(20, 'here a thing', 41, '3a3d864e', '2016-02-26 01:08:45'),
(21, 'from me', 41, '3a3d864e', '2016-02-26 01:08:47'),
(22, 'this is from Dan', 41, '13e50325', '2016-02-26 01:09:31'),
(23, 'oiueroiuwer', 41, '13e50325', '2016-02-26 01:09:38'),
(24, 'cat', 41, '13e50325', '2016-02-26 01:19:38'),
(25, 'jkbdfjhbdfjhvdfv', 41, '13e50325', '2016-02-26 03:03:50'),
(26, 'kjdnfkjndfv', 41, '13e50325', '2016-02-26 03:08:17'),
(27, 'kjdnfvkjdnfvkjdnfkvjndfjfkjvdfkjvndfkjvnsdfkv', 41, '13e50325', '2016-02-26 03:40:02'),
(28, 'kjdfkjdfvkjn', 41, '13e50325', '2016-02-26 03:56:25'),
(29, 'kjndfkjndfvjkn', 41, '13e50325', '2016-02-26 03:56:54'),
(30, 'new message', 41, '13e50325', '2016-02-26 03:57:42'),
(31, 'this is also a new message', 41, '13e50325', '2016-02-26 03:59:07'),
(32, 'I am new here!', 41, 'ca66f226', '2016-02-26 04:00:18'),
(33, 'jhbjhbjhb', 41, 'ca66f226', '2016-02-26 04:16:51'),
(34, 'neato bandito', 40, 'ca66f226', '2016-02-26 04:19:08'),
(35, 'I am commenting on this', 40, '13e50325', '2016-02-26 04:53:37'),
(36, 'I am jhdbfvjhdbfv', 40, '13e50325', '2016-02-26 04:53:54'),
(37, 'jhbdfjhvbdfv', 40, '13e50325', '2016-02-26 04:54:13'),
(38, 'jkbdfjvhb', 40, '13e50325', '2016-02-26 04:54:14'),
(39, 'kjdfkjvnd', 40, '13e50325', '2016-02-26 04:54:36'),
(40, 'jndkjnkjndfkjndfkjvndfjkvndfkjvndfkvjndfkvjndfkvjndfkvjndfkvjndfv dfvdf vdfv dfv dfv dfvd fvdfvdf vdfvd fvdfvd fvdfvd fvdfv dfvdfv dfvdf vdfvd fvdfv f', 40, '13e50325', '2016-02-26 05:05:51'),
(41, 'ye', 41, '13e50325', '2016-02-26 05:08:43'),
(42, 'kjdfkjdfvkn', 41, '13e50325', '2016-02-26 05:31:06'),
(43, 'dfdfvd', 41, '13e50325', '2016-02-26 05:31:10'),
(44, 'mdmvm', 41, '13e50325', '2016-02-26 05:31:19'),
(45, 'kjdnfkjdnfv', 41, '13e50325', '2016-02-26 05:31:54'),
(46, 'dfvdf', 41, '13e50325', '2016-02-26 05:31:59'),
(47, 'moar', 41, '13e50325', '2016-02-26 05:32:22'),
(48, 'kjdnfvkjn', 41, '13e50325', '2016-02-26 05:33:33'),
(49, 'kjdnfkjdnfvkjdnfvkjdnfvkjdnfvkjdnfvkdjnfvdjfvkj', 41, '13e50325', '2016-02-26 05:34:45'),
(50, 'kjnsdkjnsdcjknsdc', 41, '13e50325', '2016-02-26 05:39:48'),
(51, 'kjnsdckjnsdckjsdckjsdc', 41, '13e50325', '2016-02-26 05:41:08'),
(52, 'kjsndc', 41, '13e50325', '2016-02-26 05:42:52'),
(53, 'for real though', 41, '13e50325', '2016-02-26 05:43:40'),
(54, 'njkndfkjndfv', 41, '13e50325', '2016-02-26 05:45:50'),
(55, 'kjndfkvj', 41, '13e50325', '2016-02-26 05:46:14'),
(56, 'kjdfkjv', 41, '13e50325', '2016-02-26 05:47:00'),
(57, 'why', 41, '13e50325', '2016-02-26 05:47:06'),
(58, 'kjdnfvkjdnfvkj', 34, '13e50325', '2016-02-26 05:51:27'),
(59, 'jkndfkjvndfkjv', 34, '13e50325', '2016-02-26 05:51:29'),
(60, 'kjdnfkjdfvjndfkvjndfvjn', 34, '13e50325', '2016-02-26 05:52:24'),
(61, 'kjndfkjdnfvkjd', 34, '13e50325', '2016-02-26 05:52:54'),
(62, 'jkdfjndfjkvn', 34, '13e50325', '2016-02-26 05:53:14'),
(63, 'ugh', 34, '13e50325', '2016-02-26 05:53:20'),
(64, 'pleasework', 34, '13e50325', '2016-02-26 05:54:35'),
(65, 'jnkjn', 34, '13e50325', '2016-02-26 05:55:03'),
(66, 'kjndfjdfvkj', 34, '13e50325', '2016-02-26 05:55:12'),
(67, 'My eyes are starting to hurt', 34, '13e50325', '2016-02-26 05:56:02'),
(68, 'So tired', 34, '13e50325', '2016-02-26 05:56:06'),
(69, 'btich stop', 34, '13e50325', '2016-02-26 05:56:14'),
(70, 'wurk', 34, '13e50325', '2016-02-26 06:09:09'),
(71, 'kjndfkjvdfv', 34, '13e50325', '2016-02-26 06:10:02'),
(72, 'Event?', 37, '13e50325', '2016-02-28 05:45:14'),
(73, 'Event.', 37, '13e50325', '2016-02-28 05:45:18'),
(74, 'Comment Comment Banana for scale Comment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scaleComment Comment Banana for scale', 34, '13e50325', '2016-02-28 05:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `sub_user`
--

CREATE TABLE IF NOT EXISTS `sub_user` (
  `follower_id` varchar(8) NOT NULL DEFAULT '',
  `following_id` varchar(8) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_user_events`
--

CREATE TABLE IF NOT EXISTS `sub_user_events` (
  `user_id` varchar(8) NOT NULL DEFAULT '',
  `event_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_user_events`
--

INSERT INTO `sub_user_events` (`user_id`, `event_id`) VALUES
('8193eb48', 20),
('ca66f226', 20),
('13e50325', 25),
('8193eb48', 25),
('13e50325', 32),
('8193eb48', 32),
('13e50325', 34),
('ca66f226', 35),
('13e50325', 37),
('13e50325', 39),
('8193eb48', 39),
('ca66f226', 39),
('13e50325', 40),
('3a3d864e', 40),
('ca66f226', 40),
('13e50325', 41),
('3a3d864e', 41),
('8193eb48', 41),
('ca66f226', 41);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(8) NOT NULL DEFAULT '',
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `profile_pic` text,
  `cover_photo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `profile_pic`, `cover_photo`) VALUES
('13e50325', 'ActuallyDan', '$2y$10$.wk6/jj1CSuAnNn1Z5lLu.g2s8hwt3QtF.QQ3cymI3ntqCPryXAJq', 'dan_kral@yahoo.com', 'img/stock1.jpeg', 'img/stock7.jpeg'),
('3a3d864e', 'ActuallyKyle', '$2y$10$bJ.7fAwfIzAOp4bdHmqvSeTTQEb4haXmAKEstejZXsKQGwntG7.cC', 'kyle@name.com', 'img/stock1.jpeg', 'img/stock7.jpeg'),
('8193eb48', 'DanTheMan', '$2y$10$AJtmgJX2mHBob2JnahnEguyHZGl03A.XU2m4ZWJzViz2hT8wdyrrq', 'dan99@mail.com', 'img/stock1.jpeg', 'img/stock7.jpeg'),
('ca66f226', 'CaseyCahoots', '$2y$10$W0vFtSE1aBbEfz2p2gtLeuLdXnllSDLsPG/dWYXgDVmWILUED4ZAK', 'caseycahoots@gmail.com', 'img/stock1.jpeg', 'img/stock7.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `channelUsers`
--
ALTER TABLE `channelUsers`
  ADD PRIMARY KEY (`user_id`,`channel_id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indexes for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `channel_id` (`channel_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_info`
--
ALTER TABLE `event_info`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_messages`
--
ALTER TABLE `event_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `sub_user`
--
ALTER TABLE `sub_user`
  ADD PRIMARY KEY (`follower_id`,`following_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `sub_user_events`
--
ALTER TABLE `sub_user_events`
  ADD PRIMARY KEY (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `channel_messages`
--
ALTER TABLE `channel_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `event_messages`
--
ALTER TABLE `event_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `channelUsers`
--
ALTER TABLE `channelUsers`
  ADD CONSTRAINT `channelusers_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`channel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `channelusers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `channel_messages`
--
ALTER TABLE `channel_messages`
  ADD CONSTRAINT `channel_messages_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`channel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_info`
--
ALTER TABLE `event_info`
  ADD CONSTRAINT `event_info_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_messages`
--
ALTER TABLE `event_messages`
  ADD CONSTRAINT `event_messages_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_user`
--
ALTER TABLE `sub_user`
  ADD CONSTRAINT `sub_user_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_user_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_user_events`
--
ALTER TABLE `sub_user_events`
  ADD CONSTRAINT `sub_user_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_user_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
