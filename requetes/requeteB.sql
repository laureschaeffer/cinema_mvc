-- B. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)

SELECT titre, annee_sortie_fr, duree, synopsis 
FROM film
WHERE duree>135
ORDER BY duree DESC 