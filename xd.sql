-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 23 Ara 2018, 14:46:09
-- Sunucu sürümü: 10.1.37-MariaDB
-- PHP Sürümü: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `xd`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `album`
--

CREATE TABLE `album` (
  `userid` int(11) DEFAULT NULL,
  `S_DATE` datetime DEFAULT NULL,
  `id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `tittle` varchar(50) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Comment_of_person_to_story`
--

CREATE TABLE `Comment_of_person_to_story` (
  `userid` int(11) DEFAULT NULL,
  `S_DATE` datetime DEFAULT NULL,
  `text_content` varchar(500) DEFAULT NULL,
  `posted_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `fs_path` blob NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `profile_media` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `person`
--

CREATE TABLE `person` (
  `userid` int(11) NOT NULL,
  `S_PASSWORD` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `profile_name` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `member_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `person`
--

INSERT INTO `person` (`userid`, `S_PASSWORD`, `username`, `profile_name`, `birth_date`, `email`, `phone`, `is_active`, `member_time`) VALUES
(1, 'mert', 'mert', 'Mert KorukÃ¶y', '2018-12-11', 'mert123@gmail.com', '123123123123123', 0, '2018-12-22 12:14:40'),
(2, 'megan1', 'kelem9', 'Ahmet', '2018-12-21', 'kelem@gmail.com', '1124124124', 0, '2018-12-22 13:40:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `person_following`
--

CREATE TABLE `person_following` (
  `userid` int(11) DEFAULT NULL,
  `person_following_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `person_reaction`
--

CREATE TABLE `person_reaction` (
  `userid` int(11) DEFAULT NULL,
  `S_DATE` datetime DEFAULT NULL,
  `reaction_date` varchar(20) DEFAULT NULL,
  `reation_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `story`
--

CREATE TABLE `story` (
  `S_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) DEFAULT NULL,
  `text_content` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_userid_fk` (`userid`),
  ADD KEY `album_S_DATE_fk` (`S_DATE`),
  ADD KEY `album_media_id_fk` (`media_id`);

--
-- Tablo için indeksler `Comment_of_person_to_story`
--
ALTER TABLE `Comment_of_person_to_story`
  ADD KEY `comment_userid_fk` (`userid`),
  ADD KEY `comment_S_DATE_fk` (`S_DATE`);

--
-- Tablo için indeksler `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_fk` (`userid`);

--
-- Tablo için indeksler `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username_uniq` (`username`),
  ADD UNIQUE KEY `email_uniq` (`email`),
  ADD UNIQUE KEY `phone_uniq` (`phone`);

--
-- Tablo için indeksler `person_following`
--
ALTER TABLE `person_following`
  ADD KEY `follow_userid_fk` (`userid`),
  ADD KEY `follow_to_userid_fk` (`person_following_id`);

--
-- Tablo için indeksler `person_reaction`
--
ALTER TABLE `person_reaction`
  ADD KEY `person_reaction_userid_fk` (`userid`),
  ADD KEY `person_reaction_S_DATE_fk` (`S_DATE`);

--
-- Tablo için indeksler `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`S_DATE`),
  ADD KEY `story_fk` (`userid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Tablo için AUTO_INCREMENT değeri `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Tablo için AUTO_INCREMENT değeri `person`
--
ALTER TABLE `person`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_S_DATE_fk` FOREIGN KEY (`S_DATE`) REFERENCES `story` (`S_DATE`),
  ADD CONSTRAINT `album_media_id_fk` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `album_userid_fk` FOREIGN KEY (`userid`) REFERENCES `person` (`userid`);

--
-- Tablo kısıtlamaları `Comment_of_person_to_story`
--
ALTER TABLE `Comment_of_person_to_story`
  ADD CONSTRAINT `comment_S_DATE_fk` FOREIGN KEY (`S_DATE`) REFERENCES `story` (`S_DATE`),
  ADD CONSTRAINT `comment_userid_fk` FOREIGN KEY (`userid`) REFERENCES `person` (`userid`);

--
-- Tablo kısıtlamaları `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_fk` FOREIGN KEY (`userid`) REFERENCES `person` (`userid`);

--
-- Tablo kısıtlamaları `person_following`
--
ALTER TABLE `person_following`
  ADD CONSTRAINT `follow_to_userid_fk` FOREIGN KEY (`person_following_id`) REFERENCES `person` (`userid`),
  ADD CONSTRAINT `follow_userid_fk` FOREIGN KEY (`userid`) REFERENCES `person` (`userid`);

--
-- Tablo kısıtlamaları `person_reaction`
--
ALTER TABLE `person_reaction`
  ADD CONSTRAINT `person_reaction_S_DATE_fk` FOREIGN KEY (`S_DATE`) REFERENCES `story` (`S_DATE`),
  ADD CONSTRAINT `person_reaction_userid_fk` FOREIGN KEY (`userid`) REFERENCES `person` (`userid`);

--
-- Tablo kısıtlamaları `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `story_fk` FOREIGN KEY (`userid`) REFERENCES `person` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
