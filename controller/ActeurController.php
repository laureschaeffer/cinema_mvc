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

    //traite les données du formulaire d'ajout
    public function traitementActeur(){
        $acteurManager = new ActeurManager();
        if(isset($_POST['submit'])){
            if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée

                // recupere l'image dans la fonction file()
                $compressImg = new CompressImg();
                $lienPhoto= $compressImg->traiteImg('public/img/personnes/', $_FILES['file']); //la fonction file attend en parametre string lien pour savoir ou telecharger l'image
            } else{
                $lienPhoto= "https://placehold.co/600x400";//image par défaut
            }
            
            // ------------------------- les input ------------------
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biographie= filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nom && $prenom && $sexe && $dateAnniv && $biographie){
                $acteurManager->ajoutActeur($nom, $prenom, $sexe, $dateAnniv, $biographie, $lienPhoto);

                $_SESSION['messages'] = "<div class='msg_confirmation'><p>Acteur $nom ajouté</p></div>"; //message de confirmation

                $pdo = Connect::seConnecter();
                $idActeur=$pdo->lastInsertId(); //recupere le dernier id créé
                header("Location:index.php?action=detailActeur&id=$idActeur"); // redirige vers la page du nouveau realisateur
                exit;
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

    //traite les infos du formulaire de modification
    public function traiteModifAct($id){
        $acteurManager = new ActeurManager();

        
        if(isset($_POST['submit'])){
            //recupere l'image dans la fonction traiteImg()
            $compressImg = new CompressImg();
            if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée
                     
            // recupere l'image dans la fonction traiteImg()
                $compressImg = new CompressImg();
                $lienPhoto= $compressImg->traiteImg('public/img/affiches/', $_FILES['file']); //la fonction file attend en parametre string lien pour savoir ou telecharger l'image
            } else{
                $lienPhoto= "https://placehold.co/600x400";//image par défaut
            }
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biographie = filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //si ces elements sont filtres correctement (et ne renvoient pas false), alors on les rentre dans la bdd avec la fonction dans le manager
            if($prenom && $nom && $sexe && $dateAnniv && $biographie){
                $acteurManager->modifierActBDD($prenom, $nom, $sexe, $dateAnniv, $biographie, $lienPhoto, $id);

                $_SESSION['messages'] = "<div class='msg_confirmation'><p>Acteur $nom modifié</p></div>"; //message de confirmation

                //tableau contenant id_acteur et id_pers
                $acteurs=$acteurManager->findAct($id); 
                $idAct= $acteurs["id_acteur"];

                header("location:index.php?action=detailActeur&id=$idAct");
                exit;
            } else {
                header("location:index.php");
                exit;
            }
        }

    }

    //supprimer un acteur dans la bdd
    public function redirigeSupprAct($id){
        $acteurManager = new ActeurManager();
        $acteurManager->supprimerActeur($id); //supprime l'acteur mais pas la personne

        $_SESSION['messages'] = "Acteur supprimé";
        header("location:index.php?action=listActeurs");
        exit;
    }

}