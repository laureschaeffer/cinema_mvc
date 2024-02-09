-- G. g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)


SELECT CONCAT(p.prenom, ' ', p.nom) AS acteur, f.titre AS titreFilm, r.nom_personnage, f.annee_sortie_fr
FROM castings c
INNER JOIN acteur a ON c.id_acteur = a.id_acteur
INNER JOIN personne p ON a.id_personne = p.id_personne
INNER JOIN film f ON c.id_film = f.id_film
INNER JOIN role r ON c.id_role = r.id_role
WHERE a.id_acteur=4