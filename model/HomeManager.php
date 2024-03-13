<?php
//fichier qui traite les requetes sql

namespace Model;

class HomeManager extends Manager{
    protected $tableName = "film";
    
    //choix de 4 acteurs du moment pour les articles de la landing-page
    public function viewHomePage(){
        $pdo = Connect::seConnecter();
        //-----4 acteurs du moment
        $requeteHomeActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS acteur, p.photo, p.biographie, p.id_personne, a.id_acteur 
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
         WHERE a.id_acteur IN (7, 19, 6, 30)"); 
        $requeteHomeActeur->execute();

        //-----calcule le nb de films dans lequel chaque acteur a joué et renvoie les 3 plus présents
        $requeteActeurPresent = $pdo->prepare("SELECT COUNT(c.id_acteur) AS nbFilm, c.id_acteur, CONCAT(p.prenom, ' ', p.nom) AS nomActeur, p.biographie, p.photo
        FROM castings c
        INNER JOIN acteur a ON c.id_acteur = a.id_acteur
        INNER JOIN personne p ON a.id_personne = p.id_personne
        GROUP BY id_acteur
        ORDER BY nbFilm DESC
        LIMIT 3");
        $requeteActeurPresent->execute();

        $data= ["requeteHomeActeur"=>$requeteHomeActeur->fetchAll(),
        "requeteActeurPresent"=>$requeteActeurPresent->fetchAll()];

        return $data;
    }





}