<?php
// fichier qui recupere les fonctions du manager correspondant

namespace Controller;
use Model\Connect;
use Model\ActeurManager;

class ActeurController{
    // liste de tous les acteurs
    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $acteurManager = new ActeurManager();

        $acteurs = $acteurManager->listActeurs();

        require "view/personnes/listeActeurs.php";
    }

    // lien vers le formulaire ajout acteur
    public function formActeur(){
        require "view/formulaires/ajouterActeur.php";
    }

    // detail d'un acteur
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $acteurManager = new ActeurManager();

        $data = $acteurManager->detailActeur($id);
        //infos de l'acteur
        $acteurs = $data['requeteActeur'];
        //filmographie
        $films = $data['acteurFilmographie'];

        require "view/personnes/detailActeur.php";

    }

}