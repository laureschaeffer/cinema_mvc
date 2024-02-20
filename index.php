<?php
//fichier qui traite toutes les fonctions à travers l'url
use Controller\CinemaController;



// cherche automatiquement toutes les classes 

// spl_autoload_register(function ($class_name) {
//     include $class_name . '.php';
// });

// chargent toutes les classes sous le systeme d'exploitation de linux (Docker lance les conteneurs sous linux)
spl_autoload_register(function ($class_name) {
    require str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . '.php';
}) ;


$ctrlCinema = new CinemaController();


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
$id= (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){ 
        //homepage
        case "homePage" : $ctrlCinema->viewHomePage(); break ;
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

        // fonction qui contient les requetes pour avoir accès aux listes deroulantes
        case "formulaireFilm" : $ctrlCinema->showList(); break ;

        //-------------------------------------------------traitement des données---------------------------------------------------
        case "ajouterFilm" : $ctrlCinema->ajouterFilm() ; break;
        case "modifierFilm" : $ctrlCinema->showListFilm($id); break; 
        case "ajouterModification" : $ctrlCinema->modifierFilmBDD(); break;
        
            
    }
} 
else {
    $ctrlCinema->listFilms();
}
