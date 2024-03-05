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
    public function ajoutGenre(){
        if(isset($_POST['submit'])){
            $nom= filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if($nom){
                $pdo = Connect::seConnecter();
                $ajouterGenreBDD = $pdo->prepare("INSERT into genre(nom) VALUES(:nom)");
                $ajouterGenreBDD->execute(["nom"=>$nom]);

                $idGenre = $pdo->lastInsertId();

                header("Location:index.php?action=detailGenre&id=$idGenre"); // redirige vers la page du genre nouvellement créé
                exit;
            }
        } else{
            header("Location:index.php");
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