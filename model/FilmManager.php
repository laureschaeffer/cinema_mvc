<?php

namespace Model;
use Model\GenreManager;

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
    
    // -------------------------------------listes pour le formulaire
    public function showList(){ 
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