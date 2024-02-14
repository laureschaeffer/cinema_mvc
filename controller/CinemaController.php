<?php
// fichier qui crée les fonctions, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
namespace Controller;
use Model\Connect;

class CinemaController {
    //-------------------------------------------------------requetes des listes------------------------------------------
    
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requeteLsFilms = $pdo->query(
            "SELECT titre, annee_sortie_fr, id_film
            FROM film");

        require "view/film/listeFilms.php";
    }

    public function listReals(){
        $pdo = Connect::seConnecter();
        $requeteLsReal = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, p.date_naissance, r.id_realisateur
            FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne"
        );

        require "view/personnes/listeReals.php";
    }

    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requeteLsActeur = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, p.date_naissance, a.id_acteur
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne"
        );

        require "view/personnes/listeActeurs.php";
    }

    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requeteLsGenre = $pdo->query(
            "SELECT nom
            FROM genre
            ORDER BY nom"
        );

        require "view/listeGenres.php";
    }


    //----------------------------------------------------requetes précises (id)---------------------------------------------------

    // Lors d'une requête dans lequel on a un élément variable (id) il faut utiliser un "prepare" et pas un "query"

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, p.date_naissance, p.photo
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
        WHERE id_acteur = :id");
        $requeteActeur->execute(["id" => $id]);
        // on fait passer un tableau associatif qui associe le nom de champ paramétré avec la valeur de l'id
        require "view/personnes/detailActeur.php";
    }

    public function detailReal($id){
        $pdo = Connect::seConnecter();
        $requeteReal = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, p.date_naissance, p.photo
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE id_realisateur = :id");
        $requeteReal->execute(["id" => $id]);

        require "view/personnes/detailReal.php";
    }
    
    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("SELECT titre, annee_sortie_fr, synopsis, note, affiche
        FROM film WHERE id_film = :id");
        $requeteDetailFilm->execute(["id" => $id]);

        // il est nécessaire d'utiliser une seconde requête pour le casting
        $requeteCasting = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, r.nom_personnage
        FROM castings c
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN personne p ON a.id_personne = p.id_personne
        INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_film = :id");
        $requeteCasting->execute(["id" => $id]);

        require "view/film/detailFilm.php";

    }

}