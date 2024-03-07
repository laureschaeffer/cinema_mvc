<?php
//fichier qui traite les requetes sql
namespace Model;


class ActeurManager extends Manager{
    protected $tableName = "acteur";

    //liste
    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requeteLsActeur = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, a.id_personne, p.photo
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne
            ORDER BY p.nom"
        );

        return $requeteLsActeur->fetchAll();

    }

    //detail
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        
        $acteur = $pdo->prepare("SELECT id_acteur FROM acteur WHERE id_personne = :id");
        $acteur->execute(["id" => $id]);
        $act = $acteur->fetch();

        if($act){
            $requeteActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, p.photo, p.biographie, p.sexe, a.id_personne
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne
            WHERE a.id_personne = :id");
            $requeteActeur->execute(["id" => $id]);
            // on fait passer un tableau associatif qui associe le nom de champ paramétré avec la valeur de l'id
    
            //deuxième requête pour afficher la filmographie
            $acteurFilmographie = $pdo->prepare("SELECT f.titre, f.annee_sortie_fr, r.nom_personnage, c.id_film, r.id_role
            FROM castings c
            INNER JOIN film f ON c.id_film = f.id_film
            INNER JOIN role r ON c.id_role = r.id_role
            WHERE c.id_acteur= :id");
            $acteurFilmographie->execute(["id"=> $id]);

            //tableau pour return tous les fetch
            $data = ["requeteActeur"=> $requeteActeur->fetch(),
                    "acteurFilmographie"=>$acteurFilmographie->fetchAll()];
            return $data;
            

        } else {
            header("Location: index.php") ;
        }   
    }

    //infos de la personne dans le formulaire de modification
    public function formSelectAct($id){
        $pdo = Connect::seConnecter();
        $acteurs= $pdo->prepare("SELECT * FROM personne WHERE id_personne = :id_personne");
        $acteurs->execute(["id_personne"=>$id]);

        return $acteurs->fetch();
    }



    //--------------------------formulaires----------------------

    //apres traitement des input, ajouter à la bdd
    public function ajoutActeur($nom, $prenom, $sexe, $dateAnniv, $biographie, $lienPhoto){

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
    
        // dans la table acteur j'ajoute l'id de la personne nouvellement créé, et l'id acteur est en auto-increment
        $ajoutReal = $pdo->prepare("INSERT INTO acteur (id_personne)
        VALUES (:id_personne)");
        $idReal=$pdo->lastInsertId(); //recupere le dernier id créé
        $ajoutReal->execute(["id_personne" => $idReal]);

        header("Location:index.php?action=detailActeur&id=$idReal"); // redirige vers la page du nouveau realisateur
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