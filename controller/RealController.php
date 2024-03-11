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
        //si data recupere quelque chose, et donc que la requete a fonctionné, alors fetch
        if($data){
            //infos du realisateur
            $realisateurs = $data['requeteReal'];
            //filmographie
            $films = $data['realFilmographie'];

        }

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
            
            // recupere l'image dans la fonction traiteImg()
            $compressImg = new CompressImg();
            if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée
                 
                // recupere l'image dans la fonction traiteImg()
                $compressImg = new CompressImg();
                $lienAffiche= $compressImg->traiteImg('public/img/affiches/', $_FILES['file']); //la fonction file attend en parametre string lien pour savoir ou telecharger l'image
            } else{
                $lienAffiche= "https://placehold.co/600x400";//image par défaut
            }


            // --------input ----------
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // format date est reçu en string
            $biographie= filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nom && $prenom && $sexe && $dateAnniv && $biographie){
                $realisateurManager->ajoutRealisateur($nom, $prenom, $sexe, $dateAnniv, $biographie, $lienPhoto);

                $_SESSION['messages'] = "<div class='msg_confirmation'><p>Realisateur $nom ajouté</p></div>"; //msg confirmation

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

        //recupere l'image dans la fonction traiteImg()
        $compressImg = new CompressImg();
        if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée
                 
            // recupere l'image dans la fonction traiteImg()
            $compressImg = new CompressImg();
            $lienPhoto= $compressImg->traiteImg('public/img/affiches/', $_FILES['file']); //la fonction file attend en parametre string lien pour savoir ou telecharger l'image
        } else{
            $lienPhoto= "https://placehold.co/600x400";//image par défaut
        }

        if(isset($_POST['submit'])){
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biographie = filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //si ces elements sont filtres correctement (et ne renvoient pas false), alors on les rentre dans la bdd avec la fonction dans le manager
            if($prenom && $nom && $sexe && $dateAnniv && $biographie){
                $realisateurManager->modifierRealBDD($prenom, $nom, $sexe, $dateAnniv, $biographie, $lienPhoto, $id);

                $_SESSION['messages'] = "<div class='msg_confirmation'><p>Realisateur $nom modifié</p></div>"; //msg confirmation

                //tableau contenant id_real et id_pers
                $reals=$realisateurManager->findReal($id); 
                $idReal= $reals["id_realisateur"];

                header("location: index.php?action=detailReal&id=$idReal");
                exit;
            } else {
                header("location: index.php");
                exit;
            }
        }
    }

    //supprimer un realisateur dans la bdd
    public function redirigeSupprReal($id){
        $realisateurManager = new RealisateurManager();
        $realisateurManager->supprimerReal($id);

        $_SESSION['messages'] = "Réalisateur supprimé";
        header("Location:index.php?action=listReals");
        exit;
    }



}