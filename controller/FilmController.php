<?php
// fichier qui recupere les fonctions du manager correspondant 

namespace Controller;
use Model\Connect;
use Model\FilmManager;
use Model\GenreManager; //pour la liste des genres
// FILTER_SANITIZE_URL

class FilmController {

    //liste de tous les films
    public function listFilms(){
        $filmManager = new FilmManager();
       
        $films = $filmManager->listFilms();
        require "view/film/listeFilms.php";
    }

    //detail d'un film
    public function detailFilm($id){
        $pdo = Connect::seConnecter();

        $filmManager = new FilmManager();
        $data = $filmManager->detailFilm($id);
        
        //tableau qui renvoie un fetch et deux fetchall
        $detailFilm = $data['requeteDetailFilm'];
        $requeteCasting = $data['requeteCasting'];
        $requeteGenreFilm = $data['requeteGenreFilm'];

        require "view/film/detailFilm.php";
        

    }
// --------------------------------------------------------------------formulaires-------------------------------------------------- 

    public function showList(){ // requete pour les listes déroulantes du formulaire
        $pdo = Connect::seConnecter();
        $filmManager = new FilmManager();

        $data = $filmManager->showList();

        $choixReal = $data['choixReal'];
        $choixGenre = $data['choixGenre'];
   
        require "view/formulaires/ajouterFilm.php";
    }

   

    //affiche les infos d'un film dans le formulaire de modification
    public function showListFilm($id){
        $pdo = Connect::seConnecter();
        $filmManager = new FilmManager();

        //toutes les infos du film
        $data = $filmManager->showListFilm($id);

        $requeteDetailFilm = $data['requeteDetailFilm'];
        
        //pour afficher le genre
        $genreManager = new GenreManager();

        $genres = $genreManager->findAll();

        // choix du réalisateur
        $choixReal = $data['choixReal'];
        require "view/formulaires/modifierFilm.php";
    }

   
}
