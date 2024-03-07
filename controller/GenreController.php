<?php //fichier qui appelle les fonctions du manager


namespace Controller;

use Model\Connect;
use Model\GenreManager;


class GenreController {

    //liste de tous les genres
    public function listGenres(){
        $genreManager = new GenreManager();

        $genres = $genreManager->findAll();

        require "view/listeGenres.php";
    }


    // detail d'un genre
    public function detailGenre($id){
        $pdo = Connect::seConnecter();
        $genreManager = new GenreManager();

        $genres = $genreManager->detailGenre($id);

        require "view/detailGenre.php"; 

    }

    // lien vers le formulaire ajout genre
    public function formGenre(){
        require "view/formulaires/ajouterGenre.php";
    }

    //enregistre le nouveau genre
    public function traiteGenre(){

        $genreManager = new GenreManager();

        if(isset($_POST['submit'])){
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($nom){
                $genreManager->ajoutGenre($nom);
            } else{
                header("Location:index.php");
            }
        }
    }


}