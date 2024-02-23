<?php
// fichier qui crée les fonctions pour la table genre, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
namespace Controller;
use Model\Connect;

class GenreController{
    // liste des genres
    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requeteLsGenre = $pdo->query(
            "SELECT nom, id_genre
            FROM genre
            ORDER BY nom"
        );

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
            }
        }
        header("Location:index.php"); // redirige vers la page par defaut
        exit;
    }
}