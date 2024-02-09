-- F. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe

SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur, p.sexe
FROM castings c
INNER JOIN acteur a ON c.id_acteur = a.id_acteur
INNER JOIN personne p ON a.id_personne = p.id_personne
WHERE id_film=8

-- bonus : afficher le role correspondant
SELECT CONCAT(p.nom, ' ', p.prenom) AS acteur, p.sexe, r.nom_personnage
FROM castings c
INNER JOIN acteur a ON c.id_acteur = a.id_acteur
INNER JOIN personne p ON a.id_personne = p.id_personne
INNER JOIN role r ON c.id_role = r.id_role
WHERE id_film=8