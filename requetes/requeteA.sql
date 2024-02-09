-- A. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur


SELECT CONCAT((LPAD(FLOOR(duree/60), 2, 0)), ':', (LPAD(MOD(duree, 60), 2, 0))) AS dureeFilm, titre, annee_sortie_fr, CONCAT(p.prenom, ' ', p.nom) AS realisateur 
FROM film f
INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
INNER JOIN personne p ON r.id_personne = p.id_personne
WHERE f.id_film=6


-- https://sql.sh/fonctions/lpad : renvoie le reste d'une division entière (comme modulo)
-- https://sql.sh/fonctions/concat : assemble des valeurs dans une seule colonne