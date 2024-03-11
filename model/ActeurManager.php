<?php
//fichier qui traite les requetes sql
namespace Model;


class ActeurManager extends Manager{
    protected $tableName = "acteur";
    

    //liste
    public function listActeurs(){
        $pdo = Connect::seConnecter();
        $requeteLsActeur = $pdo->query(
            "SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, a.id_personne, p.photo, a.id_acteur
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne
            ORDER BY p.nom"
        );

        return $requeteLsActeur->fetchAll();

    }

    //detail
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        
        $acteur = $pdo->prepare("SELECT id_acteur FROM acteur WHERE id_acteur = :id");
        $acteur->execute(["id" => $id]);
        $act = $acteur->fetch();

        if($act){
            $requeteActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS nomActeur, DATE_FORMAT(date_naissance, '%d/%m/%Y') AS date_naissance, p.photo, p.biographie, p.sexe, a.id_personne, a.id_acteur
            FROM acteur a
            INNER JOIN personne p ON a.id_personne = p.id_personne
            WHERE a.id_acteur = :id");
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
    $ajoutActeur = $pdo->prepare("INSERT INTO acteur (id_personne)
        VALUES (:id_personne)");
        $idActeur=$pdo->lastInsertId(); //recupere le dernier id créé
        $ajoutActeur->execute(["id_personne" => $idActeur]);
        
    } 
    
    //infos de la personne dans le formulaire de modification
    public function formSelectAct($id){
        $pdo = Connect::seConnecter();
        $acteurs= $pdo->prepare("SELECT * FROM personne WHERE id_personne = :id_personne");
        $acteurs->execute(["id_personne"=>$id]);

        return $acteurs->fetch();
    }

    //formulaire modification d'un acteur, fonction appelée dans le controller apres le traitement
    public function modifierActBDD($prenom, $nom, $sexe, $dateAnniv, $biographie, $lienPhoto, $id){
        //modifie les entree dans la bdd personne
        $pdo = Connect::seConnecter();
        $modifierActeurBDD= $pdo->prepare("UPDATE personne SET prenom=:prenom, nom=:nom, sexe= :sexe, date_naissance=:date_naissance, biographie= :biographie, photo= :photo WHERE id_personne= :id");
        $modifierActeurBDD->execute([
            'prenom'=>$prenom,
            'nom'=>$nom,
            'sexe'=>$sexe,
            'date_naissance'=>$dateAnniv, 
            'biographie'=>$biographie,
            'photo'=>$lienPhoto,
            'id'=>$id
        ]);

    }
    
//cherche id_acteur de la personne modifiée avec l'id_personne, pour rediriger vers la bonne page
    public function findAct($id){
        $pdo = Connect::seConnecter();
        $findIdAct=$pdo->prepare("SELECT * FROM acteur 
        WHERE id_personne= :id");
        $findIdAct->execute(["id"=>$id]);
        return $findIdAct->fetch();

    }

    //supprime uniquement le fait d'etre acteur, pas la personne
    public function supprimerActeur($id){
        //comme dans la bdd j'ai mis en place une contrainte "suppression en cascade", supprimer l'acteur supprime egalement les entrees ou l'id existe dans castings
        $pdo = Connect::seConnecter();
        $supprimerActBDD=$pdo->prepare("DELETE from acteur WHERE id_acteur= :id");
        $supprimerActBDD->execute(["id"=>$id]);
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