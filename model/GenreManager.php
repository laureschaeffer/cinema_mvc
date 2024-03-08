<?php //page qui traite les requetes sql


namespace Model;

class GenreManager extends Manager {
    protected $tableName = "genre";

    // detail d'un genre
    public function detailGenre($id){
        $pdo = Connect::seConnecter();

        $genreFilm = $pdo->prepare("SELECT id_genre FROM genre WHERE id_genre = :id");
        $genreFilm->execute(["id"=>$id]);
        $genre = $genreFilm->fetch();

        //si l'id de l'url demandé existe dans la bdd
        if($genre){
            $requeteDetailGenre = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, d.id_genre, g.nom, f.id_film
            FROM definir d
            INNER JOIN film f ON d.id_film = f.id_film
            INNER JOIN genre g ON d.id_genre = g.id_genre
            WHERE d.id_genre= :id");
            $requeteDetailGenre->execute(["id" =>$id]);


            return $requeteDetailGenre->fetchAll();

        } else{
            header("location: index.php"); exit;
        }

    }

        // ------formulaire------
    public function ajoutGenre($nom){

        $pdo = Connect::seConnecter();
        $ajouterGenreBDD = $pdo->prepare("INSERT into genre(nom) VALUES(:nom)");
        $ajouterGenreBDD->execute(["nom"=>$nom]);
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