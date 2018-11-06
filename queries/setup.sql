--
-- Setup module Coordinator MQTT
--
-- Version 0.0.1
--

-- --------------------------------------------------------

SET time_zone = "+00:00";
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `mqtt__settings`
--

CREATE TABLE IF NOT EXISTS `mqtt__settings` (
  `setting` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------

--
-- Table structure for table `mqtt__logs`
--

CREATE TABLE IF NOT EXISTS `mqtt__logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) unsigned NOT NULL,
  `topic` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `client` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------------------------------------

--
-- Authorizations
--

INSERT INTO `framework__modules_authorizations` (`id`,`module`,`action`) VALUES
(NULL,'mqtt','mqtt-manage'),
(NULL,'mqtt','mqtt-logs');

-- --------------------------------------------------------
