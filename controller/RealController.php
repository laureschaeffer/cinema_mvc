<?php
// fichier qui recupere les fonctions du manager correspondant 

namespace Controller;
use Model\Connect;
use Model\RealisateurManager;
use Service\CompressImg;


class RealController{
    // liste de tous les reals
    public function listReals(){
        $pdo = Connect::seConnecter();
        $realisateurManager= new RealisateurManager();

        $realisateurs = $realisateurManager->listReals();
    

        require "view/personnes/listeReals.php";
    }

    // detail d'un real
    public function detailReal($id){
        $pdo = Connect::seConnecter();
        $realisateurManager= new RealisateurManager();

        $data = $realisateurManager->detailReal($id);
        //infos du realisateur
        $realisateurs = $data['requeteReal'];
        //filmographie
        $films = $data['realFilmographie'];

        require "view/personnes/detailReal.php";

    }
    // lien vers le formulaire ajout realisateur
    public function formReal(){
        require "view/formulaires/ajouterReal.php";
    }

    //traitement des input dans le formulaire d'ajout
    public function traitementReal(){
        $realisateurManager = new RealisateurManager();
        if(isset($_POST['submit'])){
            
            // recupere l'image dans la fonction file()
            $compressImg = new CompressImg();
            //la fonction file attend en parametre string lien ou telecharger l'image
            $lienPhoto= $compressImg->file('public/img/personnes/');


            // --------input ----------
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // format date est reçu en string
            $biographie= filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nom && $prenom && $sexe && $dateAnniv && $biographie){
                $realisateurManager->ajoutRealisateur($nom, $prenom, $sexe, $dateAnniv, $biographie, $lienPhoto);

                $_SESSION['messages'][] = "Realisateur $nom ajouté"; //msg confirmation

                $idReal=$pdo->lastInsertId(); // recupere le dernier id créé
                header("Location:index.php?action=detailReal&id=$idReal"); // redirige vers la page du realisateur nouvellement créé
            } else{
                header("Location:index.php");
                exit;
            }
    }
    }


    //redirige vers le formulaire de modification et affiche les infos
    public function modifieReal($id){
        $realisateurManager = new RealisateurManager();

        //infos (on ne peut pas réutiliser celle de detail car il y a un concat 'prenom nom')
        $realisateurs = $realisateurManager->formSelectReal($id);

        require "view/formulaires/modifierReal.php";
    }

    //traite les infos du formulaire modifié
    public function traiteModifReal($id){
        $realisateurManager = new RealisateurManager();

        //recupere l'image dans la fonction file()
        $compressImg = new CompressImg();
        //la fonction file attend en parametre string lien ou telecharger l'image
        $lienPhoto= $compressImg->file('public/img/personnes/');

        if(isset($_POST['submit'])){
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biographie = filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //si ces elements sont filtres correctement (et ne renvoient pas false), alors on les rentre dans la bdd avec la fonction dans le manager
            if($prenom && $nom && $sexe && $dateAnniv && $biographie){
                $realisateurManager->modifierRealBDD($prenom, $nom, $sexe, $dateAnniv, $biographie, $lienPhoto, $id);

                $_SESSION['messages'][] = "Realisateur $nom modifié"; //msg confirmation

                header("location: index.php?action=detailReal&id=$id");
                exit;
            } else {
                header("location: index.php");
                exit;
            }
        }

    }



}