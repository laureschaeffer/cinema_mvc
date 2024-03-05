<?php
// fichier qui crée la landing page
namespace Controller;
use Model\Connect;
use Model\CinemaManager;

class CinemaController {
    //-------------------------------------------------------landing page------------------------------------------
    
    //choix de 4 acteurs pour les articles
    public function viewHomePage(){
        $pdo = Connect::seConnecter();
        $cinemaManager = new CinemaManager();

        $acteurs = $cinemaManager->viewHomePage();

        require "view/home.php";
    }

}