<?php   //controller frontal

// on appelle tous les controlleurs 

use Controller\ActeurController;
use Controller\HomeController;
use Controller\FilmController;
use Controller\RealController;
use Controller\GenreController;
use Controller\RoleController;


// chargent toutes les classes sous le systeme d'exploitation de linux (Docker lance les conteneurs sous linux)
spl_autoload_register(function ($class_name) {
    require str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . '.php';
}) ;


// ici classes des controlleurs 
$ctrlHome = new HomeController();
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
        case "homePage" : $ctrlHome->viewHomePage(); break ;
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

        // redirige vers les formulaires d'ajout
        case "formulaireFilm" : $ctrlFilm->addFilm(); break ; 
        case "formGenre": $ctrlGenre->formGenre() ; break ;
        case "formReal": $ctrlReal->formReal(); break;
        case "formActeur" : $ctrlActeur->formActeur(); break; 

        //redirige vers les formulaires de modification
        case "modifierFilm" : $ctrlFilm->modifieFilm($id); break; 
        case "modifierActeur": $ctrlActeur->modifieActeur($id); break;
        case "modifierReal" : $ctrlReal->modifieReal($id); break;


        //-----------------traitement des données (action du formulaire)
        // ajouts
        case "ajouterFilm" : $ctrlFilm->traitementFilm() ; break;
        case "ajoutAct" : $ctrlActeur->traitementActeur(); break; 
        case "ajoutReal" : $ctrlReal->traitementReal(); break;
        // case "ajoutGenre" : $mngGenre->ajoutGenre(); break;
        // // modifier un film
        // case "ajouterModification" : $ctrlFilm->modifierFilmBDD($id); break;
        
            
    }
} else {
    $ctrlHome->viewHomePage();
}
