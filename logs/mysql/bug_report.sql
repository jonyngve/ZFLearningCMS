CREATE TABLE IF NOT EXISTS `bug_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `url` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `priority` enum('low','medium','high') NOT NULL,
  `status` enum('new','in_progress','resolved') NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;