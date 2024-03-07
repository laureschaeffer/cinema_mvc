<?php
// fichier qui recupere les fonctions du manager correspondant

namespace Controller;
use Model\ActeurManager;
use Service\CompressImg;

class ActeurController{
    // liste de tous les acteurs
    public function listActeurs(){
        $acteurManager = new ActeurManager();

        $acteurs = $acteurManager->listActeurs();

        require "view/personnes/listeActeurs.php";
    }

    
    // detail d'un acteur
    public function detailActeur($id) {
        $acteurManager = new ActeurManager();
        
        $data = $acteurManager->detailActeur($id);
        //infos de l'acteur
        $acteurs = $data['requeteActeur'];
        //filmographie
        $films = $data['acteurFilmographie'];
        
        require "view/personnes/detailActeur.php";
        
    }

    // lien vers le formulaire ajout acteur
    public function formActeur(){
        require "view/formulaires/ajouterActeur.php";
    }

    //traite les données du formulaire 
    public function traitementActeur(){
        $acteurManager = new ActeurManager();
        if(isset($_POST['submit'])){
            // recupere l'image dans la fonction file()
            $compressImg = new CompressImg();
            //la fonction file attend en parametre string lien ou telecharger l'image
            $lienPhoto= $compressImg->file('public/img/personnes/');

            
            // ------------------------- les input ------------------
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biographie= filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nom && $prenom && $sexe && $dateAnniv && $biographie){
                $acteurManager->ajoutActeur($nom, $prenom, $sexe, $dateAnniv, $biographie, $lienPhoto);
            } else{
                header("Location:index.php");
                exit;
            }

    }
}

    //redirige vers le formulaire de modification et affiche les infos nécessaires
    public function modifieActeur($id){
        $acteurManager = new ActeurManager();
        //infos (on ne peut pas réutiliser celle de detail car il y a un concat 'prenom nom')
        $acteurs = $acteurManager->formSelectAct($id);

        require "view/formulaires/modifierActeur.php";

    }

}