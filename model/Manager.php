<?php

// modele pour factoriser les autres manager

namespace Model;

use Model\Connect;

class Manager {
    //fonction d'une liste
    public function findAll(){

        $pdo = Connect::seConnecter();
        // $managerFilm = new FilmManager();
        // $requeteLsFilms = $managerFilm->getFilms();
        $requete = $pdo->prepare("SELECT * FROM ". $this->tableName ." ORDER BY nom");
        $requete->execute();
        return $requete->fetchAll();
    }


}