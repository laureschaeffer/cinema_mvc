<?php
use Controller\CinemaController;


spl_autoload_register(function ($class_name) {
    require $class_name . '.php';
});
// cherche automatiquement toutes les classes 


$ctrlCinema = new CinemaController();


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
$id= (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){ 
        case "listFilms": $ctrlCinema->listFilms(); break;
        case "listReals": $ctrlCinema->listReals(); break;
        case "detActeur": $ctrlCinema->detActeur($id); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;
        case "detailCasting": $ctrlCinema->detailCasting($id); break;




    }
}