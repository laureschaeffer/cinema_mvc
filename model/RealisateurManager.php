<?php //fichier qui traite les requetes sql

namespace Model;

class RealisateurManager extends Manager{
    protected $tableName = "realisateur";

    //liste
    public function listReals(){
        $pdo = Connect::seConnecter();
        $requeteLsReal = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, r.id_realisateur, p.photo
            FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne
            ORDER BY nomReal"
        );
    

        return $requeteLsReal->fetchAll();
    }

    //detail d'un realisateur
    public function detailReal($id){
        $pdo = Connect::seConnecter();

        $realisateur = $pdo->prepare("SELECT id_realisateur FROM realisateur WHERE id_realisateur = :id");
        $realisateur->execute(["id" => $id]);
        $real = $realisateur->fetch();

        // si l'id de l'url demandé existe dans la bdd
        if($real){
            $requeteReal = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, p.photo, p.biographie, p.sexe, r.id_realisateur
            FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne
            WHERE id_realisateur = :id");
            $requeteReal->execute(["id" => $id]);
            
    
            // deuxième requete pour afficher la filmographie
            $realFilmographie = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, f.id_film  
            FROM film f
            INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
            INNER JOIN personne p ON r.id_personne = p.id_personne
            WHERE r.id_realisateur = :id");
            $realFilmographie->execute(["id"=> $id]);
            
            //tableau pour return tous les fetch
            $data = ["requeteReal"=> $requeteReal->fetch(),
            "realFilmographie"=>$realFilmographie->fetchAll()];
            return $data;
    
        } else {
            header("Location: index.php"); exit;
        }

    }

    // -----------------------------------------formulaire-------------------
  
    // fonctions ajout real
    public function ajoutRealisateur(){
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

                // --------input ----------

            } else{ //pour ne pas avoir d'erreur dans l'execute plus bas
                $lienPhoto= "https://placehold.co/600x400"; //image par défaut
            }
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom= filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateAnniv = filter_input(INPUT_POST, "anniversaire", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // format date est reçu en string
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

                // dans la table réalisateur j'ajoute l'id de la personne nouvellement créé, et l'id réalisateur est en auto-increment
                $ajoutReal = $pdo->prepare("INSERT INTO realisateur (id_personne) VALUES (:id_personne)");
                $idReal=$pdo->lastInsertId(); // recupere le dernier id créé
                $ajoutReal->execute(["id_personne" => $idReal]);

                header("Location:index.php?action=detailReal&id=$idReal"); // redirige vers la page du realisateur nouvellement créé
                exit;
            } else{
                header("Location:index.php");
                exit;
            }

            


        }
    }





    //getters et setters
    public function getTableName()
    {
        return $this->tableName;
    }


    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }



}