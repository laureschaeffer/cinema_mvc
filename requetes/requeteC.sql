-- C. Liste des films d’un réalisateur (en précisant l’année de sortie) 

SELECT f.titre, f.annee_sortie_fr, CONCAT(p.prenom, ' ', p.nom) AS realisateur
FROM film f
INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
INNER JOIN personne p ON r.id_personne = p.id_personne
WHERE f.id_realisateur=5