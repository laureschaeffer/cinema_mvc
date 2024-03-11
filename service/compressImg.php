<?php //fichier pour la fonction traitement de l'image téléchargée avec compression en imagewebp

namespace Service;

class CompressImg{

    //traite l'image, attend en parametre le lien ou la telecharger
    public function traiteImg(string $lien){

        //si l'image est téléchargée
            if($_FILES["file"]["error"] <> 4) {
                $tmpName = $_FILES['file']['tmp_name'];
                $fileName1= $_FILES['file']['name'];
                //possible de mettre du script dans le nom
                $fileName = filter_var($fileName1, FILTER_SANITIZE_SPECIAL_CHARS);
                $fileSize = $_FILES['file']['size'];
                $fileError= $_FILES['file']['error'];
                // https://www.php.net/manual/en/features.file-upload.errors.php
                $fileType = $_FILES['file']['type'];
    
                // récupère l'extension .jpg, ...
                $label = explode(".", $fileName);
                $extension = strtolower(end($label));
    
                // ----crée un identifiant unique, et rajoute l'extension 
                $uniqueName= uniqid("", true);
                $newFileName = $uniqueName.'.webp';
                
                // taille max
                $maxSize = 40000000;
                $newFileName = $uniqueName.".".$extension;
                            
                //chemin dans la bdd, $lien est different pour affiche (film) et img (personnes)
                $lienAffiche=$lien.$newFileName;
                
                $extensionsAutorisees= ["jpg", "jpeg", "gif", "png"];
                //si l'extension fait parti de celles autorisées dans le tableau, et qu'aucune erreur n'est apparu, alors je latélécharge
                if(in_array($extension, $extensionsAutorisees) && $fileSize <=$maxSize && $fileName){
                    //crée l'image en fichier webp qui est compressé, moins lourd et donc plus rapide à etre téléchargé
                    imagewebp(imagecreatefromstring(file_get_contents($tmpName)), $lienAffiche);
                    } 
            } elseif($_FILES["file"]["error"]==1 || $_FILES["file"]["error"]==2){
                //si l'image téléchargée est trop volumineuse
                echo "<div class='msg_confirmation'<p>Fichier trop volumineux, réessayez</p></div>";
            } elseif($_FILES["file"]["error"]==3){
                //probleme de téléchargement
                echo "<div class='msg_confirmation'<p>Erreur de téléchargement, réessayez</p></div>" ;
            }  else {
                //les autres erreurs sont également des pb de téléchargement
                $lienAffiche= "https://placehold.co/600x400";//image par défaut
            } 

        return $lienAffiche;
    }
}