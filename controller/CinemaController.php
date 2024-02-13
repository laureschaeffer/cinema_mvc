<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    //-------------------------------------------------------requetes des listes------------------------------------------
    
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requeteLsFilms = $pdo->query(
            "SELECT titre, annee_sortie_fr
            FROM film");

        require "view/film/listFilms.php";
    }

    public function listReals(){
        $pdo = Connect::seConnecter();
        $requeteLsReal = $pdo->query(
            "SELECT CONCAT(p.prenom, p.nom) AS nomReal, p.date_naissance
            FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne"
        );

        require "view/realisateur/listeReals.php";
    }

    //----------------------------------------------------requetes précises (id)---------------------------------------------------
    // Lors d'une requête dans lequel on a un élément variable (od) il faut utiliser un "prepare" et pas un "query"

    // requete pour avoir les infos d'un acteur
    public function detActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteActeur = $pdo->prepare("SELECT CONCAT(p.nom, p.prenom) AS nomActeur, p.date_naissance 
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
        WHERE id_acteur = :id");
        $requeteActeur->execute(["id" => $id]);
        // on fait passer un tableau associatif qui associe le nom de champ paramétré avec la valeur de l'id
        require "view/acteur/detailActeur.php";
    }
    
    // requete pour avoir les infos générales d'un film
    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("SELECT titre, annee_sortie_fr, synopsis, note
        FROM film WHERE id_film = :id");
        $requeteDetailFilm->execute(["id" => $id]);
        require "view/film/detailFilm.php";

    }

    // requete pour avoir les acteurs dans leur role d'un film
    public function detailCasting($id){
        $pdo = Connect::seConnecter();
        $requeteCasting = $pdo->prepare("SELECT CONCAT(p.nom, p.prenom) AS nomActeur, r.nom_personnage
        FROM castings c
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN personne p ON a.id_personne = p.id_personne
        INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_film = :id");
        $requeteCasting->execute(["id" => $id]);
        require "view/film/castingFilm";
    }
}