-- E. Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT COUNT(f.id_film) AS nbFilm, CONCAT(p.nom, ' ', p.prenom) AS realisateur
FROM film f
INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
INNER JOIN personne p ON r.id_personne = p.id_personne
GROUP BY f.id_realisateur
ORDER BY nbFilm DESC 