-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema_laure
CREATE DATABASE IF NOT EXISTS `cinema_laure` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema_laure`;

-- Listage de la structure de la table cinema_laure. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.acteur : ~16 rows (environ)
INSERT IGNORE INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 7),
	(7, 8),
	(8, 9),
	(9, 11),
	(10, 12),
	(11, 14),
	(12, 15),
	(13, 16),
	(14, 17),
	(15, 19),
	(16, 21);

-- Listage de la structure de la table cinema_laure. castings
CREATE TABLE IF NOT EXISTS `castings` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `castings_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `castings_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `castings_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.castings : ~18 rows (environ)
INSERT IGNORE INTO `castings` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 2),
	(1, 2, 1),
	(1, 3, 3),
	(2, 4, 4),
	(8, 4, 13),
	(2, 5, 5),
	(3, 6, 6),
	(3, 7, 7),
	(4, 8, 8),
	(5, 9, 9),
	(5, 10, 10),
	(6, 11, 9),
	(6, 12, 10),
	(7, 13, 11),
	(8, 14, 12),
	(8, 15, 14),
	(9, 15, 15),
	(9, 16, 16);

-- Listage de la structure de la table cinema_laure. definir
CREATE TABLE IF NOT EXISTS `definir` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `definir_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `definir_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.definir : ~11 rows (environ)
INSERT IGNORE INTO `definir` (`id_film`, `id_genre`) VALUES
	(7, 1),
	(1, 2),
	(4, 2),
	(9, 2),
	(8, 3),
	(9, 3),
	(4, 4),
	(5, 5),
	(6, 5),
	(2, 6),
	(3, 6);

-- Listage de la structure de la table cinema_laure. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb3_bin NOT NULL,
  `annee_sortie_fr` int DEFAULT NULL,
  `duree` int DEFAULT NULL,
  `synopsis` text COLLATE utf8mb3_bin,
  `note` float DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.film : ~9 rows (environ)
INSERT IGNORE INTO `film` (`id_film`, `titre`, `annee_sortie_fr`, `duree`, `synopsis`, `note`, `id_realisateur`) VALUES
	(1, 'Million Dollar baby', 2005, 132, '"Maggie en a marre de son boulot de serveuse dans le Missouri. Elle part à Los Angeles pour se mettre à la boxe. Là-bas, elle espère bien se faire entrainer par le respecté Frankie Dunn"\r\n ', 4.4, 1),
	(2, 'Sully', 2016, 96, 'Le 15 janvier 2009, le monde a assisté au "miracle sur l\'Hudson" accompli par le commandant "Sully" Sullenberger : en effet, celui-ci a réussi à poser son appareil sur les eaux glacées du fleuve Hudson, sauvant ainsi la vie des 155 passagers à bord. Cependant, alors que Sully était salué par l\'opinion publique et les médias pour son exploit inédit dans l\'histoire de l\'aviation, une enquête a été ouverte, menaçant de détruire sa réputation et sa carrière.', 4.1, 1),
	(3, 'Mary Shelley', 2018, 120, 'La famille de Mary Wollstonecraft désapprouve quand elle et le poète Percy Shelley annoncent leur amour l\'un pour l\'autre. La famille est horrifiée lorsqu\'elle constate que le couple s\'est enfui, accompagné de la demi-soeur de Marie, Claire.', 4, 2),
	(4, 'La jetée', 1962, 28, 'A la suite de la 3e guerre mondiale qui a détruit Paris, un homme cobaye, envoyé dans le passé y rencontre une femme et découvre avec elle le bonheur d\'instants partagés. Devant le succès de ces expériences, on tente alors de l\'acheminer dans le futur.', 4.5, 3),
	(5, 'Nosferatu fantôme de la nuit', 1979, 84, 'Lorsqu\'un jeune homme, Jonathan Harker, part en destination de la Transylvanie pour négocier la vente d\'une maison avec le comte Dracula, sa femme Lucy s\'inquiète pour sa sécurité.', 3.5, 4),
	(6, 'Dracula', 1992, 127, 'Transylvanie, 1462. Viad Drakul laisse la belle Elisabeta pour aller guerroyer contre l\'envahisseur turc. Revenu victorieux du combat, il découvre le corps inanimé de sa femme, qui s\'est suicidée à la fausse nouvelle de sa mort. Eperdu de douleur, il abjure sa foi et en appelle aux puissances du sang pour retrouver sa bien-aimée.', 4.2, 5),
	(7, 'Le Parrain', 1972, 177, 'En 1945, à New York, les Corleone sont une des 5 familles de la mafia. Don Vito Corleone, `parrain\' de cette famille, marie sa fille à un bookmaker. Sollozzo, `parrain\' de la famille Tattaglia, propose à Don Vito une association dans le trafic de drogue, mais celui-ci refuse. Sonny, un de ses fils, y est quant à lui favorable. Afin de traiter avec Sonny, Sollozzo tente de faire tuer Don Vito, mais celui-ci en réchappe.', 4, 5),
	(8, 'Forest Gump', 1994, 142, 'Sur un banc, à Savannah, en Géorgie, Forrest Gump attend le bus. Comme celui-ci tarde à venir, le jeune homme raconte sa vie à ses compagnons d\'ennui. A priori, ses capacités intellectuelles plutôt limitées ne le destinaient pas à de grandes choses', 4.6, 6),
	(9, 'Le cercle des poètes disparus', 1990, 128, 'Todd Anderson, un garçon plutôt timide, est envoyé dans la prestigieuse académie de Welton, réputée pour être l\'une des plus fermées et austères des États-Unis, là où son frère avait connu de brillantes études. C\'est dans cette université qu\'il va faire la rencontre d\'un professeur de lettres anglaises plutôt étrange, Mr Keating, qui les encourage à toujours refuser l\'ordre établi. ', 4.3, 7);

-- Listage de la structure de la table cinema_laure. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.genre : ~6 rows (environ)
INSERT IGNORE INTO `genre` (`id_genre`, `nom`) VALUES
	(1, 'Action'),
	(2, 'Drame'),
	(3, 'Comedy'),
	(4, 'Sci-Fi'),
	(5, 'Fantastique'),
	(6, 'Biopic');

-- Listage de la structure de la table cinema_laure. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  `sexe` varchar(10) COLLATE utf8mb3_bin DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.personne : ~22 rows (environ)
INSERT IGNORE INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`) VALUES
	(1, 'Eastwood', 'Clint', 'homme', '1930-05-31'),
	(2, ' Swank', 'Hilary', 'femme', '1974-07-30'),
	(3, 'Freeman', 'Morgan', 'homme', '1937-06-01'),
	(4, 'Hanks', 'Tom', 'homme', '1956-07-09'),
	(5, 'Eckhart', 'Aaron', 'homme', '1968-03-12'),
	(6, 'Al-Mansour', 'Haifaa', 'femme', '1974-08-10'),
	(7, 'Fanning', 'Elle', 'femme', '1998-04-09'),
	(8, 'Booth', 'Douglas', 'homme', '1992-07-09'),
	(9, 'Marker', 'Chris', 'homme', '1921-07-29'),
	(10, 'Herzog', 'Werner', 'homme', '1942-09-05'),
	(11, 'Kinski', 'Klaus', 'homme', '1926-10-18'),
	(12, 'Adjani', 'Isabelle', 'femme', '1955-07-27'),
	(13, 'Copola', 'Francis', 'homme', '1939-04-07'),
	(14, 'Oldman', 'Gary', 'homme', '1958-03-21'),
	(15, 'Frost', 'Sadie', 'femme', '1965-06-15'),
	(16, 'Pacino', 'Alfredo', 'homme', '1940-04-25'),
	(17, 'Brando', 'Marlon', 'homme', '1924-04-03'),
	(18, 'Zemeckis', 'Robert', 'homme', '1952-05-14'),
	(19, 'Wright', 'Robin', 'femme', '1966-04-08'),
	(20, 'Weir', 'Peter', 'homme', '1944-08-21'),
	(21, 'Williams', 'Robin', 'homme', '1951-07-21'),
	(22, 'Hawke', 'Ethan', 'homme', '1970-11-06');

-- Listage de la structure de la table cinema_laure. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.realisateur : ~7 rows (environ)
INSERT IGNORE INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 6),
	(3, 9),
	(4, 10),
	(5, 13),
	(6, 18),
	(7, 20);

-- Listage de la structure de la table cinema_laure. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_personnage` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.role : ~16 rows (environ)
INSERT IGNORE INTO `role` (`id_role`, `nom_personnage`) VALUES
	(1, 'Maggie'),
	(2, 'Frankie Dunn'),
	(3, 'Eddie Dupris'),
	(4, 'Sully'),
	(5, 'Jeff Skiles'),
	(6, 'Mary Wollstonecraft'),
	(7, 'Percy Shelley'),
	(8, 'Homme cobaye'),
	(9, 'Dracula'),
	(10, 'Lucy Westenra'),
	(11, 'Michael Corleone'),
	(12, 'Vito Corleone'),
	(13, 'Forest Gump'),
	(14, 'Jenny '),
	(15, 'John Keating'),
	(16, 'Todd Anderson');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;