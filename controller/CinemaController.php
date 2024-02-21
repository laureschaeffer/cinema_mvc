<?php
// fichier qui crée la landing page
namespace Controller;
use Model\Connect;

class CinemaController {
    //-------------------------------------------------------requetes des listes------------------------------------------
    
    public function viewHomePage(){
        $pdo = Connect::seConnecter();
        $requeteHomeActeur = $pdo->prepare("SELECT CONCAT(prenom, ' ', nom) AS acteur, photo, biographie, id_personne FROM personne WHERE id_personne IN (3, 4, 7, 29)");
        $requeteHomeActeur->execute();
        require "view/home.php";
    }
}