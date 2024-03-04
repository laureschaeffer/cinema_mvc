<?php
// fichier qui crée les fonctions pour la table film, en lien avec les boucles dans les fichiers "view" correspondantes; les méthodes sont appelées dans l'index
namespace Controller;
use Model\Connect;
// FILTER_SANITIZE_URL

class FilmController {

    //liste de tous les films
    public function listFilms(){
        $pdo = Connect::seConnecter();
        // $managerFilm = new FilmManager();
        // $requeteLsFilms = $managerFilm->getFilms();
        $requeteLsFilms = $pdo->prepare(
            "SELECT f.titre, f.annee_sortie_fr, f.synopsis, f.note, f.affiche, CONCAT(prenom, ' ', nom) AS realisateur, f.id_realisateur, f.id_film
            FROM film f
            INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
            INNER JOIN personne p ON r.id_personne = p.id_personne
            ORDER BY f.titre");
        $requeteLsFilms->execute();

        require "view/film/listeFilms.php";
    }

    //detail d'un film
    public function detailFilm($id){
        $pdo = Connect::seConnecter();

        $requeteFilm = $pdo->prepare("SELECT id_film FROM film WHERE id_film = :id");
        $requeteFilm->execute(["id" => $id]);
        $film = $requeteFilm->fetch();
    
        if($film) {
        
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
    
            // pour avoir plusieurs genres
            $requeteGenreFilm = $pdo->prepare("SELECT d.id_film, g.nom AS nomGenre, g.id_genre
            FROM definir d
            INNER JOIN film f ON d.id_film = f.id_film
            INNER JOIN genre g ON d.id_genre = g.id_genre
            WHERE d.id_film = :id");
    
            $requeteGenreFilm->execute(["id" => $id]);
    
            require "view/film/detailFilm.php";
        } else {
            header("Location: index.php");
        }

    }
// --------------------------------------------------------------------formulaires-------------------------------------------------- 

    public function showList(){ // requete pour les listes déroulantes du formulaire
        $pdo = Connect::seConnecter();
        // choix du réalisateur
        $choixReal = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomReal, r.id_realisateur
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixReal->execute();

        // choix du genre, dans la table définir qui va récupérer les id
        $choixGenre = $pdo->prepare("SELECT *
        FROM genre");
        $choixGenre->execute();

   
        require "view/formulaires/ajouterFilm.php";
    }

    // formulaire ajout d'un film
    public function ajouterFilm(){

        
        if(isset($_POST['submit'])){ // si la session récupère les infos avec le bouton submit

            // ----------------------d'abord traitement de l'image téléchargée---------
            if(isset($_FILES['file'])){ //si la session récupère l'image avec la methode file, un tableau associatif se crée
                if($_FILES["file"]["error"] <> 4) {
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

                    // taille max
                    $maxSize = 40000000;
    
                    $lienAffiche='public/img/affiches/'.$newFileName;
                    //si l'extension fait parti de celles autorisées dans le tableau, et qu'aucune erreur n'est apparu, alors je la télécharge
                  
                    if(in_array($extension, $extensionsAutorisees) && $fileError==0 && $fileSize <=$maxSize){
                        // move_uploaded_file($tmpName, $lienAffiche);
                        imagewebp(imagecreatefromstring(file_get_contents($tmpName)), $lienAffiche);
                    } 
                } else {
                    $lienAffiche= "https://placehold.co/600x400";//image par défaut
                }
            }
            // -----------ensuite traitement des input-----

            // filtres les caractères pour la sécurité
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $anneeSortie= filter_input(INPUT_POST, "anneeSortie", FILTER_VALIDATE_INT);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $resume= filter_input(INPUT_POST, "resume", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note= filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $genres = filter_input(INPUT_POST, "genres", FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);

            //si ces éléments sont filtrés correctement, alors on les execute dans values 
            if($nom && $resume && $anneeSortie && $duree && $note){

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
                    'affiche' => $lienAffiche // en lien avec le traitement de l'image plus haut
                ]);

                // https://www.php.net/manual/fr/pdo.lastinsertid.php dans la table définir j'ajoute l'id du film nouvellement créé et l'id_genre récupéré
                $idFilm = $pdo->lastInsertId();

                //checkbox renvoie un tableau dans le name
                foreach($genres as $genre){
                    $ajouterDefinirBDD = $pdo->prepare("INSERT into definir(id_film, id_genre) VALUES(:id_film, :id_genre)");
                    $ajouterDefinirBDD->execute([
                        'id_film' => $idFilm,
                        'id_genre'=> $genre
                    ]);
                }

                header("Location:index.php?action=detailFilm&id=$idFilm");
                exit;
            }

        }
    }

    //affiche les infos d'un film dans le formulaire de modification
    public function showListFilm($id){
        $pdo = Connect::seConnecter();
        $requeteDetailFilm = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, f.synopsis, f.duree, f.note, f.affiche, CONCAT(prenom, ' ', nom) AS realisateur, f.id_realisateur, f.id_film
        FROM film f
        INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE f.id_film = :id");
        $requeteDetailFilm->execute(["id" => $id]);

        //pour afficher le genre
        $requeteGenreFilm = $pdo->prepare("SELECT * FROM genre");
        $requeteGenreFilm->execute();


        // choix du réalisateur
        $choixReal = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomReal, r.id_realisateur
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixReal->execute();
        require "view/formulaires/modifierFilm.php";
    }

    public function modifierFilmBDD($id){ 
        //-------------- modifie les données, action en haut du formulaire
        if(isset($_POST['submit'])){
            $titre= filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $synopsis= filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $annee_sortie_fr= filter_input(INPUT_POST, "annee_sortie_fr", FILTER_VALIDATE_INT);
            $duree=filter_input(INPUT_POST, "duree", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $note= filter_input(INPUT_POST, "note", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

             //si ces éléments sont filtrés correctement, alors on les execute dans values 
            if($titre && $synopsis && $annee_sortie_fr && $duree && $note ){
         
                $pdo = Connect::seConnecter();                
                $modifierFilmBDD = $pdo->prepare("UPDATE film
                SET titre= :titre, annee_sortie_fr= :annee_sortie_fr, duree= :duree, synopsis= :synopsis, note= :note
                WHERE id_film= :id");
                $modifierFilmBDD->execute([
                    'titre'=>$titre,
                    'annee_sortie_fr' => $annee_sortie_fr,
                    'duree' => $duree,
                    'synopsis' => $synopsis,
                    'note' => $note,
                    'id'=>$id
                ]);

                //checkbox renvoie un tableau dans le name
                foreach($genres as $genre){
                    $ajouterDefinirBDD = $pdo->prepare("UPDATE definir 
                    SET id_genre = :id_genre
                    WHERE id_film= :id_film");
                    $ajouterDefinirBDD->execute([
                        'id_film' => $idFilm,
                        'id_genre'=> $genre
                    ]);
                }


                header("Location:index.php?action=detailFilm&id=$id");
                exit;
            } else{
                header("Location:index.php");
                exit;
            }
        }

    }
}
