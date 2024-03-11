<?php
// fichier qui recupere les fonctions du manager correspondant 

namespace Controller;
use Model\Connect;
use Model\FilmManager;
use Service\CompressImg;
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
        $filmManager = new FilmManager();
        $data = $filmManager->detailFilm($id);
        
        //tableau qui renvoie un fetch et deux fetchall
        $detailFilm = $data['requeteDetailFilm'];
        $requeteCasting = $data['requeteCasting'];
        $requeteGenreFilm = $data['requeteGenreFilm'];

        require "view/film/detailFilm.php";
        

    }
// --------------------------------------------------------------------formulaires-------------------------------------------------- 

    public function addFilm(){ // requete pour les listes déroulantes du formulaire
        $filmManager = new FilmManager();

        $data = $filmManager->formSelect();

        $choixReal = $data['choixReal'];
        $choixGenre = $data['choixGenre'];
   
        require "view/formulaires/ajouterFilm.php";
    }

     // traite les données du formulaire ajout d'un film
    public function traitementFilm(){
        $filmManager = new FilmManager();

        if(isset($_POST['submit'])){ // si la session récupère les infos avec le bouton submit
            if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée

                // recupere l'image dans la fonction file()
                $compressImg = new CompressImg();
                $lienAffiche= $compressImg->traiteImg('public/img/affiches/', $_FILES['file']); //la fonction file attend en parametre string lien pour savoir ou telecharger l'image
            } else{
                $lienAffiche= "https://placehold.co/600x400";//image par défaut
            }

            
            // -----------ensuite traitement des input-----

            // filtres les caractères pour la sécurité
            $titre= filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie= filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $resume= filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note= filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $genres = filter_input(INPUT_POST, "genres", FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);

            //si ces éléments sont filtrés correctement, alors on les execute dans values 
            if($titre && $resume && $anneeSortie && $duree && $note && $genres){

                // Ajouter les données récupérées à la bdd à l'aide de la requete sql
                $idFilm = $filmManager->ajouterFilm($titre, $anneeSortie, $duree, $resume, $note, $genres, $lienAffiche);
                $_SESSION['messages'] = "<div class='msg_confirmation'><p>Film $titre ajouté</p></div>";
                header("Location:index.php?action=detailFilm&id=$idFilm");
                exit;
            } else{
                header("Location:index.php");
                exit;
            }

        }
    }

   
    //affiche les infos d'un film dans le formulaire de modification et redirige vers ce formulaire
    public function modifieFilm($id){
        $filmManager = new FilmManager();

        //toutes les infos du film
        $data = $filmManager->formSelectFilm($id);
        $requeteDetailFilm = $data['requeteDetailFilm']; //renvoie fetch
        
        //pour afficher le genre, methode deja dans le genremanager
        $genreManager = new GenreManager();
        $genres = $genreManager->findAll();

        // choix du réalisateur
        $choixReal = $data['choixReal']; //renvoie fetchAll
        require "view/formulaires/modifierFilm.php";
    }

    //traite les infos du formulaire de modification
    public function traiteModifFilm($id){
        $filmManager = new FilmManager();

        // si la session récupère les infos avec le bouton submit
        if(isset($_POST['submit'])){

            
            $titre= filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $synopsis= filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee_sortie_fr= filter_input(INPUT_POST, "annee_sortie_fr", FILTER_VALIDATE_INT);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $note= filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $genres = filter_input(INPUT_POST, "genres", FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
            
            //si ces éléments sont filtrés correctement, alors on les rentre dans la bdd avec la fonction du manager
            if($titre && $synopsis && $annee_sortie_fr && $duree && $note && $genres){
                
                if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, on modifie la bdd avec la fonction complete
                    
                    // recupere l'image dans la fonction traiteImg()
                    $compressImg = new CompressImg();
                    $lienAffiche= $compressImg->traiteImg('public/img/affiches/', $_FILES['file']); //la fonction file attend en parametre string lien pour savoir ou telecharger l'image
                    $filmManager->modifierFilmBDD($titre, $annee_sortie_fr, $duree, $synopsis, $note, $lienAffiche, $genres, $id);
                 } else {
                    //s'il n'y a pas de téléchargement d'image, pour ne pas l'écraser on utilise une autre fonction
                    $filmManager->modifierFilmBDDSansImg($titre, $annee_sortie_fr, $duree, $synopsis, $note, $genres, $id);
                 }

                $_SESSION['messages'] = "<div class='msg_confirmation'><p>Film $titre modifié</p></div>";
                header("Location:index.php?action=detailFilm&id=$id");
                exit;
              }

            }

    }

    //supprimer un film dans la bdd
    public function redirigeSuppr($id){
        $filmManager = new FilmManager();
        $filmManager->supprimerFilm($id);

        $_SESSION['messages'] = "Film supprimé";
        header("location:index.php?action=listFilms");
        exit;
    }
}
