-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 06:12 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bundesliga`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comm_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comm_id`, `text`, `date`) VALUES
(7, 'Napred Herta !!', '2020-01-25 15:26:16'),
(8, 'Dortmund je šampion!', '2020-01-26 00:33:52'),
(10, 'Velika pobeda!', '2020-01-26 00:37:53'),
(11, 'Bolji je Bajern!', '2020-01-26 01:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `con_id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`con_id`, `firstname`, `lastname`, `email`, `subject`, `text`) VALUES
(2, 'Petar', 'Petrovic', 'perap@gmail.com', 'Prenos', 'Na kom kanalu je prenos utakmica?');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `href` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `href`, `alt`) VALUES
(1, '1564717166_author.jpg', '1564717166_author'),
(2, 'bayern.png', 'Bayern'),
(3, 'hertha.png', 'Hertha'),
(4, 'dortmund.png', 'Borussia Dortmund'),
(5, 'augsburg.png', 'Augsburg'),
(6, 'bayer.png', 'Bayer Leverkusen'),
(7, 'paderborn.png', 'Paderborn'),
(8, 'wolfsburg.png', 'Wolfsburg'),
(9, 'koln.png', 'Koln'),
(10, 'werder.png', 'Werder Bremen'),
(11, 'fortuna.png', 'Fortuna Duseldorf'),
(12, 'freiburg.png', 'Freiburg'),
(13, 'mainz.png', 'Mainz'),
(14, 'menhengladbah.png', 'Borussia Monchengladbach'),
(15, 'schalke.png', 'Schalke'),
(16, 'frankfurt.png', 'Eintracht Frankfurt'),
(17, 'hoffenheim.png', 'Hoffenheim'),
(18, 'union.png', 'Union Berlin'),
(19, 'redbull.png', 'RB Leipzig'),
(20, 'new_1579469334_ksc.png', 'Karlsruher SC'),
(21, 'new_1571249573_hi055875752.jpg', 'Bayern Hertha'),
(23, 'new_1579475059_dortmund_supercup.jpg', '1579475059_dortmund_supercup'),
(43, 'new_1579560225_llukic.png', 'llukic'),
(44, 'new_1579561263_dnikitin.jpg', 'dnikitin'),
(45, 'new_1579561477_mvesic.jpg', 'mvesic'),
(46, 'new_1579561679_1579561477_mvesic.jpg', '1579561477_mvesic'),
(49, 'new_1579562351_avatar.jpg', 'avatar');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `result` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `team1_id`, `team2_id`, `result`, `date`) VALUES
(1, 1, 2, '2 : 2', '2019-08-16 18:30:00'),
(2, 3, 4, '5 : 1', '2019-08-17 15:30:00'),
(3, 5, 6, '3 : 2', '2019-08-17 15:30:00'),
(4, 7, 8, '2 : 1', '2019-08-17 15:30:00'),
(5, 9, 10, '1 : 3', '2019-08-17 15:30:00'),
(6, 11, 12, '3 : 0', '2019-08-17 15:30:00'),
(7, 13, 14, '0 : 0', '2019-08-17 18:30:00'),
(8, 15, 16, '1 : 0', '2019-08-18 15:30:00'),
(9, 17, 18, '0 : 4', '2019-08-18 18:00:00'),
(10, 18, 19, '3 : 0', '2019-09-20 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu1`
--

CREATE TABLE `menu1` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(3) DEFAULT NULL,
  `session` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu1`
--

INSERT INTO `menu1` (`menu_id`, `name`, `href`, `parent`, `session`) VALUES
(1, 'HOME', 'index', NULL, 0),
(2, 'FOOTBALL', 'football', NULL, 0),
(3, 'SCHEDULE', 'schedule', 2, 0),
(4, 'NEWS', 'news', 2, 0),
(5, 'CONTACT', 'contact', NULL, 0),
(6, 'ABOUT', 'about', NULL, 0),
(7, 'ADMIN', 'admin', NULL, 1),
(8, 'USERSADMIN', 'usersadmin', 7, 1),
(9, 'TEAMSADMIN', 'teamsadmin', 7, 1),
(10, 'MATCHESADMIN', 'matchesadmin', 7, 1),
(11, 'NEWSADMIN', 'newsadmin', 7, 1),
(12, 'LOG', 'log', 7, 1),
(13, 'MATCHES', 'matches', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `name`, `text`, `date`, `img_id`) VALUES
(1, 'Hertha Berlin hold Bayern Munich in thrilling start to 2019/20 Bundesliga season', 'Despite missing the injured Leon Goretzka, Bayern started brightly in an action-packed start to the new Bundesliga season. Thiago Alcantara and Thomas Müller both had early chances, while at the other end, Vedad Ibisevic gave Manuel Neuer some work to do. Usual Bundesliga business was soon resumed, though, when Serge Gnabry delivered the ball on a plate for Lewandowski to turn in from close range with an outstretched leg. As it appeared the floodgates may be about to be pushed open, one of Bayern\'s and indeed the Allianz Arena\'s most unwelcome opponents brought the visitors level.', '2020-01-19 22:29:25', 21),
(3, 'Paco Alcacer, Jadon Sancho, Julian Brandt and Marco Reus inspire Borussia Dortmund to an opening-day triumph', 'If the first half was good, the second half was a veritable footballing feast - even if an errant Thiago back pass was the unlikely source of the opening goal. The Bayern midfielder gifted possession to Sancho, who showed composure beyond his years to tee up Alcacer for an unerring first-time finish into the bottom corner from 18 yards. Bayern responded in waves, with Hitz performing a quite brilliant double save from Coman and Robert Lewandowski, only to be undone by a lightning counter moments later. Sancho was sent scampering by Guerreiro, and the England international duly left red shirts in his wake before slamming through the legs of Neuer. Dortmund saw out the remainder with minimum fuss to claim the first piece of silverware of 2019/20.', '2020-01-19 23:04:19', 23);

-- --------------------------------------------------------

--
-- Table structure for table `news_comment`
--

CREATE TABLE `news_comment` (
  `necomm_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `comm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_comment`
--

INSERT INTO `news_comment` (`necomm_id`, `news_id`, `comm_id`) VALUES
(5, 1, 7),
(6, 3, 8),
(8, 3, 10),
(9, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `news_teams`
--

CREATE TABLE `news_teams` (
  `nete_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_teams`
--

INSERT INTO `news_teams` (`nete_id`, `team_id`, `news_id`) VALUES
(1, 1, 1),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slide_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slide_id`, `name`, `text`, `href`, `alt`) VALUES
(1, 'Bundesliga ball', 'New ball on season 2019/20', 'bgball.jpg', 'Bundesliga ball'),
(2, 'Dejan Joveljic', 'Joveljic signed a deal with German side Eintracht Frankfurt for a fee of €4 million', 'joveljic.jpg', 'Joveljic'),
(3, 'Bundesliga teams', 'All teams in this season', 'bglogos.jpg', 'Teams');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id_sub` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id_sub`, `email`, `datetime`) VALUES
(5, 'lazalazic@gmail.com', '2020-01-20 00:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `id_img` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `w` int(2) NOT NULL,
  `d` int(2) NOT NULL,
  `l` int(2) NOT NULL,
  `pts` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `id_img`, `name`, `w`, `d`, `l`, `pts`) VALUES
(1, 2, 'FC Bayern München', 0, 1, 0, 1),
(2, 3, 'Hertha Berlin', 0, 1, 0, 1),
(3, 4, 'Borussia Dortmund', 1, 0, 0, 3),
(4, 5, 'FC Augsburg', 0, 0, 1, 0),
(5, 6, 'Bayer 04 Leverkusen', 1, 0, 0, 3),
(6, 7, 'SC Paderborn 07', 0, 0, 1, 0),
(7, 8, 'Vfl Wolfsburg', 1, 0, 0, 3),
(8, 9, 'FC Köln', 0, 0, 1, 0),
(9, 10, 'SV Werder Bremen', 0, 0, 1, 0),
(10, 11, 'Fortuna Düsseldorf', 1, 0, 0, 3),
(11, 12, 'SC Freiburg', 1, 0, 0, 3),
(12, 13, 'FSV Mainz 05', 0, 0, 1, 0),
(13, 14, 'Borussia Mönchengladbach', 0, 1, 0, 1),
(14, 15, 'FC Schalke 04', 0, 1, 0, 1),
(15, 16, 'Eintracht Frankfurt', 1, 0, 0, 3),
(16, 17, 'TSG 1899 Hoffenheim ', 0, 0, 1, 0),
(17, 18, 'FC Union Berlin', 0, 0, 1, 0),
(18, 19, 'RB Leipzig', 1, 0, 0, 3),
(19, 20, 'Karlsruher SC', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `dateregister` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `active` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `email`, `password`, `dateregister`, `token`, `active`, `role_id`, `img_id`) VALUES
(1, 'Jovan Popovic', 'jovan97@', 'moralnapobeda71@gmail.com', 'c2d9684a4165bd2a8784a1942062b4c8', '2020-01-19 20:07:11', '', '1', 1, 1),
(21, 'Luka Lukic', 'lukicl@', 'lukalukic@gmail.com', '41cd8012060774402caef35e261bc90c', '2020-01-20 22:43:45', 'dd74fe3860c3e20d09c26d1b620860a1', '1', 2, 43),
(22, 'Danijela Nikitin', 'daca@', 'daca@gmail.com', '96048268c0b8de2bd3f3201d443782fe', '2020-01-20 23:01:04', '6d9fe7d777d2d70a595857fc9c631747', '1', 2, 44),
(23, 'Milena Vesic', 'milena@', 'milena@gmail.com', '0dbf3e8d771b15f6ec26c0a0ad05d6d1', '2020-01-20 23:04:37', 'a9718504958f6e91b0ea5efbc6a97017', '1', 2, 45),
(27, 'Mila Milic', 'milaaa', 'mila@gmail.com', '0b9479b5e793290acefa2c62e441959e', '2020-01-20 23:19:11', '3f45575b6441bce736115527e8b9f0fd', '1', 2, 49);

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE `user_comment` (
  `uscom_id` int(11) NOT NULL,
  `comm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_comment`
--

INSERT INTO `user_comment` (`uscom_id`, `comm_id`, `user_id`) VALUES
(17, 7, 21),
(18, 8, 1),
(20, 10, 1),
(21, 11, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`con_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `team1_id` (`team1_id`),
  ADD KEY `team2_id` (`team2_id`);

--
-- Indexes for table `menu1`
--
ALTER TABLE `menu1`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `img_id` (`img_id`);

--
-- Indexes for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD PRIMARY KEY (`necomm_id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `comm_id` (`comm_id`);

--
-- Indexes for table `news_teams`
--
ALTER TABLE `news_teams`
  ADD PRIMARY KEY (`nete_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id_sub`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `id_img` (`id_img`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `img_id` (`img_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`uscom_id`),
  ADD KEY `comm_id` (`comm_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu1`
--
ALTER TABLE `menu1`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_comment`
--
ALTER TABLE `news_comment`
  MODIFY `necomm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news_teams`
--
ALTER TABLE `news_teams`
  MODIFY `nete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_comment`
--
ALTER TABLE `user_comment`
  MODIFY `uscom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD CONSTRAINT `news_comment_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_comment_ibfk_2` FOREIGN KEY (`comm_id`) REFERENCES `comment` (`comm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news_teams`
--
ALTER TABLE `news_teams`
  ADD CONSTRAINT `news_teams_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `news_teams_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`id_img`) REFERENCES `images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`img_id`) REFERENCES `images` (`img_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `user_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment_ibfk_2` FOREIGN KEY (`comm_id`) REFERENCES `comment` (`comm_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
