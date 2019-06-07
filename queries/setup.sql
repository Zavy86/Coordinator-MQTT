--
-- Setup module Coordinator MQTT
--
-- Version 1.0.0
--

-- --------------------------------------------------------

SET TIME_ZONE = "+00:00";
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------

--
-- Table structure for table `mqtt__settings`
--

CREATE TABLE IF NOT EXISTS `mqtt__settings` (
  `setting` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------------------------------------

--
-- Table structure for table `mqtt__logs`
--

CREATE TABLE IF NOT EXISTS `mqtt__logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) unsigned NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------------------------------------

--
-- Authorizations
--

INSERT IGNORE INTO `framework__modules__authorizations` (`id`,`fkModule`,`order`) VALUES
('mqtt-manage','mqtt',1),
('mqtt-logs','mqtt',2);

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------
