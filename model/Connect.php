<?php

// connexion à la bdd grace a pdo

namespace Model;

abstract class Connect {

    const HOST = "db"; 
    const DB = "cinema_laure";
    const USER = "root" ;
    const PASS = "";

    public static function seConnecter(){
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
                die;
        } catch (\PDOException $ex){
            return $ex->getMessage();
        }

        // catch (Exception $e)
        // {
        // die('Erreur : ' . $e->getMessage());
        // }

    }

}

// abstraction en pdo: PDO constitue une couche d'abstraction qui intervient entre l'application PHP et un système de gestion de base de données (SGDB)

// difference pdo et mysqli: Il existe notamment une différence notable entre ces deux API : l’extension MySQLi ne va fonctionner qu’avec les bases de données MySQL tandis que PDO va fonctionner avec 12 systèmes de bases de données (sgbd) différents.


// fonction static: declare les proprietes d'une classe ou methode qui les rend accessible sans instancier une classe

// include et require chargent un fichier a l'aide d'un chemin physique. Seulement require renvoie une erreur s'il ne trouve pas le fichier

//Quatres principes de la POO:
//L'encapsulation: restreindre l'acces avec la visibilite (private public protected)
// L'abstraction: permet de ne pas devoir toujours instancier une classe pour pouvoir utiliser les methodes et attributs
// L'héritage: classe mere et classe héritée
// Le polymorphisme: mot clé "implement", oblige a retourner la meme chose mais de formes differentes

////prepare: cree le moule qui ne peut pas etre modifié, execute recupere les donnees, fetch les affiche