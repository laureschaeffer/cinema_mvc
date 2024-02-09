-- L. Acteurs ayant joué dans 3 films ou plus

SELECT CONCAT(p.prenom, ' ', p.nom) AS acteur
FROM castings c
INNER JOIN acteur a ON c.id_acteur = a.id_acteur
INNER JOIN personne p ON a.id_personne = p.id_personne
GROUP BY c.id_acteur
HAVING COUNT(c.id_acteur) >= 3;