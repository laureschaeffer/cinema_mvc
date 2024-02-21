<?php
// fichier qui crée les fonctions pour la table acteur, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
namespace Controller;
use Model\Connect;

class ActeurController{
    // liste de tous les acteurs
    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requeteLsActeur = $pdo->query(
            "SELECT CONCAT(p.nom, ' ', p.prenom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, a.id_acteur, p.photo
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne
            ORDER BY p.nom"
        );

        require "view/personnes/listeActeurs.php";
    }

    // detail d'un acteur
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, p.photo, p.biographie, p.sexe
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
        WHERE id_acteur = :id");
        $requeteActeur->execute(["id" => $id]);
        // on fait passer un tableau associatif qui associe le nom de champ paramétré avec la valeur de l'id*

        //deuxième requête pour afficher la filmographie
        $acteurFilmographie = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, r.nom_personnage, c.id_film, r.id_role
        FROM castings c
        INNER JOIN film f ON c.id_film = f.id_film
        INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_acteur= :id");
        $acteurFilmographie->execute(["id"=> $id]);
        require "view/personnes/detailActeur.php";
        
    }
}