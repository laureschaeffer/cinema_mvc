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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.acteur : ~23 rows (environ)
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
	(16, 21),
	(17, 22),
	(18, 24),
	(19, 25),
	(20, 27),
	(21, 28),
	(22, 29),
	(23, 30);

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

-- Listage des données de la table cinema_laure.castings : ~23 rows (environ)
INSERT IGNORE INTO `castings` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 2),
	(1, 2, 1),
	(1, 3, 3),
	(2, 4, 4),
	(8, 4, 13),
	(11, 4, 20),
	(2, 5, 5),
	(3, 6, 6),
	(3, 7, 7),
	(4, 8, 8),
	(5, 9, 9),
	(5, 10, 10),
	(6, 11, 9),
	(6, 12, 10),
	(7, 13, 11),
	(7, 14, 12),
	(8, 15, 14),
	(9, 16, 15),
	(9, 17, 16),
	(10, 18, 18),
	(10, 19, 17),
	(11, 20, 19),
	(6, 23, 21);

-- Listage de la structure de la table cinema_laure. definir
CREATE TABLE IF NOT EXISTS `definir` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `definir_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `definir_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.definir : ~13 rows (environ)
INSERT IGNORE INTO `definir` (`id_film`, `id_genre`) VALUES
	(7, 1),
	(1, 2),
	(4, 2),
	(9, 2),
	(10, 2),
	(8, 3),
	(9, 3),
	(10, 3),
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
  `affiche` text COLLATE utf8mb3_bin,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.film : ~11 rows (environ)
INSERT IGNORE INTO `film` (`id_film`, `titre`, `annee_sortie_fr`, `duree`, `synopsis`, `note`, `id_realisateur`, `affiche`) VALUES
	(1, 'Million Dollar baby', 2005, 132, '"Maggie en a marre de son boulot de serveuse dans le Missouri. Elle part à Los Angeles pour se mettre à la boxe. Là-bas, elle espère bien se faire entrainer par le respecté Frankie Dunn"\r\n ', 4.4, 1, 'public/img/affiches/millionDollarBaby.jpg'),
	(2, 'Sully', 2016, 96, 'Le 15 janvier 2009, le monde a assisté au "miracle sur l\'Hudson" accompli par le commandant "Sully" Sullenberger : en effet, celui-ci a réussi à poser son appareil sur les eaux glacées du fleuve Hudson, sauvant ainsi la vie des 155 passagers à bord. Cependant, alors que Sully était salué par l\'opinion publique et les médias pour son exploit inédit dans l\'histoire de l\'aviation, une enquête a été ouverte, menaçant de détruire sa réputation et sa carrière.', 4.1, 1, 'public/img/affiches/sully.jpg'),
	(3, 'Mary Shelley', 2018, 120, 'La famille de Mary Wollstonecraft désapprouve quand elle et le poète Percy Shelley annoncent leur amour l\'un pour l\'autre. La famille est horrifiée lorsqu\'elle constate que le couple s\'est enfui, accompagné de la demi-soeur de Marie, Claire.', 4, 2, 'public/img/affiches/MaryShelley.jpg'),
	(4, 'La jetée', 1962, 28, 'A la suite de la 3e guerre mondiale qui a détruit Paris, un homme cobaye, envoyé dans le passé y rencontre une femme et découvre avec elle le bonheur d\'instants partagés. Devant le succès de ces expériences, on tente alors de l\'acheminer dans le futur.', 4.5, 3, 'public/img/affiches/laJetee.jpg'),
	(5, 'Nosferatu fantôme de la nuit', 1979, 84, 'Lorsqu\'un jeune homme, Jonathan Harker, part en destination de la Transylvanie pour négocier la vente d\'une maison avec le comte Dracula, sa femme Lucy s\'inquiète pour sa sécurité.', 3.5, 4, 'public/img/affiches/nosferatu.jpg'),
	(6, 'Dracula', 1992, 127, 'Transylvanie, 1462. Viad Drakul laisse la belle Elisabeta pour aller guerroyer contre l\'envahisseur turc. Revenu victorieux du combat, il découvre le corps inanimé de sa femme, qui s\'est suicidée à la fausse nouvelle de sa mort. Eperdu de douleur, il abjure sa foi et en appelle aux puissances du sang pour retrouver sa bien-aimée.', 4.2, 5, 'public/img/affiches/dracula.jpg'),
	(7, 'Le Parrain', 1972, 177, 'En 1945, à New York, les Corleone sont une des 5 familles de la mafia. Don Vito Corleone, `parrain\' de cette famille, marie sa fille à un bookmaker. Sollozzo, `parrain\' de la famille Tattaglia, propose à Don Vito une association dans le trafic de drogue, mais celui-ci refuse. Sonny, un de ses fils, y est quant à lui favorable. Afin de traiter avec Sonny, Sollozzo tente de faire tuer Don Vito, mais celui-ci en réchappe.', 4, 5, 'public/img/affiches/leParrain.jpg'),
	(8, 'Forest Gump', 1994, 142, 'Sur un banc, à Savannah, en Géorgie, Forrest Gump attend le bus. Comme celui-ci tarde à venir, le jeune homme raconte sa vie à ses compagnons d\'ennui. A priori, ses capacités intellectuelles plutôt limitées ne le destinaient pas à de grandes choses', 4.6, 6, 'public/img/affiches/forestGump.jpg'),
	(9, 'Le cercle des poètes disparus', 1990, 128, 'Todd Anderson, un garçon plutôt timide, est envoyé dans la prestigieuse académie de Welton, réputée pour être l\'une des plus fermées et austères des États-Unis, là où son frère avait connu de brillantes études. C\'est dans cette université qu\'il va faire la rencontre d\'un professeur de lettres anglaises plutôt étrange, Mr Keating, qui les encourage à toujours refuser l\'ordre établi. ', 4.3, 7, 'public/img/affiches/cercleDesPoetesDisparus.jpg'),
	(10, 'Winter Break', 2023, 133, 'Un instructeur maussade d\'une école préparatoire de la Nouvelle-Angleterre reste sur le campus pendant les vacances de Noël pour garder une poignée d\'étudiants qui n\'ont nulle part où aller.', 4.1, 8, 'public/img/affiches/winterbreak.webp'),
	(11, 'La ligne verte', 1999, 189, 'Paul Edgecomb, pensionnaire centenaire d\'une maison de retraite, est hanté par ses souvenirs. Gardien-chef du pénitencier de Cold Mountain, en 1935, il était chargé de veiller au bon déroulement des exécutions capitales au bloc E (la ligne verte) en s\'efforçant d\'adoucir les derniers moments des condamnés. Parmi eux se trouvait un colosse du nom de John Coffey, accusé du viol et du meurtre de deux fillettes.', 4.6, 9, 'public/img/affiches/ligneVerte.jpg');

-- Listage de la structure de la table cinema_laure. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.genre : ~5 rows (environ)
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
  `photo` text COLLATE utf8mb3_bin,
  `biographie` text COLLATE utf8mb3_bin,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.personne : ~30 rows (environ)
INSERT IGNORE INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`, `photo`, `biographie`) VALUES
	(1, 'Eastwood', 'Clint', 'homme', '1930-05-31', 'public/img/personnes/clintEastwood.jpg', 'Légende hollywoodienne, à la fois acteur et réalisateur, ayant laissé une empreinte indélébile sur le cinéma avec des films emblématiques tels que \'Impitoyable\' et la série des \'Dirty Harry\'. '),
	(2, 'Swank', 'Hilary', 'femme', '1974-07-30', 'public/img/personnes/hilarySwank.jpg', 'Talentueuse actrice deux fois lauréate de l\'Oscar, reconnue pour ses performances émouvantes dans des films comme ‘Boys Don\'t Cry’ et ‘Million Dollar Baby’, elle a prouvé son engagement envers des rôles complexes et provocateurs. '),
	(3, 'Freeman', 'Morgan', 'homme', '1937-06-01', 'public/img/personnes/morganFreeman.jpg', 'Voix emblématique du cinéma, cet acteur polyvalent a captivé les spectateurs avec sa présence charismatique dans des films tels que \'Les Évadés\' et \'Bruce tout-puissant\', tout en étant un narrateur recherché pour ses documentaires. '),
	(4, 'Hanks', 'Tom', 'homme', '1956-07-09', 'public/img/personnes/tom_hanks.jpg', 'Acteur vénéré à travers le monde, maintes fois récompensé pour ses performances dans des films tels que \'Forrest Gump\', \'Philadelphia\' et \'Captain Phillips\', il incarne la quintessence du talent et de la polyvalence à Hollywood. '),
	(5, 'Eckhart', 'Aaron', 'homme', '1968-03-12', 'public/img/personnes/aaronEckhart.jpg', 'Acteur polyvalent, il a brillé dans des rôles variés, que ce soit en tant que procureur dans \'The Dark Knight\' ou en tant que porte-parole cynique dans \'Thank You for Smoking\', démontrant sa capacité à incarner une large gamme de personnages. '),
	(6, 'Al-Mansour', 'Haifaa', 'femme', '1974-08-10', 'public/img/personnes/haifaaAlMansour.jpg', 'Réalisatrice saoudienne pionnière, son film \'Wadjda\' a marqué l\'histoire en tant que premier long métrage réalisé par une femme en Arabie saoudite, explorant avec sensibilité les défis de l\'émancipation féminine dans une société conservatrice.  '),
	(7, 'Fanning', 'Elle', 'femme', '1998-04-09', 'public/img/personnes/elle-Fanning.jpg', 'Actrice éblouissante, elle a captivé le public avec ses performances dans des films tels que \'Somewhere\' et \'The Neon Demon\', révélant un talent précoce et une capacité à incarner des rôles complexes avec une grâce étonnante.'),
	(8, 'Booth', 'Douglas', 'homme', '1992-07-09', 'public/img/personnes/douglasBooth.jpg', 'Acteur britannique en pleine ascension, il s\'est distingué dans des adaptations littéraires telles que \'Romeo and Juliet\' et \'Great Expectations\', séduisant le public par sa présence charismatique et son jeu d\'acteur convaincant. '),
	(9, 'Marker', 'Chris', 'homme', '1921-07-29', 'public/img/personnes/chrisMarker.jpg', 'Réalisateur et écrivain visionnaire, il est célèbre pour son film expérimental \'La Jetée\' et son travail novateur dans le domaine du cinéma documentaire, offrant une perspective unique sur les questions sociales et politiques de son époque. '),
	(10, 'Herzog', 'Werner', 'homme', '1942-09-05', 'public/img/personnes/wernerHerzog.jpg', 'Cinéaste allemand iconoclaste, ses films audacieux et provocateurs, comme \'Aguirre, la colère de Dieu\' et \'Fitzcarraldo\', repoussent les limites du cinéma conventionnel, explorant les thèmes de l\'obsession, de la folie et de la condition humaine avec une intensité saisissante.'),
	(11, 'Kinski', 'Klaus', 'homme', '1926-10-18', 'public/img/personnes/klausKinski.jpg', 'Acteur allemand au tempérament volcanique, connu pour ses collaborations tumultueuses avec Werner Herzog dans des films comme \'Aguirre, la colère de Dieu\' et \'Fitzcarraldo\', il a laissé une marque indélébile sur le cinéma avec ses performances mémorables.'),
	(12, 'Adjani', 'Isabelle', 'femme', '1955-07-27', 'public/img/personnes/isabelleAdjani.jpeg', 'Actrice française de renommée mondiale, récipiendaire de plusieurs prix, elle a captivé le public avec son talent exceptionnel et ses interprétations émouvantes dans des films tels que \'L\'Histoire d\'Adèle H.\' et \'Camille Claudel\'.'),
	(13, 'Copola', 'Francis', 'homme', '1939-04-07', 'public/img/personnes/francisCoppola.jpg', 'Réalisateur légendaire, célèbre pour avoir dirigé des films emblématiques tels que \'Le Parrain\', \'Dracula\' et \'Apocalypse Now\', il est considéré comme l\'un des cinéastes les plus influents de l\'histoire du cinéma américain.'),
	(14, 'Oldman', 'Gary', 'homme', '1958-03-21', 'public/img/personnes/garyOldman.jpg', 'Acteur polyvalent et caméléonique, il a impressionné le public avec sa capacité à se métamorphoser dans une variété de rôles, des méchants dépravés comme dans \'Léon\' aux figures historiques comme dans \'Les Heures sombres\', et son rôle de Sirius Black dans \'Harry Potter\'.'),
	(15, 'Frost', 'Sadie', 'femme', '1965-06-15', 'public/img/personnes/sadieFrost.jpeg', 'Actrice britannique et entrepreneure, elle est également connue pour son rôle dans des films tels que \'Dracula\' de Coppola et pour sa carrière dans la mode avec la marque \'FrostFrench\'.'),
	(16, 'Pacino', 'Alfredo', 'homme', '1940-04-25', 'public/img/personnes/alPacino.jpg', 'Icône du cinéma américain, célèbre pour ses performances légendaires dans des films tels que \'Le Parrain\', \'Scarface\' et \'Le Temps d\'un week-end\', il incarne la quintessence de l\'acteur tourmenté et charismatique.'),
	(17, 'Brando', 'Marlon', 'homme', '1924-04-03', 'public/img/personnes/marlonBrando.png', 'Légende du cinéma, il a révolutionné l\'art de l\'interprétation avec des performances révolutionnaires dans des films comme \'Un tramway nommé Désir\' et \'Le Parrain\', influençant des générations d\'acteurs à venir par son style novateur et sa présence magnétique.'),
	(18, 'Zemeckis', 'Robert', 'homme', '1952-05-14', 'public/img/personnes/robertZemeckis.jpg', 'Réalisateur, scénariste et producteur américain célèbre pour avoir dirigé des films emblématiques tels que \'Retour vers le futur\', \'Forrest Gump\' et \'Qui veut la peau de Roger Rabbit ?\'. Zemeckis a commencé sa carrière dans le cinéma en réalisant des films indépendants avant de connaître le succès à Hollywood. Son style visuel distinctif et son utilisation innovante des effets spéciaux lui ont valu de nombreux prix et nominations aux Oscars. En plus de son travail au cinéma, Zemeckis a également été impliqué dans la production de séries télévisées à succès.'),
	(19, 'Wright', 'Robin', 'femme', '1966-04-08', 'public/img/personnes/robinWright.jpg', 'Actrice américaine renommée, célèbre pour son rôle dans la série télévisée \'House of Cards\' et pour ses performances remarquables dans des films tels que \'Forrest Gump\' et \'The Princess Bride\', elle est également réalisatrice et militante engagée.'),
	(20, 'Weir', 'Peter', 'homme', '1944-08-21', 'public/img/personnes/peterWeir.jpg', 'Réalisateur australien acclamé, connu pour ses films emblématiques tels que \'Le Cercle des poètes disparus\' et \'Witness\', il est réputé pour son style visuel distinctif et sa capacité à capturer l\'essence de l\'humanité dans ses œuvres'),
	(21, 'Williams', 'Robin', 'homme', '1951-07-21', 'public/img/personnes/robinWilliams.jpg', 'Légende de la comédie et acteur polyvalent, il a enchanté le public avec ses performances dans des films tels que \'Good Morning, Vietnam\', \'Dead Poets Society\' et \'Mrs. Doubtfire\', démontrant un talent incomparable et une profonde sensibilité.'),
	(22, 'Hawke', 'Ethan', 'homme', '1970-11-06', 'public/img/personnes/ethanHawke.jpg', 'Acteur et écrivain polyvalent, il est connu pour ses collaborations fructueuses avec le réalisateur Richard Linklater dans des films comme la trilogie \'Before\' et \'Boyhood\', ainsi que pour ses performances remarquables dans \'Training Day\' et \'Boyhood\'.'),
	(23, 'Payne', 'Alexander', 'homme', '1961-02-10', 'public/img/personnes/alexanderPayne.jpg', 'Réalisateur et scénariste primé, il est célèbre pour ses films satiriques et émotionnels tels que \'Sideways\', \'The Descendants\', \'Nebraska\', et plus récemment \'Winter Break\' explorant les complexités de la condition humaine avec humour et compassion.'),
	(24, 'Giamitti', 'Paul', 'homme', '1967-06-06', 'public/img/personnes/paulGiamatti.jpg', 'Acteur talentueux et polyvalent, il a captivé le public avec ses performances dans des films tels que \'Sideways\', \'American Splendor\', \'Winter Break\' et \'Cinderella Man\', incarnant une variété de personnages mémorables avec une profondeur et une nuance remarquables.'),
	(25, 'Randolph', 'Da\'Vine Joy', 'femme', '1986-05-21', 'public/img/personnes/randolphDaVineJoy.jpg', 'Actrice émergente, elle a marqué les esprits avec sa performance dans le film \'Dolemite Is My Name\', lui valant des éloges pour sa présence charismatique et son talent comique.'),
	(26, 'Darabont', 'Frank', 'homme', '1959-01-28', 'public/img/personnes/frankDarabont.jpg', 'Réalisateur et scénariste acclamé, il est surtout connu pour ses adaptations cinématographiques de Stephen King, notamment \'Les Évadés\' et \'La Ligne verte\', démontrant une maîtrise narrative et une sensibilité émotionnelle exceptionnelles.'),
	(27, 'Duncan', 'Michael', 'homme', '1957-12-10', 'public/img/personnes/michaelDuncan.jpg', 'Acteur charismatique et imposant, il a impressionné le public avec sa performance nominée aux Oscars dans \'La Ligne verte\', ainsi que dans des films comme \'Armageddon\' et \'Sin City\', laissant un impact indélébile sur le cinéma.'),
	(28, 'Fanning', 'Elle', 'femme', '1998-04-09', 'public/img/personnes/elle-Fanning.jpg', 'Jeune actrice talentueuse, elle a rapidement gagné en notoriété pour ses performances dans des films tels que \'Somewhere\' et \'The Neon Demon\', affirmant son statut en tant que l\'une des étoiles montantes de Hollywood.'),
	(29, 'Robbie', 'Margot', 'femme', '1990-07-02', 'public/img/personnes/margot-robbie.jpeg', 'Actrice australienne devenue une sensation mondiale, elle a brillé dans des films tels que \'Le Loup de Wall Street\', \'Suicide Squad\', \'I, Tonya\', \'Barbie\' démontrant son talent polyvalent et son charisme magnétique.'),
	(30, 'Ryder', 'Winona', 'femme', '1971-10-29', 'public/img/personnes/winonaRyder.jpg', 'Icône du cinéma des années 90, elle a marqué des générations de cinéphiles avec ses performances dans des films emblématiques tels que \'Beetlejuice\', \'Edward aux mains d\'argent\', \'Dracula\' et \'Girl, Interrupted\', incarnant souvent des personnages excentriques et tourmentés avec une grâce et une intensité captivantes.');

-- Listage de la structure de la table cinema_laure. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.realisateur : ~9 rows (environ)
INSERT IGNORE INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 6),
	(3, 9),
	(4, 10),
	(5, 13),
	(6, 18),
	(7, 20),
	(8, 23),
	(9, 26);

-- Listage de la structure de la table cinema_laure. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nom_personnage` varchar(50) COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table cinema_laure.role : ~21 rows (environ)
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
	(16, 'Todd Anderson'),
	(17, 'Mary Lamb'),
	(18, 'Paul Hunham'),
	(19, 'John Coffey'),
	(20, 'Paul Edgecomb'),
	(21, 'Mina Harker');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
