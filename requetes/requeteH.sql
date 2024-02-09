-- H. Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT CONCAT(p.prenom, ' ', p.nom) AS personnalité
FROM realisateur r 
INNER JOIN personne p ON r.id_personne = p.id_personne
INNER JOIN acteur a ON a.id_personne = p.id_personne

-- ne renvoie que les id_personne présente dans acteur et réalisateur