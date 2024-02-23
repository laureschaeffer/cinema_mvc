<?php   //fichier qui traite toutes les fonctions à travers l'url

// on appelle tous les controlleurs 

use Controller\ActeurController;
use Controller\CinemaController;
use Controller\FilmController;
use Controller\RealController;
use Controller\GenreController;
use Controller\RoleController;

// chargent toutes les classes sous le systeme d'exploitation de linux (Docker lance les conteneurs sous linux)
spl_autoload_register(function ($class_name) {
    require str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . '.php';
}) ;


// ici classes des controlleurs 
$ctrlCinema = new CinemaController();
$ctrlFilm = new FilmController();
$ctrlReal = new RealController();
$ctrlActeur = new ActeurController(); 
$ctrlGenre = new GenreController();
$ctrlRole = new RoleController();


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
$id= (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){ 
        //homepage
        case "homePage" : $ctrlCinema->viewHomePage(); break ;
        //listes
        case "listFilms": $ctrlFilm->listFilms(); break;
        case "listReals": $ctrlReal->listReals(); break;
        case "listActeurs" : $ctrlActeur->listActeurs(); break;
        case "listGenres" : $ctrlGenre->listGenres(); break;
        
        //details
        case "detailActeur": $ctrlActeur->detailActeur($id); break;
        case "detailReal" : $ctrlReal->detailReal($id); break;
        case "detailFilm": $ctrlFilm->detailFilm($id); break;
        case "detailGenre" : $ctrlGenre->detailGenre($id); break;
        case "listeRole" : $ctrlRole->listRole($id); break;

        
        // redirige vers les formulaires, liens dans les listes 
        case "formulaireFilm" : $ctrlFilm->showList(); break ;    // fonction qui contient les requetes pour avoir accès a la liste deroulante
        case "modifierFilm" : $ctrlFilm->showListFilm($id); break; 
        case "formGenre": $ctrlGenre->formGenre() ; break ;
        case "formReal": $ctrlReal->formReal(); break;
        case "formActeur" : $ctrlActeur->formActeur(); break; 
        //-------------------------------------------------traitement des données---------------------------------------------------
        case "ajouterFilm" : $ctrlFilm->ajouterFilm() ; break;
        case "ajoutAct" : $ctrlActeur->ajoutActeur(); break; 
        case "ajoutReal" : $ctrlReal->ajoutRealisateur(); break;
        case "ajoutGenre" : $ctrlGenre->ajoutGenre(); break;
        // modifier un film
        case "ajouterModification" : $ctrlFilm->modifierFilmBDD($id); break;
        
            
    }
} else {
    $ctrlCinema->viewHomePage();
}
