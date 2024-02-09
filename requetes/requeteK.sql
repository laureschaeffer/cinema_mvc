-- K. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)

SELECT CONCAT(p.prenom, ' ', p.nom) AS acteur
FROM acteur a
INNER JOIN personne p ON a.id_personne = p.id_personne
WHERE (DATE_FORMAT(NOW(), '%Y')) - (DATE_FORMAT(date_naissance, '%Y')) >= 50

-- https://sql.sh/fonctions/datediff
