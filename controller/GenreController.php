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
    public function traitementGenre(){

        $genreManager = new GenreManager();

        if(isset($_POST['submit'])){
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($nom){
                $genreManager->ajoutGenre($nom);

                $_SESSION['messages'][] = "Genre $nom ajouté";
                
                $idGenre = $pdo->lastInsertId();
                header("Location:index.php?action=detailGenre&id=$idGenre"); // redirige vers la page du genre nouvellement créé
               exit;
            } else{
                header("Location:index.php");
            }
        }
    }


}