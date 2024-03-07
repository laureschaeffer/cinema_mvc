<?php //fichier qui traite les requetes sql

namespace Model;


class RealisateurManager extends Manager{
    protected $tableName = "realisateur";

    //liste
    public function listReals(){
        $pdo = Connect::seConnecter();
        $requeteLsReal = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, r.id_realisateur, p.photo
            FROM realisateur r
            INNER JOIN personne p ON r.id_personne = p.id_personne
            ORDER BY nomReal"
        );
    

        return $requeteLsReal->fetchAll();
    }

    //detail d'un realisateur
    public function detailReal($id){
        $pdo = Connect::seConnecter();

        $realisateur = $pdo->prepare("SELECT id_realisateur FROM realisateur WHERE id_realisateur = :id");
        $realisateur->execute(["id" => $id]);
        $real = $realisateur->fetch();

        // si l'id de l'url demandé existe dans la bdd
        if($real){
            $requeteReal = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomReal, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, p.photo, p.biographie, p.sexe, r.id_realisateur, r.id_personne
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
            
            //tableau pour return tous les fetch
            $data = ["requeteReal"=> $requeteReal->fetch(),
            "realFilmographie"=>$realFilmographie->fetchAll()];
            return $data;
    
        } else {
            header("Location: index.php"); exit;
        }

    }

    //infos de la personne dans le formulaire de modification
    public function formSelectReal($id){
        $pdo = Connect::seConnecter();
        $realisateurs= $pdo->prepare("SELECT * FROM personne WHERE id_personne = :id_personne");
        $realisateurs->execute(["id_personne"=>$id]);

        return $realisateurs->fetch();
    }

    // -----------------------------------------formulaire-------------------
  
    // fonctions ajout real
    public function ajoutRealisateur($nom, $prenom, $sexe, $dateAnniv, $biographie, $lienPhoto){

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
        // dans la table réalisateur j'ajoute l'id de la personne nouvellement créé, et l'id réalisateur est en auto-increment
        $ajoutReal = $pdo->prepare("INSERT INTO realisateur (id_personne) VALUES (:id_personne)");
        $idReal=$pdo->lastInsertId(); // recupere le dernier id créé
        $ajoutReal->execute(["id_personne" => $idReal]);

        header("Location:index.php?action=detailReal&id=$idReal"); // redirige vers la page du realisateur nouvellement créé
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