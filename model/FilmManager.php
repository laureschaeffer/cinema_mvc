<?php
//fichier qui traite les requetes sql

namespace Model;
use Service\CompressImg;

class FilmManager extends Manager {
    protected $tableName = "film";

    //liste films
    public function listFilms(){
        $pdo = Connect::seConnecter();

        $requeteLsFilms = $pdo->prepare(
            "SELECT f.titre, f.annee_sortie_fr, f.synopsis, f.note, f.affiche, CONCAT(prenom, ' ', nom) AS realisateur, f.id_realisateur, f.id_film
            FROM film f
            INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
            INNER JOIN personne p ON r.id_personne = p.id_personne
            ORDER BY f.titre");
        $requeteLsFilms->execute();
        return $requeteLsFilms->fetchAll();
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

            //tableau pour return tous les fetch
            $data = ["requeteDetailFilm" => $requeteDetailFilm->fetch(),
                    "requeteCasting" => $requeteCasting->fetchAll(),
                    "requeteGenreFilm"=> $requeteGenreFilm->fetchAll()];
            return $data;
            
        } else {
            header("Location: index.php");
        }

    }
    
    // ------------------------------------------------------Formulaires--------------------------------------
    //liste deroulante formulaire ajout
    public function formSelect(){ 
        $pdo = Connect::seConnecter();
        
        // choix du réalisateur
        $choixReal = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomReal, r.id_realisateur
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixReal->execute();
        
        // choix du genre, dans la table définir qui va récupérer les id
        $choixGenre = $pdo->prepare("SELECT * from genre ORDER BY nom");
        $choixGenre->execute();

        $data = ["choixReal"=>$choixReal->fetchAll(),
                "choixGenre"=>$choixGenre->fetchAll()];
        return $data;

    }

     // formulaire ajout d'un film, ajouter les données récupérées à la bdd à l'aide de la requete sql
    public function ajouterFilm($nom, $anneeSortie, $duree, $resume, $note, $genres, $lienAffiche){

        $pdo = Connect::seConnecter();
        $ajouterFilmBDD = $pdo->prepare("INSERT into film(titre, annee_sortie_fr, duree, synopsis, note, id_realisateur, affiche) VALUES(:titre, :annee_sortie_fr, :duree,:synopsis, :note, :id_realisateur, :affiche)");
        $ajouterFilmBDD->execute([
        'titre'=>$nom,
        'annee_sortie_fr'=>$anneeSortie,
        'duree'=>$duree,
        'synopsis'=>$resume,
        'note'=>$note,
        'id_realisateur' => $_POST["realisateur"],
        'affiche' => $lienAffiche // en lien avec le traitement de l'image
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



    //-------------------------listes pour le formulaire de modification
    public function formSelectFilm($id){
        $pdo = Connect::seConnecter();
        //infos du film
        $requeteDetailFilm = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, f.synopsis, f.duree, f.note, f.affiche, CONCAT(prenom, ' ', nom) AS realisateur, f.id_realisateur, f.id_film
        FROM film f
        INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
        INNER JOIN personne p ON r.id_personne = p.id_personne
        WHERE f.id_film = :id");
        $requeteDetailFilm->execute(["id" => $id]);

               
        // choix du réalisateur
        $choixReal = $pdo->prepare("SELECT concat(p.prenom, ' ', p.nom) AS nomReal, r.id_realisateur
        FROM realisateur r
        INNER JOIN personne p ON r.id_personne = p.id_personne
        ORDER BY p.nom");
        $choixReal->execute();

        $data = ["requeteDetailFilm"=>$requeteDetailFilm->fetch(), //ne renvoie qu'une ligne
                "choixReal"=>$choixReal->fetchAll()];
        return $data;
        
    }

    //formulaire modification d'un film
    public function modifierFilmBDD($titre, $annee_sortie_fr, $duree, $synopsis, $note, $lienAffiche, $genres, $id){ 
                //modifie les entrée dans la bdd film
                $pdo = Connect::seConnecter();                
                $modifierFilmBDD = $pdo->prepare("UPDATE film
                SET titre= :titre, annee_sortie_fr= :annee_sortie_fr, duree= :duree, synopsis= :synopsis, note= :note, affiche= :affiche
                WHERE id_film= :id");
                $modifierFilmBDD->execute([
                    'titre'=>$titre,
                    'annee_sortie_fr' => $annee_sortie_fr,
                    'duree' => $duree,
                    'synopsis' => $synopsis,
                    'note' => $note,
                    'affiche' =>$lienAffiche, //en lien avec le traitement de l'image
                    'id'=>$id
                ]);

                //supprime toutes les lignes definir genre ou il y a id_film=...
                $supprimerTabDefinir = $pdo->prepare("DELETE FROM definir WHERE id_film= :id_film");
                $supprimerTabDefinir->execute(["id_film"=>$id]);

                //avec le tableau genres créé dans le formulaire, je rajoute dans la table definir les id_genre choisis avec l'id_film correspondant
                foreach($genres as $genre){
                    $ajouterDefinirBDD = $pdo->prepare("INSERT into definir(id_film, id_genre) VALUES(:id_film, :id_genre)");
                    $ajouterDefinirBDD->execute([
                        'id_film' => $id,
                        'id_genre'=> $genre
                    ]);
                }
                header("Location:index.php?action=detailFilm&id=$id");
                exit;
            
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