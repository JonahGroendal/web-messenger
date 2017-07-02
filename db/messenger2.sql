CREATE DATABASE messenger;
USE messenger;

CREATE TABLE `users` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
);

CREATE TABLE `message` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `creator_id` int(10) NOT NULL,
  `message_body` text NOT NULL,
  `create_date` timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `message_recipient` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(10) NOT NULL,
  `message_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recipient_id` (`recipient_id`),
  KEY `message_id` (`message_id`),
  CONSTRAINT `message_recipient_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`),
  CONSTRAINT `message_recipient_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`)
);

CREATE TABLE `friendships` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  KEY `id1` (`id1`),
  KEY `id2` (`id2`),
  CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `users` (`id`),
  CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `users` (`id`)
);


INSERT INTO `users` (`username`, `first_name`, `last_name`, `is_active`, `password`) VALUES
('aarobrai', 'Aaron', 'Brainard', 0, '$2y$10$y0Y9WkFj4fLfchh2R4JulurXzxusZB4UsJhCkh5VoAedwjv43bp8e'),
('abraham_drinkin', 'Abraham', 'Drinkin', 0, '$2y$10$3TQ3evHYtnaFFIYkfV3qQupMS.9.o3pdvE2gTMGMKmu4nQPF56a.W'),
('the_senate', 'Sheev', 'Palpatine', 0, '$2y$10$JvsY20BfuHUq10mgmtRBKe2oseweRBu2QYdm2E7NK/cTeUNykp6ae');

INSERT INTO `message` (`creator_id`, `message_body`, `create_date`) VALUES
(1, 'Hello, world!(2017-04-12 19:48:54)', '2017-04-12 19:48:54.000'),
(1, 'Hey there johnny boi, hows it goin? (2017-04-12 19:48:55)', '2017-04-12 19:48:55.000'),
(2, 'oh you know, just hootin and a hollerin per the usual. You get that ol girl a rooten tooten runnin? (2017-04-12 19:48:56)', '2017-04-12 19:48:56.000'),
(1, 'Weeell im a workin on it. It aint gone be easy but ill keep ya posted! (2017-04-12 19:48:56)', '2017-04-12 19:48:56.000'),
(2, 'Yee haw!(2017-04-12 20:48:50)', '2017-04-12 20:48:50.000'),
(1, 'Hey there johnny boi, hows it goin?(2017-04-12 20:48:50)', '2017-04-12 20:48:50.000'),
(2, 'Oh you know, just hootin and a hollerin per the usual. You get that ol girl a rooten tooten runnin?(2017-05-12 20:48:50)', '2017-05-12 20:48:50.000'),
(1, 'Weeell im a workin on it. It aint gone be easy but ill keep ya posted!(2017-06-12 00:48:50)', '2017-06-12 00:48:50.000'),
(2, 'Yee haw!(2018-04-13 22:48:50)', '2018-04-13 22:48:50.000'),
(1, 'Hey there johnny boi, hows it goin?(2017-04-13 20:48:50)', '2017-04-13 20:48:50.000'),
(2, 'Oh you know, just hootin and a hollerin per the usual. You get that ol girl a rooten tooten runnin?(2017-04-14 20:48:50)', '2017-04-14 20:48:50.000'),
(1, 'Weeell im a workin on it. It aint gone be easy but ill keep ya posted!(2015-04-12 20:48:50)', '2015-04-12 20:48:50.000');

INSERT INTO `message_recipient` (`recipient_id`, `message_id`, `is_read`) VALUES
(2, 1, 0),
(2, 2, 0),
(1, 3, 0),
(2, 4, 0),
(1, 5, 0), 
(2, 6, 0), 
(1, 7, 0), 
(2, 8, 0), 
(1, 9, 0), 
(2, 10, 0), 
(1, 11, 0),
(2, 12, 0);

INSERT INTO `friendships` (`id1`, `id2`) VALUES
(1, 2),
(1, 3),
(3, 1),
(3, 2),
(2, 3);
