-- D. Nombre de films par genre (classés dans l’ordre décroissant)

SELECT COUNT(id_film) AS totalFilm, g.nom
FROM definir d
INNER JOIN genre g ON d.id_genre = g.id_genre
GROUP BY g.nom