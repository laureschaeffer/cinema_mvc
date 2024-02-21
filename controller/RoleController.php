<?php
// fichier qui crée les fonctions pour la table role, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
namespace Controller;
use Model\Connect;

class RoleController{
    public function listRole($id){
        $pdo = Connect::seConnecter();
        $requeteRole = $pdo->prepare("SELECT f.id_film, f.titre, f.annee_sortie_fr, r.nom_personnage, CONCAT(p.prenom, ' ', p.nom) AS nomActeur, a.id_acteur
        FROM castings c
        INNER JOIN film f ON c.id_film = f.id_film
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN role r ON c.id_role = r.id_role
        INNER JOIN personne p ON a.id_personne = p.id_personne
        WHERE r.id_role = :id");
        $requeteRole->execute(["id"=> $id]);

        require "view/film/listeRole.php"; 
    }
}