<?php //fichier pour la fonction traitement de l'image téléchargée avec compression en imagewebp

namespace Service;

class CompressImg{

    //traite l'image, attend en parametre le lien ou la telecharger
    public function file(string $lien){
        
        
        if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée
            if($_FILES["file"]["error"] <> 4) {
                $tmpName = $_FILES['file']['tmp_name'];
                $fileName1= $_FILES['file']['name'];
                //possible de mettre du script dans le nom
                $fileName = filter_var($fileName1, FILTER_SANITIZE_SPECIAL_CHARS);
                $fileSize = $_FILES['file']['size'];
                $fileError= $_FILES['file']['error'];
                // https://www.php.net/manual/en/features.file-upload.errors.php
    
                // récupère l'extension .jpg, ...
                $label = explode(".", $fileName);
                $extension = strtolower(end($label));
    
                // ----crée un identifiant unique, et rajoute l'extension 
                $uniqueName= uniqid("", true);
                $newFileName = $uniqueName.'.webp';
                
                // taille max
                $maxSize = 40000000;
                
                //chemin dans la bdd, $lien est different pour affiche (film) et img (personnes)
                $lienAffiche=$lien.$newFileName;
                
                $extensionsAutorisees= ["jpg", "jpeg", "gif", "png"];
                //si l'extension fait parti de celles autorisées dans le tableau, et qu'aucune erreur n'est apparu, alors je latélécharge
                if(in_array($extension, $extensionsAutorisees) && $fileError==0 && $fileSize <=$maxSize && $fileName){
                    // move_uploaded_file($tmpName, $lienAffiche);
                    //crée l'image en fichier webp qui est compressé, moins lourd et donc plus rapide à etre téléchargé
                    imagewebp(imagecreatefromstring(file_get_contents($tmpName)), $lienAffiche);
                    } 
                } 
        } else {
            $lienAffiche= "https://placehold.co/600x400";//image par défaut
        }

        return $lienAffiche;
    }
}