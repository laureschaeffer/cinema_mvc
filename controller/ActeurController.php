<?php
// fichier qui crée les fonctions pour la table acteur, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
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
        $acteurs = $detailActeur->detailActeur($id);

        require "view/personnes/detailActeur.php";

    }

    public function ajoutActeur(){
        if(isset($_POST['submit'])){
            // ----------------------d'abord traitement de l'image téléchargée---------
            if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée
                $tmpName = $_FILES['file']['tmp_name'];
                $fileName= $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $fileError= $_FILES['file']['error'];
                // https://www.php.net/manual/en/features.file-upload.errors.php
                $fileType= $_FILES['file']['type'];

                // récupère l'extension .jpg, ...
                $label = explode(".", $fileName);
                $extension = strtolower(end($label));

                // ----crée un identifiant unique, et rajoute l'extension 
                $extensionsAutorisees= ["jpg", "jpeg", "gif", "png"];
                $uniqueName= uniqid("", true);
                $newFileName = $uniqueName.'.webp';

                $lienPhoto='public/img/personnes/'.$newFileName;
                //si l'extension fait parti de celles autorisées dans le tableau, et qu'aucune erreur n'est apparu, alors je la télécharge
                if(in_array($extension, $extensionsAutorisees) && $fileError==0){
                    // move_uploaded_file($tmpName, $lienPhoto);
                    imagewebp(imagecreatefromstring(file_get_contents($tmpName)), $lienPhoto);
                } 
                
            }  else{ //pour ne pas avoir d'erreur dans l'execute plus bas
                $lienPhoto= "https://placehold.co/600x400";//image par défaut
            }
            // ------------------------- les input ------------------
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $biographie= filter_input(INPUT_POST, "biographie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nom && $prenom && $sexe && $dateAnniv && $biographie){

                $pdo = Connect::seConnecter();
                $ajouterPers = $pdo->prepare("INSERT INTO personne(nom, prenom, sexe, date_naissance, photo, biographie) VALUES(:nom, :prenom, :sexe, :date_naissance, :photo, :biographie)");
                $ajouterPers->execute([
                    "nom"=> $nom,
                    "prenom" => $prenom,
                    "sexe" => $sexe,
                    "date_naissance" => $dateAnniv,
                    "photo" => $lienPhoto,
                    "biographie" => $biographie,
                ]);
    
                // dans la table acteur j'ajoute l'id de la personne nouvellement créé, et l'id acteur est en auto-increment
                $ajoutReal = $pdo->prepare("INSERT INTO acteur (id_personne)
                VALUES (:id_personne)");
                $ajoutReal->execute(["id_personne" => $pdo->lastInsertId()]);

            }
            header("Location:index.php"); // redirige vers la page par defaut
            exit;
        }
    }



}