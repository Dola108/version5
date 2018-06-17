-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2018 at 03:27 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--
CREATE DATABASE IF NOT EXISTS `register` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `register`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(200) NOT NULL,
  `texts` varchar(180) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(25) NOT NULL,
  `likes` int(200) DEFAULT '0',
  `c_id` int(200) NOT NULL,
  `receiver` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `texts`, `time`, `username`, `likes`, `c_id`, `receiver`) VALUES
(132, 'ok', '2018-06-07 16:20:02', 'Bruce', 0, 131, ''),
(133, 'wouls', '2018-06-07 16:22:28', 'Bruce', -1, 132, ''),
(150, 'aaaa', '2018-06-07 23:40:57', 'Bryanne', 0, 275, ''),
(151, 'aaa', '2018-06-07 23:41:00', 'Bryanne', 0, 275, ''),
(152, 'adsasd', '2018-06-10 23:34:51', 'Bryanne', 0, 150, ''),
(159, 'https://www.google.com/search?q=bleach&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjzkr2HlM_bAhVP6LwKHZ2PBYcQ_AUICigB&biw=1366&bih=635#imgrc=Z5WCoy_Fir9BTM:', '2018-06-13 04:23:33', 'Bruce', 1, 310, ''),
(160, 'https://www.youtube.com/watch?v=m2uoAbgvjWg', '2018-06-13 04:24:14', 'Bruce', 1, 159, ''),
(162, 'EEEE', '2018-06-13 05:09:43', 'Bryanne', 1, 160, ''),
(163, 'not wrong', '2018-06-13 05:11:10', 'Bruce', 0, 162, ''),
(169, 'k (y)', '2018-06-14 05:10:00', 'Bruce', 1, 316, ''),
(170, 'nic', '2018-06-14 05:10:15', 'Bruce', 0, 169, ''),
(178, 'h', '2018-06-15 21:21:19', 'Bryanne', 0, 330, 'Bryanne'),
(179, 'e', '2018-06-15 21:21:46', 'Bruce', 0, 178, 'Bryanne'),
(180, 'jhv', '2018-06-15 21:25:45', 'Bruce', 0, 331, 'Bryan');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(200) NOT NULL,
  `texts` varchar(180) NOT NULL,
  `tag` varchar(30) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` longblob,
  `username` varchar(25) NOT NULL,
  `post_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `texts`, `tag`, `time`, `image`, `username`, `post_id`) VALUES
(300, 'comment', '#yyfm', '2018-05-27 19:05:28', 0x33313438353933365f323133383839333138393733323534335f323539383434363031343236303035313936385f6e312e706e67, 'Bryanne', 293),
(302, 'i need diz.', '#some_Scene', '2018-05-27 23:28:19', '', 'Bryanne', 281);

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

DROP TABLE IF EXISTS `flags`;
CREATE TABLE `flags` (
  `id` int(200) NOT NULL,
  `username` varchar(25) NOT NULL,
  `c_id` int(200) NOT NULL,
  `title` varchar(30) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `username` varchar(25) DEFAULT NULL,
  `count` int(200) NOT NULL DEFAULT '0',
  `c_id` int(200) NOT NULL,
  `checked` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`username`, `count`, `c_id`, `checked`) VALUES
('Bruce', 1, 316, 'liked'),
('Bruce', 1, 331, 'liked'),
('Bryanne', 1, 331, 'liked');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(250) NOT NULL,
  `receiver` varchar(25) NOT NULL,
  `sender` varchar(25) NOT NULL,
  `c_id` int(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `flag` varchar(7) NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `receiver`, `sender`, `c_id`, `title`, `flag`) VALUES
(12, 'Bryanne', 'Bryanne', 330, 'commented', 'unseen'),
(13, 'Bryanne', 'Bruce', 178, 'commented', 'unseen'),
(14, 'Bruce', 'Bryanne', 331, 'liked', 'unseen');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(200) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `post` varchar(180) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` longblob NOT NULL,
  `username` varchar(25) NOT NULL,
  `likes` int(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `tag`, `post`, `time`, `image`, `username`, `likes`) VALUES
(263, '#zg', 'aaaaaaaaaa', '2018-04-15 18:52:54', '', 'Bruce', 0),
(264, '#edtxdes', '', '2018-04-15 18:54:08', '', 'Bruce', 0),
(265, '#taglink', 'wrwe', '2018-04-15 19:51:49', '', 'Bruce', 0),
(273, '#meme', 'hoooo', '2018-04-15 20:59:56', 0x32363831343736345f323134393835313538353037393631345f323638333732373134363933393536353431365f6e322e6a7067, 'Soomanib', 0),
(275, '#zg', 'sgsgs', '2018-04-15 23:15:42', '', 'Bruce', 2),
(281, '#some_Scene', 'Some Scene', '2018-04-16 13:25:42', 0x5b44656164466973685d204d75736869736869202d203138205b42445d5b373230705d5b4141435d2e6d70345f736e617073686f745f30392e35345f5b323031372e30362e31355f30332e32372e34365d2e6a7067, 'Bruce', 0),
(286, '#rat', 'ddddddd', '2018-04-16 15:45:44', '', 'asdf', 0),
(293, '#yyfm', 'jygygol\r\n', '2018-04-28 23:38:00', '', 'Bruce', 1),
(301, '#taglink', 'sdasdasdasdasdas', '2018-06-12 17:21:10', '', 'Bryanne', 1),
(305, '#yt', 'a link https://www.youtube.com/watch?v=m2uoAbgvjWg', '2018-06-13 03:03:56', '', 'Bruce', 0),
(306, '#yt', 'a ink\r\nhttps://www.youtube.com/watch?v=m2uoAbgvjWg', '2018-06-13 03:07:06', '', 'Bruce', 1),
(307, '#yt', 'fxh https://www.youtube.com/watch?v=m2uoAbgvjWg', '2018-06-13 03:18:35', '', 'Bruce', 0),
(310, '#yt', 'https://www.google.com/search?q=bleach&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjzkr2HlM_bAhVP6LwKHZ2PBYcQ_AUICigB&biw=1366&bih=635#imgrc=Z5WCoy_Fir9BTM:', '2018-06-13 04:19:31', '', 'Bruce', 3),
(316, '#taglink', 'asdasasd', '2018-06-14 01:42:34', 0x313532383131323438383638382e706e67, 'Bryanne', 2),
(328, '#ubisoft', 'hhh', '2018-06-15 17:46:15', 0x6868686868682e504e47, 'Bryanne', 0),
(329, '#link', 'sdaa', '2018-06-15 17:48:02', 0x6868686868682e504e47, 'Bruce', 0),
(330, '#taglink', 'jojo', '2018-06-15 18:04:26', 0x6a6f6a6f2e504e47, 'Bryanne', 0),
(331, '#lofi', 'lo fi', '2018-06-16 23:27:10', 0x31392d312e676966, 'Bruce', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `avatar` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `email`, `password`, `age`, `gender`, `avatar`) VALUES
(317, 'Bruce', 'kkk@gmail.com', '$2y$10$E6VaezQUbzBLqyrctYPJJudoEDvNDth8X8UR.o8E59sGNH3DbJGru', 22, 'M', 0x32303437393736355f31303231343133393431383436383933345f383536363231363037353431373737373436375f6e2e6a7067),
(332, 'Soomanib', 'radhimask@gmail.com', '$2y$10$ssBpPsAZgmQlbvisS.PBkexTaByKJVrLfMWZSfi2SJRUkAtkdv5ES', 21, 'F', 0x323031362d31322d31342d32332d32302d32382d3636362e6a7067),
(333, 'moulydewan', 'mouly.dewan@gmail.com', '$2y$10$6J6P0Q2lpVCovrhXdwhQeeF7Iv9uVXdgy/wmahYN.Vw0Kq54tIquS', 21, 'F', 0x31333838323238345f313235383834343539373435393035315f343734313131303235313033353337343037325f6e2e6a7067),
(334, 'asdf', 'a@t.com', '$2y$10$Bql0JLuCxRfYvl2h94y/J.NIPQwqPsKRWrL01Y2cVCrZwwrXzl3CO', 12, 'M', 0x312e),
(338, 'Nawrin', 'nnn@gmail.com', '$2y$10$ng2ouXNlAgARXqkvuM4BZ.pZ9KDdE4Vt5GFj53NslHCPOrAaslGyu', 28, 'F', 0x323031362d30372d32322d31342d30342d30342d3234322e6a7067),
(339, 'Fariha', 'fff@gmail.com', '$2y$10$WGdyK8j09GIm3Yjhz/rMS.QrmxvQ/KLFy0eRyZx1BuvY13KuEvI9.', 31, 'F', 0x323031362d31322d30392d32302d33392d34382d3535352e6a7067),
(359, 'Bruce Wayne', 'sss@gmail.com', '$2y$10$Kqqon44W93f8fiVIZI61muvNAzRjlrtJtOqW1V6TYH7iMZtLp6UO2', 22, 'M', 0x306261312e706e67),
(360, 'Bryanne', 'scSC@gmail.com', '$2y$10$2JB5Y/eOuiRlrlE8mDXnTOOLoTwnoO3wOvA4gqsvMi6BVGfzNvxqy', 22, 'F', 0x445266786e5f7258634141684e3232312e706e67),
(362, 'Admin2', 'admin2@gmail.com', '$2y$10$BuwpxzkGQI2y6VSLv9UO.uzLDedtTtLIj4NtTV0g0EjZBikBIMw5e', 22, 'M', '');

-- --------------------------------------------------------

--
-- Table structure for table `reqs`
--

DROP TABLE IF EXISTS `reqs`;
CREATE TABLE `reqs` (
  `id` int(200) NOT NULL,
  `username` varchar(25) NOT NULL,
  `parent_id` int(200) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD UNIQUE KEY `uniquekey` (`username`,`c_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reqs`
--
ALTER TABLE `reqs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `reqs`
--
ALTER TABLE `reqs`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
