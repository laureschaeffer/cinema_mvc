-- J. Nombre d’hommes et de femmes parmi les acteurs

SELECT p.sexe, COUNT(p.sexe) AS nbActeurActrice
FROM personne p
INNER JOIN acteur a ON a.id_personne = p.id_personne
GROUP BY p.sexe