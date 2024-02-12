<?php

namespace Controller;
use Model\Connect;

class CinemaController {
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requete = $pdo->query(
            "SELECT titre, annee_sortie
            FROM film"
        );

        require "view/template.php";
    }
    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT * from acteur where id_acteur = id");
        $requete->execute(["id" => $id]);
        require "view/template.php";


    }
}