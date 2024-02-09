-- i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)

SELECT titre, annee_sortie_fr, synopsis 
FROM film 
WHERE (2024 - annee_sortie_fr) <5