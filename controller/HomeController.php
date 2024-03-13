<?php
// fichier qui crée la landing page
namespace Controller;
use Model\Connect;
use Model\HomeManager;

class HomeController {
    //-------------------------------------------------------landing page------------------------------------------
    
    //choix de 4 acteurs pour les articles
    public function viewHomePage(){
        $pdo = Connect::seConnecter();
        $homeManager = new HomeManager();

        $data = $homeManager->viewHomePage();
        //fetchAll de 4 acteurs du moment
        $topActeurs = $data["requeteHomeActeur"];
        //fetchAll du calcul des 3 acteurs les plus presents
        $acteursPresents = $data["requeteActeurPresent"];

        require "view/home.php";
    }



}