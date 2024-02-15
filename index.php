<?php
//fichier qui traite toutes les fonctions à travers l'url
use Controller\CinemaController;


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
// cherche automatiquement toutes les classes 


$ctrlCinema = new CinemaController();


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
$id= (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){ 
        //listes
        case "listFilms": $ctrlCinema->listFilms(); break;
        case "listReals": $ctrlCinema->listReals(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listGenres" : $ctrlCinema->listGenres(); break;
        
        //details
        case "detailActeur": $ctrlCinema->detailActeur($id); break;
        case "detailReal" : $ctrlCinema->detailReal($id); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;
        case "detailGenre" : $ctrlCinema->detailGenre($id); break;
        case "listeRole" : $ctrlCinema->listRole($id); break;

        //formulaire
        // case "ajouterFilm" : $ctrlCinema->listReals(); break ;
            
    }
} else {
    $ctrlCinema->listFilms();
}
