<?php
// fichier qui crée les fonctions, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
namespace Controller;
use Model\Connect;

class CinemaController {
    //-------------------------------------------------------requetes des listes------------------------------------------
    
    public function viewHomePage(){
        $pdo = Connect::seConnecter();
        $requeteHomeActeur = $pdo->prepare("SELECT CONCAT(prenom, ' ', nom) AS acteur, photo, biographie FROM personne
        WHERE id_personne IN (3, 4, 7, 29)");
        $requeteHomeActeur->execute();
        require "view/home.php";
    }
    
    public function listFilms(){
        $pdo = Connect::seConnecter();
        $requeteLsFilms = $pdo->query(
            'SELECT titre, annee_sortie_fr, id_film, affiche
            FROM film
            ORDER BY titre');

        require "view/film/listeFilms.php";
    }


    public function listReals(){
        $pdo = Connect::seConnecter();
        $requeteLsReal = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, r.id_realisateur, p.photo
            FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne
            ORDER BY nomReal"
        );
    

        require "view/personnes/listeReals.php";
    }

    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requeteLsActeur = $pdo->query(
            "SELECT CONCAT(p.nom, ' ', p.prenom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, a.id_acteur, p.photo
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne
            ORDER BY p.nom"
        );

        require "view/personnes/listeActeurs.php";
    }

    public function listGenres(){
        $pdo = Connect::seConnecter();
        $requeteLsGenre = $pdo->query(
            "SELECT nom, id_genre
            FROM genre
            ORDER BY nom"
        );

        require "view/listeGenres.php";
    }


    //----------------------------------------------------requetes précises (id)---------------------------------------------------

    // Lors d'une requête dans lequel on a un élément variable (id) il faut utiliser un "prepare" et pas un "query"

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, p.photo, p.biographie, p.sexe
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
        WHERE id_acteur = :id");
        $requeteActeur->execute(["id" => $id]);
        // on fait passer un tableau associatif qui associe le nom de champ paramétré avec la valeur de l'id*

        //deuxième requête pour afficher la filmographie
        $acteurFilmographie = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, r.nom_personnage, c.id_film, r.id_role
        FROM castings c
        INNER JOIN film f ON c.id_film = f.id_film
        INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_acteur= :id");
        $acteurFilmographie->execute(["id"=> $id]);
        require "view/personnes/detailActeur.php";
        
    }

    public function detailReal($id){
        $pdo = Connect::seConnecter();
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

        require "view/personnes/detailReal.php";
    }
    
    public function detailFilm($id){
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, f.synopsis, f.note, f.affiche, CONCAT(prenom, ' ', nom) AS realisateur, f.id_realisateur, f.id_film
        FROM film f
        INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE id_film = :id");
        $requeteDetailFilm->execute(["id" => $id]);

        // il est nécessaire d'utiliser une seconde requête pour le casting
        $requeteCasting = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, r.nom_personnage, c.id_acteur, c.id_role
        FROM castings c
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN personne p ON a.id_personne = p.id_personne
        INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_film = :id");
        $requeteCasting->execute(["id" => $id]);

        require "view/film/detailFilm.php";

    }

    public function listRole($id){
        $pdo = Connect::seConnecter();
        $requeteRole = $pdo->prepare("SELECT f.id_film, f.titre, f.annee_sortie_fr, r.nom_personnage, CONCAT(p.prenom, ' ', p.nom) AS nomActeur, a.id_acteur
        FROM castings c
        INNER JOIN film f ON c.id_film = f.id_film
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN role r ON c.id_role = r.id_role
        INNER JOIN personne p ON a.id_personne = p.id_personne
        WHERE r.id_role = :id");
        $requeteRole->execute(["id"=> $id]);

        require "view/film/listeRole.php"; 
    }

    public function detailGenre($id){
        $pdo = Connect::seConnecter();
        $requeteDetailGenre = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, d.id_genre, g.nom, f.id_film
        FROM definir d
        INNER JOIN film f ON d.id_film = f.id_film
        INNER JOIN genre g ON d.id_genre = g.id_genre
        WHERE d.id_genre= :id");
        $requeteDetailGenre->execute(["id" =>$id]);

        require "view/detailGenre.php"; 
    }

    // // -------------------------------------------------formulaires--------------------------------------------

    public function showList(){ // requete pour les listes déroulantes du formulaire
        $pdo = Connect::seConnecter();
        // choix du réalisateur
        $choixReal = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomReal, r.id_realisateur
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixReal->execute();

        // choix du genre d'un film
        $pdo = Connect::seConnecter();
        $choixGenre = $pdo->prepare("SELECT nom FROM genre ORDER BY nom");
        $choixGenre->execute();
   
        require "view/formulaires/ajouterFilm.php";
    }

    // recupere les données du formulaire pour les ajouter à la bdd
    public function ajouterFilm(){
        if(isset($_POST['submit'])){ // si la session récupère les infos avec le bouton submit
            
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
                $newFileName = $uniqueName.'.'.$extension ;

                $lienAffiche='public/img/affiches/'.$newFileName;
                //si l'extension fait parti de celles autorisées dans le tableau, et qu'aucune erreur n'est apparu, alors je la télécharge
                if(in_array($extension, $extensionsAutorisees) && $fileError==0){
                    move_uploaded_file($tmpName, $lienAffiche);
                } 
            }

            // -----------ensuite traitement des input-----

            // filtres les caractères pour la sécurité
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $resume= filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role= filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie= filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $note= filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            //si ces éléments sont filtrés correctement, alors on les execute dans values 
            // if($nom && $resume && $role && $anneeSortie && $duree && $note){

                // Ajouter les données récupérées à la bdd à l'aide de la requete sql
                $pdo = Connect::seConnecter();
                $ajouterFilmBDD = $pdo->prepare("INSERT into film(titre, annee_sortie_fr, duree, synopsis, note, id_realisateur, affiche) VALUES(:titre, :annee_sortie_fr, :duree, :synopsis, :note, :id_realisateur, :affiche)");
                $ajouterFilmBDD->execute([
                    'titre'=>$nom,
                    'annee_sortie_fr'=>$anneeSortie,
                    'duree'=>$duree,
                    'synopsis'=>$resume,
                    'note'=>$note,
                    'id_realisateur' => $_POST["realisateur"],
                    'affiche' => $lienAffiche, // en lien avec le traitement de l'image plus haut
                ]);

            // }

        }
        // header("Location:index.php"); // redirige vers la page par defaut, liste films
        // exit;
    }

    //pour modifier un film lorsqu'on est sur le detail d'un film
    public function showListFilm($id){
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, f.synopsis, f.note, f.affiche, CONCAT(prenom, ' ', nom) AS realisateur, f.id_realisateur, f.id_film
        FROM film f
        INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE f.id_film = :id");
        $requeteDetailFilm->execute(["id" => $id]);

        // il est nécessaire d'utiliser une seconde requête pour le casting
        $requeteCasting = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, r.nom_personnage, c.id_acteur, c.id_role
        FROM castings c
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN personne p ON a.id_personne = p.id_personne
        INNER JOIN role r ON c.id_role = r.id_role
        WHERE c.id_film = :id");
        $requeteCasting->execute(["id" => $id]);
        
        // choix d'un role
        $choixRole = $pdo->prepare("SELECT * FROM role");
        $choixRole->execute();
    
        // choix d'un acteur
        $choixActeur = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomActeur
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixActeur->execute();

        // choix du réalisateur
        $choixReal = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomReal, r.id_realisateur
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixReal->execute();
        require "view/formulaires/modifierFilm.php";
    }

    public function modifierFilmBDD(){ 
        //-------------- modifie les données, action en haut du formulaire
        if(isset($_POST['submit'])){
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $resume= filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role= filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie= filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $note= filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

             //si ces éléments sont filtrés correctement, alors on les execute dans values 
            // if($nom && $resume && $role && $anneeSortie && $duree && $note ){
         
                
                $modifications = [
                    'titre'=>$nom,
                    'annee_sortie_fr' => $anneeSortie,
                    'synopsis' => $resume,
                    'note' => $note,
                    // 'id'=>$id, 
                ];

            } 
        // }
            // header("Location:index.php");
            // exit;

    }

}