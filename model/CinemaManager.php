<?php
//fichier qui traite les requetes sql

namespace Model;

class CinemaManager extends Manager{
    protected $tableName = "film";
    
    //choix de 4 acteurs pour les articles de la landing-page
    public function viewHomePage(){
        $pdo = Connect::seConnecter();
        $requeteHomeActeur = $pdo->prepare("SELECT CONCAT(p.prenom, ' ', p.nom) AS acteur, p.photo, p.biographie, p.id_personne, a.id_acteur 
        FROM acteur a
        INNER JOIN personne p ON a.id_personne = p.id_personne
         WHERE a.id_acteur IN (3, 4, 6, 22)"); 
        $requeteHomeActeur->execute();

        return $requeteHomeActeur->fetchAll();
    }

}