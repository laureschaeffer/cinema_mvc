<?php
// fichier qui crée les fonctions pour la table genre, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
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
        $requeteDetailGenre = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, d.id_genre, g.nom, f.id_film
        FROM definir d
        INNER JOIN film f ON d.id_film = f.id_film
        INNER JOIN genre g ON d.id_genre = g.id_genre
        WHERE d.id_genre= :id");
        $requeteDetailGenre->execute(["id" =>$id]);

        require "view/detailGenre.php"; 
    }

    // lien vers le formulaire ajout genre
    public function formGenre(){
        require "view/formulaires/ajouterGenre.php";
    }

    // ------formulaire------
    public function ajoutGenre(){
        if(isset($_POST['submit'])){
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($nom){
                $pdo = Connect::seConnecter();
                $ajouterGenreBDD = $pdo->prepare("INSERT into genre(nom) VALUES(:nom)");
                $ajouterGenreBDD->execute(["nom"=>$nom]);

                $idGenre = $pdo->lastInsertId();

                header("Location:index.php?action=detailGenre&id=$idGenre"); // redirige vers la page du genre nouvellement créé
                exit;
            }
        } else{
            header("Location:index.php");
        }
    }
}