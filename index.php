<?php
//fichier qui traite toutes les fonctions à travers l'url
use Controller\CinemaController;


spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
// cherche automatiquement toutes les classes 


$ctrlCinema = new CinemaController();


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec la bonne méthode du controller
$id= (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){ 
        //listes
        case "listFilms": $ctrlCinema->listFilms(); break;
        case "listReals": $ctrlCinema->listReals(); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "listGenres" : $ctrlCinema->listGenres(); break;
        
        //details
        case "detailActeur": $ctrlCinema->detailActeur($id); break;
        case "detailReal" : $ctrlCinema->detailReal($id); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;
        case "detailGenre" : $ctrlCinema->detailGenre($id); break;
        case "listeRole" : $ctrlCinema->listRole($id); break;

        //aller vers le formulaire depuis la navbar
        case "formulaireFilm" : $ctrlCinema->addFilm(); break ;

        //------------------------------------traitement des données-----------

        case "ajouterFilm" : 
            if(isset($_POST['submit'])){ // si la session récupère les infos avec le bouton submit

                // filtres les caractères pour la sécurité
                $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $resume= filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $role= filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $anneeSortie= filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);

                //si ces éléments sont filtrés correctement, alors on les rentre dans le tableau de la session
                if($nom && $resume && $role){

                    $nvFilm = [
                    "nom"=> $nom,
                    "resume"=>$resume,
                    "role"=>$role,
                    //récupérer les infos de la liste déroulante
                    // "acteur"=>$acteur,
                    // "realisateur"=>$realisateur,
                    // "genre"=>$genre,
                    ];
                    $_SESSION['nvFilm'][]=$nvFilm; //comme array_push mais moins lourd
                }

            }

            // ----------------------traitement de l'image téléchargée---------
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
                $newFileName = $uniqueName.'.'.$extension ;

                //si l'extension fait parti de celles autorisées dans le tableau, et qu'aucune erreur n'est apparu, alors je la télécharge et l'ajoute à la session
                if(in_array($extension, $extensionsAutorisees) && $fileError==0){
                    move_uploaded_file($tmpName, 'public/img/upload'.$newFileName);
                }
                $_SESSION['nameFile'][]=$newFileName;
            }
            var_dump($_SESSION);
            // header('Location:index.php');
            // exit;
            break;
            
    }
} else {
    $ctrlCinema->listFilms();
}
